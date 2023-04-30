<?php
include('database.php');

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data and sanitize it
  $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
  $ca = filter_var($_POST["ca"], FILTER_SANITIZE_NUMBER_INT);
  $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
  $password_confirm = filter_var($_POST["password_confirm"], FILTER_SANITIZE_STRING);

  // Validate the form data
  $errors = [];
  if (empty($name)) {
    $errors[] = "Name is required";
  }
  if (empty($ca)) {
    $errors[] = "Chiffre d'affaire is required";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format";
  }
  if (empty($password)) {
    $errors[] = "Password is required";
  }
  if ($password != $password_confirm) {
    $errors[] = "Passwords do not match";
  }
    $logo_name = $_FILES['logo']['name'];
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["logo"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    move_uploaded_file($_FILES['logo']['tmp_name'],$target_dir.$logo_name);
  // If there are no errors, insert the data into the database
  if (empty($errors)) {
     $query = "CREATE TABLE IF NOT EXISTS entreprise (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        ca INT(10) NOT NULL,
        email VARCHAR(50) NOT NULL,
        password VARCHAR(30) NOT NULL,
        logo VARCHAR(100) NOT NULL
    )";
    $result = mysqli_query($conn, $query);
        //send the query
        $result = mysqli_query($conn, $query);
    //hash the password
    // $password = password_hash($password, PASSWORD_DEFAULT);
    // Insert the data into the database
    $sql = "INSERT INTO entreprise (name, ca, email, password, logo) VALUES ('$name', '$ca', '$email', '$password', '$logo_name')";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
      echo "Post submitted successfully!";
      //go to the login page
      header("Location: loogin.php");
    } else {
      echo "Error submitting post: " . mysqli_error($conn);
    }
  } else {
    // If there are errors, display them to the user
    echo "<ul>";
    foreach ($errors as $error) {
      echo "<li>$error</li>";
    }
    echo "</ul>";
  }
  

}
?>

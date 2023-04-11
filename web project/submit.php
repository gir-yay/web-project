<?php
include("database.php");

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


  // If there are no errors, insert the data into the database
  if (empty($errors)) {
    //hash the password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO entreprise (Name, CA, email, password, Logo) VALUES ('$name', $ca, '$email', '$password', '$filename')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      echo "Post submitted successfully!";
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

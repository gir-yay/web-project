<!-- connect to data base using include -->
<?php
include 'database.php';
//recieve data from the influencer section 
//check if the form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get the lastname , firstname , email , password ,age,password_confirm
    $lastname = filter_var($_POST["Lastname"], FILTER_SANITIZE_STRING);
    $firstname = filter_var($_POST["Firstname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $age = filter_var($_POST["age"], FILTER_SANITIZE_NUMBER_INT);
    $password_confirm = filter_var($_POST["password_confirm"], FILTER_SANITIZE_STRING);
    //validate the form data
    $errors = [];
    if(empty($lastname)){
        $errors[] = "lastname is required";
    }
    if(empty($firstname)){
        $errors[] = "firstname is required";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format";
    }
    if(empty($password)){
        $errors[] = "password is required";
    }
    if(empty($age)){
        $errors[] = "age is required";
    }
    if($password != $password_confirm){
        $errors[] = "Passwords do not match";
    }
    //if there are no errors insert the data into the database
    if(empty($errors)){
        //create the database table if it doesn't exist
        $query = "CREATE TABLE IF NOT EXISTS influencer (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            lastname VARCHAR(30) NOT NULL,
            firstname VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
            password VARCHAR(30) NOT NULL,
            age INT(6) NOT NULL)";
        //send the query
        $result = mysqli_query($conn, $query);
        //hash the password
        // $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO influencer (lastname, firstname, email, password, age) VALUES ('$lastname', '$firstname', '$email', '$password', $age)";
        $result = mysqli_query($conn, $query);
        if($result){
            echo "Post submitted successfully!";
            //go the login page
            header("Location: loogin.php");
        }else{
            echo "Error submitting post: " . mysqli_error($conn);
        }

    }else{
        //if there are errors display them to the user
        echo "<ul>";
        foreach($errors as $error){
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
 }
?>
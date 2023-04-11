<!-- connect to data base using include -->
<?php
include 'database.php';
//check if the form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //get the form data and sanitize it
    $Lastname = filter_var($_POST["Lastname"], FILTER_SANITIZE_STRING);
    $Firstname = filter_var($_POST["Firstname"], FILTER_SANITIZE_STRING);
    $age = filter_var($_POST["age"], FILTER_SANITIZE_NUMBER_INT);
    $socialmedia = filter_var($_POST["socialmedia"], FILTER_SANITIZE_STRING);
    $url = filter_var($_POST["url"], FILTER_SANITIZE_STRING);
    //validate the form data
    $errors = [];
    if(empty($Lastname)){
        $errors[] = "Lastname is required";
    }
    if(empty($Firstname)){
        $errors[] = "Firstname is required";
    }
    if(empty($age)){
        $errors[] = "age is required";
    }
    if(empty($socialmedia)){
        $errors[] = "socialmedia is required";
    }
    if(empty($url)){
        $errors[] = "url is required";
    }
    //if there are no errors, insert the data into the database
    if(empty($errors)){
        //first create the table if it doesn't exist
        $query = "CREATE TABLE IF NOT EXISTS influenceur (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            Lastname VARCHAR(30) NOT NULL,
            Firstname VARCHAR(30) NOT NULL,
            age INT(6) NOT NULL,
            socialmedia VARCHAR(30) NOT NULL,
            url VARCHAR(30) NOT NULL
        )";
        $result = mysqli_query($conn, $query);
        if(!$result){
            echo "Error creating table: " . mysqli_error($conn);
        }
        //insert the data
        $query = "INSERT INTO influenceur (Lastname, Firstname, age, socialmedia, url) VALUES ('$Lastname', '$Firstname', $age, '$socialmedia', '$url')";
        $result = mysqli_query($conn, $query);
        if($result){
            echo "Post submitted successfully!";
        }else{
            echo "Error submitting post: " . mysqli_error($conn);
        }
    }else{
        //if there are errors, display them to the user
        echo "<ul>";
        foreach($errors as $error){
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}
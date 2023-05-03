<?php 

session_start(); 

include "database.php";

//the email and password from the form are not empty and stored in th e$_post array
$email =$_POST['email'];
$password =$_POST['password'];
$pw= sha1($password);
// check if the email and password exist in the entreprise table
$sql = "SELECT * FROM entreprise WHERE email='$email' AND password='$pw'";
$result = mysqli_query($conn, $sql);

//check if the result is not empty
if (mysqli_num_rows($result) > 0) {
    //store the email in the session
    $_SESSION['email'] = $email;
    //add the id of the entreprise to the session
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    //redirect to the dashboard page
    header("Location: entreprise.php");
    exit();
} else {
    //redirect to the login page with an error message
    header("Location: loogin.php?error=Incorect User name or password");
    exit();
}

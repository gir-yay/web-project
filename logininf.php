<?php 

session_start(); 

include "database.php";
//get the email and password from the form $_POST
$email = $_POST['email'];
$password = $_POST['password'];
$pw = sha1($password);
//we already know the email and password from the form are not empty
//so we can directly use them in the query
$sql = "SELECT * FROM influencer WHERE email='$email' AND password='$pw'";
$result = mysqli_query($conn, $sql);
//if the number of rows is equal to 1, it means the email and password are correct,redirect to influenceur.php
//else redirect to loogin.php and display an error message 
if (mysqli_num_rows($result) == 1) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    //create a session variable with the id of the user
    $_SESSION['email'] = $row['email'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['firstname'] = $row['prenom'];
    $_SESSION['Lastname'] = $row['nom'];

    header("Location: influenceur.php");
} else {
    header("Location: loogin.php?error=Incorect email or password");
}
?>
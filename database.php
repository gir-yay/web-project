<?php
// connect to mysql database
//a variable for the name of the server
$servername = "localhost";
//a variable for the username
$user="root";
//a variable for the password
$password="";
//a variable for the database name
$dbname="users";
//create a connection
$conn="";
try {
    $conn = mysqli_connect($servername, $user, $password, $dbname);
} catch(Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    echo "Connected successfully";
}
  
?>

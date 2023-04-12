<?php 
// connect to database
include 'database.php';
// the session starts
session_start();
// check if the session variable is set
if (isset($_SESSION['username'])) {
    // if the session variable is set, redirect to dashboard.php
    $name=$_SESSION['username'];
    echo "<h1>WELCOME $name</h1>";
} else {
    // if the session variable is not set, redirect to admin.php
    header('Location: admin.php');
}
//show all the influencer from the database
echo "<h1>INFLUENCER</h1>";
$sql = "SELECT * FROM influencer";
$result = mysqli_query($conn, $sql);  
//print the result
foreach ($result as $row) {
    echo "<div class='influencer'>";
    echo "<h2>" . $row['id'] . "</h2>";
    echo "<h2>".$row['lastname']."</h2>";
    echo "<h2>".$row['firstname']."</h2>";
    echo "<h2>".$row['email']."</h2>";
    echo "<h2>".$row['age']."</h2>";
    echo "</div>";
}
//show all the brand from the database
echo "<h1>BRAND</h1>";
$sql = "SELECT * FROM entreprise";
$result = mysqli_query($conn, $sql);
//print the result
foreach ($result as $row) {
    echo "<div class='brand'>";
    echo "<h2>" . $row['id'] . "</h2>";
    echo "<h2>".$row['Name']."</h2>";
    echo "<h2>".$row['email']."</h2>";
    echo "<h2>".$row['CA']."</h2>";
    echo "</div>";
}



?>
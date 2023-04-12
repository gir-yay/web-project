<?php 
// connect to database
include 'database.php';
// the session starts
session_start();
// check if the session variable is set
if (isset($_SESSION['username'])) {
    // if the session variable is set, redirect to dashboard.php
    $name=$_SESSION['username'];
    echo "<h3>WELCOME $name</h3>";
} else {
    // if the session variable is not set, redirect to admin.php
    header('Location: admin.php');
}
// show all the influencer from the database as a table
echo "<h1>INFLUENCER</h1>";
$sql = "SELECT * FROM influencer";
$result = mysqli_query($conn, $sql);  

//print the result in a table format
echo "<table>";
echo "<tr><th>ID</th><th>Last Name</th><th>First Name</th><th>Email</th><th>Age</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['lastname']."</td>";
    echo "<td>".$row['firstname']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['age']."</td>";
    echo "</tr>";
}
echo "</table>";

// show all the brand from the database as a table
echo "<h1>BRAND</h1>";
$sql = "SELECT * FROM entreprise";
$result = mysqli_query($conn, $sql);
//print the result in a table format
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>CA</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['Name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['CA']."</td>";
    echo "</tr>";
}
echo "</table>";




?>
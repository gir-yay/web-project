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
echo "<tr><th>ID</th><th>Last Name</th><th>First Name</th><th>Email</th><th>Age</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['lastname']."</td>";
    echo "<td>".$row['firstname']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['age']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_influencer' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

// check if the delete button for influencer has been clicked
if(isset($_POST['delete_influencer'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM influencer WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

echo "<h1>BRAND</h1>";
$sql = "SELECT * FROM entreprise";
$result = mysqli_query($conn, $sql);

echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>CA</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['Name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['CA']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_brand' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

// check if the delete button for brand has been clicked
if(isset($_POST['delete_brand'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM entreprise WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

?>
<style>
  /* Style for the header tags */
h1 {
  font-size: 3rem;
  font-weight: bold;
  margin-bottom: 2rem;
  color: #2d2d2d;
}

h3 {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 1rem;
  color: #2d2d2d;
}

/* Style for the table */
table {
  width: 100%;
  border-collapse: collapse;
  margin: 2rem 0;
  font-size: 1rem;
  color: #2d2d2d;
  background-color: #fff;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
}

table th,
table td {
  padding: 1rem;
  text-align: left;
}

table th {
  font-weight: bold;
  background-color: #f9f9f9;
}

table tr:nth-child(even) {
  background-color: #f5f5f5;
}

/* Style for the links */
a {
  color: #E24C4C;
  font-weight: bold;
  text-decoration: none;
}

a:hover {
  color: #AD2E2E;
}

/* Style for the buttons */
button {
  background-color: #E24C4C;
  color: #fff;
  border: none;
  padding: 0.8rem 1.5rem;
  font-size: 1rem;
  font-weight: bold;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #AD2E2E;
}

/* Style for the delete buttons */
input[type="submit"][name="delete_influencer"], input[type="submit"][name="delete_brand"] {
  background-color: #FF0000;
  color: #FFFFFF;
  border: none;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"][name="delete_influencer"]:hover, input[type="submit"][name="delete_brand"]:hover {
  background-color: #AD2E2E;
}





</style>
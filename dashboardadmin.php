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
//add a nav bar for home and logout
echo "<nav>";
echo "<a href='logout.php'>Logout</a>";
echo "</nav>";
// show all the influencer from the database as a table
echo "<h1>INFLUENCER</h1>";
$sql = "SELECT * FROM influencer";
$result = mysqli_query($conn, $sql);  

//print the result in a table format
echo "<div class='container'>";
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
echo "</div>";

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
echo "<div class='container'>";
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>CA</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['Name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['ca']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_brand' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";

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
//show all collab from the offer table inner join with the influencer table and the entreprise table in id_influencer and id_entreprise
echo "<h1>Offered COLLAB</h1>";
$sql = "SELECT * FROM offer INNER JOIN influencer ON offer.id_influencer = influencer.id INNER JOIN entreprise ON offer.id_entreprise = entreprise.id ";
$result = mysqli_query($conn, $sql);
//show the result in a table format brand name , influencer full name(firstname+lastname), terms, status,amount,duration ,reg_date,add a button to delete the collab
echo "<div class='container'>";
echo "<table>";
echo "<th>Brand Name</th><th>Influencer Name</th><th>Terms</th><th>Status</th><th>Amount</th><th>Duration</th><th>Reg Date</th><th>state</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['reg_date']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_collab' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";

// check if the delete button for collab has been clicked
if(isset($_POST['delete_collab'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM offer WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
//make a tabe  to show all the suggested collab from the suggestion table inner join with the influencer table and the entreprise table in id_influencer and id_entreprise
echo "<h1>SUGGESTED COLLAB</h1>";
$sql = "SELECT * FROM suggestion INNER JOIN influencer ON suggestion.id_influencer = influencer.id INNER JOIN entreprise ON suggestion.id_entreprise = entreprise.id ";
$result = mysqli_query($conn, $sql);
//show the result in a table format brand name , influencer full name(firstname+lastname), terms, status,amount,duration ,reg_date,add a button to delete the collab
echo "<div class='container'>";
echo "<table>";
echo "<th>Influencer Name</th><th>Brand Name</th><th>Terms</th><th>Status</th><th>Amount</th><th>Duration</th><th>Reg Date</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['firstname'] . " " . $row['lastname'] . "</td>";
    echo "<td>".$row['Name']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['reg_date']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_suggested_collab' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";
// check if the delete button for suggested collab has been clicked
if(isset($_POST['delete_suggested_collab'])){
  $id = $_POST['id'];
  $sql = "DELETE FROM suggestion WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  if ($result) {
      echo "Record deleted successfully.";
  } else {
      echo "Error deleting record: " . mysqli_error($conn);
  }
}
//make a table for the request : id ,user_id , type ,state, the button need to be delete 
echo "<h1>REQUEST</h1>";
$sql = "SELECT * FROM request";
$result = mysqli_query($conn, $sql);
echo "<div class='container'>";
echo "<table>";
echo "<th>ID</th><th>User ID</th><th>Type</th><th>State</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['user_id']."</td>";
    echo "<td>".$row['type']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_request' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
// check if the delete button for request has been clicked
if(isset($_POST['delete_request'])){
  $id = $_POST['id'];
  //change the state to deleted 
  $sql = "UPDATE request SET state = 'deleted' WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  //depend of the type delte the user from the table
  if($result){
    $sql = "SELECT * FROM request WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $type = $row['type'];
    $user_id = $row['user_id'];
    if($type == 'influencer'){
      $sql = "DELETE FROM influencer WHERE id = '$user_id'";
      $result = mysqli_query($conn, $sql);
      //delete evey collab that the influencer has
      $sql = "DELETE FROM offer WHERE id_influencer = '$user_id'";
      $result = mysqli_query($conn, $sql);
      $sql = "DELETE FROM suggestion WHERE id_influencer = '$user_id'";
      $result = mysqli_query($conn, $sql);
      if($result){
        echo "Record deleted successfully.";
      }else{
        echo "Error deleting record: " . mysqli_error($conn);
      }
    }else{
      //delte the logo 
      $sql = "SELECT * FROM entreprise WHERE id = '$user_id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $logo = $row['logo'];
      unlink($logo);
      //delete the entreprise
      $sql = "DELETE FROM entreprise WHERE id = '$user_id'";
      $result = mysqli_query($conn, $sql);
      //delete evey collab that the influencer has
      $sql = "DELETE FROM offer WHERE id_entreprise = '$user_id'";
      $result = mysqli_query($conn, $sql);
      $sql = "DELETE FROM suggestion WHERE id_entreprise = '$user_id'";
      $result = mysqli_query($conn, $sql);

      if($result){
        echo "Record deleted successfully.";
      }else{
        echo "Error deleting record: " . mysqli_error($conn);
      }
    }
}
}
echo "</table>";
echo "</div>";

?>
<style>
  /* style for table */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

th, td {
  text-align: left;
  padding: 8px;
  font-size: 16px;
}

th {
  background-color: #4CAF50;
  color: white;
}

tr:nth-child(even){
  background-color: #f2f2f2
}

/* style for delete button */
input[type=submit] {
  background-color: #f44336;
  color: white;
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

input[type=submit]:hover {
  background-color: #f44336;
  opacity: 0.8;
}

/* style for headings */
h1, h3 {
  text-align: center;
  color: #2F4F4F;
  margin-bottom: 20px;
}

/* style for table container */
.container {
  max-width: 800px;
  margin: auto;
  padding: 20px;
  background-color: #f5f5f5;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

</style>
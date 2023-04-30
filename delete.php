<?php
include 'database.php';
session_start();
$id = $_SESSION['id'];
$type = $_SESSION['type'];
if($type==='entreprise'){
    $sql = "select * from entreprise where id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}else{
    $sql = "select * from influenceur where id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>
<?php

if(isset($_POST['delete']) && isset($_POST['confirm'])) {
    // add the request to the request table in the database
    $sql="INSERT INTO `request`(`user_id`, `type`, `state`) VALUES ('$id','$type','pending')";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
    }
  // Log user out after a 5-second countdown and redirect to home page
  echo '<p>Your request has been sent. You will be logged out in 5 seconds.</p>';
  echo '<script>setTimeout(function(){ window.location.href = "logout.php"; }, 5000);</script>';
  exit();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Account</title>
</head>
<body>
  <h1>Delete Account</h1>
  <p>Are you sure you want to delete your account?</p>
  <form method="post">
  <label style="margin-top: 10px;"><input type="checkbox" name="confirm" required> Yes, I want to delete my account.</label><br>

    <input type="submit" name="delete" value="Delete Account">
    <!-- depend of the user type show a href to the entreprise.php or the influenceur.php -->
    <?php if($type==='entreprise'){ ?>
        <a href="entreprise.php">No, go back to profile</a>
    <?php }else{ ?>
        <a href="influenceur.php">No, go back to profile</a>
    <?php } ?>
  </form>
</body>
</html>
<style>
    /* Center the contents of the page */
body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  font-family: Arial, sans-serif;
}

/* Style the title and subtitle */
h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  text-align: center;
}

p {
  font-size: 1.2rem;
  margin-bottom: 2rem;
  text-align: center;
}

/* Style the form and its components */
form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;
  max-width: 500px;
  padding: 2rem;
  background-color: #f5f5f5;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

label {
  font-size: 1.2rem;
  margin-bottom: 1rem;
}

input[type="submit"] {
  font-size: 1.2rem;
  background-color: #ff6666;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 0.8rem 1.5rem;
  margin-top: 2rem;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

input[type="submit"]:hover {
  background-color: #ff4d4d;
}

a {
  font-size: 1.2rem;
  margin-top: 2rem;
  text-decoration: none;
  color: #333;
  transition: color 0.2s ease-in-out;
}

a:hover {
  color: #ff6666;
}






</style>


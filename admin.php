<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<!-- create a form to login username and password -->
<h1><center>WELCOME ADMIN</center></h1>
<form action="admin.php" method="post">
  <div class="inputBox">
  <ion-icon name="person-outline"></ion-icon>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <i></i>
</div>
<div class="inputBox">
<ion-icon name="lock-closed-outline"></ion-icon>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <i></i>
</div>
    <input type="submit"  class="bouton" value="Login">

</form>
  
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>

<?php 
// connect to database
include 'database.php';

// check if the button is clicked
if (isset($_POST['username'])) {
    // get the username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // check if the username and password is correct
    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // if the username and password is correct
    if (mysqli_num_rows($result) > 0) {
        //start the session
        session_start();
        // set the session variable
        $_SESSION['username'] = $username;
        // redirect to the admin dashboard
        header('Location: dashboardadmin.php');
    } else {
        // show error message
        echo 'Username or password is incorrect';
    }
}



?>

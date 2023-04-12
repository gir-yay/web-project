<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

<!-- create a form to login username and password -->
<form action="admin.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Login">

</form>
    
</body>
</html>
<style>
body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
}

form {
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
  margin: 50px auto;
  max-width: 400px;
  padding: 20px;
  text-align: center; /* add text-align property */
}

label {
  display: block;
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
  border-radius: 5px;
  border: 1px solid #ccc;
  font-size: 16px;
  padding: 10px;
  width: 100%;
  margin-bottom: 10px; /* add margin to bottom */
}

input[type="submit"] {
  background-color: #4CAF50;
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  padding: 10px;
  width: 100%;
  transition: background-color 0.3s;
  margin-top: 10px; /* add margin to top */
}


input[type="submit"]:hover {
  background-color: #3e8e41;
}

</style>
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
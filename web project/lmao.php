<!-- Signup try  -->

<?php 
    // include the database connection file
    include("database.php");

    // receive the data from the form
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        //check if the username and password are empty
        if(empty($username) || empty($password)){
            echo "Please fill in the fields";
        }else{
            //hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);
            //send the data to the database
            $sql = "INSERT INTO `client` (username, password) VALUES ('$username', '$password')";
            if(mysqli_query($conn, $sql)){
                echo "Record added successfully.";
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Hello</p>
    <form method="post" action="lmao.php">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

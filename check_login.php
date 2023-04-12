<?php
// start the session before any output
session_start();

// check if the form was submitted
if (isset($_POST['logout'])) {
    // unset and destroy the session
    session_unset();
    session_destroy();

    // redirect to hom.php
    header("Location: index.php");
    exit(); // stop executing the current script
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome</h1>
    <p>You are logged in!</p>
    <h2>You can log out</h2>
    <form action="" method="POST">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>

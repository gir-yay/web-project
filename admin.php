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

<!-- formulaire pour l'identification -->
<h1><center>WELCOME ADMIN</center></h1>
<form action="admin.php" method="post">
  <div class="inputBox">
    <!--icon -->
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
<!--pour utiliser ion-icon il faut ajouter:  -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>

<?php 
// connecter à la base de donnees
include 'database.php';

// verifier si le bouton est cliqué
if (isset($_POST['username'])) {
    // recuperer le nom d'utilisateur et le mot de passe
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pw=sha1($password);

    // authentification
    // recupere les donnees du tableau admins
    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$pw'";
    $result = mysqli_query($conn, $sql);

    // authentifié  ?oui
    if (mysqli_num_rows($result) > 0) {
        //commence une session
        session_start();
        // les variables de las session
        $_SESSION['username'] = $username;
        // direction vers le tableau de bord de l'admin
        header('Location: dashboardadmin.php');
    } else {
        // message d'erreur
        echo 'Username or password is incorrect';
    }
}



?>

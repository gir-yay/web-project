<?php
// connecter avec mysql la base de donné
//le nom du serveur
$servername = "localhost";
//cas de changement du port par defaut
//$servername = "127.0.0.1:3308";
//utilisateur
$user="root";
//mot de passe
$password="";
//nom de la base de donné
$dbname="users";
//on connecte
$conn="";
try {
    //connexion
    $conn = mysqli_connect($servername, $user, $password, $dbname);
    //cas d'erreur
} catch(Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
// cas de connection n'est pas etabli
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    //echo "Connected successfully";
}
  
?>

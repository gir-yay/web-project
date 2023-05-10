<?php 
//commencer la session
session_start(); 
// connecter a la bd
include "database.php";

//recuperer l'email et le mot de passe a travers $_POST
$email = $_POST['email'];
$password = $_POST['password'];

// encrypter le mot de passe
$pw = sha1($password);

//we already know the email and password from the form are not empty
//so we can directly use them in the query
/*recuperer les informations de l'influenceur dont l'email est $email et le mot de passe est $pw */
/*les mots de passe sont encrypter dans la bd */
$sql = "SELECT * FROM influencer WHERE email='$email' AND password='$pw'";
$result = mysqli_query($conn, $sql);
/*si le nbr de ligne recuperé = 1 , donc l email et le mot de passe sont corrects , redirection a influenceur.php*/
/*sino redirection à loogin.php et apparution du message d'erreur */
if (mysqli_num_rows($result) == 1) {
    // données de chaque ligne
    $row = mysqli_fetch_assoc($result);
    
    /*creer les variables de la session de l'influenceur courrant*/
    $_SESSION['email'] = $row['email'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['firstname'] = $row['prenom'];
    $_SESSION['Lastname'] = $row['nom'];
    
    header("Location: influenceur.php");
} else {
    header("Location: loogin.php?error=email et/ou mot de passe incorrect(s)");
}
?>
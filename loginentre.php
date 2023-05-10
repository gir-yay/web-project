<?php 
//commencer la session
session_start(); 
// connecter a la bd
include "database.php";

//recuperer l'email et le mot de passe a travers $_POST
$email =$_POST['email'];
$password =$_POST['password'];

// encrypter le mot de passe

$pw= sha1($password);

/*recuperer les informations de l'entreprise dont l'email est $email et le mot de passe est $pw */
/*les mots de passe sont encrypter dans la bd */

$sql = "SELECT * FROM entreprise WHERE email='$email' AND password='$pw'";
$result = mysqli_query($conn, $sql);

/*si le nbr de ligne recuperé > 0 , donc l email et le mot de passe sont corrects , redirection a influenceur.php*/
/*sino redirection à loogin.php et apparution du message d'erreur */

if (mysqli_num_rows($result) > 0) {
    /*creer les variables de la session de l'entreprise courrante */
    //store the email in the session
    $_SESSION['email'] = $email;
    //add the id of the entreprise to the session
    $row = mysqli_fetch_assoc($result);
    $_SESSION['id'] = $row['id'];
    //redirect to the dashboard page
    header("Location: entreprise.php");
    exit();
} else {
    //redirect to the login page with an error message
    header("Location: loogin.php?error=email et/ou mot de passe incorrect(s)");
    exit();
}

<?php
/* connecter a la base de donnees  data avec include... */
include('database.php');

//si le formulaire est envoyé:
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //check if the form has been submitted
  if(isset($_POST['submit'])){
     //recevoir les données de signup.php section entreprise

      $nom = $_POST['nom'];
      $telephone = $_POST['telephone'];
      $email = $_POST['email'];
      // get the logo name and store it in the Upload folder
      $logo = $_FILES['logo']['name'];
      $tmp_name = $_FILES['logo']['tmp_name'];
      $path = "Upload/".$logo;
      move_uploaded_file($tmp_name,$path);
      $site = $_POST['site'];
      $ca = $_POST['ca'];
      $domaine = $_POST['domaine'];
      $password = $_POST['password'];
      $password2 = $_POST['password-confirm'];
      //verifier si le mot de passe et sa confirmation sont les memes
      if($password == $password2){
         //verifier si l'email n'est jamais utilisé
            /*on cherche les emails = $email */
        $sql = "SELECT * FROM entreprise WHERE email = '$email'";
          $result = mysqli_query($conn,$sql);
          $num = mysqli_num_rows($result);
         //si rien n'est trouvé de similaire

          if($num == 0){
                //on encrypte le mot de passe
                $pw = sha1($password);

       /*on insert les informations de l'influenceur dans la table entreprise*/
         
                $sql = "INSERT INTO entreprise (nom,telephone,email,logo,site,ca,domaine,password) VALUES ('$nom','$telephone','$email','$logo','$site','$ca','$domaine','$pw')";
              $result = mysqli_query($conn,$sql);
                //si les données sont insérées 

              if($result){
                    /*rediriger vers loogin.php*/
                  header("location:loogin.php");
              }
              else{
                 /*sinon rediriger vers signup.php page et envoyer un msg d'erreur à recuperer avec GET*/
                  header("location:signup.php?error=erreur! Ressayer");
              }
          }
          else{
            /*message d'erreur au cas d'un email qui déjà existe */
              header("location:signup.php?error=email existe déjà !");
          }
      }
      else{
         /*message d'erreur au cas ou le mot de passe et sa confirmation ne sont pas les meme*/


          header("location:signup.php?error=les mots de passe ne sont pas identiques !");
      }

    }

}
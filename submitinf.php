<?php
/* connecter a la base de donnees  data avec include... */
include 'database.php';

//si le formulaire est envoyé:
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check if the form has been submitted
    if(isset($_POST['submit'])){
        //recevoir les données de signup.php section influenceur

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $insta = $_POST['insta'];
        $fcbk = $_POST['fcbk'];
        $youtube = $_POST['ytb'];
        $domaine = $_POST['domaine'];
        $abonne = $_POST['follower'];
        $password = $_POST['password'];
        $password2 = $_POST['password-confirm'];
        // get the logo name and store it in the Upload folder
        $logo = $_FILES['logo']['name'];
        $tmp_name = $_FILES['logo']['tmp_name'];
        $path = "Upload/".$logo;
        move_uploaded_file($tmp_name,$path);
        //verifier si le mot de passe et sa confirmation sont les memes
        if($password == $password2){
            //verifier si l'email n'est jamais utilisé
            /*on cherche les emails = $email */
            $sql = "SELECT * FROM influencer WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            //si rien n'est trouvé de similaire
            if($num == 0){
                //on encrypte le mot de passe
                $pw = sha1($password);

                /*on insert les informations de l'influenceur dans la table influenceur*/

                $sql = "INSERT INTO influencer (nom,prenom,age,telephone,email,pfp,insta,fcbk,youtube,domaine,abonne,password) VALUES ('$nom','$prenom','$age','$telephone','$email','$logo','$insta','$fcbk','$youtube','$domaine','$abonne','$pw')";
                $result = mysqli_query($conn,$sql);

                //si les données sont insérées 
                if($result){
                    /*rediriger vers loogin.php*/
                    header("location:loogin.php");
                }
                else{
                    /*sinon rediriger vers signup.php page et envoyer un msg d'erreur à recuperer avec GET*/
                    header("location:signup.php?error=error in the signup process");
                }
            }
            else{
                /*message d'erreur au cas d'un email qui dj existe */
                header("location:signup.php?error=email already used");
            }
        }
        else{
            /*message d'erreur au cas ou le mot de passe et sa confirmation ne sont pas les meme*/

            header("location:signup.php?error=passwords are not the same");
        }
    }else{
        /*probleme dans la procedure du signup */
        header("location:signup.php?error=error in the signup process");
    }
    
}










?>




        
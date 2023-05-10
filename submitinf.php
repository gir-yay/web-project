<?php
/* connecter a la base de donnees  data avec include... */
include 'database.php';

//si le formulaire est envoyé:
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check if the form has been submitted
    //si le formulaire est envoyé:
    if(isset($_POST['submit'])){
        //recevoir les données de signup.php section influenceur
        //stocker nom
        $nom = $_POST['nom'];
        //stocker prenom
        $prenom = $_POST['prenom'];
        //stocker l'age
        $age = $_POST['age'];
        //stocker le tel
        $telephone = $_POST['telephone'];
        //l'email
        $email = $_POST['email'];
        //lien instagram
        $insta = $_POST['insta'];
        //lien facebook
        $fcbk = $_POST['fcbk'];
        //lien de la chaine youtube
        $youtube = $_POST['ytb'];
        //domaine
        $domaine = $_POST['domaine'];
        //stocker le nombre des abonnées
        $abonne = $_POST['follower'];
        //mot de passe
        $password = $_POST['password'];
        //confirmation du mot de passe
        $password2 = $_POST['password-confirm'];
        // get the logo name and store it in the Upload folder
        $logo = $_FILES['logo']['name'];
        $tmp_name = $_FILES['logo']['tmp_name'];
        //l'emplacement du photo est dans le dossier Upload
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
                /*message d'erreur au cas d'un email qui déjà existe */
                header("location:signup.php?error=email existe déjà !");
            }
        }
        else{
            /*message d'erreur au cas ou le mot de passe et sa confirmation ne sont pas les meme*/

            header("location:signup.php?error=les mots de passe ne sont pas identiques !");
        }
    }else{
        /*probleme dans la procedure du signup */
        header("location:signup.php?error=erreur! Ressayer");
    }
    
}










?>




        
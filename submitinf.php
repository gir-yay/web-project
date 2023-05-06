<!-- connect to data base using include -->
<?php
include 'database.php';
//recieve data from the influencer section 
//check if the form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //check if the form has been submitted
    if(isset($_POST['submit'])){
        //get the data from the influenceur section,some of them are optional
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $genre = $_POST['genre'];
        $insta = $_POST['insta'];
        $fcbk = $_POST['fcbk'];
        $youtube = $_POST['ytb'];
        $domaine = $_POST['domaine'];
        $abonne = $_POST['follower'];
        $password = $_POST['password'];
        $password2 = $_POST['password-confirm'];
        //check if the password and the password confirmation are the same
        if($password == $password2){
            //check if the email is already used
            $sql = "SELECT * FROM influencer WHERE email = '$email'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if($num == 0){
                //insert the data into the database
                $pw = sha1($password);
                $sql = "INSERT INTO influencer (nom,prenom,age,telephone,email,genre,insta,fcbk,youtube,domaine,abonne,password) VALUES ('$nom','$prenom','$age','$telephone','$email','$genre','$insta','$fcbk','$youtube','$domaine','$abonne','$pw')";
                $result = mysqli_query($conn,$sql);
                //check if the data has been inserted
                if($result){
                    //redirect to the login page
                    header("location:loogin.php");
                }
                else{
                    //redirect to the signup page and display an error message
                    header("location:signup.php?error=error in the signup process");
                }
            }
            else{
                header("location:signup.php?error=email already used");
            }
        }
        else{
            header("location:signup.php?error=passwords are not the same");
        }
    }else{
        header("location:signup.php?error=error in the signup process");
    }
    
}
?>




        
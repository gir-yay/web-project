<?php
include('database.php');
//recieve data from the influencer section 
//check if the form has been submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //check if the form has been submitted
  if(isset($_POST['submit'])){
      //get the data from the entreprise section 
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
      //check if the password and the password confirmation are the same
      if($password == $password2){
          //check if the email is already used
          $sql = "SELECT * FROM entreprise WHERE email = '$email'";
          $result = mysqli_query($conn,$sql);
          $num = mysqli_num_rows($result);
          if($num == 0){
              //insert the data into the database
              $sql = "INSERT INTO entreprise (nom,telephone,email,logo,site,ca,domaine,password) VALUES ('$nom','$telephone','$email','$logo','$site','$ca','$domaine','$password')";
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
    }
}
?>


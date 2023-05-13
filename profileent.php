<?php
session_start();
include 'database.php';
// l'id de l'utilisateur courant
$id=$_SESSION['id'];
// l'id du profile de l'entreprise 
$profile_id = $_SESSION['id2'];
//recuperer les informations de l'entreprise
$sql = "SELECT * FROM entreprise WHERE id = '$profile_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
// le nom de l'entreprise
$nom = $row['nom'];
//le LOGO de l'entreprise
$logo='Upload/'.$row['logo'];

?>
<!-- create a html to present the information of the entreprise  -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale= ">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <script src="https://kit.fontawesome.com/8b4b4337c0.js" crossorigin="anonymous"></script>
  <title>Profil</title>
</head>

<body>
  <!-- nom , telephone , email ,ca , site , domaine , logo -->
  

  <div class="container">
        
            <div class="profil-card">
                <div class="image">
                    <img src="<?php echo $logo ?>" alt="logo" class="profile-img">
                </div>
            <div class="text-data">
                <span class="name"> <?php echo $row['nom']; ?> </span>
                <span class="domaine"><?php echo $row['domaine']; ?></span>
                <span>  <?php echo $row['telephone']; ?> </span>
                <span  > <?php echo $row['email']; ?> </span>
                <span class="follower" ></i> <?php echo $row['ca']; ?> MAD</span>
            </div>
            <div class="media-buttons">
                     <a href="<?php echo $row['site']; ?> " target="_blank" class="link">
                       <i class="fa-solid fa-globe"></i>
                     </a> 
             </div>  
            <div class="buttons">
                   
                   <!-- button retour à la page précedente  -->
                   <form action="" method="post">
                       <input type="submit" name="retour" value="Retour"  class="button">
                   </form>
                     <!-- button message  -->
                     <form action="" method="post">
                      <input type="submit" name="message" value="Message"  class="button">
                   </form>
                   
                     <!-- a hidden id of the influencer -->
                      <input type="hidden" name="id" value="<?php echo $profile_id; ?>">
            </div>       
    </div>
</body>
</html>
<?php
// if the button message is clicked
if(isset($_POST['message'])) {
    //recuperer l'id de l'entreprise
    $id_entreprise = $_POST['id'];
    //envoyer l'id dans la variable de session
    $_SESSION['id2'] = $profile_id;
    //l'utilisateur est un influenceur
    $_SESSION['type'] = "inf";
    //l'id de l'influenceur
    $_SESSION['id']= $id;
    //rediriger vers message_inf.php
   ?>
  <script type="text/javascript">window.location="message_inf.php";</script>
<?php
exit();
}
// if the button retour is clicked
if(isset($_POST['retour'])) {
  // redirect to the entreprise page
 ?>
    <script type="text/javascript">window.location="influenceur.php";</script>
<?php
  exit();
}
?>
<style>
 
 *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container{
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f4f4f4ff;
    
}
.profil-card{
    display: flex;
    flex-direction: column; /*----*/
    align-items: center;
    max-width: 500px;
    width: 100%;
    background: #fff;
    border-radius: 24px;
    padding:25px ;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);

}

.image{
    position: relative;
    height: 150px;
    width: 150px;
    border-radius: 50%;
    background-color: rgb(86, 20, 114);
    padding: 3px;
    margin-bottom: 10px;
}
.image .profile-img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #fff;
}
.profil-card .text-data{
    display: flex;
    flex-direction: column; /*----*/
    align-items: center;
    color: #333;
}
.text-data .name{
    font-size: 22px;
    font-weight: 600;
    color:#000;
}
.text-data .domaine{
    font-size: 15px;
    font-weight: 500;
}

.profil-card .media-buttons{
    display: flex;
    align-items: center;
    margin-top:15px ;
}
.media-buttons .link{
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size:18px;
    height: 34px;
    width: 34px;
    margin: 0 8px;
    border-radius: 50%;
    background-color:  rgb(86, 20, 114);
    text-decoration: none;
}

.profil-card .buttons{
    display: flex;
    align-items: center;
    margin-top: 25px;
}
.button{
    font-size: 14px;
    font-weight: 400;
    color: #fff;
    border: none;
    border-radius: 24px;
    margin: 0 10px;
    padding: 8px 24px;
    background-color: rgb(86, 20, 114);
    cursor: pointer;
    transition: all 0.3s ease;
}
.button:hover{
    background-color: rgb(44, 11, 58);
}



</style>
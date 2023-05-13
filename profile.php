<?php
session_start();
include 'database.php';
// l'id de l'utilisateur courant
$id=$_SESSION['id'];
// l'id du profile de l'influenceur 
$profile_id = $_SESSION['id2'];
//recuperer les informations de l'influenceur dont l'id est $profile_id
$sql = "SELECT * FROM influencer WHERE id = '$profile_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
// le nom complet de l'influenceur
$nom = $row['nom'].' '.$row['prenom'];
//la photo de profile de l'influenceur
$pfp = $row['pfp'];
//l'emplacement
$pfp = "Upload/".$pfp;
?>
<!-- create a html to present the information of the influenceur  -->
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
  <!-- nom , prenom ,email,age ,telephone,genre,insta, fcbk,youtube,domaine,abonne -->
  

  <div class="container">
        
            <div class="profil-card">
                <div class="image">
                    <img src="<?php echo $pfp; ?>" alt="" class="profile-img">
                </div>
                <div class="text-data">
                    <span class="name"> <?php echo $row['nom']; ?> <?php echo $row['prenom']; ?></span>
                    <span>  <?php echo $row['age']; ?> ans</span>
                    <span class="domaine"> Domaine:<?php echo $row['domaine']; ?></span>
                    <span  > <?php echo $row['email']; ?> </span>
                    <span  > <?php echo $row['telephone']; ?> </span>
                    <span class="follower" ></i> <?php echo $row['abonne']; ?> abonnés</span>
                </div>
                <div class="media-buttons">
                     <a href="<?php echo $row['insta']; ?>" target="_blank" class="link">
                    <i class="fa-brands fa-instagram"></i>
                    </a> 
                     <a href="<?php echo $row['fcbk']; ?>" target="_blank" class="link">
                    <i class="fa-brands fa-facebook"></i>
                    </a> 
                     <a href="<?php echo $row['youtube']; ?>" target="_blank" class="link">
                    <i class="fa-brands fa-youtube"></i>
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
               
        
</div>

  
</body>
</html>
<?php
// if the button message is clicked
if(isset($_POST['message'])) {
  //Recuperer l'ID du message
  $id = $_POST['id'];
  //Envoyer l'identifiant dans la variable de session
  $_SESSION['id2'] = $id;
  $_SESSION['id2'] = $profile_id;
  //ajouter une  variable type pour savoir si l'utilisateur est une entreprise ou un influenceur
  $_SESSION['type'] = "ent";
  //rediriger vers la page des message
 ?>
    <script type="text/javascript">window.location="message_ent.php";</script>
<?php
  exit();
}
// if the button retour is clicked
if(isset($_POST['retour'])) {
  // redirect to the entreprise page
 ?>
    <script type="text/javascript">window.location="entreprise.php";</script>
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
    font-weight: 400;
}

.text-data .follower{
    font-size: 15px;
    font-weight: 500;
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


</style>
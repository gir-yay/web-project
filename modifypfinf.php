<!-- modifier le profile pour l'influenceur -->
<?php
session_start();
include 'database.php';

//verifier que l'influenceur est authentifié
if (!isset($_SESSION['id'])) {
    //s'il n'est pas => direction vers loogin.php using js
    echo "<script>window.location.href='login.php';</script>";
    exit();

}
//id de l'influenceur
$id = $_SESSION['id'];
//recuperer tous les informations de l'influenceur
$sql = "SELECT * FROM influencer WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//stocker le nom , email, age et instagram
$logo = 'Upload/' . $row['pfp'];
?>
<!DOCTYPE html>
<html>
    <head>
    
        <title>Modifier profile influenceur</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="./css/modifypfinf.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <!-- formulaire  -->
    <body>
    <center>

    <div class="box">
        <form action="" method="post" enctype="multipart/form-data">
                <img src="<?php echo $logo; ?>" alt="logo">
                <label for="pfp"><b>Choisir une photo</b></label>
                <input type="file" name="pfp"  id="file" accept="image/*">
                <hr> 
                <label for="lastname"><b>Nom</b></label>
                <!-- valeur par defaut: nom de l'influenceur-->
                <input type="text" placeholder="Entrer votre nom" name="lastname" value="<?php echo $row['nom']; ?>" required>
                <label for="firstname"><b>Prénom</b></label>  
                <!-- valeur par defaut:prenom de l'influenceur-->
                <input type="text" placeholder="Entrer votre prénom" name="firstname" value="<?php echo $row['prenom']; ?>" required>
                <!-- valeur par defaut:email de l'influenceur-->
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Entrer votre email" name="email" value="<?php echo $row['email']; ?>" required>
                <!-- valeur par defaut :telephone -->
                <label for="phone"><b>Téléphone</b></label>
                <input type="text" placeholder="Entrer votre téléphone" name="phone" value="<?php echo $row['telephone']; ?>" required>
                <!-- valeur par defaut:age de l'influenceur-->
                <label for="age"><b>Age</b></label>
                <!-- valeur par defaut: age de l'influenceur -->
                <input type="text" placeholder="Entrer votre age" name="age" value="<?php echo $row['age']; ?>" required>
                <label for="instagram"><b><i class="fa fa-instagram"style="margin:4px" ></i>Instagram</b></label>
                <!-- valeur par defaut: lien du compte instagram de l'influenceur-->
                <input type="text" placeholder= "Ex:https://www.instagram.com" name="instagram" value="<?php echo $row['insta']; ?>">
                <!-- valeur par defaut:lien du compte facebook de l'influenceur-->
                <label for="facebook"><b> <i class="fa fa-facebook-official" style="margin:4px"></i>Facebook </b></label>
                <input type="text" placeholder= " Ex:https://www.facebook.com" name="facebook" value="<?php echo $row['fcbk']; ?>" >
                <!-- valeur par defaut:lien de la chaine youtube de l'influenceur-->
                <label for="youtube"><b><i class="fa fa-youtube-play" style="margin:4px"></i>Youtube</b></label>
                <input type="text" placeholder="Ex:https://www.youtube.com" name="youtube" value="<?php echo $row['youtube']; ?>" >
                <!-- Domaine ,valeur par defaut: domaine de l'influenceur-->
                <br>
                <label for="domaine"><b>Domaine</b></label>
                <select name="domaine" id="domaine" value="<?php echo $row['domaine'];?>" required>
                           <option value="Fashion">Fashion</option>
                           <option value="Sport">Sport</option>
                           <option value="Art">Art</option>
                           <option value="Cuisine">Cuisine</option>
                           <option value="autre">Autre</option>
                </select>
                <BR>
                <br>
                <!-- valeur par defaut:abonne de l'influenceur-->
                <label for="abonne"><b>Abonnés</b></label>
                <select name="follower" id="follower">
                            <option value="30k-60k">30k-60k Abonné</option>
                            <option value="60k-90k">60k-90k Abonné</option>
                            <option value="90k-150k">90k-150k Abonné</option>
                            <option value="+150k">+150k Abonné</option>
                        </select> 
                 <br>
                <button type="submit" class="signupbtn" name="submit" style="float: right; margin:10px 18.2% 0 0;">Enregistrer</button>
                
                <button type="submit" name="cancel" value="cancel" style="float: left;margin:10px 0 0 18.2%;">Annuler</button>
                
                

            
        </form>
    </div>
        </center>
    </body>
</html>

<?php
//si l'influenceur clique sur cancel
if(isset($_POST['cancel'])){
    ?>
        <!-- rediriger vers loogin.php -->
      <script type="text/javascript">window.location="influenceur.php";</script>
<?php
}
// si on clique sur le bouton enregistrer
if(isset($_POST['submit'])){
    //recuperer les valeurs du formulaire
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];
    $youtube = $_POST['youtube'];
    $domaine = $_POST['domaine'];
    // check if the user has chosen a follower range
    if(isset($_POST['follower'])){
        $follower = $_POST['follower'];
    }else{
        $follower = $row['abonne'];
    }
     //recuperer le nom du logo
     $pfp=$_FILES['pfp']['name'];
     //recuperer le chemin du logo
     $target="Upload/".basename($_FILES['pfp']['name']);
     //si on a choisi un logo
     if($pfp){
         //modifier le pfp
            $sql="UPDATE influencer SET pfp='$pfp' WHERE id='$id'";
            $result=mysqli_query($conn,$sql);
            //deplacer le logo vers le dossier Upload
            move_uploaded_file($_FILES['pfp']['tmp_name'],$target);
            // update the other fields
            $sql="UPDATE influencer SET nom='$lastname',prenom='$firstname',email='$email',telephone='$phone',age='$age',insta='$instagram',fcbk='$facebook',youtube='$youtube',domaine='$domaine',abonne='$follower' WHERE id='$id'";
            mysqli_query($conn,$sql);
            //rediriger vers la page d'accueil
            ?>
        <!-- rediriger vers loogin.php -->
      <script type="text/javascript">window.location="influenceur.php";</script>
<?php
     }else{
         // update the other fields
            $sql="UPDATE influencer SET nom='$lastname',prenom='$firstname',email='$email',telephone='$phone',age='$age',insta='$instagram',fcbk='$facebook',youtube='$youtube',domaine='$domaine',abonne='$follower' WHERE id='$id'";
            mysqli_query($conn,$sql);
            //rediriger vers la page d'accueil
?>
<!-- rediriger vers loogin.php -->
      <script type="text/javascript">window.location="influenceur.php";</script>
<?php
     }
    
}  
?>


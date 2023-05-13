<?php 
//page pour modifier le profile de l'entreprise 
session_start();
include 'database.php';
//l'id de l'entreprise
$id=$_SESSION['id'];
//recuperer tout les info de l'entreprise
$sql="SELECT * FROM entreprise WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
//stocker le nom , email, chiffre d'affaire et logo
$name=$row['nom'];
$email=$row['email'];
$ca=$row['ca'];
$logo='Upload/'.$row['logo'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier profile entreprise</title>
    <link rel="stylesheet" href="css\modifypfent.css">
</head>
<body>
      <center>

      <div class="box">
        <form method="post" action="" enctype="multipart/form-data">

      <img src="<?php echo $logo; ?>" alt="logo">
                    <label for="name"><b>Choisir une photo </b></label>
                   <input type="file" name="logo"  id="file" accept="image/*">
             
            <hr>
            <label for="name"><b>Nom</b></label>
                 <!-- valeur par defaut: nom de l'entreprise-->
           
            <input type="text" placeholder="Entrer le nom" name="name" value="<?php echo $name; ?>" required>
<!-- valeur par defaut:email de l'entreprise-->
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Entrer l'email" name="email" value="<?php echo $email; ?>" required>

            <label for="ca"><b>Chiffre d'affaire</b></label>
            <!-- valeur par defaut:chiffre d'affaire de l'entreprise-->
            <input type="text" placeholder="Entrer le chiffre d'affaire en MAD" name="ca" value="<?php echo $ca; ?>" required>
            <!-- valeur par defaut:Numero du telephone de l'entreprise-->
            <label for="tel"><b>Numéro de téléphone</b></label>
            <input type="text" placeholder="Entrer le numéro de téléphone" name="tel" value="<?php echo $row['telephone']; ?>" required>
            <!-- valeur par defaut:Le site web de l'entreprise-->
            <label for="site"><b>Site web</b></label>
            <input type="text" placeholder="Ex:https://www.nomEntreprise.com" name="site" value="<?php echo $row['site']; ?>" required>
            <!-- valeur par defaut:Le domaine de l'entreprise -->
            <label for="domaine"><b>Domaine</b></label>
            <select name="domaine" id="domaine" value="<?php echo $row['domaine']; ?>" required>
                           <option value="Fashion">Fashion</option>
                           <option value="Sport">Sport</option>
                           <option value="Art">Art</option>
                           <option value="Cuisine">Cuisine</option>
                           <option value="autre">Autre</option>
            </select>
            <br>
            
    <!-- Your form fields here -->
                    <button type="submit" class="signupbtn" name="submit" style="float: right; margin:10px 18.2% 0 0;">Enregistrer</button>
                
                    <button type="submit" name="cancel" value="cancel" style="float: left;margin:10px 0 0 18.2%;">Annuler</button>
            
        </form>
    </div>
      </center>
      </body>
</html>
<?php
// si on clique sur le bouton annuler
if(isset($_POST['cancel'])){
    //rediriger vers la page d'accueil
    header('Location: entreprise.php');
}
// si on clique sur le bouton enregistrer
if(isset($_POST['submit'])){
    //recuperer les valeurs du formulaire
    $name=$_POST['name'];
    $email=$_POST['email'];
    $ca=$_POST['ca'];
    $tel=$_POST['tel'];
    $site=$_POST['site'];
    $domaine=$_POST['domaine'];
    //recuperer le nom du logo
    $logo=$_FILES['logo']['name'];
    //recuperer le chemin du logo
    $target="Upload/".basename($_FILES['logo']['name']);
    //si on a choisi un logo
    if($logo){
        //modifier le logo
        $sql="UPDATE entreprise SET logo='$logo' WHERE id='$id'";
        mysqli_query($conn,$sql);
        //deplacer le logo vers le dossier Upload
        move_uploaded_file($_FILES['logo']['tmp_name'],$target);
    }
    //modifier les autres informations
    $sql="UPDATE entreprise SET nom='$name',email='$email',ca='$ca',telephone='$tel',site='$site',domaine='$domaine' WHERE id='$id'";
    mysqli_query($conn,$sql);
    //rediriger vers la page d'accueil
    header('Location: entreprise.php');
}

?>

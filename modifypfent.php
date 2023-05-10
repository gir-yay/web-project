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
<html>
<head>
    <title>Modifier profil entreprise</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/modifypfent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!-- make a forum with all the info as default -->
<body>
    
    <div class="header">
        <img src="<?php echo $logo; ?>" alt="logo" class="logo">
        <h1><?php echo $name; ?></h1>
    </div>
   
    <form action="modifypfent.php" method="post" enctype="multipart/form-data">
    <div class="clearfix">
        <!-- bouton cancel pour revenir à  influencer.php -->
                <button type="submit" class="cancelbtn" name="cancel" >
                  <i class="fa fa-arrow-left"></i></button>
    </div>
        <div class="container">
            <h1>Modifier profil entreprise</h1>
            <p>Remplissez ce formulaire pour modifier votre profil.</p>
            <hr>
            <label for="name"><b>Nom</b></label>
                 <!-- valeur par defaut: nom de l'entreprise-->
           
            <input type="text" placeholder="Entrer le nom" name="name" value="<?php echo $name; ?>" required>
<!-- valeur par defaut:email de l'entreprise-->
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Entrer l'email" name="email" value="<?php echo $email; ?>" required>

            <label for="ca"><b>Chiffre d'affaire</b></label>
            <!-- valeur par defaut:chiffre d'affaire de l'entreprise-->
            <input type="text" placeholder="Entrer le chiffre d'affaire" name="ca" value="<?php echo $ca; ?>" required>
    <!-- make the current logo a placeholder  -->
            <label for="logo"><b>Logo</b></label>
            <input type="file" placeholder="Entrer le logo" name="logo" value="<?php echo $logo; ?>">
            

            <div class="clearfix">
                <button type="submit" class="signupbtn" name="submit">Enregistrer</button>
            </div>
            
            

        </div>
</form>

</body>
</html>
<?php
//si l'influenceur clique sur cancel
if(isset($_POST['cancel'])){
    //direction vers entreprise.php
    header("Location:entreprise.php");
}
//si l'utilisateur clique sur submit
if(isset($_POST['submit'])){
        //recuperer les données du formulaire:

    $name=$_POST['name'];
    $email=$_POST['email'];
    $ca=$_POST['ca'];
    $logo=$_FILES['logo']['name'];
    $tmp_name=$_FILES['logo']['tmp_name'];
    //deplacer le logo vers le dossier upload
    move_uploaded_file($tmp_name, "Upload/$logo");
    //modifier les anciennes informations dans la base de données
    $sql="UPDATE entreprise SET nom='$name',email='$email',ca='$ca',logo='$logo' WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    //retour à entreprise.php
    header("Location:entreprise.php");
}
?>

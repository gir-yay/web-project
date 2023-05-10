<!-- modifier le profile pour l'influenceur -->
<?php
session_start();
include 'database.php';

//verifier que l'influenceur est authentifié
if (!isset($_SESSION['id'])) {
    //s'il n'est pas => direction vers loogin.php
    header('Location: index.php');
    exit;
}
//id de l'influenceur
$id = $_SESSION['id'];
//recuperer tous les informations de l'influenceur
$sql = "SELECT * FROM influencer WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
    <head>
    
        <title>Modifier profile influenceur</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./css/modifypfinf.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <!-- formulaire  -->
    <body>
    <form action="modifypfinf.php" method="post"    enctype="multipart/form-data">
             <!-- bouton cancel pour revenir à  influencer.php -->
        <div class="clearfix">
                    <button type="submit" class="cancelbtn" name="cancel"><i class="fa fa-arrow-left"></i></button>
                </div>
            <div class="container">
                <h1>Modifier profil influenceur</h1>
                <p>Remplissez ce formulaire pour modifier votre profil.</p>
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
                <label for="age"><b>Age</b></label>
                <!-- valeur par defaut: age de l'influenceur -->
                <input type="text" placeholder="Entrer votre age" name="age" value="<?php echo $row['age']; ?>" required>
                <label for="instagram"><b>Instagram</b></label>
                <!-- valeur par defaut: lien du compte instagram de l'influenceur-->
                <input type="text" placeholder="Entrer votre instagram" name="instagram" value="<?php echo $row['insta']; ?>">
                <!-- valeur par defaut:lien du compte facebook de l'influenceur-->
                <label for="facebook"><b>Facebook</b></label>
                <input type="text" placeholder="Entrer votre facebook" name="facebook" value="<?php echo $row['fcbk']; ?>" >
                <!-- valeur par defaut:lien de la chaine youtube de l'influenceur-->
                <label for="youtube"><b>Youtube</b></label>
                <input type="text" placeholder="Entrer votre youtube" name="youtube" value="<?php echo $row['youtube']; ?>" >
                 <label for="logo"><b>Photo de profile</b></label>
            <input type="file" placeholder="Entrer la photo de profile" name="logo" value="<?php echo $logo; ?>">
                <div class="clearfix">
                    <button type="submit" class="signupbtn" name="submit">Modifier</button>
                </div>
                

            </div>
        </form>
    </body>
</html>

<?php
//si l'influenceur clique sur cancel
if (isset($_POST['cancel'])) {
    //redirection vers influenceur.php
    header("Location:influenceur.php");
    exit;
}
//si l'influenceur clique sur submit
if (isset($_POST['submit'])) {
    //recuperer les données du formulaire:
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
     $logo=$_FILES['logo']['name'];
    $tmp_name=$_FILES['logo']['tmp_name'];
    //modifier les anciennes informations dans la base de données
    //deplacer le logo vers le dossier upload
    move_uploaded_file($tmp_name, "Upload/$logo");
    //modifier les anciennes informations dans la base de données
    $sql = "UPDATE influencer SET nom='$lastname',prenom='$firstname',email='$email',age='$age',pdp='$logo' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    //si bien modifiées
    if ($result) {
        //redirection vers influenceur.php
        header('Location: influenceur.php');
        exit;
    } else {
        //sinon:message d'erreur
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>


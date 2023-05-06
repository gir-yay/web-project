<!-- a page soo the influenceeur can modify his profil -->
<?php
session_start();
include 'database.php';

//check if the user is connected
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_SESSION['id'];
//get the data of the user
$sql = "SELECT * FROM influencer WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
    <head>
    
        <title>Modifier profil influenceur</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./css/modifypfinf.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <!-- make a forum with all the info as default -->
    <body>
    <form action="modifypfinf.php" method="post"    enctype="multipart/form-data">
             <!-- add a cancel button to go back to influencer.php -->
        <div class="clearfix">
                    <button type="submit" class="cancelbtn" name="cancel"><i class="fa fa-arrow-left"></i></button>
                </div>
            <div class="container">
                <h1>Modifier profil influenceur</h1>
                <p>Remplissez ce formulaire pour modifier votre profil.</p>
                <hr>
                <label for="lastname"><b>Nom</b></label>
                <input type="text" placeholder="Entrer votre nom" name="lastname" value="<?php echo $row['nom']; ?>" required>
                <label for="firstname"><b>Prénom</b></label>
                <input type="text" placeholder="Entrer votre prénom" name="firstname" value="<?php echo $row['prenom']; ?>" required>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Entrer votre email" name="email" value="<?php echo $row['email']; ?>" required>
                <label for="age"><b>Age</b></label>
                <input type="text" placeholder="Entrer votre age" name="age" value="<?php echo $row['age']; ?>" required>
                <label for="instagram"><b>Instagram</b></label>
                <input type="text" placeholder="Entrer votre instagram" name="instagram" value="<?php echo $row['insta']; ?>">
                <label for="facebook"><b>Facebook</b></label>
                <input type="text" placeholder="Entrer votre facebook" name="facebook" value="<?php echo $row['fcbk']; ?>" >
                <label for="youtube"><b>Youtube</b></label>
                <input type="text" placeholder="Entrer votre youtube" name="youtube" value="<?php echo $row['youtube']; ?>" >
                <div class="clearfix">
                    <button type="submit" class="signupbtn" name="submit">Modifier</button>
                </div>
                

            </div>
        </form>
    </body>
</html>

<?php
//check if the user clicked on the cancel button
if (isset($_POST['cancel'])) {
    header("Location:influenceur.php");
    exit;
}
//check if the user clicked on the submit button
if (isset($_POST['submit'])) {
    //get the data from the form
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    //update the data in the database
    $sql = "UPDATE influencer SET nom='$lastname',prenom='$firstname',email='$email',age='$age' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    //check if the data is updated
    if ($result) {
        header('Location: influencer.php');
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>


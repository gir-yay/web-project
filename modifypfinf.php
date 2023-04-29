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
//get the data of the user
$email = $row['email'];
$lastname = $row['lastname'];
$firstname = $row['firstname'];
$age = $row['age'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifier profil influenceur</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/modifypfinf.css">
    </head>
    <!-- make a forum with all the info as default -->
    <body>
        <div class="header">
            <h1>Modifier profil influenceur</h1>
        </div>
        <form action="modifypfinf.php" method="post" enctype="multipart/form-data">
            <div class="container">
                <h1>Modifier profil influenceur</h1>
                <p>Remplissez ce formulaire pour modifier votre profil.</p>
                <hr>
                <label for="lastname"><b>Nom</b></label>
                <input type="text" placeholder="Entrer le nom" name="lastname" value="<?php echo $lastname; ?>" required>

                <label for="firstname"><b>Prenom</b></label>
                <input type="text" placeholder="Entrer le prenom" name="firstname" value="<?php echo $firstname; ?>" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Entrer l'email" name="email" value="<?php echo $email; ?>" required>

                <label for="age"><b>Age</b></label>
                <input type="text" placeholder="Entrer l'age" name="age" value="<?php echo $age; ?>" required>
                <hr>

                <div class="clearfix">
                    <button type="submit" class="signupbtn" name="submit">Modifier</button>
                </div>
                <!-- add a cancel button to go back to influencer.php -->
                <div class="clearfix">
                    <button type="submit" class="cancelbtn" name="cancel">Annuler</button>
                </div>

            </div>
        </form>
    </body>
</html>
<style>
    body {
        background-image: url('img/background.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
</style>
<?php
//check if the user clicked on the cancel button
if (isset($_POST['cancel'])) {
    header('Location: influencer.php');
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
    $sql = "UPDATE influencer SET lastname='$lastname',firstname='$firstname',email='$email',age='$age' WHERE id='$id'";
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



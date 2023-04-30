<?php 
//a page to modify the profil of a entreprise 
session_start();
include 'database.php';
//get all the data using the id  from th eentreprise table
$id=$_SESSION['id'];
$sql="SELECT * FROM entreprise WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);

$name=$row['Name'];
$email=$row['email'];
$ca=$row['ca'];
$logo='Upload/'.$row['logo'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier profil entreprise</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="modifypfent.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<!-- make a forum with all the info as default -->
<body>
    <!-- show th ename of the entreprise with the logo  -->
    <div class="header">
        <img src="<?php echo $logo; ?>" alt="logo" class="logo">
        <h1><?php echo $name; ?></h1>
    </div>
   
    <form action="modifypfent.php" method="post" enctype="multipart/form-data">
       <!-- add a cancel button to go back to entreprise.php -->
    <div class="clearfix">
                <button type="submit" class="cancelbtn" name="cancel" >
                  <i class="fa fa-arrow-left"></i></button>
    </div>
        <div class="container">
            <h1>Modifier profil entreprise</h1>
            <p>Remplissez ce formulaire pour modifier votre profil.</p>
            <hr>
            <label for="name"><b>Nom</b></label>
            <input type="text" placeholder="Entrer le nom" name="name" value="<?php echo $name; ?>" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Entrer l'email" name="email" value="<?php echo $email; ?>" required>

            <label for="ca"><b>Chiffre d'affaire</b></label>
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
//if the user click on cancel button
if(isset($_POST['cancel'])){
    //go back to entreprise.php
    header("Location:entreprise.php");
}
//if the user click on submit button
//get all the data from the form
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $ca=$_POST['ca'];
    $logo=$_FILES['logo']['name'];
    $tmp_name=$_FILES['logo']['tmp_name'];
    //move the logo to the upload folder
    move_uploaded_file($tmp_name, "Upload/$logo");
    //update the entreprise table with the new data
    $sql="UPDATE entreprise SET Name='$name',email='$email',ca='$ca',logo='$logo' WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    //go back to entreprise.php
    header("Location:entreprise.php");
}
?>

<?php
// start the session
session_start();
// connect to the database
include 'database.php';
$id=$_SESSION['id'];
// get the id of the profile from the session
$profile_id = $_SESSION['id2'];
// get the info from the influencer table
$sql = "SELECT * FROM influencer WHERE id = '$profile_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
// get the name of the influencer
$nom = $row['nom'].' '.$row['prenom'];
?>
<!-- create a html to present the information of the influenceur  -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale= ">
  <title>Profil</title>
</head>

<body>
  <!-- nom , prenom ,email,age ,telephone,genre,insta, fcbk,youtube,domaine,abonne -->
  <h1><?php echo $nom; ?></h1>
  <p>Nom : <?php echo $row['nom']; ?></p>
  <p>Prenom : <?php echo $row['prenom']; ?></p>
  <p>Email : <?php echo $row['email']; ?></p>
  <p>Age : <?php echo $row['age']; ?></p>
  <p>Telephone : <?php echo $row['telephone']; ?></p>
  <p>Genre : <?php echo $row['genre']; ?></p>
  <p>Instagram : <?php echo $row['insta']; ?></p>
  <p>Facebook : <?php echo $row['fcbk']; ?></p>
  <p>Youtube : <?php echo $row['youtube']; ?></p>
  <p>Domaine : <?php echo $row['domaine']; ?></p>
  <p>Nombre d'abonnés : <?php echo $row['abonne']; ?></p>
  <!-- show the button to message and a boton to go back to the entreprise page -->
  <form action="" method="post">
    <input type="submit" name="message" value="Message">
  </form>
  <form action="" method="post">
    <input type="submit" name="retour" value="Retour">
  </form>
  <!-- a logout buotton  -->
  <form action="" method="post">
    <input type="submit" name="logout" value="Logout">
  </form>
  <!-- a hidden id of the influencer -->
  <input type="hidden" name="id" value="<?php echo $profile_id; ?>">
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
// if the button logout is clicked
if(isset($_POST['logout'])) {
  // destroy the session
  session_destroy();
  // redirect to the login page
 ?>
    <script type="text/javascript">window.location="loogin.php";</script>
<?php
  exit();
}
?>
<style>
  /* Add a background color to the body */
body {
  background-color: #f2f2f2;
}

/* Style the header */
h1 {
  font-size: 2em;
  font-weight: bold;
  color: #333;
  text-align: center;
  margin: 0;
  padding: 20px 0;
}

/* Style the form buttons */
input[type=submit] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 12px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 10px;
  cursor: pointer;
  border-radius: 5px;
}

input[type=submit]:hover {
  background-color: #3e8e41;
}

/* Style the form labels */
p {
  font-size: 1.2em;
  color: #333;
  margin: 10px;
  padding: 0;
}

/* Center the form */
form {
  text-align: center;
  margin-top: 50px;
}
/* Style the logout button */
form:last-of-type {
  margin-top: 20px;
}
/* Style the page title */
title {
  font-size: 1.5em;
  font-weight: bold;
  color: #333;
  text-align: center;
  margin: 20px 0;
}
</style>
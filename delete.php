<?php
/*on connecte a la base de données */
include 'database.php';
/*on commence une session */
session_start();
/*on recupere l identificateur et le type */
$id = $_SESSION['id'];
$type = $_SESSION['type'];
/*si l'utulisateur est une entreprise */
if($type==='entreprise'){
  /*on recupere les donnees du tableau entreprise */
    $sql = "select * from entreprise where id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}else{
  /*si l'utulisateur est un influenceur */
  /*on recupere les donnees du tableau influenceur */

    $sql = "select * from influencer where id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>
<?php
/*si l' utilisateur a voulu et a confirmé la suppression de son compte */
if(isset($_POST['delete']) && isset($_POST['confirm'])) {
    // on ajoute la demande de suppression de compte au tableau request
    $sql="INSERT INTO `request`(`user_id`, `type`, `state`) VALUES ('$id','$type','pending')";
    $result = mysqli_query($conn, $sql);
    if(!$result){
      /*si ce n'est pas bien inséré */
      /*on affiche un message d'erreur */
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
    }
  // fin de session de l'utilisateur apres  5 secondes
  echo '<p>Ta demande de suppression de compte est envoyée. Logout après 5 secondes</p>';
  echo '<script>setTimeout(function(){ window.location.href = "logout.php"; }, 5000);</script>';
  exit();
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Supprimer le compte</title>
</head>
<body>
  <h1>Supprimer Le compte</h1>
  <p>êtes vous vraiment sûr de vouloire  supprimer votre compte ? </p>
  <form method="post">
  <label style="margin-top: 10px;"><input type="checkbox" name="confirm" required>Oui, Je suis sûr</label><br>

    <input type="submit" name="delete" value="Supprimer mon compte">
    <!-- selon le type d'utilisateur ( entreprise.php ou the influenceur.php ) -->
    <?php if($type==='entreprise'){ ?>
        <a href="entreprise.php">Retour au profile</a>
    <?php }else{ ?>
        <a href="influenceur.php">Retour au profile</a>
    <?php } ?>
  </form>
</body>
</html>
<style>
  /* Center the contents of the page */
body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  font-family: Arial, sans-serif;
}

/* Style the title and subtitle */
h1 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  text-align: center;
}

p {
  font-size: 1.2rem;
  margin-bottom: 2rem;
  text-align: center;
}

/* Style the form and its components */
form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100%;
  max-width: 500px;
  padding: 2rem;
  background-color: #f5f5f5;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

label {
  font-size: 1.2rem;
  margin-bottom: 1rem;
}

input[type="submit"] {
  font-size: 1.2rem;
  background-color: #ff6666;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 0.8rem 1.5rem;
  margin-top: 2rem;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out;
}

input[type="submit"]:hover {
  background-color: #ff4d4d;
}

a {
  font-size: 1.2rem;
  margin-top: 2rem;
  text-decoration: none;
  color: #333;
  transition: color 0.2s ease-in-out;
}

a:hover {
  color: #ff6666;
}






</style>


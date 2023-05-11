<?php 
// connection avec la base de données
include 'database.php';
//la session commence
session_start();
// verifier les variables de la session
if (isset($_SESSION['username'])) {
    // if the session variable are set 
    $name=$_SESSION['username'];
} else {
    // if the session variable are not set, redirect to admin.php
    header('Location: admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="./css/admindash.css">
    <!-- lien pour pouvoir utiliser les icons de fontawsome en ligne -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<input type="checkbox" id="check">
<label for="check">
    <div id="btn">&#9776;</div>
    <div id="cancel" >&#x2716;</div>
</label>
    
    <!-- nav bar to logout and message -->
    
    <nav>
        <ul>
       <li>
        <a href="logout.php"><i class="fa fa-sign-out"></i> Déconnexion</a></li>
        <li>
        <a href="mess.php"><i class="fa fa-envelope"></i> Messages </a></li>
</ul>
</nav>
    
    <div class="main">
    <h1> 
        Bienvenu <?php echo $name; ?>
    </h1><br>
    <h2>INFLUENCEURS</h2>
<?php
// on recupere les influenceurs de la base de données
$sql = "SELECT * FROM influencer";
$result = mysqli_query($conn, $sql);  
//on affiche les informations sous forme de tableau
echo "<div class='container'>";
echo "<table>";
echo "<tr><th>ID</th><th>Last Name</th><th>First Name</th><th>Email</th><th>Age</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    /*l'id de l'influenceur */
    echo "<td>" . $row['id'] . "</td>";
    /*le nom de l'influenceur */
    echo "<td>".$row['nom']."</td>";
    /*le prenom de l'influenceur */
    echo "<td>".$row['prenom']."</td>";
     /*l'email de l'influenceur */
    echo "<td>".$row['email']."</td>";
    /*l'age de l'influenceur */
    echo "<td>".$row['age']."</td>";
    echo "<td>";

    /*lorsque le bouton est cliqué on peut recuperer l'id de l'influenceur grace à: */
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' class='delete-btn' name='delete_influencer' value='Supprimer'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";

// si le bouton delete_influenceur est cliqué:
if(isset($_POST['delete_influencer'])){
    /*recuperer l'id de l'influenceur */
    $id = $_POST['id'];
    /*on supprime l'influenceur de la base de données */
    $sql = "DELETE FROM influencer WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

                /*si c'est bien supprimeé afficher: */

        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
        /*sinon afficher un message d'erreur  */

        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}

echo "<h2>Entreprises</h2>";
// on recupere les entreprises de la base de données
$sql = "SELECT * FROM entreprise";
$result = mysqli_query($conn, $sql);
//on montre les information sous forme de tableau
echo "<div class='container'>";
echo "<table>";
echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>CA</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
        /*l'id de l'entreprise*/
    echo "<td>" . $row['id'] . "</td>";
         /*le nom de l'entreprise*/
    echo "<td>".$row['nom']."</td>";
    /*l'email de l'entreprise */
    echo "<td>".$row['email']."</td>";
    /*le chiffre d'affaire de l'entreprise */
    echo "<td>".$row['ca']."</td>";
    echo "<td>";
    /*lorsque le bouton est cliqué on peut recuperer l'id de l'influenceur grace à: */
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' class='delete-btn' name='delete_brand' value='Supprimer'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";

// si le bouton delete_brand est cliqué:
if(isset($_POST['delete_brand'])){
    /*recuperer l'id de l'entreprise à supprimer */
    $id = $_POST['id'];
    /*requete pour supprimer l'entreprise dont l'id est $id */
    $sql = "DELETE FROM entreprise WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

      if ($result) {
        /*si c'est bien supprimeé afficher: */
        echo  '<center><p class="done">Supprimé avec succés!</p></center>';
    } else {
        /*sinon afficher un message d'erreur  */
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}

echo "<h2>OFFRE DE COLLABORATION</h2>";
// on recupere les offres de collaboration de la base de données depuis le tableau offer  inner join  le tableau influencer et entreprise sur id_influencer et id_entreprise
$sql = "SELECT offer.*, influencer.nom AS influencer_nom, influencer.prenom AS influencer_prenom, entreprise.nom AS entreprise_nom FROM offer INNER JOIN influencer ON offer.id_influencer = influencer.id INNER JOIN entreprise ON offer.id_entreprise = entreprise.id";


$result = mysqli_query($conn, $sql);
//on montre les information sous forme de tableau Nom entreprise , Nom influenceur ,Conditions,Montant,Durrée,statuts,Reg date ,Action
echo "<table>";
echo "<tr><th>Nom entreprise</th><th>Nom influenceur</th><th>Conditions</th><th>Montant</th><th>Durrée</th><th>Statuts</th><th>Reg date</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    /*le nom de l'entreprise */
    echo "<td>".$row['entreprise_nom']."</td>";
    // /*le nom de l'influenceur et son prenom + nom */
    echo "<td>".$row['influencer_nom'].' '.$row['influencer_prenom']."</td>";
    /*les conditions de l'offre */
    echo "<td>".$row['terms']."</td>";
    /*le montant de l'offre */
    echo "<td>".$row['amount']."</td>";
    /*la durrée de l'offre */
    echo "<td>".$row['duration']."</td>";
    /*le statut de l'offre */
    echo "<td>".$row['state']."</td>";
    /*la date de l'offre */
    echo "<td>".$row['reg_date']."</td>";
    echo "<td>";
    /*lorsque le bouton est cliqué on peut recuperer l'id de l'influenceur grace à: */
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' class='delete-btn' name='delete_offer' value='Supprimer'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
// la meme chose pour le tableau suggestion , mais change la button suprimee pour distinguer les deux tableau 
$sql = "SELECT suggestion.*, suggestion.id AS ide, influencer.nom AS influencer_nom, influencer.prenom AS influencer_prenom, entreprise.nom AS entreprise_nom  FROM suggestion  INNER JOIN influencer ON suggestion.id_influencer = influencer.id  INNER JOIN entreprise ON suggestion.id_entreprise = entreprise.id";

$result = mysqli_query($conn, $sql);
foreach($result as $row){
    echo "<tr>";
    echo "<td>".$row['entreprise_nom']."</td>";
    echo "<td>".$row['influencer_nom'].' '.$row['influencer_prenom']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['reg_date']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['ide']."'>";
    echo "<input type='submit' class='delete-btn' name='delete_suggestion' value='Supprimer'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";
// si le bouton delete_offer est cliqué:
if(isset($_POST['delete_offer'])){
    /*recuperer l'id de l'offre à supprimer */
    $id = $_POST['id'];
    /*requete pour supprimer l'offre dont l'id est $id */
    $sql = "DELETE FROM offer WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

      if ($result) {
        /*si c'est bien supprimeé afficher: */
        echo  '<center><p class="done">Supprimé avec succés!</p></center>';
    } else {
        /*sinon afficher un message d'erreur  */
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}
// si le bouton delete_suggestion est cliqué:
if(isset($_POST['delete_suggestion'])){
    /*recuperer l'id de la suggestion à supprimer */
    $id = $_POST['id'];
    /*requete pour supprimer la suggestion dont l'id est $id */
    $sql = "DELETE FROM suggestion WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

      if ($result) {
        /*si c'est bien supprimeé afficher: */
        echo  '<center><p class="done">Supprimé avec succés!</p></center>';
    } else {
        /*sinon afficher un message d'erreur  */
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}
/*request pour supprimer le compte */
//tableau de requetes: id ,user_id , type ,state, delete button 
echo "<center>";
echo "<h2>Demandes</h2>";
echo "</center>";
/*selectionner tout de la table request */
$sql = "SELECT * FROM request";
$result = mysqli_query($conn, $sql);
echo "<div class='container'>";
echo "<table>";
echo "<th>ID</th><th>ID de l'utilisateur</th><th>Type</th><th>Etat</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    /*l'id */
    echo "<td>" . $row['id'] . "</td>";
    /*l'id de l'entreprise ou l'influenceur */
    echo "<td>".$row['user_id']."</td>";
    /*type: influenceur ou entreprise */
    echo "<td>".$row['type']."</td>";
    /**/
    echo "<td>".$row['state']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' class='delete-btn' name='delete_request' value='Supprimer'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
// si delete_request est cliqué
if(isset($_POST['delete_request'])){
  $id = $_POST['id'];
  //changer 'state' à 'deleted' dans la base de données 
  $sql = "UPDATE request SET state = 'deleted' WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  if($result){
    $sql = "SELECT * FROM request WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
  //selon si l'utilisateur est un influenceur ou marque
    $type = $row['type'];
    $user_id = $row['user_id'];
    if($type == 'influencer'){
      $sql = "DELETE FROM influencer WHERE id = '$user_id'";
      $result = mysqli_query($conn, $sql);
      //supprimer les collaborations de l'influenceur

      $sql = "DELETE FROM offer WHERE id_influencer = '$user_id'";
      $result = mysqli_query($conn, $sql);
      $sql = "DELETE FROM suggestion WHERE id_influencer = '$user_id'";
      $result = mysqli_query($conn, $sql);
        // chenger le satut du request à 'deleted'
        $sql = "UPDATE request SET state = 'deleted' WHERE id = '$id'";
       if ($result) {
        echo  '<center><p class="done">Supprimé avec succés!</p></center>';
    } else {
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
    }else{
      //supprimer le logo
      $sql = "SELECT * FROM entreprise WHERE id = '$user_id'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $logo = $row['logo'];
      unlink($logo);
      //supprimer l'entreprise
      $sql = "DELETE FROM entreprise WHERE id = '$user_id'";
      $result = mysqli_query($conn, $sql);
      //supprimer les collaborations de l'entreprise
      $sql = "DELETE FROM offer WHERE id_entreprise = '$user_id'";
      $result = mysqli_query($conn, $sql);
      $sql = "DELETE FROM suggestion WHERE id_entreprise = '$user_id'";
      $result = mysqli_query($conn, $sql);
        //   chenger le satut du request à 'deleted'
        $sql = "UPDATE request SET state = 'deleted' WHERE id = '$id'";


       if ($result) {
        echo  '<center><p class="done">Supprimé avec succés!</p></center>';
    } else {
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
    }
}
}
echo "</table>";
echo "</div>";
?>
</div>
</body>
</html>
<style>
    /* style pour la button echo "<input type='submit' class='delete-btn' name='delete_request' value='Supprimer'>";
    */
    .delete-btn{
        background-color: #ff0000;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }



</style>

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
  <!--page css -->
  <link rel="stylesheet" href="./css/admindash.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Admin Dashboard</title>
</head>
<body>
    <!-- <input type="checkbox" id="check">
    <label for="check">
        <div id="btn">&#9776;</div>
        <div id="cancel">&#x2716;</div>
    </label>

    <nav><!-- nav bar to logout and message -->
    <!-- <ul>
        <li></li><a href="logout.php">Logout</a></li>
        <li><a href="mess.php">Message</a></li>
    </ul>
    <hr>
    </nav> --> 
    <input type="checkbox" id="check">
<label for="check">
    <div id="btn">&#9776;</div>
    <div id="cancel">&#x2716;</div>
</label>

    <nav>
  <hr>
  <ul>
    <li>
        <a href="mess.php"><i class="fa fa-envelope"></i>Messages</a>
    </li>
            
            <li>
                <!-- Bouton du logout pour detruire la session de l'utilisateur "on click log out" -->
                <a href="logout.php"><i class="fa fa-sign-out"></i>Déconnexion</a>
        </li><br>
        
    
            
        </ul>
  </nav>
    
    
    <h2>INFLUENCERS</h2>
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
    echo "<input type='submit' name='delete_influencer' value='Delete'>";
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
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>CA</th><th>Action</th></tr>";
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
    echo "<input type='submit' name='delete_brand' value='Delete'>";
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
        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
        /*sinon afficher un message d'erreur  */
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}

echo "<h2>OFFRE DE COLLABORATION</h2>";
/*on recupere les colaboration en joignant la table des offres avec la table des influenceurs et la tables des entreprises */
$sql = "SELECT * FROM offer INNER JOIN influencer ON offer.id_influencer = influencer.id INNER JOIN entreprise ON offer.id_entreprise = entreprise.id ";
$result = mysqli_query($conn, $sql);

/*afficher toutes les colaboration entre influenceur et entreprise dans un tableau (offert par l'entreprise) */
/*show the result in a table format brand name , influencer full name(firstname+lastname), terms, status,amount,duration ,reg_date,add a button to delete the the collaboration*/
echo "<div class='container'>";
echo "<table>";
echo "<th>Brand Name</th><th>Influencer Name</th><th>Terms</th><th>Status</th><th>Amount</th><th>Duration</th><th>Reg Date</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    /*nom de l'entreprise */
    echo "<td>" . $row['nom'] . "</td>";
    /*nom complet de l'influenceur */
    echo "<td>".$row['prenom']." ".$row['nom']."</td>";
    /*les termes de la collaboration */
    echo "<td>".$row['terms']."</td>";
    /*etat: accepté ou refusé */
    echo "<td>".$row['state']."</td>";
    /*le prix de la collaboration */
    echo "<td>".$row['amount']."</td>";
    /*duré de la collaboration */
    echo "<td>".$row['duration']."</td>";
    /*date de la collaboration */
    echo "<td>".$row['reg_date']."</td>";
    echo "<td>";

    /*lorsque le bouton est cliqué on peut recuperer l'id de cette collaboration grace à: */

    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_collab' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
// si bouton delete_collab est cliqué
if(isset($_POST['delete_collab'])){
    /*recupere l'id de la collaboration */
    $id = $_POST['id'];
    /*requete de suppression de la collaboration */
    $sql = "DELETE FROM offer WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
      if ($result) {

         /*si c'est bien supprimeé afficher: */
       
        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
                /*sinon afficher un message d'erreur  */

        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}
//make a tabe  to show all the suggested collab from the suggestion table inner join with the influencer table and the entreprise table in id_influencer and id_entreprise

/*affiché toutes les colaboration entre influenceur et entreprise dans un tableau (suggeré par l'influenceur) */

$sql = "SELECT * FROM suggestion INNER JOIN influencer ON suggestion.id_influencer = influencer.id INNER JOIN entreprise ON suggestion.id_entreprise = entreprise.id ";
$result = mysqli_query($conn, $sql);
//show the result in a table format brand name , influencer full name(firstname+lastname), terms, status,amount,duration ,reg_date,add a button to delete the collab
foreach ($result as $row) {
    echo "<tr>";
    /*nom complet de l'influenceur */
    echo "<td>" . $row['prenom'] . " " . $row['nom'] . "</td>";
    /*nom de l'entreprise */
    echo "<td>".$row['nom']."</td>";
    /*termes de la collaboration */
    echo "<td>".$row['terms']."</td>";
    /*etat: accepté ou refusé */
    echo "<td>".$row['state']."</td>";
    /*prix demandé */
    echo "<td>".$row['amount']."</td>";
    /*durée */
    echo "<td>".$row['duration']."</td>";
    /*date de la collaboration */
    echo "<td>".$row['reg_date']."</td>";
    echo "<td>";
        /*lorsque le bouton est cliqué on peut recuperer l'id de cette collaboration grace à: */

    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_suggested_collab' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";
// si  delete_suggested_collab est cliqué
if(isset($_POST['delete_suggested_collab'])){
    /*recuperer l'id de la collaboration */
  $id = $_POST['id'];
  /*requete de suppression */
  $sql = "DELETE FROM suggestion WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
   if ($result) {
            /*si c'est bien supprimeé afficher: */

        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}
/*request pour supprimer le compte */
//tableau de requetes: id ,user_id , type ,state, delete button 
echo "<h2>REQUEST</h2>";
/*selectionner tout de la table request */
$sql = "SELECT * FROM request";
$result = mysqli_query($conn, $sql);
echo "<div class='container'>";
echo "<table>";
echo "<th>ID</th><th>User ID</th><th>Type</th><th>State</th><th>Action</th></tr>";
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
    echo "<input type='submit' name='delete_request' value='Delete'>";
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
       if ($result) {
        echo  '<center><p class="done">Bien Supprimé!</p></center>';
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

       if ($result) {
        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
    }
}
}
echo "</table>";
echo "</div>";
?>
</body>
</html>
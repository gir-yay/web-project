<?php 
// connection avec la base de données
include 'database.php';
//la session commence
session_start();
// verifier les variables de la session
if (isset($_SESSION['username'])) {
    // if the session variable are set 
    $name=$_SESSION['username'];
    echo "<h1>BIENVENUE $name</h1>";
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
  <link rel="stylesheet" href="./css/admindash.css">
  <title>Admin</title>
</head>
<body>

<?php
//barre de navigation
echo "<nav>";
echo "<a href='mess.php'>Message</a>";
echo "<a href='logout.php'>Logout</a>";
echo "</nav>";
// recuperer les données des influenceurs
echo "<h2>INFLUENCEURS</h2>";
$sql = "SELECT * FROM influencer";
$result = mysqli_query($conn, $sql);  

//on montre les information sous forme de tableau
echo "<div class='container'>";
echo "<table>";
echo "<tr><th>ID</th><th>Last Name</th><th>First Name</th><th>Email</th><th>Age</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['nom']."</td>";
    echo "<td>".$row['prenom']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['age']."</td>";
    echo "<td>";
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
    $id = $_POST['id'];
    /*on supprime l'influenceur de la base de données */
    $sql = "DELETE FROM influencer WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}

echo "<h2>Marques</h2>";
$sql = "SELECT * FROM entreprise";
$result = mysqli_query($conn, $sql);
echo "<div class='container'>";
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>CA</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['nom']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['ca']."</td>";
    echo "<td>";
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
    $id = $_POST['id'];
    $sql = "DELETE FROM entreprise WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
      if ($result) {
        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}

echo "<h2>OFFRE DE COLLABORATION</h2>";
/*on recupere les colaboration en joignant la table des offres avec la table des influenceurs et la tables des entreprises */
$sql = "SELECT * FROM offer INNER JOIN influencer ON offer.id_influencer = influencer.id INNER JOIN entreprise ON offer.id_entreprise = entreprise.id ";
$result = mysqli_query($conn, $sql);

/*montrer toutes les colaboration entre influenceur et entreprise dans un tableau */
/*show the result in a table format brand name , influencer full name(firstname+lastname), terms, status,amount,duration ,reg_date,add a button to delete the <collab></collab>*/

echo "<div class='container'>";
echo "<table>";
echo "<th>Brand Name</th><th>Influencer Name</th><th>Terms</th><th>Status</th><th>Amount</th><th>Duration</th><th>Reg Date</th><th>state</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['nom'] . "</td>";
    echo "<td>".$row['prenom']." ".$row['nom']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['reg_date']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "<input type='submit' name='delete_collab' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";

// si bouton delete_collab est cliqué
if(isset($_POST['delete_collab'])){
    $id = $_POST['id'];
    $sql = "DELETE FROM offer WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
      if ($result) {
        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}
//make a tabe  to show all the suggested collab from the suggestion table inner join with the influencer table and the entreprise table in id_influencer and id_entreprise
echo "<h2>SUGGESTED COLLAB</h2>";
$sql = "SELECT * FROM suggestion INNER JOIN influencer ON suggestion.id_influencer = influencer.id INNER JOIN entreprise ON suggestion.id_entreprise = entreprise.id ";
$result = mysqli_query($conn, $sql);
//show the result in a table format brand name , influencer full name(firstname+lastname), terms, status,amount,duration ,reg_date,add a button to delete the collab
echo "<div class='container'>";
echo "<table>";
echo "<th>Influencer Name</th><th>Brand Name</th><th>Terms</th><th>Status</th><th>Amount</th><th>Duration</th><th>Reg Date</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['prenom'] . " " . $row['nom'] . "</td>";
    echo "<td>".$row['nom']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['reg_date']."</td>";
    echo "<td>";
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
  $id = $_POST['id'];
  $sql = "DELETE FROM suggestion WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
   if ($result) {
        echo  '<center><p class="done">Bien Supprimé!</p></center>';
    } else {
        echo '<center><p class="erreur">Erreur: ' . mysqli_error($conn) . '</p></center>';
    }
}
//tableau de requetes: id ,user_id , type ,state, delete button 
echo "<h2>REQUEST</h2>";
$sql = "SELECT * FROM request";
$result = mysqli_query($conn, $sql);
echo "<div class='container'>";
echo "<table>";
echo "<th>ID</th><th>User ID</th><th>Type</th><th>State</th><th>Action</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['user_id']."</td>";
    echo "<td>".$row['type']."</td>";
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
  //selon si l'utilisateur est un influenceur ou marque
  if($result){
    $sql = "SELECT * FROM request WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
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
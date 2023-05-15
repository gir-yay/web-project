<?php   
    include_once 'database.php';
    //session commence
    session_start();
    //verifier si la session est définie
    if(!isset($_SESSION['email'])){
        //si n'est pas defini deriger vers loogin.php
    ?>
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
    exit();
    }else{

        //recuperer l'id de l'entreprise courante
        $id=$_SESSION['id'];

        //recuperer les information de l'entreprise courante
        $sql="SELECT * FROM entreprise WHERE id='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);

        //le nom de l'entreprise
        $name=$row['nom'];
        //l'emplacement du logo de l'entreprise
        $logo='Upload/'.$row['logo'];
        //type=entreprise
        $_SESSION['type']='entreprise';
    }
    $_SESSION['type']='entreprise';
?>
<!-- html page de l'entreprise  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entreprise</title>
    <link rel="stylesheet" href="./css/entreprise.css">
    <!-- lien pour pouvoir utiliser les icons de fontawsome en ligne -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<input type="checkbox" id="check">
<label for="check">
    <div id="btn">&#9776;</div>
    <div id="cancel" >&#x2716;</div>
</label>
    
    <nav>
    
  <div class="profile">
    <!-- Le profil a le nom de l'entreprise le logo et  l'ID -->
     <img src="<?php echo $logo ?>" alt="logo" class="pro-img"><br>
         <center> <p><?php echo $name;?></p></center><br>
</div>
        <ul>
             
            <!-- Bouton du logout pour detruire la session de l'utilisateur "on click log out" -->
            <li>
            <i class="fa fa-sign-out"></i><input type="submit" value="Déconnexion" onclick="window.location.href='logout.php'">
            </li><br>
            <!--  lien pour modifier les infomations de l'entreprise -->

            <li><a href="modifypfent.php"><i class="fa fa-pencil-square-o"></i> Modifier Mon Profil</a>
            </li><br>
            <!-- envoyer une demande a l'admin pour supprimer le compte -->
            <li><a href="delete.php"><i class="fa fa-trash"></i> Supprimer mon compte</a>
            </li><br>
            <!-- lien pour contactez l'admin -->
            <li>
            <a href="message_admin.php"><i class="fa fa-envelope"></i> Contacter l'Admin</a>
            </li><br>
            <!-- lien pour voir les messages recu et tous les conversations -->
            <li>
                <a href="conversations_ent.php"><i class="fa fa-envelope"></i> Messages recus</a>
            </li><br>
                
        </ul>
    </nav>
    <main>
    </main>

<div class="main">
<?php 
//Afficher tous les influenceurs sous forme d'une table  
//Recuperer la bd connection
include_once 'database.php';
//Recuperer l'id de l'entreprise
$id = $_SESSION['id'];
// recuprer les informations de l'entreprise
$sql = "SELECT * FROM entreprise WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//nom de l'entreprise
$name = $row['nom'];
//chiffre d'affaire
$ca = $row['ca'];
//email
$email = $row['email'];
echo "<h1 style='font-size:30px; padding: 16px;'><strong><center>INFLUENCEUR </center></strong></h1>";
//requete pour recuperer tous les influenceurs 
$sql = "SELECT * FROM influencer";
$result = mysqli_query($conn, $sql); 
//afficher les resultats dans un tableau
echo "<table>";
echo "<tr><th>ID</th><th>Nom</th><th>Prenom</th><th>Email</th><th>Age</th><th>Ajouter un offre </th><th>Message</th><th>Profil</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['id'] . "</td>";
    echo "<td>".$row['nom']."</td>";
    echo "<td>".$row['prenom']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['age']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    // ajouter un bouton pour executer un offre pour l'influencer
    echo "<button type='button' class='offer-btn'>Offre</button>";

    echo "<div clas-form' style='display:none;'>";
    // ajouter un formulaire pour executer un offre: Les termes d'un accord entre deux parties, le montant payé par une marque à un influenceur et la durée du contrat.
    echo "<input type='text' class='offer-options' name='terms' placeholder='Conditions'>";
    echo "<input type='text' class='offer-options' name='amount' placeholder='Montant'>";
    echo "<input type='text' class='offer-options' name='duration' placeholder='Durée'>";
    echo "<button type='submit' class='submit-offer' name='submit'>Envoyer</button>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "</div>";
    echo "</form>";
    echo "</td>";
    echo "<td>";
    //Ajouter un bouton pour aller à la page message.php.
    echo "<form method='post'>";
    echo "<button type='submit' class='message-btn' name='message'>Message</button>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "</form>";
    echo "</td>";
    // a button to visit the profile of the influencer
    echo "<td>";
    echo "<form method='post'>";
    echo "<button type='submit' class='profile-btn' name='profile'>Profil</button>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";

}
echo "</table>";
// Vérifier si le bouton d'offre a été cliqué
if(isset($_POST['submit'])) {
    // recuperer les termes de l'offre
    $terms = $_POST['terms'];
    // Recuperer le prix de l'offre
    $amount = $_POST['amount'];
    // Recuperer la durée de l'offre
    $duration = $_POST['duration'];
    // Recuperer l'ID de l'offre
    $id_entreprise = $_SESSION['id'];
    // Recuperer l'ID de l'influenceur
    $id_influencer = $_POST['id'];
    //L'état par défaut est en attente que l'influenceur accepte ou refuse l'offre.
    $state = "waiting";
    //afficher toutes les données
    echo "terms: ".$terms." amount: ".$amount." duration: ".$duration." id_entreprise: ".$id_entreprise." id_influencer: ".$id_influencer." state: ".$state;
    // requete pour ajouter l'offre à la base de données
    $sql = "INSERT INTO offer (terms, amount, duration, id_entreprise, id_influencer, state) VALUES ('$terms', '$amount', '$duration', '$id_entreprise', '$id_influencer', '$state')";
    $result = mysqli_query($conn, $sql);
    // si c'est bien inseré
    if($result) {
        // rediriger vers la page de l'entreprise.
        ?>
      <script type="text/javascript">window.location="entreprise.php";</script>
<?php

    exit();
    } else {
        // Si cela n'a pas réussi, afficher un message d'erreur
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
//si le bouton de message a été cliqué

if(isset($_POST['message'])) {
    //Recuperer l'ID du message
    $id = $_POST['id'];
    //Envoyer l'identifiant dans la variable de session
    $_SESSION['id2'] = $id;
    //ajouter une  variable type pour savoir si l'utilisateur est une entreprise ou un influenceur
    $_SESSION['type'] = "ent";
    //rediriger vers la page des message
   ?>
      <script type="text/javascript">window.location="message_ent.php";</script>
<?php
    exit();
}
//si le bouton de profil a été cliqué
if(isset($_POST['profile'])) {
    //Recuperer l'ID du profil
    $id = $_POST['id'];
    //Envoyer l'identifiant dans la variable de session
    $_SESSION['id2'] = $id; 
    //rediriger vers la page du profil
   ?>
      <script type="text/javascript">window.location="profile.php";</script>
<?php
    exit();
}




// Ajouter du JavaScript pour afficher le formulaire d'offre
echo "<script>
    var offerBtn = document.querySelectorAll('.offer-btn');
    var form = document.querySelectorAll('.form');
    for(var i = 0; i < offerBtn.length; i++) {
        offerBtn[i].addEventListener('click', function() {
            this.nextElementSibling.style.display = 'block';
        });
    }";
echo "</script>";



//Recuperer les suggestion de l'influenceur à l'entreprise courante
echo "<h1><center>SUGGESTIONS DE COLLABORATION</center></h1>";
//Afficher les suggestions de l'influenceur sous forme de tableau et ajouter un bouton pour accepter ou refuser la suggestion lorsque l'état est en attente.
$sql = "SELECT * FROM suggestion WHERE state = 'waiting' AND id_entreprise = '$id'";
$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<tr><th>ID</th><th>Conditions</th><th>Montant</th><th>Dur&eacute;e</th><th>Etat</th><th>Accepter</th><th>Refuser</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<button type='submit' name='accept' class='accept-btn' id='accept'>Accept</button>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "</form>";
    echo "</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<button type='submit' name='refuse' class='refuse-btn' id='refuse'>Refuse</button>";
    echo "<input type='hidden' name='id' value='".$row['id']."'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
// si le bouton d'acceptation a été cliqué
if(isset($_POST['accept'])) {
    // Recuperer l'ID de la suggestion
    $id = $_POST['id'];
    // Changer l'état de la suggestion en "accepté
    $state = "accepted";
    // Envoyer une requête à la base de données pour mettre à jour l'état de la suggestion
    $sql = "UPDATE suggestion SET state = '$state' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    // Vérifier si la requête est réussie
    if($result) {
        // Si réussi, rediriger vers la page de l'entreprise.
       
        ?>
      <script type="text/javascript">window.location="entreprise.php";</script>
<?php
    exit();
    } else {
        // si cela n'a pas réussi, afficher un message d'erreur
        echo "Error: ".$sql."<br>".mysqli_error($conn);
    }
}
// Verifier si le bouton du refus a été cliqué
if(isset($_POST['refuse'])) {
    // Recuperer l'ID de la suggestion
    $id = $_POST['id'];
    // Changer l'état de la suggestion en refusé
    $state = "refused";
    // Envoyer une requête à la base de données pour mettre à jour l'état de la suggestion.
    $sql = "UPDATE suggestion SET state ='$state' WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);
    // Vérifier si la requête a réussi
    if($result) {
        // Si c'est réussit, rediriger vers la page de l'entreprise.
       ?>
      <script type="text/javascript">window.location="entreprise.php";</script>
<?php        
exit();

    } else {
        // si cela n'est pas réussi, afficher un message d'erreur
        echo "Error: ". $sql ."<br>".mysqli_error($conn);
    }
}
//Afficher la suggestion acceptée de l'influenceur sous forme de table en utilisant une jointure interne avec la table d'influenceurs pour obtenir le prénom et le nom de famille de l'influenceur.
$sql = "SELECT * FROM suggestion INNER JOIN influencer ON suggestion.id_influencer = influencer.id WHERE state = 'accepted' AND id_entreprise = '$id'";
$result = mysqli_query($conn, $sql);
echo "<h1>COLLABORATIONS ACTIVES </h1>";
echo "<table>";
echo "<tr><th>ID</th><th>Conditions</th><th>Montant</th><th>Durée</th><th>Etat</th><th>Influenceur</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['id']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['prenom']." ".$row['nom']."</td>";
    echo "</tr>";
}
$sql="SELECT * FROM offer INNER JOIN influencer ON offer.id_influencer= influencer.id where state='accepted' and id_entreprise='$_SESSION[id]'";
$result=mysqli_query($conn,$sql);
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['id']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['prenom']." ".$row['nom']."</td>";
    echo "</tr>";
}
echo "</table>";

// /*Afficher les suggestions refusées de l'influenceur sous forme de table jointe avec la table de l'influenceur pour obtenir le prénom et le nom de famille de l'influenceur.*/
// $sql = "SELECT * FROM suggestion INNER JOIN influencer ON suggestion.id_influencer = influencer.id WHERE state = 'refused' AND id_entreprise = '$id'";
// $result = mysqli_query($conn, $sql);
// echo "<h1> SUGGESTIONS REFUSé&Eacute;ES</h1>";
// echo "<table>";
// echo "<tr><th>ID</th><th>Conditions</th><th>Montant</th><th>Durée</th><th>Etat</th><th>Influenceur</th></tr>";
// foreach ($result as $row) {
//     echo "<tr>";
//     echo "<td>".$row['id']."</td>";
//     echo "<td>".$row['terms']."</td>";
//     echo "<td>".$row['amount']."</td>";
//     echo "<td>".$row['duration']."</td>";
//     echo "<td>".$row['state']."</td>";
//     echo "<td>".$row['prenom']." ".$row['nom']."</td>";
//     echo "</tr>";
// }
// echo "</table>";
?>
</div>
</body>
</html>

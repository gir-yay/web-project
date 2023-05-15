<?php 
    //la session commence
    session_start();
    //verifier si la session est defini
    if(!isset($_SESSION['email'])){
        //sinon rediriger vers loogin.php
       ?>
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
        exit();

}else{
        //if set get the name of the influencer
        /*email de l'influenceur */
        $email=$_SESSION['email'];
        /*nom complet de l'influenceur */
        $name= $_SESSION['firstname'].' ' .$_SESSION['Lastname'];
        /*l'id de l'influenceur */
        $id=$_SESSION['id'];
        /*type de l'utillisateur = inflenceur */
        $_SESSION['type']='influenceur';

    }

    $_SESSION['type']='influenceur';
    //connect to the database
    include 'database.php';
    // get the row of the influenceur from the database
    /*recuperer tout les infos de l'influenceur courant de la base de données */
    $sql = "SELECT * FROM influencer WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    //get the pfp of the influenceur
    $pfp = $row['pfp'];
    //add the path to the pfp from Upload folder
    $pfp = "Upload/".$pfp;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Influenceur </title>
    <link rel="stylesheet" href="./css/influenceur.css">
    <!-- lien pour utiliser les icons de fontawsome en ligne-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<input type="checkbox" id="check">
<label for="check">
    <div id="btn">&#9776;</div>
    <div id="cancel">&#x2716;</div>
</label>

    <nav>
    <!-- add the pfp of the inf -->
    <img src="<?php echo $pfp; ?>" alt="profile picture" class="profile-pic">

        <ul> 
            <li> <?php echo $name; ?></li><br>
            <li><i class="fa fa-envelope"></i>  <?php echo $email; ?> </li><br>
            

        </ul>
  <hr>
  <ul>
             <!--  lien pour modifier les infomations de l'entreprise -->
             <li>
                <a href="modifypfinf.php"><i class="fa fa-pencil-square-o"></i> Modifier Mon Profil</a>
            </li><br>
                <!-- lien pour voir les messages recus -->
            <li>
                <a href="conversations_inf.php"><i class="fa fa-envelope"></i> Messages recus</a>
            </li><br>
            <!-- lien pour contactez l'admin -->
            <li>
            <a href="message_admin.php"><i class="fa fa-envelope"></i> Contacter l'Admin</a>
            </li><br>
            <!-- envoyer une demande de suppression du compte  -->
            <li>
                <a href="delete.php"><i class="fa fa-trash"></i>Supprimer mon compte</a>
            </li><br>
            <li>
                <!-- Bouton du logout pour detruire la session de l'utilisateur "on click log out" -->
                <a href="logout.php"><i class="fa fa-sign-out"></i>Déconnexion</a>
        </li><br>
        
    
            
        </ul>
  </nav>
  <main>
    </main>
<div class="main">
<?php 
include 'database.php';
// afficher tous les entreprises dans un tableau
/*requeste pour recuperer les information de l'entreprise */
$sql = "SELECT * FROM entreprise";
$result = $conn->query($sql);
echo "<h2>Entreprises</h2>";
    // output data of each row
    echo "<table border='1'>
    <tr>
    <th>Nom</th>
    <th>Email</th>
    <th>CA</th>
    <th> Envoyer une suggestion </th>
    <th>Message</th>
    <th>Profil</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        /*nom de l'entreprise */
        echo "<td>" . $row['nom'] . "</td>";
        /*email de l'entreprise */
        echo "<td>" . $row['email'] . "</td>";
        /*chiffre d'affaire de l'entreprise */
        echo "<td>" . $row['ca'] . "</td>";
        echo "<td>";
        echo "<form method='post'>";
        // bouton pour suggerer qqc à une entreprise
        echo "<button type='button' class='suggestion-btn'>suggestion</button>";
        /*invisible  (display:none)*/
        echo "<div class='suggestion-form' style='display:none;'>";
        echo "<input type='text' class='sug-options' name='terms' placeholder='Conditions'>";
        echo "<input type='text'class='sug-options'  name='amount' placeholder='Montant'>";
        echo "<input type='text' class='sug-options' name='duration' placeholder='Durée'><br>";
        echo "<button type='submit' class='submit-sug' name='submit'>Envoyer</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</div>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        //bouton pour envoyer un massage à une entreprise
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Message</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        // bouton pour voir le profil de l'entreprise
        echo "<form method='post'>";
        echo "<button type='submit' class='profile-btn' name='profile'>Profil</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    //check if the submit button is clicked
    if(isset($_POST['submit'])) {
        //recuperer l'id de l'entreprise
        $id_entreprise = $_POST['id'];
        //recupererles termes de la suggestion
        $terms = $_POST['terms'];
        //recuperer le prix
        $amount = $_POST['amount'];
        //recuperer la durée
        $duration = $_POST['duration'];
        //l'id de l'influenceur
        $id_influencer = $id;
        //set the state of the offer to waiting
        $state = "waiting";
        //ajouter ces informations à la bd (tableau: suggestion)
        $sql = "INSERT INTO suggestion (id_entreprise, id_influencer, terms, amount, duration, state) VALUES ('$id_entreprise', '$id_influencer', '$terms', '$amount', '$duration', '$state')";
        $result = $conn->query($sql);
        //si c'est bien inséré
        if($result) {
            //rediriger vers la mm page
           ?>
      <script type="text/javascript">window.location="influenceur.php";</script>
<?php
            exit();
    }else{
        //sinon afficher un message d'erreur
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  //check if the message button is clicked
    if(isset($_POST['message'])) {
        //recuperer l'id de l'entreprise
        $id_entreprise = $_POST['id'];
        //envoyer l'id dans la variable de session
        $_SESSION['id2'] = $id_entreprise;
        //l'utilisateur est un influenceur
        $_SESSION['type'] = "inf";
        //l'id de l'influenceur
        $_SESSION['id']= $id;
        //rediriger vers message_inf.php
       ?>
      <script type="text/javascript">window.location="message_inf.php";</script>
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
      <script type="text/javascript">window.location="profileent.php";</script>
<?php
    exit();
}
    /*faire apparaitre ce qu avait display:none lorsque on clique sur le bouton de suggestion*/
    echo "<script>
    document.querySelectorAll('.suggestion-btn').forEach(item => {
        item.addEventListener('click', event => {
            item.nextElementSibling.style.display = 'block';
        })
    })
    </script>";
    //afficher tous les offres en attente de l'influenceur dans un tableau
    $sql = "SELECT offer.id, offer.terms, offer.amount, offer.duration, offer.state, entreprise.nom FROM offer INNER JOIN entreprise ON offer.id_entreprise = entreprise.id WHERE offer.id_influencer = $id AND offer.state = 'waiting'";
    $result=mysqli_query($conn, $sql);
    // output data of each row
    //ajouter une option pour accepter ou refuser l'offre
    echo "<h2>Offres</h2>";
    echo "<table border='1'>
    <tr>
    <th>Conditions</th>
    <th>Montant</th>
    <th>Durée</th>
    <th>Etat</th>
    <th>Entreprise</th>
    <th>Accepter</th>
    <th>Refuser</th>
    </tr>";
    //check if the result is not empty
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            /*terme de l'offre envoyé a l'influenceur  */
            echo "<td>" . $row['terms'] . "</td>";
            /*prix */
            echo "<td>" . $row['amount'] . "</td>";
            /*durée */
            echo "<td>" . $row['duration'] . "</td>";
            /*etat: waiting */
            echo "<td>" . $row['state'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>";
            echo "<form method='post'>";
            //add a button to accept the offer
            echo "<button type='submit' class='accept-btn' name='accept'>Accepter</button>";
            echo "<input type='hidden' name='id' value='".$row['id']."'>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form method='post'>";
            //add a button to refuse the offer 
            echo "<button type='submit' class='refuse-btn' name='refuse'>Refuser</button>";
            echo "<input type='hidden' name='id' value='".$row['id']."'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    //si le bouton accept est cliqué
    if(isset($_POST['accept'])) {
        //recuperer l'id de l'offre
        $id_offer = $_POST['id'];
        //changer waiting à accepted
        $state = "accepted";
        //modifier state dans la base de données
        $sql = "UPDATE offer SET state='$state' WHERE id=$id_offer";
        $result = mysqli_query($conn, $sql);
        //si c'est bien fait
        if($result) {
            //diriger vers la meme page
           ?>
      <script type="text/javascript">window.location="influenceur.php";</script>
<?php
            exit();
        } else {
            //sinon afficher un message d'erreur
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    //si le bouton refuse est cliqué
    if(isset($_POST['refuse'])) {
        //recuperer l'id de l'offre
        $id_offer = $_POST['id'];
        //changer l'etat à refused
        $state = "refused";

        //modifier state dans la base de données

        $sql = "UPDATE offer SET state='$state' WHERE id=$id_offer";
        $result = mysqli_query($conn, $sql);
        //check if the request is successful
        if($result) {
            //diriger vers la meme page

          ?>
      <script type="text/javascript">window.location="influenceur.php";</script>
<?php            
exit();
        } else {
            //sinon afficher un message d'erreur
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    //afficher les offres acceptés
    echo "<h2> Offres Acceptés </h2>";
    //requete pour afficher tous les offres dont state= accepted de l'influenceur courant
    $sql = "SELECT offer.id, offer.terms, offer.amount, offer.duration, offer.state, entreprise.nom FROM offer INNER JOIN entreprise ON offer.id_entreprise = entreprise.id WHERE offer.id_influencer = $id AND offer.state = 'accepted'";
    $result=mysqli_query($conn, $sql);
    // output data of each row
    echo "<table border='1'>
    <tr>
    <th>Conditions</th>
    <th>Montant</th>
    <th>Durée</th>
    <th>Etat</th>
    <th>Entreprise</th>
    </tr>";
    //check if the result is not empty
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //afficher les resultats dans un tableau
            echo "<tr>";
            echo "<td>" . $row['terms'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['duration'] . "</td>";
            echo "<td>" . $row['state'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
?>
</div>

</body>
</html>





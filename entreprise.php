<!-- creer une page pour une entreprise connectée -->
<?php   
    include 'database.php';
    //get the session
    session_start();
    //verifier si la session est définie
    if(!isset($_SESSION['email'])){
        //if not set redirect to the login page
        header("Location: loogin.php");
        exit();
    }else{
        //get the info from entreprise table
        $id=$_SESSION['id'];
        $sql="SELECT * FROM entreprise WHERE id='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        //get the name of the entreprise
        $name=$row['Name'];
        //get the logo of the entreprise
        $logo='Upload/'.$row['logo'];
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
    <link rel="stylesheet" href="entreprise.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    

<div class="col-div-6">
<div class="profile">
    <!-- Le profil a le nom de l'entreprise le logo et  l'ID -->
    <!-- Le logo de l'entreprise est une image et recuperer le chemin de la bd -->
<img src="<?php echo $logo ?>" alt="logo" class="pro-img">
<p><?php echo $name;?><span>ID:<?php echo $_SESSION['id'] ?></span></p>
</div>
</div>

    <nav>
        <ul>
            <li>&#9776; MENU </li><br><br>
            
            <li><i class="fa fa-home"></i> <input type="button" value="Home"  onclick="window.location.href='Home.php'">
            </li><br>
            
        
            <!-- Bouton du logout pour detruire la session de l'utilisateur "on click log out" -->
            <li>
            <i class="fa fa-sign-out"></i>
                <input type="submit" value="Logout" onclick="window.location.href='logout.php'">
            </li><br>

            <!--  lien pour modifier les infomations de l'entreprise -->

            <li><a href="modifypfent.php"><i class="fa fa-pencil-square-o"></i> Modify Profile</a>
            </li><br>
            <!-- send a request to the admin to delete ur accont  -->
            <li><a href="delete.php"><i class="fa fa-trash"></i> Delete Account</a>
            </li><br>
            <!-- lien pour contactez l'admin -->
            <li>
            <a href="contact.php"><i class="fa fa-envelope"></i> Contact</a>
            </li><br>
            <!-- lien pour voir les messages recu -->
            <li>
                <a href="messagerec.php"><i class="fa fa-envelope"></i> Messages recu</a>
            </li><br>
            

            
        </ul>

    </nav>

   
    <main>
    </main>

</body>

<div class="main">
<<?php 
//Afficher tous les influenceurs sous forme d'une table  
//Recuperer la bd connection
include 'database.php';
//Recuperer l'id de l'entreprise
$id = $_SESSION['id'];
//Recuperer le nom de l'entreprise
$name = $_SESSION['name'];
//Recuperer ca de l'entreprise
$ca = $_SESSION['ca'];
//Recuperer l'email de l'entreprise
$email = $_SESSION['email'];
//Envoyer une demande à la bd pour recuperer tous les influenceurs 
echo "<h1 style='font-size:30px; padding: 16px;'><strong><center>INFLUENCER </center></strong></h1>";
$sql = "SELECT * FROM influencer";
$result = mysqli_query($conn, $sql); 
//
echo "<table>";
echo "<tr><th>ID</th><th>Last Name</th><th>First Name</th><th>Email</th><th>Age</th><th>Make an offer</th><th>Message</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['id'] . "</td>";
    echo "<td>".$row['lastname']."</td>";
    echo "<td>".$row['firstname']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['age']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    // ajouter un bouton pour executer un offre pour l'influencer
    echo "<button type='button' class='offer-btn'>Offer</button>";

    echo "<div clas-form' style='display:none;'>";
    // ajouter une form pour executer un offre: Les termes d'un accord entre deux parties, le montant payé par une marque à un influenceur et la durée du contrat.
    echo "<input type='text' name='terms' placeholder='Terms'>";
    echo "<input type='text' name='amount' placeholder='Amount'>";
    echo "<input type='text' name='duration' placeholder='Duration'>";
    echo "<button type='submit' name='submit'>Submit</button>";
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
    echo "</tr>";
}
echo "</table>";
// Vérifier si le bouton d'offre a été cliqué
if(isset($_POST['submit'])) {
    // get the terms of the offer
    $terms = $_POST['terms'];
    // Recuperer les termes de l'offre
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
    // Envoyer une demande à la base de données pour ajouter l'offre à la base de données
    $sql = "INSERT INTO offer (terms, amount, duration, id_entreprise, id_influencer, state) VALUES ('$terms', '$amount', '$duration', '$id_entreprise', '$id_influencer', '$state')";
    $result = mysqli_query($conn, $sql);
    // Vérifier si la demande a réussi
    if($result) {
        // Si la connexion réussit, rediriger vers la page de l'entreprise.
        header("Location: entreprise.php");
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
    header("Location: message.php");
    exit();
}



// Ajouter du JavaScript pour basculer l'affichage du formulaire d'offre
echo "<script>
    var offerBtn = document.querySelectorAll('.offer-btn');
    var form = document.querySelectorAll('.form');
    for(var i = 0; i < offerBtn.length; i++) {
        offerBtn[i].addEventListener('click', function() {
            this.nextElementSibling.style.display = 'block';
        });
    }";
echo "</script>";



//Recuperer la suggestion de l'influenceur
echo "<h1><center>SUGGESTION</center></h1>";
//Afficher les suggestions de l'influenceur sous forme de tableau et ajouter un bouton pour accepter ou refuser la suggestion lorsque l'état est en attente.
$sql = "SELECT * FROM suggestion WHERE state = 'waiting' AND id_entreprise = '$id'";
$result = mysqli_query($conn, $sql);
echo "<table>";
echo "<tr><th>ID</th><th>Terms</th><th>Amount</th><th>Duration</th><th>State</th><th>Accept</th><th>Refuse</th></tr>";
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
// Verifier si le bouton d'acceptation a été cliqué
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
        header("Location: entreprise.php");
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
        // Si la connexion réussit, rediriger vers la page de l'entreprise.
        header("Location: entreprise.php");
        exit();
    } else {
        // si cela n'est pas réussi, afficher un message d'erreur
        echo "Error: ". $sql ."<br>".mysqli_error($conn);
    }
}
//Afficher la suggestion acceptée de l'influenceur sous forme de table en utilisant une jointure interne avec la table d'influenceurs pour obtenir le prénom et le nom de famille de l'influenceur.
$sql = "SELECT * FROM suggestion INNER JOIN influencer ON suggestion.id_influencer = influencer.id WHERE state = 'accepted' AND id_entreprise = '$id'";
$result = mysqli_query($conn, $sql);
echo "<h1>ACCEPTED SUGGESTION</h1>";
echo "<table>";
echo "<tr><th>ID</th><th>Terms</th><th>Amount</th><th>Duration</th><th>State</th><th>Influencer</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['id']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
    echo "</tr>";
}
echo "</table>";
//Afficher les suggestions refusées de l'influenceur sous forme de table jointe avec la table de l'influenceur pour obtenir le prénom et le nom de famille de l'influenceur.
$sql = "SELECT * FROM suggestion INNER JOIN influencer ON suggestion.id_influencer = influencer.id WHERE state = 'refused' AND id_entreprise = '$id'";
$result = mysqli_query($conn, $sql);
echo "<h1>REFUSED SUGGESTION</h1>";
echo "<table>";
echo "<tr><th>ID</th><th>Terms</th><th>Amount</th><th>Duration</th><th>State</th><th>Influencer</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['terms']."</td>";
    echo "<td>".$row['amount']."</td>";
    echo "<td>".$row['duration']."</td>";
    echo "<td>".$row['state']."</td>";
    echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
</div>

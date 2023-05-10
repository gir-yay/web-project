<?php   
    /*cette page est la liste des conversasions de l'entreprise */
    include_once 'database.php';
    //get the session
    session_start();
    //verifier si la session n'est pas définie
    if(!isset($_SESSION['email'])){
        //rediriger vers loogin.php
    ?>
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
    exit();
    }else{

        //sinon
        
        $id=$_SESSION['id'];

        /*recuperer les informations de l'entreprise courrante  */
        $sql="SELECT * FROM entreprise WHERE id='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        //nom de l'entreprise
        $name=$row['nom'];
    }
   
?>
<!-- html page de l'entreprise  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entreprise</title>

    <!-- page css -->
    <link rel="stylesheet" href="./css/entreprise.css">

        <!-- lien des icons en ligne -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<input type="checkbox" id="check">
<label for="check">
    <div id="btn">&#9776;</div>
    <div id="cancel">&#x2716;</div>
</label>

    <nav>
        <ul>
            <li> MENU </li><br><br>
            
            
        
            <!-- Bouton du logout pour detruire la session de l'utilisateur "on click log out" -->
            <li>
            <i class="fa fa-sign-out"></i>
                <input type="submit" value="Retour" onclick="window.location.href='entreprise.php'">
            </li><br>

            <!--  lien pour modifier les infomations de l'entreprise -->

            <li><a href="modifypfent.php"><i class="fa fa-pencil-square-o"></i> Modifier Mon Profil</a>
            </li><br>
            <!-- send a request to the admin to delete ur accont  -->
            <li><a href="delete.php"><i class="fa fa-trash"></i> Supprimer mon compte</a>
            </li><br>
        </ul>
    </nav>

    <main></main>
    <div class="main">

<?php

//Afficher tous les influenceurs sous forme d'une table  
//connection a la base de donnees
include_once 'database.php';

//Recuperer l'id de l'entreprise
$id = $_SESSION['id'];


/*recuperer tous les messages non lu envoyé a cette entreprise */

$sql = "SELECT * FROM messages join influencer on messages.sender = influencer.id WHERE receiver='$id' and `receiver_type` like 'ent' and read_ =0 group by sender order by time_stamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

/*montrer les infos dans un tableau */
echo "<table>";
echo "<th>From</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['email'] . "</td>";
    echo "<td>".$row['time_stamp']."</td>";
            //add a button to go to the massage.php page
               echo "<td>";
     
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>LIRE</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<h1><center>TOUTES LES CONVERSATIONS</center></h1>";

/*recuperer tous les messages lu ou non lu envoyé a cette entreprise */

    $sql2 = "SELECT * FROM messages join influencer on messages.sender = influencer.id WHERE receiver='$id' and `receiver_type` like 'ent' group by sender order by time_stamp ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

/*montrer les infos dans un tableau */

echo "<table>";
echo "<th>From</th><th>Date</th><th>Action</th>";
foreach ($result2 as $row2) {
    echo "<tr>";
    echo "<td>" .$row2['email'] . "</td>";
    echo "<td>".$row2['time_stamp']."</td>";
            //add a button to go to the massage.php page
               echo "<td>";
     
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Message</button>";
        echo "<input type='hidden' name='id' value='".$row2['id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";


//check if the message button is clicked
    if(isset($_POST['message'])) {
        //Recuperer l'ID du message
    $id = $_POST['id'];
    //Envoyer l'identifiant dans la variable de session
    $_SESSION['id2'] = $id;
    //ajouter une  variable type pour savoir si l'utilisateur est une entreprise ou un influenceur
    $_SESSION['type'] = "ent"; //entreprise
    
    /*message est lu <=> modifier read_ a 1 au lieu de 0 */
    mysqli_query($conn, "UPDATE `messages` set read_ =1 where receiver='$id' and `receiver_type` like 'ent' and read_=0  ");

    //rediriger vers la page des message
       ?>
      <script type="text/javascript">window.location="message_ent.php";</script>
<?php
exit();
    }

?>

</div>

</body>
</html>

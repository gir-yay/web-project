<?php 
    /*cette page est la liste des conversasions de l'influenceur */

    //commencer la session
    session_start();
    //si la session n'est pas defini
    if(!isset($_SESSION['email'])){
        //rediriger vers loogin.php
       ?>
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
        exit();

}else{
        //sinon
        // email de l'influenceur
        $email=$_SESSION['email'];
        //nom complet de l'influenceur
        $name= $_SESSION['firstname'].' ' .$_SESSION['Lastname'];
        // id de l'influenceur
        $id=$_SESSION['id'];
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>influenceur </title>
    <!-- page css -->
    <link rel="stylesheet" href="./css/influenceur.css">
    <!-- icon en ligne -->
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
            <!-- nom complet de l'influenceur courant-->
            <li> <?php echo $name; ?></li><br>
            <!--email de l'influenceur -->

            <li><i class="fa fa-envelope"></i>  <?php echo $email; ?> </li><br>

            <!-- id de l'influenceur  -->

            <br>
  </ul><hr>
  <ul>
             <!--  lien pour modifier les infomations de l'influenceur -->
             <li>
                <a href="modifypfinf.php"><i class="fa fa-pencil-square-o"></i> Modifier mon profil</a>
            </li><br>
            <!-- envoyer une demande de suppression du compte  -->
            <li>
                <a href="delete.php"><i class="fa fa-trash"></i>Supprimer mon compte</a>
            </li><br>
            <li>

            <!--retour a influenceur.php -->

                <a href="influenceur.php"><i class="fa fa-sign-out"></i>Retour</a>
        </li><br>
        
    
            
        </ul>
  </nav>

  <main>

  </main>
      <div class="main">

<?php

//Afficher tous les influenceurs sous forme d'une table  
// connection a la bd
include_once 'database.php';
//Recuperer l'id de l'influenceur
$id = $_SESSION['id'];


/*recuperer tous les messages non lu envoyé a cet influenceur */

$sql = "SELECT * FROM messages join entreprise on messages.sender = entreprise.id WHERE receiver='$id' and `receiver_type` like 'inf' and read_ =0 group by sender order by time_stamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<table border='1'><th>De</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['nom'] . "</td>";
    echo "<td>".$row['time_stamp']."</td>";
            //add a button to go to the massage.php page
                    echo "<td>";

        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Lire</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";


      echo "<h1><center>TOUTES LES CONVERSATIONS</center></h1>";

      /*recuperer tous les messages lu ou  non lu envoyé a cet influenceur */


    $sql2 = "SELECT * FROM messages join entreprise on messages.sender = entreprise.id WHERE receiver='$id' and `receiver_type` like 'inf' group by sender order by time_stamp ";

$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

echo "<table>";
echo "<th>De</th><th>Date</th><th>Action</th>";
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
        //get the id from thr row 
        $id_entreprise = $_POST['id'];

        //send the id in the session variable
        $_SESSION['id2'] = $id_entreprise;

        //add a variable type to know if the user is an entreprise or an influencer
        $_SESSION['type'] = "inf";//influenceur
        
        $_SESSION['id']= $id;

        /*message est lu <=> modifier read_ a 1 au lieu de 0 */

        mysqli_query($conn, "UPDATE `messages` set read_ =1 where receiver='$id' and receiver_type like 'inf' and read_ =0  ");

        //redirect to the message page
       ?>
      <script type="text/javascript">window.location="message_inf.php";</script>
<?php
exit();
    }

?>

</div>
</body>
</html>

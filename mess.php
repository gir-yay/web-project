<?php 
// connection avec la base de données
include 'database.php';
//la session commence
session_start();
// verifier les variables de la session
if (isset($_SESSION['username'])) {
    // if the session variable are set 
    $name=$_SESSION['username'];
    $type='admin';


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
    <title>Admin Messages</title>
    <link rel="stylesheet" href="./css/mess.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    
<?php
/*barre de navigation */

/*retour au tableau de bord de l'admin */
echo '<a href="dashboardadmin.php"><button class="retour-btn"><i class="fa fa-arrow-left"></i></button>';


/*messages non lus des influenceurs */
echo "<h1>Non Encore Lu : Influenceur</h1>";

/*$read_ = 0 <=> non encore lu $user_type est un influenceur */
$sql = "SELECT * FROM admin_messages join influencer on admin_messages.user_id = influencer.id WHERE read_ =0  and user_type like 'influenceur' group by user_id  order by time_stamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

/*tableau*/
echo "<div class='container'>";
echo "<table>";
echo "<th>De</th><th>Date</th><th>Action</th>";
foreach ($result as $row)
 {
    echo "<tr>";
        /*email de l'influenceur*/

    echo "<td>" .$row['email'] . "</td>";
    echo "<td>".$row['time_stamp']."</td>";
    //add a button to go to the massage.php page
    echo "<td>"; 
    echo "<form method='post'>";
    echo "<button type='submit' class='message-btn' name='message'>Read</button>";
    /*id du message */
    echo "<input type='hidden' name='id' value='".$row['message_id']."'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
    echo "</table>";
    echo "</div>";

    echo "<br><br>";

    /*tous les messages envoyes par les influenceurs à l'admin */
    echo "<h1><center>TOUTES LES CONVERSATIONS: Influenceur</center></h1>"; 
$sql = "SELECT * FROM admin_messages join influencer on admin_messages.user_id = influencer.id WHERE user_type='influenceur' group by user_id  order by time_stamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<div class='container'>";
echo "<table>";
echo "<th>De</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    /*email de l'influenceur*/
    echo "<td>" .$row['email'] . "</td>";
    echo "<td>".$row['time_stamp']."</td>";
    //add a button to go to the massage.php page
    echo "<td>"; 
    echo "<form method='post'>";
    echo "<button type='submit' class='message-btn' name='message'>Message</button>";
    /*id du message */
    echo "<input type='hidden' name='id' value='".$row['message_id']."'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

echo "<br><br>";

/*messages non lus des entreprises */

    echo "<h1>Non Encore Lu : Entreprise</h1>";

$sql = "SELECT * FROM admin_messages join entreprise on admin_messages.user_id = entreprise.id WHERE read_ =0 and user_type like 'entreprise' group by user_id  order by time_stamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


echo "<div class='container'>";
echo "<table>";
echo "<th>De</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
        /*nom de l'entreprise */
    echo "<td>" .$row['nom'] . "</td>";
    echo "<td>".$row['time_stamp']."</td>";
            //add a button to go to the massage.php page
               echo "<td>";
     
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Read</button>";
            /*id du message */
        echo "<input type='hidden' name='id' value='".$row['message_id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

echo "<br><br>";

        /*tous les messages envoyes par les entreprises à l'admin */

    echo "<h1><center>TOUTES LES CONVERSATIONS: Entreprise</center></h1>";

$sql = "SELECT * FROM admin_messages join entreprise on admin_messages.user_id = entreprise.id WHERE  user_type like 'entreprise' group by user_id  order by time_stamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


echo "<div class='container'>";
echo "<table>";
echo "<th>De</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    /*nom de l'entreprise */
    echo "<td>" .$row['nom'] . "</td>";
    echo "<td>".$row['time_stamp']."</td>";
            //add a button to go to the massage.php page
               echo "<td>";
     
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Message</button>";
        echo "<input type='hidden' name='id' value='".$row['message_id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

echo "<br><br>";
    

//check if the message button is clicked
    if(isset($_POST['message'])) {
        //Recuperer l'ID du message
    $id = $_POST['id'];
    //Envoyer l'identifiant dans la variable de session
    $_SESSION['id2'] = $id;
    //ajouter une  variable type pour montrer que c'est l admin
    $_SESSION['type'] = $type;
    
    mysqli_query($conn, "UPDATE `admin_messages` set read_ =1 where message_id='$id' and read_ =0  ");

    //rediriger vers la page des message
       ?>
      <script type="text/javascript">window.location="admin_chat.php";</script>
<?php
exit();
    }

?>

</body>
</html>

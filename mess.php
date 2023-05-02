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
    <link rel="stylesheet" href="./css/admindash.css">
</head>
<body>
    
<?php

echo "<nav>";
echo "<a href='dashboardadmin.php'>Return</a>";
echo "</nav>";
echo "<h1>Non Encore Lu : Influenceur</h1>";

$sql = "SELECT * FROM admin_messages join influencer on admin_messages.user_id = influencer.id WHERE read_ =0  and user_type='influenceur' group by user_id  order by timestamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<table>";
echo "<th>From</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['email'] . "</td>";
    echo "<td>".$row['timestamp']."</td>";
            //add a button to go to the massage.php page
               echo "<td>";
     
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Read</button>";
        echo "<input type='hidden' name='id' value='".$row['message_id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><br>";

        echo "<h1><center>ALL CONVERSATIONS: Influenceur</center></h1>";

        
$sql = "SELECT * FROM admin_messages join influencer on admin_messages.user_id = influencer.id WHERE user_type='influenceur' group by user_id  order by timestamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<table>";
echo "<th>From</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['email'] . "</td>";
    echo "<td>".$row['timestamp']."</td>";
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
echo "<br><br>";

    echo "<h1>Non Encore Lu : Entreprise</h1>";

$sql = "SELECT * FROM admin_messages join entreprise on admin_messages.user_id = entreprise.id WHERE read_ =0 and user_type like 'entreprise' group by user_id  order by timestamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<table>";
echo "<th>From</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['Name'] . "</td>";
    echo "<td>".$row['timestamp']."</td>";
            //add a button to go to the massage.php page
               echo "<td>";
     
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Read</button>";
        echo "<input type='hidden' name='id' value='".$row['message_id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
echo "<br><br>";
    
    echo "<h1><center>ALL CONVERSATIONS: Entreprise</center></h1>";

$sql = "SELECT * FROM admin_messages join entreprise on admin_messages.user_id = entreprise.id WHERE  user_type like 'entreprise' group by user_id  order by timestamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<table>";
echo "<th>From</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['Name'] . "</td>";
    echo "<td>".$row['timestamp']."</td>";
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
<?php   
    include_once 'database.php';
    //get the session
    session_start();
    //verifier si la session est définie
    if(!isset($_SESSION['email'])){
        //if not set redirect to the login page
    ?>
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
    exit();
    }else{
        //get the info from entreprise table
        $id=$_SESSION['id'];
        $sql="SELECT * FROM entreprise WHERE id='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        //get the name of the entreprise
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
    <link rel="stylesheet" href="./css/entreprise.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    
    <nav>
        <ul>
            <li>&#9776; MENU </li><br><br>
            
            
        
            <!-- Bouton du logout pour detruire la session de l'utilisateur "on click log out" -->
            <li>
            <i class="fa fa-sign-out"></i>
                <input type="submit" value="Return" onclick="window.location.href='entreprise.php'">
            </li><br>

            <!--  lien pour modifier les infomations de l'entreprise -->

            <li><a href="modifypfent.php"><i class="fa fa-pencil-square-o"></i> Modify Profile</a>
            </li><br>
            <!-- send a request to the admin to delete ur accont  -->
            <li><a href="delete.php"><i class="fa fa-trash"></i> Delete Account</a>
            </li><br>
        </ul>
    </nav>

    <main></main>
    <div class="main">

<?php

//Afficher tous les influenceurs sous forme d'une table  
//Recuperer la bd connection
include_once 'database.php';
//Recuperer l'id de l'entreprise
$id = $_SESSION['id'];

$sql = "SELECT * FROM messages join influencer on messages.sender = influencer.id WHERE receiver='$id' and `receiver_type` like 'ent' and read_ =0 group by sender order by time_stamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<table>";
echo "<th>From</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['email'] . "</td>";
    echo "<td>".$row['time_stamp']."</td>";
            //add a button to go to the massage.php page
               echo "<td>";
     
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Read</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<h1><center>ALL CONVERSATIONS</center></h1>";

    $sql2 = "SELECT * FROM messages join influencer on messages.sender = influencer.id WHERE receiver='$id' and `receiver_type` like 'ent' group by sender order by time_stamp ";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

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
    $_SESSION['type'] = "ent";
    
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
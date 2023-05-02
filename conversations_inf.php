<?php 
    //get the session
    session_start();
    //check if the session is set
    if(!isset($_SESSION['email'])){
        //if not set redirect to the login page
       ?>
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
        exit();

}else{
        //if set get the name of the entreprise
        $email=$_SESSION['email'];
        $name= $_SESSION['firstname'].' ' .$_SESSION['Lastname'];
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
    <link rel="stylesheet" href="./css/influenceur.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <nav>
    <span class="icon">
        <i class="fa fa-user"></i> 
          </span><hr>
        <ul> 
            <li> <?php echo $name; ?></li><br>
            <li><i class="fa fa-envelope"></i>  <?php echo $email; ?> </li><br>
            <li>ID: <?php echo $id; ?> </li>
            <br>
  </ul><hr>
  <ul>
             <!--  lien pour modifier les infomations de l'entreprise -->
             <li>
                <a href="modifypfinf.php"><i class="fa fa-pencil-square-o"></i> Modify Profile</a>
            </li><br>
            <!-- envoyer une demande de suppression du compte  -->
            <li>
                <a href="delete.php"><i class="fa fa-trash"></i>Supprimer mon compte</a>
            </li><br>
            <li>
                <a href="influenceur.php"><i class="fa fa-sign-out"></i>Return</a>
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
//Recuperer l'id de l'influenceur
$id = $_SESSION['id'];

$sql = "SELECT * FROM messages join entreprise on messages.sender = entreprise.id WHERE receiver='$id' and `type` like 'ent'and read_ =0 group by sender order by timestamp ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<table border='1'><th>From</th><th>Date</th><th>Action</th>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .$row['Name'] . "</td>";
    echo "<td>".$row['timestamp']."</td>";
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

    $sql2 = "SELECT * FROM messages join entreprise on messages.sender = entreprise.id WHERE receiver='$id' and `type` like 'ent' group by sender order by timestamp ";

$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

echo "<table>";
echo "<th>From</th><th>Date</th><th>Action</th>";
foreach ($result2 as $row2) {
    echo "<tr>";
    echo "<td>" .$row2['email'] . "</td>";
    echo "<td>".$row2['timestamp']."</td>";
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
        //send the i d in the session variable
        $_SESSION['id2'] = $id_entreprise;
        //add a variable type to know if the user is an entreprise or an influencer
        $_SESSION['type'] = "inf";
        $_SESSION['id']= $id;
        mysqli_query($conn, "UPDATE `messages` set read_ =1 where receiver='$id' and `type` like 'ent'and read_ =0  ");

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
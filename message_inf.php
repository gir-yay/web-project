<?php
// commencer la session
session_start();

/*if session is not set */
if (!isset($_SESSION['id'])) {
?>
    <!-- rediriger vers loogin.php -->
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
}

// Connecter a la base de donnees

include_once 'database.php';

// id de l'expediteur
$sender = $_SESSION['id'];
//influenceur
$type = $_SESSION['type'];

/*entreprise */
$receiver_type="ent";

//id du distinataire
$receiver = $_SESSION['id2'];

if ($type == 'inf') {

    /*recuperer les informations de l'influenceur */
    $sql = "SELECT * FROM influencer WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    /*le nom complet de l'influenceur */
    $senderName = $row['nom'] . " " . $row['prenom'];

    /*recuperer les infos de l'entreprise a qui on envoie les messages */
    $sql = "SELECT * FROM entreprise WHERE id = '$receiver'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    /*le nom de l'entreprise */
    $receiverName = $row['nom'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages</title>
    <link rel="stylesheet" href="./css/message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
     <?php
                /*recuperer tous les informations echange par l'influenceur courrant et l'entreprise  */
                $sql = "SELECT * FROM messages WHERE (sender = '$sender' AND receiver = '$receiver') OR (sender = '$receiver' AND receiver = '$sender') ORDER BY time_stamp ASC";
                $result = mysqli_query($conn, $sql); ?>
    
    <section class="wrapper">
        <header>
            <!-- icon de retour -->
            <a href="conversations_inf.php" class="back-icon" ><i class="fas fa-arrow-left" style="font-size:1.5rem;"></i></a>
            
            <!-- Nom de l'entreprise destinataire-->
            <span style="font-size:1.5rem;"><?php echo $receiverName ?></span>
                
            </header>

        <div class="chat-area">
            <!-- Messages will be displayed here -->
           <?php
                echo '<div class="chat-box">';

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        /*contenu du message */
                        $message = $row['message'];
                        /*date de l'envoi */
                        $timestamp = $row['time_stamp'];
                        //if the sender is the current user
                        if($row['sender'] == $sender && $row['receiver_type'] == "ent"){
                            //display the message in the right side of the conversation div
                             echo '<div class="chat outgoing">';
                            echo '<div class="details"><pre>'.$message.'<br>'.$timestamp.'</pre></div>';
                            echo '</div>';

                        }else{
                            //display the message in the left side of the conversation div
                             echo '<div class="chat incoming">';
                             echo '<div class="details"><pre>'.$message.'<br>'.$timestamp.'</pre></div>';
                            echo '</div>';
                           
                        }
                    }
                }
                    echo '</div>';

                ?>
        </div>
                <!--  zone d'ecriture -->
            <form class="typing-area" method="post" action="">
                <textarea name="message" placeholder="Taper votre message ici..."></textarea>
                <!-- bouton d'envoi-->
                <button type="submit" name="send"><i class="fa-sharp fa-solid fa-paper-plane fa-lg" ></i></button>
            </form>
    </section>
</body>
</html>


<?php
//if the send button is clicked
if(isset($_POST['send'])){
    //contenu du message
    $message = $_POST['message'];
    //date de l'envoi
    $date = date('Y-m-d H:i:s');
    // non encore lu
    $read = 0;

    //insert the message into the message table
    $sql = "INSERT INTO messages (`sender`, `receiver`, `message`, `receiver_type`, `time_stamp`, `read_`) VALUES ('$sender', '$receiver', '$message', '$receiver_type','$date', '$read')";
    $result = mysqli_query($conn, $sql);
    //if the message is inserted
    if($result){
       
       /*redireger vers la mm page */ 
?>
      <script type="text/javascript">window.location="message_inf.php";</script>
<?php

}else{
        //display an error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>


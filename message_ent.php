<?php
// commencer la session
session_start();
// if the session is not set
if (!isset($_SESSION['id'])) {
?>
<!-- rediriger vers loogin.php -->
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
}
// Connecter à la database de données

include_once 'database.php';


//id de l'expediteur
$sender = $_SESSION['id'];

//ent => entreprise
$type = $_SESSION['type'];

// influenceur
$receiver_type="inf";
//the receiver id
$receiver = $_SESSION['id2'];


if ($type == 'ent') {
    /*recuperer les information de l'entreprise */
    $sql = "SELECT * FROM entreprise WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    /*le nom de l'entreprise qui a envoyé le message */
    $senderName = $row['nom'];

    /*recperer les infos de l'influenceur a qui l'entreprise veut envoyer le message */

    $sql = "SELECT * FROM influencer WHERE id = '$receiver'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    //le nom complet de l'influenceur
    $receiverName = $row['nom']." ".$row['prenom'];
} 

?>


<!DOCTYPE html>
<html>
<head>
    <title>Message Exchange</title>
    <link rel="stylesheet" href="./css/message.css">
    <!-- lien des icons online-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
     <?php
            /*recuperer tous les messages entre $sender et $receiver*/
                $sql = "SELECT * FROM messages WHERE (sender = '$sender' AND receiver = '$receiver') OR (sender = '$receiver' AND receiver = '$sender') ORDER BY time_stamp ASC";
                $result = mysqli_query($conn, $sql); ?>
    
    <section class="wrapper">
        <header>
            <!-- icon de retour -->
            <a href="conversations_ent.php" class="back-icon"><i class="fas fa-arrow-left" style="font-size:1.5rem;"></i></a>
                
            <!-- nom du destinataire -->
            <span style="font-size:1.5rem;"><?php echo $receiverName ?></span>
                
            </header>

        <div class="chat-area">
            <!-- Messages will be displayed here -->
           <?php
                echo '<div class="chat-box">';

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $message = $row['message'];
                        $timestamp = $row['time_stamp'];
                        //if the sender is the current user
                        if($row['sender'] == $sender && $row['receiver_type'] != 'ent'){
                            //display the message in the right side of the conversation div
                             echo '<div class="chat outgoing">';
                            echo '<div class="details"><pre>'.$message.'<br>'.$timestamp.'</pre></div>';
                            echo '</div>';

                        }else {
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
            <!-- zone d'ecriture des messages -->
        <form class="typing-area" method="post" action="">
                <textarea name="message" placeholder="Taper votre message ici..."></textarea>
                <!-- bouton d'envoi-->
                <button type="submit" name="send"><i class="fa-sharp fa-solid fa-paper-plane fa-lg" ></i></button>
            </form>
    </section>

</body>
</html>

<?php
//si le bouton 'send' est cliqué
if(isset($_POST['send'])){
    //contenu du message
    $message = $_POST['message'];
    //date de l'envoi
    $date = date('Y-m-d H:i:s');
    $read=0;
    //insert the message into the message table
      $sql = "INSERT INTO messages (`sender`, `receiver`, `message`, `receiver_type`, `time_stamp`, `read_`) VALUES ('$sender', '$receiver', '$message', '$receiver_type','$date', '$read')";
    $result = mysqli_query($conn, $sql);
    //if the message is inserted
    if($result){
        
?>
      <script type="text/javascript">window.location="message_ent.php";</script>
<?php

}else{
        //display an error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

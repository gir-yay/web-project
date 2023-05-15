<?php
/*le chat box de l'admin */
// Connect to the database
include_once 'database.php';

session_start();

//si l'utilisateur n'est pas authentifié
if(!isset($_SESSION['username'])){
    //retour à admin.php
    header('Location: admin.php');
    exit();
}
/*variable definis dans la page mess.php */
// retenir l id du message recu (page: mess.php)
$msg_id = $_SESSION['id2'];
// admin
$type = $_SESSION['type'];

// retenir les informations de ce message
$sql_ = "SELECT * FROM admin_messages WHERE message_id='$msg_id' ";
$result_ = mysqli_query($conn, $sql_);
$row_ = mysqli_fetch_assoc($result_);

//message recu par:
$receiver= $row_['user_id'];
// entreprise ou influenceur?
$receiver_type= $row_['user_type'];

// cas d'entreprise
if($receiver_type == "entreprise"){

//retenir les informations de cette entreprise
$sql_ = "SELECT * FROM entreprise  WHERE id = '$receiver' ";
$result_ = mysqli_query($conn, $sql_);
$row_ = mysqli_fetch_assoc($result_);
$receiverName = $row_['nom'];

}else if($receiver_type == "influenceur"){
// cas d'influenceur
//retenir les informations de cet influenceur
$sql_ = "SELECT * FROM influencer  WHERE id = '$receiver' ";
$result_ = mysqli_query($conn, $sql_);
$row_ = mysqli_fetch_assoc($result_);
// email de l'influenceur
$receiverName = $row_['email'];

}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Message Admin</title>
    <!-- lien css -->
    <link rel="stylesheet" href="./css/message.css">
    <!--lien des icons online -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
     
            
    
    <section class="wrapper">
        <header>
            <!-- icon de retour -->
            <a href="<?php echo "mess.php" ?>" class="back-icon"><i class="fas fa-arrow-left" style="font-size:1.5rem;"></i></a>
            <!-- nom du destinataire ou email-->
            <span style="font-size:1.5rem;"><?php echo $receiverName ?></span>  
        </header>

        <div class="chat-area">
            <!-- create a conversation where the receiver is the admin -->
            <?php
                echo '<div class="chat-box">';
                /*recuperer les messages addressé à $receiver */
                 $sql = "SELECT * FROM admin_messages WHERE (user_type = '$receiver_type') AND user_id = '$receiver' ORDER BY time_stamp ASC";
            $result = mysqli_query($conn, $sql);


                while ($row = mysqli_fetch_assoc($result)) {
                    /*(msg envoyé par une entreprise ou un influenceur) */
                    if ($row['sender_type'] === 'entreprise' || $row['sender_type'] === 'influenceur') {
                        echo '<div class="chat incoming">
                                <div class="details">
                                    <pre>' . $row['message_text'] . '</pre>
                                </div>
                            </div>';
                    } else {
                        /* (msg envoyé par l'admin) */
                        echo '<div class="chat outgoing">
                                <div class="details">
                                    <pre>' . $row['message_text'] . '</pre>
                                </div>
                            </div>';
                    }
                }
        
          
                 
            ?>   
        </div>
        <!-- zone d'ecriture des messages -->
        <form class="typing-area" method="post" action="">
            <input type="text" name="message" placeholder="Taper votre message ici...">
            <button type="submit" name="send"><i class="fa-sharp fa-solid fa-paper-plane fa-lg" ></i></button>
        </form>
            </section>
</body>
</html>
<?php
//si on clique sur le bouton "send":
if (isset($_POST['send'])) {
    //le contenu du message
    $message = $_POST['message'];
    // date de l'envoi
    $date = date('Y-m-d H:i:s');
    // lu ou non
    $read=1;


    //si le message est non vide
    if (!empty($message)) {

        //insert the message in the admin_messages table
        
        $sql = "INSERT INTO admin_messages (`user_id`,`user_type`,`sender_type`,`message_text` , `time_stamp` , `read_`) VALUES ('$receiver','$receiver_type','$type','$message' ,'$date', '$read')";
        $result = mysqli_query($conn, $sql);
        //if the message is inserted
        if ($result) {
            //refresh the page
            header("Refresh:0");
        }
    }
}
?>

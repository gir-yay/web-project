<?php
// commencer la session
session_start();
//si l'utilisateur n'est pas authentifie 
if(!isset($_SESSION['id'])){
    //retour a loogin.php
    header('Location: loogin.php');
    exit();
}
// Connecter avec la base de données
include_once 'database.php';
//retenir l id de l'expediteur
$sender = $_SESSION['id'];
/*enreprise ou influenceur */
$type = $_SESSION['type'];


/*s'il s'agit d'une entrepise on prend les infos necessaires du tableau entreprise (dans la base de données) */
if ($type === 'entreprise') {
    $sql = "SELECT * FROM entreprise WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    //get the information of the sender
    $row = mysqli_fetch_assoc($result);
    $senderName = $row['nom'];
    $receiverName="admin";
    $return='entreprise.php';


    
} else {
/*s'il s'agit d'un influenceur on prend les infos necessaires du tableau influencer(dans la base de données) */

    $sql = "SELECT * FROM influencer WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    //get the information of the sender
    $row = mysqli_fetch_assoc($result);
    $senderName = $row['email'];
    $receiverName="admin";
    $return='influenceur.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Message Exchange</title>
    <link rel="stylesheet" href="./css/message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
     
            
    
    <section class="wrapper">
        <header>
            <!-- icon de retour -->
            <!-- si $type=entreprise => $return=entreprise.php sinon $return=influenceur.php -->
            <a href="<?php echo "$return" ?>" class="back-icon"><i class="fas fa-arrow-left" style="font-size:1.5rem;"></i></a>

            <!-- nom ou email  du destinataire -->    
            <span style="font-size:1.5rem;"><?php echo $receiverName ?></span>  
            </header>

        <div class="chat-area">
            <!-- create a conversation where the receiver is the admin -->
            <?php
                echo '<div class="chat-box">';
            /*l admin est le destinataire */
            $receiver = 'admin';
            
            /*recuperer tous les messages de admin_messages ou notre utilisateur courant est l'expediteur */

            $sql = "SELECT * FROM admin_messages WHERE (sender_type = 'entreprise' OR sender_type = 'influenceur' OR sender_type='admin') AND user_id = '$sender' AND user_type = '$type' ORDER BY time_stamp ASC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    /*entreprise ou l'influenceur qui envoient les messages */
                    if ($row['sender_type'] === 'entreprise') {
                        echo '<div class="chat outgoing">
                                <div class="details">
                                    <pre>' . $row['message_text'] . '</pre>
                                </div>
                            </div>';
                    } else if($row['sender_type'] === 'influenceur') {
                        echo '<div class="chat outgoing">
                                <div class="details">
                                    <pre>' . $row['message_text'] . '</pre>
                                </div>
                            </div>';
                    }else{
                    /*l'admin recoit */

                    echo '<div class="chat incoming">
                            <div class="details">
                                <pre>' . $row['message_text'] . '</pre>
                            </div>
                        </div>';
                    }
                }
            }else{
                /*si aucun message n'est envoyé a l'utilisateur courrant par l'admin*/
                /*ce message va apparaitre */
                echo '<div class="chat incoming">
                        <div class="details">
                            <p>Contacter un membre de notre equipe pour vous aider</p>
                        </div>
                    </div>';
            }
           
            ?>   
        </div>
            <!-- zone d'ecriture du message -->
        <form class="typing-area" method="post" action="">
                <textarea name="message" placeholder="Taper votre message ici..."></textarea>
                <!-- bouton d'envoi-->
                <button type="submit" name="send"><i class="fa-sharp fa-solid fa-paper-plane fa-lg" ></i></button>
            </form>
    </section>
</body>
</html>
<?php
//bouton send est cliqué
if (isset($_POST['send'])) {
    //contenu du messages
    $message = $_POST['message'];
    // date de l'envoi
    $date = date('Y-m-d H:i:s');
    // pas encore lu
    $read=0;


    //si le message est non vide
    if (!empty($message)) {
        //insert the message in the admin_messages table
        $sql = "INSERT INTO admin_messages (`user_id`,`user_type`,`sender_type`,`message_text` , `time_stamp` , `read_`) VALUES ('$sender','$type','$type','$message' ,'$date', '$read')";
        $result = mysqli_query($conn, $sql);
        //if the message is inserted
        if ($result) {
            //refresh the page
            header("Refresh:0");
        }
    }
}
?>

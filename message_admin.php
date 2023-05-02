<?php
// Start the session
session_start();
//if the user is not logged in
if(!isset($_SESSION['id'])){
    //go to the login page
    header('Location: loogin.php');
    exit();
}
// Connect to the database
include_once 'database.php';
//get the id of the sender
$sender = $_SESSION['id'];
$type = $_SESSION['type'];


//if the type is ent then check in the entreprise table if not check in the influenceur table
if ($type === 'entreprise') {
    $sql = "SELECT * FROM entreprise WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    //get the name of the sender
    $row = mysqli_fetch_assoc($result);
    $senderName = $row['Name'];
    $receiverName="admin";
    $return='entreprise.php';


    
} else {
    $sql = "SELECT * FROM influencer WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    //get the name of the sender
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
            <a href="<?php echo "$return" ?>" class="back-icon"><i class="fas fa-arrow-left" style="font-size:1.5rem;"></i></a>
                
                    <span style="font-size:1.5rem;"><?php echo $receiverName ?></span>  
            </header>

        <div class="chat-area">
            <!-- create a conversation where the receiver is the admin -->
            <?php
                echo '<div class="chat-box">';

            // get the id of the users and the type of the user
            $receiver = 'admin';
            //$sender = $_SESSION['id'];
            //$type = $_SESSION['type'];
            // the table of the admin_messages is CREATE TABLE messages (message_id INT PRIMARY KEY AUTO_INCREMENT,user_id INT NOT NULL,user_type VARCHAR(255) NOT NULL,sender_type VARCHAR(255) NOT NULL,message_text TEXT NOT NULL,timestamp DATETIME NOT NULL);

            //select all the messages where the sender_type is entreprise or influencer in the admin_messages table on the right side
            $sql = "SELECT * FROM admin_messages WHERE (sender_type = 'entreprise' OR sender_type = 'influenceur') AND user_id = '$sender' AND user_type = '$type' ORDER BY timestamp ASC";
            $result = mysqli_query($conn, $sql);
            //if there are results,determine the sender and display the message
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['sender_type'] === 'entreprise') {
                        echo '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['message_text'] . '</p>
                                </div>
                            </div>';
                    } else {
                        echo '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['message_text'] . '</p>
                                </div>
                            </div>';
                    }
                }
            }else{
                // no messages sent yet , send a message 
                echo '<div class="chat incoming">
                        <div class="details">
                            <p> Contact a member of our team to help you</p>
                        </div>
                    </div>';
            }
            // select all the message where the sender is the admin on the left side
            $sql = "SELECT * FROM admin_messages WHERE sender_type = 'admin' AND user_id = '$sender' AND user_type = '$type' ORDER BY message_id DESC";
            $result = mysqli_query($conn, $sql);
            //if there are results,display the message in th eleft 
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="chat incoming">
                            <div class="details">
                                <p>' . $row['message_text'] . '</p>
                            </div>
                        </div>';
                }
            }else{
                // no messages sent yet , send a message 
                // echo '<div class="chat incoming">
                //         <div class="details">
                //             <p>Hi, how can we help you?</p>
                //         </div>
                //     </div>';
            }
            ?>   
        </div>

        <form class="typing-area" method="post" action="">
            <input type="text" name="message" placeholder="Type your message here...">
            <button type="submit" name="send"><i class="fa-sharp fa-solid fa-paper-plane fa-lg" ></i></button>
        </form>
            </section>
</body>
</html>
<?php
//if the send button is clicked
if (isset($_POST['send'])) {
    //get the message
    $message = $_POST['message'];

    $date = date('Y-m-d H:i:s');
    $read=0;


    //if the message is not empty
    if (!empty($message)) {
        //insert the message in the admin_messages table
        $sql = "INSERT INTO admin_messages (`user_id`,`user_type`,`sender_type`,`message_text` , `timestamp` , `read_`) VALUES ('$sender','$type','$type','$message' ,'$date', '$read')";
        $result = mysqli_query($conn, $sql);
        //if the message is inserted
        if ($result) {
            //refresh the page
            header("Refresh:0");
        }
    }
}
?>

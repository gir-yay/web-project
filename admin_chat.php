<?php
// Start the session
include_once 'database.php';

session_start();
//if the user is not logged in
if(!isset($_SESSION['username'])){
    //go to the login page
    header('Location: admin.php');
    exit();
}

// Connect to the database

$msg_id = $_SESSION['id2'];
$type = $_SESSION['type'];


$sql_ = "SELECT * FROM admin_messages WHERE message_id='$msg_id' ";
$result_ = mysqli_query($conn, $sql_);
$row_ = mysqli_fetch_assoc($result_);

$receiver= $row_['user_id'];
$receiver_type= $row_['user_type'];

if($receiver_type == "entreprise"){

$sql_ = "SELECT * FROM entreprise  WHERE id = '$receiver' ";
$result_ = mysqli_query($conn, $sql_);
$row_ = mysqli_fetch_assoc($result_);
$receiverName = $row_['Name'];

}else if($receiver_type == "influenceur"){
$sql_ = "SELECT * FROM influencer  WHERE id = '$receiver' ";
$result_ = mysqli_query($conn, $sql_);
$row_ = mysqli_fetch_assoc($result_);
$receiverName = $row_['email'];

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
            <a href="<?php echo "mess.php" ?>" class="back-icon"><i class="fas fa-arrow-left" style="font-size:1.5rem;"></i></a>
                
                    <span style="font-size:1.5rem;"><?php echo $receiverName ?></span>  
            </header>

        <div class="chat-area">
            <!-- create a conversation where the receiver is the admin -->
            <?php
                echo '<div class="chat-box">';
                 $sql = "SELECT * FROM admin_messages WHERE (user_type = '$receiver_type') AND user_id = '$receiver' ORDER BY timestamp ASC";
            $result = mysqli_query($conn, $sql);


                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['sender_type'] === 'entreprise' || $row['sender_type'] === 'influenceur') {
                        echo '<div class="chat incoming">
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
    $read=1;


    //if the message is not empty
    if (!empty($message)) {
        //insert the message in the admin_messages table
        $sql = "INSERT INTO admin_messages (`user_id`,`user_type`,`sender_type`,`message_text` , `timestamp` , `read_`) VALUES ('$receiver','$receiver_type','$type','$message' ,'$date', '$read')";
        $result = mysqli_query($conn, $sql);
        //if the message is inserted
        if ($result) {
            //refresh the page
            header("Refresh:0");
        }
    }
}
?>

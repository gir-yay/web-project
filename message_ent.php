<?php
// Start the session
session_start();
if (!isset($_SESSION['id'])) {
?>
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
}
// Connect to the database

include_once 'database.php';
$sender = $_SESSION['id'];
//check the type 
$type = $_SESSION['type'];
//the receiver id
$receiver = $_SESSION['id2'];
//if the type is ent then check in the entreprise table if not check in the influenceur table
if ($type == 'ent') {
    $sql = "SELECT * FROM entreprise WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    //get the name of the sender
    $row = mysqli_fetch_assoc($result);
    $senderName = $row['nom'];
    //get the id of the receiver from influenceur table
    $sql = "SELECT * FROM influencer WHERE id = '$receiver'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    //get the name of the receiver
    $receiverName = $row['nom']." ".$row['prenom'];
} else {
    $sql = "SELECT * FROM influencer WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    //get the name of the sender
    $row = mysqli_fetch_assoc($result);
    $senderName = $row['nom']." ".$row['prenom'];
    //get the id of the receiver from entreprise table
    $sql = "SELECT * FROM entreprise WHERE id = '$receiver'";
    $result = mysqli_query($conn, $sql);
    //get the name of the receiver
    $row = mysqli_fetch_assoc($result);
    $receiverName = $row['nom'];
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
     <?php
            //get the messages from the database
            //show all the messages between the sender and the receiver in the conversation div
                $sql = "SELECT * FROM messages WHERE (sender = '$sender' AND receiver = '$receiver') OR (sender = '$receiver' AND receiver = '$sender') ORDER BY time_stamp ASC";
                $result = mysqli_query($conn, $sql); ?>
    
    <section class="wrapper">
        <header>
            <a href="conversations_ent.php" class="back-icon"><i class="fas fa-arrow-left" style="font-size:1.5rem;"></i></a>
                
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
                            echo '<div class="details"><p>'.$message.'<br>'.$timestamp.'</p></div>';
                            echo '</div>';

                        }else {
                            //display the message in the left side of the conversation div
                             echo '<div class="chat incoming">';
                             echo '<div class="details"><p>'.$message.'<br>'.$timestamp.'</p></div>';
                            echo '</div>';
                           
                        }
                    }
                }
                                            echo '</div>';

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
/*
echo "<br>the sender id is ".$sender."<br>";
echo "the receiver id is ".$receiver."<br>";
echo "the type is ".$type."<br>";
echo "the sender name is ".$senderName."<br>";
echo "the receiver name is ".$receiverName."<br>";
*/
?>

<?php
//if the send button is clicked
if(isset($_POST['send'])){
    //get the message
    $message = $_POST['message'];
    //get the current date and time
    $date = date('Y-m-d H:i:s');
    $read=0;
    //insert the message into the message table
      $sql = "INSERT INTO messages (`sender`, `receiver`, `message`, `receiver_type`, `time_stamp`, `read_`) VALUES ('$sender', '$receiver', '$message', '$type','$date', '$read')";
    $result = mysqli_query($conn, $sql);
    //if the message is inserted
    if($result){
        //refresh the page
        
?>
      <script type="text/javascript">window.location="message_ent.php";</script>
<?php

}else{
        //display an error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

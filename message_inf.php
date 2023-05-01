<?php
//add a home button
echo '<a href="influenceur.php">Return</a>';
//add a logout button
echo '<a href="logout.php">Logout</a>';
// Start the session
session_start();
if (!isset($_SESSION['id'])) {
?>
      <script type="text/javascript">window.location="loogin.php";</script>
<?php
}
// Connect to the database

include'database.php';
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
    $senderName = $row['Name'];
    //get the id of the receiver from influenceur table
    $sql = "SELECT * FROM influencer WHERE id = '$receiver'";
    $result = mysqli_query($conn, $sql);
    //get the full name of the receiver (lastname + firstname)
    $row = mysqli_fetch_assoc($result);
    $receiverName = $row['lastname'] . " " . $row['firstname'];
} else {
    $sql = "SELECT * FROM influencer WHERE id = '$sender'";
    $result = mysqli_query($conn, $sql);
    //get the name of the sender
    $row = mysqli_fetch_assoc($result);
    $senderName = $row['lastname'] . " " . $row['firstname'];
    //get the id of the receiver from entreprise table
    $sql = "SELECT * FROM entreprise WHERE id = '$receiver'";
    $result = mysqli_query($conn, $sql);
    //get the name of the receiver
    $row = mysqli_fetch_assoc($result);
    $receiverName = $row['Name'];
}
?>





<!DOCTYPE html>
<html>
<head>
    <title>Message Exchange</title>
    <link rel="stylesheet" href="./css/message.css">

</head>
<body>
    <div class="container">
        <div class="conversation">
            <!-- Messages will be displayed here -->
            <?php
            //get the messages from the database
            //show all the messages between the sender and the receiver in the conversation div
                $sql = "SELECT * FROM messages WHERE (sender = '$sender' AND receiver = '$receiver') OR (sender = '$receiver' AND receiver = '$sender') ORDER BY timestamp ASC";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $message = $row['message'];
                        $timestamp = $row['timestamp'];
                        //if the sender is the current user
                        if($row['sender'] == $sender){
                            //display the message in the right side of the conversation div
                            echo '<div class="message-box" style="text-align: right;">';
                            echo '<div class="sender">'.$senderName.'</div>';
                            echo '<div class="timestamp">'.$timestamp.'</div>';
                            echo '<div class="content">'.$message.'</div>';
                            echo '</div>';
                        }else{
                            //display the message in the left side of the conversation div
                            echo '<div class="message-box" style="text-align: left;">';
                            echo '<div class="sender">'.$receiverName.'</div>';
                            echo '<div class="timestamp">'.$timestamp.'</div>';
                            echo '<div class="content">'.$message.'</div>';
                            echo '</div>';
                        }
                    }
                }
                ?>
        </div>

        <form class="message-form" method="post" action="">
            <textarea name="message" placeholder="Type your message here"></textarea>
            <button type="submit" name="send">Send</button>
        </form>
    </div>
</body>
</html>
<?php 
echo "<br>the sender id is ".$sender."<br>";
echo "the receiver id is ".$receiver."<br>";
echo "the type is ".$type."<br>";
echo "the sender name is ".$senderName."<br>";
echo "the receiver name is ".$receiverName."<br>";
?>
<?php
//if the send button is clicked
if(isset($_POST['send'])){
    //get the message
    $message = $_POST['message'];
    //get the current date and time
    $date = date('Y-m-d H:i:s');
    //insert the message into the message table
    $sql = "INSERT INTO messages (sender, receiver, message, type,timestamp) VALUES ('$sender', '$receiver', '$message', '$type','$date')";
    $result = mysqli_query($conn, $sql);
    //if the message is inserted
    if($result){
        //refresh the page
?>
      <script type="text/javascript">window.location="message_inf.php";</script>
<?php

      }else{
        //display an error message
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<?php 
    //get the session
    session_start();
    //check if the session is set
    if(!isset($_SESSION['email'])){
        //if not set redirect to the login page
        header("Location: login.php");
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
             <li><a href="modifypfinf.php"><i class="fa fa-pencil-square-o"></i> Modify Profile</a>
            </li><br>
            <!-- envoyer une demande de suppression du compte  -->
            <li><a href="delete.php"><i class="fa fa-trash"></i>Supprimer mon compte</a>
            </li><br>
            <!-- lien pour contactez l'admin -->
            <li>
            <a href="contact.php"><i class="fa fa-envelope"></i> Contact</a>
            </li><br>
            <!-- lien pour voir les messages recus -->
            <li>
                <a href="messagerec.php"><i class="fa fa-envelope"></i> Messages recu</a>
            </li><br>
            <br>
    
            
        </ul>
  </nav>
  <main>
    </main>
</body>
</html>
<div class="main">
<?php 
include 'database.php';
// show all the entreprise as a table

$sql = "SELECT * FROM entreprise";
$result = $conn->query($sql);
echo "<h2>Entreprises</h2>";
    // output data of each row
    echo "<table border='1'>
    <tr>
    <th>id</th>
    <th>name</th>
    <th>email</th>
    <th>ca</th>
    <th>Make a suggestion </th>
    <th>Message</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['ca'] . "</td>";
        echo "<td>";
        echo "<form method='post'>";
        // add a button to make an suggestion to the influencer
        echo "<button type='button' class='suggestion-btn'>suggestion</button>";
        echo "<div class='suggestion-form' style='display:none;'>";
        echo "<input type='text' class='sug-options' name='terms' placeholder='Terms'>";
        echo "<input type='text'class='sug-options'  name='amount' placeholder='Amount'>";
        echo "<input type='text' class='sug-options' name='duration' placeholder='Duration'><br>";
        echo "<button type='submit' class='submit-sug' name='submit'>Submit</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</div>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        //add a button to go to the massage.php page
        echo "<form method='post'>";
        echo "<button type='submit' class='message-btn' name='message'>Message</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    //check if the submit button is clicked
    if(isset($_POST['submit'])) {
        //get the id of the entreprise
        $id_entreprise = $_POST['id'];
        //get the terms of the offer
        $terms = $_POST['terms'];
        //get the amount of the offer
        $amount = $_POST['amount'];
        //get the duration of the offer
        $duration = $_POST['duration'];
        //get the id of the influencer
        $id_influencer = $id;
        //set the state of the offer to waiting
        $state = "waiting";
        //add the suggestion to the database
        $sql = "INSERT INTO suggestion (id_entreprise, id_influencer, terms, amount, duration, state) VALUES ('$id_entreprise', '$id_influencer', '$terms', '$amount', '$duration', '$state')";
        $result = $conn->query($sql);
        //check if the result is true
        if($result) {
            //if true redirect to the same page
            header("Location: influenceur.php");
            exit();
    }else{
        //if false show an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  //check if the message button is clicked
    if(isset($_POST['message'])) {
        //get the id from thr row 
        $id_entreprise = $_POST['id'];
        //send the i d in the session variable
        $_SESSION['id2'] = $id_entreprise;
        //add a variable type to know if the user is an entreprise or an influencer
        $_SESSION['type'] = "inf";
        $_SESSION['id']= $id;
        //redirect to the message page
        header("Location: message.php");
        exit();
    }

    echo "<script>
    document.querySelectorAll('.suggestion-btn').forEach(item => {
        item.addEventListener('click', event => {
            item.nextElementSibling.style.display = 'block';
        })
    })
    </script>";
    //show all the offers as a table
    $sql = "SELECT offer.id, offer.terms, offer.amount, offer.duration, offer.state, entreprise.name FROM offer INNER JOIN entreprise ON offer.id_entreprise = entreprise.id WHERE offer.id_influencer = $id AND offer.state = 'waiting'";
    $result=mysqli_query($conn, $sql);
    // output data of each row
    //add the option to accept or refuse the offer
    echo "<h2>Offers</h2>";
    echo "<table border='1'>
    <tr>
    <th>id</th>
    <th>terms</th>
    <th>amount</th>
    <th>duration</th>
    <th>state</th>
    <th>entreprise</th>
    <th>Accept</th>
    <th>Refuse</th>
    </tr>";
    //check if the result is not empty
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['terms'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['duration'] . "</td>";
            echo "<td>" . $row['state'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>";
            echo "<form method='post'>";
            //add a button to accept the offer
            echo "<button type='submit' class='accept-btn' name='accept'>Accept</button>";
            echo "<input type='hidden' name='id' value='".$row['id']."'>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form method='post'>";
            //add a button to refuse the offer WITH Adiffernt name
            echo "<button type='submit' class='refuse-btn' name='refuse'>Refuse</button>";
            echo "<input type='hidden' name='id' value='".$row['id']."'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
    //check if the accept button is clicked
    if(isset($_POST['accept'])) {
        //get the id of the offer
        $id_offer = $_POST['id'];
        //change the state of the offer to accepted
        $state = "accepted";
        //send a request to the database to update the state of the offer
        $sql = "UPDATE offer SET state='$state' WHERE id=$id_offer";
        $result = mysqli_query($conn, $sql);
        //check if the request is successful
        if($result) {
            //if successful redirect to the influencer page
            header("Location: influenceur.php");
            exit();
        } else {
            //if not successful show an error message
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    //check if the refuse button is clicked
    if(isset($_POST['refuse'])) {
        //get the id of the offer
        $id_offer = $_POST['id'];
        //change the state of the offer to refused
        $state = "refused";
        //send a request to the database to update the state of the offer
        $sql = "UPDATE offer SET state='$state' WHERE id=$id_offer";
        $result = mysqli_query($conn, $sql);
        //check if the request is successful
        if($result) {
            //if successful redirect to the influencer page
            header("Location: influenceur.php");
            exit();
        } else {
            //if not successful show an error message
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    //show accepted offers
    echo "<h2>Accepted offers</h2>";
    //get all the accepted offers for the influencer
    $sql = "SELECT offer.id, offer.terms, offer.amount, offer.duration, offer.state, entreprise.name FROM offer INNER JOIN entreprise ON offer.id_entreprise = entreprise.id WHERE offer.id_influencer = $id AND offer.state = 'accepted'";
    $result=mysqli_query($conn, $sql);
    // output data of each row
    echo "<table border='1'>
    <tr>
    <th>id</th>
    <th>terms</th>
    <th>amount</th>
    <th>duration</th>
    <th>state</th>
    <th>entreprise</th>
    </tr>";
    //check if the result is not empty
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['terms'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['duration'] . "</td>";
            echo "<td>" . $row['state'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
?>
</div>


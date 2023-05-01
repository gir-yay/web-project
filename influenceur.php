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
    $_SESSION['type'] = "influencer";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>influenceur </title>
</head>
<body>
    <h1>influenceur</h1>
    <h2> <?php echo $name; ?> </h2>
    <h2> <?php echo $email; ?> </h2>
    <h2> <?php echo $id; ?> </h2>
    <!-- A Buton to logout -->
    <nav>
        <ul>
            <li>&#9776; MENU </li><br><br>
            
            <li><i class="fa fa-home"></i> <input type="button" value="Home"  onclick="window.location.href='Home.php'">
            </li><br>
            
        
            <!-- Bouton du logout pour detruire la session de l'utilisateur "on click log out" -->
            <li>
            <i class="fa fa-sign-out"></i>
                <input type="submit" value="Logout" onclick="window.location.href='logout.php'">
            </li><br>

            <!--  lien pour modifier les infomations de l'entreprise -->

            <li><a href="modifypfinf.php"><i class="fa fa-pencil-square-o"></i> Modify Profile</a>
            </li><br>
            <!-- send a request to the admin to delete ur accont  -->
            <li><a href="delete.php"><i class="fa fa-trash"></i> Delete Account</a>
            </li><br>
            <!-- lien pour contactez l'admin -->
            <li>
            <a href="contact.php"><i class="fa fa-envelope"></i> Contact</a>
            </li><br>
            <!-- lien pour voir les messages recu -->
            <li>
                <a href="messagerec.php"><i class="fa fa-envelope"></i> Messages recu</a>
            </li><br>
            

            
        </ul>

    </nav>

    
</body>
</html>
<div class="main">
<?php 
include 'database.php';
// show all the entreprise as a table

$sql = "SELECT * FROM entreprise";
$result = $conn->query($sql);
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
        echo "<input type='text' name='terms' placeholder='Terms'>";
        echo "<input type='text' name='amount' placeholder='Amount'>";
        echo "<input type='text' name='duration' placeholder='Duration'>";
        echo "<button type='submit' name='submit'>Submit</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</div>";
        echo "</form>";
        echo "</td>";
        echo "<td>";
        //add a button to go to the massage.php page
        echo "<form method='post'>";
        echo "<button type='submit' name='message'>Message</button>";
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
            echo "<button type='submit' name='accept'>Accept</button>";
            echo "<input type='hidden' name='id' value='".$row['id']."'>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form method='post'>";
            //add a button to refuse the offer WITH Adiffernt name
            echo "<button type='submit' name='refuse'>Refuse</button>";
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
</body>
</html>
</div>
<style>
 /*ajouter une background image (filgrane du logo du site web)*/
body{
    background-image: url("bacg.png");
    background-size: cover;
    
}
/*styler la barre de navigation*/
nav{
    height: 100%;/*une hauteur de 100%*/
    width: 300px;/*une largeur de 300px*/
    position: fixed;/*ne position fixe sur la page*/
    z-index: 1;/**/
    top: 0;/**/
    left: 0;/**/
    background-color: #33033e; /*couleur de fond : violet foncé */
    overflow: hidden;/**/
    transition: 0.5s;/**/
    padding-top: 30px;/**/
    
}
/*styler le lien*/
nav li a{
    color: white;
    text-decoration: none;
    font-family: Arial, Helvetica, sans-serif;
}
/*style de la liste lors du survol */
nav li:hover *{
    color: #f1f1f1;
    background-color:#531d61 ;
}

input{
    color: #f1f1f1;
    background-color:#33033e ;
    border: none;
    font-size: 19px;
    font-family: Arial, Helvetica, sans-serif;
}

main {
    padding: 70px; 
}
.main {

    transition: margin-left .5s;
    padding: 16px;
    margin-left: 300px;

}
/*styler les titres du main*/
.main h1 {
    transition: left .5s;
    padding: 16px;
    margin-left: 30px;
    font-size: 30px;
    text-align: center;
}
/*styler les textes des li*/
li{
    color: #f1f1f1;
    font-size: 19px;
}
/*enlever les puces de la listes*/
ul{
    list-style-type: none;
}
/*la mise en forme des tableaux*/
table {
    border-collapse: collapse; /*bordures effacées*/ 
    width: 100%; /*la largeur est fixée à 100%*/
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);/*bordure de 1px solide de couleur grise*/
    border-collapse: separate;/**/
    border-color: #787475;/*bordure de couleur grise*/
    border-radius: 5px;/*une bordure arrondie de 5px*/
    margin-top: 20px;
}
  /*styler le tableau*/
  td, th {
    border: 1px solid #c2bbbb;
    border-radius: 5px;
    padding: 10px;
    text-align: center;
    
  }
  /*styler les lignes impaires et paires du tableau*/
  tr:nth-child(odd) {
    background: linear-gradient(to right, #b573b7, #787475);
  }
  tr:nth-child(even) {
    background: linear-gradient(to right, #bebcbe, #a283a2);
  }
  /*style des lignes lors du survol */
  tr:hover {
    background: linear-gradient(to right, #a579ae, #eabbe7);
    color: #110d0d;
    animation: highlight 0.3s ease-in-out;
  }
  /*keyframe pour le changement de couleurs avec un effet de zoom*/
  @keyframes highlight {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.05);
    }
    100% {
      transform: scale(1);
    }
  }
  
/* Styler la form d'offre */
.offer-form {
    display: none;
    margin-top: 10px;
}
/*Styler le bouton d'offre*/
.suggestion-btn {
    background-color: #23a6ca;
    border: none;
    border-radius: 4px;
    color: white;
    padding: 12px 30px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    margin-left: 30px;
    margin-top: 10px;
}
/*Style du bouton d'offre lors du survol*/
.suggestion-btn:hover {
    background-color: #187993;
}
/*Styler le bouton de refus*/

.refuse-btn {
    background-color: #f51505;
    border: none;
    border-radius: 4px;
    color: white;
    padding: 12px 24px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    margin-left: 40px;
    margin-top: 10px;
}
/*Styler le bouton de refus lors du survol*/
.refuse-btn:hover {
    background-color: #e60000; /* rouge foncé lors du survol */
  }
/*Styler le bouton de refus lors du click*/
.refuse-btn:active {
    background-color: #cc0000; /* rouge encore plus foncé lors du click */
  }
/*Styler le bouton d'acceptation */
.accept-btn {
    background-color: #37d83c;
    border: none;
    border-radius: 4px;
    color: white;
    padding: 12px 24px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    margin-left: 30px;
    margin-top: 10px;
    margin-right: 0px;
}
/*Styler le bouton d'acceptation lors du survol*/
.accept-btn:hover{
    background-color: #139618;
}

/*Styler le bouton des offres acceptés*/
td.accepted {
background-color: #95c895;
}

/*Styler le bouton des offres refusés*/
td.refused {
  background-color: #ffc9c9;
}

/*Styler le bouton des messages*/
td.message-btn{
    background-color: #215ee0; 
    color: white;
    border: none;
    padding: 12px 24px;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-left: 40px;
    margin-top: 10px;
  }
  /*Styler le bouton des messages lors du survol*/
  td.message-btn:hover {
    background-color: #0d3e9a;
  }
  /* styler la partie profil contenant les infos de l"entreprise*/
  .profile{
	display: inline-block;
	float: right;
	width: 220px;
}
/*redimensioner l'image du logo*/
.pro-img{
	float: right;
	width: 100px;
	margin-top: 5px;
}
/*styler le nom de l'entreprise*/
.profile p{
	color: black;
	font-weight: 500;
	margin-right: 55px;
	margin-top: 10px;
	font-size: 18px;
}
/*styler l'id de l'entreprise*/
.profile p span{
	font-weight: 400;
    font-size: 20px;
    display: block;
    color: #262525;
}

.col-div-3{
	width: 25%;
	float: left;
}
</style>
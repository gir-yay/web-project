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
</head>
<body>
    <h1>influenceur</h1>
    <h2> <?php echo $name; ?> </h2>
    <h2> <?php echo $email; ?> </h2>
    <h2> <?php echo $id; ?> </h2>
    <!-- A Buton to logout -->
    <a href="logout.php">Logout</a>

    
</body>
</html>
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
    <th>Make a offer </th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['CA'] . "</td>";
        echo "<td>";
        echo "<form method='post'>";
        // add a button to make an offer to the influencer
        echo "<button type='button' class='offer-btn'>Offer</button>";
        echo "<div class='offer-form' style='display:none;'>";
        echo "<input type='text' name='terms' placeholder='Terms'>";
        echo "<input type='text' name='amount' placeholder='Amount'>";
        echo "<input type='text' name='duration' placeholder='Duration'>";
        echo "<button type='submit' name='submit'>Submit</button>";
        echo "<input type='hidden' name='id' value='".$row['id']."'>";
        echo "</div>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    //check if the submit button is clicked
    if(isset($_POST['submit'])) {
        // get the terms of the offer
        $terms = $_POST['terms'];
        // get the amount of the offer
        $amount = $_POST['amount'];
        // get the duration of the offer
        $duration = $_POST['duration'];
        // get the id of the entreprise
        $id_entreprise = $_SESSION['id'];
        // get the id of the influencer
        $id_influencer = $_POST['id'];
        //the state is by default waiting for the influencer to accept or refuse the offer
        $state = "waiting";
        //echo all the data
        echo "terms: ".$terms." amount: ".$amount." duration: ".$duration." id_entreprise: ".$id_entreprise." id_influencer: ".$id_influencer." state: ".$state;
        // send a request to the database to add the offer to the database
        $sql = "INSERT INTO offer (terms, amount, duration, id_entreprise, id_influencer, state) VALUES ('$terms', '$amount', '$duration', '$id_entreprise', '$id_influencer', '$state')";
        $result = mysqli_query($conn, $sql);
        // check if the request is successful
        if($result) {
            // if successful redirect to the entreprise page
            header("Location: entreprise.php");
            exit();
        } else {
            // if not successful show an error message
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    echo "<script>
    document.querySelectorAll('.offer-btn').forEach(button => {
        button.addEventListener('click', () => {
            const form = button.parentElement.querySelector('.offer-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
    });
    </script>";
    //show all the offers for the influencer and get the name of the entreprise where the state is waiting
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
<style>
    /* Body styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

/* Header styles */
h1 {
  color: #333;
  margin-bottom: 20px;
  text-align: center;
}

/* Table styles */
table {
  border-collapse: collapse;
  margin: 20px auto;
  width: 100%;
}

table td,
table th {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: center;
}

table th {
  background-color: #f2f2f2;
  font-weight: bold;
  text-align: center;
}

/* Button styles */
button {
  background-color: #4CAF50;
  border: none;
  color: white;
  cursor: pointer;
  padding: 8px 16px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  border-radius: 5px;
}

button:hover {
  background-color: #3e8e41;
}

button[name=refuse] {
  background-color: #f44336;
}



/* Form styles */
.offer-form {
  margin-top: 10px;
}

.offer-form input[type=text],
.offer-form button[type=submit] {
  border-radius: 5px;
  padding: 8px;
  margin: 5px;
  width: 100%;
  font-size: 16px;
  box-sizing: border-box;
}

.offer-form button[type=submit] {
  background-color: #4CAF50;
  border: none;
  color: white;
  cursor: pointer;
  transition-duration: 0.4s;
}

.offer-form button[type=submit]:hover {
  background-color: #3e8e41;
}

/* Logout link styles */
a {
  display: block;
  margin: 20px auto;
  width: 120px;
  text-align: center;
  padding: 8px 16px;
  background-color: #f44336;
  color: white;
  border-radius: 5px;
  text-decoration: none;
}

a:hover {
  background-color: #da190b;
}






</style>
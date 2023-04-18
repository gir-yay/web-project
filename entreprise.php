<!-- create a page for the entreprise loged in  -->

<?php   
    include 'database.php';
    //get the session
    session_start();
    //check if the session is set
    if(!isset($_SESSION['email'])){
        //if not set redirect to the login page
        header("Location: login.php");
        exit();
    }else{
        //if set get the name of the entreprise
        $name = $_SESSION['name'];
        echo "<br>".$name." ";
        //the logo path 
        $logo = $_SESSION['logo'];
        //change th elogo path to Upload/logo
        $logo = "Uploads/".$logo;
        $ca = $_SESSION['ca'];
        echo "chiffre d'affaire: ".$ca;
       

    }
?>
<!-- html page for the entreprise  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entreprise</title>
</head>
<body>
    <h1> Welcome <?php echo $name; ?></h1>
    <!-- create a navigation part  logout and home as a button  -->
    <nav>
        <ul>
            <li><input type="button" value="Home" onclick="window.location.href='Home.php'"></li>
            <!-- logout button and session destroyer  on click log out -->
            <li>
                <input type="submit" value="Logout" onclick="window.location.href='logout.php'">
            </li>
        </ul>

    </nav>

    <!-- the body have the name of the entreprise the logo and the id  -->
    <main>
        <h1>Entreprise <?php echo $name ?> </h1>
        <!-- the logo of the copany is a image get the path from the database  -->
        <img src="<?php echo $logo ?>" alt="logo">
        <h1>Id <?php echo $_SESSION['id'] ?></h1>
    </main>

</body>
<<?php 
//show all the influenceur as a table 
//get the database connection
include 'database.php';
//get the id of the entreprise
$id = $_SESSION['id'];
//get the name of the entreprise
$name = $_SESSION['name'];
//get the logo of the entreprise
$logo = $_SESSION['logo'];
//get the ca of the entreprise
$ca = $_SESSION['ca'];
//get the email of the entreprise
$email = $_SESSION['email'];
//send a request to the database to get all the influenceur
echo "<h1>INFLUENCER</h1>";
$sql = "SELECT * FROM influencer";
$result = mysqli_query($conn, $sql); 
//
echo "<table>";
echo "<tr><th>ID</th><th>Last Name</th><th>First Name</th><th>Email</th><th>Age</th><th>Make a offer</th></tr>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>".$row['lastname']."</td>";
    echo "<td>".$row['firstname']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['age']."</td>";
    echo "<td>";
    echo "<form method='post'>";
    // add a button to make an offer to the influencer
    echo "<button type='button' class='offer-btn'>Offer</button>";
    echo "<div class='offer-form' style='display:none;'>";
    // add a form to make an offer: the terms of an agreement between two parties, the amount paid by a brand to an influencer, and the duration of the contract
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
// check if the offer button is clicked
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

// add JavaScript to toggle the display of the offer form
echo "<script>
document.querySelectorAll('.offer-btn').forEach(button => {
    button.addEventListener('click', () => {
        const form = button.parentElement.querySelector('.offer-form');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
});
</script>";
?>
<style>
table {
  border-collapse: collapse;
  width: 100%;
  margin-top: 20px;
}
th, td {
  text-align: left;
  padding: 8px;
}
th {
  background-color: #ddd;
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}
.offer-form {
  margin-top: 10px;
}
.offer-form input[type=text] {
  margin-right: 10px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
.offer-form button {
  padding: 5px;
  background-color: #4CAF50;
  border: none;
  color: white;
  border-radius: 3px;
  cursor: pointer;
}
</style>

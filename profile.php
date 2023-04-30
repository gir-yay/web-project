<?php 
    //profile page for the entreprise 
    include 'database.php';
    //start a session
    session_start();
    //check if the user is logged in
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
    }
    //get the user id
    $id = $_SESSION['id'];
    //get all the data from the entreprise table
    $sql = "SELECT * FROM entreprise WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    //get the name , logo , ca , email 
    $name = $row['Name'];
    $ca = $row['ca'];
    $email = $row['email'];
    //the logo is saved in Upload folder
    $logo = "Upload/".$row['logo'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil entreprise</title>
    <style>
        body {
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size: 16px;
  color: #333;
  background-color: #f5f5f5;
}

header {
  background-color: #333;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

nav li {
  display: inline-block;
  margin-right: 10px;
}

nav a {
  color: #fff;
  text-decoration: none;
  font-size: 16px;
  transition: color 0.3s ease-in-out;
}

nav a:hover {
  color: #ddd;
}

main {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

section {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.3);
  padding: 30px;
}

h1 {
  font-size: 36px;
  margin: 0;
  text-transform: uppercase;
  letter-spacing: 2px;
}

h2 {
  font-size: 28px;
  margin: 20px 0;
  text-transform: uppercase;
  letter-spacing: 1px;
}

img {
  max-width: 100%;
  height: auto;
  margin: 20px 0;
  border-radius: 50%;
  box-shadow: 0 2px 5px rgba(0,0,0,0.3);
  max-height: 200px;
}

table {
  margin: 20px 0;
  border-collapse: collapse;
  width: 100%;
}

td {
  padding: 10px;
  border: 1px solid #ddd;
}

a {
  color: #0077cc;
  text-decoration: none;
  transition: color 0.3s ease-in-out;
}

a:hover {
  color: #005fa3;
}

    </style>
</head>
<body>
    <header>
        <h1>Profil entreprise</h1>
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="entreprise.php">Main page</a></li>
                <li>
                  <form action="" method="POST">
                    <input type="submit" name="delete" value="Delete">
                  </form>
                </li>
                <li>
                  <form action="" method="POST">
                    <input type="submit" name="update" value="Update">
                  </form>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2><?php echo $name; ?></h2>
            <img src="<?php echo $logo; ?>" alt="Logo de <?php echo $name; ?>">
            <table>
                <tr>
                    <td>Chiffre d'affaires:</td>
                    <td><?php echo $ca; ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $email; ?></td>
                </tr>
            </table>
        </section>
    </main>
</body>
</html>
<?php 
    //set the state as pending 
    $state = 'pending';
    //if the user click on delete button
    if(isset($_POST['delete'])){
        //make  a pop up message to confirm the delete with a yes or no button and a check box to confirm the delete
        
        echo "<script> ";
        echo "var c = confirm('Are you sure you want to delete your account?');";
        echo "if(c == true){";
        //if the user confirm the delete
        //add the request to the request table with the state pending
        $sql = "INSERT INTO request (user_id, state,type) VALUES ('$id','$state','entreprise')";
        $result = mysqli_query($conn, $sql);
        //else if the user click on no
        echo "}else{";
        //redirect to the profile page
        header("Location: profile.php");
        echo "}";
        echo "</script>";
    }
    //if the user click on update button
    if(isset($_POST['update'])){
       //create  a forum with all the info to update 
       echo "<form action='' method='POST'>";
        echo "<input type='text' name='name' placeholder='Name'>";
        echo "<input type='text' name='ca' placeholder='Chiffre d affaires'>";
        echo "<input type='text' name='email' placeholder='Email'>";
        //a input for the logo 
        echo "<input type='file' name='logo' placeholder='Logo'>";
        echo "<input type='submit' name='update' value='Update'>";
        echo "</form>";
        //if the user click on Update
        if(isset($_POST['update'])){
            //get the info from the forum
            $name = $_POST['name'];
            $ca = $_POST['ca'];
            $email = $_POST['email'];
            $logo = $_POST['logo'];
            //update the info in the database
            $sql = "UPDATE entreprise SET Name='$name', ca='$ca', email='$email', logo='$logo' WHERE id='$id'";
            $result = mysqli_query($conn, $sql);
            //redirect to the profile page
            header("Location: profile.php");
        }
    }
?>


    




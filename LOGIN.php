<!-- we create the login page  -->
<!-- we have two type of user entreprise and influenceur each have a forumm to login in  -->
<!-- we have a link to the signup page  -->
<?php
session_start();
include 'database.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //hash the password 
    // $password = password_hash($password, PASSWORD_DEFAULT);

    if (isset($_POST['entreprise'])) {
    
        $sql = "SELECT * FROM entreprise WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['entreprise_id'] = $row['id'];
            header('Location: index.php');
        } else {
            $error = "Email or password is incorrect.";
        }
    }

    if (isset($_POST['influenceur'])) {
        $sql = "SELECT * FROM influenceur WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['influenceur_id'] = $row['id'];
            header('Location: index.php');
        } else {
            $error = "Email or password is incorrect.";
        }
    }
}
?>

<!-- Login page HTML code here -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>
</head>
<body>
    <!-- add a home button  -->
    <a href="Home.php">Home</a>
    <!-- add a link to the signup page  -->
    <a href="signup.php">Signup</a>

    <!-- we create two botuon on for each forum  -->
    <nav>
			<ul>
				<li><button onclick="showEntrepriseSection()">Entreprise</button></li>
				<li><button onclick="showInfluenceurSection()">Influenceur</button></li>
			</ul>
	</nav>
    <main>
        <section id="entreprise">
            <h1>Entreprise</h1>
            <form action="" method="POST">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="login">Login</button>
            </form>
        </section>
        <section id="influenceur">
            <h1>Influenceur</h1>
            <form action="" method="POST">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <button type="submit" name="login">Login</button>
            </form>
        </section>
        <!-- script to show the forum  -->
        <script>
		function showEntrepriseSection() {
			document.getElementById("entreprise").style.display = "block";
			document.getElementById("influenceur").style.display = "none";
		}

		function showInfluenceurSection() {
			document.getElementById("entreprise").style.display = "none";
			document.getElementById("influenceur").style.display = "block";
		}
	</script>
    <!-- style the forum  -->
    <style>
        /* Set box-sizing property for all elements */
            * {
            box-sizing: border-box;
            }

            /* Set background and font colors */
            body {
            background-color: #f7f7f7;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 16px;
            }

            /* Set nav styles */
            nav {
            background-color: #fff;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            }

            nav ul {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            }

            nav ul li {
            margin: 0 10px;
            }

            nav button {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
            }

            nav button:hover {
            background-color: #0069d9;
            }

            /* Set main styles */
            main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 50px);
            }

            section {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: none;
            max-width: 400px;
            padding: 20px;
            text-align: center;
            }

            section h1 {
            font-size: 24px;
            margin-top: 0;
            }

            section form {
            display: flex;
            flex-direction: column;
            }

            section form input[type="text"],
            section form input[type="password"] {
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px;
            padding: 10px;
            }

            section form button[type="submit"] {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px;
            transition: background-color 0.3s ease;
            }

            section form button[type="submit"]:hover {
            background-color: #0069d9;
            }
    </style>

    </main> 
</body>
</html>

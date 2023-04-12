<!-- create a page for the entreprise loged in  -->

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
        $name = $_SESSION['name'];
        echo $name;
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
            <li><input type="button" value="Logout"></li>
            <!-- php code for logout button -->
            <?php 
            //destroy the session and go to login page
            if(isset($_POST['logout'])){
                session_destroy();
                header("Location: login.php");
                exit();
            }
            ?>
        </ul>

    </nav>

    <!-- the body have the name of the entreprise the logo and the id  -->
    <main>
        <h1>Entreprise <?php echo $name ?> </h1>
        <!-- the logo of the copany is a image get the path from the database  -->
        <img src="<?php echo $logo ?>" alt="logo">
        <h1>Id <?php echo $_SESSION['id'] ?></h1>
    </main>

    <style>
        /* Set box-sizing property for all elements */
            * {
            box-sizing: border-box;
            }
        /* give a modern look for the button */
        input[type=button] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        /* Set background and font colors */
        body {
            background-color: #f7f7f7;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #555;
            line-height: 20px;
        }
        /* customize the nav bar  */
        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        nav li {
            display: inline-block;
            margin-right: 20px;
        }
        nav a {
            color: #fff;
            text-decoration: none;
        }
        /* customize the main part  */
        main {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }
        /* customize the footer  */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>


        
            

    
    





</body>
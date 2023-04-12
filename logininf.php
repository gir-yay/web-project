<?php 

session_start(); 

include "database.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['email']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: index.php?error=email is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM influencer  WHERE email='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $uname && $row['password'] === $pass) {
                $_SESSION['email']=$uname  ;
                $_SESSION['Lastname']=$row['lastname'];
                $_SESSION['firstname']=$row['firstname'];
                $_SESSION['id']=$row['id'];
                //head to the influenceur page
                header("Location: influenceur.php");

                

            }else{

                    echo "ur not loged in ";

                

            }

        }else{

            echo " ur not loged in ";


        }

    }

}else{

    header("Location: index.php");

    exit();

}
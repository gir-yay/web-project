<?php 
//logout.php
session_start();

//remove all session variables
session_unset();
session_destroy();

//redirect to home page
header("Location: index.php");
exit();
?>
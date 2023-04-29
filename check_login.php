<?php
// start the session before any output
session_start();

// connect to mysql database
include 'database.php';
//print th esession variables
print_r($_SESSION);




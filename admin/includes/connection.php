<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	
	$host = "localhost";
	$user = "mdairy_mdairy";
	$pass = "Mdairy@123";
	$db = "mdairy_unesco";

	$con=mysqli_connect($host, $user, $pass, $db) or die(mysql_error());
	mysqli_set_charset($con,'utf8');
	
?>
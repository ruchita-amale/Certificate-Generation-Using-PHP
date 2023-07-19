<?php
	
	$host = "localhost";
	$user = "tbadmin_suman";
	$pass = "Pravara@4106";
	$db = "tbadmin_unesco";

	$con=mysqli_connect($host, $user, $pass, $db) or die(mysql_error());
	mysqli_set_charset($con,'utf8');
	
?>
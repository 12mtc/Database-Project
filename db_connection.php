<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbPass = "";
	$db = "recipedb";
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbPass, $db); 
	
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>
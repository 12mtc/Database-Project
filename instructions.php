<?php
include('db_connection.php');
if (!isset($_SESSION)) {
	session_start();
}
$currentFilterMessage = "No current filter";


?>
<<!DOCTYPE html>
<html>
<head>
	<title>Instructions</title>
</head>
<body>
<div class="bg-image">
	<div class="topnav">
		<a  href="welcome.php">Home</a>
		<a  href="pantry.php">Pantry</a>
		<a href="recipes.php">Recipes</a>
		<a href="stores.php">Stores</a>
	</div>
</div>

<style type="text/css">
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}
.container {
  position: absolute;
  margin: 20px;
  width: auto;
}

/* The navbar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Navbar links */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

</style>

<p>this is an instruction...</p>



</body>
</html>

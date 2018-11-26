<?php
include('db_connection.php');
if (!isset($_SESSION)) {
	session_start();
}

$query = "SELECT * FROM user WHERE UserNo = {$_SESSION['UserNumber']}";
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);

//Adds session variable for user location on entrance
$_SESSION['UserLocation'] = $userData["location"];

include('FindGroceryStores.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

* {box-sizing: border-box;}

.bg-img {
  /* The image used */
  background-image: url("food.jpg");
  min-height: 380px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

  /* Needed to position the navbar */
  position: relative;
}

/* Position the navbar container inside the image */
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
</head>
<body>
<div class="bg-image">
	<div class="topnav">
		<a href="welcome.php">Home</a>
		<a href="pantry.php">Pantry</a>
		<a href="recipes.php">Recipes</a>
		<a class="active" href="stores.php">Stores</a>
	</div>
</div>
    <form method="post" action="databaseInsert.php">
		<div class="input-group">
			<label>Location</label>
			<input type="text" name="newUserLocation">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="set_location_btn">Set Location</button>
		</div>
	</form>

	
	
</body>
</html>

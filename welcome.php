<?php
include('db_connection.php');
session_start();

$query = "SELECT * FROM user WHERE UserName = '" . $_SESSION["UserName"] . "'";
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);

//Sets the users pantry number if it has not yet been set
if (is_null($userData["PantryNo"])) {
	$query = "UPDATE user SET PantryNo = '" . $userData["UserNo"] . "' WHERE UserName = '" . $_SESSION["UserName"] . "'";
	if (!mysqli_query($conn, $query)) {
		echo "Failed to set PantryNo";
	}
}
$_SESSION['PantryNo'] = $userData["PantryNo"];
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
		<a class="active" href="welcome.php">Home</a>
		<a href="pantry.php">Pantry</a>
		<a href="recipes.php">Recipes</a>
		<a href="stores.php">Stores</a>
	</div>
</div>

<div style="padding-left:16px">
  Welcome <?php echo $_SESSION["UserName"]; ?><br>
  <p>Some content..</p>
</div>

</body>
</html>

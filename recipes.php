<?php
include('db_connection.php');
if (!isset($_SESSION)) {
	session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
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
<body>

<div class="bg-image">
	<div class="topnav">
		<a href="welcome.php">Home</a>
		<a href="pantry.php">Pantry</a>
		<a class="active" href="recipes.php">Recipes</a>
		<a href="stores.php">Stores</a>
		<a href="logout.php">Logout</a>
	</div>
</div>
<br>

<?php
	$query = "SELECT r.Mealtype, r.MealTime, u.UserName
				FROM recipebook r, ingredients i
				WHERE r.RecipeNum = i.RecipeNum AND i.IngredientNum IN
				(SELECT p.FoodNum FROM pantry p
				WHERE p.PantryNo = {$_SESSION["PantryNo"]})
				LEFT JOIN user u ON r.AuthorNo = u.UserNo";
				$result = mysqli_query($conn, $query);
				echo "<table border='1'>";
				echo "<tr><td><b>Recipe Name</b></td>
						<td><b>Meal Time</b></td>
						<td><b>Author</b></td></tr>";

				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>
							<td>{$row['Mealtype']}</td>
							<td>{$row['MealTime']}</td>
							<td>{$row['UserName']}</td>
						  </tr>";
				}
				echo "</table>";
?>
</body>
</html>

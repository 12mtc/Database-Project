<?php
include('db_connection.php');
if (!isset($_SESSION)) {
	session_start();
}

if (isset($_GET["all_recipes_btn"])) {
	// Makes an array of all recipe numbers
	$query = "SELECT recipeNum FROM recipebook";
	$result = mysqli_query($conn, $query);
	$valid_recipes = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($valid_recipes, $row['recipeNum']);
	}
}
if (isset($_GET["vegitarian_btn"])) {
	// Makes an array of all vegitarian recipe numbers
	$query = "SELECT r.RecipeNum 
				FROM recipebook r, 
					(SELECT RecipeNum, COUNT(RecipeNum) AS Total FROM ingredients GROUP BY RecipeNum) total, 
					(SELECT RecipeNum, COUNT(i.recipeNum) AS Total FROM ingredients i, foodtype f WHERE i.IngredientNum = f.FoodNum AND f.FoodName NOT IN (SELECT FoodName FROM foodtype WHERE FoodGroup = 'Meat') GROUP BY recipeNum) noMeat 
				WHERE total.RecipeNum = noMeat.RecipeNum AND total.Total = noMeat.Total AND r.RecipeNum = noMeat.RecipeNum";
	$result = mysqli_query($conn, $query);
	$valid_recipes = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($valid_recipes, $row['RecipeNum']);
	}
}
else {
	// Makes an array of 'make-able' recipe numbers
	$query = "SELECT DISTINCT i.recipeNum FROM pantry p
				INNER JOIN ingredients i ON i.IngredientNum = p.FoodNum
				WHERE p.PantryNo = '{$_SESSION['UserNumber']}'";
	$result = mysqli_query($conn, $query);
	$valid_recipes = array();
	while($row = mysqli_fetch_assoc($result)) {
		array_push($valid_recipes, $row['recipeNum']);
	}
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
		<a href="logout.php" onclick="return confirm('Are you sure you want to logout? (OK/CANCEL)');">Logout</a>
	</div>
</div>

<table cellpadding="10">
<tr><td>
<form method="get" action="recipes.php">
	<div class="input-group">
		<button type="submit" class="btn" name="default_btn">Show 'Make-able' Recipes</button>
	</div>
</form>
</td>
<td>
<form method="get" action="recipes.php">
	<div class="input-group">
		<button type="submit" class="btn" name="all_recipes_btn">Show All Recipes</button>
	</div>
</form>
</td>
<td>
<form method="get" action="recipes.php">
	<div class="input-group">
		<button type="submit" class="btn" name="vegitarian_btn">Show All Vegitarian Recipes</button>
	</div>
</form>
</td>
</tr>
</table>


<div>
<?php
	echo "<table cellpadding='2' border='5'>";
	foreach ($valid_recipes as $count => $rNum) {
		$query = "SELECT RecipeName 
					FROM recipebook
					WHERE RecipeNum = {$rNum};";
		$result = mysqli_query($conn, $query);
		$temp = mysqli_fetch_assoc($result);
		
		if ($result->num_rows > 0) {
			echo "<tr><td><b>{$temp['RecipeName']}</td></b>";
			echo "<td><form action=\"instructions.php\" method=\"get\">
					<button type=\"submit\" name=\"recipe\" value=\"{$rNum}\">View Instructions</button>
					</form></td></tr>";
		}
	}
	echo "</table>";
?>
</div>
</body>
</html>

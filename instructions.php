<?php
	include('db_connection.php');
	if (!isset($_SESSION)) {
		session_start();
	}
	// Gets the needed recipe number from button press value
	$currentRNum = $_GET["recipe"];

	// Queries our own REST API to get a list of all recipes
	$json = file_get_contents("http://localhost/Database-Project-master/readRecipes.php");
	$allRecipes = json_decode($json);
	if (empty($allRecipes)) {
		echo "No recipes on file";
	}
	else {
		// Convers the returned JSON file into different variables needed
		$instrArr = array();
		$ingrArr = array();
		$temp = "recipe".$currentRNum;
		$rUserName = $allRecipes->$temp->UserName;
		$rRecipeName = $allRecipes->$temp->RecipeName;
		$rMealTime = $allRecipes->$temp->MealTime;
		$instrArr = $allRecipes->$temp->Instructions;
		$ingrArr = $allRecipes->$temp->Ingredients;
	}
?>
<!DOCTYPE html>
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
<form method="get" action="recipes.php">
	<div class="input-group">
		<button type="submit" class="btn" name="default_btn">Return to Recipes</button>
	</div>
</form>
<br>
<?php
	// Creates table containing information about recipe
	echo "<table border='1'>";
	echo "<tr><td><b>Recipe</b></td>
			<td><b>Meal Time</b></td>
			<td><b>Writer</b></td></tr>";
	echo "<tr><td>$rRecipeName</td>
			<td>$rMealTime</td>
			<td>$rUserName</td></tr>";
	echo "</table><br>";
	
	// Creates table for recipe instructions
	if (!empty($instrArr)) {
		echo "<table border='1'>";
		echo "<tr><td><b>#</b></td>
			<td><b>Instruction</b></td></tr>";
		foreach($instrArr as $numb => $instr) {
			echo "<tr><td>$numb</td>
				<td>$instr</td></tr>";
		}
		echo "</table><br>";
	}
	else {
		echo "<br>No instructions provided<br>";
	}
	
	// Creates table for ingredient list
	if (!empty($ingrArr)) {
		echo "<table border='1'>";
		echo "<tr><td><b>Ingredient</b></td>
			<td><b>Quantity</b></td></tr>";
		foreach($ingrArr as $ingredient => $quantity) {
			echo "<tr><td>$ingredient</td>
				<td>$quantity</td></tr>";
		}
		echo "</table><br>";
	}
	else {
		echo "<br>No ingredients provided<br>";
	}
?>

</body>
</html>

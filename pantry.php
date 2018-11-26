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
		<a  href="welcome.php">Home</a>
		<a class="active" href="pantry.php">Pantry</a>
		<a href="recipes.php">Recipes</a>
		<a href="stores.php">Stores</a>
	</div>
</div>

<?php
	//Replace this query with SELECT * FROM view, if view is defined for this query
	$query = "SELECT f.FoodName, f.FoodGroup, f.FoodBrand, f.Barcode, p.quantity 
				FROM pantry p, foodtype f 
				WHERE p.FoodNum = f.FoodNum AND p.PantryNo = " . $_SESSION["PantryNo"];
	$result = mysqli_query($conn, $query);

	echo "<table border='1'>";
	echo "<tr><td>Food Name</td><td>Food Group</td><td>Food Brand</td><td>Barcode</td><td>Quantity</td></tr>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>
				<td>{$row['FoodName']}</td>
				<td>{$row['FoodGroup']}</td>
				<td>{$row['FoodBrand']}</td>
				<td>{$row['Barcode']}</td>
				<td>{$row['quantity']}</td>
			  </tr>";
	}
	echo "</table>";
?>

<form method="post" action="databaseInsert.php">
	<div class="input-group">
		<label>Food Name</label>
		<input type="text" name="newFoodName">
	</div>
	<div class="input-group">
		<label>Food Group</label>
		<input type="text" name="newFoodGroup">
	</div>
	<div class="input-group">
		<label>Food Brand</label>
		<input type="text" name="newFoodBrand">
	</div>
	<div class="input-group">
		<label>Barcode</label>
		<input type="number" name="newBarcode">
	</div>
	<div class="input-group">
		<label>Quantity</label>
		<input type="number" name="newQuantity">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="add_item_btn">Add Item</button>
	</div>
</form>

</body>
</html>

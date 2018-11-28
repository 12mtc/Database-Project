<?php
include('db_connection.php');
if (!isset($_SESSION)) {
	session_start();
}
// Sets the variable for filter message
$currentFilterMessage = "No current filter";

// Based on which filter button is pressed (if any), changes the SQL query to build the table
// Also sets the filter message depending on which filter user selected
if (isset($_POST['filter_quant_btn']) and !empty($_POST['maxQuant'])) {
	$query = "SELECT f.FoodName, f.FoodGroup, f.FoodBrand, f.Barcode, p.quantity 
				FROM pantry p, foodtype f 
				WHERE p.FoodNum = f.FoodNum AND p.PantryNo = {$_SESSION["PantryNo"]}
				AND quantity = ANY (SELECT quantity FROM pantry WHERE quantity <= {$_POST['maxQuant']})
				GROUP BY f.FoodGroup, f.FoodName, f.FoodBrand, f.Barcode";	
	$currentFilterMessage = "Showing all items with a quantity at most {$_POST['maxQuant']}";
}
else {
	$query = "SELECT f.FoodName, f.FoodGroup, f.FoodBrand, f.Barcode, p.quantity 
				FROM pantry p, foodtype f 
				WHERE p.FoodNum = f.FoodNum AND p.PantryNo = {$_SESSION["PantryNo"]}";
	$currentFilterMessage = "No current filter";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<style>
h2 { 
  color: white;
  text-align: right;
}
	
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-image: url("fruit-background.jpg");
   background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}
  
* {box-sizing: border-box;}

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

<div class="bg-img">
	<div class="topnav">
		<a  href="welcome.php">Home</a>
		<a class="active" href="pantry.php">Pantry</a>
		<a href="recipes.php">Recipes</a>
		<a href="stores.php">Stores</a>
		<a href="logout.php" onclick="return confirm('Are you sure you want to logout? (OK/CANCEL)');">Logout</a>
		<h2>Recipe Finder</h2>
	</div>
</div>
<b>Current Pantry Items: </b>
<?php echo $currentFilterMessage; ?>
<?php if($currentFilterMessage !== "No current filter") : ?>
	<form method="post" action="pantry.php">
		<div class="input-group">
			<button type="submit" class="btn" name="clear_search_btn">Clear Filter</button>
		</div>
	</form>
	
<?php endif; ?>
<?php
	// Queries database then builds the table
	$result = mysqli_query($conn, $query);
	echo "<table border='1'>";
	echo "<tr><td><b>Food Name</b></td>
			<td><b>Food Group</b></td>
			<td><b>Food Brand</b></td>
			<td><b>Barcode</b></td>
			<td><b>Quantity</b></td>
			</tr>";
	
	// Iterates through each row of the SQL result, building table row by row.
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
<b>Filter foods by max quantity</b>
<form method="post" action="pantry.php">
	<div class="input-group">
		<label>Max Quantity</label>
		<input type="number" name="maxQuant">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="filter_quant_btn">Search</button>
	</div>
</form>
<br>
<br>
<b>Add Item or Update Quantity</b>
<table>
<form method="post" action="databaseInsert.php">
	<tr>
	<div class="input-group">
		<td>
		<label>Food Name</label>
		</td>
		<td>
		<input type="text" name="newFoodName">
		</td>
	</div>
	</tr>
	<tr>
	<div class="input-group">
		<td>
		<label>Food Group</label>
		</td>
		<td>
		<input type="text" name="newFoodGroup">
		</td>
	</div>
	</tr>
	<tr>
	<div class="input-group">
		<td>
		<label>Food Brand</label>
		</td>
		<td>
		<input type="text" name="newFoodBrand">
		</td>
	</div>
	</tr>
	<tr>
	<div class="input-group">
		<td>
		<label>Barcode</label>
		</td>
		<td>
		<input type="number" name="newBarcode">
		</td>
	</div>
	</tr>
	<tr>
	<div class="input-group">
		<td>
		<label>Quantity</label>
		</td>
		<td>
		<input type="number" name="newQuantity">
		</td>
	</div>
	</tr>
	<tr>
	<div class="input-group">
		<td>
		<button type="submit" class="btn" name="add_item_btn">Add/Update</button>
		</td>
	</div>
	</tr>
</table>
</form>

</body>
</html>

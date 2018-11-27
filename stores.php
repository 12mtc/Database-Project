<?php
include('db_connection.php');
if (!isset($_SESSION)) {
	session_start();
}

// Sets current filter message
$currentFilterMessage = "No current filter";

// Based on which filter button is pressed (if any), changes the SQL query to build the table
// Also sets the filter message depending on which filter user selected
if (isset($_POST['filter_name_btn']) and !empty($_POST['storeNameSearch'])) {
	$searchQuery = "SELECT StoreNo, StoreName, Location FROM grocerystores 
					WHERE UserNo = {$_SESSION['UserNumber']}
					AND StoreName LIKE '%{$_POST['storeNameSearch']}%'";
	$currentFilterMessage = "Showing all store names containing \"{$_POST['storeNameSearch']}\"";
}
else if (isset($_POST['filter_location_btn']) and !empty($_POST['storeLocationSearch'])) {
	$searchQuery = "SELECT StoreNo, StoreName, Location FROM grocerystores 
					WHERE UserNo = {$_SESSION['UserNumber']}
					AND Location LIKE '%{$_POST['storeLocationSearch']}%'";
	$currentFilterMessage = "Showing all store names containing \"{$_POST['storeLocationSearch']}\"";
}
else {
	$searchQuery = "SELECT StoreNo, StoreName, Location FROM grocerystores 
					WHERE UserNo = {$_SESSION['UserNumber']}";
	$currentFilterMessage = "No current filter";
}
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
		<a href="logout.php" onclick="return confirm('Are you sure you want to logout? (OK/CANCEL)');">Logout</a>
	</div>
</div>

<form method="post" action="databaseInsert.php">
	<div class="input-group">
		<b><label>Current Postal/ZIP Code:</label></b> 
		<input type="text" name="newUserLocation">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="set_location_btn">Set Location</button>
	</div>
</form>
<br>
<b>Nearest stores to your location</b><br>

<?php if($currentFilterMessage !== "No current filter") : ?>
	<form method="post" action="stores.php">
		<div class="input-group">
			<button type="submit" class="btn" name="clear_search_btn">Clear Filter</button>
		</div>
	</form>
<?php endif; ?>

<?php
	// Sets the current filter message
	echo $currentFilterMessage;
	
	// Queries database then builds the table
	$result = mysqli_query($conn, $searchQuery);
	echo "<table border='1'>";
	echo "<tr><td><b>Store Number</b></td><td><b>Store Name</b></td><td><b>Store Location</b></td></tr></b>";
	
	// Iterates through each row of the SQL result, building table row by row.
	while($row = mysqli_fetch_assoc($result)) {
	echo "<tr>
			<td>{$row['StoreNo']}</td>
			<td>{$row['StoreName']}</td>
			<td>{$row['Location']}</td>
		   </tr>";
	}
	echo "</table>";
?>
<font size="1">If table is blank, enter a location (Must be valid and have stores within 10km)</font>
<table cellpadding="20">
<tr><td>
<form method="post" action="stores.php">
	<div class="input-group">
		<b><label>Filter by Store Name</label></b><br>
		<input type="text" name="storeNameSearch">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="filter_name_btn">Search</button>
	</div>
</form>
</td>
<td>
<form method="post" action="stores.php">
	<div class="input-group">
		<b><label>Filter by Store Location</label></b><br>
		<input type="text" name="storeLocationSearch">
	</div>
	<div class="input-group">
		<button type="submit" class="btn" name="filter_location_btn">Search</button>
	</div>
</form>
</td>
</tr>
</table>
	
</body>
</html>

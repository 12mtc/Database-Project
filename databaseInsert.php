<?php
include('db_connection.php');
if (!isset($_SESSION)) {
	session_start();
}

// Add item function on pantry.php
if (isset($_POST['add_item_btn'])) {
	$foodName = $_POST['newFoodName'];
	$foodGroup = $_POST['newFoodGroup'];
	$foodBrand = $_POST['newFoodBrand'];
	$barcode = $_POST['newBarcode'];
	$quantity = $_POST['newQuantity'];
	
	$query = "SELECT * FROM foodtype 
				WHERE FoodName = '{$foodName}' AND FoodGroup = '{$foodGroup}'
				AND FoodBrand = '{$foodBrand}' AND Barcode = '{$barcode}'";
	$result = mysqli_query($conn, $query);
	if ($result->num_rows <= 0) {
		// Gets the highest foodNum, adds 1 for next insert
		$query = "SELECT MAX(FoodNum) AS max FROM foodtype";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$foodNum = $row['max'] + 1;
		
		// Query to insert into foodtype
		$query = "INSERT INTO foodtype VALUES (
					'{$foodNum}',
					'{$foodGroup}',
					'{$foodName}',
					'{$foodBrand}',
					'{$barcode}')";
		if (!mysqli_query($conn, $query)) {
			echo "Failed to insert into foodtype";
		}
		
		// Query to insert into pantry
		$query = "INSERT INTO pantry VALUES (
					'{$_SESSION['PantryNo']}',
					'{$foodNum}',
					'{$quantity}')";
		echo $query . "<br>";
		if (!mysqli_query($conn, $query)) {
			echo "Failed to insert into pantry <br>";
			echo mysqli_error($conn);
		}
	}
	else {
		$temp = mysqli_fetch_assoc($result);
		$query = "SELECT * FROM pantry WHERE FoodNum = '{$temp['FoodNum']}' AND PantryNo = '{$_SESSION["PantryNo"]}'";
		$result2 = mysqli_query($conn, $query);
		if ($result2->num_rows > 0) {
			$foodData = mysqli_fetch_assoc($result);
			$query = "UPDATE pantry SET Quantity = {$quantity}
						WHERE FoodNum = '{$temp['FoodNum']}' AND PantryNo = '{$_SESSION["PantryNo"]}'";
			echo $query;
			mysqli_query($conn, $query);
		}
		else {
			$query = "INSERT INTO pantry VALUES ('{$_SESSION["PantryNo"]}', '{$temp['FoodNum']}', '{$quantity}')";
			echo $query;
			mysqli_query($conn, $query);
		}
	}
	header('location: pantry.php');

}

// Set location function on stores.php
if (isset($_POST['set_location_btn'])) {
	$newLocation = $_POST['newUserLocation'];
	
	if (!empty($newLocation)) {
		// Updates users location
		$query = "UPDATE user SET location = '{$newLocation}' WHERE userNo = {$_SESSION['UserNumber']}";
		if (!mysqli_query($conn, $query)) {
			echo "Failed to update location";
		}
		else {
			// Updates users location in session variable
			$_SESSION['UserLocation'] = $newLocation;
			// Deletes all nearby stores for that user, if user successfully changes locations
			$query = "DELETE FROM grocerystores WHERE UserNo = {$_SESSION['UserNumber']}";
			mysqli_query($conn, $query);
			// Runs FindGroceryStores.php whenever users location changed.
			include('FindStores.php');
		}
	}
	header('location: stores.php');
}
?>
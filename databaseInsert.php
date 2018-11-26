<?php
include('db_connection.php');
session_start();

//Add item function on pantry.php
if (isset($_POST['add_item_btn']))
	$foodName = $_POST['newFoodName'];
	$foodGroup = $_POST['newFoodGroup'];
	$foodBrand = $_POST['newFoodBrand'];
	$barcode = $_POST['newBarcode'];
	$quantity = $_POST['newQuantity'];
	
	//Gets the highest foodNum, adds 1 for next insert
	$query = "SELECT MAX(FoodNum) AS max FROM foodtype";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$foodNum = $row['max'] + 1;
	
	//Query to insert into foodtype
	$query = "INSERT INTO foodtype VALUES (
				'{$foodNum}',
				'{$foodGroup}',
				'{$foodName}',
				'{$foodBrand}',
				'{$barcode}')";
	if (!mysqli_query($conn, $query)) {
		echo "Failed to insert into foodtype";
	}
	
	//Query to insert into pantry
	$query = "INSERT INTO pantry VALUES (
				'{$_SESSION['PantryNo']}',
				'{$foodNum}',
				'{$quantity}')";
	if (!mysqli_query($conn, $query)) {
		echo "Failed to insert into pantry";
	}
	header('location: pantry.php');
?>
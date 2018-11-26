<?php
include('db_connection.php');

$distance=10000; //In meters

//Allows php to access internet
ini_set("allow_url_fopen", 1);

$userLocation = $_SESSION['UserLocation'];
$geocodingAPI = "https://maps.googleapis.com/maps/api/geocode/json?components=postal_code:{$userLocation}&key=AIzaSyBpITV9_OttxQUpaEAM0w_D0-iaslq6sQo";

$json = file_get_contents($geocodingAPI);
$obj = json_decode($json);


if (empty($obj->results)) {
	echo "Invalid location";
}
else {
	//Gets lat and lng from returned JSON object
	$userLat = $obj->results[0]->geometry->location->lat;
	$userLng = $obj->results[0]->geometry->location->lng;

	//API to return all supermarkets in $distance radius of users lat/lng
	$placesAPI = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$userLat},{$userLng}&radius={$distance}&type=grocery_or_supermarket&key=AIzaSyBpITV9_OttxQUpaEAM0w_D0-iaslq6sQo";

	$json = file_get_contents($placesAPI);
	$obj = json_decode($json);

	foreach ($obj->results as $store) {

		$storeName = addslashes($store->name);
		$storeLocation = addslashes($store->vicinity);

		
		$query = "SELECT * FROM grocerystores 
					WHERE StoreName = '{$storeName}' 
					AND Location = '{$storeLocation}'
					AND UserNo = '{$_SESSION['UserNumber']}'";

		$result = mysqli_query($conn, $query);
		
		if ($result->num_rows == 0) {
			$query = "INSERT INTO grocerystores (UserNo, StoreName, Location) VALUES (
						'{$_SESSION['UserNumber']}', 
						'{$storeName}', 
						'{$storeLocation}')";
			if (!mysqli_query($conn, $query)) {
				echo "Failed to store into grocerystore <br>";
			}	
		}
	}
}
?>
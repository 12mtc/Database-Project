<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include('db_connection.php');

// Gets the main array building query; selecs basic information
$mainQuery = "SELECT u.UserName, r.MealTime, r.RecipeName, r.RecipeNum
			FROM recipebook r
			LEFT JOIN user u ON r.AuthorNo = u.UserNo";
// Gets the first sub-array, ingredients
$ingQuery = "SELECT r.RecipeNum, f.FoodName, ing.Quantity
			FROM recipebook r
			LEFT JOIN ingredients ing ON r.RecipeNum = ing.RecipeNum
			INNER JOIN foodtype f ON ing.IngredientNum = f.FoodNum";
// Gets the second sub-array, instructions
$insQuery = "SELECT r.RecipeNum, i.InstructionNum, i.Instruction
			FROM recipebook r
			LEFT JOIN instructions i ON r.RecipeNum = i.RecipeNum";
			
// Defines the main array for the new json file
$json_array = array();
$count = 1;

// Queries for the main array
$mainResult = mysqli_query($conn, $mainQuery);

// Loops through each row of the query, each row being one recipe and its basic information
while($row = mysqli_fetch_assoc($mainResult)) {
	
	// Instantiates the sub-array for the ingredients
	$ingredientArray = array();
	$ingredientResult = mysqli_query($conn, $ingQuery);
	
	// Loops through each row for the first sub-array, each row being the recipe number, the food name, and the quantity of the food
	while ($rowTwo = mysqli_fetch_assoc($ingredientResult)) {
		// If the recipe number of the current sub-array row matches the recipe number of the current row in the main array
		if ($rowTwo['RecipeNum'] == $row['RecipeNum']) {
			// Set a new cell in the associative array for the ingredients
			// The cell label being the food's name, and the value of the cell being the quantity
			$ingredientArray[$rowTwo['FoodName']] = $rowTwo['Quantity'];
		}
	}
	// Makes a new cell in the main array for the current row to the new array for ingredients
	$row["Ingredients"] = $ingredientArray;
	
	// Functions the same as the ingredient array, just for instructions instead
	$instructionArray = array();
	$instructionResult = mysqli_query($conn, $insQuery);
	while ($rowThree = mysqli_fetch_assoc($instructionResult)) {
		if ($rowThree['RecipeNum'] == $row['RecipeNum'] AND !is_null($rowThree['InstructionNum']) AND !is_null($rowThree['Instruction'])) {
			$instructionArray[$rowThree['InstructionNum']] = $rowThree['Instruction'];
		}
	}
	$row["Instructions"] = $instructionArray;
	
	// Adds the current row, including all the basic information about the current recipe, and the instrucions / ingredients in sub arrays
	$json_array["recipe" . $count] = $row;
	$count++; 
}

echo json_encode($json_array);
?>
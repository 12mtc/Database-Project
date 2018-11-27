INSERT INTO `foodtype` (`FoodNum`, `FoodGroup`, `FoodName`, `FoodBrand`, `Barcode`) VALUES
(12, 'Vegetable', 'Brocoli', 'PC', '123'),
(13, 'Fruit', 'Apple', 'NoName', '124'),
(14, 'Dairy', 'Milk', 'Janes', '125'),
(15, 'Grain', 'Bread', 'PC', '26'),
(16, 'Meat', 'Chicken', 'Janes', '1232'),
(17, 'Vegetable', 'Mushroom', 'Schnieder', '1567');

INSERT INTO `user` (`UserNo`, `UserName`, `Password`, `Email`, `Phone`, `Location`, `PantryNo`) VALUES
(2, 'Adam', 'adam123', 'adam@yahoo.ca', 333333555, 'toronto', 2),
(3, 'Jonas', 'jonas123', 'jonas@yahoo.ca', 234323333, 'oshawa', 3),
(4, 'Steve', 'steve123', 'steve@gmail.com', 234321234, 'ottawa', 4),
(5, 'Alice', 'alice123', 'alice@gmail.com', 123233243, 'windsor', 5),
(6, 'Jill', 'jil123', 'jill@yahoo.ca', 123459876, 'london', 6),
(7, 'Raj', 'raj123', 'raj@gmail.com', 145123489, 'quebec', 7);

INSERT INTO `recipebook` (`RecipeNum`, `AuthorNo`, `MealTime`, `RecipeName`) VALUES
(1, 2, 'dinner', 'macaroni and cheese with bacon'),
(2, 3, 'lunch', 'roast chicken'),
(3, 4, 'dinner', 'spaghetti with meatballs'),
(4, 5, 'breakfast', 'french toast'),
(5, 6, 'lunch', 'rice and chicken curry'),
(6, 7, 'lunch', 'stir fry with beef');

INSERT INTO `instructions` (`RecipeNum`, `InstructionNum`, `Instruction`) VALUES
(1, 1, 'boil macaroni pasta and drain it'),
(1, 2, 'heat some milk and add grated cheese, while stirring consistently.'),
(1, 3, 'cut bacon into small bits and cook them over medium heat. '),
(1, 4, 'add bacon bits to the cheese mix and add the pasta. '),
(4, 5, 'beat eggs with salt and pepper'),
(4, 6, 'add bread to the egg mix and make sure it\'s soaked well.'),
(4, 7, 'cook the bread over heated oil, making sure both sides are well cooked'),
(4, 8, 'serve with maple syrup if desired.');

INSERT INTO `pantry` (`PantryNo`, `FoodNum`, `Quantity`) VALUES
(2, 12, 2),
(3, 13, 1),
(4, 14, 4),
(5, 15, 2),
(6, 16, 1),
(7, 17, 2);

INSERT INTO `ingredients` (`RecipeNum`, `IngredientNum`, `Quantity`) VALUES
(1, '12', 1),
(1, '13', 1),
(1, '14', 1),
(1, '15', 2),
(4, '15', 2),
(4, '16', 4),
(4, '17', 1);







-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2018 at 05:59 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `foodtype`
--

DROP TABLE IF EXISTS `foodtype`;
CREATE TABLE IF NOT EXISTS `foodtype` (
  `FoodNum` int(11) NOT NULL,
  `FoodGroup` varchar(45) DEFAULT NULL,
  `FoodName` varchar(45) DEFAULT NULL,
  `FoodBrand` varchar(45) DEFAULT NULL,
  `Barcode` int(11) DEFAULT NULL,
  PRIMARY KEY (`FoodNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grocerystores`
--

DROP TABLE IF EXISTS `grocerystores`;
CREATE TABLE IF NOT EXISTS `grocerystores` (
  `StoreNo` int(11) NOT NULL AUTO_INCREMENT,
  `UserNo` int(11) NOT NULL,
  `StoreName` varchar(45) DEFAULT NULL,
  `Location` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`StoreNo`),
  KEY `fk_UserNo` (`UserNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `RecipeNum` int(11) NOT NULL,
  `IngredientNum` varchar(45) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`RecipeNum`,`IngredientNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

DROP TABLE IF EXISTS `instructions`;
CREATE TABLE IF NOT EXISTS `instructions` (
  `RecipeNum` int(11) NOT NULL,
  `InstructionNum` int(11) NOT NULL,
  `Instruction` longtext,
  PRIMARY KEY (`RecipeNum`,`InstructionNum`),
  KEY `fk_recipeNum_idx` (`RecipeNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pantry`
--

DROP TABLE IF EXISTS `pantry`;
CREATE TABLE IF NOT EXISTS `pantry` (
  `PantryNo` int(11) NOT NULL,
  `FoodNum` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`PantryNo`,`FoodNum`),
  KEY `fk_foodNo` (`FoodNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recipebook`
--

DROP TABLE IF EXISTS `recipebook`;
CREATE TABLE IF NOT EXISTS `recipebook` (
  `RecipeNum` int(11) NOT NULL,
  `AuthorNo` int(11) DEFAULT NULL,
  `MealTime` varchar(45) DEFAULT NULL,
  `MealType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`RecipeNum`),
  KEY `fk_recipeNo_idk` (`RecipeNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserNo` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `PantryNo` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserNo`),
  KEY `fk_pantryNo_idx` (`PantryNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grocerystores`
--
ALTER TABLE `grocerystores`
  ADD CONSTRAINT `fk_UserNo` FOREIGN KEY (`UserNo`) REFERENCES `user` (`UserNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `fk_recipeNo` FOREIGN KEY (`RecipeNum`) REFERENCES `recipebook` (`RecipeNum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructions`
--
ALTER TABLE `instructions`
  ADD CONSTRAINT `fk_recipeNum` FOREIGN KEY (`RecipeNum`) REFERENCES `recipebook` (`RecipeNum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pantry`
--
ALTER TABLE `pantry`
  ADD CONSTRAINT `fk_foodNo` FOREIGN KEY (`FoodNum`) REFERENCES `foodtype` (`FoodNum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pantryNo` FOREIGN KEY (`PantryNo`) REFERENCES `user` (`PantryNo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

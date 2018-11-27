<?php
include('db_connection.php');
if (!isset($_SESSION)) {
	session_start();
}

$query = "SELECT * FROM user WHERE UserName = '" . $_SESSION["UserName"] . "'";
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);

$_SESSION['UserNumber'] = $userData["UserNo"];

//Sets the users pantry number if it has not yet been set
if (is_null($userData["PantryNo"])) {
	$query = "UPDATE user SET PantryNo = '" . $userData["UserNo"] . "' WHERE UserName = '" . $_SESSION["UserName"] . "'";
	if (!mysqli_query($conn, $query)) {
		echo "Failed to set PantryNo";
	}
}
$_SESSION['PantryNo'] = $userData["PantryNo"];
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

h1 {
    text-align: center;
}
h3 {
    text-align: right;
}

.bg-img {
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

body {
  background-image: url("background.jpg");
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

* {box-sizing: border-box;}

* {box-sizing: border-box}
.mySlides1 {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 900px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a grey background color */
.prev:hover, .next:hover {
  background-color: #f1f1f1;
  color: black;
}
/* Position text in the middle of the page/image */
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  font-size: 80px;
  border: 10px solid #f1f1f1;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 300px;
  padding: 20px;
text-align: center;}


<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="text/html; charset=iso-8859-2" http-equiv="Content-Type">

</style>
</head>

<body>

<div class="bg-image">
	<div class="topnav">
		<a class="active" href="welcome.php">Home</a>
		<a href="pantry.php">Pantry</a>
		<a href="recipes.php">Recipes</a>
		<a href="stores.php">Stores</a>
		<a href="logout.php">Logout</a>
	</div>
</div>

<div style="padding-left:16px">
 <h1> Welcome <?php echo $_SESSION["UserName"]; ?>! </h1><br>
</div>

<div class="slideshow-container">
  <div class="mySlides1">
    <img src="pasta.jpg" style="width:100%">
  </div>

  <div class="mySlides1">
    <img src="fish.jpg" style="width:100%">
  </div>

  <div class="mySlides1">
    <img src="taco.jpg" style="width:100%">
  </div>

  <a class="prev" onclick="plusSlides(-1, 0)">&#10094;</a>
  <a class="next" onclick="plusSlides(1, 0)">&#10095;</a>
</div>

<script>
var slideIndex = [1,1];
var slideId = ["mySlides1"]
showSlides(1, 0);
showSlides(1, 1);

function plusSlides(n, no) {
  showSlides(slideIndex[no] += n, no);
}

function showSlides(n, no) {
  var i;
  var x = document.getElementsByClassName(slideId[no]);
  if (n > x.length) {slideIndex[no] = 1}    
  if (n < 1) {slideIndex[no] = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex[no]-1].style.display = "block";  
}
</script>


</body>
</html>

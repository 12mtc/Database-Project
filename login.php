<?php
include('db_connection.php');

if (isset($_POST['login_btn'])) {
	$username = $_POST['UserName'];
	$password = $_POST['password_1'];
	
	if (empty($username)) { 
		Echo "Username is required <br>"; 
	}
	if (empty($password)) { 
		Echo "Password is required <br>"; 
	}
	
	$user_check_query = "SELECT * FROM user WHERE UserName='$username' AND password='$password' LIMIT 1";
	$user = mysqli_query($conn, $user_check_query);

	if ($user->num_rows > 0) {
		// Destroys session if one exists before login
		if (isset($_SESSION)) {
			session_destroy();
		}
		session_start();
		
		$_SESSION['UserName'] = $username;
		header('location: welcome.php');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<style>
	body, html {
	  height: 100%;
	  margin: 0;
	  font-family: Arial, Helvetica, sans-serif;
	}

	* {
	  box-sizing: border-box;
	}

	.bg-image {
	  /* The image used */
	  background-image: url("images/food.jpg");
	  
	  /* Add the blur effect */
	  filter: blur(8px);
	  -webkit-filter: blur(8px);
	  
	  /* Full height */
	  height: 100%; 
	  
	  /* Center and scale the image nicely */
	  background-position: center;
	  background-repeat: no-repeat;
	  background-size: cover;
	}

	/* Position text in the middle of the page/image */
	.bg-text {
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
	  color: white;
	  font-weight: bold;
	  border: 3px solid #f1f1f1;
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  z-index: 2;
	  width: 80%;
	  padding: 20px;
	  text-align: center;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>	
	<div class="bg-image"></div>

<div class="bg-text">

	<div class "header">
		<h2>Login</h2>
	</div>
	<form method="post" action="login.php">
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="UserName">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>

		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Not a member? <a href="register.php">Sign up</a>
		</p>	
	</form>
</div>	
</body>
</html>

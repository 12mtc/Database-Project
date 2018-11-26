<?php 
include('db_connection.php');

// initializing variable
$errors = array(); 

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = $_POST['UserName'];
  $email = $_POST['Email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
	Echo "Password Error";
  }
  
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE UserName='$username' OR Email='$email' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  
  if ($result->num_rows > 0) {
	  array_push($errors, "Already exists");
	  Echo "Already Exists";
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password_1);//encrypt the password before saving in the database
	$password = $password_1;
  	$query = "INSERT INTO user (UserName, Email, Password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($conn, $query);
  	header('location: login.php');
  }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>USER REGISTRATION</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class "header">
		<h2>Register</h2>
	</div>
	
	<form method="post" action="register.php">
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="UserName">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="text" name="Email">
		</div>
		<div class="input-group">
			<label>Enter Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Re-enter Password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" name="reg_user" class="btn">Register</button>
		</div>
		<p>
			Already a member? <a href="login.php">Sign in</a>
		</p>	
	</form>
</body>
</html>

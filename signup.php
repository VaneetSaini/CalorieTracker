<?php
session_start();

$host = "303.itpwebdev.com";
$user = "vsaini_user";
$pass = "Et73ni4369420!@#";
$db = "vsaini_final_db"; 
$error_message = "";


$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
	echo "$mysqli->connect_error";
	exit();
}

$mysqli->set_charset('utf8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM user_credentials WHERE email = '$email'";
	$results = $mysqli->query($sql);
	if ($results->num_rows > 0) {
		$error_message = "Email already registered";
	} else {
		$insert = "INSERT INTO user_credentials (email, password) VALUES ('$email', '$password');";
		$x = $mysqli->query($insert);
		$_SESSION['email'] = $email;
		header('Location: dashboard.php');
		exit();
	}
}

$mysqli->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Signup for CalorieTracker today to kickstart a healthy lifestyle. Enter your email and create a password to gain access to all the features we have.">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
  @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap');
</style>
	<link rel = "icon" href = 
	"" 
	type = "image/x-icon">
	<title>Get Started</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	<div id="navbar">
		<div id="title">
			<a href="login.php">CalorieTracker</a>
		</div>
		<div id="menu">
			<a id="sub" class="btn" href="user_login.php">Member Login <img src="img/right.png.png"></a>
		</div>
	</div>

	<div class="container" id="content">
		<div id="login-form">
			<form  id="form-part" method="POST" action="signup.php">
				<h3>Get Started</h3>
				<div class="form-group">
					<input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Create Password" required>
				</div>
				<button type="submit" id="dashbtn" class="btn">Register <img src="img/right.png.png"></button>
				<small id="error"><?php echo $error_message; ?></small>
			</form>
		</div>
	</div>

	

	<div id="footer">
		<p>&copy;2023 Vaneet Saini</p>
	</div>

</body>

</html>

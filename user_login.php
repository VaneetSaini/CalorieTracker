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


	$sql = "SELECT * FROM user_credentials WHERE email = '$email' AND password = '$password'";
	$results = $mysqli->query($sql);

	if ($results->num_rows > 0) {
		$user = $results->fetch_assoc();
		$_SESSION['email'] = $user['email'];
		header('Location: dashboard.php');
		exit();
	} else {
		$error_message = "Invalid credentials";

	}
}

$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Log in to access your account and manage your nutrition plan. Enter your email and password to securely sign in and track your progress towards your health goals.">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
  @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap');
</style>
	<link rel = "icon" href = 
	"" 
	type = "image/x-icon">
	<title>Member Login</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<style>
		#change-pass{
			margin-top: 5px;
		}
		#change-pass a{
			font-size: 0.8em;
			color: #Fd801d;
			font-weight: bold;
		}
		#change-pass a:hover {
			text-decoration: underline;
			color: #ff9f4d;
		}
	</style>
</head>
<body>
	<div id="navbar">
		<div id="title">
			<a href="login.php">CalorieTracker</a>
		</div>
		<div id="menu">
			<a id="sub" class="btn" href="signup.php">Get Started <img src="img/right.png.png"></a>
		</div>
	</div>

	<div class="container" id="content">
		<div id="login-form">
			<form  id="form-part" method="POST" action="user_login.php">
				<h3>Member Login</h3>
				<div class="form-group">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
				</div>
				<button type="submit" id="dashbtn" class="btn">Dashboard <img src="img/right.png.png"></button>
				<small id="error"><?php echo $error_message ?></small>
			
				<div class="text-center" id="change-pass"><a href="change.php">Change Password</a></div>
			</form>
		</div>
	</div>

	

	<div id="footer">
		<p>&copy;2023 Vaneet Saini</p>
	</div>

</body>

</html>

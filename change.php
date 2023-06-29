<?php 
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
	$new = $_POST['new-password'];

	$sql = "SELECT * FROM user_credentials WHERE email='$email' AND password='$password'";
	$rs = $mysqli->query($sql);
	if ($rs->num_rows > 0) {
		if ($password == $new) {
			$error_message = "New password cannot be the same.";
		} else {
			$update = "UPDATE user_credentials SET password='$new' WHERE email='$email'";
			$result = $mysqli->query($update);

			header('Location: user_login.php');
			exit();
		}

	} else {
		$error_message = "Invalid credentials.";
	}



	
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="
	Update your password and keep your account secure with this easy-to-use page. Simply enter your email, old password, and new password to update the database. You will be redirected to the login page to complete the process.">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap');
	</style>
	<link rel = "icon" href = 
	"" 
	type = "image/x-icon">
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<style>
		
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
			<form  id="form-part" method="POST" action="change.php">
				<h3>Change Password</h3>
				<div class="form-group">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Old Password" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="new-password" name="new-password" placeholder="New Password" required>
				</div>
				<button type="submit" id="dashbtn" class="btn">Update Password <img src="img/right.png.png"></button>
				<small id="error"><?php echo $error_message; ?></small>
			</form>
		</div>
	</div>

	

	<div id="footer">
		<p>&copy;2023 Vaneet Saini</p>
	</div>

</body>

</html>

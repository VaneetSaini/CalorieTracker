<?php 
session_start();
if (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
}

$cals = $_POST['maintenance'];

$host = "303.itpwebdev.com";
$user = "vsaini_user";
$pass = "Et73ni4369420!@#";
$db = "vsaini_final_db"; 


$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
	echo "$mysqli->connect_error";
	exit();
}

$mysqli->set_charset('utf8');

$sql = "SELECT m.* FROM maintenance m JOIN user_credentials uc ON m.id = uc.id WHERE uc.email = '$email'";
$rs = $mysqli->query($sql);
if ($rs->num_rows > 0) {
	$update = "UPDATE maintenance JOIN user_credentials ON maintenance.id = user_credentials.id SET maintenance.calories = '$cals' WHERE user_credentials.email = '$email'";
	$result_update = $mysqli->query($update);
} else {
	$insert = "INSERT INTO maintenance (id, calories) SELECT user_credentials.id, '$cals' FROM user_credentials WHERE user_credentials.email = '$email'";
	$result_insert = $mysqli->query($insert);
}

$mysqli->close();

?>
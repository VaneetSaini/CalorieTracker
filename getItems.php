<?php
session_start();
$email = $_SESSION['email'];

$host = "303.itpwebdev.com";
$user = "vsaini_user";
$pass = "Et73ni4369420!@#";
$db = "vsaini_final_db";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
	echo "$mysqli->connect_error";
	exit();
}

$sql = "SELECT ui.* FROM user_items ui JOIN user_credentials uc ON ui.user_id = uc.id WHERE uc.email = '$email'";
$results = $mysqli->query($sql);
if ($results->num_rows > 0) {
	while ($row = $results->fetch_assoc()) {
		$userItems[] = $row;
	}
	
}
echo json_encode($userItems); 

$mysqli->close();


?>
<?php 
session_start();
$email = $_SESSION['email'];
$item = $_POST['val'];
$day = $_POST['day'];

$host = "303.itpwebdev.com";
$user = "vsaini_user";
$pass = "Et73ni4369420!@#";
$db = "vsaini_final_db";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
	echo "$mysqli->connect_error";
	exit();
}

$sql = "DELETE ui FROM user_items ui JOIN user_credentials uc ON uc.id = ui.user_id WHERE uc.email = '$email' AND ui.item_name = '$item' AND ui.day ='$day'";
$results = $mysqli->query($sql);

$mysqli->close();

?>

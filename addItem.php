<?php
session_start();
$email = $_SESSION['email'];
$name = $_POST['name'];
$calories = $_POST['calories'];
$servings = $_POST['servings'];
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

$sql = "INSERT INTO user_items (user_id, item_name, calories, servings, day) SELECT id, '$name', '$calories', '$servings', '$day' FROM user_credentials WHERE email = '$email'";
$result = $mysqli->query($sql);



$mysqli->close();
?>
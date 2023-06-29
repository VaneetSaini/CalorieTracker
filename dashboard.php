<?php
session_start();
if (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
} 


$host = "303.itpwebdev.com";
$user = "vsaini_user";
$pass = "Et73ni4369420!@#";
$db = "vsaini_final_db";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
	echo "$mysqli->connect_error";
	exit();
}




$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Plan and track your meals with ease using our dashboard. Add items to your weekly plan, calculate your maintenance calories, and stay on top of your nutrition goals.">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<style>
		@import url('https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap');
	</style>
	<link rel = "icon" href = 
	"" 
	type = "image/x-icon">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Sigmar&display=swap" rel="stylesheet">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="landing.css">
	<style type="text/css">
		body {
			margin-top: 5.0em;
			padding-left: 10%;
			padding-right: 10%;
			margin-bottom: 10%;

		}
		.card-header {
			background-color: #Fd801d;
			color: #FFF;
			text-align: center;
			border-radius: 20px;
		}
		#header {
			margin-bottom: -10px;
			margin-left: 20px;
			
		}
		
		#sub-calc {
			background-color: #Fd801d;
			color: #FFF;
			border-radius: 30px;
			width: 100%;
		}
		#sub-calc:hover {
			background-color: #ff9f4d;
		}
		#calculator {
			margin-bottom: 10px;
		}
		span {
			color: red;
		}
		#cals {
			font-weight: bold;
		}
		#flex {
			display: flex;
			flex-direction: row;
		}
		#sub-food {
			background-color: #Fd801d;
			color: #FFF;
			border-radius: 30px;


		}
		#sub-food img {
			height: 20px;
			margin-bottom: 2px;
		}

		#sub-food:hover {
			background-color: #ff9f4d;
		}
		#sub-add {
			background-color: #Fd801d;
			color: #FFF;
			border-radius: 30px;
			width: 100%;
		}
		#sub-add:hover {
			background-color: #ff9f4d;
		}
		#message {
			color: green;
		}
		.plan {
			color: #Fd801d;
			font-weight: bold;
		}
		.plan:hover {
			text-decoration: underline;
			color: #ff9f4d;
		}
		#search-button {
			margin-right: 20px;
			color: #Fd801d;
			font-weight: bold;
		}
		#search-button:hover {
			text-decoration: underline;
			color: #ff9f4d;
		}




		
	</style>
</head>
<body>
	<div id="navbar">
		<div id="title">
			CalorieTracker
		</div>
		<div id="menu">
			<a id="sub" class="btn" href="logout.php">Member Logout <img src="img/right.png.png"></a>
		</div>
	</div>
	
	<div class="row" id="flex">
		<div class="col">
			<div class="row">
				<div class="col">
					<h3 id="header">Welcome <span id="color"><?php echo explode('@', $email)[0] ?></span></h3>
				</div>
				<div class="col text-right">
					<a id="search-button" href="search.php" class="btn">Nutrition Database</a>
				</div>
			</div>
			
		</div>

	</div>
	<div class="container-fluid mt-3" id="con">
		<div class="row">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header">
						Add To Weekly Meal
					</div>
					<div class="card-body">
						<div id="add">
							<small class="warning text">Add a meal to your weekly meal plan by filling out the form below.</small>
							<form id="add-form">
								<div class="form-group">
									<input type="text" class="form-control" id="name" name="name" required placeholder="Item Name">
								</div>
								<div class="form-group">
									<input type="number" class="form-control" id="calories" name="calories" required placeholder="Calories per Serving" min="0">
								</div>
								<div class="form-group">
									<input type="number" class="form-control" id="servings" name="servings" required placeholder="Servings" min="1">
								</div>
								<div class="form-group">
									<select class="form-control" id="day" name="day" required>
										<option value="Sunday">Sunday</option>
										<option value="Monday">Monday</option>
										<option value="Tuesday">Tuesday</option>
										<option value="Wednesday">Wednesday</option>
										<option value="Thursday">Thursday</option>
										<option value="Friday">Friday</option>
										<option value="Saturday">Saturday</option>
									</select>
								</div>
								<button type="submit" id="sub-add" class="btn">Add Item</button>
								<div class="row">
									<div class="col text-center">
										<small id="succ" class="text-success"></small>
									</div>
								</div>
								<div class="row">
									<div class="col text-center">
										<a class="btn plan" href="plan.php">View your meal plan</a>
									</div>
									<div class="col text-center">
										<a class="btn plan" href="recipe.php">Search for recipes</a>
									</div>
								</div>
								
								
								

							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-header">
						Maintenance Calorie Calculator
					</div>
					<div class="card-body">
						<div id="calculator">
							<small class="warning"><span>*</span>You should adjust your intake depending on your goals.</small>
							<form id="form-calculator">
								<div class="form-group">
									<input type="number" class="form-control" id="age" name="age" required placeholder="Age" min="18">
								</div>
								<div class="form-group">
									<input type="number" class="form-control" id="weight" name="weight" required placeholder="Weight (lbs)" min="50" max="600">
								</div>
								<div class="form-group">
									<input type="number" class="form-control" id="height" name="height" required placeholder="Height (in)" min="36" max="108">
								</div>
								<div class="form-group">
									<select class="form-control" id="gender" name="gender" required>
										<option value="male">Male</option>
										<option value="female">Female</option>
									</select>
								</div>
								
								<button type="submit" id="sub-calc" class="btn">Calculate</button>
							</form>
							<small>Your daily maintenance calories: <span id="cals"></span></small>


						</div>

						

					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="footer">
		<p>&copy;2023 Vaneet Saini</p>
	</div>
	
	<script type="text/javascript">

		function getEmail(callback) {
			$.ajax({
				type: "GET",
				url: "getEmail.php",
				success: function(response) {
					callback(response);
				}
			});
		}
		getEmail(function(email) {
			console.log(email); 
		});


		
		var add = document.querySelector('#add-form').addEventListener("submit", function(event){
			event.preventDefault();
			var name = document.querySelector('#name').value.trim();
			var calories = document.querySelector('#calories').value.trim();
			var servings = document.querySelector('#servings').value.trim();
			var day = document.querySelector('#day').value.trim();
			console.log(day);

			$.ajax({
				type: "POST",
				url: "addItem.php",
				data: {
					name: name,
					calories: calories,
					servings: servings,
					day: day
				},
				success: function(response) {
					console.log("success");
					document.querySelector('#succ').innerHTML = 'Added Item!';
					setTimeout(function() {
						document.querySelector('#succ').innerHTML = '';
					}, 1000);
					
				},
				error: function(xhr, status, error) {
					console.log("error");
				}

			})



			document.querySelector('#name').value = '';
			document.querySelector('#calories').value = '';
			document.querySelector('#servings').value = '';
			document.querySelector('#day').value = 'Sunday';
		})


		var sub = document.querySelector('#form-calculator').addEventListener("submit", function(event){
			event.preventDefault();
			var age = document.querySelector('#age').value.trim();
			var weight = document.querySelector('#weight').value.trim();
			var height = document.querySelector('#height').value.trim();
			var gender = document.querySelector('#gender').value.trim();
			var bmr = 0;
			var maintenance = 0;
			if (gender == "male") {
				weight = parseInt(weight) / 2.205;
				height = parseInt(height) * 2.54;
				bmr = 66.47 + (parseInt(weight) * 13.75) + (5.003 * parseInt(height)) - (6.755 * parseInt(age));
				maintenance = parseInt(bmr) * 1.375;
			}
			if (gender == "female") {
				weight = parseInt(weight) / 2.205;
				height = parseInt(height) * 2.54;
				bmr = 655.1 + (parseInt(weight) * 9.563 ) + (1.850 * parseInt(height)) - (4.676 * parseInt(age));
				maintenance = parseInt(bmr) * 1.375;
			}
		
			var cals = document.querySelector('#cals');
			cals.innerHTML = parseInt(maintenance);
			$.ajax({
				type: 'POST',
				url: 'maintain.php',
				data: {
					maintenance: maintenance
				},
				success: function(response) {
					console.log("good");
				},
				error: function(xhr, status, error) {
					console.log("error");
				}

			});
			document.querySelector('#age').value = '';
			document.querySelector('#weight').value = '';
			document.querySelector('#height').value = '';
			document.querySelector('#gender').value = 'male';

		})
	</script>

</body>
</html>

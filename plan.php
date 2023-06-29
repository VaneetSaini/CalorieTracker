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
$mysqli->set_charset('utf8');

$sql = "SELECT m.* FROM maintenance m JOIN user_credentials uc ON m.id = uc.id WHERE uc.email = '$email'";
$rs = $mysqli->query($sql);
if ($rs->num_rows > 0) {
	while ($row = $rs->fetch_assoc()) {
		$calories = $row['calories'];
	}
}

$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Plan your meals and stay on track with your nutrition goals using our weekly planner. The planner allows you to view items you added and remove them. Each week the planner will update.">
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
	<title>Weekly Schedule</title>
	<link rel="stylesheet" type="text/css" href="landing.css">
	<style type="text/css">
		body {
			margin-top: 5.0em;
			padding-left: 5%;
			padding-right: 5%;

		}
		.card-header {
			background-color: #Fd801d;
			color: #FFF;
			text-align: center;
			border-radius: 20px;
		}
		.card {
			margin-bottom: 60px;
		}

		.day-content {
			margin-top: 5px;
		}

		ul {
			margin-top: 10px;
		}
		p {
			margin-top: 10px;
		}
		li {
			font-size: 0.8em;
		}
		.delete{
			cursor: pointer;
		}
		.delete:hover {
			color: red;
			
		}


		
	</style>
</head>
<body>
	<div id="navbar">
		<div id="title">
			CalorieTracker
		</div>
		<div id="menu">
			<a id="sub" class="btn" href="dashboard.php">Dashboard <img src="img/right.png.png"></a>
		</div>
	</div>

	<div class="container-fluid mt-3" id="con">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">
						Weekly Meal Plan <br><small id="week"></small><br><small>Your Daily Maintenance: <?php echo $calories; ?></small>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col">
								<div class="text-center">Sunday</div>
								<ul class="list-group" id="Sunday">
									<!-- <li class="list-group-item">Spinach<span class="float-right delete">x</span></li> -->

								</ul>
							</div>
							<div class="col">
								<div class="text-center">Monday</div>
								<ul class="list-group" id="Monday">
									<!-- <li class="list-group-item">Spinach<span class="float-right delete">x</span></li> -->

								</ul>
							</div>
							<div class="col">
								<div class="text-center">Tuesday</div>
								<ul class="list-group" id="Tuesday">
									<!-- <li class="list-group-item">Spinach<span class="float-right delete">x</span></li> -->

								</ul>
							</div>
							<div class="col">
								<div class="text-center">Wednesday</div>
								<ul class="list-group" id="Wednesday">
									<!-- <li class="list-group-item">Spinach<span class="float-right delete">x</span></li> -->

								</ul>
							</div>
							<div class="col">
								<div class="text-center">Thursday</div>
								<ul class="list-group" id="Thursday">
									


								</ul>
							</div>
							<div class="col">
								<div class="text-center">Friday</div>
								<ul class="list-group" id="Friday">
									<!-- <li class="list-group-item">Spinach<span class="float-right delete">x</span></li> -->

								</ul>
							</div>
							<div class="col">
								<div class="text-center">Saturday</div>
								<ul class="list-group" id="Saturday">
									<!-- <li class="list-group-item">Spinach<span class="float-right delete">x</span></li> -->

								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="footer">
		<p>&copy;2023 Vaneet Saini</p>
	</div>



</body>
<script>
	$.ajax({
		type: "GET",
		url: "getItems.php",
		success: function(response) {

			var userItems = JSON.parse(response);
			var daily = {};
			for (var i = 0; i < userItems.length; i++) {
				var item = userItems[i];
				var name = item.item_name;
				var day = item.day;
				var servings = parseInt(item.servings);
				var calories = parseInt(item.calories);
				var cals = parseInt(calories * servings);
				if (day in daily) {
					daily[day] += cals;
				} else {
					daily[day] = cals;
				}
				if (day === "Sunday") {
					const listItem = document.createElement('li');
					listItem.classList.add("list-group-item");
					listItem.innerHTML = `<span class="list-item">${name}</span><span class="float-right delete">x</span>`;

					document.querySelector('#Sunday').appendChild(listItem);
				}
				if (day === "Monday") {
					const listItem = document.createElement('li');
					listItem.classList.add("list-group-item");
					listItem.innerHTML = `<span class="list-item">${name}</span><span class="float-right delete">x</span>`;

					document.querySelector('#Monday').appendChild(listItem);
				}
				if (day === "Tuesday") {
					const listItem = document.createElement('li');
					listItem.classList.add("list-group-item");
					listItem.innerHTML = `<span class="list-item">${name}</span><span class="float-right delete">x</span>`;

					document.querySelector('#Tuesday').appendChild(listItem);
				}
				if (day === "Wednesday") {
					const listItem = document.createElement('li');
					listItem.classList.add("list-group-item");
					listItem.innerHTML = `<span class="list-item">${name}</span><span class="float-right delete">x</span>`;

					document.querySelector('#Wednesday').appendChild(listItem);
				}
				if (day === "Thursday") {
					const listItem = document.createElement('li');
					listItem.classList.add("list-group-item");
					listItem.innerHTML = `<span class="list-item">${name}</span><span class="float-right delete">x</span>`;

					document.querySelector('#Thursday').appendChild(listItem);
				}
				if (day === "Friday") {
					const listItem = document.createElement('li');
					listItem.classList.add("list-group-item");
					listItem.innerHTML = `<span class="list-item">${name}</span><span class="float-right delete">x</span>`;

					document.querySelector('#Friday').appendChild(listItem);
				}
				if (day === "Saturday") {
					const listItem = document.createElement('li');
					listItem.classList.add("list-group-item");
					listItem.innerHTML = `<span class="list-item">${name}</span><span class="float-right delete">x</span>`;

					document.querySelector('#Saturday').appendChild(listItem);
				}

				

			}
			
			for (let day in daily) {
				const pItem = document.createElement('p');
				pItem.classList.add('text-center');
				pItem.innerHTML = `<strong>Cal: </strong>${daily[day]}`;
				document.querySelector(`#${day}`).appendChild(pItem);
			}

			var deleteButtons = document.querySelectorAll('.delete');
			deleteButtons.forEach(function(button) {
				button.addEventListener('click', function(event) {
					const item = event.target.closest('.list-group-item');
					const val = item.textContent.trim().split('x')[0];
					const day = item.parentNode.id;


					if (item) {
						console.log(val);
						console.log(day);
					}
					$.ajax({
						type: 'POST',
						url: "deleteItem.php",
						data: {
							day: day,
							val: val
						},
						success: function(response) {
							location.reload();
						},
						error: function(xhr, status, error) {
							console.log("error");
						}
					})
				});
			});

			
			
			
		}

	})

	const today = new Date();
	const firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
	const lastDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 6));

	const options = { month: 'short', day: 'numeric' };
	const week = `${firstDayOfWeek.toLocaleDateString('en-US', options)} - ${lastDayOfWeek.toLocaleDateString('en-US', options)}`;
	document.querySelector('#week').innerHTML = week;
	
</script>

</html>

<?php
session_start();
$email = $_SESSION['email'];
$user = explode('@', $email)[0];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Search out extensive database for detailed caloric and nutritional information on any item. Simply enter keywords and click the item to view a rundown on diatery information.">
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
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="landing.css">
	<style type="text/css">
		body {
			margin-top: 10%;
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
		.card-body {
			background-color: #fff;
		}
		#sub-search {
			background-color: #Fd801d;
			color: #FFF;
			border-radius: 30px;
			width: 30%;
		}
		#sub-search:hover {
			background-color: #ff9f4d;
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
			
			<div class="col-lg-12">
				
				<div class="card">
					<div class="card-header">
						Nutritional Information
					</div>
					<div class="card-body">
						<div id="search">
							<small>Search for nutritional information based on item name.</small>

							<form id="search-form">
								<br>
								<div class="form-group">
									<input type="text" class="form-control" id="name" name="name" required placeholder="Query Parameter">
								</div>
								<div class="text-center">
									<button type="submit" id="sub-search" class="btn">Search</button>
								</div>
								
								
							</form>
							<br>
							<div id="results" class="text-center">

							</div>

							
						</div>

						

					</div>
				</div>
				<br>
				
				
			</div>
			
		</div>
		

	</div>
	

	<div id="footer">
		<p>&copy;2023 Vaneet Saini</p>
	</div>

	<script type="text/javascript">

		$('#search-form').submit(function(event) {
				event.preventDefault();
				var query = $('#name').val().trim();

				var endpoint = "https://api.nal.usda.gov/fdc/v1/foods/search?api_key=VvhJ1Yjh5zF8DuynFLoowibf4D6MnXaWjZG4DL4G&query=" + encodeURIComponent(query);
				console.log(endpoint);
				$.ajax ({
					type: 'GET',
					async: false,
					url: endpoint,
					dataType: 'JSON',
					success: function(response) {
						$('#name').val('');
						console.log(response);
						if (response.totalHits == 0) {
							$('#results').text('No Results Found');
						} else {
							var table = $('<table>');
            table.append('<tr><th>Food Nutrient</th><th>Amount</th><th>Unit</th></tr>');
            table.addClass('text-center mx-auto');

            for (var i = 0; i < Math.min(10, response.foods[0].foodNutrients.length); i++) {
                var nutrient = response.foods[0].foodNutrients[i];
                var row = $('<tr>');
                row.append($('<td>').text(nutrient.nutrientName));
                row.append($('<td>').text(nutrient.value));
                row.append($('<td>').text(nutrient.unitName));
                table.append(row);
            }
            $('#results').html(table);
						}
					}
				})

			});



		



	</script>

</body>



</html>

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
	<meta name="description" content="Discover new and delicious recipes you would enjoy. Search through this extensive API of recipes using keywords and find the perfect meal for any occasion.">
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
	<title>Recipes</title>
	<link rel="stylesheet" type="text/css" href="landing.css">
	<style type="text/css">
		body {
			margin-top: 10%;
			padding-left: 10%;
			padding-right: 10%;
			margin-bottom: 10%;

		}
		
		.overlay img {
			height: 200px;
			width: auto;
			filter: grayscale(40%);
			border-radius: 20px;
			margin-bottom: 20px;


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
		.show {
			visibility: hidden;
		}
		img:hover + .show{
			visibility: visible;
		}
		#results {
			margin: 20px auto;
			max-width: 800px;
			border: 1px solid #ddd;
			border-radius: 4px;
			overflow: hidden;
		}
		table {
			width: 100%;
		}

		#results th {
			background-color: #Fd801d;
			color: white;
			padding: 12px;
			text-align: center;

		}

		#results td {
			border-bottom: 1px solid #ddd;
			padding: 12px;
			text-align: center;
		}

		#results tr:hover {
			background-color: #f5f5f5;
		}

		#results img {
			max-width: 100px;
			max-height: 100px;
			margin: 0 auto;
			display: block;
		}
		#pagination {
			text-align: center;
		}

		#pagination a {
			display: inline-block;
			padding: 5px 10px;
			margin: 0 5px;
			background-color: #f9f9f9;
			border: 1px solid #ddd;
			border-radius: 4px;
			color: #555;
		}

		#pagination a:hover {
			background-color: #ddd;
		}
		#pagination .active {
			background-color: darkgrey;
		}
		#recipe-details {

		}
		ul {
			list-style-type: none;
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
						Recipe Search
					</div>
					<div class="card-body">
						<div id="search">
							<small>Search for foods based on name and select item for recipe details.</small>

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
							<div id="pagination"></div>

							
						</div>

						

					</div>
				</div>
				<br>
				
				
			</div>
			
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<div id="recipe-details">
					<h2 id="recipe-title"></h2>
					<h3>Ingredients:</h3>
					<ul id="recipe-ingredients"></ul>
					<h3>Instructions:</h3>
					<p id="recipe-instructions"></p>
				</div>
			</div>
		</div>

	</div>
	

	<div id="footer">
		<p>&copy;2023 Vaneet Saini</p>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			var currentPage = 1;
			var itemsPerPage = 3;

			function displayResults(results) {
				$('#results').empty();
				var startIndex = (currentPage - 1) * itemsPerPage;
				var endIndex = startIndex + itemsPerPage;

				var table = $('<table>');
				var tableHeader = $('<tr>');
				tableHeader.append($('<th>').text('Item'));
				tableHeader.append($('<th>').text('Image'));
				table.append(tableHeader);

				for (var i = startIndex; i < endIndex && i < results.length; i++) {
					var meal = results[i];
					var row = $('<tr>');
					row.append($('<td>').text(meal.strMeal));
					row.append($('<td>').append($('<img>').attr('src', meal.strMealThumb)));
					row.click((function(meal) {
						return function() {
							console.log(meal.idMeal);
							var end = "https://www.themealdb.com/api/json/v1/1/lookup.php?i=" + meal.idMeal;
							console.log(end);
							$('html, body').animate({
								scrollTop: $('#recipe-details').offset().top
							}, 1000);

							$.ajax({
								type: 'GET',
								url: end,
								success: function(response) {
									console.log(response);
									$('#recipe-title').text(meal.strMeal);
									var ingredients = [];
									for (var i = 1; i <= 20; i++) {
										var ingredient = meal['strIngredient' + i];
										var measure = meal['strMeasure' + i];
										if (ingredient && measure) {
											ingredients.push(measure + ' ' + ingredient);
										}
									}
									$('#recipe-ingredients').empty();
									for (var i = 0; i < ingredients.length; i++) {
										$('#recipe-ingredients').append($('<li>').text(ingredients[i]));
									}

									$('#recipe-instructions').text(meal.strInstructions);
								},
								error: function(xhr, status, error) {
									console.log("error");
								}

							})
						};
					})(meal));
					table.append(row);
				}


				$('#results').append(table);

				var totalPages = Math.ceil(results.length / itemsPerPage);
				$('#pagination').empty();
				for (var i = 1; i <= totalPages; i++) {
					var link = $('<a>').text(i);
					if (i == currentPage) {
						link.addClass('active');
					}
					link.click(function() {
						currentPage = parseInt($(this).text());
						displayResults(results);
						$('html, body').animate({
								scrollTop: $('#name').offset().top
							}, 1000);
					});
					$('#pagination').append(link);
				}
			}

			$('#search-form').submit(function(event) {
				event.preventDefault();
				var query = $('#name').val().trim();
				var endpoint = 'https://www.themealdb.com/api/json/v1/1/search.php?s=' + query;

				$.ajax({
					type: 'GET',
					url: endpoint,
					async: false,
					dataType: 'JSON',
					success: function(response) {
						$('#name').val('');
						console.log(response);
						if (!response.meals) {
							$('#results').text('No Results Found');
						} else {
							displayResults(response.meals);

						}
					},
					error: function(xhr, status, error) {
						console.log('Error:', error);
					}
				});
			});
		});

	</script>



</body>


</html>

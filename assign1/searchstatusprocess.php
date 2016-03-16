<!DOCTYPE html>
<html>
	<head>

		<!-- Stylesheets -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<!-- /Stylesheets -->

		<!-- Meta -->
		<meta charset="UTF-8">
		<meta name="description" content="Web Development Assignment 1">
		<meta name="keywords" content="HTML,CSS,JavaScript,PHP">
		<meta name="author" content="Jack Witbrock Finlay">
		<!-- /Meta -->

		<title>Search Status Results</title>
	</head>
	<body>
		<div class="container">
			<h1>Status Posting System</h1>
			<div>
			<?php
				$searchString = $_GET["searchString"];
				$servername   = "localhost";
				$username     = "username";
				$password     = "password";
				$dbname       = "dbname";



				
			?>
			</div>
			<a href="searchstatusform.php">Search for another status</a>
			<a href="index.php" class="pull-right">Return to Home Page</a>
		</div>

	</body>
</html>
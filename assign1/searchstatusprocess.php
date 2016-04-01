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

					require 'constants.php';
					require 'helperfunctions.php';
					
					run(); //Declared and run as function so that return can be called, halting processing of PHP, but allowing parsing of HTML to continue.

					function run(){

						$servername = SERVER;
						$username 	= USERNAME;
						$password 	= PASSWORD;
						$dbname		= DBNAME;

						if (empty($_GET['searchString'])) {
							echo "<p>Search string is empty. Please enter a value.</p>";
							return;
						}

						$connection =  mysqli_connect($servername, $username, $password, $dbname); // Create new DB connection.

						if (!$connection) {
						    echo "<p>Unable to connect to database: " . mysqli_connect_error() . "</p>";
						    return;
						} 

						if (!checkTableExists($connection)) {
							echo "<p>Unable to create or find database table, please try again.</p>";
							return;
						}

						if (!getSearchResults($connection)){
							echo "<p>Unable to find status, please try again or use another search phrase.</p>";
						}

						mysqli_close($connection);
						
					}

				?>
			</div>
			<br/>
			<a href="searchstatusform.php">Search for another status</a>
			<a href="index.php" class="pull-right">Return to Home Page</a>
		</div>

	</body>
</html>
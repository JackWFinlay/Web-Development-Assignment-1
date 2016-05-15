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
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="poststatusform.php">Post</a></li>
				<li><a href="searchstatusform.php">Search</a></li>
				<li><a href="about.php">About</a></li>
			</ul>
		</nav>
		<div class="container">
			<h1>Status Posting System</h1>
			<div>
				<?php

					require_once 'settings.php';
					require_once 'helperfunctions.php';
					
					run(); //Declared and run as function so that return can be called, halting processing of PHP, but allowing parsing of HTML to continue.

					function run(){
						global $host, $user, $password, $dbname;

						if (empty($_GET['searchString'])) {
							echo "<p>Search string is empty. Please enter a value.</p>";
							return;
						}

						$connection =  mysqli_connect($host, $user, $password, $dbname); // Create new DB connection.

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
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
				require 'helperfunctions.php';
				run();

				function run(){
					$servername = "localhost";
					$username 	= "root";
					$password 	= "";
					$dbname		= "fhp0351_Ass1_DB";

					if (empty($_GET['searchString'])) {
						echo "<p>Search string is empty. Please enter a value.";
						return;
					}

					$connection = new mysqli($servername, $username, $password); // Create new DB connection.

					if ($connection->connect_error) {
					    echo "<p>Unable to connect to database: " . $connection->connect_error . "</p>";
					    return;
					} 

					if (!checkDBExists($connection)) {
						echo "<p>Unable to find or create database, please try again.</p>";
						return;
					}

					$connection->select_db($dbname);

					if (!checkTableExists($connection)) {
						echo "<p>Unable to create or find database table, please try again.</p>";
						return;
					}

					if (!getSearchResults($connection)){
						echo "<p>Unable to find status try again.</p>";
					}

					$connection->close();
				}
			?>
			</div>
			<br/>
			<a href="searchstatusform.php">Search for another status</a>
			<a href="index.php" class="pull-right">Return to Home Page</a>
		</div>

	</body>
</html>
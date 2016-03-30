<!DOCTYPE html>
<html>
	<head>

		<!-- Stylesheets -->
		

		<link rel="stylesheet" type="text/css" href="style.css">
		<!-- /Stylesheets -->

		<!-- Meta -->
		<meta charset="UTF-8">
		<meta name="description" content="Web Development Assignment 1">
		<meta name="keywords" content="HTML,CSS,JavaScript, PHP">
		<meta name="author" content="Jack Witbrock Finlay">
		<!-- /Meta -->

		<title>Post Status Process</title>
	</head>
	<body>
		<div class="container">
			<h1>Status Posting System</h1>
			<?php

				require 'constants.php';
				require 'helperfunctions.php';
				
				run(); //Declared and run as function so that return can be called, halting processing of PHP, but allowing parsing of HTML to continue.

				function run(){
					
					$servername = SERVER;
					$username 	= USERNAME;
					$password 	= PASSWORD;
					$dbname		= DBNAME;

					if (!isDataValid()){
						return;
					}
					
					$connection = new mysqli($servername, $username, $password, $dbname); // Create new DB connection.

					if ($connection->connect_error) {
					    echo "<p>Unable to connect to database: " . $connection->connect_error . "</p>";
					    return;
					}

					if (!checkTableExists($connection)) {
						echo "<p>Unable to create or find database table, please try again:" . $connection->error . "</p>";
						return;
					}
					
					if (!isStatusCodeUnique($connection)) {
						$statusCode = $_POST["statusCode"];
						echo "<p>The statusCode $statusCode is not unique.</p>";
						return;
					}
					
					if (!insertStatus($connection)) {
						echo "<p>Unable to post status try again: " . $connection->error . "</p>";
						return;
					}

					$connection->close();

					echo "<p>Status was successfully posted!</p>";

				}

			?>
			
			<a href='poststatusform.php'>Return to Post Status form</a><br/>
			<a href="index.php">Return to Home Page</a>
		</div>
	</body>
</html>


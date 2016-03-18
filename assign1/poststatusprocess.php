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
				require 'helperfunctions.php';
				run();

				function run(){
					$servername = "localhost";
					$username 	= "root";
					$password 	= "";

					if (!isDataValid()){
						return;
					}
					
					$connection = new mysqli($servername, $username, $password); // Create new DB connection.

					if ($connection->connect_error) {
					    echo "<p>Unable to connect to database: " . $connection->connect_error . "</p>";
					    return;
					} 

					if (!isStatusCodeUnique($connection)) {
						$statusCode = $_POST["statusCode"];
						echo "<p> The statusCode $statusCode is not unique.</p>";
						return;
					}

					if (!checkDBExists($connection)) {
						return;
					}

					$connection->select_db("fhp0351_Ass1_DB");

					if (!checkTableExists($connection)) {
						return;
					}

					if (!insertStatus($connection)) {
						echo "<p>Unable to post status.";
						echo "<a href='poststatusform.php' class='display-block'>Return to post status form</a><br/>";
						return;
					}

					echo

					$connection->close();
				}
			?>
			
			<a href="index.php">Return to Home Page</a>
		</div>
	</body>
</html>


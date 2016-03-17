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
				function processStatus() {
					// Regular Expressions
					$statusCodePattern = '/^S\d{4}$/';
					$statusPattern     = '/^[a-zA-Z0-9\s!,\?\.]*$/';
					$datePattern       = '/^\d{1,2}\/\d{1,2}\/\d{4}$/';

					if (empty($_POST["statusCode"])){ // Print message if statusCode is not specified.
						echo "<p>Status Code not specified</p>";
					}

					if (empty($_POST["status"])){
						echo "<p>Status not specified</p>";
					}

					if (empty($_POST["date"])){
						echo "<p>Date not specified</p>";
					}

					if (empty($_POST["statusCode"]) ||
						empty($_POST["status"]) ||
						empty($_POST["date"])){ // Display link back to poststatus form if any value is empty.

						echo "<a href='poststatusform.php' class='display-block'>Try again</a><br/>";
						return; // Stop processing php section.
					} 


					$statusCode   = $_POST["statusCode"]; 
					$status       = $_POST["status"];
					$date         = $_POST["date"];
					$share        = isset($_POST["share"]) ? $_POST["share"] : "Public"; //Default to public if not set
					$allowLike	  = isset($_POST["allowLike"]) ? $_POST["allowLike"] : FALSE; //FALSE if not set;
					$allowComment = isset($_POST["allowComment"]) ? $_POST["allowComment"] : FALSE;
					$allowShare   = isset($_POST["allowShare"]) ? $_POST["allowShare"] : FALSE;

					// Check that code, status, and date match patterns
					if ((preg_match($statusCodePattern, $statusCode)) &&
						(preg_match($statusPattern, $status)) &&
					 	(preg_match($datePattern, $date))) {

					 	echo "<p>$statusCode, $status, $date<p>";
					} else {
						echo "<p>Failure.</p>";
					}
				}

				processStatus();
			?>
			
			<a href="index.php">Return to Home Page</a>
		</div>
	</body>
</html>


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
				// Regular Expressions
				$statusCodePattern = '/^S\d{4}$/';
				$statusPattern     = '/^[a-zA-Z0-9\s!,\?\.]*$/';
				$datePattern       = '/^\d{1,2}\/\d{1,2}\/\d{4}$/';

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

			?>

		</div>
	</body>
</html>


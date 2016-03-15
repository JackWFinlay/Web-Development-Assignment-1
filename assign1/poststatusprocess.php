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
			<?php
				$statusCodePattern = "/^S\d{4}$/";
				$statusPattern = "/^[a-zA-Z0-9\s!,\?\.]*$/";
				$datePattern = "/\d{1,2}\/\d{1,2}\/\d{4}/";

				$statusCode = $_POST["statusCode"];
				$status = $_POST["status"];
				$date = $_POST["date"];



				if ((preg_match($statusCodePattern, $statusCode)) &&
					(preg_match($statusCodePattern, $status)) &&
				 	(preg_match($datePattern, $date))) {

				 	echo "<p> $statusCode, $status, $date <p>";
				} else {
					echo "<p>Failure.</p>";
				}

			?>
		</div>



	</body>
</html>


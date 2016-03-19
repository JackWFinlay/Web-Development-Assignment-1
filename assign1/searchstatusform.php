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

		<title>Search Status</title>
	</head>
	<body>
		<div class="container">
			<h1>Status Posting System</h1>
			<form action="searchstatusprocess.php" method="get" id="getStatusForm">

				<div>
					<label for="searchbox" class="search-label">Status: </label>
					<input type="text" class="input-wide" name="searchString" id="searchbox" required>

					<input type="submit" value="View Status">
				</div>
			</form>
			<br/>
			<a href="index.php">Return to Home Page</a>
		</div>

	</body>
</html>
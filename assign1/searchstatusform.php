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
			<form action="searchstatusprocess.php" method="get" id="getStatusForm">

				<div>
					<label for="searchbox" class="search-label">Status: </label>
					<input type="text" class="input-wide form-input" name="searchString" id="searchbox" required>

					<input type="submit" value="View Status">
				</div>
			</form>
			<br/>
			<a href="index.php">Return to Home Page</a>
		</div>

	</body>
</html>
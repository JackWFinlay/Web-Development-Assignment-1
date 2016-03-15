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

		<title>Post Status</title>
	</head>
	<body>
		<div class="container">
			<h1>Status Posting System</h1>
			<form action="poststatusprocess.php" method="post" id="postStatusForm">

				<p>Status Code (required) <input type="text" name="statusCode"></p>

				<p>Status (required) <input type="text" name="status" class="input-wide"></p>
				
				<!-- Share -->
				<div>
					<p class="share">Share:</p> 
					<p class="share">
						<input type="radio" name="share" value="Public">Public
					</p>
					<p class="share">
						<input type="radio" name="share" value="Friends">Friends
					</p>
					<p class="share">
						<input type="radio" name="share" value="Only Me">Only Me
					</p>
				</div>
				<!-- /Share -->
				<div>
					<input type="submit" value="Post" class="display-inline">
					<input type="reset" value="Reset" class="display-inline">
				</div>

				<br/>
			</form>
			<a href="index.php">Return to Home Page</a>
		</div>

	</body>
</html>
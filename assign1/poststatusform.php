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

				<label class="display-inline-block">Status Code (required): <input type="text" name="statusCode"></label><br/>

				<label class="display-inline-block">Status (required): <input type="text" name="status" class="input-wide"></label><br/>

				<?php

				$date = date('d/m/Y');

				echo "<label><span class='share display-inline-block'>Date: </span><input type='text' name='date' class='share' value='$date'></label><br/>"
				?>
				
				<!-- Share -->
				
				<label class="share">Share:</label> 
				<label class="share">
					<input type="radio" name="share" value="Public">Public
				</label>
				<label class="share">
					<input type="radio" name="share" value="Friends">Friends
				</label>
				<label class="share">
					<input type="radio" name="share" value="OnlyMe">Only Me
				</label>
				
				<!-- /Share -->
				

				<!-- Permissions -->
				
				<label class="share">Permission Type:</label> 
				<label class="share">
					<input type="checkbox" name="allowLike" value="true">Allow Like
				</label>
				<label class="share">
					<input type="checkbox" name="allowComment" value="true">Allow Comment
				</label>
				<label class="share">
					<input type="checkbox" name="allowShare" value="true">Allow Share
				</label>
				
				<!-- /Permissions -->

				<div>
					<input type="submit" value="Post" class="display-inline">
					<input type="reset" value="Reset" class="display-inline">
				</div>
			</form>
			<br/>
			<a href="index.php">Return to Home Page</a>
		</div>

	</body>
</html>
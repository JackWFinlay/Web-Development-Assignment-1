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
			<form action="poststatusprocess.php" method="post" id="postStatusForm">

				<div class="form-group">
					<label class="form-label">Status Code (required):</label>
					<input type="text" name="statusCode" class="form-input" required><br/>
				</div>

				<div class="form-group">
					<label class="form-label">Status (required):</label> 
					<input type="text" name="status" class="input-wide form-input" required><br/>
				</div>

				<?php

				$date = date('d/m/Y');

				echo "<label class='form-label'>Date: </label>
					  <input type='text' name='date' class='share form-input' value='$date'><br/>"
				?>
				
				<!-- Share -->
				
				<div class="form-group">
					<label class="form-label">Share:</label> 

					<input type="radio" name="share" value="Public" id="public">
					<label for="public" class="share">Public</label>

					
					<input type="radio" name="share" value="Friends" id="friends">
					<label class="share" for="friends">Friends</label>

					
					<input type="radio" name="share" value="Only Me" id="onlyme">
					<label class="share" for="onlyme">Only Me</label>
				</div>
				<!-- /Share -->
				

				<!-- Permissions -->
				
				<div class="form-group">
					<label class="form-label">Permission Type:</label> 
					
					<input type="checkbox" name="allowLike" value="true" id="allowLike">
					<label class="share" for="allowLike">Allow Like</label>

					
					<input type="checkbox" name="allowComment" value="true" id="allowComment">
					<label class="share" for="allowComment">Allow Comment</label>

					
					<input type="checkbox" name="allowShare" value="true" id="allowShare">
					<label class="share" for="allowShare">Allow Share</label>
				</div>
				<!-- /Permissions -->

				<div class="align-home-link">
					<a href="index.php">Return to Home Page</a>
				</div>

				<div class="pull-right align-form-buttons">
					<input type="submit" value="Post" class="display-inline">
					<input type="reset" value="Reset" class="display-inline">
				</div>
				</div>
			</form>

			
		</div>

	</body>
</html>
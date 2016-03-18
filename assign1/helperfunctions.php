<?php
	// Checks if DB exists, creates DB if it doesn't.
	function checkDBExists($connection){
		$sqlCommand = "CREATE DATABASE IF NOT EXISTS fhp0351_Ass1_DB;";

		if ($connection->query($sqlCommand) === true) {
		    return true;
		} else {
		    return false;
		}
	}

	//returns whether the table exists, creates it if it doesn't.
	function checkTableExists($connection) {
		$sqlCommand = "SHOW TABLES LIKE 'status'";
		$createTableSQL = "CREATE TABLE status (
							statusCode VARCHAR(5) NOT NULL PRIMARY KEY,
							status VARCHAR(1024) NOT NULL,
							statusDate VARCHAR(10) NOT NULL,
							share VARCHAR(7),
							allowLike BOOLEAN,
							allowComment BOOLEAN,
							allowShare BOOLEAN
						)";

		$results = $connection->query($sqlCommand);
			if (($results->num_rows) > 0){
				// Table exists
				return true;
			} else {
				if ($connection->query($createTableSQL) === true) {
					// Table created
		    	return true;
			} else {
		    	return false;
			}
			}
	}

	// Inserts the passed in details to the DB.
	function insertStatus($connection){
		$statusCode     = $_POST["statusCode"]; 
		$status         = $_POST["status"];
		$date 			= $_POST["date"];
		$share          = isset($_POST["share"]) ? $_POST["share"] : "Public"; //Default to public if not set.
		$allowLike	    = isset($_POST["allowLike"]) ? $_POST["allowLike"] : false; //false if not set.
		$allowComment   = isset($_POST["allowComment"]) ? $_POST["allowComment"] : false;
		$allowShare     = isset($_POST["allowShare"]) ? $_POST["allowShare"] : false;

		$insertStatusSQL = "INSERT INTO status VALUES (
							'$statusCode',
							'$status',
							'$date',
							'$share',
							$allowLike,
							$allowComment,
							$allowShare
							)";


		if ($connection->query($insertStatusSQL) === true) {
		    	return true;
			} else {
		    	return false;
			}
	}

	// Checks if status code is unique.
	function isStatusCodeUnique($connection) {
		$statusCode = $_POST["statusCode"];
		$sqlCommand = "SELECT COUNT(statusCode) AS total FROM status WHERE statusCode = 'statusCode'";

		$result = $connection->query($sqlCommand);
		$data = $result->fetch_assoc();
		if ( $data["total"] > 0) {
			echo "not unique";
		    return false;
		} else {
			echo "unique";
		    return true;
		}
	}

	// Checks that data passed from form is valid.
	function isDataValid() {
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

			echo "<a href='poststatusform.php' class='display-block'>Return to post status form</a><br/>";
			return false; // Stop processing function as param was incorrect.
		} 

		// Check that code, status, and date match patterns.
		if ((preg_match($statusCodePattern, $_POST["statusCode"])) &&
			(preg_match($statusPattern, $_POST["status"])) &&
		 	(preg_match($datePattern, $_POST["date"]))) {

		 	return true;
		} else {
			return false;
		}
	}
?>
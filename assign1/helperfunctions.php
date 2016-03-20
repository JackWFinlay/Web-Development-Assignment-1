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
							statusDate DATE NOT NULL,
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
		
		$date = str_replace('/', '-', $_POST["date"]); // PHP needs date with hyphens for dd/mm/yyyy formats.
		$date = date('Y-m-d', strtotime($date)); // yyyy-mm-dd required for MySql Databases.

		$share          = isset($_POST["share"]) ? $_POST["share"] : "Public"; //Default to public if not set.
		$allowLike	    = isset($_POST["allowLike"]) ? $_POST["allowLike"] : false; //false if not set.
		$allowComment   = isset($_POST["allowComment"]) ? $_POST["allowComment"] : false;
		$allowShare     = isset($_POST["allowShare"]) ? $_POST["allowShare"] : false;

		$insertStatusSQL = "INSERT INTO status VALUES (
							'{$statusCode}',
							'{$status}',
							'{$date}',
							'{$share}',
							'{$allowLike}',
							'{$allowComment}',
							'{$allowShare}'
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
		$sqlCommand = "SELECT COUNT(*) AS total FROM status WHERE statusCode LIKE '{$statusCode}'";

		$result = $connection->query($sqlCommand);
		$data = $result->fetch_assoc();
		if ( $data['total'] > 0 ) {
		    return false;
		} else {
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
			return false;
		}

		if (!preg_match($statusCodePattern, $_POST["statusCode"])){
			echo "<p>Status code is in incorrect format. Must be capital 'S' followed by four digits.</p>";
			return false;
		}

		if (empty($_POST["status"])){
			echo "<p>Status not specified</p>";
			return false;
		}

		if (!preg_match($statusPattern, $_POST["status"])){
			echo "<p>Status contains illegal characters. Can only contain alphanumeric and !.,? characters.</p>";
			return false;
		}

		if (empty($_POST["date"])){
			echo "<p>Date not specified</p>";
			return false;
		} 

		$day 	= substr($_POST["date"], 0,2); //Grab the relevant section of the $date string.
		$month 	= substr($_POST["date"], 3,2);
		$year	= substr($_POST["date"], 6);

		if (!preg_match($datePattern, $_POST["date"]) || 
			!checkdate($month, $day, $year)){	// Check that the date provided is real.
			echo "<p>Date is invalid or in an incorrect format. Must be DD/MM/YYYY</p>";
			return false;
		}

		return true;
	}

	function getSearchResults($connection){
		$searchString = $_GET['searchString'];

		$sqlCommand = "SELECT * FROM status WHERE status LIKE '%{$searchString}%'";

		$resultSet = $connection->query($sqlCommand);

		if ($resultSet->num_rows > 0) {
		    while($row = $resultSet->fetch_assoc()) {
		    	$statusCode    = $row['statusCode'];
		    	$status        = $row['status'];
		    	
		    	$date          = $row['statusDate'];
		    	$date  		   = date('F d, Y', strtotime($date));

		    	$share         = $row['share'];
		    	$allowLike     = $row['allowLike'];
		    	$allowComment  = $row['allowLike'];
		    	$allowShare    = $row['allowLike'];

		    	// Creates an array that can be imploded to create a string of permissions.
		    	$permissionsArray = array(($allowLike ? "Allow Like" : ""),
		    								($allowComment ? "Allow Comment" : ""),
		    								($allowShare ? "Allow Share" : ""));

		    	// Creates imploded string from array, ignoring empty strings.
		    	$permissions = implode(', ', array_filter($permissionsArray));
		    	// Sets permissions to "None" if none present.
		    	$permissions = empty($permissions) ? "None" : $permissions;

		        echo "<div class='search-result'>
	        			<p>Status Code: $statusCode<br/>
	        				Date Posted: $date</p>

	        			<p>Status: $status</p>

	        			<p>Share: $share<br/>
	        				Permissions: $permissions</p>
		        	 </div>";
		    }

		    return true;
		} else {
		    return false;
		}
	}


?>
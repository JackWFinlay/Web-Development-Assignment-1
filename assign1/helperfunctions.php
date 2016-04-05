<?php

	//returns whether the table exists, creates it if it doesn't.
	function checkTableExists($connection) {
		
		global $dbname;

		if (!mysqli_select_db($connection, $dbname)) {
			return false;
		}

		$sqlCommand = "SHOW TABLES LIKE 'status'";

		$createTableSQL = "CREATE TABLE status (" .
							"statusCode VARCHAR(5) NOT NULL PRIMARY KEY," .
							"status VARCHAR(1024) NOT NULL," .
							"statusDate DATE NOT NULL," .
							"share VARCHAR(7)," .
							"allowLike BOOLEAN," .
							"allowComment BOOLEAN," .
							"allowShare BOOLEAN" .
						")";

		$results = mysqli_query($connection, $sqlCommand);
		if ((mysqli_num_rows($results)) > 0){
			// Table exists
			return true;
		} else {
			if (mysqli_query($connection, $createTableSQL) == true) {
			// Table created
	    		return true;
			} else {
		    	return false;   	
			}
		}

	}

	// Inserts the passed in details to the DB.
	function insertStatus($connection){

		global $dbname;

		if (!mysqli_select_db($connection, $dbname)) {
			return false;
		}

		$statusCode     =  mysqli_escape_string($connection, $_POST["statusCode"]); 
		$status         =  mysqli_escape_string($connection, $_POST["status"]);
		
		$date = str_replace('/', '-',  mysqli_escape_string($connection, $_POST["date"])); // PHP needs date with hyphens for dd/mm/yyyy formats.
		$date = date('Y-m-d', strtotime($date)); // yyyy-mm-dd required for MySql Databases.

		$share          = isset($_POST["share"]) ? $_POST["share"] : "Public"; //Default to public if not set.

		$allowLike	    = isset($_POST["allowLike"]) ? true : false; //false if not set.
		$allowComment   = isset($_POST["allowComment"]) ? true : false;
		$allowShare     = isset($_POST["allowShare"]) ? true : false;

		$insertStatusSQL = "INSERT INTO status VALUES (
							'{$statusCode}',
							'{$status}',
							'{$date}',
							'{$share}',
							'{$allowLike}',
							'{$allowComment}',
							'{$allowShare}'
							)";

		if (mysqli_query($connection, $insertStatusSQL) === true) {
	    	return true;
		} else {
	    	return false;
		}

	}

	// Checks if status code is unique.
	function isStatusCodeUnique($connection) {

		global $dbname;

		if (!mysqli_select_db($connection, $dbname)) {
			return false;
		}

		$statusCode = mysqli_escape_string($connection, $_POST["statusCode"]);
		$sqlCommand = "SELECT COUNT(*) AS total FROM status WHERE statusCode LIKE '{$statusCode}'";

		$result = mysqli_query($connection, $sqlCommand);
		$data = mysqli_fetch_assoc($result);
		if ( $data['total'] > 0 ) {
			mysqli_free_result($result);
		    return false;
		} else {
			mysqli_free_result($result);
		    return true;
		}

	}

	// Checks that data passed from form is valid.
	function isDataValid($connection) {

		// Regular Expressions
		$statusCodePattern = '/^S\d{4}$/';
		$statusPattern     = '/^[a-zA-Z0-9\s!,\?\.]*$/';
		$datePattern       = '/^\d{1,2}\/\d{1,2}\/\d{4}$/';

		$statusCode        = mysqli_escape_string($connection, $_POST["statusCode"]);
		$status 		   = mysqli_escape_string($connection, $_POST["status"]);
		$date 			   = mysqli_escape_string($connection, $_POST["date"]);


		if (empty($statusCode)){ // Print message if statusCode is not specified.
			echo "<p>Status Code not specified</p>";
			return false;
		}

		if (!preg_match($statusCodePattern, $statusCode)){
			echo "<p>Status code is in incorrect format. Must be capital 'S' followed by four digits.</p>";
			return false;
		}

		if (empty($status)){
			echo "<p>Status not specified</p>";
			return false;
		}

		if (!preg_match($statusPattern, $status)){
			echo "<p>Status contains illegal characters. Can only contain alphanumeric and !.,? characters.</p>";
			return false;
		}

		if (empty($date)){
			echo "<p>Date not specified</p>";
			return false;
		} 

		$day 	= substr($date, 0,2); //Grab the relevant section of the $date string.
		$month 	= substr($date, 3,2);
		$year	= substr($date, 6);

		if (!preg_match($datePattern, $date) || 
			!checkdate($month, $day, $year)){	// Check that the date provided is real.
			echo "<p>Date is invalid or in an incorrect format. Must be DD/MM/YYYY</p>";
			return false;
		}

		return true;

	}

	function getSearchResults($connection){

		global $dbname;

		if (!mysqli_select_db($connection, $dbname)) {
			return false;
		}

		$searchString = mysqli_escape_string($connection, $_GET['searchString']);

		$sqlCommand = "SELECT * FROM status WHERE status LIKE '%{$searchString}%'";

		$resultSet = mysqli_query($connection, $sqlCommand);

		if (mysqli_num_rows($resultSet) > 0) {

		    while($row = mysqli_fetch_assoc($resultSet)) {

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

		    mysqli_free_result($resultSet);
		    return true;
		} else {
			mysqli_free_result($resultSet);
		    return false;
		}
		
	}


?>
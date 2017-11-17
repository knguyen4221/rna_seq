<?php

	function MakeConnection() {
		/*
		Description: Opens a connection to SQL database. Database variables such as servername/hostname, username, password and dbname are available on dbconnection.
		Parameters:
			None
		Returns:
			$conn = mysqli connection object to the database present on the server
		*/

		// load dbconnect config
		include '../../dbconnection/dbconfig.php';

    	// Create connection
    	$conn = new mysqli($servername, $username, $password, $dbname);

    	// Check connection
    	if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
    	}
		return $conn;
	}

	function GetCommonName($conn, $input, &$common_name){
		/*
		Description: Given input in the form of any of the keys of the gene, queries the database for that row and returns its primary key.
		Parameters:
			$conn: mysql database connection object generated from MakeConnection()
			$input:
				type: string
				value: a key that identifies a row
			$common_name: a string variable that is passed by reference in order to store the primary key
		Returns:
			None
			*Technically $common_name is the return value*
		*/
    	$sql = "select * from genes where symbol = " . "\"" . $input . "\"" . " or EntrezID = " . "\"" . $input . "\""; ;
    	$result = $conn->query($sql);
    	if ($result->num_rows > 0) {
        	$row = $result->fetch_assoc();
        	$common_name = $row["EntrezID"];
  			return;
     	} else {
        	echo "0 results";
			return "";
    	}	
	}

	/*
	Ajax call starts here.
	*/

	$input = $_GET["gene_name"];
	$common_name = "";

	$conn = MakeConnection();
	GetCommonName($conn,$input,$common_name);


	// when ajax call succeeds the value of data will be set to whatever is echo.
	// in this case we only want to return $common_name
	echo $common_name; 
?>
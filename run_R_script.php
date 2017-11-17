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

	function FetchData($conn, $common_name){
		/*
		Description: queries the database for the row where the primary key = $common_name
		Parameters:
			$conn: a mysqli database connection
			$common_name: 
				type: string
				value: the primary key of the table that is being queried from
		Returns: a formatted version of the data row such that it can be command line fed into R
		*/
    	$sql = "select * from genes where EntrezID = " . "\"" . $common_name ."\"";
    	$result = $conn->query($sql);
    	if ($result->num_rows > 0) {
        	$row = $result->fetch_assoc();
  			return FormatData($row);
     	} else {
        	echo "0 results";
			return "";
    	}	
	}
		
	function FormatData($row) {
		/*
		Description: Formats An associative array into a string that can be command line fed into R to render graphs
		Parameters: 
			$row:
				$type: an associative array of strings
		Returns:
			An associative array of the column names and values of the query.
		*/
		$keys = array_keys($row);
		$values = array_values($row);
		$data = "";
		$data2 = "";
		for ($i = 2; $i < (count($values) - 1); ++$i) {
			$data = $data . $values[$i] .  ",";
			$data2 = $data2 . $keys[$i] . ",";
		}
		$data = $data . $values[count($values) - 1];
		$data2 = $data2 . $keys[count($keys)-1]; 
		return array($data,$data2); 
	}
	
	function RenderGraph($data, $common_name,$input) {
		/*
		Description: Calls the Rscript responsible for rendering the graph
		Parameters:
			$data:
				$type: an array of strings
				$value: $data[0] is a comma delimited string of the queries values. $data[1] is a comma delimited string of the queries column names.
			$common_name:
				$type: string
				$value: primary key of the row you queried
			$input:
				$type: string
				$value: user input
		Returns: None

		*/
		//echo "Rscript green.r $data[0] $common_name $input $data[1]";
	    //echo "$data[1]";
		//echo "$data[0]";
		exec("Rscript green.r $data[0] $common_name $input $data[1]");
	}

	function Controller($common_name,$input) {
		/*
		The controller for this particular script. Kind of a like a main.
		*/
		$filename = "images/gene_images/" . $common_name . ".png";
		if (file_exists($filename)) {
		    echo "The file $filename exists";
		} else {
		    echo "The file $filename does not exist";
		    
	    	$conn = MakeConnection();

			$data = FetchData($conn,$common_name);

			RenderGraph($data,$common_name,$input);
		}
	}

	$input = $_GET["input"];
	$common_name = $_GET["common_name"];

	Controller($common_name,$input);

?>

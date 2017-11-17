<?php
    function makeConnection() {
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

    function formatSuggestions($gene_name, $keyword) {
    	/*
    	Description: Formats the gene names so that it highlights the keyword within the gene_name
    	Parameters:
    		$gene_name: 
    			type: string
    			value: the full gene name gotten from the database
    		$keyword:
    			type: string
    			value: a substring of the gene name that was gotten from user input
    	Returns:
    		type: string
    		value: returns a string such that a substring within the gene_name is bolded
    		Ex: $keyword = el
    		$gene_name = Hello
    		return H<b>el</b>lo
    	*/
    	$keyword = strtoupper($keyword); 
		$initial_pos = strpos($gene_name, $keyword);
		$prefix = substr($gene_name,0,$initial_pos);
		$suffix = substr($gene_name, $initial_pos + strlen($keyword));
		return $prefix . "<strong>" . $keyword . "</strong>" . $suffix; 
    }

	$conn = makeConnection(); 
	
	if (!empty($_POST['keyword'])) {
		$keyword = $_POST['keyword'];
		//Queries based on all identifiers for the table.
		$sql_common_name = "select * from genes where symbol like '%" . $keyword . "%' order by symbol";
		$sql_gene_id = "select * from genes where EntrezID like '%" . $keyword . "%' order by EntrezID"; 
		
		$result_common_name = $conn->query($sql_common_name); 
		$result_gene_id = $conn->query($sql_gene_id);


		if (!empty($result_common_name)) {

			foreach($result_common_name as $gene) {
				?>
				<span class="element" onClick="selectGene('<?php echo $gene["symbol"]; ?>');"><?php echo formatSuggestions($gene["symbol"],$keyword) ?></span>
			<?php
			}
		}

		if (!empty($result_gene_id)) {

			foreach($result_gene_id as $gene) {
				?>
				<span class="element" onClick="selectGene('<?php echo $gene["EntrezID"]; ?>');"><?php echo formatSuggestions($gene["EntrezID"],$keyword); ?></span>
			<?php
			}
		}

	}	
?>

Places you should edit:
	readGenes.php
		$sql_common_name
		$sql_gene_id
		and the resulting conditional statements that gets the queries` results.
	run_R_script.php
		funct FetchData
			$sql: should be a query that selects based on the primary key of the table
		funct RenderGraph
			Command line arguments should be changed based on required inputs for Rscript.
	common_name.php
		funct GetCommonName
			$sql = should query the rows where the input matches any of the keys of the table
			$common_name = $row[*INSERT PRIMARY KEY HERE*]
	Rscript
		depends on how you wnat to render your data
	gene_search.php
		#DownloadSection
			href should be changed to whichever file is the data you use for importing to your sql database
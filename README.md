Places you should edit:  
&nbsp;&nbsp;&nbsp;&nbsp;readGenes.php  
&nbsp;&nbsp;&nbsp;&nbsp;$sql_common_name  
&nbsp;&nbsp;&nbsp;&nbsp;$sql_gene_id  
&nbsp;&nbsp;&nbsp;&nbsp;and the resulting conditional statements that gets the queries' results.  
&nbsp;&nbsp;&nbsp;&nbsp;run_R_script.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;funct FetchData  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sql: should be a query that selects based on the primary key of the table  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;funct RenderGraph  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Command line arguments should be changed based on required inputs for Rscript.  
&nbsp;&nbsp;&nbsp;&nbsp;common_name.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;funct GetCommonName  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$sql = should query the rows where the input matches any of the keys of the table  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$common_name = $row[*INSERT PRIMARY KEY HERE*]  
&nbsp;&nbsp;&nbsp;&nbsp;Rscript  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;depends on how you want to render your data  
&nbsp;&nbsp;&nbsp;&nbsp;gene_search.php  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#DownloadSection  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;href should be changed to whichever file is the data you use for importing to your sql database  
Contributors:  
Franco, Francisco  
Nguyen, Ken  
Phelan, Michael  

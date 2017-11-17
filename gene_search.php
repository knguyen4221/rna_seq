<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title></title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/theme.css"/>
	<link rel="stylesheet" type="text/css" href="css/main-content.css"/>
	<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="js/fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="body">
	
	<header class="mainHeader">
		<img id="Logo" src="images/Logo.jpg">
		<nav>
			<ul>
				<li><a href="/green/">Home</a></li>
				<li><a href="/green/gene_search.php">Gene Search</a></li>
				<li><a href="/green/about.html">About</a></li>
				<li><a href="/green/images/help.png" target="_blank">Help</a></li>
			</ul>
		</nav>
	</header>


	<div id="MainContent">
		<div id="SearchContainer">
			<div id="SearchFormTitle">
				<h3>Search For Gene</h3>
			</div>
			<?php include "search_box.html";?>
			<div id="Misc">
			</div>
		</div>
		<div id="ImageContainer">
			<div style="text-align:center;">
			  <h1>Gene expression in Alzheimer's disease mice in the presence and absence of microglia </h1>
			</div>
			<p class="Research_Titles">Experimental Design:
			</p>
			<p>5xfAD and Wild-type mice treated with vehicle or PLX5622 (1200 ppm in chow) from 1.5 to 7 months of age. Brains microdissected into cortex, hippocampus, and thalamus+striatum. 4 mice/group.</p>
		  <p>This dataset allows for exploration of the effects of Alzheimer's disease pathology on disease expression in these 3 brain regions. </p>
		  <p>PLX5622 eliminates &gt;95% of microglia in less than 5 days. Thus, these data also allow the exploration of the effects, and specificity, of 6 months microglial depletion on gene expression in these 3 brain regions, in both wild-type and 5xfAD mice. The figure below shows the extent of microglial depletion, with representative images (microglia identfied via IBA1 immunostaining), and quantfications shown on the right.</p>
		  <div align="center"><img src="images/microglia 2.jpg" width="991" height="221" align="center" alt=""/></div>
		  <p>Use the search box to the left to display raw expression data for any gene, expressed as RPKM (Reads Per Kilobase of transcript per Million mapped reads). Individual data points, as well as means and standard errors are displayed.</p>
		  <p>This dataset accompanies the manuscript "Microglia are necessary for plaque formation and neuronal gene expression changes in Alzheimer’s disease mice". </p>
		</div>
	</div>


	<div id="DownloadSection">
		<a href="EXP-17-AE3143_rpkm_norm_20170501_Dan.xlsx" download>Download Data</a>
	</div>
	

	<footer class="mainFooter">
		<a href="//uci.edu/copyright/">
		<small>&copy; 2017 UC Regents</small>
		</a>
	</footer>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
	</script>
	<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
	<!-- underscore js allows for a delay on user keyboard input  -->
	<script type="text/javascript" src="js/underscore-min.js"></script>
	<!-- autocomplete js returns the results on input submission -->
	<script type="text/javascript" src="js/autocomplete.js"></script>
	<script type="text/javascript" src="js/outside-events.js"></script>
	<!-- generate-image js handles the execution of R script and generates the image -->
	<script type="text/javascript" src="js/generate-image.js"></script>


</body>
</html>

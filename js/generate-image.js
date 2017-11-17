$("#SearchForm").submit(function(e) {
	//Event loop
	e.preventDefault();
	HandleSubmission();
});

function HandleSubmission() {
	//override of submit event to instead render an image.
	var input = $("#search").val().toUpperCase();
	var common_name;
	GetCommonName(input);
}


function GetCommonName(input) {
	/*
	Makes an ajax call to common_name.php to grab the primary key of the whichever row given another key of the table.
	Parameter:
		input: 
			type: string
			value: a key within the table
	*/
	$.ajax({
		type: "GET",
		url: "common_name.php",
		data:{"gene_name":input},
			success: function(data) {
				common_name = data; 
				console.log(common_name);
				// as soon as it succeeeds send this 
				RenderImage(input,common_name);
				Loading();
			}
	});
}

function RenderImage(input,common_name) {
	/*
	Runs the R script in order to render the graph from the data and then displays it on the page on success.
	Parameter:
		input:
			type: string
			value: a key of the table
		common_name:
			type: string
			value: primary key of the table grabbed from common_name.php
	*/
	//console.log("input is " + input);
	$.ajax({
		type: "GET",
		url: "run_R_script.php",
		data:{"input":input,"common_name":common_name},
			success: function(data) {
				console.log(data);
				ImageDisplay();
			}
	});
}

function Loading() {
	/*
	During ajax call, replaces image with loading gif.
	*/
	$("#ImageContainer").html("<div id='GeneImageContainer'><img id='GeneImage' src='/green/images/loading.gif'></div>");
}
function ImageDisplay() {
	/*
	Displays the rendered graph into the corresponding divs within the page.
	*/
	var image_url = "/green/images/gene_images/" + common_name + ".png";

	$("#GeneImageContainer").html("<a class='fancybox' href='" + image_url +"'><img id ='GeneImage' src='" + image_url + "' alt=''/></a>");

	// $("#GeneImage").attr("src", image_url);
			
	// Update Gene Online Reference
	$("#Misc").html("<div id='GeneName'>GeneName</div>");

	$("#GeneName").html('<a href="https://www.ncbi.nlm.nih.gov/gene/?term=' + common_name + '" target="_blank">' + common_name + " @NCBI" + '</a>');


	$(".fancybox").fancybox({});
	// $("#GeneImage").fancybox();
	
	/* Using custom settings */
	
	// $("#GeneImage").fancybox({
	// 	'hideOnContentClick': false
	// });

}

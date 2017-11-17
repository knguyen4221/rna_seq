// AJAX call for autocomplete
$(document).ready(function() {
	// using underscore js 
	// Event loop
	$("#search").on("keyup", _.debounce(function (e) {
	    
	    if(e.keyCode == "38" || e.keyCode == "40") {
	        // console.log("up or down key press");
	        return; 
	    }
	    ajaxRequest();
	}, 500)); 


	// when the user clicks outside the search area, the suggestion box
	// will disappear. If the input field is not empty and the user wants 
	// to continue searching I want the suggestion box to appear again. 
	$("#search").click(function(){
		if ($(this).val()) {
			ajaxRequest();
		}
	});

});

function ajaxRequest() {
	/*
	makes an ajax call to the readgenes.php file with the search term as keyword input and generates autofill box with its output.
	*/
	$.ajax({
	type: "POST",
	url: "readGenes.php",
	data:"keyword="+$("#search").val(),
		success: function(data) {
			if (data) {
				$(".wrapper").show();
				$("#box").html(data);

				$("span").hover( function() {
				    $(".element-hover").removeClass("element-hover");
				    $(this).addClass("element-hover");
				}, function() {
				    $(this).removeClass("element-hover");
				});

				$("#box").width("100%");

				$("#box").css({
				    "max-height": "200px",
				    "margin": "auto",
				    "overflowX": "hidden",
				    "overflowY": "auto"
				});

			} else {
				$(".wrapper").hide();
			}
		}
	});
}

function selectGene(val) {
	/*
	Just autocompletes it on click and then submits it.
	*/
	$("#search").val(val);
	$("#SearchForm").submit();
	$(".wrapper").hide();
}

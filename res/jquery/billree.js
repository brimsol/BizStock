$(document).ready(function() {
	
	window.setInterval(function() {
		        
				$totalprintbill();
	}, 500);
 

});


$totalprintbill = function() {

	var rows = $("#myTable tr");
	var total = 0;
	rows.children("td:nth-child(6)").each(function() {
		total += parseFloat($(this).html());
	});
var a='Grant Total:  Rs:'
var c=a+total.toFixed(2);
	$("#grand").html(c);
};
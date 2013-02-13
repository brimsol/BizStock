$(document).ready(function() {
	
	window.setInterval(function() {
		        $total_calculator();
				
	}, 500);
 

});


$total_calculator = function() {

	var rows = $("#myresultTable tr");
	var total = 0;
	rows.children("td:nth-child(5)").each(function() {
		total += parseFloat($(this).html());
	});
var a='Grant Total:  Rs:'
var c=a+total.toFixed(2);
	$("#grand").html(c);
};


$(document).ready(function() {
	
	window.setInterval(function() {
		        
				$totalprintbill();
				$totalbill();
	}, 500);
 

});
$( "#search" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/product/auto_id/',
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success: function(data){
                        if(data.response =='true'){
                           add(data.message);
                        }
                    }
                });
            },
             });


$totalprintbill = function() {
	var rows = $("#myTable tr");
	var total = 0;
	rows.children("td:nth-child(3)").each(function() {
		total += parseFloat($(this).html());
	});
var a='Grant Total:  Rs:'
var c=a+total;
	$("#grand").html(c);
};
$totalbill = function() {
	var rows = $("#myTable tr");
	var total = 0;
	rows.children("td:nth-child(3)").each(function() {
		total += parseFloat($(this).html());
	});
var a='<div class="pull-right" style="color:#990000;"> <strong>Grant Total:  Rs:'
var c=a+total;
var b='</srong></div>'
	$("#totalbill").html(c);
};
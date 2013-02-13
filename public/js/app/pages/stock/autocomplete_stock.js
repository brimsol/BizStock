/** Auto Complete the Product ID in the Clear Stock page **/
$("#search_id_clear").autocomplete({
	source : function(req, add) {
		$.ajax({
			url : '/index.php/product/autoCompleteProductID/',
			dataType : 'json',
			type : 'POST',
			data : req,
			success : function(data) {
				if (data.response == 'true') {
					add(data.message);
				}
			}
		});
	},
});

$('#search_id_clear').keypress(function(e) {
	if (e.which == 13) {
		var key = $('#search_id_clear').val();
		if (key != '') {
			window.location.href = "/index.php/stock/renderClearStockPage/" + key;
		}
	}
});

$("#search_name_clear").autocomplete({
	source : function(req, add) {
		$.ajax({
			url : '/index.php/product/autoCompleteProductName/',
			dataType : 'json',
			type : 'POST',
			data : req,
			success : function(data) {
				if (data.response == 'true') {
					add(data.message);
				}
			}
		});
	},
});

$('#search_name_clear').keypress(function(e) {
	if (e.which == 13) {
		var key = $('#search_name_clear').val();
		if (key != '') {
			window.location.href = "/index.php/stock/renderClearStockPage/" + key;
		}
	}
});
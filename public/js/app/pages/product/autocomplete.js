/** Auto Complete the Product ID in the Manage Product page **/
$("#search_id1").autocomplete({
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

$('#search_id1').keypress(function(e) {
	if (e.which == 13) {
		var $key = $('#search_id1').val();
		if ($key != '') {
			$.ajax({
				url : '/index.php/product/fetchProductDetailsWithID/',
				data : 'key=' + $key,
				success : function(data) {
					$('#userresult2').html(data);
				}
			});
		}
	}
});

$("#search_name1").autocomplete({
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

$('#search_name1').keypress(function(e) {
	if (e.which == 13) {
		var $key = $('#search_name1').val();
		if ($key != '') {
			$.ajax({
				url : '/index.php/product/fetchProductDetailsWithName/',
				data : 'key=' + $key,
				success : function(data) {
					$('#userresult2').html(data);
				}
			});
		}
	}
});
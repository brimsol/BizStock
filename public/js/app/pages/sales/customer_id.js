$("#sales_pdt_id").autocomplete({
	source : function(req, add) {
		$.ajax({
			url : 'customer/autoCompleteCustomerID/',
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

$('#sales_pdt_id').keypress(function(e) {
	if (e.which == 13) {
		var key = $('#sales_pdt_id').val();
		if (key != '') {
			window.location.href = "sales/verifyCustomerID/" + key;
		}
	}

});
$('#pdt_id').keyup(function() {
	this.value = this.value.toUpperCase();
});

/** Auto Complete the Product ID in the Add Stock page **/
$("#pdt_id").autocomplete({
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
	/**select : function(event, ui) {
	 var selectedObj = ui.item;
	 $pdtdetails(selectedObj.value);
	 },**/
});

$("#pdt_id").keypress(function(event) {
	if (event.which == 13) {
		event.preventDefault();
		$getProductDetailsOnEnter();
	}
});

$getProductDetailsOnEnter = function() {
	var k = $('#pdt_id').val();
	$.ajax({
		url : '/index.php/stock/getProductDetails/',
		dataType : 'json',
		type : 'POST',
		data : {
			term : k,
		},
		success : function(data) {
			$('#pdt_purchase_price').val(data.pdt_purchase_price);
			$('#pdt_sell_price').val(data.pdt_sell_price);
			$pdt_sell_price_unit(data.pdt_sell_price_unit);
			$pdt_purchase_price_unit(data.pdt_purchase_price_unit);
			$('#pdt_des').val(data.pdt_des);
			$('#pdt_highest_unit_for_s').val(data.pdt_highest_unit);
			$pdt_highest_unit_op(data.pdt_highest_unit);
			$pdt_quality_op(data.pdt_quality);
			$('#pdt_idx').val(data.pdt_id);
			$stock(k);
			$('#new_pdt').val(data.new_product);
			$("#pdt_name2").val(data.pdt_name)
			var np = data.new_product;
			if (np == 'Y') {
				var answer = confirm("This is a new product. Do you want to add it now?")
				if (answer) {
					$add_new_product();
				}
				return false;
			}
		}
	});
}

$pdt_sell_price_unit = function(pdt_sell_price_unit) {
	var k = pdt_sell_price_unit;
	if (k == null || k == 0 || k == '') {
		$("#pdt_sell_price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="L">L</option><option value="ml">ml</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_sell_price_unit");
	} else if (k == 'Kg') {
		$("#pdt_sell_price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option selected="true" value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option value="L">L</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_sell_price_unit");
	} else if (k == 'Pieces') {
		$("#pdt_sell_price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option  value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option value="Litre">L</option><option selected="true" value="Pieces">Pieces</option>');
		s.appendTo("#pdt_sell_price_unit");
	} else if (k == 'L') {
		$("#pdt_sell_price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option selected="true" value="L">L</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_sell_price_unit");
	}
}

$pdt_purchase_price_unit = function(pdt_purchase_price_unit) {
	var k = pdt_purchase_price_unit;
	if (k == null || k == 0 || k == '') {
		$("#pdt_purchase_price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="L">L</option><option value="ml">ml</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_purchase_price_unit");
	} else if (k == 'Kg') {
		$("#pdt_purchase_price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option selected="true" value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option value="L">L</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_purchase_price_unit");
	} else if (k == 'Pieces') {
		$("#pdt_purchase_price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option  value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option value="Litre">L</option><option selected="true" value="Pieces">Pieces</option>');
		s.appendTo("#pdt_purchase_price_unit");
	} else if (k == 'L') {
		$("#pdt_purchase_price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option selected="true" value="L">L</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_purchase_price_unit");
	}
}

$pdt_highest_unit_op = function(h_unit) {
	var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Litre">Litre</option><option value="Pieces">Pieces</option>');
	s.appendTo("#pdt_highest_unit");

	var k = h_unit;
	if (k == null || k == 0 || k == '') {
		$("#pdt_highest_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Litre">Litre</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_highest_unit");
	} else if (k == 'Tonne') {
		$("#pdt_highest_unit").empty();
		var s = $('<!--<option selected="true" value="Tonne">Tonne</option>-->');
		s.appendTo("#pdt_highest_unit");
	} else if (k == 'Kg') {
		$("#pdt_highest_unit").empty();
		var s = $('<option selected="true" value="Kg">Kg</option>');
		s.appendTo("#pdt_highest_unit");
	} else if (k == 'L') {
		$("#pdt_highest_unit").empty();
		var s = $('<option selected="true" value="L">L</option>');
		s.appendTo("#pdt_highest_unit");
	} else if (k == 'Pieces') {
		$productquantityforpieces();
		$("#pdt_highest_unit").empty();
		var s = $('<option selected="true" value="Pieces">Pieces</option>');
		s.appendTo("#pdt_highest_unit");
	}
}

$productquantityforpieces = function() {
	$('#newstock').keyup(function() {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
}

$pdt_quality_op = function(quality) {
	var k = quality;
	if (k == null || k == 0 || k == '') {
		$("#pdt_quality").empty();
		var s = $('<option value="">Select</option><option value="First Quality">First Quality</option><option value="Second Quality">Second Quality</option><option value="Third Quality">Third Quality</option><option value="Cheap Quality">Cheap Quality</option>');
		s.appendTo("#pdt_quality");
	} else if (k == 'Cheap Quality') {
		$("#pdt_quality").empty();
		var s = $('<option selected="true" value="Cheap Quality">Cheap Quality</option>');
		s.appendTo("#pdt_quality");
	} else if (k == 'Second Quality') {
		$("#pdt_quality").empty();
		var s = $('<option selected="true" value="Second Quality">Second Quality</option>');
		s.appendTo("#pdt_quality");
	} else if (k == 'Third Quality') {
		$("#pdt_quality").empty();
		var s = $('<option selected="true" value="Third Quality">Third Quality</option>');
		s.appendTo("#pdt_quality");
	} else if (k == 'First Quality') {
		$("#pdt_quality").empty();
		var s = $('<option selected="true" value="First Quality">First Quality</option>');
		s.appendTo("#pdt_quality");
	}
}

$stock = function(key) {
	var k = key;
	$.ajax({
		url : '/index.php/stock/getCurrentStock/',
		dataType : 'json',
		type : 'POST',
		data : {
			term : k,
		},
		success : function(data) {
			if (data.pdt_stock == null || data.pdt_stock == 0) {
				$('#pdt_stock').val('Out Of Stock')
				$('#pdt_stock_val').val('0');
				$('#pdt_stock_val').attr('value', '0');
			} else {
				$('#pdt_stock').val(data.pdt_stock + '/' + data.stock_unit);
				$('#pdt_stock_val').val(data.pdt_stock);
				$('#pdt_stock_val').attr('value', data.pdt_stock);
			}
			$('#pdt_stock_val_u').attr('value', data.stock_unit);
			$('#pdt_stock_val_u').val(data.stock_unit);
			$unit_selector();
		}
	});
}

$unit_selector = function() {
	var k = $('#pdt_stock_val_u').val();
	var h = $('#pdt_highest_unit_for_s').val();

	if (k == null || k == 0) {
		if (h == 'Tonne') {
			$("#stk_unit").empty();
			var s = $('<!--<option value="">Select</option><option value="Tonne">Tonne</option>-->');
			s.appendTo("#stk_unit");
		} else if (h == 'Quintal') {
			$("#stk_unit").empty();
			var s = $('<!--<option value="">Select</option><option value="Tonne">Tonne</option>-->');
			s.appendTo("#stk_unit");
		} else if (h == 'Kg') {
			$("#stk_unit").empty();
			var s = $('<option value="">Select</option><option value="Kg">Kg</option>');
			s.appendTo("#stk_unit");
		} else if (h == 'L') {
			$("#stk_unit").empty();
			var s = $('<option value="">Select</option><option value="L">L</option>');
			s.appendTo("#stk_unit");
		} else if (h == 'Gram') {
			$("#stk_unit").empty();
			var s = $('<option value="">Select</option><option value="Gram">Gram</option>');
			s.appendTo("#stk_unit");
		} else if (h == 'ml') {
			$("#stk_unit").empty();
			var s = $('<option value="">Select</option><option value="Gram">Gram</option>');
			s.appendTo("#stk_unit");
		} else if (h == 'Pieces') {
			$("#stk_unit").empty();
			var s = $('<option value="">Select</option><option value="Pieces">Pieces</option>');
			s.appendTo("#stk_unit");
		}
	} else if (k == 'Tonne') {
		$("#stk_unit").empty();
		var s = $('<!--<option value="">Select</option><option value="Tonne">Tonne</option>-->');
		s.appendTo("#stk_unit");
	} else if (k == 'Pieces') {
		$("#stk_unit").empty();
		var s = $('<option value="">Select</option><option value="Pieces">Pieces</option>');
		s.appendTo("#stk_unit");
	} else if (k == 'L') {
		$("#stk_unit").empty();
		var s = $('<option value="">Select</option><option value="L">L</option>');
		s.appendTo("#stk_unit");
	} else if (k == 'Kg') {
		$("#stk_unit").empty();
		var s = $('<option value="">Select</option><option value="Kg">Kg</option>');
		s.appendTo("#stk_unit");
	}
}

$("#stk_unit").change(function() {
	var stk_unit = $('#stk_unit :selected').val();
	if (stk_unit == '' || stk_unit == null) {
		alert('Missing values found. Please check !');
		$("#stk_unit").val(0);
	} else {
		var value = $("#newstock").val();
		var currentvalue = $("#pdt_stock_val").val();
		var unit = stk_unit;
		var added_stock = parseFloat(value) + parseFloat(currentvalue);
		var pdt_purchase_price = $('#pdt_purchase_price').val();
		var pdt_purchase_price_unit = $('#pdt_purchase_price_unit').val();
		var pdt_sell_price = $('#pdt_sell_price').val();
		var pdt_sell_price_unit = $('#pdt_sell_price_unit').val();
		var pdt_des = $('#pdt_des').val();
		var pdt_h_unit = $('#pdt_highest_unit').val();
		var u = $('#stk_unit :selected').val();
		var p = $('#pdt_purchase_price').val();
		var pu = $('#pdt_purchase_price_unit').val();
		if (pu == null | pu == '') {
			var pu = $('#pdt_purchase_price_unit:selected').val();
		}
		var q = $('#newstock').val();
		var newstkvalue = $('#newstock').val();
		var pdt_quality = $('#pdt_quality').val();
		var pdt_id = $("#pdt_id").val();
		var bill_num = $("#bill_num").val();
		var pdt_name_from = $("#pdt_name2").val();

		if (newstkvalue != '' && pdt_purchase_price != '' && pdt_purchase_price_unit != '' && pdt_des != '' 
		  && pdt_h_unit != '' && pdt_id != '' && pdt_name_from != '') {
			if (q != '') {
				if (pu == 'Kg' && u == 'Tonne') {
					var sub_total = parseFloat(p) * (parseFloat(q) * 1000);
					$('#sub_total').val(sub_total);
				} else if (pu == 'Gram' && u == 'Tonne') {
					var sub_total = parseFloat(p) * (parseFloat(q) * 1000000);
					$('#sub_total').val(sub_total);
				} else if (pu == 'Kg' && u == 'Kg') {
					var sub_total = parseFloat(p) * (parseFloat(q));
					$('#sub_total').val(sub_total);
				} else if (pu == 'gram' && u == 'Kg') {
					var sub_total = parseFloat(p) * (parseFloat(q) * 1000);
					$('#sub_total').val(sub_total);
				} else if (pu == 'L' && u == 'L') {
					var sub_total = parseFloat(p) * (parseFloat(q));
					$('#sub_total').val(sub_total);
				} else if (pu == 'ml' && u == 'L') {
					var sub_total = parseFloat(p) * (parseFloat(q) * 1000);
					$('#sub_total').val(sub_total);
				} else if (pu == 'ml' && u == 'ml') {
					var sub_total = parseFloat(p) * (parseFloat(q));
					$('#sub_total').val(sub_total);
				} else if (pu == 'Gram' && u == 'Gram') {
					var sub_total = parseFloat(p) * (parseFloat(q));
					$('#sub_total').val(sub_total);
				} else if (pu == 'Pieces' && u == 'Pieces') {
					var sub_total = parseFloat(p) * (parseFloat(q));
					$('#sub_total').val(sub_total);
				} else {
					alert('Invalid unit convertion(EL 456)')
				}

				if (q == 0 || q == '') {
					alert('You have not entered a valid quantity')
					$("#stk_unit").val(0);
				}
				$addStockToDB(stk_unit);
			}
		} else {
			alert('Some fields are missing. Please check !')
			$("#stk_unit").val(0);
		}
	}
});

$addStockToDB = function(stk_unit) {
	var bill_num = $("#bill_num").val();
	var pdt_id = $("#pdt_id").val();
	var pdt_des = $('#pdt_des').val();
	var pdt_name_from = $("#pdt_name2").val();
	var pdt_name = pdt_name_from;
	var pdt_name_ml = $("#pdt_name_ml2").val();
	var pdt_quality = $('#pdt_quality').val();
	var pdt_h_unit = $('#pdt_highest_unit').val();
	var pdt_purchase_price = $('#pdt_purchase_price').val();
	var pdt_purchase_price_unit = $('#pdt_purchase_price_unit').val();
	var pdt_sell_price = $('#pdt_sell_price').val();
	var pdt_sell_price_unit = $('#pdt_sell_price_unit').val();
	var value = $("#newstock").val();
	var currentvalue = $("#pdt_stock_val").val();
	var new_stock = parseFloat(value) + parseFloat(currentvalue);
	var unit = stk_unit;
	var sub_total = $("#sub_total").val();
	var new_pdt = $("#new_pdt").val();
	$.ajax({
		type : "POST",
		url : "/index.php/stock/addStockToDB",
		data : "pdt_id=" + pdt_id + "&stock_unit=" + unit + "&new_stock=" + new_stock + "&stock_before_load=" + currentvalue 
		     + "&stock_going_to_add=" + value + "&stock_going_to_add=" + value + "&pdt_purchase_price=" + pdt_purchase_price 
		     + "&pdt_purchase_price_unit=" + pdt_purchase_price_unit + "&pdt_sell_price=" + pdt_sell_price 
		     + "&pdt_sell_price_unit=" + pdt_sell_price_unit + "&pdt_des=" + pdt_des + "&pdt_h_unit=" + pdt_h_unit 
		     + "&pdt_quality=" + pdt_quality + "&bill_num=" + bill_num + "&pdt_name=" + pdt_name + "&pdt_name_ml=" + pdt_name_ml 
		     + "&new_pdt=" + new_pdt + "&sub_total=" + sub_total,
		success : function(data) {
			$('#myTable :input').val("");
			$("#succesmsg").show();
			$("#result").show();
			$("#back").hide();
			var h = data;
			$('#myresultTable > tbody:last').prepend(h);
		},
		error : function(data) {
			alert('Oops! some thing went wrong.')
		}
	});
}

$('#newstock').keyup(function() {
	this.value = this.value.replace(/[^0-9\.]/g, '');
});

$('#price_per_unit').keyup(function() {
	this.value = this.value.replace(/[^0-9\.]/g, '');
});

$('#price_per_unit_selling').keyup(function() {
	this.value = this.value.replace(/[^0-9\.]/g, '');
});

$("#pdt_highest_unit").change(function() {
	var hs_unit = $('#pdt_highest_unit :selected').val();
	$("#stk_unit").empty();
	var s = $('<option value="">Select</option><option value="' + hs_unit + '">' + hs_unit + '</option>');
	s.appendTo("#stk_unit");
});

$(document).ready(function() {
	window.setInterval(function() {
		var rows = $("#myresultTable tr");
		var total = 0;
		rows.children("td:nth-child(4)").each(function() {
			total += parseFloat($(this).html());
		});
		$("#total").val(total.toFixed(2));
		if (total == null || total == 0) {
			$("#result").hide();
			$("#back").show();
		}
	}, 500);
	$("#succesmsg").hide();
	$("#pdt_name").hide();
	$("#pdt_ml").hide();
	$("#pdt_name1").hide();
	$("#pdt_name_ml").hide();
	$("#result").hide();
	$("#newstock").keyup(function() {
		$('#stk_unit').val(0);
		window.setInterval(function() {
			$("#succesmsg").hide();
		}, 5000);
	});
});

$("#tendercash").keyup(function() {
	var total = $("#total").val();
	var tendercash = $("#tendercash").val();
	var b = parseFloat(tendercash) - parseFloat(total);
	$("#balance").val(b.toFixed(2));

});

$("button").live({
	click : function() {
		var id = this.id;
		var pdt_id = $('#pdt_id_del' + id).val();
		var stk_added = $('#stk_added' + id).val();
		var stk_after_add = $('#stk_after_add' + id).val();
		current_stock = parseFloat(stk_added);
		var answer = confirm('Are you sure, do you want to remove this item from the order?');
		if (answer) {
			$.ajax({
				type : "POST",
				url : "/index.php/stock/updateStockUponLineRemoval",
				data : "spa_id=" + id + "&pdt_id=" + pdt_id + "&current_stock=" + current_stock,
				success : function() {
					$('#' + id).remove();
					$('#myTable :input').val("");
				}
			});
		}
	}
});

$("#cancelload").click(function() {
	var answer = confirm('Are you sure, do you want to cancel this bill?');
	if (answer) {
		$('.delete').trigger('click');
	}
});

$("button1").live({
	click : function() {
		var id = this.id;
		var pdt_id = $('#pdt_id_del' + id).val();
		var stk_added = $('#stk_added' + id).val();
		var stk_after_add = $('#stk_after_add' + id).val();
		current_stock = parseFloat(stk_added);
		$.ajax({
			type : "POST",
			url : "/index.php/stock/updateStockUponLineRemoval",
			data : "spa_id=" + id + "&pdt_id=" + pdt_id + "&current_stock=" + current_stock,
			success : function() {
				$('#' + id).remove();
				$('#myTable :input').val("");
			}
		});
	}
});

$add_new_product = function() {
	$("#pdt_ml").show();
	$("#pdt_name").show();
	$("#pdt_name1").show();
	$("#pdt_name_ml").show();
	$('#pdt_des').removeAttr("disabled");
	$('#pdt_quality').removeAttr("disabled");
	$('#pdt_highest_unit').removeAttr("disabled");
	$('#pdt_sell_price').removeAttr("disabled");
	$('#pdt_sell_price_unit').removeAttr("disabled");
	$('#pdt_purchase_price ').removeAttr("disabled");
	$('#pdt_purchase_price_unit').removeAttr("disabled");
}


/*
 $pdtdetails = function(key) {
 $addcancel();
 var k = key;
 $.ajax({
 url : '/index.php/stock/pdt_details/',
 dataType : 'json',
 type : 'POST',
 data : {
 term : k,
 },
 success : function(data) {
 $('#price_per_unit').val(data.pdt_price);
 $('#price_per_unit_selling').val(data.pdt_price_selling);
 $pdt_sell_price_unit(data.pdt_sell_price_unit);
 $pdt_purchase_price_unit(data.pdt_purchase_price_unit);
 $('#pdt_des').val(data.pdt_des);
 $('#pdt_highest_unit_for_s').val(data.pdt_highest_unit);
 $pdt_highest_unit_op(data.pdt_highest_unit);
 $pdt_quality_op(data.pdt_quality);
 $('#pdt_idx').val(data.pdt_id);
 $("#pdt_name2").val(data.pdt_name)
 $stock(k);
 }
 });
 }
 */

/*
 $addcancel = function() {
 $("#pdt_name").hide();
 $("#pdt_ml").hide();
 $("#pdt_name1").hide();
 $("#pdt_name_ml").hide();
 $('#pdt_des').attr("disabled", "true");
 $('#price_per_unit').attr("disabled", "true");
 $('#pdt_quality').attr("disabled", "true");
 $('#price_unit').attr("disabled", "true");
 $('#pdt_highest_unit').attr("disabled", "true");
 $('#price_per_unit_selling').attr("disabled", "true");
 $('#price_unit_selling').attr("disabled", "true");
 }*/
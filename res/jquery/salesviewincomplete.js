
$(document).ready(function() {
	$("#purchasedresult").hide();
	$('#is_quota_limited_flag').val('N');
	$('#is_quota_limited_flag').attr('value', 'N');
    var gToKg_ConvFactor=1000;
    var kgToTon_ConFactor=1000;
	window.setInterval(function() {
		$total_calculator();

	}, 500);
window.setInterval(function() {
	var rows = $("#myresultTable tr");
	var total = 0;
	rows.children("td:nth-child(4)").each(function() {
		total += parseFloat($(this).html());
	});
	if (total==null || total==0){$("#result").hide();}
	}, 500);
});
$("#tendercash").keyup(function() {

	var total=$("#total").val();
	
	var tendercash=$("#tendercash").val();
	var b = parseFloat(tendercash)-parseFloat(total);

	$("#balance").val(b.toFixed(2));

});
$("#pdt_id").autocomplete({
	source : function(req, add) {
		$.ajax({
			url : '/index.php/product/auto_id/',
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
	select : function(event, ui) {
		var selectedObj = ui.item;

		$price_per_unit(selectedObj.value);
		$stockcheck(selectedObj.value);
		$is_quota_limited(selectedObj.value);

	},
});

$is_quota_limited = function(pdt_id) {

	var k = pdt_id;
	$.ajax({
		url : '/index.php/product/is_quota_limited/',
		dataType : 'json',
		type : 'POST',
		data : {
			term : k,
		},
		success : function(data) {

			var is_quota_limited = data.is_quota_limited;
			$is_quota(is_quota_limited, pdt_id);
		}
	});
}
$is_quota = function(is_quota_limited, pdt_id) {
	if (is_quota_limited == 'Y') {
          
		//alert('quotalimited');
		$('#is_quota_limited_flag').val('Y');
		$('#is_quota_limited_flag').attr('value', 'Y');
		$getCurrentWeek(pdt_id);

	} else {

		$('#remaining_quota').val('No quota limit');
		$('#purchased_quota').val('No quota limit');
		$('#total_quota').val('No quota limit');
	}
}
$getCurrentWeek = function(pdt_id) {

	var pdt_id = pdt_id;
	$.ajax({
		url : '/index.php/sales/GetcurrWeekController/',
		dataType : 'json',
		type : 'POST',
		data : {

		},
		success : function(data) {

			$('#week_num').val(data.week_num);
			$('#week_num').attr('value', data.week_num);

		},
		complete : function() {

			$quota(pdt_id);

		}
	});
}
$quota = function(pdt_id) {
	var k = pdt_id;
	var rc_type = $('#rc_type').val();
	var rc_num = $('#rc_num').val();

	$.ajax({
		url : '/index.php/quota/quota_details/',
		dataType : 'json',
		type : 'POST',
		data : {
			term : k,
			rc_type : rc_type
		},
		success : function(data) {
             if(data.pdt_quota=='' || data.pdt_quota==null){
             	
             	$('#total_quota').val('No quota limit');
             	$('#is_quota_limited_flag').val('N');
		        $('#is_quota_limited_flag').attr('value', 'N');
             }else{
			$('#total_quota').val(data.pdt_quota);
			}

		},
		complete : function() {
           if($('#total_quota').val()=='No quota limit'){
             	
             	$("#purchased_quota").val('No quota limit');
             	$("#remaining_quota").val('No quota limit');
             }else{
			$purchasedquantity(k, rc_num);
			}
		}
	});
}
$purchasedquantity = function(key, key2) {
	var k = key;
	var week_num = $('#week_num').val();
	var rc_num = key2;
	$.ajax({
		url : '/index.php/sales/purchasedquantity/',
		type : 'POST',
		data : {
			term : k,
			rc_num : rc_num,
			week_num : week_num
		},
		success : function(data) {
			var h = data;
			$("#purchased_quota").val(h);
			

		},
		complete : function(data) {

			$remainingquota();
		},
	});

}
$price_per_unit = function(key) {
	var k = key;
	var rc_type = 'BPL'
	$.ajax({
		url : '/index.php/product/auto_pdt_per_unit_price/',
		dataType : 'json',
		type : 'POST',
		data : {
			term : k,
			rc_type : rc_type
		},
		success : function(data) {

			$('#price_per_unit').val(data.pdt_price + '/' + data.pdt_unit);
			$('#price_per_unit_h').val(data.pdt_unit);
			$('#price_per_h').val(data.pdt_price);
			$('#pdt_des').val(data.pdt_des);
			$("#pdt_unit").empty();
			$unit_selector(data.pdt_unit);
		}
	});

}
$unit_selector = function(key) {
	var k = key;
	if (k == 'Kg' || k == 'Gram') {

		var s = $('<option value="pls select">Select</option><option value="Kg">Kg</option><option value="Gram">Gram</option>');
		s.appendTo("#pdt_unit");
	} else if (k == 'L' || k == 'ml') {

		var s = $('<option value="pls select">Select</option><option value="L">L</option><option value="ml">ml</option>');
		s.appendTo("#pdt_unit");
	} else if (k == 'Pieces') {
$productquantityforpieces();
		var s = $('<option value="pls select">Select</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_unit");
	}
}

$("#pdt_unit").change(function() {
	var u = $('#pdt_unit :selected').val();
	var p = $('#price_per_h').val();
	var pu = $('#price_per_unit_h').val();
	var q = $('#pdt_quantity').val();

	if (q != '') {
		if (pu == 'Kg' && u == 'Kg') {
			var sub_total = parseFloat(p) * parseFloat(q);
			$('#sub_total').val(sub_total);
		} else if (pu == 'Kg' && u == 'Gram') {
			var sub_total = parseFloat(p) * (parseFloat(q) / 1000);
			$('#sub_total').val(sub_total);
		} else if (pu == 'L' && u == 'L') {
			var sub_total = parseFloat(p) * (parseFloat(q));
			$('#sub_total').val(sub_total);
		} else if (pu == 'L' && u == 'ml') {
			var sub_total = parseFloat(p) * (parseFloat(q) / 1000);
			$('#sub_total').val(sub_total);
		} else if (pu == 'Pieces' && u == 'Pieces') {
			var sub_total = parseFloat(p) * (parseFloat(q));
			$('#sub_total').val(sub_total);
		}
		
		if(q==0 || q==''){
			
			alert('You have not entered a valid quantity')
			
		}else{
			$stockcheck_afterunitgiven()
		}
		
		
		

	}

});

$("#pdt_quantity").keyup(function() {
	this.value = this.value.replace(/[^0-9\.]/g, '');
	$('#pdt_unit').val(0);
	$('#sub_total').val('');

});

$biller = function(newstock) {

	var pdt_id = $('#pdt_id').val();
	var pdt_des = $('#pdt_des').val();
	var total_quota = $('#total_quota').val();
	var purchased_quota = $('#purchased_quota').val();
	var remaining_quota = $('#remaining_quota').val();
	var price_per_unit_h = $('#price_per_unit_h').val();
	var price_per_h = $('#price_per_h').val();
	var pdt_quantity = $('#pdt_quantity').val();
	var pdt_unit = $('#pdt_unit').val();
	var sub_total = $('#sub_total').val();
	var bill_num = $('#bill_num').val();
	var rc_num = $('#rc_num').val();
	var week_num = $('#week_num').val();
	var is_quota_limited_flag = $('#is_quota_limited_flag').val();
	var new_stock = newstock;
	var u = $('#pdt_unit :selected').val();
	if (u == 'Kg') {
		var newr = pdt_quantity;
	} else if (u == 'L') {

		var newr = pdt_quantity;
	} else if (u == 'Pieces') {

		var newr = pdt_quantity;
	} else if (u == 'Gram') {

		var newr = pdt_quantity / 1000;

	} else if (u == 'ml') {

		var newr = pdt_quantity / 1000;
	} else if (u == 'Pieces') {

		var newr = pdt_quantity;
	}
	if (is_quota_limited_flag == 'Y') {

		var r = parseFloat($('#remaining_quota').val());
		var u = $('#pdt_unit :selected').val();
		if (u == 'Kg') {

			var newr = pdt_quantity;
		} else if (u == 'L') {

			var newr = parseFloat(pdt_quantity);
		} else if (u == 'Pieces') {

			var newr = pdt_quantity;
		} else if (u == 'Gram') {

			var newr = parseFloat(pdt_quantity / 1000);
		} else if (u == 'ml') {

			var newr = parseFloat(pdt_quantity / 1000);
		} else if (u == 'Pieces') {

			var newr = parseFloat(pdt_quantity);
		}

		if (newr > r) {
			alert('You Quota limit exceeds')
			$("#pdt_quantity").val('');
			$("#sub_total").val('');

		} else {

			$.ajax({
				type : "POST",
				url : "/index.php/sales/add_db",
				data : "pdt_id=" + pdt_id + "&rc_num=" + rc_num + "&total_quota=" + total_quota + "&purchased_quota=" + purchased_quota + "&remaining_quota=" + remaining_quota + "&price_per_unit_h=" + price_per_unit_h + "&price_per_h=" + price_per_h + "&pdt_quantity=" + newr + "&pdt_unit=" + pdt_unit + "&sub_total=" + sub_total + "&bill_num=" + bill_num + "&pdt_des=" + pdt_des + "&new_stock=" + new_stock + "&week_num=" + week_num + "&is_quota_limited_flag=" + is_quota_limited_flag,
				success : function(data) {
					$('#myTable :input').val("");
					$("#result").show();
					var h = data;
					$('#myresultTable > tbody:last').append(h);
					$('#is_quota_limited_flag').val('N');
					$('#is_quota_limited_flag').attr('value', 'N');

				}
			});
		}
	} else {

		$.ajax({
			type : "POST",
			url : "/index.php/sales/add_db",
			data : "pdt_id=" + pdt_id + "&rc_num=" + rc_num + "&total_quota=" + total_quota + "&purchased_quota=" + purchased_quota + "&remaining_quota=" + remaining_quota + "&price_per_unit_h=" + price_per_unit_h + "&price_per_h=" + price_per_h + "&pdt_quantity=" + newr + "&pdt_unit=" + pdt_unit + "&sub_total=" + sub_total + "&bill_num=" + bill_num + "&pdt_des=" + pdt_des + "&new_stock=" + new_stock + "&week_num=" + week_num + "&is_quota_limited_flag=" + is_quota_limited_flag,
			success : function(data) {
				$('#myTable :input').val("");
				$("#result").show();
				var h = data;
				$('#myresultTable > tbody:last').append(h);
				$('#is_quota_limited_flag').val('N');
				$('#is_quota_limited_flag').attr('value', 'N');

			}
		});
	}

}

$("button").live({
	click : function() {
		var id = this.id;
		//alert(id);
		var is_quota_limited = $('#is_quota_limited_flag' + id).val();
		//alert(is_quota_limited);

		var st_id = $('#st_id' + id).val();
		//alert(st_id);
		var pdt_id = $('#pdt_id_del' + id).val();
		//alert(pdt_id);
		var pdt_quantity = $('#pdt_quantity_del' + id).val();
		//alert(pdt_quantity);
		var pdt_unit_del = $('#pdt_unit_del' + id).val();
		//alert(pdt_unit_del);
		var q_p_h_id = $('#q_p_h_id' + id).val();
		//alert(q_p_h_id);
		var answer = confirm('Are you sure,do you want to delete this item?');
		if (answer) {

			$.ajax({
				type : "POST",
				url : "/index.php/sales/delete_db",
				data : "s_id=" + id + "&pdt_id=" + pdt_id + "&st_id=" + st_id + "&pdt_quantity=" + pdt_quantity + "&pdt_unit=" + pdt_unit_del + "&q_p_h_id=" + q_p_h_id + "&is_quota_limited=" + is_quota_limited,
				success : function() {

					$('#' + id).remove();

				}
			});
		}
	}
});
$("button1").live({
	click : function() {
		var id = this.id;
		//alert(id);
		var is_quota_limited = $('#is_quota_limited_flag' + id).val();
		//alert(is_quota_limited);

		var st_id = $('#st_id' + id).val();
		//alert(st_id);
		var pdt_id = $('#pdt_id_del' + id).val();
		//alert(pdt_id);
		var pdt_quantity = $('#pdt_quantity_del' + id).val();
		//alert(pdt_quantity);
		var pdt_unit_del = $('#pdt_unit_del' + id).val();
		//alert(pdt_unit_del);
		var q_p_h_id = $('#q_p_h_id' + id).val();
		//alert(q_p_h_id);
		
			$.ajax({
				type : "POST",
				url : "/index.php/sales/delete_db",
				data : "s_id=" + id + "&pdt_id=" + pdt_id + "&st_id=" + st_id + "&pdt_quantity=" + pdt_quantity + "&pdt_unit=" + pdt_unit_del + "&q_p_h_id=" + q_p_h_id + "&is_quota_limited=" + is_quota_limited,
				success : function() {

					$('#' + id).remove();

				}
			});
	
	}
});
$total_calculator = function() {

	var rows = $("#myresultTable tr");
	var total = 0;
	rows.children("td:nth-child(5)").each(function() {
		total += parseFloat($(this).html());
	});
	$("#total").val(total.toFixed(2));
	var t = $("#total").val()
	if (t == 0) {

		$("#print").hide();

		$("#back").show();
	} else {
		$("#print").show();
		$("#back").hide();
	}
};

$stockcheck = function(pdt_id) {
	var k = pdt_id;

	// var given_unit = $('#pdt_unit').val();
	// var give_quantity = $('#pdt_quantity').val();
	$.ajax({
		url : '/index.php/stock/stock_details/',
		dataType : 'json',
		type : 'POST',
		data : {
			term : k,
		},
		success : function(data) {

			var stock = data.pdt_stock;
			var stock_unit = data.stock_unit;

			if (stock == 0 || stock == '' || stock == null) {
				alert(k + ' is out of stock');
				$('#myTable :input').val("");

			}

		}
	});
$.ajax({
		type : "POST",
		url : "/index.php/home/alertincomplete_pdt/",
		data : {
			term : k,
		},
		success : function(data) {
			if(data=='inStock')
			{
				alert('Incomplete Purchase Bill(s) found for this item. Please submit or cancel it and then continue.');
				$('#myTable :input').val("");	
			}else if(data=='inSalesinStock'){
			
			alert('Incomplete Purchase Bill(s) found for this item. Please submit or cancel it and then continue.');
				$('#myTable :input').val("");	
			}
			
			
		},
		
	});		
	
}
$stockcheck_afterunitgiven = function() {
	var k = $('#pdt_id').val();

	var given_unit = $('#pdt_unit').val();
	var given_quantity = parseFloat($('#pdt_quantity').val());

	$.ajax({
		url : '/index.php/stock/stock_details/',
		dataType : 'json',
		type : 'POST',
		data : {
			term : k,
		},
		success : function(data) {
			var stock = data.pdt_stock;
			var stock_unit = data.stock_unit;

			if (stock_unit == given_unit) {

				if (given_quantity > stock) {
					alert(k + ' exceeds current stock ' + stock + stock_unit);
					$('#myTable :input').val("");
				} else if (stock == null) {
					alert(k + ' exceeds current stock ' + stock + stock_unit);
					$('#myTable :input').val("");
				} else {
					var newstock = (stock - given_quantity);
					$biller(newstock);
				}
			} else if (stock_unit == 'Tonne' && given_unit == 'Kg') {
				var stockinkg = stock * 1000;
				if (given_quantity > stockinkg) {
					alert(k + ' exceeds current stock ' + stock + stock_unit);
					$('#myTable :input').val("");
				} else {
					var newstock = (stockinkg - given_quantity) / 1000;
					$biller(newstock);
				}
			} else if (stock_unit == 'Tonne' && given_unit == 'Gram') {
				var stockingram = stock * 1000000;
				if (given_quantity > stockingram) {
					alert(k + ' exceeds current stock ' + stock + stock_unit);
					$('#myTable :input').val("");
				} else {

					var newstock = (stockingram - given_quantity) / 1000000;

					$biller(newstock);
				}
			} else if (stock_unit == 'Kg' && given_unit == 'Gram') {
				var stockingram = stock * 1000;
				if (given_quantity > stockingram) {
					alert(k + ' exceeds current stock ' + stock + stock_unit);
					$('#myTable :input').val("");
				} else {
					var newstock = (stockingram - given_quantity) / 1000;
					$biller(newstock);
				}
			} else if (stock_unit == 'L' && given_unit == 'ml') {
				var stockinmilli = stock * 1000;
				if (given_quantity > stockinmilli) {
					alert(k + ' exceeds current stock ' + stock + stock_unit);
					$('#myTable :input').val("");
				} else {
					var newstock = (stockinmilli - given_quantity) / 1000;
					$biller(newstock);
				}

			}

		}
	});

}
$remainingquota = function() {
	var purchased = parseFloat($("#purchased_quota").val());
	var total = parseFloat($('#total_quota').val());
	var remaining = parseFloat(total - purchased);

	$("#remaining_quota").val(remaining.toFixed(2));

}

$("#cancelsale").click(function(){
	var answer = confirm('Are you sure,do you want to cancel this sale?');
		if (answer) {
			 
	$('.delete').trigger('click');
	 

	}
});

$productquantityforpieces=function(){
	
	$('#pdt_quantity').keyup(function() {
	this.value = this.value.replace(/[^0-9]/g, '');
});
}
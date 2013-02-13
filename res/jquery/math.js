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
		$pdtdetails(selectedObj.value);
	},
});

$productquantityforpieces=function(){
	$('#newstock').keyup(function() {
	this.value = this.value.replace(/[^0-9]/g, '');
});
}

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
			$price_unit(data.pdt_unit);
			$price_unit_selling(data.pdt_unit_selling);
			$('#pdt_des').val(data.pdt_des);
			$('#pdt_highest_unit_for_s').val(data.pdt_highest_unit);
			//$('#pdt_highest_unit').val(data.pdt_highest_unit);
			$pdt_highest_unit_op(data.pdt_highest_unit);
			$pdt_quality_op(data.pdt_quality);
			//$('#pdt_quality').val(data.pdt_quality);
            $('#pdt_idx').val(data.pdt_id);
            $("#pdt_name2").val(data.pdt_name)
			$stock(k);
		}
	});

}
$("#pdt_id").keypress(function(event) {
if ( event.which == 13 ) {
     event.preventDefault();
     
$pdtdetails_on_enter();
   }

});
$pdtdetails_on_enter = function() {
	var k = $('#pdt_id').val();
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
			$price_unit_selling(data.pdt_unit_selling);
			$price_unit(data.pdt_unit);
			$('#pdt_des').val(data.pdt_des);
			$('#pdt_highest_unit_for_s').val(data.pdt_highest_unit);
			$pdt_highest_unit_op(data.pdt_highest_unit);
			$pdt_quality_op(data.pdt_quality);
			//$('#pdt_quality').val(data.pdt_quality);
            $('#pdt_idx').val(data.pdt_id);
			//$stock(k);
			$('#new_pdt').val(data.new_product);
			$("#pdt_name2").val(data.pdt_name)
			var np=data.new_product;
			if(np=='Y'){
				 var answer = confirm("This product is not in product list,Do you want to add it now ?")
                if (answer){
                $add_new_product();
                }
                return false;  
				
			}
		}
	});

}
$pdt_highest_unit_op=function(h_unit){
	
	var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Litre">Litre</option><option value="Pieces">Pieces</option>');
		s.appendTo("#pdt_highest_unit");
	
	var k = h_unit;
	if (k == null || k == 0 || k=='') {
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
	}else if (k == 'L') {
 $("#pdt_highest_unit").empty();
		var s = $('<option selected="true" value="L">L</option>');
		s.appendTo("#pdt_highest_unit");
	}else if (k == 'Pieces') {
		$productquantityforpieces();
 $("#pdt_highest_unit").empty();
		var s = $('<option selected="true" value="Pieces">Pieces</option>');
		s.appendTo("#pdt_highest_unit");
	}
}

$pdt_quality_op = function(quality) {
	
	var k = quality;
	if (k == null || k == 0 || k=='') {
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
	}else if (k == 'Third Quality') {
 $("#pdt_quality").empty();
		var s = $('<option selected="true" value="Third Quality">Third Quality</option>');
		s.appendTo("#pdt_quality");
	}else if (k == 'First Quality') {
 $("#pdt_quality").empty();
		var s = $('<option selected="true" value="First Quality">First Quality</option>');
		s.appendTo("#pdt_quality");
	}
	
}


$add_new_product=function(){
	
$("#pdt_name").show();
$("#pdt_ml").show();
$("#pdt_name1").show();
$("#pdt_name_ml").show();	
$('#pdt_des').removeAttr("disabled")z; 
$('#price_per_unit ').removeAttr("disabled");
$('#pdt_quality').removeAttr("disabled");
$('#price_unit').removeAttr("disabled");   
$('#price_per_unit_selling').removeAttr("disabled");
$('#price_unit_selling').removeAttr("disabled"); 
$('#pdt_highest_unit').removeAttr("disabled");   
}


$stock = function(key) {
	var k = key;
	$.ajax({
		url : '/index.php/stock/stock_details/',
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
 $('#pdt_stock_val_u').val( data.stock_unit);
	 $unit_selector();		
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
$(document).ready(function() {
	  window.setInterval(function() {
		var rows = $("#myresultTable tr");
	var total = 0;
	rows.children("td:nth-child(4)").each(function() {
		total += parseFloat($(this).html());
	});
	$("#total").val(total.toFixed(2));
	if (total==null || total==0){$("#result").hide();$("#back").show();}
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

	var total=$("#total").val();
	
	var tendercash=$("#tendercash").val();
	var b = parseFloat(tendercash)-parseFloat(total);

	$("#balance").val(b.toFixed(2));

});
$add_db = function(stk_unit) {
        var value = $("#newstock").val();
		var currentvalue = $("#pdt_stock_val").val();
		var unit = stk_unit;
		var added_stock = parseFloat(value) + parseFloat(currentvalue);
		var pdt_unit_price = $('#price_per_unit').val();
		var pdt_price_unit=	$('#price_unit').val();
		var pdt_unit_price_selling = $('#price_per_unit_selling').val();
		var pdt_price_unit_selling=	$('#price_unit_selling').val();
		var pdt_des=$('#pdt_des').val();
		var pdt_h_unit=$('#pdt_highest_unit').val();
		var pdt_quality=$('#pdt_quality').val();
		var pdt_id =$("#pdt_id").val();
		var bill_num=$("#bill_num").val();
		var pdt_name_from=$("#pdt_name2").val();
		var pdt_name=pdt_name_from;
		var pdt_name_ml=$("#pdt_name_ml2").val();
		var new_pdt=$("#new_pdt").val();
		var sub_total=$("#sub_total").val();
$.ajax({
		type : "POST",
		url : "/index.php/stock/add_db",
		data : "pdt_id=" + pdt_id + "&stock_unit=" + unit + "&added_stock=" + added_stock+ "&stock_before_load=" + currentvalue + "&stock_going_to_add=" + value+ "&stock_going_to_add=" + value
		+ "&pdt_unit_price=" + pdt_unit_price+ "&pdt_price_unit=" + pdt_price_unit + "&pdt_unit_price_selling=" + pdt_unit_price_selling+ "&pdt_price_unit_selling=" + pdt_price_unit_selling +"&pdt_des=" + pdt_des+ "&pdt_h_unit=" + pdt_h_unit+ "&pdt_quality=" + pdt_quality+ "&bill_num=" + bill_num
		+ "&pdt_name=" + pdt_name+ "&pdt_name_ml=" + pdt_name_ml+ "&new_pdt=" + new_pdt+ "&sub_total=" + sub_total,
		success : function(data) {
			$('#myTable :input').val("");
			$("#succesmsg").show();
			$("#result").show();
			$("#back").hide();
			var h = data;
			$('#myresultTable > tbody:last').prepend(h);
		},
		error : function(data) {
			alert('Ops! some thing went wrong.')
		}
	});		
}

$unit_selector = function() {
	var k = $('#pdt_stock_val_u').val();
	var h = $('#pdt_highest_unit_for_s').val();

	if (k == null || k == 0) {
          if(h=='Tonne'){
          	$("#stk_unit").empty();
          	var s = $('<!--<option value="">Select</option><option value="Tonne">Tonne</option>-->');
			s.appendTo("#stk_unit");
          }else if(h=='Quintal'){
          	$("#stk_unit").empty();
          	var s = $('<!--<option value="">Select</option><option value="Tonne">Tonne</option>-->');
			s.appendTo("#stk_unit");    	
          }else if(h=='Kg'){
          	$("#stk_unit").empty();
          	var s = $('<option value="">Select</option><option value="Kg">Kg</option>');
			s.appendTo("#stk_unit");    	
          }else if(h=='L'){
          	$("#stk_unit").empty();
          	var s = $('<option value="">Select</option><option value="L">L</option>');
			s.appendTo("#stk_unit");   	
          }else if(h=='Gram'){
          	$("#stk_unit").empty();
          	var s = $('<option value="">Select</option><option value="Gram">Gram</option>');
			s.appendTo("#stk_unit");   	
          }else if(h=='ml'){
          	$("#stk_unit").empty();
          	var s = $('<option value="">Select</option><option value="Gram">Gram</option>');
			s.appendTo("#stk_unit");	
          }else if(h=='Pieces'){
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
	}else if (k == 'L') {
 		$("#stk_unit").empty();
		var s = $('<option value="">Select</option><option value="L">L</option>');
		s.appendTo("#stk_unit");
	}else if (k == 'Kg') {
 		$("#stk_unit").empty();
		var s = $('<option value="">Select</option><option value="Kg">Kg</option>');
		s.appendTo("#stk_unit");
	}
}

$price_unit = function(price_unit) {
	var k = price_unit;
	if (k == null || k == 0 || k=='') {
 $("#price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="L">L</option><option value="ml">ml</option><option value="Pieces">Pieces</option>');
		s.appendTo("#price_unit");
	} else if (k == 'Kg') {
 $("#price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option selected="true" value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option value="L">L</option><option value="Pieces">Pieces</option>');
		s.appendTo("#price_unit");
	} else if (k == 'Pieces') {
 $("#price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option  value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option value="Litre">L</option><option selected="true" value="Pieces">Pieces</option>');
		s.appendTo("#price_unit");
	}else if (k == 'L') {
 $("#price_unit").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option selected="true" value="L">L</option><option value="Pieces">Pieces</option>');
		s.appendTo("#price_unit");
	}	
}

$price_unit_selling = function(price_unit) {
	var k = price_unit;
	if (k == null || k == 0 || k=='') {
 $("#price_unit_selling").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="L">L</option><option value="ml">ml</option><option value="Pieces">Pieces</option>');
		s.appendTo("#price_unit_selling");
	} else if (k == 'Kg') {
 $("#price_unit_selling").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option selected="true" value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option value="L">L</option><option value="Pieces">Pieces</option>');
		s.appendTo("#price_unit_selling");
	} else if (k == 'Pieces') {
 $("#price_unit_selling").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option  value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option value="Litre">L</option><option selected="true" value="Pieces">Pieces</option>');
		s.appendTo("#price_unit_selling");
	}else if (k == 'L') {
 $("#price_unit_selling").empty();
		var s = $('<option value="">Select</option><!--<option value="Tonne">Tonne</option>--><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="ml">ml</option><option selected="true" value="L">L</option><option value="Pieces">Pieces</option>');
		s.appendTo("#price_unit_selling");
	}
}

$("#stk_unit").change(function() {
	
	    var stk_unit = $('#stk_unit :selected').val();
		if (stk_unit==''||stk_unit==null){
		alert('Missing values found,Please check it.');
		$("#stk_unit").val(0);
		}else{
	    var value = $("#newstock").val();
		var currentvalue = $("#pdt_stock_val").val();
		var unit = stk_unit;
		var added_stock = parseFloat(value) + parseFloat(currentvalue);
		var pdt_unit_price = $('#price_per_unit').val();
		var pdt_price_unit=	$('#price_unit').val();
		var pdt_unit_price_selling = $('#price_per_unit_selling').val();
		var pdt_price_unit_selling=	$('#price_unit_selling').val();
		var pdt_des=$('#pdt_des').val();
		var pdt_h_unit=$('#pdt_highest_unit').val();
	var u=$('#stk_unit :selected').val();
	var p = $('#price_per_unit').val();
	var pu =$('#price_unit').val();
	if(pu==null|pu==''){
	var pu = $('#price_unit:selected').val();
	}
	var q = $('#newstock').val();
	
    var newstkvalue =$('#newstock').val();
    var pdt_unit_price = $('#price_per_unit').val();
		var pdt_price_unit=	$('#price_unit').val();
		var pdt_des=$('#pdt_des').val();
		var pdt_h_unit=$('#pdt_highest_unit').val();
		var pdt_quality=$('#pdt_quality').val();
		var pdt_id =$("#pdt_id").val();
		var bill_num=$("#bill_num").val();
		var pdt_name_from=$("#pdt_name2").val();
	
    if (newstkvalue!=''&&pdt_unit_price!=''&&pdt_price_unit!=''&&pdt_des!=''&&pdt_h_unit!=''&&pdt_id !=''&&pdt_name_from!=''){
    	
    	if (q != '') {

		if (pu == 'Kg' && u == 'Tonne') {
			
			var sub_total = parseFloat(p) * (parseFloat(q)*1000);
			$('#sub_total').val(sub_total);
		}else if(pu == 'Gram' && u == 'Tonne'){
			var sub_total = parseFloat(p) * (parseFloat(q)*1000000);
			$('#sub_total').val(sub_total);
		}else if(pu == 'Kg' && u == 'Kg'){
			var sub_total = parseFloat(p) * (parseFloat(q));
			$('#sub_total').val(sub_total);
		}else if(pu == 'gram' && u == 'Kg'){
			var sub_total = parseFloat(p) * (parseFloat(q)*1000);
			$('#sub_total').val(sub_total);
		}else if(pu == 'L' && u == 'L'){
			var sub_total = parseFloat(p) * (parseFloat(q));
			$('#sub_total').val(sub_total);
		}else if(pu == 'ml' && u == 'L'){
			var sub_total = parseFloat(p) * (parseFloat(q)*1000);
			$('#sub_total').val(sub_total);
		}else if(pu == 'ml' && u == 'ml'){
			var sub_total = parseFloat(p) * (parseFloat(q));
			$('#sub_total').val(sub_total);
		}else if(pu == 'Gram' && u == 'Gram'){
			var sub_total = parseFloat(p) * (parseFloat(q));
			$('#sub_total').val(sub_total);
		}else if(pu == 'Pieces' && u == 'Pieces'){
			var sub_total = parseFloat(p) * (parseFloat(q));
			$('#sub_total').val(sub_total);
		}else{
			alert('Invalid unit convertion(EL 456)')
		}
		
		if(q==0 || q==''){
			
			alert('You have not entered a valid quantity')
			$("#stk_unit").val(0);
		}
		 $add_db(stk_unit);
    }	
}else{

alert('Some fields are missing,please check it.')
$("#stk_unit").val(0);
}

}
});
	
$("button").live({
	click : function() {
		var id = this.id;
		//alert(id);
		//alert(st_id);
		var pdt_id = $('#pdt_id_del' + id).val();
		//alert(pdt_id);
		var stk_added = $('#stk_added' + id).val();
		//alert(pdt_quantity);
		var stk_after_add = $('#stk_after_add' + id).val();
		//alert(pdt_unit_del);
		current_stock = parseFloat(stk_added) ;
		//alert(q_p_h_id);
		var answer = confirm('Are you sure,do you want to delete this item?');
		if (answer) {

			$.ajax({
				type : "POST",
				url : "/index.php/stock/delete_db",
				data : "spa_id=" + id + "&pdt_id=" + pdt_id + "&current_stock=" + current_stock ,
				success : function() {

					$('#' + id).remove();
$('#myTable :input').val("");
				}
			});
		}
	}
});

$("button1").live({
	click : function() {
		var id = this.id;
		//alert(id);
		//alert(st_id);
		var pdt_id = $('#pdt_id_del' + id).val();
		//alert(pdt_id);
		var stk_added = $('#stk_added' + id).val();
		//alert(pdt_quantity);
		var stk_after_add = $('#stk_after_add' + id).val();
		//alert(pdt_unit_del);
		current_stock = parseFloat(stk_added) ;
		//alert(q_p_h_id);
		

			$.ajax({
				type : "POST",
				url : "/index.php/stock/delete_db",
				data : "spa_id=" + id + "&pdt_id=" + pdt_id + "&current_stock=" + current_stock ,
				success : function() {

					$('#' + id).remove();
                   $('#myTable :input').val("");
				}
			});
		}
	
});

$("#cancelload").click(function(){
	var answer = confirm('Are you sure,do you want to cancel this load?');
		if (answer) {
			 
	$('.delete').trigger('click');
	 

	}
});
$("#pdt_highest_unit").change(function() {

	var hs_unit = $('#pdt_highest_unit :selected').val();
	$("#stk_unit").empty();
	var s = $('<option value="">Select</option><option value="'+hs_unit+'">'+hs_unit+'</option>');
		s.appendTo("#stk_unit");
});
$addcancel=function(){
	$("#pdt_name").hide();
	$("#pdt_ml").hide();
	$("#pdt_name1").hide();
	$("#pdt_name_ml").hide();	
	$('#pdt_des').attr("disabled","true"); 
	$('#price_per_unit').attr("disabled","true");
	$('#pdt_quality').attr("disabled","true");
	$('#price_unit').attr("disabled","true");   
	$('#pdt_highest_unit').attr("disabled","true");  
$('#price_per_unit_selling').attr("disabled","true");
$('#price_unit_selling').attr("disabled","true"); 
  
}

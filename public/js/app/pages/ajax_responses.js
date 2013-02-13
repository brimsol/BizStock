$(document).ready(function(){
	$('#add_pdt').submit(function(){
		$(this).hide();
		if($('#_alert_box').length > 0) $('#_alert_box').remove();
			var alert_msg   = $('<div id="_alert_box" class="alert alert-info">Please wait...</div>');
		$(this).before(alert_msg);

		alert_msg.ajaxSend(function(){
			//alert("--->Inside ajaxSend");
			alert_msg.text("Processing...");
		});
		
		var action = $(this).attr("action");
		//alert(action);
		
		var pdt_id					= $('#pdt_id').val();
		var pdt_name  				= $('#pdt_name').val();
		var pdt_name_ml				= $('#pdt_name_ml').val();
		var pdt_description			= $('#pdt_description').val();
		var quality					= $('#quality').val();
		var pdt_sell_price				= $('#pdt_sell_price').val();
		var pdt_sell_price_unit          = $('#pdt_sell_price_unit').val();
		var pdt_purchase_price	    = $('#pdt_purchase_price').val();
		var pdt_purchase_price_unit	= $('#pdt_purchase_price_unit').val();
		var hs_unit					= $('#hs_unit').val();
		var ls_unit					= $('#ls_unit').val();
		var is_quota_limited		= $('#is_quota_limited').val();
		var bpl_quota				= $('#bpl_quota').val();
		var bpl_quota_unit			= $('#bpl_quota_unit').val();
		var apl_quota				= $('#apl_quota').val();
		var apl_quota_unit			= $('#apl_quota_unit').val();
		//alert("is_quota_limited: " + "*" + is_quota_limited + "*");
		$.post(action, {
				pdt_id: pdt_id,
				pdt_name: pdt_name,
				pdt_name_ml: pdt_name_ml,
				pdt_description: pdt_description,
				quality: quality,
				pdt_sell_price: pdt_sell_price,
				pdt_sell_price_unit: pdt_sell_price_unit,
				pdt_purchase_price: pdt_purchase_price,
				pdt_purchase_price_unit: pdt_purchase_price_unit,
				hs_unit: hs_unit,
				ls_unit: ls_unit,
				is_quota_limited: is_quota_limited,
				bpl_quota: bpl_quota,
				bpl_quota_unit: bpl_quota_unit,
				apl_quota: apl_quota,
				apl_quota_unit: apl_quota_unit
			}, function(data){
			data = $.parseJSON(data);
			//alert('data.type: ' + data.type);
			if(data.type == "success"){
				//alert("---> success message");
				alert($('input[type=submit]').val());
				alert_msg.removeClass('alert-info').addClass('alert-success').html("<span class='label label-success'>Success!</span> <br/><br/>"+data.msg+'<p>File size: 0 KB</p>');
				if($('input[type=submit]').val() == "Create"){
					alert_msg.after($('<a href="/product/addProduct" class="pull-right btn btn-small">Add more products &raquo;</a>'));
				}else{
					alert_msg.after($('<a href="/board" class="pull-right btn btn-small">Back to dashboard &raquo;</a>'));
				}
			}else{
				alert("---> Ooops..! Something went wrong.");
				var items = [];
				$.each(data.errors, function(key, val){
					if(val != ""){
						items.push(val);
						$('#'+key).parent().parent().addClass("error");
					}else{
						$('#'+key).parent().parent().removeClass("error");
					}
				});
				alert_msg.removeClass('alert-info').addClass('alert-error').html("<ul>"+items.join('')+"</ul>");
				$('#add_pdt').show();
			}
		});
		return false;
	});
});
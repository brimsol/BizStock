$(document).ready(function(){
	$('#contact_page_form').submit(function(){
		$(this).hide();
		if($('#_alert_box').length > 0) $('#_alert_box').remove();
		var alert_msg   = $('<div id="_alert_box" class="alert alert-info">Please wait...</div>');
		$(this).before(alert_msg);

		alert_msg.ajaxSend(function(){
			alert_msg.text("Sending message...");
		});
		
		var action = $(this).attr("action");

		var input_name           = $('#input_name').val();
		var input_contact_number = $('#input_contact_number').val();
		var input_email          = $('#input_email').val();
		var input_message        = $('#input_message').val();
		$.post(action, {
				input_name: input_name, 
				input_contact_number: input_contact_number, 
				input_email: input_email, 
				input_message: input_message
			}, function(data){
			data = $.parseJSON(data);
			if(data.type == "success"){
				alert_msg.removeClass('alert-info').addClass('alert-success').html(data.msg);
			}else{
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
				$('#contact_page_form').show();
			}
		});

		return false;
	});
});

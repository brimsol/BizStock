$(document).ready(function(){
	$('#welcome_login_form_alert').hide();
	$('#welcome_login_form').submit(function(){
		var alert_msg = $('#welcome_login_form_alert');
		alert_msg.ajaxSend(function(){
			alert_msg.addClass('alert-info').removeClass('alert-error');
			alert_msg.text("Logging In...Please Wait..");
			alert_msg.fadeIn(250);
		});
		
		var action = $(this).attr("action");

		var username           = $('#username').val();
		var hashed_password    = $('#hashed_password ').val();
		
		$.post(action, {
				username: username, 
				hashed_password: hashed_password
			}, function(data){
			data = $.parseJSON(data);
			// alert(data.type);
			
			if(data.type == "success"){
				// alert("POST Sucess");
				alert_msg.removeClass('alert-info alert-error').addClass('alert-success').html(data.msg);
				document.location.href = data.uri; 
			}else{
				// alert("POST Failed");
				alert_msg.removeClass('alert-info').addClass('alert-error').html(data.msg);
				$('#hashed_password').val('').focus();
			}
		});

		return false;
	});
});

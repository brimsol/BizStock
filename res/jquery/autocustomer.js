$( "#search" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/customer/auto/',
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

$('#search').keypress(function(e) {
    if(e.which == 13) {
       var $key=$('#search').val();
       if($key!=''){
        $.ajax({
		url:'/index.php/customer/cus_result/',
		data:'key='+$key,
		success:function(data){
			$('#userresult2').html(data);
		}
	});}
    }
    
});



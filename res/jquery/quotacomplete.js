$( "#search" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/product/auto/',
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
$( "#search_name" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/product/auto/',
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
            
$( "#search_id" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/stock/auto_id/',
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
$( "#search_name_clear" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/product/auto/',
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
            
$( "#search_id_clear" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/stock/auto_id/',
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
		url:'/index.php/product/pdt_result/',
		data:'key='+$key,
		success:function(data){
			$('#userresult2').html(data);
		}
	});}
    }
 
});
$('#search_name').keypress(function(e) {
    if(e.which == 13) {
       var key=$('#search_name').val();
       if(key!=''){
      window.location.href ="/index.php/quota/addgetname/"+key;
      
      }
    }
    
});
$('#search_id').keypress(function(e) {
    if(e.which == 13) {
       var key=$('#search_id').val();
       if(key!=''){
      window.location.href ="/index.php/quota/addgetid/"+key;
      
      }
    }
    
});
$('#search_name_clear').keypress(function(e) {
    if(e.which == 13) {
       var key=$('#search_name_clear').val();
       if(key!=''){
      window.location.href ="/index.php/stock/cleargetname/"+key;
      
      }
    }
    
});
$('#search_id_clear').keypress(function(e) {
    if(e.which == 13) {
       var key=$('#search_id_clear').val();
       if(key!=''){
      window.location.href ="/index.php/stock/cleargetid/"+key;
      
      }
    }
    
});




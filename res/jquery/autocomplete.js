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
             
             $( "#search_name1" ).autocomplete({
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
             $( "#search_id1" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/product/auto_id/',
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
      window.location.href ="/index.php/stock/addgetname/"+key;
      
      }
    }
    
});
$('#search_id').keypress(function(e) {
    if(e.which == 13) {
       var key=$('#search_id').val();
       if(key!=''){
      window.location.href ="/index.php/stock/addgetid/"+key;
      
      }
    }
    
});
$('#search_name1').keypress(function(e) {
      if(e.which == 13) {
       var $key=$('#search_name1').val();
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
$('#search_id1').keypress(function(e) {
       if(e.which == 13) {
       var $key=$('#search_id1').val();
       if($key!=''){
        $.ajax({
		url:'/index.php/product/pdt_result2/',
		data:'key='+$key,
		success:function(data){
			$('#userresult2').html(data);
		}
	});}
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

$( "#search_idr" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/stock/auto_sid/',
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

$('#search_idr').keypress(function(e) {
    if(e.which == 13) {
       var key=$('#search_idr').val();
       if(key!=''){
      window.location.href ="/index.php/stock/report_details_id/"+key;
      
      }
    }
    
});
$( "#search_namer" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/stock/auto_sname/',
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

$('#search_namer').keypress(function(e) {
    if(e.which == 13) {
       var key=$('#search_namer').val();
       if(key!=''){
      window.location.href ="/index.php/stock/report_details_name/"+key;
      
      }
    }
    
});

$( "#search_name2" ).autocomplete({
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
             
             $( "#search_name2" ).autocomplete({
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
            
$( "#search_id2" ).autocomplete({
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
             $( "#search_id2" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/product/auto_id/',
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
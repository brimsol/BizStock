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
       var key=$('#search').val();
       if(key!=''){
      window.location.href ="/index.php/sales/checkcard/"+key;
      
      }
    }
    
});

$( "#pdt_des" ).autocomplete({
				source: function(req, add){
                $.ajax({
                    url: '/index.php/product/desauto/',
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



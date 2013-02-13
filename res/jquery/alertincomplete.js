$(document).ready(function() {
$('#inalertsales').hide();	
$('#inalertstock').hide();	
	$.ajax({
		type : "POST",
		//url : "/index.php/home/alertincomplete",
		success : function(data) {
			if(data=='inSalesinStock')
			{
			$('#inalertstock').show();
			$('#inalertsales').show();			
			}
			
			if(data=='inSales'){
			$('#inalertsales').show();		
			}else if(data=='inStock'){
			$('#inalertstock').show();	
			}
		},
		
	});		
 

});
		



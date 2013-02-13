$(document).ready(function() {
		$update_q_n();
		$update_q_y();
   		$('#appendedInputButton1').keyup(function () { 
    		this.value = this.value.replace(/[^0-9\.]/g,'');
		}
		)

  });


$(document).ready(function() {
    var currentPrice = $('#current_value').val();
    $("#calc").click(function() {
         var value = $("#newvalue").val();  
         var unit=$('#unit').val();   
              
 var newValue = parseFloat(value) + parseFloat(currentPrice);               
        $('#result1').val(newValue);
        $('#result').attr('value',newValue);
        $('#newunit').val(unit);
        $('#newunitk').attr('value',unit);
      
    });
});

$update_q_n=function(){
	
	var pdt_id=$('#pdt_id').val();
	var c_apl_q=$('#c_apl_q').val();
	var c_bpl_q=$('#c_bpl_q').val();
	if (c_apl_q=='No quota limit' && c_bpl_q=='No quota limit'){
		$('#quota').hide();
		$('#is_quota').attr('checked', false);

		$.ajax({
			
		url:'/index.php/product/update_is_quota_limited/',
		type : 'POST',
		data:'key='+pdt_id,
		success:function(){

		}
	});
	}
	
}	
$update_q_y=function(){
	var pdt_id=$('#pdt_id').val();
	var c_apl_q=$('#c_apl_q').val();
	var c_bpl_q=$('#c_bpl_q').val();
	if (c_apl_q!='No quota limit' || c_bpl_q!='No quota limit'){
		$('#quota').show();
		$('#is_quota').attr('checked', true);
		$.ajax({
		url:'/index.php/product/update_is_quota_limited_y/',
		type : 'POST',
		data:'key='+pdt_id,
		success:function(){
		
		}
	});
  }
}
$(':checkbox').change(function(){
	    if (this.checked) {
        $('#quota').show();
         }else{
    	 	$('#quota').hide();
         }
});
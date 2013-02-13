$(document).ready(function() {
	
	   if($("#is_quota").is(':checked')){
    $("#quota").show();  // checked
    var u=$('#pdt_price_unit').val();
        $('#quota_unit').val(u);
        $('#quota_unit2').val(u);
    }else{
    $("#quota").hide()
}
});
	$('#bpl_quota').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
$('#apl_quota').keyup(function () { 
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
    

$(':checkbox').change(function(){
	    if (this.checked) {
    	
        $('#quota').show();
        
        var u=$('#pdt_price_unit').val();
        $('#quota_unit').val(u);
        $('#quota_unit2').val(u);
    }else{
    	$('#quota').hide();
    	
    }
}); 
$('#pdt_price_unit').change(function(){

	var u=$('#pdt_price_unit').val();
        $('#quota_unit').val(u);
        $('#quota_unit2').val(u);

});
/*$("#hs_unit").change(function() {
	var k = $('#hs_unit:selected').val();
	if (k == null || k == 0 || k=='') {
 $("#ls_unit").empty();
		var s = $('<option value="">Select</option><option value="Kg">Kg</option><option value="Gram">Gram</option><option value="L">L</option><option value="ml">ml</option><option value="Pieces">Piece</option>');
		s.appendTo("#ls_unit");
	} else if (k == 'Kg') {
 $("#ls_unit").empty();
		var s = $('<option value="">Select</option><option value="Kg">Kg</option><option value="Gram">Gram</option>');
		s.appendTo("#ls_unit");
	} else if (k == 'Pieces') {
 $("#ls_unit").empty();
		var s = $('<option value="">Select</option><option value="Pieces">Piece</option>');
		s.appendTo("#ls_unit");
	}else if (k == 'L') {
 $("#ls_unit").empty();
		var s = $('<option value="">Select</option><option value="L">L</option><option value="ml">ml</option>');
		s.appendTo("#ls_unit");
	}
});*/
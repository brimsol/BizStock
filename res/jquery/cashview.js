$(document).ready(function() {
	
	window.setInterval(function() {
		$total_calculator();
		//$total_closing();
        $total_opening();
        $total_op_calculator();
        $salesvalue();
        $todaysalesvalue();
	}, 500);
 

});

$( "#1000" ).keyup(function(){
	
	var d = $('#1000').val();
	var s = d*1000;
	
	$('#1000x').val(s);
	
	
});
$( "#500" ).keyup(function(){
	
	var d = $('#500').val();
	var s = d*500;
	
	$('#500x').val(s);
	
	
});
$( "#100" ).keyup(function(){
	
	var d = $('#100').val();
	var s = d*100;
	
	$('#100x').val(s);
	
	
});
$( "#50" ).keyup(function(){
	
	var d = $('#50').val();
	var s = d*50;
	
	$('#50x').val(s);
	
	
});
$( "#20" ).keyup(function(){
	
	var d = $('#20').val();
	var s = d*20;
	
	$('#20x').val(s);
	
	
});
$( "#10" ).keyup(function(){
	
	var d = $('#10').val();
	var s = d*10;
	
	$('#10x').val(s);
	
	
});
$( "#5" ).keyup(function(){
	
	var d = $('#5').val();
	var s = d*5;
	
	$('#5x').val(s);
	
	
});
$( "#2" ).keyup(function(){
	
	var d = $('#2').val();
	var s = d*2;
	
	$('#2x').val(s);
	
	
});
$( "#1" ).keyup(function(){
	
	var d = $('#1').val();
	var s = d*1;
	
	$('#1x').val(s);
	
	
});
$( "#50p" ).keyup(function(){
	
	var d = $('#50p').val();
	var s = d*.5;
	
	$('#50psx').val(s);
	
	
});
$( "#25p" ).keyup(function(){
	
	var d = $('#25p').val();
	var s = d*.25;
	
	$('#25psx').val(s);
	
	
});
$total_calculator = function() {
    
	var a =parseInt ($('#1000x').val());
	var b =parseInt ($('#100x').val());
	var c =parseInt ($('#500x').val());
	var d =parseInt ($('#50x').val());
	var e =parseInt ($('#20x').val());
	var f =parseInt ($('#10x').val());
	var g =parseInt ($('#5x').val());
	var h =parseInt ($('#2x').val());
	var i =parseInt ($('#1x').val());
	var j =parseFloat ($('#50psx').val());
	var k =parseFloat ($('#25psx').val());
	to=a+b+c+d+e+f+g+h+i+j+k;
	var t = to;
	$('#total').val(t);
};


// $total_closing = function() {
//     
	// var a =parseFloat ($('#total').val());
	// var b =parseFloat($('#prev_total').val());
// 	
	// to=a-b
	// var t = to;
	// $('#totalclose').val(t);
// };
$todaysalesvalue= function() {
    
	var a =parseFloat ($('#op_bal').val());
	var b =parseFloat($('#rtotal').val());
	
	to=b-a
	var t = to;
	$('#totalclose').val(t);
};

$salesvalue= function() {
    
	var a =parseFloat ($('#opvalue').val());
	var b =parseFloat($('#clovalue').val());
	
	to=b-a
	var t = to;
	$('#salevalue').val(t);
};

$total_opening = function() {
    
	var d = $('#r1000').val();
	var s = d*1000;
	
	$('#r1000x').val(s);
	var d = $('#r500').val();
	var s = d*500;
	
	$('#r500x').val(s);
	var d = $('#r100').val();
	var s = d*100;
	
	$('#r100x').val(s);
	var d = $('#r100').val();
	var s = d*100;
	
	$('#r100x').val(s);
	var d = $('#r20').val();
	var s = d*20;
	
	$('#r20x').val(s);
	var d = $('#r50').val();
	var s = d*50;
	
	$('#r50x').val(s);
	var d = $('#r10').val();
	var s = d*10;
	
	$('#r10x').val(s);
	var d = $('#r5').val();
	var s = d*5;
	
	$('#r5x').val(s);
	var d = $('#r2').val();
	var s = d*2;
	
	$('#r2x').val(s);
	var d = $('#r1').val();
	var s = d*1;
	
	$('#r1x').val(s);
	var d = $('#r50p').val();
	var s = d*.5;
	
	$('#r50psx').val(s);
	var d = $('#r25p').val();
	var s = d*.25;
	
	$('#r25psx').val(s);
	
	
};

	$total_op_calculator = function() {
    
	var a =parseInt ($('#r1000x').val());
	var b =parseInt ($('#r100x').val());
	var c =parseInt ($('#r500x').val());
	var d =parseInt ($('#r50x').val());
	var e =parseInt ($('#r20x').val());
	var f =parseInt ($('#r10x').val());
	var g =parseInt ($('#r5x').val());
	var h =parseInt ($('#r2x').val());
	var i =parseInt ($('#r1x').val());
	var j =parseFloat ($('#r50psx').val());
	var k =parseFloat ($('#r25psx').val());
	to=a+b+c+d+e+f+g+h+i+j+k;
	var t = to;
	$('#rtotal').val(t);
};					
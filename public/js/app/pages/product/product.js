$('#pdt_id').keyup(function() {
	this.value = this.value.toUpperCase();
});

$(document).ready(function() {
	// checked
	if ($("#is_quota_limited").is(':checked')) {
		$("#quota").show();

		var u = $('#pdt_price_unit').val();
		$('#bpl_quota_unit').val(u);
		$('#apl_quota_unit').val(u);
	} else {
		$("#quota").hide()
	}
});

$(':checkbox').change(function() {
	if (this.checked) {
		$('#quota').show();
		var u = $('#pdt_price_unit').val();
		$('#bpl_quota_unit').val(u);
		$('#apl_quota_unit').val(u);
	} else {
		$('#quota').hide();
	}
});

$('#pdt_price_unit').change(function() {
	var u = $('#pdt_price_unit').val();
	$('#bpl_quota_unit').val(u);
	$('#apl_quota_unit').val(u);
});

$('#bpl_quota').keyup(function() {
	this.value = this.value.replace(/[^0-9\.]/g, '');
});

$('#apl_quota').keyup(function() {
	this.value = this.value.replace(/[^0-9\.]/g, '');
});
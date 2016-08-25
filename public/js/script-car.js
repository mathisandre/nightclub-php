
/* Change car type */

$('.vehicleCheckChoice').change(function(){
	var attr = $(this).val();

	/* Check value and show content about */
	if(attr=='car') {
		$('#select-module-car').css('padding', '20px 0px 20px 0px');
		$('#car-module-form').show();
	} else {
		$('#select-module-car').css('padding', '20px 0px 0px 0px');
		$('#car-module-form').hide();
	}
});
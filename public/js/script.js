var url = 'http://clubenfin.be/';

/* Scroll Effect */

$('a[href^="#"]').click(function() {
	var link = $(this).attr("href");

	$('html, body').animate({
		scrollTop:$(link).offset().top
	}, 'slow');
});

$('#btn_men').on('click', function(){
	$('#form_member1').show();
	$('#form_member2').hide();
});

$('#btn_women').on('click', function(){
	$('#form_member2').show();
	$('#form_member1').hide();
});


$('.birthday').datepicker();

/*
$('#cameraIco').on('click', function(){
	$('#fileUpload').click();
});

$('#fileUpload').on('change', function(){
	$('#form_upload_member').submit();
});
*/

$('#btn_men').on('click', function(){
	$(this).css('background', 'transparent');
	$('#btn_women').css('background', '#fff');
});

$('#btn_women').on('click', function(){
	$(this).css('background', 'transparent');
	$('#btn_men').css('background', '#fff');
});

$('#cookie_accept').on('click', function(){
	$('#cookieInfos').hide();
	$.ajax({
		type: 'post', 
		url: url + 'main/cookie_dismissed',
	});
});
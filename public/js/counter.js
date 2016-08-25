/* Clock */

var clock;
var url = 'http://localhost:8888/ClubEnfin/';
	
$(document).ready(function() {
	var clock;

	var opening = new Date('09/03/2016 21:30:00');
	var now = new Date();
		
	var opening_date = (opening.getTime() - now.getTime()) / 1000;

	clock = $('.clock').FlipClock({
	    clockFace: 'DailyCounter',
	    autoStart: true
	});
			    
	clock.setTime(opening_date);
	clock.setCountdown(true);
	clock.start();
});


/* Members */


function getTotalMember() {
	$.ajax({
		type: 'GET',
		url: url + 'register/counter',
		success: function(responseText) {
			$('a.gold').html(responseText + '<br>');
		}
	});
	setTimeout(getTotalMember, 5000);
}

getTotalMember();
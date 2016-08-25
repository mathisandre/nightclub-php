$(document).ready(function(){
	$('#mainLogo img').animate({
		width: "500px",
	}, {
		duration: 2000,
		complete: function(){
			$('#exclusiveLogo img').animate({
				width: "275px",
			}, {
				duration: 1000,
				complete: function(){
					$('#languagesBloc').animate({
						opacity: 1,
						bottom: '150px',
					}, 2000);
				},
			});
		}
	});
});
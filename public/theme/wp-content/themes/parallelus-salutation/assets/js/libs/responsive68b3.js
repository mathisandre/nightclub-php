jQuery(document).ready(function($) {

	$(document).mouseup(function (e) {
	    var container = $("#MM");

	    if (!container.is(e.target) // if the target of the click isn't the container...
	        && container.has(e.target).length === 0) { // ... nor a descendant of the container
	       		container.find('.sub-menu').hide();
	    }
	});

	$('.touching').on( 'click', '.hasSubMenu', function(e) {	
		e.preventDefault();
		var thisNext = $(this).next();	
		$('.sub-menu').each(function() {
			if($(this).css('display') == "block" && thisNext.css('display') != "block" ){
				$(this).hide('slow');
			}
		});		
		$(this).parent().addClass('li_hover');
		if(thisNext.css('display') == 'none') {
			$(this).next().slideDown();
		} else {
			$(this).next().slideUp();
			$(this).parent().removeClass('li_hover');
		}
	});
	$('.touching .sub-menu a').on( 'click', function(e) {
		var thisNext = $(this).next();
		if($(this).children().size() > 0) {
			e.preventDefault();
			thisNext.toggle('600', 'linear');

		}
	});

	$('#MM_responsive_show').on( 'click', function() {
		$(this).hide();
		$('#MM_responsive_hide, #MM').show();
	});

	$('#MM_responsive_hide').on( 'click', function() {
		$("#MM_responsive_hide, #MM").hide();
		$('#MM_responsive_show').show();
	});
	
	// Home slider 
	// The function with timeout for waiting for other functions' completion

	$(window).resize(function() {

		// Portfolio
		$('.portfolio-list').find('.item-container').css('height','auto'); //reset on resize
		
		// Menu
		if ( window.innerWidth < 768 ) {
			$('#MM').hide();
			$('#MM_responsive_hide').hide();
			$('#MM_responsive_show').show();
		} else {
			$('#MM').show();
			$('#MM_responsive_hide').hide();
			$('#MM_responsive_show').hide();	
		} 

		// Home slider
		$('.slideShow img').each(function() {
			if($(this).height() != 0) {
				var smallHeight = $(this).height();
				var originalHeight = $('.slideShow').height();
				if (smallHeight < originalHeight) {
					$('.slideShow').height(smallHeight);
					$('.slideShow > div[id^="SS-"] div').height(smallHeight);
				}
			}
		});

		// Contact Form
		$('.contactFormWrapper input, .contactFormWrapper textarea, .publicForm input, .publicForm textarea').each( function() {
			var maxW = $('.contactFormWrapper').width();
			$(this).css('max-width', maxW);
		});
	});


});



jQuery(window).load(function ($) {
	jQuery('.portfolio-list').find('.item-container').css('height','auto'); //reset on resize
	jQuery('.portfolio-list').portfolioHeightFix(); // reapply after resize	
});

// ======================================================================
//	Responsive Design Functions
// ======================================================================

// Browser re-size adjustments (important for orientation change)
// -------------------------------------------------------------------
(function($) {
	// Portfolio Height Adjust (for uniform display if heigh variation)
	// -------------------------------------------------------------------
	$.fn.portfolioHeightFix = function(opts) {
		var pGroup = $(this);
		// for each portfolio instance
		this.each( function() {
			var h = 0;
			// get all items in the group
			$pItems = $(this).find('.item-container');

			$pItems.each( function(i, val) {
				console.log($(this).attr('class'));
				if ($(this).height() > h) {
					// get the greatest height value
					h = $(this).height();
				}
			});


			$pItems.css('height',h+'px'); // set all to max height
		});
	}

	$.fn.responsiveScale = function(ratio) {
		this.each(function() {
			var _this = $(this),
				_w = ( typeof _this.data('width') !== "undefined" ) ? _this.data('width') : _this.width(),
				_h = ( typeof _this.data('height') !== "undefined" ) ? _this.data('height') : _this.height();

				if (typeof ratio !== "undefined") {
					var _ratio = ratio;
				} else {
					var _ratio = (typeof _this.data('ratio') !== "undefined") ? _this.data('ratio') : _w / _h;
				}
			$(window).resize(function() {
				var w = _this.width(); 
				_this.css('height', Math.round((w / _ratio))+'px');
			});
		});
		
		$(window).trigger('resize');
		return this;
	};
		
	$('.slideShow').responsiveScale();
	$('.slideShow .contentSlide').responsiveScale();
	$('.slideShow .slideAnimate img').responsiveScale();

})(jQuery);
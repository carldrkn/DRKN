$(function() {
	var realWidth = {};
  
	realWidth.getWindowWidth = function() {
		var windowWidth = 0;
		if (typeof(window.innerWidth) === 'number') {
			windowWidth = window.innerWidth;
		}
		else {
			if (document.documentElement && document.documentElement.clientWidth) {
				windowWidth = document.documentElement.clientWidth;
			}
			else {
				if (document.body && document.body.clientWidth) {
					windowWidth = document.body.clientWidth;
				}
			}
		}
		return windowWidth;
	};
	

	var swipeSlider = {};
	
	swipeSlider.initial = function() {
		var swiper = new Swiper( '.swiper-container' );
	};
	
	swipeSlider.exec = function() {
		if( $('.swiper-container').length > 0 ) {
			if( realWidth.getWindowWidth() < 767 ) {
				if ( $('.swiper-container').is(':empty') ){
					var slideDt = $( '.slide-desktop' ).html();
					$( '.swiper-container' ).html( '<div class="swiper-wrapper">' + slideDt + '</div>' );
					swipeSlider.initial();
				}
			}
		}
	};
	
	swipeSlider.exec();
	
	//resize
	$(window).on('resize',function(){
		swipeSlider.exec();
	});
});

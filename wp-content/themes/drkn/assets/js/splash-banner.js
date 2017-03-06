(function($) {
	var Splash = {};

	Splash.BannerRep = function () {
		var currentImage;

		$(".replace-img").hover(function(){
			if(drkn.documentWidth().width > 767){
				newImage = $( this ).data('second-image');
				oldImage = $( this ).find('img').attr('src');
				
				if(newImage ) {
					$( this ).find('img').attr('src', newImage);
					$( this ).data('second-image', oldImage);
				}
			}
			
		},function(){
			if(drkn.documentWidth().width > 767){
				newImage = $( this ).data('second-image');
				oldImage = $( this ).find('img').attr('src');

				if(newImage ) {
					$( this ).find('img').attr('src', newImage);
					$( this ).data('second-image', oldImage);
				}
			}
		});
	};

	var VideoBG = {};

	VideoBG.init = function() {
		$( '.video-inner' ).backgroundVideo();

		if( drkn.documentWidth().width <= 1024 && $( '.video-inner' ).length != 0 ){
			$( '.video-inner video' ).get(0).pause();
		}

		$( '.video-play' ).on( 'click', function( e ){
			e.preventDefault();

			if( drkn.documentWidth().width <= 1024 ) {
				if( $( this ).find( 'img' ).is(":visible") ) {
				$( '.video-play img' ).hide();
				$( '.video-inner video' ).show();
				$( '.video-inner video' ).get(0).play();
				} else {
					$( '.video-play img' ).show();
					$( '.video-inner video' ).hide();
					$( '.video-inner video' ).get(0).pause();
				}
			} else {
				if( $( this ).find( 'img' ).is(":visible") ) {
					$( '.video-play img' ).hide();
					$( '.video-inner video' ).get(0).play();
				} else {
					$( '.video-play img' ).show();
					$( '.video-inner video' ).get(0).pause();
				}
			}
		});
	}; 

	// Initialize
	$(document).ready(function() {
		Splash.BannerRep();
		VideoBG.init();
	});
})(jQuery);



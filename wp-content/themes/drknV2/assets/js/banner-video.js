jQuery(function($) {

	var Viewport = {};
	Viewport.documentWidth = function(){
		var e = window, a = 'inner';
			if (!('innerWidth' in window )) {
			  a = 'client';
			  e = document.documentElement || document.body;
			}
		return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };

	};

	var VideoBG = {};
	VideoBG.init = function() {

		var container = $( '.video-outer' );

		$( '.video-play' ).on( 'click', function(){
			container.find( 'video' ).get(0).play();
			$( this ).hide();
			if( Viewport.documentWidth().width <= 991 ){
				container.find( 'video' ).show();
				container.find( 'video' ).prop('muted', false);
			}
		});

		$( '.video-inner video' ).on( 'click', function(){
			if( Viewport.documentWidth().width <= 991 ){
				$( this ).hide();
				$( this ).prop('muted', true);
			}
			else{
				$( this ).get(0).pause();
			}
			container.find( '.video-play' ).show();

		});

	};

	// Initialize
	$(document).ready(function() {
		VideoBG.init();
	});

});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function( $ ) {
	
	var Inspiration = {};
	
	Inspiration.load = function( target ) {
		var container = $( '#InspirationModal .content' );
		
		container.html( '' );
		
		$.post(
			target.attr( 'href' ),
			{ 'NextID': target.data( 'next' ), 'PrevID': target.data( 'prev' ) },
			function( response ) {
				container.html( response );
				
				container.find( '#InspirationImage' ).on( 'load', function() {
					$( this ).fadeIn();
					$( '.spinner-container' ).hide();
				} );

				Inspiration.controlsInit();
			}
		);
	};
	
	Inspiration.controlsInit = function() {
		$( 'a.arrow' ).click( function( e ) {
			e.preventDefault();
			
			var target = $( '#Ins-' + $( this ).data( 'id' ) );
			
			Inspiration.load( target );
		} );
	};
	
	$( document ).ready( function() {
		$( '#InspirationModal' ).on( 'show.bs.modal', function( e ) {
			 var target = $( e.relatedTarget );
			 
			 Inspiration.load( target );
		} );
	} );
	
})( jQuery );
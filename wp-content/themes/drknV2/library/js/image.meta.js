/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var MetaImage = {};

( function( $ ) {
	
	MetaImage.show = function( image, parent ) {
		if( image.length === 0 ) {
			return;
		}
		
		parent.find( '.meta-image-tag' ).attr( 'src', image.data( 'src' ) );
		
		if( image.val() ) {
			parent.find( '.image-wrapper' ).show();
		}
	};
	
	MetaImage.hide = function( image, parent ) {
		if( image.length === 0 ) {
			return;
		}
		
		parent.find( '.meta-image-tag' ).attr( 'src', image.data( 'src' ) );
		parent.find( '.image-wrapper' ).hide();
	};
	
	$( document ).ready( function() {
		$( '.meta-image-btn' ).click( function( e ) {
			e.preventDefault();
			
			var metaImageFrame;

			if( metaImageFrame ) {
				metaImageFrame.open();
				return;
			}
			
			var parent = $( this ).parents( '.image-container' );
			var image = parent.find( '.meta-image' );
			
			// Sets up the media library frame
			metaImageFrame = wp.media.frames.metaImageFrame = wp.media( {
				title: meta_image.title,
				button: { text:  meta_image.button },
				library: { type: 'image' }
			} );

			// Runs when an image is selected
			metaImageFrame.on( 'select', function() {
				var mediaAttachment = metaImageFrame.state().get( 'selection' ).first().toJSON();
				
				image.val( mediaAttachment.id );
				image.data( 'src', mediaAttachment.url );
				
				MetaImage.show( image, parent );
			} );

			// Opens the media library frame
			metaImageFrame.open();
		} );
		
		$( '.meta-image-del' ).click( function( e ) {
			e.preventDefault();
			
			var parent = $( this ).parents( '.image-container' );
			var image = parent.find( '.meta-image' );
				
			image.val( '' );
			
			MetaImage.hide( image, parent );
		} );
		
		$( '.meta-image' ).each( function() {
			var parent = $( this ).parents( '.image-container' );
			var image = $( this );
			
			MetaImage.show( image, parent );
		} );
	} );
	
} )( jQuery );
/*
 * WP ADMIN SCRIPT
 * Attaches single image uploader to custom post types image uploads
 */
jQuery(document).ready(function($){

	// Instantiates the variable that holds the media library frame.
	var meta_image_frame;

	// Runs when the image button is clicked.
	$('.meta-image .meta-image-button').click(function(e){

		var $container = $(this).closest('.meta-image');

		// Prevents the default action from occuring.
		e.preventDefault();

		/*
		// If the frame already exists, re-open it.
		if ( meta_image_frame ) {
			meta_image_frame.open();
			return;
		}*/

		// Sets up the media library frame
		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: 'Select image',
			button: { text:  'Use image' },
			library: { type: 'image' }
		});

		// Runs when an image is selected.
		meta_image_frame.on('select', function(){

			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

			// Sends the attachment URL to our custom image input field.
			$container.find('.meta-image-value').val(media_attachment.id);
			$container.find('img').attr('src', media_attachment.sizes.thumbnail.url).css('display', 'block');

			console.log(media_attachment);
		});

		// Opens the media library frame.
		meta_image_frame.open();
	});
});

/*
 * WP ADMIN SCRIPT
 * Attaches the multiple image uploader to custom post types images
  * uploads
 */
jQuery(document).ready(function($){

	// Instantiates the variable that holds the media library frame.
	var meta_image_frame;

	var image_template = function(id, src){
		var html =
			'<span class="meta-images-image" data-id="'+id+'">' +
				'<img src="' + src + '" />' +
				'<span class="meta-images-remove-image">Ta bort</span>' +
			'</span>';
		return html;
	};

	var save_values = function( $container ){
		var ids = [];
		$container.find('.meta-images-image').each(function(){
			ids.push( $(this).data('id') );
		});

		$container.find('.meta-images-value').val( ids.join(',') );
	};

	$('body').on('click', '.meta-images-remove-image', function(){

		var $container = $(this).closest('.meta-images');

		$(this).closest('.meta-images-image').remove();
		save_values($container);

	});

	$('.meta-images').each(function(){

		var $container = $(this),
			$list = $container.find('.meta-images-list'),
			images = $container.data('images');

		$list.sortable({
			update: function(){
				save_values($container);
			}
		});

		_.each( images, function( image ) {
			$list.append(image_template( image.id, image.src) );
		});

	});

	// Runs when the image button is clicked.
	$('.meta-images .meta-images-button').click(function(e){

		var $container = $(this).closest('.meta-images');

		// Prevents the default action from occuring.
		e.preventDefault();

		/*
		// If the frame already exists, re-open it.
		if ( meta_image_frame ) {
			meta_image_frame.open();
			return;
		}*/

		// Sets up the media library frame
		meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
			title: 'Select image',
			button: { text:  'Use image' },
			library: { type: 'image' }
		});

		// Runs when an image is selected.
		meta_image_frame.on('select', function(){

			// Grabs the attachment selection and creates a JSON representation of the model.
			var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

			// Sends the attachment URL to our custom image input field.
			//$container.find('img').attr('src', media_attachment.sizes.thumbnail.url).css('display', 'block');
			$container.find('.meta-images-list').append(image_template( media_attachment.id, media_attachment.sizes.thumbnail.url) );
			save_values($container);
		});

		// Opens the media library frame.
		meta_image_frame.open();
	});
});

/**
 * Custom functionality for front page slider selecting between video and slideshow
 */
( function( $ ) {
	
	var Slider = {};
	
	Slider.process = function( type ) {
		if( type === 'slideshow' ) {
			$( 'div#slideshow' ).show();
			$( 'div#video' ).hide();
		} else if( type === 'video' ) {
			$( 'div#slideshow' ).hide();
			$( 'div#video' ).show();
		}
	};
	
	$( document ).ready( function() {
		$( 'input[name="slider_type"]' ).click( function() {
			Slider.process( $( this ).val() );
		} );
		
		var type = $( 'input[name="slider_type"]:checked' ).val();
		
		Slider.process( type );
		
		if( !type ) {
			$( 'input[name="slider_type"][value="slideshow"]' ).click();
		} else {	
			Slider.process( type );
		}
	} );
	
} )( jQuery );
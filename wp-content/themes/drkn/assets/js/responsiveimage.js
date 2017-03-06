jQuery(function($){

	drkn.fixResponsive = function(){

		$('.resize-area').each(function(){
			var $area = $(this),
				width = $area.data('width'),
				height = $area.data('height'),
				element_width = $area.width();
			$area.height( element_width / width * height );
		});

		$('.responsive-image').each(function(){
			var $container = $(this),
				$img = $container.find('img'),
				id = $container.data('id'),
				image = drkn.images[id],
				container_width = $container.width(),
				container_height = $container.height(),
				min_width = $container.width(),
				size = null,
				fill_image = $container.is('.fill-image'),
				center_image = $container.is('.center-image');
			
			if( typeof(image) == 'undefined' ) {
				return;
			}

			if ( fill_image ) {

				var ratio = image.height / image.width;

				//console.log('fill image ratio', ratio);
				//console.log('fill image', ratio * min_width);
				if ( container_width * ratio < container_height) {
					min_width = (container_height  / ( ratio ));
				}
				//console.log('min_width', min_width);

			}

			if ( center_image ) {
				var ratio = image.height / image.width;
				//console.log('CENTER IMAGE');
				//console.log('container-height', container_height);
				if ( container_height < ratio * min_width ) {
					//console.log('TOO HIGH', ratio * min_width);
					min_width = container_height / ratio;
				}
			}

			var i = 0;

			while ( i < image.sizes.length ) {
				size = image.sizes[i];

				i++;
				if ( min_width < size.width ) {
					break;
				}
			}

			if ( !size )
				size = image;

			var changed_image = $img.attr('src') !== size.url;

			if ( changed_image ) {
				$img.css('opacity', 0);
			}

			$img.attr('src', size.url).css({
				width: min_width,
				left: -( min_width - container_width ) / 2
			});

			if ( changed_image ) $container.imagesLoaded(function(){
				$img.css('opacity', 1);
			});


		});
	};
	$(window).bind('resize', function(){
		setTimeout(function(){
			drkn.fixResponsive();
		});
	}).trigger('resize');

});
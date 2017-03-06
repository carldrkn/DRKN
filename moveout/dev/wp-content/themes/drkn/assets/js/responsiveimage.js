jQuery(function($){

	drkn.fixResponsive = function(){
		$('.responsive-image').each(function(){
			var $container = $(this),
				$img = $container.find('img'),
				id = $container.data('id'),
				image = drkn.images[id],
				container_width = $container.width(),
				container_height = $container.height(),
				min_width = $container.width(),
				size = null,
				fill_image = $container.is('.fill-image');

			if ( fill_image ) {

				var ratio = image.height / image.width;

				console.log('fill image ratio', ratio);
				console.log('fill image', ratio * min_width);
				if ( container_width * ratio < container_height) {
					min_width = (container_height  / ( ratio ));
				}
				console.log('min_width', min_width);
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

			$img.attr('src', size.url).css({
				width: min_width,
				left: -( min_width - container_width ) / 2
			});


		});
	};
	$(window).bind('resize', function(){
		setTimeout(function(){
			drkn.fixResponsive();
		});
	}).trigger('resize');

});
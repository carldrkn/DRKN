jQuery(document).ready(function($) {

	var initCheckout = function() {

		//Remove checked attrs on checkboxes that shouldn't be checked.
		$('.is-openSection').each(function() {
			if(!$(this).hasClass('sectionOpen')) {
				$(this).find('.js-openSection').attr('checked', false);
			}
		})

		$('.js-openSection').on('change', function() {
			if($(this).prop('checked')) {
				$(this).closest('.is-openSection').addClass('sectionOpen');
			} else {
				$(this).closest('.is-openSection').removeClass('sectionOpen');
			}
		});

		$('#address_country').on('change', function(e){
			var val = $(this).val();
			var sendData = {
				'esc_action': 'esc_change_country',
				'esc_country': val
			};

			//Countries with states.
			if(val === 'US' || val === 'CA' || val === 'AU') {
				sendData['esc_get_states'] = true;
			} else {
				$('#js-stateCont').addClass('hide');
			}

			//Update all HTML
			$.ajax({
				data: sendData,
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					if(sendData['esc_get_states']) {
						$('#js-stateCont').find('select').html(data.states);
						$('#js-stateCont').removeClass('hide');
					}
					$('#js-paymentFields').html(data.payments);
					$('#js-selectedItems').html(data.basket);
					$('#js-selectedItems--selection').html(data.items);
					$('#js-selectedTotals').html(data.totals);
				}
			});

		});

	};

	var initProduct = function() {

		var $sizes = $('#js-productSizes');
		var $sizeInputs = $sizes.find('input');
		var $purchaseButton = $('#js-submitPurchase');

		$sizes.find(':checked').closest('li').addClass('active');
		
		$sizes.on('change', 'input', function(){
			$sizes.find('.active').removeClass('active');
			$(this).closest('li').addClass('active');
			$purchaseButton.addClass('buy').removeClass('size forced').find('span').text($purchaseButton.data('orig-text'));
		});

		//Checkout button interaction.
		$purchaseButton.on({
			mouseenter: function() {
				if(!$sizeInputs.is(':checked') && $(this).hasClass('buy')) {
					//If size is not checked
					$(this).removeClass('buy').addClass('size').find('span').text($(this).data('hover-text'));
				}
			},
			mouseleave: function() {
				if($(this).hasClass('size') && !$(this).hasClass('forced')) {
					$(this).removeClass('size').addClass('buy').find('span').text($(this).data('orig-text'));
				}	
			}
		});

		$('#js-selectProduct').on('submit', function(e){
			e.preventDefault();
			var $this = $(this);
			var data = $this.serialize();

			if(!$sizeInputs.is(':checked')) {
				$purchaseButton.removeClass('buy').addClass('size forced').find('span').text($purchaseButton.data('hover-text'));
			} else {

				//Change text directly to make the site feel fast.
				$purchaseButton.find('span').text($purchaseButton.data('co-text'));
				$purchaseButton.on('click touchstart', function(e) {
					e.preventDefault();
					window.location = drkn.base_uri + 'selection';
				});

				$.ajax({
					data: data,
					type: 'POST',
					dataType: 'JSON',
					success: function(data) {
						if(data.success) {
							//Update minicart contents
							//Display minicart after 4secs remove class.
							$('#js-selectedItems').html(data.html);
							$('#js-popOut').addClass('popOut--open');
							$('html,body').animate({
								scrollTop: 0
							}, 200);
							window.setTimeout(function() { $('#js-popOut').removeClass('popOut--open'); }, 3000);
						} else {
							//Error message
						}
					}
				});
			}

		});

	}

	if($('#js-checkout').length > 0) initCheckout();
	if($('#js-product').length > 0) initProduct();

	$('.mobile-menu').click(function(e){
		e.preventDefault();
		$('header nav').slideToggle();
	});

	menu = $('header nav');

	$(window).resize(function(){
		var w = $(window).width();
		if(w > 992 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}

	}); 

	var w = $(window).width();
	if(w < 992){

		/*
		$('.first-child').click(function(e){
			e.preventDefault();
			$('.shop-item').toggleClass('active-drop');
			$('.shop-item ul').slideToggle();
		});*/

		$('.first-child-sec').click(function(e){
			e.preventDefault();
			$('.join-item').toggleClass('active-drop');
			$('.join-item .menu-submenu').slideToggle();
		});

	}

	$('#size-guide-button').click(function(e){

		e.preventDefault();

		$('.size-guide').fadeToggle(200);
		$('#size-guide-button').toggleClass("active");

	});

	$('html').click(function() {
		$('.size-guide').fadeOut(200);
		$('#size-guide-button').removeClass("active");
	});

	$('#size-guide-button').click(function(event){
		event.stopPropagation();
	});

	$('.size-guide').click(function(event){
		event.stopPropagation();
	});

	/*
	 * Culture
	 */

	setTimeout(function(){
		$(window).trigger('resize');
		$('.culture-images-container').each(function(){
			var $container = $(this).masonry({
				itemSelector: '.culture-image',
				transitionDuration: 0
			});
			$(this).find('.culture-image').each(function(){
				$(this).imagesLoaded(function(){
					$container.masonry();
					$('.culture-image').css('opacity', 1);
				});
			});
		});
	}, 100);

	/*
	 * Product images
	 */
	console.log('product init');
	$('.shop-product').each(function(){
		var $product = $(this),
			$product_image = $product.find('.product-image');

		console.log('product');
		$product.find('.thumbnails .responsive-image').click(function(){
			console.log('click');
			var $new = $(this).clone().css({
				opacity: 0,
				position: 'absolute',
				left: 0,
				top: 0,
				width: '100%'
			}).appendTo($product_image);
			drkn.fixResponsive();
			$new.imagesLoaded(function(){
				$product_image.height( $product_image.height() );
				$product_image.children().not($new).remove();
				$new.attr('style', '');
				$product_image.removeAttr('style');
			});
		});
	});

	/*
	 * Full width embed class for post ocntent
	 */

	$('.full-width-embed').each(function(){

		var $embed = $(this),
			o_width = $embed.width(),
			o_height = $embed.height();

		var resize = function(){
			var width = $embed.parent().width(),
				height = o_height / o_width * width;
			$embed.css({
				width: width,
				height: height
			})
		};

		$(window).bind('resize', resize);
		resize();

	});

	/*
	 * Filtering
	 */

	$('.filter-search select').change(function(){
		window.location.href = $(this).val();
	});

});



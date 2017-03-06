jQuery(document).ready(function($) {

	var initCheckout = function() {

		var updateVoucher = function($button) {
			var sendData = $('#esc_purchase').serialize();
			var buttonName = $button.attr('name');
			var buttonValue = $button.attr('value');
			
			sendData += '&' + buttonName + '=' + buttonValue + '&ajax=1';

			//Update all HTML
			$.ajax({
				data: sendData,
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					$('#js-paymentFields').html(data.payments);
					$('#js-selectedItems').html(data.basket);
					$('#js-selectedItems--selection').html(data.items);
					$('#js-selectedTotals').html(data.totals);
					$('#js-voucher-fields').html(data.voucher);
				}
			});
		};

		$('#adyen').attr({'checked': true});

		if( $('input[name=paymentMethod]').length == 1 ) {
			$('.paymentMethod').hide();
			$('#adyenCheckout').show();
			$('#paypalCheckout').hide();
		}

		//Remove checked attrs on checkboxes that shouldn't be checked.
		$('.is-openSection').each(function() {
			if(!$(this).hasClass('sectionOpen')) {
				$(this).find('.js-openSection').attr('checked', false);
			}
		});

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
				$('#js-stateCont').addClass('hide').find('select').html('');
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
					$('.german-terms').css('display', data.country == 'DE' ? 'block' : 'none');
				}
			});

		});

		$('#js-voucher-fields').on('keydown', '#voucher', function (e) {
			//If enter pushed
			if(e.keyCode == 13) {
				e.preventDefault();
				updateVoucher($(this).parent().next());
			}
		});

		$('#js-voucher-fields').on('click', 'button', function (e) {
			e.preventDefault();
			updateVoucher($(this));
		});

		$('#esc_purchase').on('change', '#paypal', function(e) {
			$('#paypalCheckout').show();
			$('#klarnaCheckout').hide();
			$('#adyenCheckout').hide();
			console.log('paypal');
		});

		$('#esc_purchase').on('change', '#adyen', function(e) {
			$('#adyenCheckout').show();
			$('#klarnaCheckout').hide();
			$('#paypalCheckout').hide();
			console.log('adyen');
		});

		$('#esc_purchase').on('change', '#klarna', function(e) {
			var sendData = $('#esc_purchase').serialize();

			if($('#klarnaCheckout').data('loaded') === undefined) {
				sendData += '&skipTerms=1';

				$.ajax({
					data: sendData,
					type: 'POST',
					success: function(html) {
						$('#paypalCheckout').hide();
						$('#adyenCheckout').hide();
						$('#klarnaCheckout').html(html).show().data({'loaded': true});
					}
				});

			} else {
				$('#paypalCheckout').hide();
				$('#adyenCheckout').hide();
				$('#klarnaCheckout').show();
				console.log('klarna');
			}

		});

	};

	var initProduct = function() {
		var $productPurchase = $('#js-product');

		if( $('#js-productSizes li') && $('#js-productSizes li').length <= 1 ) {
			$('#js-productSizes li').hide();
		}

		var updateSizes = function() {
			$productPurchase.find('input:checked').closest('li').addClass('active');

			$productPurchase.on('change', '#js-productSizes input', function(){
				var $container = $(this).closest('#js-productPurchase');
				var $purchaseButton = $container.find('#js-submitPurchase');
				$container.find('.active').removeClass('active');
				$(this).closest('li').addClass('active');
				$container.find('#js-submitPurchase').addClass('buy').removeClass('size forced').find('span').text($purchaseButton.data('orig-text'));
			});
		}

		updateSizes();

		//Checkout button interaction.
		$productPurchase.on({
			mouseenter: function() {
				if(!$productPurchase.find('input').is(':checked') && $(this).hasClass('buy')) {
					//If size is not checked
					if( ! $(this).is(':disabled') ) {
						$(this).removeClass('buy').addClass('size').find('span').text($(this).data('hover-text'));
					}
				}
			},
			mouseleave: function() {
				if($(this).hasClass('size') && !$(this).hasClass('forced')) {
					if( ! $(this).is(':disabled') ) {
						$(this).removeClass('size').addClass('buy').find('span').text($(this).data('orig-text'));
					}
				}
			}
		}, '#js-submitPurchase');

		$productPurchase.on('submit', '.js-selectProductSingle', function(e){

			e.preventDefault();
			var $this = $(this);
			var $purchaseButton = $this.find('.js-submitPurchaseSingle');
			var data = $this.serialize();

			if(!$productPurchase.find('input').is(':checked')) {
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
							$('#js-numberOfItems').text(data.totalItems).parent().addClass('is-selected');
							$('#js-selectedItems').html(data.basket);
							$('#js-popOut').addClass('popOut--open');
							drkn.fixResponsive();
							/*
							$('html,body').animate({
								scrollTop: 0
							}, 200);
							*/
							window.setTimeout(function() { $('#js-popOut').removeClass('popOut--open'); }, 3000);
						} else {
							//Error message
						}
					}
				});
			}

		});

		$productPurchase.on('focus', '#unlockProduct-input', function() {
			$(this).parent().find('.voucherErrors').addClass('hide');
		});

		$productPurchase.on('submit', '.js-unlockProduct', function(e) {

			e.preventDefault();

			var $this = $(this);
			var sendData = $this.serialize();
			var voucherField = /\S/.test($this.find('.unlockProduct-input').val());

			//Empty value don't test.
			if(!voucherField) return;

			$.ajax({
				data: sendData + '&ajax=1',
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					if(data.success) {
						$('.unlockProduct').replaceWith(data.html);
						//$productPurchase.html();
						updateSizes();
					}
				}
			});
		});

	}




	var initProductInline = function() {

		$productPurchase = $('.js-selectProduct');

		$productPurchase.on('click','.js-submitPurchase', function(e){

			e.preventDefault();

			$productForm = $(this).closest('form');


			var $this = $(this).closest('form');
			var $purchaseButton = $this.find('.js-submitPurchase');
			var data = $this.serialize();

			if(!$productForm.find('input').is(':checked')) {
				$purchaseButton.removeClass('buy').addClass('size forced').find('span').text($purchaseButton.data('hover-text'));
			} else {

				//Change text directly to make the site feel fast.
				/*
				 $purchaseButton.find('span').text($purchaseButton.data('co-text'));
				 $purchaseButton.on('click touchstart', function(e) {
				 e.preventDefault();
				 window.location = drkn.base_uri + 'selection';
				 });
				 */

				$.ajax({
					data: data,
					type: 'POST',
					dataType: 'JSON',
					success: function(data) {
						if(data.success) {
							//Update minicart contents
							//Display minicart after 4secs remove class.
							$('#js-numberOfItems').text(data.totalItems).parent().addClass('is-selected');
							$('#js-selectedItems').html(data.basket);
							$('#js-popOut').addClass('popOut--open');
							/*
							 $('html,body').animate({
							 scrollTop: 0
							 }, 200);*/
							window.setTimeout(function() { $('#js-popOut').removeClass('popOut--open'); }, 3000);
						} else {
							//Error message
						}
					}
				});
			}
		});

		$productPurchase.on('change','input:radio', function(e){

			$productForm = $(this).closest('form');

			var $this = $(this).closest('form');
			var $purchaseButton = $this.find('.js-submitPurchase');
			var data = $this.serialize();

			if(!$productPurchase.find('input').is(':checked')) {
				$purchaseButton.removeClass('buy').addClass('size forced').find('span').text($purchaseButton.data('hover-text'));
			} else {

				//Change text directly to make the site feel fast.
				/*
				$purchaseButton.find('span').text($purchaseButton.data('co-text'));
				$purchaseButton.on('click touchstart', function(e) {
					e.preventDefault();
					window.location = drkn.base_uri + 'selection';
				});
				*/

				$.ajax({
					data: data,
					type: 'POST',
					dataType: 'JSON',
					success: function(data) {
						if(data.success) {
							//Update minicart contents
							//Display minicart after 4secs remove class.
							$('#js-numberOfItems').text(data.totalItems).parent().addClass('is-selected');
							$('#js-selectedItems').html(data.basket);
							$('#js-popOut').addClass('popOut--open');
							drkn.fixResponsive();
							/*
							$('html,body').animate({
								scrollTop: 0
							}, 200);*/
							window.setTimeout(function() { $('#js-popOut').removeClass('popOut--open'); }, 3000);
						} else {
							//Error message
						}
					}
				});
			}
		});

		$productPurchase.on('focus', '#unlockProduct-input', function() {
			$(this).parent().find('.voucherErrors').addClass('hide');
		});

		$productPurchase.on('submit', '#js-unlockProduct', function(e) {
			e.preventDefault();

			var $this = $(this);
			var sendData = $this.serialize();
			var voucherField = /\S/.test($('#unlockProduct-input').val());

			//Empty value don't test.
			if(!voucherField) return;

			$.ajax({
				data: sendData + '&ajax=1',
				type: 'POST',
				dataType: 'JSON',
				success: function(data) {
					if(data.success) {
						$productPurchase.html(data.html);
						updateSizes();
					}
				}
			});
		});

	}

	if($('#js-checkout').length > 0) initCheckout();
	if($('#js-product').length > 0) initProduct();
	if($('.js-selectProduct').length > 0) initProductInline();

	$('.mobile-menu').click(function(e){
		e.preventDefault();
		$('header nav').slideToggle( "slow", function() {
			// Animation complete.
			if( $( "body" ).hasClass( "no-scroll" ) ) {
				$( "body" ).removeClass( "no-scroll" );
			}
			else {
				$( "body" ).addClass( "no-scroll" );
			}
		});
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
				itemSelector: '.culture-image, .studio-image',
				transitionDuration: 0
			});

			var $window = $(window);
				window_height = null,
				body_height = null,

			$window.bind('resize', function(){
				window_height = $window.height(),
				body_height = $('body').height();
			}).trigger('resize');

			var loading = false;

			$window.bind('scroll', function(){

				var scroll_top = $window.scrollTop();

				if ( !loading && body_height - ( window_height * 2 ) < scroll_top ) {

					loading = true;

					var $next = $('.next-page a');

					if ( $next.length ) $.ajax( $next.attr('href') ).done(function( html ){

						html = html.replace(/<(\/?)(html|head|body)[^>]*>/g, '<$1div>');
						var $html = $( html );
						$html.find('script[data-images="1"]').appendTo( 'body' );

						var $images = $html.find('.culture-image, .studio-image');

						$images.appendTo('.culture-images-container');
						if ( $html.find('.next-page.length') )
							$('.next-page').replaceWith( $html.find('.next-page')  );
						$window.trigger('resize');

						setTimeout(function(){
							$container.masonry( 'appended', $images );
							$container.masonry( 'layout' );
							loading = false;
							$(window).trigger('scroll');
						}, 50);

					});

				}
			});
		});

	}, 100);

	/*
	 * Product images
	 */

	$('.shop-product').each(function(){
		var $product = $(this),
			$product_image = $product.find('.product-image');


		if( $('.product-image img').data('imagezoom') && $('.product-image img').data('imagezoom').length > 0 ) {

			$('<img />').attr('src', $('.product-image img').data('imagezoom') ).appendTo('body').css('display','none');

		}

		$product.find('.thumbnails .responsive-image').click(function(){
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
				if(drkn.documentWidth().width > 991){
					if( $('.product-image img').data('thumbzoom').length > 0 ) {

						$('<img />').attr('src', $('.product-image img').data('thumbzoom') ).appendTo('body').css('display','none');

						$('.product-image img').attr('data-imagezoom', $('.product-image img').data('thumbzoom') );
					}
				}
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

	$('.filter-search select.category').change(function(){
		window.location.href = $(this).val();
	});

	$('.filter-search select.meta').change(function(){
		var url = window.location.href.replace(/page\/[0-9]+\/$/, '');
		var name = $(this).attr('name');
		var value = $(this).val();
		$('<form method="post" action="'+url+'">')
			.append(
				$('<input>')
					.attr('type', 'hidden')
					.attr('name', name)
					.attr('value', value).get()
			)
			.appendTo('body')
			.submit();
	});

	/*
	 * Fix for responsive images in cart
	 */
	$('.popOut').hover(function(){
		drkn.fixResponsive();
	 });

	/*
	 * Fix for cart not emptying
	 */
	if ( $('.order-confirmed').length ) {
		$('#js-popOut > a > span').html('CART (0)');
	}

	/*
	 * Ajax for increasing/decreasing products
	*/

	$('#js-selectedItems').on('click', '.selectedItems-edit a', function(e){
		e.preventDefault();

		var ajaxUrl = $(this).attr('href');

		$.ajax({
			url: ajaxUrl,
			type: 'GET',
			dataType: 'JSON',
			success: function(data) {
				$('#js-paymentFields').html(data.payments);
				$('#js-selectedItems').html(data.basket);
				$('#js-selectedItems--selection').html(data.items);
				$('#js-numberOfItems').text(data.totalItems);
				if(parseInt(data.totalItems) > 0) {
					$('#js-numberOfItems').parent().addClass('is-selected');
				} else {
					$('#js-numberOfItems').parent().removeClass('is-selected');
				}
				$('#js-selectedTotals').html(data.totals);
				$('#js-voucher-fields').html(data.voucher);
			}
		});

	});

	$('#esc_purchase').on('submit',function(){
		return validateForm();
	});

	var validateForm = function() {

		hasError = false;
		errorMsg = '';

		var formFields = [
			'email',
			'firstName',
			'lastName',
			'phoneNumber',
			'address1',
			'zipCode',
			'city'
		];

		$.each(formFields, function (index, field) {

			formField = $('#address_' + field + ':visible');
			formField.parents('.input-field').removeClass('error');

			if (typeof( formField.val() ) != 'undefined') {
				if (!formField.val()) {
					formField.parents('.input-field').addClass('error');
					label = $("label[for='" + $(formField).attr('id') + "']").text();
					hasError = true;
					errorMsg += '<p class="checkoutErrors"><strong>' + label + '</strong> missing</p>';
					if( field == 'email') {
						jQuery('html,body').animate({
							scrollTop: 0
						}, 200);
					}
				} else if (field == 'email') {
					if (!validateEmail(formField.val())) {
						formField.parents('.input-field').addClass('error');
						label = $("label[for='" + $(formField).attr('id') + "']").text();
						hasError = true;
						errorMsg += '<p class="checkoutErrors"><strong>' + label + '</strong> invalid</p>';
						jQuery('html,body').animate({
							scrollTop: 0
						}, 200);
					}
				}
			}
		});

		if (hasError) {
			$('#adyenCheckout .errorContainer').html(errorMsg);
			$('#adyenCheckout .errorContainer').show();
			return false;
		} else {
			$('#adyenCheckout .errorContainer').html('');
			$('#adyenCheckout .errorContainer').hide();
			return true;
		}
	}

});


function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
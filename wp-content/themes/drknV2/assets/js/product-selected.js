$(function() {

	$( document ).ready( function() {
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
		
		var ProdSelected = {};

		ProdSelected.Popup = function() {
			$( ".swipebox" ).swipebox({ selector: '.swipebox' });
		};
		
		ProdSelected.JQpin = function() {
			var popheight = $( ".item-pop" ).outerHeight();
			if( realWidth.getWindowWidth() < 991 ) {
				$( ".pin-wrapper" ).removeAttr( "style" );
				$( ".psc-pin" ).removeAttr( "style" );
				$( ".psc-selected .content" ).removeAttr( "style" );
				$( ".product-sidemenu" ).removeAttr( "style" );
				$( ".cat-nav" ).removeAttr( "style" );
				if( realWidth.getWindowWidth() < 767 ) {
					$( ".pin-wrapper" ).removeAttr( "style" );
					$( ".psc-pin" ).removeAttr( "style" );
					$( ".psc-selected .content" ).removeAttr( "style" );
					$( ".cat-nav" ).removeAttr( "style" );
				}
				else {
					$( ".pin-wrapper" ).removeAttr( "style" );
					$( ".psc-pin" ).removeAttr( "style" );
					$( ".psc-selected .content" ).removeAttr( "style" );
					$( ".cat-nav" ).removeAttr( "style" );
					$( ".cat-nav" ).pin({
						padding: {top: -69},
						containerSelector: ".container-fluid"
					});
				}	
			}
			
			else {
				$( ".pin-wrapper" ).removeAttr( "style" );
				$( ".psc-pin" ).removeAttr( "style" );
				$( ".cat-nav" ).removeAttr( "style" );
				$( ".cat-nav" ).removeClass( "fixed-cat" );
				$( ".psc-selected .content" ).removeAttr( "style" );
				$( ".product-sidemenu" ).removeAttr( "style" );
				if( $( ".psc-selected" ).height() < $(".item-pop").height() ) {
					$( ".psc-selected .content" ).height( popheight );
					$( ".product-sidemenu" ).height( popheight ); 
					
					$( ".psc-pin" ).pin({
						containerSelector: ".psc-selected .content"	
					});
					
					$( ".cat-nav" ).pin({
						padding: {top: -69},
						containerSelector: ".product-sidemenu"	
					});
				}
			}
		};
		
		ProdSelected.cHeight = function() {
			if ( $( '.product-selected' ).length > 0 ) {
				
				if( realWidth.getWindowWidth() < 991 ) {
					$( ".product-selected" ).removeAttr( "style" );
					$( ".cat-nav" ).removeAttr( "style" );
					$( ".pin-wrapper" ).removeAttr( "style" );
					$( ".psc-pin" ).removeAttr( "style" );
					
				}
				else {				
					$(".collapse").on('shown.bs.collapse', function(){
						if( realWidth.getWindowWidth() < 991 ) {
							$( ".product-selected" ).removeAttr( "style" );
							$( ".cat-nav" ).removeAttr( "style" );
							$( ".pin-wrapper" ).removeAttr( "style" );
							$( ".psc-pin" ).removeAttr( "style" );
						}
						else {
							var popheight = $( ".item-pop" ).outerHeight();
							var prodSel = $( ".product-selected" ).outerHeight();
							
							var pinHeight = $( ".psc-pin" ).outerHeight();
							var pinwHeight = $( ".pin-wrapper" ).outerHeight();
							
							subtractHeight = pinHeight - pinwHeight;
							
							var pinheight = $( ".psc-pin" ).height();
							
							$( ".psc-selected .pin-wrapper" ).height( pinheight );
							
							var pinwrapperHeight = $( ".psc-selected .pin-wrapper" ).height();
							
							$( ".psc-selected .content" ).height( popheight + pinwrapperHeight );

							if( ( $( ".psc-pin" ).css( "position" ) === "absolute" ) || $( ".psc-pin" ).css( "position" ) === "fixed" ) {
								$( ".product-selected" ).animate({
									height: ( prodSel + subtractHeight )
								}, 100, function() {

								});
							}
							
						}
					});

					$('.collapse').on('hidden.bs.collapse', function () {
						$( ".product-selected .content" ).removeAttr( "style" );
						$( ".product-selected" ).animate({
							height: "auto"
						}, 100, function() {
							$( ".product-selected" ).removeAttr( "style" );
						});
						
					});
				}
			}
		};	
		
		ProdSelected.heightCheck = function() {
			if( realWidth.getWindowWidth() < 767 ) {
				$( ".product-selected" ).removeAttr( "style" );
				$( ".cat-nav" ).removeAttr( "style" );
				$( ".pin-wrapper" ).removeAttr( "style" );
				$( ".psc-pin" ).removeAttr( "style" );
			}
			if( realWidth.getWindowWidth() < 991 ) {
				$( ".psc-selected .pin-wrapper" ).removeAttr( "style" );
				$( ".psc-selected .psc-pin" ).removeAttr( "style" );
			}
		};
		
		ProdSelected.stickyMenu = function() {
			if( $( '.sticky-menu' ).length ) {
				if( realWidth.getWindowWidth() < 767 ) {
					$( ".nav-sticky" ).removeAttr( "style" );
					$( ".pin-wrapper" ).removeAttr( "style" );
					$( ".psc-pin" ).removeAttr( "style" );
				}
				else {
					
					$( ".pin-wrapper" ).removeAttr( "style" );
					$( ".psc-pin" ).removeAttr( "style" );
					$( ".nav-sticky" ).removeAttr( "style" );
					
					var containerHeight = $( ".sticky-menu" ).height();
					$( ".nav-sticky" ).height( containerHeight );
					$( ".nav-sbmenu" ).pin({
						padding: {top: 20},
						containerSelector: ".nav-sticky"	
					});
				}	
			}	
		};
		
		ProdSelected.Popup();
		ProdSelected.cHeight();
		ProdSelected.heightCheck();
		
		
		$(window).on("load", function() {
			ProdSelected.JQpin();
			ProdSelected.stickyMenu();
		});
		
		$(window).on('resize',function(){
			ProdSelected.JQpin();
			ProdSelected.heightCheck();
			ProdSelected.stickyMenu();
		});

		var $productPurchase = $('.js-selectProductSingle');

		$productPurchase.on('submit', function(e){

			console.log('BUY');

			$productForm = $(this);
			var $this = $(this);

			e.preventDefault();
			var $this = $(this);
			var $purchaseButton = $this.find('.js-submitPurchaseSingle');
			var data = $this.serialize();

			if(!$productForm.find('input').is(':checked')) {
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
							$('#js-numberOfItems').text('('+data.totalItems+')').parent().addClass('is-selected');
						} else {
							//Error message
						}
					}
				});
			}

		});

	});
});
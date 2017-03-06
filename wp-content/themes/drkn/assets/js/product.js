drkn.documentWidth = function(){
	var e = window, a = 'inner';
	if (!('innerWidth' in window )) {
	    a = 'client';
	    e = document.documentElement || document.body;
	}
	return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
};

jQuery(function($){
	

	var Product = {};

	Product.showSize = function(){
		if(drkn.documentWidth().width > 767){
			$('.product-size-container').hover(function(){
				if( $(this).find('.product-size li') && $(this).find('.product-size li').length > 1 ) {
					$(this).find('.product-size').show();
				}
			}, function(){
				$(this).find('.product-size').hide();
			});
		}
		else{
			$('.product-size-container').on('click', function(){
				
				if( $(this).find('.product-size li') && $(this).find('.product-size li').length > 1 ) {
					$('.product-size-container').find('.product-size').hide();
					$(this).find('.product-size').show();
				}
			});
		}
	};

	Product.checkActiveSize = function(){
		$('.product-size-container .product-size input[type=radio]').on('click', function(){
			if( $(this).is(':checked') ){
				$(this).parents('.product-size').find('li').removeClass('active');
				$(this).parents('li').addClass('active');
			}
		});
	};

	Product.setZoom = function(){
		var imageWidth = $('.shop-product').find('.product-image img').width();
		var imageHeight = $('.shop-product').find('.product-image img').height();

		$('[data-imagezoom]').imageZoom({
			cursorcolor:'255,255,255',
			opacity:0.1, 
			cursor:'crosshair', 
			zindex:1, 
			zoomviewsize:[imageWidth,imageHeight],
			zoomviewposition:'right', 
			zoomviewmargin:30, 
			zoomviewborder:'none',
			magnification:2,
			zoomviewborder:'1px solid #ccc'
		});
	};

	Product.productHeader = function(){
		if(drkn.documentWidth().width <= 767){
			var productHeader = $('.shop-product').find('.product-inner .product-header #js-productPurchase').clone();

			$('.shop-product').find('.product-header').insertBefore('.product-image');
			productHeader.one().insertAfter('.product-description-bottom');
		}
		else{
			$('.shop-product').find('.product-header').insertBefore('.post-content');

			$('.product-description-bottom').next('#js-productPurchase').remove();
		}
	};

	Product.setThumbSize = function(){
		var thumbHolderWidth = $('.thumb-holder').width();
		var thumbCount = $('.product-thumnbail').length;
		var thumbSize = thumbHolderWidth / 4;

		$('.thumbnails').outerWidth(thumbCount * thumbSize);
		$('.product-thumnbail').outerWidth(thumbSize);
		if( thumbCount > 4 ){
			$('.thumbnails').css('margin-left', -thumbSize);
		}
	};

	Product.setItemPosition = function(){
		var thumbCount = $('.product-thumnbail').length;
		if( thumbCount > 4 ){
			$('.product-thumnbail').last().insertBefore('.product-thumnbail:first-of-type');
			$('.product-thumnbail').removeClass('thumb-active');
			$('.product-thumnbail').first().next().addClass('thumb-active');
		}
		else{
			$('.product-thumnbail').first().addClass('thumb-active');
		}
	};

	Product.thumbClick = function(){
		$('.product-thumnbail .responsive-image').on('click', function(){
			var itemCount = $('.product-thumnbail').length;
			var thumbHolderWidth = $('.thumb-holder').width();
			var thumbSize = thumbHolderWidth / 4;
			var $this = $(this);
			var thumbIndex = $this.parent().index();
			
			if( itemCount > 4 ){
				if(thumbIndex > 1){
					$('.thumbnails').animate({
						'marginLeft': -thumbSize * thumbIndex
					}, 200, function(){
						$('.product-thumnbail').removeClass('thumb-active');
						$this.parent().addClass('thumb-active');
						for( var i = 0; i < thumbIndex-1; i++ ){
							$('.product-thumnbail').eq(0).insertAfter('.product-thumnbail:last-of-type');
						}
						$('.thumbnails').css('margin-left', -thumbSize);
					});
				}
			}
			else{
				$('.product-thumnbail').removeClass('thumb-active');
				$this.parent().addClass('thumb-active');
			}
			
		});
	};

	Product.navigation = function(){
		$('.nav-left').on('click', function(e){
			e.preventDefault();

			var itemCount = $('.product-thumnbail').length;
			var thumbHolderWidth = $('.thumb-holder')[0].getBoundingClientRect().width;
			var thumbSize = thumbHolderWidth / 4;

			if( itemCount > 4 ){
				$('.thumbnails').animate({
					'marginLeft': 0
				}, 200, function(){
					$('.product-thumnbail').removeClass('thumb-active');
					$('.product-thumnbail').first().addClass('thumb-active');

					$('.thumb-active').find('.responsive-image').click();
					
					$('.product-thumnbail').last().insertBefore('.product-thumnbail:first-of-type');

					$('.thumbnails').css('margin-left', -thumbSize);
				});
			}
			else{
				$('.thumb-active').prev().find('.responsive-image').click();
			}
		});

		$('.nav-right').on('click', function(e){
			e.preventDefault();

			$('.thumb-active').next().find('.responsive-image').click();
		});
	};

	Product.swipe = function(){
		$('.product-image').swipe({
			preventDefaultEvents: false,
			swipeLeft: function(){
				$('.nav-right').click();
			},
			swipeRight: function(){
				$('.nav-left').click();
			},
			allowPageScroll:"auto"
		});
	};


	var Activist = {};

	Activist.stickInfo = function() {
		if(drkn.documentWidth().width <= 767){
			return;
		}

		$( '.selected-activist .content-act' ).addClass( 'activist-info-fixed' );

		$( window ).scroll( function( event ) {
			var scroll = $( window ).scrollTop();
			var windowHeight = $( window ).height();
			var activistHeight = $( '.selected-activist' ).outerHeight();
			var finalheight = (activistHeight - windowHeight) + 80;

			if( scroll > finalheight ){
				$( '.selected-activist .content-act' ).removeClass( 'activist-info-fixed' );
			} else {
				$( '.selected-activist .content-act' ).addClass( 'activist-info-fixed' );
			}
		});
	};

	Activist.bannerResize = function() {
		if(drkn.documentWidth().width > 767) {
			var windowHeight = $( window ).height();
			var headerHeight = $( 'header' ).outerHeight();

			$( '.banner-act' ).height( windowHeight - headerHeight );
		} else {
			$( '.banner-act' ).height( 'auto' );
		}
	};

	$(document).ready(function() {
		Product.showSize();
		Product.checkActiveSize();
		Product.productHeader()
		Product.setItemPosition();
		Product.navigation();
		Product.thumbClick();
		Activist.stickInfo();
		Activist.bannerResize();
		//Product.swipe();

		if(drkn.documentWidth().width > 991){
			Product.setZoom();
		}
	});

	$(window).resize(function(){
		Product.setThumbSize();
		Product.productHeader();
		Activist.bannerResize();
	});

	$('.product-image img').load(function(){
		if(drkn.documentWidth().width <= 991){
			$('.product-image img').removeAttr('data-imagezoom');
			$('.thumb-outer img').removeAttr('data-imagezoom');
			Product.setZoom();
		}
	});
});



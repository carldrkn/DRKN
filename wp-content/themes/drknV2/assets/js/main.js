
$(function() {
	
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
	
	//Global JS
	var globalJS = {};
	
	globalJS.navsearch =  function() {
		$( ".sl-form input[type='text']" ).focus(function() {
			if( $( ".sl-form" ).hasClass( "active" )  ) {
				$( ".sl-form" ).removeClass( "active" );
				$( "nav ul li" ).each(function() {
					$( this ).removeAttr();
				});
			}
			else {
				$( "nav ul li" ).each(function() {
					if( !$( this ).hasClass( "search-link" ) ) {
						$( this ).hide();	
					}
				});
				$( ".sl-form" ).addClass( "active" );
			}
		});
		
		$( ".sl-form input[type='text']" ).focusout(function(){
			$( ".sl-form" ).removeClass( "active" );
			$( "nav ul li" ).each(function() {
				$( this ).removeAttr( "style" );
			});
		});	
	};
	
	globalJS.bannerTextCenter = function() {
		if ( $( ".full-box" ).length > 0 ) {
			var boxHeight = parseInt( $( ".full-box" ).css('min-height') , 10);
			
			if( boxHeight == 0 ) {
				boxHeight = parseInt( $( ".full-box" ).outerHeight() , 10);
			}
			
			halfBox = boxHeight / 2;
			var titleHeight = $( ".title-line" ).outerHeight();
			topHeight = halfBox - ( titleHeight / 2 );
			
			$( ".title-line" ).css( 'top', topHeight );
		}
	};
	
	
	globalJS.navDropdown =  function() {
		if( realWidth.getWindowWidth() < 767 ) {
			if ( $( ".nav-menuselect" ).length > 0 ) {
				var optionLinks = new Array();
				$( ".nav-menuselect select" ).html( '' );
				if( !$( ".nav-menuselect" ).hasClass( "non-product" ) ) {
					var shopLink = $( ".nav-menuselect" ).data( 'shoplink' );
					$( ".nav-menuselect select" ).append( '<option class="all-products" value="' + shopLink + '" selected>All Products</option>' );
				}
				
				
				$( ".nav-sbmenu ul li" ).each(function() {
					
					var sblinks = $( this ).children( 'a' ).attr( 'href' );
					var sbtext = $( this ).children( 'a' ).text();
					var selActive = '';
					
					if( $( this ).hasClass( "current_page_item" ) || $( this ).hasClass( "current-menu-item" ) ) {
						if( !$( ".nav-menuselect" ).hasClass( "non-product" ) ) {
							$( ".all-products" ).removeAttr( 'selected' );
						}
						selActive = 'selected';
					}
					optionLinks.push( '<option class="linkDD" value="' +sblinks + '"'+selActive+'>' + sbtext + '</option>' );
					
				});
				
				$( ".nav-menuselect select" ).append( optionLinks );
				$( ".nav-menuselect select" ).selectmenu({
					change: function( event, data ) {
						var urlLink = data.item.value;
						if ( urlLink ) {
							window.location = urlLink;
						}
						return false;
					}
				});
			}
		}
		else {
			$( ".nav-menuselect select" ).html( '' );
		}
	};
	
	
	globalJS.navsearch();
	globalJS.bannerTextCenter();
	globalJS.navDropdown();
	//resize
	$(window).on('resize',function(){
		globalJS.bannerTextCenter();
		globalJS.navDropdown();
	});

});
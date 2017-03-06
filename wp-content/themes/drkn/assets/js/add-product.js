/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

( function( $ ) {

	$( document ).ready( function() {
		var container = $( 'section#AddProductPage' );

		if( container.length ) {
			var sizeName = container.data( 'size' );
			var productID = container.data( 'id' );
			var link = container.data( 'link' );
			var selection = container.data( 'selection' );

			$.ajax( {
				url: addProduct.ajaxurl,
				data: { 'action': 'addProduct', 'sizeName': sizeName, 'productID': productID, 'link': link, 'selection': selection },
				type: 'POST',
				dataType: 'JSON',
				success: function( data ) {
					console.log( data.basket );

					if( data.success ) {
						//Update minicart contents
						//Display minicart after 4secs remove class.
						$( '#js-numberOfItems' ).text( data.totalItems ).parent().addClass( 'is-selected' );
						$( '#js-selectedItems' ).html( data.basket );
						$( '#js-popOut' ).addClass( 'popOut--open' );
						
						drkn.fixResponsive();
						
						window.setTimeout( function() {
							$( '#js-popOut' ).removeClass( 'popOut--open' );
						}, 3000 );
					}
				}
			} );
		}
	} );

} )( jQuery );
var Checkout = {};

( function( $ ) {

	Checkout.init = function() {

		$('#esc_purchase').on('click','.u-mainButton',function(e){
			return validateForm();
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
				
				Checkout.voucherProcess( $( this ).parent().next() );
			}
		});

		$('#js-voucher-fields').on('click', 'button', function (e) {
			e.preventDefault();
			
			Checkout.voucherProcess( $( this ) );
		});

	};
	
	Checkout.voucherProcess = function( $button ) {
		var sendData = $('#esc_purchase').serialize();
		var buttonName = $button.attr('name');
		var buttonValue = $button.attr('value');

		sendData += '&' + buttonName + '=' + buttonValue + '&ajax=1';

		//Update all HTML
		$.ajax( {
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
		} );
	};

	$( document ).ready( function() {
		Checkout.init();
	} );

} ) ( jQuery );


var validateForm = function() {

	console.log('validate');

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



function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
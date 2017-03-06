jQuery(document).ready(function($) {
    
	var itemsInCheckout = $('#checkout-cont').data('item-count'),
		getAddress = false;

    //Cycle through pics.
	$('#main-prod-cont').on('click', 'li', function(){
		var $this = $(this);

		if($this.next().length > 0) {
			$this.removeClass('current').next().addClass('current');
		} else {
			$this.removeClass('current').parent().children().eq(0).addClass('current');
		}
	});


	$('.to-selection').on('submit', function(e){	

		// Check that we have val
		if ( ! $('select[name="add_item"]').val()) {
			$('.custom-select .title').trigger('click');			
			if ($('.custom-select .title').is(':visible')) {
				console.log('visible');
				$('.custom-select').css('border-color', 'red');
			}
			
			return false;
		}

		e.preventDefault();
		var $this = $(this),
			action = $this.attr('action'),
			data = $this.serialize() + '&ajax=1';
	
		$this.parent().prev().addClass('to-checkout-now');
	
		$.ajax({
			url: action,
			type: 'POST',
			data: data,
			dataType: 'JSON',
			success: function(data) {	
				var cart = $('#cart-count'), count = 0;
				count = parseInt(cart.text()) + 1;
				cart.text(count);			
			}
		});
		
		$(this).find('input[type="submit"]').hide();
		$(this).find('.product-black-btn').css('display','block');
		$('.product-to-cart-wrapper').show();	
		$('header').css('marginTop', '134');
		$('.main').css('paddingTop', '237');
		$(document).scrollTop(0);
	});

	//Update top selection from checkout
	$('#co-prod-list').on('click', '.change-amount', function(e){
		e.preventDefault();

		var loc = $(this).attr('href')+'&ajax=1&checkout=1';
		loc = loc.replace('?','');

		if(itemsInCheckout === 1 && $(this).hasClass('delete')) {
			if(!window.confirm('Ville du verkligen ta bort sista produkten?')) {
				//stop if customer changes their mind about the last product.
				return;
			}
		}

		$.ajax({
			type: 'POST',
			data: loc,
			dataType: 'JSON',
			success: function(data) {
				itemsInCheckout = data.items;
				if(itemsInCheckout === 0) {
					window.location = window.location;
				} else {
					$('#selection').html(data.sel);
					$('#co-prod-list').html(data.coSel);
					$('#checkout-totals').html(data.coTotals);
				}
			}
		});		
	});

	var checkValues = function(get) {
		//Check values.
		var getArray = get.split('&'),
			check = {
				'address_firstName': true,
				'address_lastName': true,
				'address_address1': true,
				'address_city': true,
				'address_zipCode': true,
				'address_country': true,
				'address_email': true,
				'address_phoneNumber': true,
				'termsAndConditions': true
			};

		for (var i = 0; i < getArray.length; i++) {
			var field = getArray[i].split('=');
			if(check[field[0]]) {
				if(/\S/.test(field[1])) {
					delete check[field[0]];
				} 
			}
		}

		for(var prop in check) {
	        if(check.hasOwnProperty(prop)) {
	            $('#error-cont').html('<div class="errors"><h3>Alla fält måste fylls i</h3></div>');
	            return false;
	        }
	    }
	    return true;
	}

	$('#get-address').on('click', function(e){
		getAddress = true;
	});

	$('#purchase').on('submit', function(e){
		var $this = $(this);

		if(!getAddress) {
			return checkValues($this.serialize());
		} else {
			getAddress = false;
			return true;
		}
	});

	//Show/hide sections on selection
	var showHiddenForms = function() {
		if($(this).find('input').is(':checked')) {
			$(this).next().show();
		} else {
			$(this).next().hide();
		}
	};

	$('.heading-cb').each(function() {
		var $this = $(this);
		showHiddenForms.apply($this);
	})
	$('.heading-cb').on('click', function(){
		var $this = $(this);
		showHiddenForms.apply($this);
	});

	//Copy above form and place in bottom form.
	$('#copy-above').on('click', function(e){
		e.preventDefault();
		
		$('#shipping-form').find('input').each(function() {
			var id = $(this).attr('id').replace('shippingAddress', 'address');
			$(this).val($('#'+id).val());
		})
		$('#shipping-form').find('select').each(function() {
			var id = $(this).attr('id').replace('shippingAddress', 'address'),
				newVal = $('#'+id).val(),
				newText = $('#'+id).find('option[value="'+newVal+'"]').text();
			
			$(this).val(newVal);
			$(this).prev().text(newText);
		})

	});

	//Print functionality
	$('.print').on('click', function(e){
		e.preventDefault();

		window.print();
	});


	var verifyVals = function($el){
		var $this = $el,
		val = $this.val(),
		errors = 0,
		emptyReg = /\S/,
		numbReg = /\D/,
		name = $this.data('type') || "";

		switch(name){
			case "email":
				errors = (val.indexOf('@') === -1 || val.indexOf('@') > val.lastIndexOf('.')) ? 1 : 0;
				break;
			case "remail":
				errors = (val !== $('#reg_email').val()) ? 1 : 0;
				break;
			case "password":
				errors = (!emptyReg.test(val) || val === $this.attr('placeholder') || val.length < 8) ? 1 : 0;
				break;
			case "repassword":
				errors = (!emptyReg.test(val) || val === $this.attr('placeholder') || val !== $('input#cus_pass,input#reg_pass').val()) ? 1 : 0;
				break;
			case "checkbox":
				errors = (!$this.is(':checked')) ? 1 : 0;
				break;
			case "dropdown":
				errors = (val == 0) ? 1 : 0;
				break;
			case "number":
				errors = (numbReg.test(val) || (!emptyReg.test(val) || val === $this.attr('placeholder')) || val < 1) ? 1: 0;
				break;
			case "hidden":
				errors = 0;
				break;
			default:
				errors = (!emptyReg.test(val) || val === $this.attr('placeholder')) ? 1 : 0;
				break;
		}

		if(errors === 1) { $this.addClass('err'); $this.parent().addClass('err') } else { $this.removeClass('err'); $this.parent().removeClass('err') }
		return errors;

	}

	//Check values on input change	
	$('.validate-val').on({
		blur: function(){
			verifyVals($(this));
		},
		focus: function(){
			$(this).removeClass('err');
			$(this).parent().removeClass('err');
		},
		change: function(){
			verifyVals($(this));
		}
	});


});

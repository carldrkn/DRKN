<?php
	if(class_exists('EscSelection')) {
		$selection = new EscSelection();
		$selection->paymentFieldTemplate('<div class="col-md-6 col-sm-6 col-xs-12 no-padding-left"><label for="{id}"><input id="{id}" type="{type}" name="{name}" value="{value}" {checked}><span></span><!--<img src="' . get_stylesheet_directory_uri() . '/assets/images/{id}.png?v=123">--></label></div>');
		$selection->renderPaymentLoop('adyen');
	}

<?php

/*
 * ABOUT:
 * Silk specific characteristics needed for display of receipt page.
 * Runs prior to product page being displayed.
 *
*/

class EscSuccess {

	function __construct() {
	}

	static public function init() {
		$return_variables = array('paymentMethodFields' => $_REQUEST);
		
		if(isset($_SESSION['esc_store'])) {
			$esc_init = EscConnect::init('selections/' . $_SESSION['esc_store']['selection_id'] . '/payment-result');
			$complete_purchase = $esc_init->post($return_variables);
		} else {
			$complete_purchase = array('success' => false, 'errors' => 'Session has expired');
		}

		return $complete_purchase;
	}

	static public function clearSession() {
		unset($_SESSION['esc_store']);
		unset($_SESSION['esc_selection']);
	}

}
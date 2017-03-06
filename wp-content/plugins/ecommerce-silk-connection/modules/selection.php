<?php

/*
 * ABOUT:
 * Silk specific characteristics needed for display of product page.
 * Runs prior to product page being displayed.
 *
*/

class EscSelection {

	private $input_template;
	private $select_template;
	private $check_template;
	private $payment_template;
	private $submit_template;

	function __construct() {

	}

	//Set up templates for use later on.
	public function inputFieldTemplate($input_template) {
		$this->input_template = $input_template;
	}

	public function selectFieldTemplate($select_template) {
		$this->select_template = $select_template;
	}

	public function checkFieldTemplate($check_template) {
		$this->check_template = $check_template;
	}

	public function paymentFieldTemplate($payment_template) {
		$this->payment_template = $payment_template;
	}

	public function submitFieldTemplate($submit_template) {
		$this->submit_template = $submit_template;
	}

	static public function renderPossibleErrors() {
		global $esc_errors;

		if($esc_errors) {
			foreach ($esc_errors as $error_key => $error) {
				$error_message = '<strong>' . sanitize_text_field($error_key) . '</strong> ' . sanitize_text_field($error);
				if($error_key === 'termsAndConditions') $error_message = 'Terms and Conditions must be selected to continue with purchase';
				echo '<p class="checkoutErrors">' . $error_message . '</p>';
			}
		}
	}

	static public function getVouchers() {
		$selection = EscGeneral::getSelection();
		if(isset($selection['discounts']) && isset($selection['discounts']['vouchers'])) {
			return $selection['discounts']['vouchers'];
		} else {
			return array();
		}
	}

	static public function isVoucherSet() {
		$selection = EscGeneral::getSelection();
		return (isset($selection['discounts']) && isset($selection['discounts']['vouchers']) && $selection['totals']['totalDiscountPriceAsNumber']);
	}

	static public function hasSelection() {
		$selection = EscGeneral::getSelection();
		return $selection['success'];
	}

	static public function getSelectCountries() {
		$esc_countries = EscController::getCountries();
		$str = '';
		$current_country = EscGeneral::getCurrentCountry();
		foreach ($esc_countries as $country) {
			if(!isset($country['name'])) continue;
			$selected = $current_country === $country['country'] ? ' selected="selected"' : '';
			$str .= '<option value="' . sanitize_alphanumeric($country['country']) . '"' . $selected . '>' . sanitize_text_field($country['name']) . '</option>';
		}
		return $str;
	}

	static public function getSelectStates($country_code) {
		$esc_countries = EscController::getCountries();
		$str = '';
		$states = $esc_countries[$country_code];
		foreach ($states['states'] as $state_code => $state) {
			$str .= '<option value="' . sanitize_alphanumeric($state_code) . '">' . sanitize_text_field($state) . '</option>';
		}
		return $str;
	}

	static public function showStates() {
		$countries_with_states = array('US', 'CA', 'AU');
		return in_array($_SESSION['esc_store']['country'], $countries_with_states);
	}

	static public function getPaymentMethods() {
		return isset($_SESSION['esc_selection']['paymentMethodsAvailable']) ? $_SESSION['esc_selection']['paymentMethodsAvailable'] : array();
	}

	//Return code to be rendered on the page.
	public function renderStartSelectionForm() {
		echo '<form id="esc_purchase" method="POST">';
		echo '<input type="hidden" name="esc_action" value="esc_selection">';
		wp_nonce_field('confirm_selection');
	}

	private function returnTemplate($replaces, $template) {
		$str = preg_replace_callback('/\s?\{(.+?)\}\s?/', function($matches) use ($replaces) {
			if(!isset($replaces[$matches[1]])) return '';
			return $replaces[$matches[1]];
		}, $template);

		return $str;
	}

	public function renderField($str, $content = '', $shipping = false, $class = array()) {
		if(strpos($str, 'remove_voucher_') !== false) {
			$current_voucher = str_replace('remove_voucher_', '', $str);
			$str = 'remove_voucher';
		}
		$str = sanitize_alphanumeric($str);
		
		$replaces = array(
			'type' => 'text',
			'classes' => '',
			'id' => ($shipping ? 'shippingAddress_' . $str : 'address_' . $str),
			'name' => ($shipping ? 'shippingAddress[' . $str . ']' : 'address[' . $str . ']'),
			'value' => '',
			'content' => $content,
			'checked' => '',
		);

		for ($i=0; $i < count($class); $i++) { 
			$replaces['class_' . $i] = ' ' . $class[$i];
		}

		if(strpos($str, 'internalComment') !== false) {
			$replaces['id'] = $str;
			$replaces['name'] = str_replace('_', '[', $str) . ']';
		}

		switch ($str) {
			case 'email':
				$replaces['type'] = 'email';
				echo $this->returnTemplate($replaces, $this->input_template);
				break;
			case 'country':
				$replaces['options'] = EscSelection::getSelectCountries();
				echo $this->returnTemplate($replaces, $this->select_template);
				break;
			case 'state':
				$replaces['options'] = '';
				if(EscSelection::showStates()) $replaces['options'] = EscSelection::getSelectStates($_SESSION['esc_store']['country']);
				echo $this->returnTemplate($replaces, $this->select_template);
				break;
			case 'voucher':
				$replaces['id'] = $str;
				$replaces['name'] = $str;
				echo $this->returnTemplate($replaces, $this->input_template);
				break;
			case 'remove_voucher':
				$replaces['value'] = $current_voucher;
				$replaces['name'] = 'remove_voucher';
				echo $this->returnTemplate($replaces, $this->submit_template);
				break;
			case 'submit_voucher':
				$replaces['value'] = 1;
				$replaces['name'] = 'submit_voucher';
				echo $this->returnTemplate($replaces, $this->submit_template);
				break;
			case 'add_voucher':
				$replaces['value'] = 1;
				$replaces['type'] = 'checkbox';
				$replaces['name'] = $str;
				$replaces['checked'] = EscSelection::isVoucherSet() ? ' checked="checked"' : '';
				echo $this->returnTemplate($replaces, $this->check_template);
				break;
			case 'newsletter':
				$replaces['value'] = 1;
				$replaces['type'] = 'checkbox';
				echo $this->returnTemplate($replaces, $this->check_template);
				break;
			case 'termsAndConditions':
			case 'ship_to_another_address':
				$replaces['value'] = 1;
				$replaces['type'] = 'checkbox';
				$replaces['name'] = $str;
				echo $this->returnTemplate($replaces, $this->check_template);
				break;
			default:
				echo $this->returnTemplate($replaces, $this->input_template);
				break;
		}

	}

	public function renderPaymentLoop($id = false) {

		$replaces = array(
			'id' => '',
			'type' => 'radio',
			'name' => 'paymentMethod',
			'checked' => '',
		);

		$payment_methods = EscSelection::getPaymentMethods();
		$methods = array();
		$first = ($id === false);

		foreach ($payment_methods as $method) {
			$replaces['id'] = $method['paymentMethod'];
			$replaces['value'] = $method['paymentMethod'];
			if($replaces['id'] === $id || $first) {
				$replaces['checked'] = 'checked="checked"';
				array_unshift($methods, $this->returnTemplate($replaces, $this->payment_template));
			} else {
				$replaces['checked'] = '';
				array_push($methods, $this->returnTemplate($replaces, $this->payment_template));
			}
		}

		foreach ($methods as $method) {
			echo $method;
		}
		
	}

	public function renderEndSelectionForm() {
		echo '</form>';
	}

}
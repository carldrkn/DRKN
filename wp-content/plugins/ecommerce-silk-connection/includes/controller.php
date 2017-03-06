<?php

include_once(Esc::directory() . '/includes/connect.php');

class EscController {

	private $architecture_options;
	private $connections_options;
	private $errors;
	private $store;

	public function __construct() {
		//Set up Silk settings in the session
		add_action('init', array($this, 'init'));

		//Additional functionality to posts for retrieving product data
		add_action('wp', array($this, 'routing'));
	}

	public function init() {			
		//Which pages map to which modules
		$this->architecture_options = get_option('esc_architecture_options');

		//No Session? Set shop defaults
		if(!session_id()) session_start();
		
		if(!isset($_SESSION['esc_store']) || empty($_SESSION['esc_store'])) {
			$this->setShopSettings();
		}

	}

	public function routing() {
		global $wp_query, $esc_errors;
		$current_page_id = null;		

		//Should redirect to a specific preview page, perhaps move to routing...
		if(isset($this->architecture_options['esc_close_on']) && $this->architecture_options['esc_close_on'] == 1) $this->_closeStore();

		//Need to get which category archive we are in - page category doesn't work. 
		$which_module = '';

		//Page routing
		if(is_tax('silk_category')) {
			//Category or archive view, no single post.
			$which_module = 'esc_category_page';
		} else if(is_singular('silk_products')) {
			//Custom post type product
			$which_module = 'esc_product_page';
		} else {
			//Routing based on current page id
			if(isset($wp_query->post)) {
				$current_page_id = $wp_query->post->ID;
				foreach ($this->architecture_options as $page_name => $page_id) {
					if($page_id == $current_page_id) $which_module = $page_name;
				}
			}
		}

		//Include general functions
		include_once(Esc::directory() . '/modules/general.php');

		//Extend pages
		switch ($which_module) {
			case 'esc_category_page':
				include_once(Esc::directory() . '/modules/category.php');
				break;
			case 'esc_fail_page':
				include_once(Esc::directory() . '/modules/fail.php');
				break;
			case 'esc_product_page':
				include_once(Esc::directory() . '/modules/product.php');
				new EscProduct($current_page_id);
				break;
			case 'esc_push_page':
				include_once(Esc::directory() . '/modules/push.php');
				break;
			case 'esc_selection_page':
				include_once(Esc::directory() . '/modules/selection.php');
				break;
			case 'esc_success_page':
				include_once(Esc::directory() . '/modules/success.php');
				break;
		}

		//Routing for requests
		//Placed here for AJAX requests
		if(!empty($_REQUEST)) $esc_errors = $this->requests();
		
		//Not an ecommerce page continue
	}

	public function requests() {

		$request_arr = $_REQUEST;
		$esc_errors = array();

		//Not a esc action stop processing
		if(!isset($request_arr['esc_action'])) return;

		switch ($request_arr['esc_action']) {
			case 'esc_unlock_product':
				if(wp_verify_nonce($request_arr['_wpnonce'], 'unlock_' . (int)$request_arr['esc_post'] . '_product' )) {
					EscConnect::verifyProductVoucherUnlock($request_arr);
				}
				break;
			case 'esc_select_product':
				if(wp_verify_nonce($request_arr['_wpnonce'], 'add_' . (int)$request_arr['esc_post'] . '_to_selection' )) {
					EscConnect::editProduct($request_arr);
				}
				break;
			case 'esc_add_product':
 				EscConnect::editProduct($request_arr, (int)$request_arr['esc_amount']);
				break;
			case 'esc_remove_product':
 				EscConnect::editProduct($request_arr, (int)$request_arr['esc_amount']);
				break;
			case 'esc_selection':
				if(wp_verify_nonce($request_arr['_wpnonce'], 'confirm_selection' )) {
					$esc_errors = EscConnect::selection($request_arr);
				}
				break;
			case 'esc_change_country':
				EscConnect::changeCountry($request_arr, $request_arr['esc_country']);
				break;
			case 'esc_submit_newsletter':
				if(wp_verify_nonce($request_arr['_wpnonce'], 'silk_submit_newsletter' )) {
					EscConnect::submitNewsletter($request_arr);
				}
				break;
		}

		return $esc_errors;

	}

	static public function getCountriesApi() {
		$esc_init = EscConnect::init('countries');
		$esc_countries = $esc_init->get();
		update_option('esc_shipping_countries', json_encode($esc_countries));
		return $esc_countries;
	}

	static public function getCountries($country_code = null) {
		$countries = get_option('esc_shipping_countries');
		$countries = $countries == 'false' ? EscGeneral::getCountriesApi() : json_decode($countries, true);
		if(isset($country_code) && isset($countries[$country_code])) {
			return $countries[$country_code];
		} else {
			return $countries;
		}
	}

	//Define location, pricelist and market
	public function setShopSettings() {
		$country_code = Esc::getUserCountryCode();
		$esc_store = EscController::getCountries($country_code);
		$_SESSION['esc_store'] = $esc_store;
	}

	private function _closeStore() {
		global $wp_query;

		$current_page_id = null;
		if(isset($wp_query->post)) {
			$current_page_id = $wp_query->post->ID;
		}

		if(isset($_REQUEST['preview0202']) || isset($_SESSION['demo_mode_on']) && $_SESSION['demo_mode_on']) {
			$_SESSION['demo_mode_on'] = true;
			if(isset($this->architecture_options['esc_preview_page']) && $current_page_id === intval($this->architecture_options['esc_preview_page'])) {
				wp_redirect(home_url());
				exit;
			}
		} else {
			//Shut webshop.
			if(isset($this->architecture_options['esc_preview_page'])) {
				if($current_page_id !== intval($this->architecture_options['esc_preview_page'])) {
					wp_redirect(get_permalink($this->architecture_options['esc_preview_page']));
				}
			} else {
				echo "Website is temporarily closed please contact an adminstrator for this site.";
				die;
			}
		}
	}

}

new EscController();

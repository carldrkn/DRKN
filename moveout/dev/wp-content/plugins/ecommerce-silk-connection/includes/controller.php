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

		//Should redirect to a specific preview page, perhaps move to routing...
		if(isset($this->architecture_options['esc_close_store']) && $this->architecture_options['esc_close_store'] == 1) $this->_closeStore();
	}

	public function routing() {
		global $wp_query;
		$current_page_id = null;

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
		if(!empty($_REQUEST)) $this->requests();
		
		//Not an ecommerce page continue
	}

	public function requests() {

		$request_arr = $_REQUEST;

		//Not a esc action stop processing
		if(!isset($request_arr['esc_action'])) return;

		switch ($request_arr['esc_action']) {
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
					EscConnect::selection($request_arr);
				}
				break;
			case 'esc_change_country':
				EscConnect::changeCountry($request_arr, $request_arr['esc_country']);
				break;
		}

	}

	//Define location, pricelist and market
	public function setShopSettings() {
		$_SESSION['esc_store'] = EscConnect::init('countries/' . $_SERVER['geo_location'])->get();
	}

	private function _closeStore() {

		if(isset($_REQUEST['preview0202']) || isset($_SESSION['demo_mode_on']) && $_SESSION['demo_mode_on']) {
			$_SESSION['demo_mode_on'] = true;
		} else {
			//Shut webshop.
			echo "Webshop is closed :/ Contact the adminstrator for more information.";
			die;
		}
	}

}

new EscController();


/*
	function esc_control_init() {

		//Run Ajax functions.
		if(isset($_POST['ajax']) && isset($_POST['update_selection'])) {		
			include_once(Esc::directory().'/mods/selection.php');
			$selection = init_selection(true);
			if(isset($_POST['checkout'])) {
				$items = count($_SESSION['selection']['items']);
				$coSel = esc_checkout_selection();
				$coTotals = esc_checkout_totals();
				echo json_encode(array('sel' => $selection, 'items' => $items, 'coSel' => $coSel, 'coTotals' => $coTotals));
			} else {
				echo json_encode(array('sel' => $selection));
			}

			exit;
		}

		if(isset($_REQUEST['checkout'])) { 
			//Add subscription in here.
			$esc_errors = esc_create_checkout();
		}

		if(isset($_REQUEST['update_voucher']) && $_REQUEST['update_voucher']) {
			$add_vouch = isset($_REQUEST['voucher_code'])?urlencode($_REQUEST['voucher_code']):false;
			$rem_vouch = isset($_REQUEST['voucher_code_remove'])?urlencode($_REQUEST['voucher_code_remove']):false;
			
			if($add_vouch) {
				$esc_voucher_req = esc_rest('selections/'.$_SESSION['silk_store']['selection_id'].'/vouchers/'.$add_vouch);
				$esc_voucher = $esc_voucher_req->post();

				if (!isset($esc_voucher['notFound']))
					$_SESSION['selection'] = $esc_voucher;
			}
			if($rem_vouch) {
				$esc_voucher_req = esc_rest('selections/'.$_SESSION['silk_store']['selection_id'].'/vouchers/'.$rem_vouch);
				$esc_voucher_rem = $esc_voucher_req->delete();

				$_SESSION['selection'] = $esc_voucher_rem;
			}
		}

	}

	add_action( 'wp_enqueue_scripts', 'esc_script_enqueuer' );
	function esc_script_enqueuer() {
		wp_register_script( 'esc_main', ESC_PLUGIN_URL.'/js/main.js', array( 'jquery' ), 1, false);
		wp_enqueue_script( 'esc_main' );
	}

	add_action('plugins_loaded', 'esc_add_shortcodes');
	function esc_add_shortcodes() {
		add_shortcode('ecommerce-silk-connection', 'esc_shortcode_handler');
		add_shortcode('esc', 'esc_shortcode_handler');
	}

	function esc_shortcode_handler($attrs, $content = null) {
		
		if(!isset($attrs['id'])) {
			return '[ecommerce-silk-connection id="404"]';
		}

		//Functions to run from id
		$calls = array(
			'product_list' => array('/mods/list.php','init_list'),
			'checkout' => array('/mods/checkout.php','init_checkout'),
			'payment_returned' => array('/mods/receipt.php','init_receipt'),
			'payment_failed' => array('/mods/failed.php','init_failed'),
			'retrieve_prods' => array('/mods/create-prods.php','create_prods'),
		);
		
		//Include file
		include_once(Esc::directory().$calls[$attrs['id']][0]);
		//Initiate function
		$html = call_user_func($calls[$attrs['id']][1], $attrs);
		//Display data
		return $html;
	}

	function esc_cart_display() {
		//Include file
		include_once(Esc::directory().'/mods/selection.php');
		//Initiate function
		$html = call_user_func('init_selection');
		return $html;
	}

	function esc_single_product($post) {
		//Include file
		include_once(Esc::directory().'/mods/single-product.php');
		//Initiate function
		$html = call_user_func('init_product', $post);
		return $html;	
	}

	function esc_selection_upd() {
		echo json_encode(array('success' => true));
		exit;
	}
*/
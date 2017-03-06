<?php

include_once(Esc::directory() . '/includes/rest.php');

class EscConnect {

	static public function init($uri, $sendHeader = true, $root = false) {

		//Get connection options from WP settings.
		$connections_options = get_option('esc_connections_options');
		$header = array();
		
		//Include authorization header
		if($sendHeader) $header = array('API-Authorization: ' . $connections_options['esc_authorization_code']);

		//Add URL
		$silk_url = rtrim($connections_options['esc_silk_url'], '/ ');
		$root = $root ? rtrim($root , '/ ') : $silk_url;
		
		return new EscRest($root . '/' . $uri, $header);
	}

	static public function getSelection() {
		$esc_store = $_SESSION['esc_store'];

		/*
			Needed to create selection with:
		  "country": "Country ISO 3166-1 alpha-2, for example SE",
	  	"market": "market id",
	  	"pricelist": "pricelist id"
		*/
		$create_selection_array = array(
			'country' => $esc_store['country'],
			'market' => $esc_store['market'],
			'pricelist' => $esc_store['pricelist']
		);

		if(!isset($esc_store['selection_id'])) {
			//Start basket 
			$current_selection = EscConnect::init('selections')->post($create_selection_array);
			
			if(!empty($current_selection['selection'])) {
				$_SESSION['esc_store']['selection_id'] = $current_selection['selection'];
				$esc_store = $_SESSION['esc_store'];
			} else {
				return array('success' => false, 'error' => 'No selection id found and failed to create a new one.');
			}
		}

		return array('success' => true, 'esc_store' => $esc_store);
	}

	static public function changeCountry($request, $country_code) {
		$change_country_arr = array();
		$selection = EscConnect::getSelection();

		if($selection['success']) {
			$esc_store = $selection['esc_store'];

			$esc_init = EscConnect::init('selections/' . $esc_store['selection_id'] . '/countries/' . $country_code);
			$esc_country = $esc_init->put();

			if($esc_init->httpCode() === 200) {

				$_SESSION['esc_store']['country'] = $esc_country['country'];
				$_SESSION['esc_store']['market'] = $esc_country['market'];
				$_SESSION['esc_store']['pricelist'] = $esc_country['pricelist'];
				$_SESSION['esc_store']['currency'] = $esc_country['currency'];

				$_SESSION['esc_selection'] = $esc_country;

				ob_start();
				include(get_template_directory() . '/parts/shop/header-selection.php');
				$change_country_arr['basket'] = ob_get_contents();
				ob_clean();

				ob_start();
				include(get_template_directory() . '/parts/shop/payments-selection.php');
				$change_country_arr['payments'] = ob_get_contents();
				ob_clean();

				ob_start();
				include(get_template_directory() . '/parts/shop/checkout-selection.php');
				$change_country_arr['items'] = ob_get_contents();
				ob_clean();

				ob_start();
				include(get_template_directory() . '/parts/shop/totals-selection.php');
				$change_country_arr['totals'] = ob_get_contents();
				ob_clean();

				if(isset($request['esc_get_states'])) $change_country_arr['states'] = EscSelection::getSelectStates($country_code);
				
				echo json_encode($change_country_arr);
				die;
			}
		}
	}

	static public function editProduct($request, $action = 1) {
		$selection = EscConnect::getSelection();
		
		if($selection['success']) {
			$esc_store = $selection['esc_store'];
			if(!isset($request['esc_product_item'])) return;
			$product_item = sanitize_text_field($request['esc_product_item']);
			$post_id = (int)$request['esc_post'];
			
			if($action === 'remove') {
				//Remove the whole product
				$esc_init = EscConnect::init('selections/' . $esc_store['selection_id'] . '/items/' . $product_item);
				$esc_selection = $esc_init->delete();
			} else if(intval($action) && $action > 0) {
				//Add a certain amount of products
				$esc_init = EscConnect::init('selections/' . $esc_store['selection_id'] . '/items/' . $product_item . '/quantity/' . (int)$action);
				$esc_selection = $esc_init->post();
			} else if(intval($action) && $action < 0) {
				//Remove a certain amount of products
				$esc_init = EscConnect::init('selections/' . $esc_store['selection_id'] . '/items/' . $product_item . '/quantity/' . abs((int)$action));
				$esc_selection = $esc_init->delete();
			}

			//pr($esc_init->dump());

			if($esc_selection !== false) {
				//Save to selection to session
				$_SESSION['esc_selection'] = $esc_selection;
				$matched_item = false;

				if($action === 'remove') {
					//Remove post link from selection
					unset($esc_store['posts'][$product_item]);
				} else if(intval($action) && $action > 0) {
					$esc_store['posts'][$product_item] = $post_id;
				} else if(intval($action) && $action < 0) {
					if(isset($esc_selection['items'])) {
						foreach ($esc_selection['items'] as $item) {
							if($item['item'] === $product_item) $matched_item = true;
						}
					}
					if(!$matched_item) unset($esc_store['posts'][$product_item]);
				}

				$_SESSION['esc_store'] = $esc_store;

				if(is_ajax_request()) {
					ob_start();
					include(get_template_directory() . '/parts/shop/header-selection.php');
					$basket_html = ob_get_contents();
					ob_clean();
					echo json_encode(array('success' => true, 'data' => $esc_selection, 'html' => $basket_html));
					die;
				}
			} else {
				if(is_ajax_request()) {
					echo json_encode(array('success' => false, 'error' => 'Products were not able to be added to selection.'));
					die;
				}
			}

		}

	}

	static public function selection($request) {
		$selection = EscConnect::getSelection();

		if($selection['success']) {
			
			if(isset($request['submit_voucher']) && $request['submit_voucher']) {

				$esc_init = EscConnect::init('selections/' . $selection['esc_store']['selection_id'] . '/vouchers/' . $request['voucher']);
				$esc_selection = $esc_init->post();

				if($esc_init->httpCode === 200) {
					$_SESSION['esc_store']['voucher'] = array('success' => true, 'voucher_name' => $request['voucher']);
					$_SESSION['esc_selection'] = $esc_selection;
				} else {
					$_SESSION['esc_store']['voucher'] = array('success' => false, 'error' => 'voucher not found');
				}

			} else if(isset($request['remove_voucher']) && $request['remove_voucher']) {

				$esc_init = EscConnect::init('selections/' . $selection['esc_store']['selection_id'] . '/vouchers/');
				$esc_selection = $esc_init->delete();

				if($esc_init->httpCode === 200) {
					$_SESSION['esc_store']['voucher'] = array('success' => false, 'error' => 'voucher removed');
					$_SESSION['esc_selection'] = $esc_selection;
				}
			} else {

  			$connections_options = get_option('esc_architecture_options');

				$paymemt_parameters = array(
					'selection' => $selection['esc_store']['selection_id'],
					'paymentMethod' => $request['paymentMethod'],
					'paymentReturnPage' => isset($connections_options['esc_success_page']) ? get_permalink($connections_options['esc_success_page']) : get_bloginfo('url'),
					'paymentFailedPage' => isset($connections_options['esc_fail_page']) ? get_permalink($connections_options['esc_fail_page']) : get_bloginfo('url'),
					'termsAndConditions' => $request['termsAndConditions'],
					'address' => $request['address'],
					'ipAddress' => $_SERVER['REMOTE_ADDR']
				);

				//Check if shipping is set
				if(isset($request['ship_to_another_address']) && $request['ship_to_another_address']) {
					$paymemt_parameters['shippingAddress'] = $request['shippingAddress'];
				}

				$esc_init = EscConnect::init('selections/' . $selection['esc_store']['selection_id'] . '/payment');
				$esc_selection = $esc_init->post($paymemt_parameters);

				if($esc_init->httpCode() != 200) {
					pr($esc_init->dump());				
				} else {
					switch(@$esc_selection['action']) {
						case 'form':
							if($paymemt_parameters['paymentMethod'] === 'klarna') {
								echo Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 
								echo $esc_selection['formHtml'];
								echo Starkers_Utilities::get_template_parts( array( 'parts/shared/html-footer', 'parts/shared/footer' ) ); 
							} else {
								echo '<!DOCTYPE><html><head><meta http-equiv="content-type" content="text/html; charset=utf-8"/></head><body>';
								echo $esc_selection['formHtml'];
								echo '</body></html>';
							}
							break;
						case 'redirect':
							wp_redirect($esc_selection['url']);
							break;
						case 'success':
							wp_redirect($paymemt_parameters['paymentReturnPage']);
							break;
						case 'failed':
							wp_redirect($paymemt_parameters['paymentFailedPage']);
							break;
					}

					die;
				}

			}

		}

	}

}

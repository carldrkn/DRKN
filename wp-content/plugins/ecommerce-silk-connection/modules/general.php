<?php

/*
 * ABOUT:
 * Functions used on multiple pages
 * Not referred to directly from theme code but proxied through page specific classes.
 *
*/

class EscGeneral {

	static public function getCurrentPricelist() {
		$store = $_SESSION['esc_store'];
		return (int) $store['pricelist'];
	}

	static public function getCurrentPricelistName() {
		$store = $_SESSION['esc_store'];
		return (string) $store['currency'];
	}

	static public function getCurrentMarket() {
		$store = $_SESSION['esc_store'];
		return (int) $store['market'];
	}

	static public function getCurrentCountry() {
		$store = $_SESSION['esc_store'];
		return sanitize_alphanumeric($store['country']);
	}

	static public function getPostMeta($product, $property = false) {
		//Get product meta if $post_id instead of product_meta.
		if(!is_array($product)) {
			$product_meta_data_raw = get_post_meta($product);
			$product_meta = unserialize($product_meta_data_raw['product_data'][0]);
		} else {
			$product_meta = $product;
		}

		if($property !== false) return $product_meta[$property];
		return $product_meta;
	}

	/**
	 * @param int|array $product Either post_id or product_meta array from post_meta
	 * @return array An error with reason of failure or price for that item and if it is on sale or is new.
	*/
	static public function getPrice($product, $check_availability = false) {
		$product_market = EscGeneral::getPostMeta($product, 'markets');

		$market = EscGeneral::getCurrentMarket();
		$pricelist = EscGeneral::getCurrentPricelist();

		//Not in market return error
		if(!isset($product_market[$market])) {
			return array('success' => false, 'error' => 'Product is not in the current market.');
		}

		//Not in pricelist return error
		if(!isset($product_market[$market]['pricesByPricelist'][$pricelist])) {
			return array('success' => false, 'error' => 'Product is in the right market but not in the current price list - not for sale.');
		}

		if($check_availability) {
			return array('success' => true, 'info' => array('stockOfAllItems' => $product_market[$market]['stockOfAllItems']));
		} else {
			//Price is set and is available in current market.
			return array('success' => true, 'info' => $product_market[$market]['pricesByPricelist'][$pricelist]);
		}
	}

	static public function isAvailable($product) {
		return EscGeneral::getPrice($product, true);
	}

	/**
	 * Splits page uri and tries to match the parts to the silk_category taxonomy
	 * @return array with name and url for breadcrumbs
	*/
	static public function getBreadcrumbs() {
		$uri = $_SERVER['REQUEST_URI'];
		$uri_parts = explode('/', $uri);
		$uri_concat = '';
		$categories = array();

		foreach ($uri_parts as $uri_part) {
			//Remove empty values and pagination from breadcrumbs
			if(empty($uri_part) || (string)(int)$uri_part == $uri_part || $uri_part == 'page' || strpos($uri_part, '?') === 0) continue;
			$uri_concat .= '/' . $uri_part;
			//Check if category
			$category_term = get_term_by('slug', $uri_part, 'silk_category');
			if(!empty($category_term)) {
				$category_link = get_term_link($category_term);
				$categories[] = array('url' => $category_link, 'uri' => $uri_concat, 'name' => $category_term->name);
			} else {
				//Otherwise fake it.
				$categories[] = array('url' => get_bloginfo('url') . $uri_concat, 'uri' => $uri_concat, 'name' => ucwords(strtolower($uri_part)));
			}
		}

		//Add a last flag for easier rendering.
		$categories[count($categories) - 2]['sec_last'] = true;
		$categories[count($categories) - 1]['last'] = true;

		return $categories;
	}

	static public function linkItemsToPosts($items, $posts) {
		foreach ($items as $key => $item) {
			$items[$key]['post_id'] = $posts[$item['item']];
		}
		return $items;
	}

	static public function getSelection() {
		$selection = $_SESSION;

		//No items added to selection yet return error.
		if(!isset($selection['esc_selection']) || (!isset($selection['esc_selection']['items']) && !isset($selection['esc_selection']['voucher']) )) {
			return array(
				'success' => false, 
				'error' => 'No items added to the selection yet.', 
				'total_items' => 0, 
				'items' => array(),
				'totals' => array(),
			);
		}

		$items = EscGeneral::linkItemsToPosts($selection['esc_selection']['items'], $selection['esc_store']['posts']);
		return array(
			'success' => true, 
			'total_items' => $selection['esc_selection']['totals']['totalQuantity'],
			'items' => $items, 
			'discounts' => $selection['esc_selection']['discounts'],
			'shipping' => $selection['esc_selection']['shippingMethodsAvailable'],
			'totals' => $selection['esc_selection']['totals'],
			'vat_exempt' => $selection['esc_selection']['vatExempt'],
		);
	}

	/**
	* @param $item array() the selection item.
	* @param $amount integer how many to add to the selection.
	* @return $str get query to add products.
	*/
	static public function getQueryAddProduct($item, $amount = 1) {
		return '?esc_action=esc_add_product&esc_post=' . intval($item['post_id']) . '&esc_product_item=' . $item['item'] . '&esc_amount=' . $amount;
	}

	/**
	* @param $item array() the selection item.
	* @param $amount integer how many to remove from the selection.
	* @return $str get query to remove products.
	*/
	static public function getQueryRemoveProduct($item, $amount = -1) {
		return '?esc_action=esc_remove_product&esc_post=' . intval($item['post_id']) . '&esc_product_item=' . $item['item'] . '&esc_amount=' . $amount;
	}

	static public function renderVoucherErrors($template) {
		if(isset($_SESSION['esc_store']['voucher']) && !$_SESSION['esc_store']['voucher']['success']) {
			$replaces = array('content' => $_SESSION['esc_store']['voucher']['error']);
			echo preg_replace_callback('/\s?\{(.+?)\}\s?/', function($matches) use ($replaces) {
				return $replaces[$matches[1]];
			}, $template);
			unset($_SESSION['esc_store']['voucher']);
		}
	}

}
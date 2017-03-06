<?php

/*
 * ABOUT:
 * Silk specific characteristics needed for display of product page.
 * Runs prior to product page being displayed.
 *
*/

class EscProduct {

	public $product_post;
	public $product_meta;

	function __construct($product_id) {
		$product_meta_data_raw = get_post_meta($product_id);
		$this->product_post = get_post($product_id);
		$this->product_meta = json_decode($product_meta_data_raw['json'][0], true);

		if(!empty($_REQUEST)) {}
	}

	public function getProductImages($args = array()) {
		$size = check($args, 'size', '');
		return '';
	}

	static public function getBreadcrumbs() {
		return EscGeneral::getBreadcrumbs();
	}

	static public function getMeasurementChart($chart_num) {
		$json = get_option('esc_measurement_charts');
		$chart = json_decode($json, true);
		return $chart[$chart_num];
	}

	public function renderStartPurchaseForm() {
		$post = $this->product_post;
		echo '<form id="js-selectProduct" method="POST">';
		echo '<input type="hidden" name="esc_action" value="esc_select_product">';
		echo '<input type="hidden" name="esc_post" value="' . $post->ID . '">';
		wp_nonce_field('add_' . $post->ID . '_to_selection');
	}

	public function renderSizesLoop($template) {
		//Get selected on second pass.
		$sizes = $this->product_meta['items'];
		$replaces = array();
		$market = EscGeneral::getCurrentMarket();
		$selected = (count($sizes) === 1 ? ' checked="checked" ' : '');
		$str = '';

		foreach ($sizes as $size_key => $size) {
			$has_stock = (int)$size['stockByMarket'][$market] > 0;
			$replaces['value'] = $size['item'];
			$replaces['name'] = $size['name'];
			$replaces['selector'] = 'esc_product_item';
			$replaces['selected'] = $selected;
			$replaces['selectedClass'] = '';
			$replaces['disabled'] = $has_stock ? '' : ' disabled="disabled" ';
			$replaces['disabledClass'] = $has_stock ? '' : ' disabled ';
			$replaces['id'] = 'select_size_' . $size['item'];

			$str .= preg_replace_callback('/\s?\{(.+?)\}\s?/', function($matches) use ($replaces) {
				return $replaces[$matches[1]];
			}, $template);
			
		}
		echo $str;
	}

	public function renderEndPurchaseForm() {
		echo '</form>';
	}

}
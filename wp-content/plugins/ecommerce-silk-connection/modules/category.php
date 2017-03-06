<?php

/*
 * ABOUT:
 * Silk specific characteristics needed for the display of the category page.
 * Runs prior to category page being displayed.
 *
*/

class EscCategory {

	function __construct() {
		global $wp_query;
		$is_ordered_by = $wp_query->get('orderby');

		//Sort order for category based on option in category. If no prior sort order specified.
		if(is_tax('silk_category') && empty($is_ordered_by)) {
			$current_category = $wp_query->query_vars['silk_category'];
			$product_array = get_option('category_order_' . $current_category);
			$temp_prod_order = array();

			foreach($wp_query->posts as $post_key => $post) {
				$silk_product_id = get_post_meta($post->ID, 'product_id');

				for($i = 0; $i < count($product_array); $i++) { 
					if($product_array[$i] == $silk_product_id[0]) {
						$temp_prod_order[$i] = $post;
					}
				}
			}

			ksort($temp_prod_order);
			$temp_prod_order = array_values($temp_prod_order);

			$wp_query->posts = $temp_prod_order;

		}

	}

	static public function getPrice($post_id) {
		return EscGeneral::getPrice($post_id);
	}

	static public function isAvailable($post_id) {
		return EscGeneral::isAvailable($post_id);
	}

	static public function getBreadcrumbs() {
		return EscGeneral::getBreadcrumbs();
	}

}

new EscCategory();
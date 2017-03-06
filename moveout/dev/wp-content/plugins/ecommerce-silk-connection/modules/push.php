<?php

include_once(Esc::directory() . '/includes/connect.php');

require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

/*
 * ABOUT:
 * Receives updates from Silk. This updates the products in the custom post typ silk_products
 * A diff is done on products prior to update and after update to remove any superfluous products/categories 
 * Categories and products are defined here. Brands and collections will also be included in future updates.
 *
 * TODO:
 * Check sort order of categories so that it matches whats coming out of silk.
 * Check if I need to add products to parent categories for them to show on the site.
 * Add more taxonomies for more ways of sorting products.
 * Save pricelists and markets?? Only if needed.
 *
*/

class EscPush {

	private $connections_options;
	private $previous_products;
	private $current_products = array();
	private $previous_categories;
	private $current_categories = array();
	private $previous_images;
	private $current_images = array();

	public function __construct() {
		ini_set ( 'max_execution_time', 60 * 5);

		//Used to compare products
		$this->previous_products = get_option('esc_current_products', array());
		$this->previous_categories = get_option('esc_current_categories', array());
		$this->previous_images = get_option('esc_current_images', array());
		$this->connections_options = get_option('esc_connections_options');

		add_action('the_post', array($this, 'init'));
	}

	public function init() {
		$this->getAllCountries();
		$this->getAllMeasurementCharts();
		$this->getAllPaymentMethods();
		$this->getAllCategories();
		$this->getAllProducts();
	}

	public function getAllCountries() {
		$esc_init = EscConnect::init('countries');
		$countries = $esc_init->get();
		//Save to option
		update_option('esc_shipping_countries', json_encode($countries, JSON_UNESCAPED_UNICODE));
	}

	public function getAllMeasurementCharts() {
		$esc_init = EscConnect::init('measurement-charts');
		$charts = $esc_init->get();
		//Save to option
		update_option('esc_measurement_charts', json_encode($charts, JSON_UNESCAPED_UNICODE));
	}

	public function getAllPaymentMethods() {
		$esc_init = EscConnect::init('payment-methods');
		$methods = $esc_init->get();
		//Save to option
		update_option('esc_payment_methods', json_encode($methods, JSON_UNESCAPED_UNICODE));
	}

	public function getAllCategories() {
		$category_request = EscConnect::init('categories');
		$categories = $category_request->get();

		//Recurse through the categories saving them
		$this->_saveCategories($categories);

		if(isset($this->connections_options['esc_demo_on'])) {
			echo '<h3>Category Data:</h3>';
			pr($categories);
		}
	}

	private function _saveCategories($categories, $id = 0, $taxonomy = 'silk_category') {
		foreach ($categories as $category) {

			$inserted_category = wp_insert_term(
				sanitize_text_field($category['name']), 
				$taxonomy,
				array(
					'description' => sanitize_text_field($category['metaDescription']),
					'slug' => sanitize_key($category['uri']),
					'parent' => $id
				)
			);

			$category_id = is_object($inserted_category) ? $inserted_category->error_data['term_exists'] : $inserted_category['term_id'];
			$this->current_categories[intval($category['category'])] = intval($category_id);

			//Remove from array in prepartion for deletion.
			if(isset($this->previous_categories[intval($category['category'])])) unset($this->previous_categories[intval($category['category'])]);

			if(isset($category['categories'])) {
				$this->_saveCategories($category['categories'], intval($category_id));
			}
		}
	}

	private function _deleteCategories() {
		if(count($this->previous_categories) > 0) {
			echo "<h3>Deleting Following Categories:</h3>";
			pr($this->previous_categories);

			foreach ($this->previous_categories as $category_id) {
				wp_delete_category($category_id);
			}
		}
	}

	public function getAllProducts() {
		$product_request = EscConnect::init('products');
		$products = $product_request->get();

		if(isset($this->connections_options['esc_demo_on'])) {
			echo '<h2>Total Products Retrieved: ' . count($products) . '</h2>';
			echo '<h3>Product Data:</h3>';
			pr($products);
		}

		$this->_saveProducts($products);
		$this->_deleteProducts();
		update_option('esc_current_products', $this->current_products);
		update_option('esc_current_images', $this->current_images);
	}

	private function _saveProducts($products, $taxonomy = 'silk_category') {
		foreach ($products as $product) {
			
			//Create category array for silk-product
			$product_categories = array();
			foreach ($product['categories'] as $category_key => $category_arr) {
				if(isset($this->current_categories[$category_key])) {
					$product_categories[] = $this->current_categories[$category_key];
				}
			}
			
			$post_array = array(
				'post_name' => $product['uri'],
				'post_title' => $product['name'],
				'post_content' => $product['description'],
				'post_excerpt' => $product['excerpt'],
				'post_status' => 'publish',
				'post_type' => 'silk_products'
			);

			$args = array('name' => $product['uri'], 'post_type' => 'silk_products', 'post_status' => 'any', 'posts_per_page' => 1 );
			$posts = get_posts($args);

			if($posts) {
				$post_id = $posts[0]->ID;
				$post_array['ID'] = $post_id;
				wp_update_post($post_array);				
				wp_set_object_terms($post_id, $product_categories, $taxonomy);
				
				echo 'Updated product: ' . $product['name'] . '<br />';
			} else {
				$post_id = wp_insert_post($post_array);
				wp_set_object_terms($post_id, $product_categories, $taxonomy);

				echo 'Inserted product: ' . $product['name'] . '<br />';
			}

			$this->current_products[$product['uri']] = $post_id;

			$this->_saveImages($post_id, $product);
			
			//Remove from array in prepartion for deletion.
			if(isset($this->previous_products[$product['uri']])) unset($this->previous_products[$product['uri']]);

			update_post_meta($post_id, 'json', json_encode($product, JSON_UNESCAPED_UNICODE));
			update_post_meta($post_id, 'canonical_category', $product['categories'][$product['canonicalCategory']]['uri']);

		}
	}

	private function _saveImages($post_id, $product) {
		//pr($product);

		$attachment_ids = array();
		foreach ($product['media'] as $media_item) {
			$url = $media_item['sources']['original']['url'];
			//Check if image has already been uploaded
			if(!isset($this->previous_images[$url])) {
				//Save image to WP
				$attachment_id = $this->createAttachmentFromUrl( $url, $post_id );
				if ( $attachment_id ) {
					$this->current_images[$url] = $attachment_id;
					$attachment_ids[] = $attachment_id;
				} else {
					//Error
				}
			} else {
				$attachment_ids[] = $this->previous_images[$url];
			}
		}
		update_post_meta($post_id, 'attachment_ids', $attachment_ids);
	}

	private function createAttachmentFromUrl( $url, $post_id ) {
		$filename = pathinfo( $url, PATHINFO_BASENAME );

		$upload_file = wp_upload_bits($filename, null, file_get_contents($url));

		if (!$upload_file['error']) {
			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_parent' => $post_id,
				'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
				'post_content' => '',
				'post_status' => 'inherit'
			);

			$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );
			if (!is_wp_error($attachment_id)) {
				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
				wp_update_attachment_metadata( $attachment_id,  $attachment_data );
			}
			return $attachment_id;
		}
		else
			return false;
	}

	private function _deleteProducts() {
		if(count($this->previous_products) > 0) {
			echo "<h3>Deleting Following Products:</h3>";
			pr($this->previous_products);

			foreach ($this->previous_products as $post_id) {
				wp_delete_post($post_id, true);
				delete_post_meta($post_id, 'json');
			}
		}
	}

}

new EscPush();

	/*
		$post = array(
			'ID'             		=> [ <post id> ] // WP defined id.
			'post_content'   		=> [ <string> ] // Description from Silk.
			'post_name'      		=> [ <string> ] // Product uri from Silk
			'post_title'     		=> [ <string> ] // Product title from Silk.
			'post_status'    		=> [ 'draft' | 'publish' | 'pending'| 'future' | 'private' | custom registered status ] // Set as Publish.
			'post_type'      		=> [ 'post' | 'page' | 'link' | 'nav_menu_item' | 'silk_products' ] // Set as silk_products - custom posts.
			'post_parent'    		=> [ <post ID> ] // Can be used for product items
			'menu_order'     		=> [ <order> ] // Might be able to use this to sort products based on category structure
			'post_excerpt'   		=> [ <string> ] // Product excerpt or short description
			'post_category'  		=> [ array(<category id>, ...) ] // Can be used to sort products into correct categories. Must work out category ID first. Not needed yet.
			'tags_input'     		=> [ '<tag>, <tag>, ...' | array ] // Not used, default. May be needed??..
		);

	*/
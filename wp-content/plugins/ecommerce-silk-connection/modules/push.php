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
	private $current_images;

	public function __construct() {
		ini_set ( 'max_execution_time', 60 * 5);

		//Used to compare products
		$this->previous_products = get_option('esc_current_products', array());
		$this->previous_categories = get_option('esc_current_categories', array());
		$this->current_images = get_option('esc_current_images', array());
		$this->connections_options = get_option('esc_connections_options');

		add_action('the_post', array($this, 'init'));
	}

	public function init() {
		$this->getAllCountries();
		$this->getAllPricelists();
		$this->getAllMeasurementCharts();
		$this->getAllPaymentMethods();
		$this->getAllCategories();
		$this->getAllProducts();
	}

	public function getAllCountries() {
		$esc_init = EscConnect::init('countries');
		$countries = $esc_init->get();
		//Save to option
		update_option('esc_shipping_countries', json_encode($countries));
	}

	public function getAllPricelists() {
		$esc_init = EscConnect::init('pricelists');
		$pricelists = $esc_init->get();
		//Save to option
		update_option('esc_pricelists', json_encode($pricelists));
	}

	public function getAllMeasurementCharts() {
		$esc_init = EscConnect::init('measurement-charts');
		$charts = $esc_init->get();
		//Save to option
		update_option('esc_measurement_charts', json_encode($charts));
	}

	public function getAllPaymentMethods() {
		$esc_init = EscConnect::init('payment-methods');
		$methods = $esc_init->get();
		//Save to option
		update_option('esc_payment_methods', json_encode($methods));
	}

	public function getAllCategories() {
		$category_request = EscConnect::init('categories');
		$categories = $category_request->get();

		//Recurse through the categories saving them
		$this->_saveCategories($categories);
		$this->_deleteCategories();

		if(isset($this->connections_options['esc_demo_on'])) {
			echo '<h3>Category Data:</h3>';
			pr($categories);
		}

		update_option('esc_current_categories', $this->current_categories);
	}

	private function _saveCategories($categories, $id = 0, $taxonomy = 'silk_category') {
		$i = 0;

		foreach ($categories as $category) {
			$i++;

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

			update_option('category_order_' . $category['uri'], $category['products']);

			//Remove from array in prepartion for deletion.
			if(isset($this->previous_categories[intval($category['category'])])) {
				unset($this->previous_categories[intval($category['category'])]);
				echo 'Updated category: ' . $category['name'] . ' ' . PHP_EOL . '<br />';
			} else {
				echo 'Removing category: ' . $category['name'] . ' ' . PHP_EOL . '<br />';
			}

			if(isset($category['categories'])) {
				$this->_saveCategories($category['categories'], intval($category_id));
			}
		}
	}

	private function _deleteCategories() {
		if(count($this->previous_categories) > 0) {

			if(isset($this->connections_options['esc_demo_on'])) {
				echo "<h3>Deleting Following Categories:</h3>";
				pr($this->previous_categories);
			}

			foreach ($this->previous_categories as $category_id) {
				wp_delete_term($category_id, 'silk_category');
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
		$all_sizes = array();
		$all_colors = array();
		$patch_product = false;

		$i = 1;
		// Improves image uploading concurrency if two pushes are activve at once
		shuffle($products);
		foreach ($products as $product) {

			//Create category array for silk-product
			$product_categories = array();
			foreach ($product['categories'] as $category_key => $category_arr) {
				if (isset($this->current_categories[$category_key])) {
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

			$args = array('name' => $product['uri'], 'post_type' => 'silk_products', 'post_status' => 'any', 'posts_per_page' => 1);
			$posts = get_posts($args);

			if ($posts) {
				$post_id = $posts[0]->ID;
				$post_array['ID'] = $post_id;
				wp_update_post($post_array);
				wp_set_object_terms($post_id, $product_categories, $taxonomy);

				echo 'Updated product: ' . $product['name'] . ' ' . PHP_EOL . '<br />';
			} else {
				$post_id = wp_insert_post($post_array);
				wp_set_object_terms($post_id, $product_categories, $taxonomy);

				echo 'Inserted product: ' . $product['name'] . ' ' . PHP_EOL . '<br />';
			}

			$this->current_products[$product['uri']] = $post_id;

			$local_array = array('127.0.0.1', '80.240.143.180');
			if(!in_array($_SERVER['SERVER_ADDR'], $local_array)) {
				//Avoid doing this locally as it updates images on AWS.
				$this->_saveImages($post_id, $product);
			}

			//Remove from array in prepartion for deletion.
			if (isset($this->previous_products[$product['uri']])) unset($this->previous_products[$product['uri']]);

			update_post_meta($post_id, 'product_data', $product);
			update_post_meta($post_id, 'product_order', $i);
			update_post_meta($post_id, 'product_id', $product['product']);
			update_post_meta($post_id, 'canonical_category', $product['categories'][$product['canonicalCategory']]['uri']);
			update_post_meta($post_id, 'social_image', @$product['social_image']['url']);
			update_post_meta($post_id, 'product_type', @$product['type']);

			if( isset($product['type']) && $product['type'] == 'is_patch' ) {
				$patch_product = $post_id;
			}

			foreach ($product['items'] as $size) {
				$size = (object)$size;
				$size_name = strtolower(str_replace(' ', '', $size->name));
				foreach ($size->stockByMarket as $market => $stock) {
					update_post_meta($post_id, 'in_stock_' . $market . '_' . $size_name, $stock ? 1 : 0);
				}
				if (!in_array($size->name, $all_sizes))
					$all_sizes[] = $size->name;
			}

			if (isset($product['swatch']) && isset($product['swatch']['desc'])) {
				$color = $product['swatch']['desc'];
				update_post_meta($post_id, 'product_color', $color);
				if (!in_array($color, $all_colors))
					$all_colors[] = $color;
			}

			$i++;
		}
		if( $patch_product ) {
			update_option('patch_product_id', $patch_product);
		}
		update_option('product_sizes', $all_sizes);
		update_option('product_colors', $all_colors);
	}

	private static $not_found = 0;
	private static $found = 0;

	private function _saveImages($post_id, $product) {
		//pr($product);

		$attachment_ids = array();
		foreach ($product['media'] as $media_item) {

			$url = $media_item['sources']['original']['url'];
			//Check if image has already been uploaded
			//Also makes sure image hasn't just been uploaded by an concurrent script
			if( !isset($this->current_images[$url])
				&& $this->_reloadCurrentImages()
				&& !isset($this->current_images[$url]) ) {
				self::$not_found++;
				echo 'Image not found ' . self::$not_found . ' : ' . $url . ' ' . PHP_EOL . '<br />';
				ob_flush();
				//Save image to WP
				$attachment_id = $this->createAttachmentFromUrl( $url, $post_id );
				if ( $attachment_id ) {
					$attachment_ids[] = $attachment_id;
					// Reload current images so that it supports two scripts are running concurrently
					// So if a concurrent push-script has just saved an image, that change isn't overwritten
					$this->_reloadCurrentImages();
					$this->current_images[$url] = $attachment_id;
					// Update option so if script crashes (because of timeout), the progress is saved
					$this->_updateCurrentImages();

				} else {
					//Error
				}
			} else {
				self::$found++;
				echo 'Image found ' . self::$found . ' : ' . $url . ' ' . PHP_EOL . '<br />';
				$attachment_ids[] = $this->current_images[$url];
			}
		}
		update_post_meta($post_id, 'attachment_ids', $attachment_ids);
	}

	private function createAttachmentFromUrl( $url, $post_id ) {
		echo 'Uploading image: ' . $url . ' ' . PHP_EOL . '<br />';
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
				delete_post_meta($post_id, 'product_data');
			}
		}
	}

	private function _reloadCurrentImages() {
		wp_cache_delete('esc_current_images', 'options');
		$this->current_images = get_option('esc_current_images', array());
		return true;
	}
	private function _updateCurrentImages() {
		update_option('esc_current_images', $this->current_images);
		return true;
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
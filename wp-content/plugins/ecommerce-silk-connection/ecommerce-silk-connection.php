<?php
/**
 *
 * @author    Richard Herries
 * @link      http://coalescecreate.com
 * @copyright 2015 Richard Herries
 *
 * Plugin Name: Ecommerce Silk Connection
 * Plugin URI: http://youngskilled.com
 * Description: Connection to Silk's API. Revised version of Y/S plugin.
 * Author: Richard Herries
 * Author URI: http://coalescecreate.com
 * Version: 0.2
 * Requires PHP version: >= 5.3 (anonymous functions for simpler templating)
*/

class Esc {

	static public $version = '0.2';
	static public $required_wp_version = '3.6';

	function __construct() {
		include_once($this::directory() . '/helpers/common.php');

		//Create ajax specific handler.
		add_action( 'wp_ajax_esc_selection_upd', 'esc_selection_upd' );
		add_action( 'wp_ajax_nopriv_esc_selection_upd', 'esc_selection_upd' );

		//Initate custom types and taxonimies
		add_action( 'init', array($this, 'register'));

		register_activation_hook(__FILE__, array('Esc', 'activate') );
		register_deactivation_hook(__FILE__, array('Esc', 'deactivate') );

		//Enable better pretty permalinks
		add_filter('post_type_link', array($this, 'setPermalinks'), 10, 2);
		add_filter('rewrite_rules_array', array($this, 'shopRewrites'));

		$this->routing();
	}

	static public function directory() {
		return untrailingslashit(dirname(__FILE__));
	}

	static public function baseName() {
		return plugin_basename(__FILE__);
	}

	static public function pluginUrl() {
		return untrailingslashit(plugins_url( '', __FILE__ ));
	}

	static public function activate() {
		flush_rewrite_rules();
	}

	static public function deactivate() {
		flush_rewrite_rules();
	}

	public function register() {

		$labels = array(
			'name'                       => _x('Products', 'Taxonomy General Name', 'esc'),
			'singular_name'              => _x('Product', 'Taxonomy Singular Name', 'esc'),
			'menu_name'                  => __('Silk Products', 'esc'),
			'all_items'                  => __('All Products', 'esc'),
			'parent_item'                => __('Product Group', 'esc'),
			'parent_item_colon'          => __('Product Group:', 'esc'),
			'new_item_name'              => __('New Product', 'esc'),
			'add_new_item'               => __('Add Product', 'esc'),
			'edit_item'                  => __('Edit Product', 'esc'),
			'update_item'                => __('Update Product', 'esc'),
			'separate_items_with_commas' => __('Separate products with commas', 'esc'),
			'search_items'               => __('Search Products', 'esc'),
			'add_or_remove_items'        => __('Add or remove products', 'esc'),
			'choose_from_most_used'      => __('Choose from the most used products', 'esc'),
			'not_found'                  => __('Not Found', 'esc'),
		);

		$args = array(
			'labels'                     => $labels,
			'description'                => 'Products generated from Silk, Any changes to following products made in Wordpress will be written over.',
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'                    => array('slug' => 'product/%silk_category%', 'with_front' => true, 'hierarchical' => false),
			'menu_icon'                  => 'dashicons-products',
			'capability_type'            => 'post',
			'menu_position'              => null,
			'supports'                   => array('title','editor','thumbnail','excerpt')
		);

		register_post_type('silk_products', $args);

		$tax_labels = array(
			'name'                       => 'Product Categories',
			'singular_name'              => 'Product Category',
			'search_items'               => 'Search Product Categories',
			'popular_items'              => 'Popular Product Categories',
			'all_items'                  => 'All Product Categories',
			'parent_item'                => 'Parent Product Category',
			'edit_item'                  => 'Edit Product Category',
			'update_item'                => 'Update Product Category',
			'add_new_item'               => 'Add New Product Category',
			'new_item_name'              => 'New Product Category',
			'separate_items_with_commas' => 'Separate product categories with commas',
			'add_or_remove_items'        => 'Add or remove product categories',
			'choose_from_most_used'      => 'Choose from most used product categories'
			);

		$tax_args = array(
			'label'                      => 'Product Categories',
			'labels'                     => $tax_labels,
			'public'                     => true,
			'hierarchical'               => true,
			'show_ui'                    => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'args'                       => array('orderby' => 'term_order'),
			'rewrite'                    => array('slug' => 'shop', 'with_front' => true, 'hierarchical' => true, 'ep_mask' => 'EP_ALL_ARCHIVES'),
			'query_var'                  => true
		);

		register_taxonomy('silk_category', 'silk_products', $tax_args);
		register_sidebar(array("name" => "Silk Product Page", "id" => "silk-product-page", "description" => "Content to be displayed at the bottom of a product page."));
	}

	public function setPermalinks($post_link, $id = 0, $leavename = FALSE) {
		//If no rewrite link found leave as is.
		if(strpos($post_link, '%silk_category%') === false) {
			//logIt('strpos not found');
			return $post_link;
		}
    
    $post = get_post($id);

    //If no post received and post is not of the custom type silk_products leave as is.
    if(!is_object($post) || $post->post_type !== 'silk_products') {
    	//logIt('no post');
    	return $post_link;
    }

    $terms = wp_get_object_terms($post->ID, 'silk_category');

    //If no terms connected to post then return without term
    if(!$terms) {
    	//logIt('no terms');
    	return str_replace('product/%silk_category%/', '', $post_link);
    }

    //Need to recurse for nested categories using parent in terms
    //Use canonical uri instead.
    $canonical = get_post_meta($post->ID, 'canonical_category');
    return str_replace('%silk_category%', $canonical[0], $post_link);
	}

	// Adding a new rule    
	public function shopRewrites($rules) {
		$newrules = array();

		//product structure refers to end rule being product
		//shop structure refers to end rule being a category
		//Difficult to say to wordpress that it's either a category or product in final uri...
		//Seems like even woocommerce doesn't support it...

		//Categories
		$newrules['shop/([^/]+)/([^/]+)/([^/]+)/page/([0-9]{1,})/?$'] = 'index.php?silk_category=$matches[1]&silk_category=$matches[2]&silk_category=$matches[3]&paged=$matches[4]';
		$newrules['shop/([^/]+)/([^/]+)/page/([0-9]{1,})/?$'] = 'index.php?silk_category=$matches[1]&silk_category=$matches[2]&paged=$matches[3]';
		$newrules['shop/([^/]+)/page/([0-9]{1,})/?$'] = 'index.php?silk_category=$matches[1]&paged=$matches[2]';
		$newrules['shop/([^/]+)/([^/]+)/([^/]+)/?$'] = 'index.php?silk_category=$matches[1]&silk_category=$matches[2]&silk_category=$matches[3]';
		$newrules['shop/([^/]+)/([^/]+)/?$'] = 'index.php?silk_category=$matches[1]&silk_category=$matches[2]';
		$newrules['shop/([^/]+)/?$'] = 'index.php?silk_category=$matches[1]';

		//Products
		$newrules['product/([^/]+)/([^/]+)/([^/]+)/([^/]+)/?$'] = 'index.php?silk_category=$matches[1]&silk_category=$matches[2]&silk_category=$matches[3]&silk_products=$matches[4]';
		$newrules['product/([^/]+)/([^/]+)/([^/]+)/?$'] = 'index.php?silk_category=$matches[1]&silk_category=$matches[2]&silk_products=$matches[3]';
		$newrules['product/([^/]+)/([^/]+)/?$'] = 'index.php?silk_category=$matches[1]&silk_products=$matches[2]';
		$newrules['product/([^/]+)/?$'] = 'index.php?silk_products=$matches[1]';

		logIt($rules);
		return $newrules + $rules;
	}

	public function routing() {
		//If in Wordpress backend run admin otherwise prepare data for site.
		if(is_admin()) {
			include_once($this::directory() . '/admin/settings-page.php');
		} else {
			include_once($this::directory() . '/includes/controller.php');
		}
	}

	public static function getUserCountryCode() {
		//Set a default geo_location if non-existent
		//Check to see if we can set up a warning in WP if this is non-existent
		if(!isset($_SERVER['geo_location'])) {
			if ( defined('GEO_LOCATION' ) )
				$code = GEO_LOCATION;
			else
				$code = 'US';

		}
		else
			$code = $_SERVER['geo_location'];
		return $code;
	}

}

new Esc();

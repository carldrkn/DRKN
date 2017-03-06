<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 08/05/15
 * Time: 03:24
 */

define( 'INDEX_OBJECTS_MULTIPLE', 0 );
define( 'INDEX_OBJECTS_SINGLE', 1 );

define( 'INDEX_OBJECTS_NORMAL', 1 );
define( 'INDEX_OBJECTS_CI', 2 );

function index_objects( $objects, $key, $single = true, $flag = INDEX_OBJECTS_NORMAL ) {

	$index = array();

	foreach ( $objects as $object ) {
		$v = $object->$key;

		if ( $flag == INDEX_OBJECTS_CI )
			$v = mb_strtolower($v, 'UTF-8');

		if ( $single ) {
			$index[$v] = $object;
		}
		else {
			if ( !isset($index[$v]) )
				$index[$v] = array( $object );
			else
				$index[$v][] = $object;

		}
	}

	return $index;
}

function objects_values( $objects, $key, $unique = true ) {

	$values = array();

	foreach ( $objects as $o ) if ( isset($o->$key) ) {
		$v = $o->$key;
		if ( !$unique || !in_array($v, $values))
			$values[] = $v;
	}

	return $values;
}

/**
 * Add product page meta callback
 * 
 * @return void
 */
function addProductPageMetaCallback () {
	global $post;
	
    $productID = (int) get_post_meta( $post->ID, 'product', true );
	
	$products = get_posts( array(
		'numberposts' => -1,
		'post_type' => 'silk_products',
		'orderby' => 'title',
		'order' => 'ASC'
	) );

	$html = '<p><select name="product"><option value="0">-- Please select --</option>';

	foreach( $products as $product ) {
		$selected = '';
		
		if( $productID == $product->ID ) {
			$selected = 'selected="selected"';
		}
		
		$html .= '<option value="' . $product->ID . '" ' . $selected . '>' . $product->post_title . '</option>';
	}

	$html .= '</select></p>';

	echo $html;
}

/**
 * Add product page save
 * 
 * @return void
 */
function addProductPageMeteSave() {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	$id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];

	if( !isset( $id ) ) {
		return;
	}

	$template = get_post_meta( $id, '_wp_page_template', true );

	if( $template == 'add-product-page.php' ) {
		if( isset( $_POST['product'] ) ) {
			update_post_meta( $id, 'product', $_POST['product'] );
		}
	}
}

add_action( 'save_post', 'addProductPageMeteSave' );

/**
 * Add product meta box to Add Product Page template
 * 
 * @return void
 */
function addProductPageMeta() {
	$id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
	
	if( !isset( $id ) ) {
		return;
	}
	
	$template = get_post_meta( $id, '_wp_page_template', true );

	if( $template == 'add-product-page.php' ) {
		add_meta_box(
			'product-select',
			'Product',
			'addProductPageMetaCallback',
			'page',
			'normal',
			'high'
		);
	}
}

add_action( 'add_meta_boxes', 'addProductPageMeta' );

/**
 * AJAX call hook
 */
function addProductAJAX() {
	$jsURL = get_template_directory_uri() . '/assets/js/add-product.js';

	wp_enqueue_script( 'addProduct', $jsURL, array( 'jquery' ), '1.0', true );

	wp_localize_script( 'addProduct', 'addProduct', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_enqueue_scripts', 'addProductAJAX' );

/**
 * AJAX call process
 */
function addProductAJAXProcess() {
	$selection = $_REQUEST[ 'selection' ];
	
	ob_start();
	
	include( get_template_directory() . '/parts/add-product/header-selection.php' );
	
	$basket = ob_get_contents();
	
	ob_clean();
	
	$data = array(
		'success' => true,
		'totalItems' => $selection['totals']['totalQuantity'],
		'basket' => $basket
	);
	
	echo json_encode( $data );
	die;
}

add_action( 'wp_ajax_addProduct', 'addProductAJAXProcess' );
add_action( 'wp_ajax_nopriv_addProduct', 'addProductAJAXProcess' );


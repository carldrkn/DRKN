<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class FrontpageProduct extends CustomPostType {

	public $name = 'frontpage_products';
	public $slug = 'frontpage-products';
	public $singularName = 'Frontpage products';
	public $pluralName = 'Frontpage products';

	public $fields = array(
			'title' => array(

			),

			'product_1_title' => array(
					'type' => 'title',
					'title' => 'Title'
			),
			'product_1_image' => array(
					'title' => 'Image',
					'type' => 'responsive_image'
			),
			'product_1_product' => array(
					'type' => 'product',
					'title' => 'Product'
			),


			'product_2_title' => array(
					'type' => 'title',
					'title' => 'Title'
			),
			'product_2_image' => array(
					'title' => 'Image',
					'type' => 'responsive_image'
			),
			'product_2_product' => array(
					'type' => 'product',
					'title' => 'Product'
			),


			'product_3_title' => array(
					'type' => 'title',
					'title' => 'Title'
			),
			'product_3_image' => array(
					'title' => 'Image',
					'type' => 'responsive_image'
			),
			'product_3_product' => array(
					'type' => 'product',
					'title' => 'Product'
			),

			'product_4_title' => array(
					'type' => 'title',
					'title' => 'Title'
			),
			'product_4_image' => array(
					'title' => 'Image',
					'type' => 'responsive_image'
			),
			'product_4_product' => array(
					'type' => 'product',
					'title' => 'Product'
			),


	);

	public $boxes = array(
			array(
					'title' => 'Product 1',
					'fields' => array( 'product_1_image', 'product_1_title', 'product_1_product' )
			),
			array(
					'title' => 'Product 2',
					'fields' => array( 'product_2_image', 'product_2_title', 'product_2_product' )
			),
			array(
					'title' => 'Product 3',
					'fields' => array( 'product_3_image', 'product_3_title', 'product_3_product' )
			),
			array(
					'title' => 'Product 4',
					'fields' => array( 'product_4_image', 'product_4_title', 'product_4_product' )
			)
	);

	public $taxomonies = array(
		'product_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);

}

$frontpage_product = new FrontpageProduct();
$frontpage_product->setup();

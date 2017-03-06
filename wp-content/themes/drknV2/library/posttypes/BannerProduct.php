<?php

/**
 * Description of BannerProduct
 *
 * @package package
 * @version $id: BannerProduct.php $
 */
class BannerProduct extends CustomPostType {
	
	public $name = 'banner-product';
	public $slug = 'banner-product';
	public $singularName = 'Banner Product';
	public $pluralName = 'Banners Product';
	
	public $fields = array(
		'title' => array(

		),
		'bp_product' => array(
			'type' => 'product',
			'title' => 'Product'
		)
	);

	public $boxes = array(
		array(
			'title' => 'Product',
			'fields' => array(
				'bp_product'
			)
		)
	);
	
	public $taxomonies = array(
		'banner_product_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);
	
}

$bannerProduct = new BannerProduct();
$bannerProduct->setup();

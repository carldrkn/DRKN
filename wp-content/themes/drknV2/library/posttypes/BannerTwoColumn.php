<?php

/**
 * Description of BannerTwoColumn
 *
 * @package package
 * @version $id: BannerTwoColumn.php $
 */
class BannerTwoColumn extends CustomPostType {
	
	public $name = 'banner-two-column';
	public $slug = 'banner-two-column';
	public $singularName = 'Banner Two Column';
	public $pluralName = 'Banners Two Column';
	
	public $fields = array(
		'title' => array(

		),
		// First Column
		'btcf_type' => array(
			'title' => 'Type',
			'type' => 'options_radio',
			'options' => array( 'image' => 'Image', 'product' => 'Product' )
		),
		// Image
		'btcf_background' => array(
			'type' => 'responsive_image',
			'title' => 'Background'
		),
		'btcf_image' => array(
			'type' => 'responsive_image',
			'title' => 'Image'
		),
		'btcf_link' => array(
			'title' => 'Link',
			'type' => 'target'
		),
		// Product
		'btcf_product' => array(
			'type' => 'product',
			'title' => 'Product'
		),
		'btcf_show_in_mobile' => array(
			'title' => 'Show in Mobile',
			'type' => 'options_radio',
			'options' => array( 'yes' => 'Yes', 'no' => 'No' )
		),
		// Second Column
		'btcs_type' => array(
			'title' => 'Type',
			'type' => 'options_radio',
			'options' => array( 'image' => 'Image', 'product' => 'Product' )
		),
		// Image
		'btcs_background' => array(
			'type' => 'responsive_image',
			'title' => 'Background'
		),
		'btcs_image' => array(
			'type' => 'responsive_image',
			'title' => 'Image'
		),
		'btcs_link' => array(
			'title' => 'Link',
			'type' => 'target'
		),
		// Product
		'btcs_product' => array(
			'type' => 'product',
			'title' => 'Product'
		),
		'btcs_show_in_mobile' => array(
			'title' => 'Show in Mobile',
			'type' => 'options_radio',
			'options' => array( 'yes' => 'Yes', 'no' => 'No' )
		),
	);

	public $boxes = array(
		array(
			'title' => 'First Column',
			'fields' => array(
				'btcf_type',
				'btcf_background',
				'btcf_image',
				'btcf_link',
				'btcf_product',
				'btcf_show_in_mobile'
			)
		),
		array(
			'title' => 'Second Column',
			'fields' => array(
				'btcs_type',
				'btcs_background',
				'btcs_image',
				'btcs_link',
				'btcs_product',
				'btcs_show_in_mobile'
			)
		),
	);
	
	public $taxomonies = array(
		'banner_two_column_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);
	
}

$bannerTwoColumn = new BannerTwoColumn();
$bannerTwoColumn->setup();
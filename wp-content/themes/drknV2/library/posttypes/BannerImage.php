<?php

/**
 * Description of BannerImage
 *
 * @package package
 * @version $id: BannerImage.php $
 */
class BannerImage extends CustomPostType {
	
	public $name = 'banner-image';
	public $slug = 'banner-image';
	public $singularName = 'Banner Image';
	public $pluralName = 'Banners Image';
	
	public $fields = array(
		'title' => array(

		),
		'bi_text' => array(
			'type' => 'text',
			'title' => 'Text'
		),
		'bi_background' => array(
			'type' => 'responsive_image',
			'title' => 'Background'
		),
		'bi_image' => array(
			'type' => 'responsive_image',
			'title' => 'Image'
		),
		'bi_position' => array(
			'title' => 'Position',
			'type' => 'options_radio',
			'options' => array( 'left' => 'Left', 'right' => 'Right', 'center' => 'Center' )
		),
		'bi_link' => array(
			'title' => 'Link',
			'type' => 'target'
		)
	);

	public $boxes = array(
		array(
			'title' => 'Settings',
			'fields' => array(
				'bi_text',
				'bi_background',
				'bi_image',
				'bi_position',
				'bi_link'
			)
		)
	);
	
	public $taxomonies = array(
		'banner_image_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);
	
}

$bannerImage = new BannerImage();
$bannerImage->setup();

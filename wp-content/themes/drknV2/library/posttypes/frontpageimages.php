<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class FrontpageImage extends CustomPostType {

	public $name = 'frontpage_images';
	public $slug = 'frontpage-images';
	public $singularName = 'Frontpage images';
	public $pluralName = 'Frontpage images';

	public $fields = array(

		'title' => array(

		),

		'images' => array(
			'title' => 'Images (6 or 12)',
			'type' => 'responsive_images'
		)

	);

	public $boxes = array(
		array(
			'title' => 'Display',
			'fields' => array('images')
		)
	);

	public $taxomonies = array(
		'image_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);

}

$frontpage_images = new FrontpageImage();
$frontpage_images->setup();

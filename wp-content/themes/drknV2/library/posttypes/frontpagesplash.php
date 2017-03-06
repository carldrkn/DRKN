<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class FrontpageSplash extends CustomPostType {

	public $name = 'frontpage_splashes';
	public $slug = 'frontpage-splashes';
	public $singularName = 'Frontpage splashes';
	public $pluralName = 'Frontpage splashes';

	public $fields = array(
		'title' => array(

		),
		'splash_1_title' => array(
			'type' => 'title',
			'title' => 'Title'
		),
		'splash_1_button_title' => array(
			'type' => 'title',
			'title' => 'Button text'
		),
		'splash_1_image' => array(
			'title' => 'Image',
			'type' => 'responsive_image'
		),
		'splash_1_target' => array(
			'type' => 'target',
			'title' => 'Target'
		),
		'splash_1_hover_image' => array(
			'title' => 'Hover Image',
			'type' => 'responsive_image'
		),

		'splash_2_title' => array(
			'type' => 'title',
			'title' => 'Title'
		),
		'splash_2_button_title' => array(
			'type' => 'title',
			'title' => 'Button text'
		),
		'splash_2_image' => array(
			'title' => 'Image',
			'type' => 'responsive_image'
		),
		'splash_2_target' => array(
			'type' => 'target',
			'title' => 'Target'
		),
		'splash_2_hover_image' => array(
			'title' => 'Hover Image',
			'type' => 'responsive_image'
		),

		'splash_3_title' => array(
			'type' => 'title',
			'title' => 'Title'
		),
		'splash_3_button_title' => array(
			'type' => 'title',
			'title' => 'Button text'
		),
		'splash_3_image' => array(
			'title' => 'Image',
			'type' => 'responsive_image'
		),
		'splash_3_target' => array(
			'type' => 'target',
			'title' => 'Target'
		),
		'splash_3_hover_image' => array(
			'title' => 'Hover Image',
			'type' => 'responsive_image'
		),


	);

	public $boxes = array(
		array(
			'title' => 'Splash 1 - Small (square)',
			'fields' => array( 'splash_1_image', 'splash_1_hover_image', 'splash_1_title', 'splash_1_button_title', 'splash_1_target' )
		),
		array(
			'title' => 'Splash 2 - Small (square)',
			'fields' => array( 'splash_2_image','splash_2_hover_image', 'splash_2_title', 'splash_2_button_title', 'splash_2_target' )
		),
		array(
			'title' => 'Splash 3 - Small (square)',
			'fields' => array( 'splash_3_image', 'splash_3_hover_image', 'splash_3_title', 'splash_3_button_title', 'splash_3_target' )
		)
	);
	
	public $taxomonies = array(
		'splash_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);

}

$frontpage_slash = new FrontpageSplash();
$frontpage_slash->setup();

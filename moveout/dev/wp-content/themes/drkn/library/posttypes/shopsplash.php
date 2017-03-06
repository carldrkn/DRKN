<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class ShopSplash extends CustomPostType {

	public $name = 'shop_landing';
	public $slug = 'shop-landing';
	public $singularName = 'Shop landing';
	public $pluralName = 'Shop landings';

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

		'splash_4_title' => array(
			'type' => 'title',
			'title' => 'Title'
		),
		'splash_4_button_title' => array(
			'type' => 'title',
			'title' => 'Button text'
		),
		'splash_4_image' => array(
			'title' => 'Image',
			'type' => 'responsive_image'
		),
		'splash_4_target' => array(
			'type' => 'target',
			'title' => 'Target'
		),

	);

	public $boxes = array(
		array(
			'title' => 'Splash 1 - Large',
			'fields' => array( 'splash_1_image', 'splash_1_title', 'splash_1_button_title', 'splash_1_target' )
		),
		array(
			'title' => 'Splash 2 - Small (square)',
			'fields' => array( 'splash_2_image', 'splash_2_title', 'splash_2_button_title', 'splash_2_target' )
		),
		array(
			'title' => 'Splash 3 - Small (square)',
			'fields' => array( 'splash_3_image', 'splash_3_title', 'splash_3_button_title', 'splash_3_target' )
		),
		array(
			'title' => 'Splash 4 - Large',
			'fields' => array( 'splash_4_image', 'splash_4_title', 'splash_4_button_title', 'splash_4_target' )
		),
	);

}

new ShopSplash();
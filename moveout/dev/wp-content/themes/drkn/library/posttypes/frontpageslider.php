<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class FrontpageSlider extends CustomPostType {

	public $name = 'frontpage_slider';
	public $slug = 'frontpage-slider';
	public $singularName = 'Frontpage slider';
	public $pluralName = 'Frontpage sliders';

	public $fields = array(
		'title' => array(

		),

		'slider_title' => array(
			'type' => 'title',
			'title' => 'Title'
		),
		'slider_button_title' => array(
			'type' => 'title',
			'title' => 'Button text'
		),
		'slider_images' => array(
			'title' => 'Images',
			'type' => 'responsive_images'
		),

	);

	public $boxes = array(
		array(
			'title' => 'Slideshow',
			'fields' => array( 'slider_title', 'slider_button_title', 'slider_images')
		)
	);

}

new FrontpageSlider();
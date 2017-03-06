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
		'slider_type' => array(
			'title' => 'Type',
			'type' => 'options_radio',
			'options' => array( 'slideshow' => 'Slideshow', 'video' => 'Video' )
		),
		// slideshow
		'slider_title' => array(
			'type' => 'title',
			'title' => 'Title'
		),
		'slider_target' => array(
			'type' => 'target',
			'title' => 'Target'
		),
		'slider_button_title' => array(
			'type' => 'title',
			'title' => 'Button text'
		),
		'slider_images' => array(
			'title' => 'Images',
			'type' => 'responsive_images'
		),
		// video
		'slider_video_url' => array(
			'title' => 'URL',
			'type' => 'title',
		),
		'slider_video_image' => array(
			'title' => 'Fallback Image',
			'type' => 'responsive_image',
		),
		'slider_video_loop' => array(
			'title' => 'Loop',
			'type' => 'options_radio',
			'options' => array( 'yes' => 'Yes', 'no' => 'No' )
		),
		'slider_video_autoplay' => array(
			'title' => 'Autoplay',
			'type' => 'options_radio',
			'options' => array( 'yes' => 'Yes', 'no' => 'No' )
		),
		'slider_video_sound' => array(
			'title' => 'Sound',
			'type' => 'options_radio',
			'options' => array( 'yes' => 'Yes', 'no' => 'No' )
		)
	);

	public $boxes = array(
		array(
			'title' => 'Setting',
			'fields' => array( 'slider_type' )
		),
		array(
			'title' => 'Slideshow',
			'fields' => array( 'slider_title', 'slider_button_title', 'slider_target', 'slider_images' )
		),
		array(
			'title' => 'Video',
			'fields' => array( 'slider_video_url', 'slider_video_image', 'slider_video_loop', 'slider_video_autoplay', 'slider_video_sound' )
		)
	);
	
	public $taxomonies = array(
		'slider_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);

}

$frontpage_slider = new FrontpageSlider();
$frontpage_slider->setup();
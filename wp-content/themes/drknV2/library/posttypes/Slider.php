<?php

/**
 * Description of Slider
 *
 * @package package
 * @version $id: Slider.php $
 */
class Slider extends CustomPostType {
	
	public $name = 'slider';
	public $slug = 'slider';
	public $singularName = 'Slider';
	public $pluralName = 'Sliders';
	
	public $fields = array(
		'title' => array(

		),
		'slider_type' => array(
			'title' => 'Type',
			'type' => 'options_radio',
			'options' => array( 'slideshow' => 'Slideshow', 'video' => 'Video' )
		),
		// slideshow
		'slider_title_1' => array(
			'type' => 'text',
			'title' => 'Title 1'
		),
		'slider_image_1' => array(
			'type' => 'responsive_image',
			'title' => 'Image 1'
		),
		'slider_link_1' => array(
			'type' => 'target',
			'title' => 'Link 1'
		),
		'slider_title_2' => array(
			'type' => 'text',
			'title' => 'Title 2'
		),
		'slider_image_2' => array(
			'type' => 'responsive_image',
			'title' => 'Image 2'
		),
		'slider_link_2' => array(
			'type' => 'target',
			'title' => 'Link 2'
		),
		'slider_title_3' => array(
			'type' => 'text',
			'title' => 'Title 3'
		),
		'slider_image_3' => array(
			'type' => 'responsive_image',
			'title' => 'Image 3'
		),
		'slider_link_3' => array(
			'type' => 'target',
			'title' => 'Link 3'
		),
		'slider_mobile_fallback' => array(
			'title' => 'Mobile Fallback Image',
			'type' => 'responsive_image'
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
			'fields' => array(
				'slider_title_1',
				'slider_image_1',
				'slider_link_1',
				'slider_title_2',
				'slider_image_2',
				'slider_link_2',
				'slider_title_3',
				'slider_image_3',
				'slider_link_3',
				'slider_mobile_fallback'
			)
		),
		array(
			'title' => 'Video',
			'fields' => array(
				'slider_video_url',
				'slider_video_image',
				'slider_video_loop',
				'slider_video_autoplay',
				'slider_video_sound'
			)
		)
	);
	
	public $taxomonies = array(
		'slider_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);
	
}

$slider = new Slider();
$slider->setup();

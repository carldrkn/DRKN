<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class Banner extends CustomPostType {

	public $name = 'banner';
	public $slug = 'banner';
	public $singularName = 'Banner';
	public $pluralName = 'Banners';

	public $fields = array(
		'title' => array(

		),
		
		'banner_title' => array(
			'type' => 'title',
			'title' => 'Title'
		),
		'banner_button_title' => array(
			'type' => 'title',
			'title' => 'Button text'
		),
		'banner_image' => array(
			'title' => 'Image',
			'type' => 'responsive_image'
		),
		'banner_target' => array(
			'title' => 'Target',
			'type' => 'target'
		),


	);

	public $boxes = array(
		array(
			'title' => 'Banner',
			'fields' => array( 'banner_image', 'banner_title', 'banner_button_title', 'banner_target' )
		)
	);

	public $taxomonies = array(
		'displayed_in' => array(
			'title' => 'Displayed in'
		)
	);

}

new Banner();
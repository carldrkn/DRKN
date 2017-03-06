<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class Activist extends CustomPostType {

	public $name = 'activist';
	public $slug = 'activist';
	public $singularName = 'Activist';
	public $pluralName = 'Activists';

	public $fields = array(

		'title' => array(

		),
		'body' => array(

		),
		'activist_image' => array(
			'title' => 'Image',
			'type' => 'responsive_image'
		),
		'activist_position' => array(
			'title' => 'Position',
			'type' => 'options_radio',
			'options' => array( 'left' => 'Left', 'right' => 'Right' )
		),
		'activist_target' => array(
			'title' => 'Target',
			'type' => 'target'
		),
		'activist_subtitle' => array(
			'type' => 'title',
			'title' => 'Subtitle'
		),

	);

	public $boxes = array(
		array(
			'title' => 'Image',
			'fields' => array( 'activist_subtitle', 'activist_image', 'activist_position', 'activist_target' )
		)
	);


}

$activist = new Activist();
$activist->setup();
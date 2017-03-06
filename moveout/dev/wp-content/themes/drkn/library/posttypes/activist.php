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
		)

	);

	public $boxes = array(
		array(
			'title' => 'Image',
			'fields' => array( 'activist_image' )
		)
	);


}

new Activist();
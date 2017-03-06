<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class InstagramPost extends CustomPostType {

	public $name = 'instagram_post';
	public $slug = 'instagram-post';
	public $singularName = 'Instagram post';
	public $pluralName = 'Instagram posts';

	public $fields = array(
		'title' => array(

		),
		'post_image' => array(
			'title' => 'Image',
			'type' => 'responsive_image'
		),
		'post_url' => array(
			'type' => 'title',
			'title' => 'Url'
		)
	);

	public $boxes = array(
		array(
			'title' => 'Instagram post',
			'fields' => array( 'post_image', 'post_url' )
		),

	);

}

new InstagramPost();
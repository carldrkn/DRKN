<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class StudioPost extends CustomPostType
{

	public $name = 'studio_post';
	public $slug = 'studio';
	public $singularName = 'Studio post';
	public $pluralName = 'Studio posts';

	public $hasArchive = 'studio';

	public $postsPerPage = 50;

	protected $settingsPage = false;

	public $fields = array(
			'title' => array(),
			'post_image' => array(
					'title' => 'Image',
					'type' => 'responsive_image'
			),
			'post_text' => array(
					'title' => 'Text',
					'type' => 'text'
			),
			'post_url' => array(
					'type' => 'title',
					'title' => 'Url'
			)
	);

	public $boxes = array(
			array(
					'title' => 'Studio post',
					'fields' => array('post_image', 'post_text', 'post_url')
			),

	);
}

$studio = new StudioPost();

$studio->setup();
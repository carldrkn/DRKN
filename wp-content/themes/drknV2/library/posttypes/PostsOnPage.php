<?php

/**
 * Description of PostsOnPage
 *
 * @package package
 * @version $id: PostsOnPage.php $
 */
class PostsOnPage extends CustomPostType {
	
	public $name = 'posts_on_page';
	public $slug = 'posts_on_page';
	public $singularName = 'Post on Page';
	public $pluralName = 'Posts on Page';

	public $fields = array(
		'title' => array(),
		'posts_on_page_image' => array(
			'title' => 'Image',
			'type' => 'responsive_image'
		),
		'posts_on_page_subtitle' => array(
			'type' => 'title',
			'title' => 'Subtitle'
		),
		'posts_on_page_target' => array(
			'title' => 'Target',
			'type' => 'target'
		),
	);

	public $boxes = array(
		array(
			'title' => 'Post on Page',
			'fields' => array( 'posts_on_page_image', 'posts_on_page_subtitle', 'posts_on_page_target' )
		)
	);

	public $taxomonies = array(
		'posts_on_page_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);
	
}

$postsOnPage = new PostsOnPage();

$postsOnPage->setup();

<?php

/**
 * Description of FrontPageText
 *
 * @package package
 * @version $id: FrontPageText.php $
 */
class FrontPageText extends CustomPostType {
	
	public $name = 'front_page_text';
	public $slug = 'front_page_text';
	public $singularName = 'Frontpage Text';
	public $pluralName = 'Frontpage Texts';

	public $fields = array(
		'title' => array(),
		'text_content' => array(
			'title' => 'Content',
			'type' => 'editor'
		)
	);
	
	public $boxes = array(
		array(
			'title' => 'Settings',
			'fields' => array( 'text_content' )
		)
	);
	
	public $taxomonies = array(
		'text_displayed_in' => array(
			'title' => 'Displayed in'
		)
	);
	
}


$frontPageText = new FrontPageText();

$frontPageText->setup();
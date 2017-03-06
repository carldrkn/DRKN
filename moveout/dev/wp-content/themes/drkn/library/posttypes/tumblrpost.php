<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class TumblrPost extends CustomPostType {

	public $name = 'tumblr_post';
	public $slug = 'tumblr-post';
	public $singularName = 'Tumblr post';
	public $pluralName = 'Tumblr posts';

	public $fields = array(
		'title' => array(

		),
		'tumblr_id' => array(
			'type' => 'title'
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
			'title' => 'Tumblr post',
			'fields' => array( 'post_image', 'post_url' )
		),

	);

	public function loadAllPosts() {
		$tumblr = new WpTumblr();
		$response = $tumblr->getPosts('wearedrkn', array(
			'limit' => 100,
			'offset' => 60,
			'type' => 'photo'
		));


		foreach ( $response->posts as $post ) {

			if ( count($this->getPosts(array(
				'meta_query' => array(
					array(
						'key' => 'tumblr_id',
						'value' => $post->id
					)
				)
			))) ) continue;

			$data = array(
				'tumblr_id' => $post->id,
				'post_url' => $post->post_url,
				//'title' => strip_tags($post->caption),
				'post_image' => $this->createAttachment( $post->photos[0]->original_size->url )
			);

			$post_id = wp_insert_post(
				array(
					'comment_status'	=>	'closed',
					'ping_status'		=>	'closed',
					'post_name'		=>		$post->slug,
					'post_title'		=>	strip_tags($post->caption),
					'post_status'		=>	'publish',
					'post_type'		=>	'tumblr-post'
				)
			);

			foreach ( $data as $k => $v )
				update_post_meta( $post_id, $k, $v );



		}
	}

	public function createAttachment( $url ) {
		$filename = pathinfo( $url, PATHINFO_BASENAME );

		$upload_file = wp_upload_bits($filename, null, file_get_contents($url));

		if (!$upload_file['error']) {
			$wp_filetype = wp_check_filetype($filename, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
				'post_content' => '',
				'post_status' => 'inherit'
			);

			$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'] );
			if (!is_wp_error($attachment_id)) {
				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
				wp_update_attachment_metadata( $attachment_id,  $attachment_data );
			}
			return $attachment_id;
		}
		else
			return false;
	}

}

$tumblr = new TumblrPost();


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

	protected $orderBy = '!instagram_created_time';

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
		),
		'instagram_created_time' => array(
			'type' => 'title'
		),
		'instagram_id' => array(
			'type' => 'title'
		)
	);

	public $boxes = array(
		array(
			'title' => 'Instagram post',
			'fields' => array( 'post_image', 'post_url' )
		),

	);

	public function setup() {
		//$this->loadLatestPosts( true );
		//die('setup insta');
		$this->setupAutoFetching();
		parent::setup();
	}

	public function loadLatestPosts( $output = false ) {
		$instagram = new WpInstagram();

		$response = $instagram->getUserMedia();

		$response = $instagram->getTagMedia('wearegamers',10);

		foreach ( $response->data as $instagram_data ) {
			$this->createPostFromInstagramData( $instagram_data, $output  );
		}

		/**
		 * Remove duplicates
		 */
		$posts = get_posts(array(
			'post_type' => $this->name,
			'numberposts' => -1
		));
		$instagram_ids = array();
		foreach ( $posts as $post ) {
			$instagram_id = get_post_meta( $post->ID, 'instagram_id', true );
			if ( !$instagram_id || in_array($instagram_id, $instagram_ids) )
				wp_delete_post( $post->ID, 1 );
			else
				$instagram_ids[] = $instagram_id;
		}

	}

	public function createPostFromInstagramData( $instagram_data, $output = false ) {

		if ( $output === true )
			echo '<br/>Instagram post ' . $instagram_data->id;

		if ( count($this->getPosts(array(
			'meta_query' => array(
				array(
					'key' => 'instagram_id',
					'value' => $instagram_data->id
				)
			)
		))) ) {
			echo ' already exists, continuing.';
			return;
		}

		$data = array(
			'instagram_id' => $instagram_data->id,
			'post_url' => $instagram_data->link,
			'instagram_created_time' => $instagram_data->created_time,
			//'title' => strip_tags($post->caption),
			'post_image' => $this->createAttachment( $instagram_data->images->standard_resolution->url )
		);

		$post_id = wp_insert_post(
			array(
				'comment_status'	=>	'closed',
				'ping_status'		=>	'closed',
				//'post_name'		=>		$instagram_data->slug,
				'post_title'		=>	strip_tags($instagram_data->caption->text),
				'post_status'		=>	'publish',
				'post_type'		=>	$this->name
			)
		);

		if ( $output )
			echo ' created post ' . $post_id ;

		foreach ( $data as $k => $v )
			update_post_meta( $post_id, $k, $v );

	}

	public function createAttachment( $url ) {
		$filename = pathinfo( $url, PATHINFO_BASENAME );
		$filename = parse_url($filename, PHP_URL_PATH);

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

	public function setupAutoFetching() {

		add_action( 'wp', array($this, 'setupSchedule') );
		add_action( 'wp_instagram_load_posts', array( $this, 'loadLatestPosts' ) );

	}

	public function setupSchedule() {
		if ( ! wp_next_scheduled( 'wp_instagram_load_posts' ) ) {
			wp_schedule_event(time(), 'hourly', 'wp_instagram_load_posts');
		}
	}

}

$instagram_post = new InstagramPost();

$instagram_post->setup();
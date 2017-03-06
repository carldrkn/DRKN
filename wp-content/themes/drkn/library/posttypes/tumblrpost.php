<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 04/05/15
 * Time: 13:09
 */

class TumblrPost extends CustomPostType {

	public $name = 'tumblr_post';
	public $slug = 'culture';
	public $singularName = 'Tumblr post';
	public $pluralName = 'Tumblr posts';

	public $hasArchive = 'culture';

	public $postsPerPage = 50;

	protected $orderBy = '!tumblr_id';

	protected $settingsPage = true;

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
			'title' => 'Tumblr post',
			'fields' => array( 'post_image', 'post_text', 'post_url' )
		),

	);

	public function setup() {
		parent::setup();
		$this->setupAutoFetching();
	}

	public function loadLatestPosts( $output = false ) {

		$tumblr = new WpTumblr();
		$response = $tumblr->getPosts('wearedrkn', array(
			'limit' => 20,
			'offset' => 0,
			//'type' => 'photo'
		));

		foreach ( $response->posts as $tumblr_data  ) {
			$this->createPostFromTumblrData( $tumblr_data, $output );
		}
	}

	public function loadAllPosts( $output = false ) {

		set_time_limit( 300 );

		$tumblr = new WpTumblr();
		$response = $tumblr->getBlog('wearedrkn');;
		$blog = $response->blog;
		$response = null;
		$i = 0;
		while ( $i < $blog->posts && ( !$response || count($response->posts) ) ) {
			$response = $tumblr->getPosts('wearedrkn', array(
				'limit' => 20,
				'offset' => $i * 20,
				//'type' => 'photo'
			));
			foreach ( $response->posts as $tumblr_data  ) {
				$this->createPostFromTumblrData( $tumblr_data, $output );
			}
			$i++;
		}

		/**
		 * Remove duplicates
		 */
		$posts = get_posts(array(
			'post_type' => $this->name,
			'numberposts' => -1
		));
		$tumblr_ids = array();
		foreach ( $posts as $post ) {
			$tumblr_id = get_post_meta( $post->ID, 'tumblr_id', true );
			if ( !$tumblr_id || in_array($tumblr_id, $tumblr_ids) )
				wp_delete_post( $post->ID, 1 );
			else
				$tumblr_ids[] = $tumblr_id;
		}

	}

	public function createPostFromTumblrData( $tumblr_data, $output = false ) {

		if ( $output === true )
			echo '<br/>Tumblr post ' . $tumblr_data->id;

		if ( count($this->getPosts(array(
			'meta_query' => array(
				array(
					'key' => 'tumblr_id',
					'value' => $tumblr_data->id
				)
			)
		))) ) {
			if ( $output ) echo ' already exists, continuing.';
			return;
		}

		if ( $tumblr_data->type !== 'photo' ) {
			if ( $output ) echo ' is not a photo, continuing.';
			return;
		}

		$data = array(
			'tumblr_id' => $tumblr_data->id,
			'post_url' => $tumblr_data->post_url,
			//'title' => strip_tags($post->caption),
			'post_image' => $this->createAttachment( $tumblr_data->photos[0]->original_size->url )
		);

		$post_id = wp_insert_post(
			array(
				'comment_status'	=>	'closed',
				'ping_status'		=>	'closed',
				'post_name'		=>		$tumblr_data->slug,
				'post_title'		=>	strip_tags($tumblr_data->caption),
				'post_status'		=>	'publish',
				'post_type'		=>	$this->name
			)
		);

		if ( $output ) echo ' created post ' . $post_id ;

		foreach ( $data as $k => $v )
			update_post_meta( $post_id, $k, $v );

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

	public function setupAutoFetching() {

		add_action( 'wp', array($this, 'setupSchedule') );
		add_action( 'wp_tumblr_load_posts', array( $this, 'loadLatestPosts' ) );

	}

	public function setupSchedule() {
		if ( ! wp_next_scheduled( 'wp_tumblr_load_posts' ) ) {
			wp_schedule_event(time(), 'hourly', 'wp_tumblr_load_posts');
		}
	}

	public function settingsPage() {
		?>
		<div class="output-messages">
		<?php
		if ( isset($_POST['load_all_posts']) && $_POST['load_all_posts'] ) {
			$this->loadAllPosts( true );
		}
		if ( isset($_POST['load_latest_posts']) && $_POST['load_latest_posts'] ) {
			$this->loadLatestPosts( true );
		}
		?>
		</div>
		<form action="" method="post">
			<br/>
			<h2>Load latest posts</h2>
			<input type="hidden" name="load_latest_posts" value="1"/>
			<input class="button" type="submit" value="Load"/>
		</form>
		<form action="" method="post">
			<br/>
			<h2>Load all posts</h2>
			<input type="hidden" name="load_all_posts" value="1"/>
			<input class="button" type="submit" value="Load"/>
		</form>
		<?php
	}

}

$tumblr = new TumblrPost();

$tumblr->setup();
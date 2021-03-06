<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 05/05/15
 * Time: 18:19
 */

include 'vendor/autoload.php';

class WpTumblr {
	public function __construt() {


	}
	public function getPosts( $name, $args ) {
		$consumer =  get_option('tumblr_consumer_key');
		$secret =  get_option('tumblr_secret_key');

		$tumblr = new Tumblr\API\Client($consumer, $secret);

		return $tumblr->getBlogPosts( $name, $args );
	}
}

// create custom plugin settings menu
add_action('admin_menu', 'wp_tumblr_create_menu');

function wp_tumblr_create_menu() {

	//create new top-level menu
	add_menu_page('Tumblr Plugin Settings', 'Tumblr Settings', 'administrator', __FILE__, 'wp_tumblr_settings_page');

	//call register settings function
	add_action( 'admin_init', 'tumblr_register' );
}


function tumblr_register() {
	//register our settings
	register_setting( 'wp_tumblr-settings-group', 'tumblr_consumer_key' );
	register_setting( 'wp_tumblr-settings-group', 'tumblr_secret_key' );
	register_setting( 'wp_tumblr-settings-group', 'option_etc' );
}

function wp_tumblr_settings_page() {

	$consumer =  get_option('tumblr_consumer_key');
	$secret =  get_option('tumblr_secret_key');
	$client = new Tumblr\API\Client($consumer, $secret);


	$tumblr = new TumblrPost();

	$tumblr->loadAllPosts();

	?>
	<div class="wrap">
		<h2>Tumblr settings</h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'wp_tumblr-settings-group' ); ?>
			<?php do_settings_sections( 'wp_tumblr-settings-group' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Tumblr Consumer Key</th>
					<td><input type="text" name="tumblr_consumer_key" value="<?php echo esc_attr( get_option('tumblr_consumer_key') ); ?>" /></td>
				</tr>

				<tr valign="top">
					<th scope="row">Tumbler Secret Key</th>
					<td><input type="text" name="tumblr_secret_key" value="<?php echo esc_attr( get_option('tumblr_secret_key') ); ?>" /></td>
				</tr>

			</table>

			<?php submit_button(); ?>

		</form>
	</div>
<?php } ?>
<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 05/05/15
 * Time: 18:19
 */

include 'Instagram-PHP-API/Instagram.php';
include 'Instagram-PHP-API/InstagramException.php';

use MetzWeb\Instagram\Instagram;

class WpInstagram extends Instagram {

	public function __construct() {

		$callback_url = preg_replace('/&code=.+/', '', wp_instagram_full_url());
		$callback_url = explode('?', $callback_url);
		$callback_url[1] = str_replace('/', '%2F', $callback_url[1]);
		$callback_url = implode('?', $callback_url);

		$instagram = parent::__construct(array(
			'apiKey'      => get_option('instagram_app_key'),
			'apiSecret'      => get_option('instagram_app_secret'),
			'apiCallback' => ($callback_url),
		));

		$data = get_option('instagram_auth');

		if ( $data && isset($data->user) )
			$this->setAccessToken($data);



	}

	public function getInstance() {

		return $this;

	}

	public function outputLink( $authed ) {
		$instagram = $this->getInstance();
		$str = !$authed ? 'Login with Instagram' : 'Login with different Instagram-account';
		echo "<a href='{$instagram->getLoginUrl()}'>$str</a>";
	}

	public function testToken() {
		$auth_data = get_option('instagram_auth');
		$user = $auth_data && isset($auth_data->user) ? $auth_data->user : null;
		if ( $auth_data && isset($auth_data->user) ) {
			$response = $wpinstagram->getUserFeed( $auth_data->user->id );
			if ( isset($response->error) )
				$user = null;
		}
		return $user ? true : false;
	}
}

// create custom plugin settings menu
add_action('admin_menu', 'wp_instagram_create_menu');

function wp_instagram_create_menu() {

	//create new top-level menu
	add_menu_page('Instagram Plugin Settings', 'Instagram Settings', 'administrator', __FILE__, 'wp_instagram_settings_page');

	//call register settings function
	add_action( 'admin_init', 'wp_instagram_register_settings' );
}


function wp_instagram_register_settings() {
	//register our settings
	register_setting( 'wp_instagram-settings-group', 'instagram_app_key' );
	register_setting( 'wp_instagram-settings-group', 'instagram_app_secret' );
}

function wp_instagram_url_origin($s, $use_forwarded_host=false)
{
	$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
	$sp = strtolower($s['SERVER_PROTOCOL']);
	$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
	$port = $s['SERVER_PORT'];
	$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
	$host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
	$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
	return $protocol . '://' . $host;
}

function wp_instagram_full_url($use_forwarded_host=false)
{
	return wp_instagram_url_origin($_SERVER, $use_forwarded_host) . $_SERVER['REQUEST_URI'];
}

function wp_instagram_settings_page() {
	?>
	<div class="wrap">
		<h2>Instagram app settings</h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'wp_instagram-settings-group' ); ?>
			<?php do_settings_sections( 'wp_instagram-settings-group' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">App key</th>
					<td><input type="text" name="instagram_app_key" value="<?php echo esc_attr( get_option('instagram_app_key') ); ?>" /></td>
				</tr>

				<tr valign="top">
					<th scope="row">App secret</th>
					<td><input type="text" name="instagram_app_secret" value="<?php echo esc_attr( get_option('instagram_app_secret') ); ?>" /></td>
				</tr>

			</table>

			<?php submit_button(); ?>

		</form>

	</div>
	<?php
	$wpinstagram = new WpInstagram();

	$error_msg = null;
	// Get access token from oauth redirect code
	if ( isset($_GET['code']) ) {
		$code = $_GET['code'];
		$instagram = new WpInstagram();
		$data = $instagram->getOAuthToken($code );

		if ( !isset($data->error_message) ) {
			update_option('instagram_auth', $data);
			$instagram->setAccessToken($data);
		}
		else {
			$error_msg = 'Auth error';
		}

	}

	// Test existing token
	$auth_data = get_option('instagram_auth');
	$user = $auth_data && isset($auth_data->user) ? $auth_data->user : null;
	if ( $auth_data && isset($auth_data->user) ) {
		$response = $wpinstagram->getUserFeed( $auth_data->user->id );
		if ( isset($response->error) )
			$user = null;
	}

	?>
	<div class="wrap">
		<h2>Instagram user authentication</h2>
		<br/>
		<?php if ( $error_msg ) echo $error_msg . '<br/>'; ?>
		<?php if ( $user ): ?>
			User <?php echo $user->username ?> authed. <br/> <br/>
		<?php endif; ?>
		<?php echo $wpinstagram->outputLink( $user ? true : false ); ?>
	</div>
	<?php

}
?>
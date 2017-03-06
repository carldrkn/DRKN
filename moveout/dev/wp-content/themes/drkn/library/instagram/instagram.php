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

class WpInstagram {
	public function __construt() {

		$instagram = new Instagram(array(
			'apiKey'      => 'YOUR_APP_KEY',
			'apiSecret'   => 'YOUR_APP_SECRET',
			'apiCallback' => 'YOUR_APP_CALLBACK'
		));

		echo "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";
	}
}

// create custom plugin settings menu
add_action('admin_menu', 'wp_instagram_create_menu');

function wp_instagram_create_menu() {

	//create new top-level menu
	add_menu_page('Instagram Plugin Settings', 'Instagram Settings', 'administrator', __FILE__, 'wp_instagram_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'wp_instagram-settings-group', 'new_option_name' );
	register_setting( 'wp_instagram-settings-group', 'some_other_option' );
	register_setting( 'wp_instagram-settings-group', 'option_etc' );
}

function wp_instagram_settings_page() {
	?>
	<div class="wrap">
		<h2>Instagram settings</h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'wp_instagram-settings-group' ); ?>
			<?php do_settings_sections( 'wp_instagram-settings-group' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">New Option Name</th>
					<td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
				</tr>

				<tr valign="top">
					<th scope="row">Some Other Option</th>
					<td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
				</tr>

				<tr valign="top">
					<th scope="row">Options, Etc.</th>
					<td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
				</tr>
			</table>

			<?php submit_button(); ?>

		</form>
	</div>
<?php } ?>
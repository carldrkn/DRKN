<?php

/*
	Create a list of available shortcodes for the plugin.
*/

class DrknSettingsPage {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $drkn_theme_options;

	/**
	 * Start up
	 */
	public function __construct() {
		add_action( 'admin_menu', array($this, 'add_menu_page' ) );
		add_action( 'admin_init', array($this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_menu_page() {
		// This page will be under "Settings"
		add_menu_page(
			'Drkn Theme Options', 
			'Drkn Theme', 
			'manage_options', 
			'drkn-theme-options', 
			array($this, 'create_admin_page'),
			'dashicons-admin-generic',
			'25.000266' //random number to decide order.
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {
		// Set class property
		$this->drkn_theme_options = get_option( 'drkn_theme_options' );

?>
		<div class="wrap">
			<h2>Drkn Theme Settings</h2>
			<div class="welcome-panel">
				<div class="welcome-panel-content">
					<h3>Theme Settings</h3>
					<p>General theme settings for setting across the site. Turn on/off instagram, decide how many images to show on the start page etc.</p>
				</div>
			</div>
			<div class="escShopSettings">
				<ul id="js-media" class="u-cleanList metabox-holder">
					<li class="escShopSettings-column postbox-container">
						<div class="postbox">
							<form method="post" action="options.php">

<?php
								// This prints out all hidden setting fields
								settings_fields( 'drkn_theme_group' );   
								do_settings_sections( 'drkn-theme-setting' );
								submit_button(); 
?>
							</form>
						</div>
					</li>
				</ul>
			</div>
		</div>

<?php

	}

	/**
	 * Register and add settings
	 */
	public function page_init() {

		register_setting(
			'drkn_theme_group', // Option group
			'drkn_theme_options'
		);

		add_settings_section(
			'drkn_theme_settings',
			'Drkn Theme Settings',
			array($this, 'drkn_theme_section_info'),
			'drkn-theme-setting'
		);

		add_settings_field(
			'drkn_theme_instagram_boolean',
			'Show instagram images on start page?',
			array($this, 'output_field'),
			'drkn-theme-setting', 
			'drkn_theme_settings',
			array('value' => 'drkn_theme_instagram_boolean', 'type' => 'checkbox')
		);

		add_settings_field(
			'drkn_theme_products_on_start',
			'How many products to show on start page? (Default: 6)',
			array($this, 'output_field'),
			'drkn-theme-setting', 
			'drkn_theme_settings',
			array('value' => 'drkn_theme_products_on_start', 'type' => 'input')
		);

		add_settings_field(
			'drkn_theme_products_on_category',
			'How many products to show on category pages? (Default: 12)',
			array($this, 'output_field'),
			'drkn-theme-setting',
			'drkn_theme_settings',
			array('value' => 'drkn_theme_products_on_category', 'type' => 'input')
		);

	}

	/** 
	 * Print the Section text
	 */
	public function drkn_theme_section_info() {
		echo 'Enter your settings below:';
	}

	private function select_page_options($selected) {
		$args = array(
			'sort_order' => 'ASC',
			'sort_column' => 'post_title',
			'post_type' => 'page',
			'post_status' => 'publish,private,draft'
		); 
		$pages = get_pages($args);
		$str = '';

		foreach ($pages as $page) {
			$is_selected = $selected == $page->ID ? ' selected="selected"' : '';
		 	$str .= '<option value="' . $page->ID . '"' . $is_selected . '>' . $page->post_title . '</option>';
		}

		return $str;
	}

	public function output_field($settings) {
		$type = isset($settings['type']) ? $settings['type'] : 'input';
		$options = $this->drkn_theme_options;

		switch ($type) {
			case 'input':
				$value = (isset($options[$settings['value']] ) ? esc_attr($options[$settings['value']]) : '');
				echo '<input type="text" id="' . $settings['value'] . '" name="drkn_theme_options[' . $settings['value'] . ']" value="' . $value . '" />';
				break;
			case 'checkbox':
				$value = (isset($options[$settings['value']]) && $options[$settings['value']] == 1 ? 'checked="checked" ' : '');
				echo '<input type="checkbox" id="' . $settings['value'] . '" value="1" name="drkn_theme_options[' . $settings['value'] . ']" ' . $value . '/>';
				break;
			case 'pages':
				$value = (isset($options[$settings['value']]) ? $options[$settings['value']] : '');
				echo '<select id="' . $settings['value'] . '" name="drkn_theme_options[' . $settings['value'] . ']"><option>Choose Page</option>' . $this->select_page_options($value) . '</select>';
				break;
		}
	}

}

if( is_admin() )
	$drkn_settings_page = new DrknSettingsPage();

<?php

/*
	Create a list of available shortcodes for the plugin.
*/

class EscSettingsPage {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $connections_options;
	private $architecture_options;

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
			'Silk Store Options', 
			'Silk', 
			'manage_options', 
			Esc::baseName(), 
			array($this, 'create_admin_page'),
			'dashicons-cart', 
			'25.000234' //random number to decide order.
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {
		// Set class property
		$this->connections_options = get_option( 'esc_connections_options' );
		$this->architecture_options = get_option( 'esc_architecture_options' );
?>
		<div class="wrap">
			<h2>Silk Connection Settings</h2>
			<div class="welcome-panel">
				<div class="welcome-panel-content">
					<h3>Shop Settings</h3>
					<p>Edit how Wordpress connects with Silk. Which pages are displaying what type of content and general shop setup.</p>
				</div>
			</div>
			<div class="escShopSettings">
				<ul id="js-media" class="u-cleanList metabox-holder">
					<li class="escShopSettings-column postbox-container">
						<div class="postbox">
							<form method="post" action="options.php">

<?php
								// This prints out all hidden setting fields
								settings_fields( 'esc_connection_group' );   
								do_settings_sections( 'esc-connection-setting' );
								submit_button(); 
?>
							</form>
						</div>
					</li><li class="escShopSettings-column postbox-container">
						<div class="postbox">
							<form method="post" action="options.php">

<?php

								// This prints out all hidden setting fields
								settings_fields( 'esc_architecture_settings' );   
								do_settings_sections( 'esc-architecture-setting' );
								//New group to handle when the website is shut.
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

		wp_enqueue_style( 'esc_screen', Esc::pluginUrl() .'/admin/css/esc_main.css', Esc::$version);

		register_setting(
			'esc_connection_group', // Option group
			'esc_connections_options'
		);

		register_setting(
			'esc_architecture_settings', // Option group
			'esc_architecture_options'
		);

		//Connections to Silk
		add_settings_section(
			'esc_connection_settings',
			'Connection Settings to Silk',
			array($this, 'connection_section_info'),
			'esc-connection-setting'
		);  
		add_settings_field(
			'esc_silk_url',
			'Shop API URL',
			array($this, 'output_field'),
			'esc-connection-setting',
			'esc_connection_settings',
			array('value' => 'esc_silk_url', 'group' => 'connections')
		);
		add_settings_field(
			'esc_authorization_code', 
			'Shop API Authorization Code', 
			array($this, 'output_field'), 
			'esc-connection-setting', 
			'esc_connection_settings',
			array('value' => 'esc_authorization_code', 'group' => 'connections')
		);
		add_settings_field(
			'esc_demo_on', 
			'See json received (dev only)', 
			array($this, 'output_field'), 
			'esc-connection-setting', 
			'esc_connection_settings',
			array('value' => 'esc_demo_on', 'type' => 'checkbox', 'group' => 'connections')
		);

		//Silk Architecture settings
		add_settings_section(
			'esc_architecture_settings',
			'Shop Architecture Definition',
			array($this, 'architecture_section_info'),
			'esc-architecture-setting'
		);
		add_settings_field(
			'esc_push_page', 
			'Silk push page',
			array($this, 'output_field'),
			'esc-architecture-setting', 
			'esc_architecture_settings',
			array('value' => 'esc_push_page', 'type' => 'pages', 'group' => 'architecture')
		);
		add_settings_field(
			'esc_selection_page', 
			'Selection page',
			array($this, 'output_field'),
			'esc-architecture-setting', 
			'esc_architecture_settings',
			array('value' => 'esc_selection_page', 'type' => 'pages', 'group' => 'architecture')
		);
		add_settings_field(
			'esc_success_page', 
			'Success page (Receipt)',
			array($this, 'output_field'),
			'esc-architecture-setting', 
			'esc_architecture_settings',
			array('value' => 'esc_success_page', 'type' => 'pages', 'group' => 'architecture')
		);
		add_settings_field(
			'esc_fail_page', 
			'Fail page (Transaction aborted)',
			array($this, 'output_field'),
			'esc-architecture-setting', 
			'esc_architecture_settings',
			array('value' => 'esc_fail_page', 'type' => 'pages', 'group' => 'architecture')
		);
		add_settings_field(
			'esc_preview_page', 
			'Preview Page for when shop is closed',
			array($this, 'output_field'),
			'esc-architecture-setting', 
			'esc_architecture_settings',
			array('value' => 'esc_preview_page', 'type' => 'pages', 'group' => 'architecture')
		);
		add_settings_field(
			'esc_close_on', 
			'Close webshop? (?preview0202 is needed to see shop)',
			array($this, 'output_field'),
			'esc-architecture-setting', 
			'esc_architecture_settings',
			array('value' => 'esc_close_on', 'type' => 'checkbox', 'group' => 'architecture')
		);
	}

	/** 
	 * Print the Section text
	 */
	public function connection_section_info() {
		echo 'Enter your settings below: All information in the following section can be gathered from your silk admins store page.';
	}

	public function architecture_section_info() {
		echo 'Define architecture that the Silk shop will depend upon. Choose the pages that correspond to each of the functions';
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
		$group = isset($settings['group']) ? $settings['group'] : 'connections';
		$options = $group === 'architecture' ? $this->architecture_options : $this->connections_options;

		switch ($type) {
			case 'input':
				$value = (isset($options[$settings['value']] ) ? esc_attr($options[$settings['value']]) : '');
				echo '<input type="text" id="' . $settings['value'] . '" name="esc_' . $group . '_options[' . $settings['value'] . ']" value="' . $value . '" />';
				break;
			case 'checkbox':
				$value = (isset($options[$settings['value']]) && $options[$settings['value']] == 1 ? 'checked="checked" ' : '');
				echo '<input type="checkbox" id="' . $settings['value'] . '" value="1" name="esc_' . $group . '_options[' . $settings['value'] . ']" ' . $value . '/>';
				break;
			case 'pages':
				$value = (isset($options[$settings['value']]) ? $options[$settings['value']] : '');
				echo '<select id="' . $settings['value'] . '" name="esc_' . $group . '_options[' . $settings['value'] . ']"><option>Choose Page</option>' . $this->select_page_options($value) . '</select>';
				break;
		}
	}

}

if( is_admin() )
	$esc_settings_page = new EscSettingsPage();

<?php
/**
 *
 * @package   DRKN - Frontpage Splash
 * @author    Sanna Frese
 * @link      http://sannafre.se
 * @copyright 2015 Sanna Frese
 *
 * Plugin Name: DRKN - Frontpage Splash
 * Plugin URI: http://drkn.com
 * Description: Custom post type for frontpage splashes.
 * Version: 0.2
 * Author: Sanna Frese
 * Author URI: http://sannafre.se
 */

namespace DRKN\Plugin\FrontpageSplash;

class FrontpageSplash {
    const VERSION = '0.1';

    protected $pluginSlug = 'frontpage-splash';
    protected static $instance = null;

    protected $postName = 'Frontpage Splash';
    protected $postType = 'frontpage-splash';

    protected $pluginBase;
    protected $pluginRelBase;

    private function __construct() {
        $this->pluginBase = rtrim(dirname(__FILE__), '/');
        $this->pluginRelBase = dirname(plugin_basename(__FILE__));

        register_activation_hook(__FILE__, array(&$this, 'activationHook'));
        register_deactivation_hook(__FILE__, array(&$this, 'deactivationHook'));
        register_uninstall_hook(__FILE__, array(get_class(), 'uninstallHook'));

        add_action('init', array($this, 'initHook'));
        add_action('add_meta_boxes', array($this, 'createCmb'));
        add_action('save_post', array($this, 'saveForm'));
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /*------------------------------------------------------------------------*
     * Hooks
     *------------------------------------------------------------------------*/

    public function activationHook($networkWide) {
    }

    public function deactivationHook($networkWide) {
    }

    public static function uninstallHook($networkWide) {
        if (! defined('WP_UNINSTALL_PLUGIN')) {
            die();
        }
    }

    public function initHook() {
        $this->registerCpt();
        add_theme_support('post-thumbnails');
    }

    /*------------------------------------------------------------------------*
     * Public
     *------------------------------------------------------------------------*/

    public function createCmb() {
        add_meta_box(
            'target',
            __( 'Splash target', 'frontpage-splash' ),
            array($this, 'targetMetaBox'),
            'frontpage-splash', 'normal'
        );

		add_meta_box(
            'order',
            __( 'Manual ordering', 'frontpage-splash' ),
            array($this, 'orderMetaBox'),
            'frontpage-splash', 'side'
        );
    }

    public function targetMetaBox($object, $box) {

        wp_nonce_field( basename( __FILE__ ), 'target_nonce' );

        $target = get_post_meta($object->ID, 'target', true);
		
		if(isset($target['id'])) {
			$page_id = $target['id'];
		} else {
			$page_id = null;
		}

        if(isset($target['url'])) {
            $url = $target['url'];
        } else {
            $url = "";
        } ?>

        <p>
        <label for="target_url">URL: </label>
        <input class="widefat" type="text" name="target_url" id="target_url" value="<?php echo $url; ?>" size="30" />
        </p>
        <p>
        <label for="target_url">Post or page: </label>
        <select name="page_id" id="page_id">
        <?php
            $argsPosts = array(
                'numberposts' => -1,
            );

            $argsPages = array(
            );

            $posts = get_posts($argsPosts);
            $pages = get_pages($argsPages);

            $posts = array_merge($posts, $pages);

            foreach( $posts as $post ) : setup_postdata($post);

        ?>
            <option value="<?php echo $post->ID; ?>" <?php if ( $post->ID = 'page_id' ) echo 'selected="SELECTED"' ?>><?php echo $post->post_title; ?></option>

        <?php endforeach; ?>
        </select>

        </p>
        <p class="howto">Selecting a post or page will override URL-input</p>

    <?php }

    public function orderMetaBox($object, $box) {

        wp_nonce_field( basename( __FILE__ ), 'order_nonce' ); ?>

        <p>
        <input type="text" name="order" id="order" value="<?php echo esc_attr( get_post_meta( $object->ID, 'order', true ) ); ?>" size="4" />
        </p>

    <?php }

	public function saveForm( $post_id ) {

		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( !isset( $_POST['target_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( !wp_verify_nonce( $_POST['target_nonce'], basename( __FILE__ ) ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( !current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. */

		// Make sure that it is set.
		if ( isset( $_POST['order'] ) ) {
			// Sanitize user input.
			$value = sanitize_text_field( $_POST['order'] );

			// Update the meta field in the database.
			update_post_meta( $post_id, 'order', $value );
		}


		if ( isset($_POST['target_url']) && isset($_POST['page_id']) ) {

			$value = array(
				'url' => sanitize_text_field( $_POST['target_url'] ),
				'id' => sanitize_text_field( $_POST['page_id'] )
			);
			update_post_meta( $post_id, 'target', $value );

		}
	}


    /*------------------------------------------------------------------------*
     * Private
     *------------------------------------------------------------------------*/

    private function registerCpt() {
       $labels = array(
            'name' => __($this->postName.'es', $this->pluginSlug),
            'singular_name' => __($this->postName, $this->pluginSlug),
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'taxonomies' => array(),
            'menu_position' => null,
            'supports' => array('title', 'editor', 'thumbnail')
        );

        register_post_type($this->postType, $args);
    }

    private function renderTemplate($name, $vars=array()) {
        foreach ($vars as $key => $val) {
            $$key = $val;
        }

        $path = $this->pluginBase.'/templates/'.$name.'.php';
        if (file_exists($path)) {
            include($path);
        } else {
            echo '<p>Rendering of template failed</p>';
        }
    }
}

FrontpageSplash::getInstance();

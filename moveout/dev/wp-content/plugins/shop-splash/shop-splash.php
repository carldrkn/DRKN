<?php
/**
 *
 * @package   DRKN - Shop Splash
 * @author    Sanna Frese
 * @link      http://sannafre.se
 * @copyright 2015 Sanna Frese
 *
 * Plugin Name: DRKN - Shop Splash
 * Plugin URI: http://drkn.com
 * Description: Custom post type for shop landing page splashes.
 * Version: 0.2
 * Author: Sanna Frese
 * Author URI: http://sannafre.se
 */

namespace DRKN\Plugin\ShopSplash;

class ShopSplash {
    const VERSION = '0.1';

    protected $pluginSlug = 'shop-splash';
    protected static $instance = null;

    protected $postName = 'Shop Splash';
    protected $postType = 'shop-splash';

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
            __( 'Splash target', 'shop-splash' ),
            array($this, 'targetMetaBox'),
            'shop-splash', 'normal'
        );

        add_meta_box(
            'order',
            __( 'Manual ordering', 'shop-splash' ),
            array($this, 'orderMetaBox'),
            'shop-splash', 'side'
        );
    }

     public function targetMetaBox($object, $box) {

        wp_nonce_field( basename( __FILE__ ), 'target_nonce' );

        $target = get_post_meta($object->ID, 'target', true);

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
            <option value="<?php echo $post->ID; ?>"><?php echo $post->post_title; ?></option>

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

ShopSplash::getInstance();

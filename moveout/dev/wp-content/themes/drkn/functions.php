<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	//remove_filter( 'the_content', 'wpautop' );

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'library/starkers-utilities.php' );
	//require_once( 'library/instagram/instagram.php' );
	require_once( 'library/tumblr/tumblr.php' );
	require_once( 'library/functions.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */


	add_theme_support('post-thumbnails');
	require_once 'library/drkn.php';

	foreach ( Drkn::$imageSizes as $size )
		add_image_size( 'drkn_' . $size, $size );

	// register_nav_menus(array('primary' => 'Primary Navigation'));

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );
	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );
	add_filter( 'show_admin_bar', '__return_false');

	// Adds menus
	function drkn_register_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header menu' ),
				'footer-menu' => __( 'Footer Menu' ),
				'pages-menu' => __( 'Pages Menu' )
			)
		);
	}
	add_action( 'init', 'drkn_register_menus' );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */

	require_once 'library/customposttype.php';
	require_once 'library/posttypes/shopsplash.php';
	require_once 'library/posttypes/banner.php';
	require_once 'library/posttypes/frontpageslider.php';
	require_once 'library/posttypes/frontpagesplash.php';
	require_once 'library/posttypes/instagrampost.php';
	require_once 'library/posttypes/activist.php';
	require_once 'library/posttypes/tumblrpost.php';

	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {

		/**
		 *  Vendor scripts
		 */

		wp_register_script( 'underscore', get_template_directory_uri().'/assets/js/vendor/underscore.js', array() );
		wp_enqueue_script( 'underscore' );

		wp_register_script( 'backbone', get_template_directory_uri().'/assets/js/vendor/backbone.js', array() );
		wp_enqueue_script( 'backbone' );

		wp_register_script( 'backbone', get_template_directory_uri().'/assets/js/vendor/backbone.js', array() );
		wp_enqueue_script( 'backbone' );

		wp_register_script( 'imagesloaded', get_template_directory_uri().'/assets/js/vendor/imagesloaded.js', array() );
		wp_enqueue_script( 'imagesloaded' );
		
		wp_register_script( 'webfont', get_template_directory_uri().'/assets/js/vendor/webfont.js', array() );
		wp_enqueue_script( 'webfont' );

		wp_register_script( 'modernizr', get_template_directory_uri().'/assets/js/vendor/modernizr-custom.min.js', array() );
		wp_enqueue_script( 'modernizr' );

		wp_register_script( 'masonry', get_template_directory_uri().'/assets/js/vendor/masonry.js', array() );
		wp_enqueue_script( 'masonry' );

		/**
		 * Theme scripts
		 */

		wp_register_script( 'global', get_template_directory_uri().'/assets/js/global.js', array( 'jquery' ) );
		wp_enqueue_script( 'global' );

		wp_register_script( 'responsiveimage', get_template_directory_uri().'/assets/js/responsiveimage.js', array( 'jquery', 'underscore'  ) );
		wp_enqueue_script( 'responsiveimage' );

		wp_register_script( 'slider', get_template_directory_uri().'/assets/js/slider.js', array( 'jquery', 'underscore', 'backbone' ) );
		wp_enqueue_script( 'slider' );

		wp_register_script( 'newsletter-dialog', get_template_directory_uri().'/assets/js/newsletter-dialog.js', array( 'jquery', 'underscore', 'backbone' ) );
		wp_enqueue_script( 'newsletter-dialog' );

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
		wp_enqueue_style( 'screen' );
	}	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}
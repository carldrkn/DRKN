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
add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );

function submenu_limit( $items, $args ) {

	if ( empty($args->menu_item_start) )
		return $items;

	$parent_ids = wp_filter_object_list( $items, array( 'menu_item_parent' => 0 ), 'and', 'ID' );

	if( !empty( $parent_ids ) ){

		$menu_item_end = ( isset( $args->menu_item_end ) ) ? (int) $args->menu_item_end : count( $parent_ids );
		$total = ($menu_item_end) - ((int) $args->menu_item_start);
		$range_parent_ids = array_slice( (array) $parent_ids, ($args->menu_item_start)-1, $total+1, true );

		if( !empty( $range_parent_ids ) ) {
			$return_items = array();
			foreach ( $range_parent_ids as $parent_id ) {

				$return_items[] = $parent_id;
				$children = submenu_get_children_ids( $parent_id, $items );

				if( !empty($children) ) {
					$return_items = array_merge( $return_items, $children );
				}

			}

			foreach( $items as $key => $item ){
				if( !in_array( $item->ID, $return_items ) ){
					unset( $items[$key] );
				}
			}

		} else {
			return false;
		}
	}

	return $items;
}

function submenu_get_children_ids( $id, $items ) {

	$ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );
	foreach ( $ids as $id ) {
		$ids = array_merge( $ids, submenu_get_children_ids( $id, $items ) );
	}

	return $ids;
}



	function delete_duplicate_product_images() {
		echo '<pre>';
		set_time_limit(1200);

		$products = get_posts(array(
			'post_type' => 'silk_products',
			'numberposts' => -1
		));

		$x = 0;
		foreach ( $products as $product ) {

			$attachments_ids = get_post_meta( $product->ID, 'attachment_ids', true );

			$all_product_attachments = get_posts(array(
				'post_type' => 'attachment',
				'numberposts' => -1,
				'post_parent' => $product->ID
			));

			$keep = array();
			$delete = array();

			foreach ( $all_product_attachments as $attachment ) {
				if ( !in_array($attachment->ID, $attachments_ids) )
					$delete[] = $attachment;
				else
					$keep[] = $attachment;
			}

			echo 'PRODUCT ' . $product->post_title . ':' . PHP_EOL;

			echo 'Keep: ' . count($keep) . ' ' . json_encode(objects_values($keep, 'ID')) . PHP_EOL;
			echo 'Delete: ' . count($delete) . ' ' . json_encode(objects_values($delete, 'ID')) . PHP_EOL;

			//continue;
/*
			foreach ( $delete as $attachment )
				wp_delete_attachment($attachment->ID);
			foreach ( $keep as $image ) {

				$id = $image->ID;
				$fullsizepath = get_attached_file( $id );

				$upload_dir = wp_upload_dir();
				$upload_dir = $upload_dir['path'] . '/';
				$tmp_path = $upload_dir . pathinfo($fullsizepath, PATHINFO_BASENAME );
				file_put_contents($tmp_path, file_get_contents($fullsizepath));

				echo '--';
				echo $fullsizepath . PHP_EOL;
				echo $tmp_path . PHP_EOL;
				if ( file_exists($tmp_path) ) {
					wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $tmp_path) );
					echo 'Generated';
				}

				unlink($tmp_path);

			}
*/
		}
		echo '</pre>';
	}


	function drkn_pre_get_posts( $query ) {

		if ( is_admin() || ! $query->is_main_query() || !$query->is_archive )
			return;

		if ( isset($query->query_vars['silk_category']) ) {

			$drkn_options = get_option('drkn_theme_options');
			$display_num_products = isset($drkn_options['drkn_theme_products_on_category']) && $drkn_options['drkn_theme_products_on_category'] !== '' ? intval($drkn_options['drkn_theme_products_on_category']) : 12;

			$product_size = isset($_POST['product_size']) ?
				$_SESSION['product_size'] = $_POST['product_size']
				:
				( isset($_SESSION['product_size'])
				? $_SESSION['product_size'] : null );

			$meta_query = array();
			if ( $product_size && $product_size !== '*' ) {
				$market = $_SESSION['esc_store']['market'];
				$key = 'in_stock_' . $market . '_' . $product_size;
				$meta_query[] = array(
					array(
					  'key' => $key,
					  'value' => 1,
					)
			  );
			}

			$product_color = isset($_POST['product_color']) ?
				$_SESSION['product_color'] = $_POST['product_color']
				:
				( isset($_SESSION['product_color'])
				? $_SESSION['product_color'] : null );

			if ( $product_color && $product_color !== '*' ) {
				$meta_query[] = array(
					array(
					  'key' => 'product_color',
					  'value' => $product_color,
					)
			  );
			}

			$query->set('posts_per_page', $display_num_products);
			$query->query_vars['meta_query'] = $meta_query;
			return;
		}

	}
	add_action( 'pre_get_posts', 'drkn_pre_get_posts', 1 );

	/**
	 *  Set meta_key attachment_hide to true for auto-created attachments
	 */


	function drkn_uploads_hide( $query = array() ) {
		add_filter( 'pre_get_posts', 'drkn_uploads_hide_2');
		/*if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/upload.php' ) !== false ) {
			$wp_query->set('meta_key', 'hide_attachment');
			$wp_query->set('meta_value', 1);
		}*/
		//$query['meta_key'] = 'attachment_hide';
		//$query['meta_value'] = 1;
		/*$query['meta_query'] = array(
			array(
				'key' => 'attachment_hide',
				'compare' => 'NOT EXISTS' // this should work...
			)
		);*/
		return $query;
	}

	function drkn_uploads_hide_2( $query ) {
		$query->set('meta_query', array(
			array(
				'key' => 'attachment_hide',
				'compare' => 'NOT EXISTS' // this should work...
			)
		));
		return $query;
	}

	add_filter('ajax_query_attachments_args', 'drkn_uploads_hide' );


	add_action('wp', 'drkn_setup_schedule');

	function drkn_setup_schedule(){
		if ( ! wp_next_scheduled( 'drkn_hide_attachments' ) ) {
			wp_schedule_event(time(), 'hourly', 'drkn_hide_attachments');
		}
	}

	function drkn_hide_attachments() {

		global $wpdb;
		$results = $wpdb->get_results( 'SELECT * FROM wp_postmeta WHERE meta_key = "attachment_hide"', OBJECT );

		$hidden_attachments = objects_values($results, 'post_id');

		$types = array('silk_products', 'instagram_post', 'tumblr_post');
		$hide = array();

		foreach ( $types as $type ) {
			$posts = get_posts(array(
				'post_type' => $type,
				'numberposts' => -1
			));

			foreach ( $posts as $post ) {
				$attachments_ids = get_post_meta($post->ID, 'attachment_ids', true);
				if ($attachments_ids)
					$hide = array_merge($hide, $attachments_ids);
				$attachments_id = get_post_meta($post->ID, 'post_image', true);
				if ($attachments_id)
					$hide[] = $attachments_id;
			}
		}

		foreach ( $hide as $id ) {
			if ( !in_array($id, $hidden_attachments) ) {
				update_post_meta($id, 'attachment_hide', 1);
			}
		}
	}

	function drkn_stringLimiter( $string,$limit,$add ){

		//Remove embeded media link from content intro text
		$string = preg_replace('/http\:\/\/[^ \<\n]*/','', $string);

  		echo mb_strimwidth($string, 0, $limit,$add);
	}

	/* ========================================================================================================================

	Required external files

	======================================================================================================================== */

	require_once( 'library/functions.php' );
	require_once( 'library/starkers-utilities.php' );
	require_once( 'library/instagram/instagram.php' );
	//require_once( 'library/tumblr/tumblr.php' );
	require_once( 'library/frontpage-products.php' );
	require_once( 'library/ShopMetaBox.php' );

	//Settings for general administration of website.
	require_once( 'library/drkn-settings.php' );

	/* ========================================================================================================================

	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme

	======================================================================================================================== */


	add_theme_support('post-thumbnails');
	require_once 'library/drkn.php';

	foreach ( Drkn::$imageSizes as $size )
		add_image_size( 'drkn_' . $size, $size );

	add_image_size( 'facebook', 1024, 536, false );
	add_image_size( 'army-list-size', 426, 286, true );
	add_image_size( 'frontpage-blog', 372, 186, true );
	add_image_size( '402x574', 402, 574, true );
	add_image_size( '630x760', 630, 760, true );
	add_image_size( '500x500', 500, 500, true );

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
				'header-menu-right' => __( 'Header Menu Right' ),
				'footer-menu' => __( 'Footer Menu' ),
				'pages-menu' => __( 'Pages Menu' ),
				'social-menu' => __( 'Social Menu' ),
				'sidebar-menu' => __( 'Sidebar Menu' )
			)
		);
	}
	add_action( 'init', 'drkn_register_menus' );

	add_filter( 'wp_get_nav_menu_items', 'drkn_menu_items', 10, 2 );

	function drkn_menu_items ( $items, $menu ) {
		if ($menu->slug == 'sidebar-menu' && is_single()) {

			global $post;

			$categories = get_the_terms( $post->ID, 'silk_category' );

			foreach( $items as $item ){

				foreach( $categories as $category ) {

					if( $category->term_id == $item->object_id ) {
						//$item->classes[0] = 'current-menu-item';
						$item->title =   " ›› " . $item->title . "<br> &nbsp;&nbsp; ›› <strong>" . $post->post_title ."</strong>";
						break(2);
					}
				}
			}
		}
		return $items;
	}

	/* ========================================================================================================================

	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

	======================================================================================================================== */

	require_once 'library/customposttype.php';
// require_once 'library/posttypes/shopsplash.php';
	require_once 'library/posttypes/banner.php';
//	require_once 'library/posttypes/frontpageslider.php';
//	require_once 'library/posttypes/frontpagesplash.php';
//	require_once 'library/posttypes/frontpageproduct.php';
//	require_once 'library/posttypes/frontpageimages.php';
//	require_once 'library/posttypes/FrontPageText.php';
	require_once 'library/posttypes/instagrampost.php';
	require_once 'library/posttypes/activist.php';
//	require_once 'library/posttypes/tumblrpost.php';
//	require_once 'library/posttypes/studiopost.php';
//	require_once 'library/posttypes/PostsOnPage.php';
	require_once 'library/posttypes/Slider.php';
	require_once 'library/posttypes/BannerTwoColumn.php';
	require_once 'library/posttypes/BannerProduct.php';
	require_once 'library/posttypes/BannerImage.php';


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



		wp_register_script( 'main-js', get_template_directory_uri().'/dist/js/main.min.js', array(), '5.4' );
		wp_enqueue_script( 'main-js' );
		wp_register_style( 'main-css', get_stylesheet_directory_uri().'/dist/css/main.css', array(), '5.5' );
		wp_enqueue_style( 'main-css' );









		/**
		 *  Vendor scripts
		 */

		// wp_register_script( 'bootstrap', get_template_directory_uri().'/assets/js/vendor/bootstrap.min.js', array( 'jquery' ) );
		// wp_enqueue_script( 'bootstrap' );

		// wp_register_script( 'underscore', get_template_directory_uri().'/assets/js/vendor/underscore.js', array() );
		// wp_enqueue_script( 'underscore' );

		// wp_register_script( 'backbone', get_template_directory_uri().'/assets/js/vendor/backbone.js', array() );
		// wp_enqueue_script( 'backbone' );

		// wp_register_script( 'backbone', get_template_directory_uri().'/assets/js/vendor/backbone.js', array() );
		// wp_enqueue_script( 'backbone' );

		// wp_register_script( 'imagesloaded', get_template_directory_uri().'/assets/js/vendor/imagesloaded.js', array() );
		// wp_enqueue_script( 'imagesloaded' );

		// wp_register_script( 'webfont', get_template_directory_uri().'/assets/js/vendor/webfont.js', array() );
		// wp_enqueue_script( 'webfont' );

		// wp_register_script( 'modernizr', get_template_directory_uri().'/assets/js/vendor/modernizr-custom.min.js', array() );
		// wp_enqueue_script( 'modernizr' );

		// wp_register_script( 'masonry', get_template_directory_uri().'/assets/js/vendor/masonry.js', array() );
		// wp_enqueue_script( 'masonry' );

		// wp_register_script( 'zoom', get_template_directory_uri().'/assets/js/vendor/imagezoom.js', array() );
		// wp_enqueue_script( 'zoom' );

		// wp_register_script( 'swipe', get_template_directory_uri().'/assets/js/vendor/jquery.touchSwipe.min.js', array() );
		// wp_enqueue_script( 'swipe' );

		// wp_register_script( 'bgvideo', get_template_directory_uri().'/assets/js/vendor/backgroundVideo.min.js', array() );
		// wp_enqueue_script( 'bgvideo' );
		/**
		 * Theme scripts
		 */


		// wp_register_script( 'global', get_template_directory_uri().'/assets/js/global.js', array( 'jquery' ), 12 );
		// wp_enqueue_script( 'global' );

		// wp_register_script( 'responsiveimage', get_template_directory_uri().'/assets/js/responsiveimage.js', array( 'jquery', 'underscore'  ) );
		// wp_enqueue_script( 'responsiveimage' );

		// wp_register_script( 'slider', get_template_directory_uri().'/assets/js/slider.js', array( 'jquery', 'underscore', 'backbone' ) );
		// wp_enqueue_script( 'slider' );

		// wp_register_script( 'newsletter-dialog', get_template_directory_uri().'/assets/js/newsletter-dialog.js', array( 'jquery', 'underscore', 'backbone' ) );
		// wp_enqueue_script( 'newsletter-dialog' );

		// wp_register_script( 'splash', get_template_directory_uri().'/assets/js/splash-banner.js', array( 'jquery' ) );
		// wp_enqueue_script( 'splash' );

		// wp_register_script( 'product', get_template_directory_uri().'/assets/js/product.js', array( 'jquery' ) );
		// wp_enqueue_script( 'product' );

		// wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', 12, 'screen' );
		// wp_enqueue_style( 'screen' );

		// wp_register_script( 'inspiration', get_template_directory_uri().'/assets/js/inspiration.js', array( 'jquery', 'underscore' ) );
		// wp_enqueue_script( 'inspiration' );
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

	function auto_generate_taxonomy_position_on_save($post_id, $post) {

		if ( wp_is_post_revision( $post_id ) ) return;

		$special_taxonomies = array(
			'displayed_in',
			'posts_on_page_displayed_in'
		);

		$taxonomies = array(
			'slider_displayed_in' => 2,
			'splash_displayed_in' => 2,
			'product_displayed_in' => 2,
			'image_displayed_in' => 2,
			'text_displayed_in' => 3
		);

		if ( $post->page_template == 'frontpage.php' ) {

			foreach( $special_taxonomies as $taxonomy ) {
				if ( $post_id == get_option( 'page_on_front' ) ) {
					if ( ! get_term_by('slug', 'frontpage', $taxonomy ) ) {
						wp_insert_term( 'Frontpage', $taxonomy, array('slug' => 'frontpage') );
					}
				} else {

					if ( !  get_term_by('slug', $post->post_name, $taxonomy ) ) {
						wp_insert_term( $post->post_title, $taxonomy, array('slug' => $post->post_name) );
					}
				}
			}

			foreach( $taxonomies as $taxonomy => $count ) {
				if ( $post_id == get_option( 'page_on_front' ) ) {
					for($i=1;$i<=$count;$i++) {
						if ( ! get_term_by('slug', 'frontpage', $taxonomy ) ) {
							wp_insert_term( "Frontpage (Position {$i})", $taxonomy, array('slug' => 'frontpage-position-' . $i) );
						}
					}

				} else {
					for($i=1;$i<=$count;$i++) {
						if ( ! get_term_by('slug', $post->post_name . '-position-' . $i, $taxonomy ) ) {
							wp_insert_term( $post->post_title . " (Position {$i})", $taxonomy, array('slug' =>  $post->post_name . '-position-' . $i) );
						}
					}
				}
			}
		} else {

			if ( $post_id != get_option( 'page_on_front' ) ) {

				foreach( $special_taxonomies as $taxonomy ) {

					if ( $term = get_term_by('slug', $post->post_name, $taxonomy) ) {
						wp_delete_term($term->term_id, $taxonomy);
					}
				}

				foreach( $taxonomies as $taxonomy => $count ) {
					for($i=1;$i<=$count;$i++) {

						if ( $term = get_term_by('slug', $post->post_name . '-position-' . $i, $taxonomy ) ) {
							wp_delete_term($term->term_id, $taxonomy);
						}
					}
				}
			}

		}
	}
	add_action('save_post', 'auto_generate_taxonomy_position_on_save', 10, 3);
	add_action('untrash_post', 'auto_generate_taxonomy_position_on_save');

	function auto_delete_taxonomy_position_on_delete($post_id) {

		$object = get_post($post_id);

		$special_taxonomies = array(
			'displayed_in',
			'posts_on_page_displayed_in'
		);
		$taxonomies = array(
			'slider_displayed_in' => 2,
			'splash_displayed_in' => 2,
			'product_displayed_in' => 2,
			'image_displayed_in' => 2,
			'text_displayed_in' => 3
		);

		if ( $object->page_template == 'frontpage.php' ) {

			if ( $post_id != get_option( 'page_on_front' ) ) {

				foreach( $special_taxonomies as $taxonomy ) {

					if ( $term = get_term_by('slug', $object->post_name, $taxonomy) ) {
						wp_delete_term($term->term_id, $taxonomy);
					}
				}

				foreach( $taxonomies as $taxonomy => $count ) {
					for($i=1;$i<=$count;$i++) {

						if ( $term = get_term_by('slug', $object->post_name . '-position-' . $i, $taxonomy ) ) {
							wp_delete_term($term->term_id, $taxonomy);
						}
					}
				}
			}

		}
	}
	add_action( 'trashed_post', 'auto_delete_taxonomy_position_on_delete' );

/**
 * Remove empty paragraphs created by wpautop()
 */
function remove_empty_p( $content ) {
    $content = force_balance_tags( $content );
    $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
    $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
    return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);

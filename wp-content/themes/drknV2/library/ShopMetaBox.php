<?php

namespace DRKN\Library;

/**
 * Description of ShopMetaBox
 *
 * @package package
 * @version $id: ShopMetaBox.php $
 */
class ShopMetaBox {
	
	public function initMeta() {
		add_action( 'add_meta_boxes', array( $this, 'addMetaBox' ) );
		add_action( 'save_post', array( $this, 'saveMetaBox' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'metaImageEnqueue' ) );
	}
	
	public function addMetaBox() {
		global $post;
		
		if( !$post ) {
			return;
		}
		
		$template = get_post_meta( $post->ID, '_wp_page_template', true );
		
		if( $template == 'shop_landing.php' ) {
			add_meta_box( 'shop_meta_box', 'Images', array( $this, 'renderMetaBox' ), 'page' );
		}
	}
	
	public function renderMetaBox() {
		// Noncename needed to verify where the data originated
		wp_nonce_field( basename( __FILE__ ), 'Shop_Noncename' );
		
		include 'html/shop-meta.php';
	}
	
	public function saveMetaBox() {
		global $post;
		
		$isAutosave = wp_is_post_autosave( $post->ID );
		$isRevision = wp_is_post_revision( $post->ID );
		$isValidNonce = ( isset( $_POST[ 'Shop_Noncename' ] ) && wp_verify_nonce( $_POST[ 'Shop_Noncename' ], basename( __FILE__ ) ) ) ? true : false;

		if( $isAutosave || $isRevision || !$isValidNonce ) {
			return;
		}
		
		for( $i = 1; $i <= 3; $i++ ) {
			$metaData['Image_' . $i] = $_POST['Image_' . $i];
			$metaData['Position_' . $i] = (int) $_POST['Position_' . $i];
			$metaData['Is_Wide_' . $i] = (int) $_POST['Is_Wide_' . $i];
		}
		
		foreach( $metaData as $key => $value ) {
			if( $post->post_type == 'revision' ) {
				return;
			}
			
			$value = implode( ',', (array) $value );
			
			if( get_post_meta( $post->ID, $key, false ) ) {
				update_post_meta( $post->ID, $key, $value );
			} else {
				add_post_meta( $post->ID, $key, $value );
			}
			
			if( $value == '' ) {
				delete_post_meta( $post->ID, $key );
			}
		}
	}
	
	public function metaImageEnqueue() {
		global $post;
		
		if( !$post ) {
			return;
		}
		
		$template = get_post_meta( $post->ID, '_wp_page_template', true );
		
		if( $template == 'shop_landing.php' ) {
			wp_enqueue_media();

			wp_register_script( 'meta-image', get_template_directory_uri() . '/library/js/image.meta.js', array( 'jquery' ) );
			wp_localize_script( 'meta-image', 'meta_image',
				array(
					'title' => 'Choose or Upload an Image',
					'button' => 'Use this image',
				)
			);

			wp_enqueue_script( 'meta-image' );
		}
	}
	
}

$car = new ShopMetaBox();

$car->initMeta();
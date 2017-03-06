<?php

/**
 * Template Name: Add Product Page
 */

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) );

$sizeName = ( isset( $_GET[ 'size' ] ) ) ? $_GET[ 'size' ] : '';
$productID = (int) get_post_meta( $post->ID, 'product', true );
$link = get_permalink( $post );

if( $productID && $sizeName ) {
	$postMetadata = get_post_meta( $productID );
	$productMetadata = unserialize( $postMetadata['product_data'][0] );
	$productSizes = $productMetadata['items'];
	$actualSize = '';

	foreach( $productSizes as $productSize ) {
		if( strtolower( $sizeName ) == strtolower( $productSize['name'] ) ) {
			$actualSize = $productSize['item'];
			
			break;
		}	
	}
	
	$args = array(
		'esc_action' => 'esc_select_product',
		'esc_post' => $productID,
		'_wp_http_referer' => $link,
		'esc_product_item' => $actualSize
	);
	
	EscConnect::editProduct( $args );
	
	$selection = EscGeneral::getSelection();
}
?>

<section id="AddProductPage" class="textPage"
		 data-size="<?php echo $sizeName; ?>"
		 data-id="<?php echo $productID; ?>"
		 data-link="<?php echo $link; ?>"
		 data-selection='<?php echo json_encode( $selection ); ?>'
		 data-basket="<?php // echo $basket; ?>">
	<div class="container-fluid">
		<div class="row">
			<?php if( $productID && $sizeName ) : ?>
			<div class="col-md-4 div-center">
				<h4 class="text-center"><?php echo $post->post_title; ?></h4>
				
				<?php echo apply_filters( 'the_content', $post->post_content ); ?>
			</div>
			<?php else: ?>
			<p>Something went wrong, please try again later.</p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php

Starkers_Utilities::get_template_parts( array( 'parts/shared/footer', 'parts/shared/html-footer' ) );

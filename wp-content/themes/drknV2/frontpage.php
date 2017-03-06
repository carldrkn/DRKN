<?php

/**
 * Template Name: Frontpage
 */

get_template_part( 'parts/shared/header' );
?>

<div class="banner-slider">
	<?php
	
	get_template_part( 'parts/shared/header-nav-bar' );
	get_template_part( 'parts/front-page/slider' );
	?>
</div>

<?php

$btc = CustomPostType::getInstance( 'banner-two-column' )->getPost( array( 'banner_two_column_displayed_in' => 'frontpage' ) );

if( $btc ) :
?>
<div class="switch-box">
	<?php
	
	$btcfHidden = ( $btc->btcf_show_in_mobile == 'no' ) ? 'hidden-xs' : '';

	$btcfNoImage = $btc->btcf_image ? '' : 'no-image';

	if( $btc->btcf_type == 'image' ) :
	?>
	<a href="<?php echo ( $btc->btcf_link->id ) ? get_permalink( (int) str_replace( 'post_', '', $btc->btcf_link->id ) ) : $btc->btcf_link->url; ?>"
	   class="sb-img <?php echo $btcfHidden; ?>  <?php echo $btcfNoImage; ?>"
	   style="background-image: url('<?php echo wp_get_attachment_url( $btc->btcf_background ); ?>')">
		<img class="img-responsive" src="<?php echo wp_get_attachment_image_src( $btc->btcf_image, 'original' )[0]; ?>" alt="" />
	</a>
	<?php else: ?>
	<div class="sb-product <?php echo $btcfHidden; ?>">
		<?php
			
		$btcfProduct = get_post( $btc->btcf_product );
		$productID = $btcfProduct->id;

		include( locate_template( 'parts/shared/product-wide.php' ) );
		?>
	</div>
	<?php endif; ?>
	
	<?php
	
	$btcsHidden = ( $btc->btcs_show_in_mobile == 'no' ) ? 'hidden-xs' : '';
	
	if( $btc->btcs_type == 'image' ) :
	?>
	<a href="<?php echo ( $btc->btcs_link->id ) ? get_permalink( (int) str_replace( 'post_', '', $btc->btcs_link->id ) ) : $btc->btcs_link->url; ?>"
	   class="sb-img <?php echo $btcsHidden; ?>"
	   style="background-image: url('<?php echo wp_get_attachment_url( $btc->btcs_background ); ?>')">
		<img class="img-responsive" src="<?php echo wp_get_attachment_image_src( $btc->btcs_image, '402x574' )[0]; ?>" alt="" />
	</a>
	<?php else: ?>
	<div class="sb-product <?php echo $btcsHidden; ?>">
		<?php
			
		$btcsProduct = get_post( $btc->btcs_product );
		$productID = $btcsProduct->id;

		include( locate_template( 'parts/shared/product-wide.php' ) );
		?>
	</div>
	<?php endif; ?>
</div>
<?php  endif; ?>

<?php

$bannerImage1 = CustomPostType::getInstance( 'banner-image' )->getPost( array( 'banner_image_displayed_in' => 'frontpage-position-1' ) );

if( $bannerImage1 ) {
	$banner = $bannerImage1;
	
	include( locate_template( 'parts/front-page/banner-image.php' ) );
}
?>

<?php

$bannerProduct = CustomPostType::getInstance( 'banner-product' )->getPost( array( 'banner_product_displayed_in' => 'frontpage' ) );

if( $bannerProduct ) :
?>
<div class="container single-prod">
	<div class="row">
		<div class="col-md-12">
			<?php
			
			$product = get_post( $bannerProduct->bp_product );
			$productID = $product->id;

			include( locate_template( 'parts/shared/product-wide.php' ) );
			?>
		</div>
	</div>
</div>
<?php endif; ?>

<?php

$bannerImage2 = CustomPostType::getInstance( 'banner-image' )->getPost( array( 'banner_image_displayed_in' => 'frontpage-position-2' ) );

if( $bannerImage2 ) {
	$banner = $bannerImage2;
	
	include( locate_template( 'parts/front-page/banner-image.php' ) );
}

get_template_part( 'parts/shared/footer' );

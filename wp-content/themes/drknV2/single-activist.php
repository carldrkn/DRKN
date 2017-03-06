<?php $banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'culture')); ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

<?php

	$background = '';
	$attachement = wp_get_attachment_image_src( $post->activist_image, 'full' );
	
	if( isset( $attachement[0] ) ) {
		$background = 'style="background-image: url(' . $attachement[0] . ');"';
	}
?>
<div class="selected-activist <?php echo $post->activist_position; ?>">
	<div class="banner-act" <?php echo $background; ?>>
		<?php 
		$pages = get_pages( array(
			'number' => 1,
			'meta_key' => '_wp_page_template',
			'meta_value' => 'activists.php'
		) );

		if( isset( $pages[0] ) ) :
		?>
		<a href="<?php echo get_permalink( $pages[0] ); ?>" class="back-btn">Back</a>
		<?php endif; ?>
	</div>
	
	<div class="content-act">
		<div class="content">
			<h1><?php echo the_title(); ?> <span><?php echo $post->activist_subtitle; ?></span></h1>
			
			<?php echo apply_filters( 'the_content', $post->post_content ); ?>
		</div>
		
		<?php
		
		$productID = (int) str_replace( 'post_', '', $post->activist_target->id );
	
		$isAvailable = EscGeneral::isAvailable( $productID );
		
		if( $isAvailable['success'] ) :
			$post = get_post( $productID );

			$soldOut = '';

			if( $isAvailable['info']['stockOfAllItems'] == 0) {
				$soldOut = ' sold-out';
			}
		?>
		<div class="prod-info-ct">
			<div class="prod-info">
				<div class="name-price">
					<div class="name"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a><span><?php echo $post->activist_subtitle; ?></span></div>
					<div class="price">
						<?php if( $soldOut !== '' ) : ?>
						<strong>SOLD OUT</strong>
						<?php else: ?>
						<?php get_template_part( 'parts/shop/price' ); ?>
						<?php endif; ?>
					</div>
				</div>
				<?php if( $soldOut == '' ) : ?>
				<?php
					get_template_part('parts/shop/product-purchase-inline');
				?>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; wp_reset_query(); ?>
	</div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
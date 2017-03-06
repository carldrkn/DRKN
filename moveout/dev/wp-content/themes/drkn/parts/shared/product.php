<?php
$is_available = EscGeneral::isAvailable($post->ID);
$sold_out = '';
$attachments = get_post_meta( $post->ID, 'attachment_ids', true );
//If product unavailable due to no stock, wrong pricelist or wrong market
if($is_available['success']):
	if($is_available['info']['stockOfAllItems'] == 0) $sold_out = ' sold-out';
?>
	<div class="product col-md-4 col-sm-6<?php echo $sold_out; ?>">
		<a href="<?php the_permalink(); ?>">
			<?php responsive_img( array_shift( $attachments ) ) ?>
			<?php /*
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/product.jpg" class="div-center">
 			*/ ?>
			<p class="product-name"><?php the_title(); ?></p>
			<p class="product-price"><?php if($sold_out !== '') echo '<strong>Sold Out</strong> '; ?><?php get_template_part('parts/shop/price'); ?></p>
		</a>
	</div>
<?php endif; ?>
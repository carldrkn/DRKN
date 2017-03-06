<?php

$is_available = EscGeneral::isAvailable($post->ID);
$is_available['success'] = true;
$sold_out = '';



//If product unavailable due to no stock, wrong pricelist or wrong market
if($is_available['success']):
	if($is_available['info']['stockOfAllItems'] == 0) $sold_out = ' sold-out';  // $sold_out = ' sold-out';
?>
	<div class="product col-md-3 col-sm-4 col-xs-6<?php echo $sold_out; ?>">
		<a href="<?php the_permalink(); ?>" class="replace-img" data-second-image="<?php echo ( isset($hoverImage[0]) ? $hoverImage[0] : '' ) ?>">
			<?php responsive_img( $prod_img_id ) ?>
		</a>
		<div>
			<a href="<?php the_permalink(); ?>">
				<p class="product-name"><?php the_title(); ?></p>
				<p class="product-price"><?php if($sold_out !== '') echo 'SOLD OUT '; ?><?php if($sold_out == '') get_template_part('parts/shop/price'); ?></p>
			</a>

			<?php
			get_template_part('parts/shop/product-purchase-inline');
			?>
		</div>
	</div>
<?php endif; ?>
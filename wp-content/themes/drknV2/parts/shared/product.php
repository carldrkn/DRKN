<?php

$attachments = get_post_meta( $productID, 'attachment_ids', true );
$isAvailable = EscGeneral::isAvailable( $productID );
$price = EscGeneral::getPrice( $productID );
$soldOut = false;

if( $isAvailable['success'] && $isAvailable['info']['stockOfAllItems'] == 0 ) {
	$soldOut = true;
}
?>
<div class="prod-wrap <?php echo ( isset( $productClass ) ) ? $productClass : ''; ?>">
	<a href="<?php echo get_permalink( $productID ); ?>" class="prod-item">
		<img class="img-responsive" src="<?php echo wp_get_attachment_image_src( $attachments[0], '500x500' )[0]; ?>" alt="" />
		<div class="title"><?php echo get_the_title( $productID ); ?></div>

		<?php if( $soldOut ) : ?>
		<div class="price sold-out">Sold out</div>
		<?php else: ?>
		<div class="price">
			<?php if( $price['success'] && $price['info']['showAsOnSale'] ) : // On Sale ?>
				<s><?php echo $price['info']['priceBeforeDiscount']; ?></s>
				<span class="sale-product"><?php echo $price['info']['price']; ?></span>

				<?php if( isset( $price['info']['discountPercent'] ) && !empty( $price['info']['discountPercent'] ) ) : ?>
				<span class="sale-percent">
					<?php echo ' (' . $price['info']['discountPercent'] . '% Off)'; ?>
				</span>
				<?php endif; ?>
			<?php elseif( $price['info']['newProduct'] ) : //New product ?>
				<span class="new-product"><strong>New!</strong> <?php echo $price['info']['price']; ?></span>
			<?php else: //Normal ?>
				<?php echo $price['info']['price']; ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</a>
</div>
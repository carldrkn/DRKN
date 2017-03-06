<?php
$patch_product_id = get_option('patch_product_id');

$post = get_post( $patch_product_id );
$product = new EscProduct($patch_product_id);
$attachments = get_post_meta( $post->ID, 'attachment_ids', true );

$attachment_id = false;

if( ! empty($attachments) && is_array($attachments) ) {
	$attachment_id = $attachments[0];
}
?>
<div class="add-patch">
	<h2 class="arr">Add <?php echo $product->product_meta['name'] ?></h2>
	<div class="link-wrap clearfix">
	<?php
	get_template_part('parts/shop/price');
	?>
	</div>
	<img class="img-responsive" src="<?php echo wp_get_attachment_image_src( $attachment_id, '500x500' )[0]; ?>" alt="" />
	<?php
	$custom_cta = 'ADD PATCH PACK';
	get_template_part('parts/shop/product-purchase');
	?>
</div>
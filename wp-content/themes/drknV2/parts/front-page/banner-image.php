<?php

$text = $banner->bi_text;
$background = $banner->bi_background;
$image = $banner->bi_image;
$link = ( $banner->bi_link->id ) ? get_permalink( (int) str_replace( 'post_', '', $banner->bi_link->id ) ) : $banner->bi_link->url;
$class = 'full-box ' . $banner->bi_position;

if( !$image ) {
	$class .= ' text-only';
}
?>
<a href="<?php echo $link; ?>" class="<?php echo $class; ?>" style="background-image: url('<?php echo wp_get_attachment_url( $background ); ?>')">
	<?php if( $image ) : ?>
	<img src="<?php echo wp_get_attachment_image_src( $image, 'original' )[0]; ?>" alt="" class="img-responsive" />
	<?php endif; ?>
	<?php if( $text ) : ?>
	<div class="title-line"><?php echo $text; ?></div>
	<?php endif; ?>
</a>
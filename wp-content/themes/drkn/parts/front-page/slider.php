<?php

if( isset( $slider->slider_type ) && $slider->slider_type == 'video' ) :
	$autoplay = "";
	$loop = "";
	$sound = "";
	$showPlay = "";
	$videobgImg = "";

	if( $slider->slider_video_autoplay == "yes" ) { $autoplay = "autoplay"; }
	if( $slider->slider_video_autoplay == "no" ) { $showPlay = "play-visible"; }
	if( $slider->slider_video_loop == "yes" ) { $loop = "loop"; }
	if( $slider->slider_video_sound == "no" ) { $sound = "muted"; }

	$videobg = wp_get_attachment_image_src( $slider->slider_video_image, array(750,750) );

	if( isset( $videobg[0] ) ) {
		$videobgImg = $videobg[0];
	}
?>
	<div class="video-outer <?php echo ( isset( $banner ) && $slider_pos == 1 ) ? 'has-banner' : '' ?>" style="background-image: url('<?php echo $videobgImg ?>');">
		<div class="video-inner">
			<video controls <?php echo $autoplay . ' ' . $loop . ' ' . $sound; ?> >
				<source src="<?= $slider->slider_video_url ?>" type="video/mp4">
			</video>
		</div>

		<a href="" class="video-play <?php echo $showPlay; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/play.svg" class="play-visible" /></a>
	</div>
<?php else : ?>
<div class="frontpage-slider slider-container <?= ( isset( $banner ) && $slider_pos == 1 ) ? 'has-banner' : '' ?>">
	<div class="slider">
		<?php foreach ( $slider->slider_images as $n => $attachment_id ): ?>
		<div class="slide<?php if( !$n ) { echo ''; } ?> ">
			<?php if( $slider->slider_target_link ) : ?>
			<a href="<?php echo $slider->slider_target_link; ?>" class="">
				<?php responsive_img( $attachment_id, 'fill-image' ); ?>
			</a>
			<?php else: ?>
			<?php responsive_img( $attachment_id, 'fill-image' ); ?>
			<?php endif; ?>
		</div>
		<?php endforeach; ?>
	</div>

	<h3 class="title-shop">
		<span class="title-shop-title"><?php echo $slider->slider_title ?></span>

		<?php if ( strlen( $slider->slider_button_title ) ): ?>
		<span class="shop-button"><?php echo $slider->slider_button_title ?></span>
		<?php endif; ?>
	</h3>
	
	<button class="next"></button>
	<button class="prev"></button>
</div>
<?php endif;

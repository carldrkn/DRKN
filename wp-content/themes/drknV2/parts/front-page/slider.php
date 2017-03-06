<?php

$slider = CustomPostType::getInstance( 'slider' )->getPost( array( 'slider_displayed_in' => 'frontpage' ) );

if( isset( $slider->slider_type ) && $slider->slider_type == 'video' ) :
	$autoplay = ( $slider->slider_video_autoplay == 'yes' ) ? 'autoplay' : '';
	$loop = ( $slider->slider_video_loop == 'yes' ) ? 'loop' : '';
	$sound = ( $slider->slider_video_sound == 'no' ) ? 'muted' : '';
	$showPlay = ( $slider->slider_video_autoplay == 'no' ) ? 'play-visible' : '';
	$videoImageURL = '';

	if( $slider->slider_video_image ) {
		$videoImageURL = wp_get_attachment_url( $slider->slider_video_image );
	}
?>
<div class="video-outer">
	<div class="video-inner" style="background-image: url( '<?php echo $videoImageURL; ?>' )">
		<video controls <?php echo $autoplay . ' ' . $loop . ' ' . $sound; ?> >
			<source src="<?php echo $slider->slider_video_url; ?>" type="video/mp4">
		</video>
	</div>

	<a class="video-play <?php echo $showPlay; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/play.svg" class="play-visible" /></a>
</div>
<?php else : ?>
<div id="bannerSlider" class="carousel slide" data-ride="carousel">
	<?php

	$slides = array();

	for( $i = 1; $i <= 3; $i++ ) {
		$title = $slider->{'slider_title_' . $i };
		$imageID = $slider->{'slider_image_' . $i };
		$link = ( $slider->{'slider_link_' . $i }->id ) ? get_permalink( (int) str_replace( 'post_', '', $slider->{'slider_link_' . $i }->id ) ) : $slider->{'slider_link_' . $i }->url;

		if( !$title || !$imageID ) {
			continue;
		}

		array_push(
			$slides,
			array(
				'title' => $title,
				'imageURL' => wp_get_attachment_url( $imageID ),
				'link' => $link
			)
		);
	}
	?>
	<ol class="carousel-indicators">
		<?php foreach( $slides as $key => $slide ): ?>
		<li data-target="#bannerSlider" data-slide-to="<?php echo $key; ?>" class="<?php echo ( $key == 0 ) ? 'active' : '' ?>"></li>
		<?php endforeach; ?>
	</ol>

	<div class="carousel-inner" role="listbox">
		<?php foreach( $slides as $key => $slide ): ?>
		<div class="item <?php echo ( $key == 0 ) ? 'active' : '' ?>" style="background-image: url( '<?php echo $slide['imageURL']; ?>' );">
			<a href="<?php echo $slide['link']; ?>" class="bannerContent container">
				<div class="row">
					<h2 class="bannerTitle"><?php echo $slide['title']; ?></h2>
				</div>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
</div>

<div class="mobileImageFB">
	<?php
	
	$mobileImage = ( $slider->slider_mobile_fallback ) ? wp_get_attachment_url( $slider->slider_mobile_fallback ) : $slides[0]['imageURL'];
	?>
	<div class="item" style="background-image: url( '<?php echo $mobileImage; ?>' );">
		<div class="container">
			<div class="row">
				<a href="<?php echo $slides[0]['link']; ?>">
					<h2 class="imgfbtitle"><?php echo $slides[0]['title']; ?></div>
				</a>
			</div>
		</div>
	</div>
</div>
<?php endif;

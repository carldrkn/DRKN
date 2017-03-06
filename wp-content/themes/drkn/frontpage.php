<?php


/**
 * Template Name: Frontpage
 */
 if ( is_front_page() ) {
 	$position = 'frontpage';
 } else {
 	$position = $post->post_name;
 }

Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) );

$banner = CustomPostType::getInstance( 'banner' )->getPost( array( 'displayed_in' => $position ) );

include 'parts/shared/banner.php';

$slider1 = CustomPostType::getInstance( 'frontpage_slider' )->getPost( array( 'slider_displayed_in' => $position. '-position-1' ) );

if( $slider1 && count( $slider1->slider_images ) ) {
	$slider = $slider1;
	$slider_pos = 1;
	include 'parts/front-page/slider.php';
}

$text1 = CustomPostType::getInstance( 'front_page_text' )->getPost( array( 'text_displayed_in' => $position . '-position-1' ) );

if( $text1 ) {
	$text = $text1;

	include 'parts/front-page/text.php';
}

$splashes1 = CustomPostType::getInstance( 'frontpage_splashes' )->getPost( array( 'splash_displayed_in' => $position . '-position-1' ) );

if( $splashes1 ) {
	$splashes = $splashes1;

	include 'parts/front-page/splashes.php';
}

$text2 = CustomPostType::getInstance( 'front_page_text' )->getPost( array( 'text_displayed_in' => $position . '-position-2' ) );

if( $text2 ) {
	$text = $text2;

	include 'parts/front-page/text.php';
}

$slider2 = CustomPostType::getInstance( 'frontpage_slider' )->getPost( array( 'slider_displayed_in' => $position . '-position-2' ) );

if( $slider2 && count( $slider2->slider_images ) ) {
	$slider = $slider2;
	$slider_pos = 2;
	include 'parts/front-page/slider.php';
}

$text3 = CustomPostType::getInstance( 'front_page_text' )->getPost( array( 'text_displayed_in' => $position . '-position-3' ) );

if( $text3 ) {
	$text = $text3;

	include 'parts/front-page/text.php';
}

$splashes2 = CustomPostType::getInstance( 'frontpage_splashes' )->getPost( array( 'splash_displayed_in' => $position . '-position-2' ) );

if( $splashes2 ) {
	$splashes = $splashes2;

	include 'parts/front-page/splashes.php';
}
?>
<?php
$frontpage_images = CustomPostType::getInstance( 'frontpage_images' )->getPost( array( 'image_displayed_in' => $position . '-position-1') );

if( $frontpage_images ):
?>
<div class="frontpage-instagram-posts">
	<?php foreach ( $frontpage_images->images as $image ): ?>
	<div class="frontpage-instgram-post col-md-2 col-sm-2 col-xs-4 no-padding margin-bottom">
		<span class="square-container">
			<span class="square-inner">
				<?php responsive_img($image, 'fill-image') ?>
			</span>
		</span>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<?php

$fp_products = CustomPostType::getInstance( 'frontpage_products' )->getPosts( array( 'product_displayed_in' =>  $position . '-position-1', 'limit' => 3 ) );
$products =  get_frontpage_products($position);
$count = 0;
?>
<section class="frontpage-product-list product-list">
	<div class="container-fluid">
		<div class="row">

			<div class="product-list-inner">
			<?php
				if( !empty($fp_products) ) {
					foreach ($fp_products as $fp_prod) {
						if( $fp_prod->product_1_product->id && $fp_prod->product_2_product->id && $fp_prod->product_3_product->id  && $fp_prod->product_4_product->id ) {

							$post = get_post( $fp_prod->product_1_product->id );
							$prod_img_id = $fp_prod->product_1_image;
							include 'parts/shared/fp_product.php';

							$post = get_post( $fp_prod->product_2_product->id );
							$prod_img_id = $fp_prod->product_2_image;
							include 'parts/shared/fp_product.php';

							$post = get_post( $fp_prod->product_3_product->id );
							$prod_img_id = $fp_prod->product_3_image;
							include 'parts/shared/fp_product.php';

							$post = get_post( $fp_prod->product_4_product->id );
							$prod_img_id = $fp_prod->product_4_image;
							include 'parts/shared/fp_product.php';

						}
					}
				}

				$featuredPosts = CustomPostType::getInstance( 'posts_on_page' )->getPosts( array('posts_on_page_displayed_in' => $position, 'limit' => 4 ) );
				if( $featuredPosts && count($featuredPosts) == 4 ) :
				?>

				<div class="blog-post-list-container clearfix">
					<div class="col-md-12 hidden-sm hidden-xs"><div class="wrap-h3">&nbsp;</div></div>
					<div class="blog-post-list-inner">
						<?php foreach( $featuredPosts as $item ) : ?>
							<div class="col-md-3 col-sm-6 col-xs-6 blog-post-list">
								<?php

								$target = $item->posts_on_page_target;
								$id = (int) str_replace( 'post_', '', $target->id );
								$itemPost = get_post( $id );
								$attachement = wp_get_attachment_image_src( $item->posts_on_page_image, 'frontpage-blog' );
								$image = $attachement[0];

								if( !empty( $item->post_title ) ) {
									$title = $item->post_title;
								}  else {
									$title = $itemPost->post_title;
								}

								if( !$image ) {
									$itemPostAttachement = wp_get_attachment_image_src( get_post_thumbnail_id($id, 'frontpage-blog' ) );
									$image = $itemPostAttachement[0];
								}
								?>

								<a href="<?php echo $item->posts_on_page_target_link ?>">
									<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" class="img-responsive">
									<div>
										<p class="blog-post-title"><?php echo $title; ?></p>
										<p class="blog-post-description"><?php echo $item->posts_on_page_subtitle; ?></p>
									</div>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif;

			?>
				<div class="col-md-12 hidden-sm hidden-xs">
					<div class="wrap-h3">
						<h3>SHOP</h3>
					</div>
				</div>
			<?php

			foreach ( $products as $post ): setup_postdata($post) ?>
				<?php
				$count++;

				if( $count <= 4 ) {
					$secondImg = true;
				} else {
					$secondImg = false;
				}

				include 'parts/shared/product.php';

				?>
			<?php endforeach; ?>
			</div>

		</div>
	</div>
</section>

<?php

$drkn_options = get_option('drkn_theme_options');
$display_instagram = isset($drkn_options['drkn_theme_instagram_boolean']) && $drkn_options['drkn_theme_instagram_boolean'];
$instagram_posts = CustomPostType::getInstance('instagram_post')->getPosts(array('limit' => 8));
$col = 0;

if( $display_instagram ): ?>

	<div class="frontpage-instagram-posts">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12 hidden-xs">
				<div class="wrap-h3">
					<h3>INSTAGRAM</h3>
				</div>
			</div>

			<?php foreach ( $instagram_posts as $post ): ?>
				<?php if( ($col % 2) == 0): ?>
					<div class="frontpage-instgram-post col-md-3 col-sm-4 col-xs-6 <?= $col >= 6 ? 'hidden-sm' : ''; ?> <?= $col >= 4 ? 'hidden-xs' : ''; ?> no-padding margin-bottom">
				<?php endif;  ?>

				<div class="frontpage-instgram-post col-md-6 col-sm-6 col-xs-12">
					<a href="<?php echo $post->post_url ?>" target="_blank">
					<span class="square-container">
						<span class="square-inner">
								<?php responsive_img($post->post_image, 'fill-image') ?>
						</span>
					</span>
					</a>
				</div>

				<?php if( ($col % 2) == 1): ?>
					</div>
				<?php endif; $col++; ?>

			<?php endforeach; ?>
		</div>
	</div>
	</div>
<?php endif; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>

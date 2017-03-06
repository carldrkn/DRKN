<?php
/*
Template Name: Frontpage
*/

$slider = CustomPostType::getInstance('frontpage_slider')->getPost();
$splashes = CustomPostType::getInstance('frontpage_splashes')->getPost();
$instagram_posts = CustomPostType::getInstance('instagram_post')->getPosts(array('limit' => 6));
$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'frontpage'));
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

<?php if ( $slider && count($slider->images) ): ?>
<div class="frontpage-slider slider-container">
	<div class="slider">
		<?php foreach ( $slider->slider_images as $n => $attachment_id ): ?>
			<div class="slide<?php if (!$n) echo ''; ?> ">
				<?php responsive_img( $attachment_id, 'fill-image' ) ?>
			</div>
		<?php endforeach; ?>
	</div>
	<h3 class="title-shop">
		<a href="<?php echo $slider->slider_target_link ?>" class="">
			<span class="title-shop-title">
				<?php echo $slider->slider_title ?>
			</span>
			<?php if ( strlen($slider->slider_button_title) ): ?>
				<span class="shop-button"><?php echo $slider->slider_button_title ?></span>
			<?php endif; ?>
		</a>
	</h3>
	<button class="next"></button>
	<button class="prev"></button>
</div>
<?php endif; ?>

<?php if ( $splashes ): ?>
<div class="padding-top frontpage-splashes">

	<div class="frontpage-splash margin-bottom col-md-4 col-sm-4 no-padding first">
		<div class="square-container">
			<div class="square-inner">
				<h3 class="title-shop">
					<a href="<?php echo $splashes->splash_1_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $splashes->splash_1_title ?>
						</span>
						<?php if ( strlen($splashes->splash_1_button_title) ): ?>
							<span class="shop-button"><?php echo $splashes->splash_1_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>

				<a href="<?php echo $splashes->splash_1_target_link ?>" class="">
					<?php responsive_img($splashes->splash_1_image, 'fill-image') ?>
				</a>
			</div>
		</div>
	</div>

	<div class="frontpage-splash margin-bottom col-md-4 col-sm-4 no-padding second">
		<div class="square-container">
			<div class="square-inner">
				<h3 class="title-shop">
					<a href="<?php echo $splashes->splash_2_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $splashes->splash_2_title ?>
						</span>
						<?php if ( strlen($splashes->splash_2_button_title) ): ?>
							<span class="shop-button"><?php echo $splashes->splash_2_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>

				<a href="<?php echo $splashes->splash_2_target_link ?>" class="">
					<?php responsive_img($splashes->splash_2_image, 'fill-image') ?>
				</a>
			</div>
		</div>
	</div>

	<div class="frontpage-splash margin-bottom col-md-4 col-sm-4 no-padding third">
		<div class="square-container">
			<div class="square-inner">
				<h3 class="title-shop">
					<a href="<?php echo $splashes->splash_3_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $splashes->splash_3_title ?>
						</span>
						<?php if ( strlen($splashes->splash_3_button_title) ): ?>
							<span class="shop-button"><?php echo $splashes->splash_3_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>

				<a href="<?php echo $splashes->splash_3_target_link ?>" class="">
					<?php responsive_img($splashes->splash_3_image, 'fill-image') ?>
				</a>
			</div>
		</div>
	</div>

</div>
<?php endif; ?>

<div class="frontpage-instagram-posts">
	<?php foreach ( $instagram_posts as $post ): ?>
	<div class="frontpage-instgram-post col-md-2 col-sm-2 col-xs-4 no-padding margin-bottom">
		<div class="square-container">
			<div class="square-inner">
				<?php responsive_img($post->post_image, 'fill-image') ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>

<?php
$products =  get_posts(array(
	'posts_per_page' => 6,
	'post_type' => 'silk_products'
));
?>

<section class="product-list">
	<div class="container-fluid">
		<div class="row">

			<div class="wrap-h3 col-md-12 hidden-sm hidden-xs">
				<h3>
					SHOP
				</h3>
			</div>

			<div>
			<?php foreach ( $products as $post ): setup_postdata($post) ?>
				<?php include 'parts/shared/product.php'; ?>
			<?php endforeach; ?>
			</div>

		</div>
	</div>
</section>

<div class="clearfix"></div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
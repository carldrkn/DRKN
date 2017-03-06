<?php
/*
Template Name: Shop landing
*/

$landing = CustomPostType::getInstance('shop_landing')->getPost();
$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'shop'));

?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

<div class="shop-landing-wrapper content-container">
	<div class="clearfix"></div>

	<?php include 'parts/shop/sidebar.php' ?>

	<div class="content has-sidebar">

		<div class="shop-landing-splashes col-md-12 col-sm-12">

			<div class="section-image margin-bottom col-md-12 no-padding-left no-padding-right">

				<h3 class="title-shop">
					<a href="<?php echo $landing->splash_1_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $landing->splash_1_title ?>
						</span>
						<?php if ( strlen($landing->splash_1_button_title) ): ?>
							<span class="shop-button"><?php echo $landing->splash_1_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>

				<a href="<?php echo $landing->splash_1_target_link ?>" class="">
					<?php responsive_img($landing->splash_1_image, '') ?>
				</a>

			</div>

			<div class="section-image margin-bottom col-md-6 no-padding-left">

				<h3 class="title-shop">
					<a href="<?php echo $landing->splash_2_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $landing->splash_2_title ?>
						</span>
						<?php if ( strlen($landing->splash_2_button_title) ): ?>
							<span class="shop-button"><?php echo $landing->splash_2_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>

				<a href="<?php echo $landing->splash_2_target_link ?>" class="almost-square-image">
					<?php responsive_img($landing->splash_2_image, 'fill-image') ?>
				</a>

			</div>

			<div class="section-image margin-bottom col-md-6 no-padding-right">

				<h3 class="title-shop">
					<a href="<?php echo $landing->splash_3_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $landing->splash_3_title ?>
						</span>
						<?php if ( strlen($landing->splash_3_button_title) ): ?>
							<span class="shop-button"><?php echo $landing->splash_3_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>

				<a href="<?php echo $landing->splash_3_target_link ?>" class="almost-square-image">
					<?php responsive_img($landing->splash_3_image, 'fill-image') ?>
				</a>

			</div>

			<div class="section-image col-md-12 no-padding-left no-padding-right margin-bottom">

				<h3 class="title-shop">
					<a href="<?php echo $landing->splash_4_target_link ?>" class="">
						<span class="title-shop-title">
							<?php echo $landing->splash_4_title ?>
						</span
						<?php if ( strlen($landing->splash_4_button_title) ): ?>
							<span class="shop-button"><?php echo $landing->splash_4_button_title ?></span>
						<?php endif; ?>
					</a>
				</h3>

				<a href="<?php echo $landing->splash_4_target_link ?>" class="almost-square-image">
					<?php responsive_img($landing->splash_4_image, '') ?>
				</a>

			</div>

		</div>
	</div>
	<div class="clearfix"></div>
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
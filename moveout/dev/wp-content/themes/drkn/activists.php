<?php
/*
Template Name: Activists
*/

$activists = CustomPostType::getInstance('activist')->getPosts();
$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'activists'));

?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

<section class="activist-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php foreach ( $activists as $post ): setup_postdata($post) ?>
				<div class="activist-single col-md-4">
					<div class="square-container">
						<div class="square-inner">
							<?php responsive_img( $post->activist_image, 'fill-image' ) ?>
						</div>
					</div>
					<h3 class="text-center"><?php echo the_title() ?></h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
				</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</section>

<div class="clearfix"></div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
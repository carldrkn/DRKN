<?php
/*
Template Name: Culture
*/

$tumblr_images = CustomPostType::getInstance('tumblr_post')->getPosts();
$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'culture'));


?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

	<section class="culture">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 no-padding">
					<div class="culture-images-container">
						<?php foreach ( $tumblr_images as $post ): setup_postdata($post) ?>
							<div class="culture-image col-md-3 col-sm-4 col-xs-12 no-padding">
								<?php responsive_img( $post->post_image ) ?>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="clearfix"></div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
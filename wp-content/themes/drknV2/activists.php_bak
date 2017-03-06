<?php
/*
Template Name: Activists
*/

$activists = CustomPostType::getInstance( 'activist' )->getPosts();
$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'activists'));

?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

<section class="activist-page">
	<div class="container-fluid">
		<div class="row">
			<?php foreach ( $activists as $post ) : setup_postdata( $post ); ?>
			<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
				<a href="<?php echo get_permalink( $post->ID ); ?>">
					<div class="activist-single">
						<?php
						
						$attachement = wp_get_attachment_image_src( $post->activist_image, 'army-list-size' );

						if( isset( $attachement[0] ) ) :
						?>
							<img class="img-responsive" src="<?php echo $attachement[0]; ?>" alt="<?php echo the_title(); ?>" />
						<?php else:  ?>
							<img class="img-responsive" src="<?=get_template_directory_uri().'/assets/images/no_image.jpg'?>" alt="" />
						<?php endif; ?>
						
						<div class="name-info">
							<h3><?php echo the_title() ?><span><?php echo $post->activist_subtitle; ?></span></h3>
							<p><?php echo wp_trim_words( get_the_content(), 10, '' ); ?>... <span>>></span></p>
						</div>
					</div>
				</a>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</section>

<div class="clearfix"></div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
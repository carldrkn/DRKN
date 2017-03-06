<?php
/*

*/

$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'studio'));

?>
	
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>
	<section class="culture">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 no-padding">
					<div class="culture-images-container">
						<?php while ( have_posts() ) : the_post(); $nextPost = get_previous_post(); $prevPost = get_next_post(); ?>
						<div class="studio-image col-md-3 col-sm-4 col-xs-12 no-padding">
							<a id="Ins-<?php echo the_ID(); ?>" class="culture-link" href="<?php the_permalink() ?>"
							   data-toggle="modal" data-target="#InspirationModal" data-next="<?php echo $nextPost->ID; ?>"
							   data-prev="<?php echo $prevPost->ID; ?>">
								<?php $size = get_image_size($post->post_image); ?>
								<div class="resize-area" data-width="<?php echo $size->width ?>" data-height="<?php echo $size->height ?>" >
									<?php responsive_img( $post->post_image ) ?>
								</div>
							</a>
						</div>
						<?php endwhile ?>
					</div>
				</div>
			</div>
		</div>

		<div class="previous-page">
			<?php previous_posts_link( ) ?>
		</div>
		<div class="next-page">
			<?php next_posts_link( ) ?>
		</div>

		<div class="clearfix"></div>
	</section>

	<!-- Modal -->
	<div class="modal fade" id="InspirationModal" tabindex="-1" role="dialog" aria-labelledby="InspirationModal">
		<div class="modal-dialog" role="document">
			<div class="content"></div>
		</div>
	</div>


<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>


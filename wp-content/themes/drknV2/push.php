<?php

/**
 *
 * Template Name: Push
 *
*/

	Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 

?>
	<section class="textPage">
			<div class="container-fluid">
				<div class="row">
<?php 
			if(have_posts()) {
				while(have_posts()) {
					the_post();
?>
					<div class="col-md-4 div-center">
						<h4 class="text-center"><?php the_title(); ?></h4>
						<?php the_content(); ?>
					</div>
<?php
				}
			}
?>
				</div>
			</div>
	</section>

<?php 

	Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) );
<?php

/**
 *
 * Template Name: Fail Page
 *
*/
	Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 
?>
<?php get_template_part( 'parts/shared/header' ); ?>
<?php get_template_part( 'parts/shared/header-nav-bar' ); ?>

	<section class="textPage">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
<?php 
			if(have_posts()) {
				while(have_posts()) {
					the_post();
?>
					<div class="col-md-12 text-center">
						<h1 class="text-center"><?php the_title(); ?></h1>
					</div>
					<div class="col-md-8 col-md-offset-2 div-center">
						<?php the_content(); ?>
					</div>
<?php
				}
			}
?>
			</div>
		</div>
	</div>

	</section>

<?php

	Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) );
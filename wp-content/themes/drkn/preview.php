<?php

/**
 *
 * Template Name: Preview
 *
*/

	get_template_part('parts/shared/html-header'); 

?>

	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
								
		<?php endwhile; ?>
	<?php else: ?>
		<h1>Website is temporarily closed please contact an adminstrator for this site.</h1>
	<?php endif; ?>

<?php
	get_template_part('parts/shared/html-footer');
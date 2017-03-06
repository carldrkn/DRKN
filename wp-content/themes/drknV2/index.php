<?php

/**
 * The main template file
 */

get_template_part( 'parts/shared/header' );
get_template_part( 'parts/shared/header-nav-bar' );
?>

<div class="post-single" id="post-single">
	<div class="wrapper">
		<div class="container-fluid sticky-menu">
			<div class="row">
				<div class="col-md-3 sidebar-menu col-sm-3">
					<div class="list-nav">
						<div class="nav-sticky">
							<div class="nav-sbmenu hidden-xs">
								<?php wp_nav_menu( array( 'theme_location' => 'pages-menu' ) ); ?>
							</div>
						</div>
						<div class="nav-menuselect non-product visible-xs">
							<select></select>
						</div>
					</div>
				</div>
				
				<div class="col-md-9 col-sm-9">
					<?php
					
					if( have_posts() ) :
						while( have_posts() ) :
							the_post();
					?>
							<article>
								<h2><?php the_title(); ?></h2>
								
								<?php the_content(); ?>
							</article>
					<?php
					
						endwhile;
					endif;
					?>
				</div>
			</div>
		</div>

	</div>
</div>

<?php

get_template_part( 'parts/shared/footer' );

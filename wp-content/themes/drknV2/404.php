<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php get_template_part( 'parts/shared/header' ); ?>
<?php get_template_part( 'parts/shared/header-nav-bar' ); ?>
<div class="not-found" style="background-image: url( '<?php echo get_stylesheet_directory_uri(); ?>/dist/images/static_img/sliderImg1.jpg' ); ">
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<h2>Page not found</h2>
				<p>The link you followed probably broken, or the page has been removed.<br />
				Return to the <a href="<?php echo home_url(); ?>">homepage</a>.</p>
			</div>
		</div>
	</div>
</div>

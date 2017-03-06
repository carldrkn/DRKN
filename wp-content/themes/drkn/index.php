<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */

$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'news'));

?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

<div class="container-fluid padding-top content-container">

	<?php include 'parts/news/sidebar.php'; ?>

	<div class="content has-sidebar">

		<?php if ( have_posts() ): ?>
		<ol class="col-md-10">
			<?php include 'parts/news/filter.php' ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<article class="single-article">

					<h5>
						<a href="<?php esc_url( the_permalink() ); ?>" title="Permalink to <?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h5>

					<p class="author">
						<span class="hidden-lg hidden-md"><?php the_date(); ?> /
						</span> POSTED BY DRKN
						<?php $tags = get_the_tags(); ?>
						<?php if ( $tags ) echo ' / '; ?>
						<?php foreach ( $tags ? $tags : array() as $tag ): ?>
							<a href="<?php get_tag_link($tag) ?>">
								#<?php echo $tag->name ?>
							</a>
						<?php endforeach; ?>
					</p>

					<div class="post-content">
						<?php the_content(); ?>
					</div>


					<div class="date-time hidden-sm hidden-xs" dir="rtl">
						<?php echo date('d', strtotime($post->post_date) ) ?> <br/>
						<?php echo strtoupper(date('M', strtotime($post->post_date) )) ?> <br/>
						<?php echo date('Y', strtotime($post->post_date) ) ?>
					</div>


				</article>
			</li>
		<?php endwhile; ?>
		</ol>
		<?php else: ?>
		<h2>No posts to display</h2>
		<?php endif; ?>

	</div>

</div>
<br/>
<br/>
	
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
<?php if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') : ?>
<?php

$inspiration = get_post( (int) $post->post_name );

$nextLink = '';
$prevLink = '';

if( isset( $_POST['NextID'] ) && $_POST['NextID'] ) {
	$nextLink = get_permalink( (int) $_POST['NextID'] );
}

if( isset( $_POST['PrevID'] ) && $_POST['PrevID'] ) {
	$prevLink = get_permalink( (int) $_POST['PrevID'] );
}

?>

<div class="img-container">
	
	
	<div class="spinner-container">
		<div class="sk-folding-cube">
		  <div class="sk-cube1 sk-cube"></div>
		  <div class="sk-cube2 sk-cube"></div>
		  <div class="sk-cube4 sk-cube"></div>
		  <div class="sk-cube3 sk-cube"></div>
		</div>
	</div>
	
	<div class="colored-image"><img style="display: none;" id="InspirationImage" class="img-responsive" src="<?php echo wp_get_attachment_url( $inspiration->post_image ); ?>" alt="" /></div>
	
	<?php if( $prevLink ) : ?> 
	<a href="<?php echo $prevLink; ?>" class="arrow left" data-id="<?php echo $_POST['PrevID']; ?>"><span></span></a>
	<?php endif; ?>
	
	<?php if( $nextLink ) : ?> 
	<a href="<?php echo $nextLink; ?>" class="arrow right" data-id="<?php echo $_POST['NextID']; ?>"><span></span></a>
	<?php endif; ?>
	<a href="#" class="close" data-dismiss="modal"><span></span></a>
</div>

<div class="mod-content">
	<div class="header clearfix">
		<div class="title clearfix">
			<h1><?php echo $inspiration->post_title; ?></h1>
			<time><?php echo date( 'd M Y', strtotime( $inspiration->post_date ) ); ?></time>
		</div>
		
		<div class="socials">
			<ul>
<!--				<li class="social-mail"><a href="#">mail</a></li>
				<li class="social-facebook"><a href="#">facebook</a></li>
				<li class="social-twitter"><a href="#">twitter</a></li>
				<li class="social-googleplus"><a href="#">google plus</a></li>
				<li class="social-tumblr"><a href="#">tumblr</a></li>
				<li class="social-pinterest"><a href="#">pinterest</a></li>-->
				<li class="social-facebook"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink( $inspiration->ID ) ); ?>"></a></li>
				<li class="social-twitter"><a target="_blank" href="http://twitter.com/intent/tweet?text=<?php echo urlencode( $inspiration->post_title ); ?>&amp;url=<?php echo urlencode( get_permalink( $inspiration->ID ) ); ?>"></a></li>
				<li class="social-tumblr"><a target="_blank" href="http://wearedrkn.tumblr.com/post/<?php echo $inspiration->tumblr_id?>"></a></li>
			</ul>
		</div>
	</div>
	
	<p><?php echo $inspiration->post_text; ?></p>
</div>
<?php else: ?>

<?php $banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'culture')); ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php include 'parts/shared/banner.php'; ?>

<?php while ( have_posts() ) : the_post(); ?>
<div class="single-culture-image">
	<div class="col-md-12">
		<div class="col-md-12">
			<?php $size = get_image_size($post->post_image); ?>
			<div class="resize-area" data-width="2" data-height="1" >
				<?php responsive_img( $post->post_image, 'center-image' ) ?>
			</div>
		</div>
		<div class="clear-both"></div>
		<ul class="social-big">
			<li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php urlencode(the_permalink()); ?>"></a></li>
			<li><a target="_blank" href="http://twitter.com/intent/tweet?text=<?php urlencode(the_title()); ?>&amp;url=<?php urlencode(the_permalink()); ?>"></a></li>
			<li><a target="_blank" href="http://wearedrkn.tumblr.com/post/<?php echo $post->tumblr_id?>"></a></li>
		</ul>
	</div>
	<div class="clear-both"></div>
</div>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>
<?php endif;
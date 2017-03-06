<?php

/**
 *
 * Product pages from Silk.
 *
*/

	Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) );

	$num_pages = $wp_query->max_num_pages;
	$current_page = get_query_var('paged') ? get_query_var('paged') : 1;
	$breadcrumbs = EscCategory::getBreadcrumbs();

	$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'shop'));

	$fullUri = end($breadcrumbs);
?>

	<?php include 'parts/shared/banner.php'; ?>

<div class="nosto_category" style="display:none"><?php echo $fullUri['uri']; ?></div>
<div class="content-container">

	<div class="clearfix"></div>

	<?php /* include 'parts/shop/sidebar.php'; */ ?>

	<div class="content">

		<section class="product-list shop-page col-md-12 col-sm-12">
				<div class="container-fluid">
					<div class="row">

						<div class="product-top-navigation">
							<div class="breadcrumbs">

								<br/>
								<br/>
								<div class="first padding-left-5">
	<?php
								foreach ($breadcrumbs as $key => $crumb) {
									if( ! empty($crumb['url']) ) {
										echo '<a href="' . $crumb['url'] . '">' . $crumb['name'] . '</a>';
										if(!isset($crumb['last'])) echo ' / ';
									}
								}
	?>
								</div>
								<div class="second">
	<?php
								if($num_pages > 1) {
									for ($i=1; $i <= $num_pages; $i++) {
										echo '<a href="' . get_pagenum_link($i) . '"' . ($i == $current_page ? ' class="active"':'') . '>' . $i . '</a>';
									}
								}
	?>
								</div>
							</div>
							<div class="clearfix"></div>
							<?php include 'parts/shop/filter.php' ?>
						</div>
						<div class="clearfix"></div>
						<div class="products">
							<?php
							while(have_posts()) {
								the_post();
								if( isset( $post->ID ) && $post->ID != null ) {
									include 'parts/shared/product.php';
								}
							}
							?>
						</div>
					</div>
	<?php
			if($num_pages > 1) {
	?>
					<ul class="paging">
	<?php
				if($current_page !== 1) {
	?>
						<li><a class="u-mainButton" href="<?php echo get_previous_posts_page_link(); ?>"><span>Previous</span></a></li>
	<?php
				}
				if($current_page != $num_pages) {
	?>
						<li><a class="u-mainButton" href="<?php echo get_next_posts_page_link(); ?>"><span>Next</span></a></li>
	<?php
				}
	?>
					</ul>
	<?php
			}
	?>
				</div>
			</section>

			<div class="clearfix"></div>
		</div>

</div>

<?php

	Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) );

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

?>

	<?php include 'parts/shared/banner.php'; ?>

<div class="content-container">

	<div class="clearfix"></div>

	<?php include 'parts/shop/sidebar.php'; ?>

	<div class="content has-sidebar">

		<section class="product-list shop-page col-md-10 col-sm-10">
				<div class="container-fluid">
					<div class="row">

						<div class="product-top-navigation">
							<div class="breadcrumbs">

								<br/>
								<br/>
								<div class="first padding-left-5">
	<?php
								foreach ($breadcrumbs as $key => $crumb) {
									echo '<a href="' . $crumb['url'] . '">' . $crumb['name'] . '</a>';
									if(!isset($crumb['last'])) echo ' / ';
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
							<div class="filter-search hidden-md hidden-sm hidden-lg">

								<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
									<div class="select-container" data-title="A title">
										<select class="inverted">
											<option value="*">COLLECTION</option>
										<?php foreach ( $master_categories as $category ) if ( $category->slug != 'all' ): ?>
											<option value="<?php echo get_category_link($category) ?>">
												<?php echo $category->name ?>
											</option>
										<?php endif; ?>
										</select>
									</div>
								</div>
								<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
									<div class="select-container" data-title="A title">
										<select class="inverted">
											<option value="*">TYPE</option>
										<?php foreach ( $subcategories as $category ): ?>
											<option value="<?php echo get_category_link($category) ?>">
												<?php echo $category->name ?>
											</option>
										<?php endforeach; ?>
										</select>
									</div>
								</div>
								<?php /*
								<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
									<div class="select-container" data-title="A title">
										<select class="inverted">
											<option value="*">COLOR</option>
											<option value="hurr">Durr</option>
										</select>
									</div>
								</div>
								<div class="select-option col-md-2 col-sm-3 col-xs-6 no-padding-right">
									<div class="select-container" data-title="A title">
										<select class="inverted">
											<option value="*">SIZE</option>
											<option value="hurr">Durr</option>
										</select>
									</div>
								</div>
 								*/ ?>

							</div>
						</div>
						<div class="clearfix"></div>
						<div class="products">
							<?php
							while(have_posts()) {
								the_post();
								include 'parts/shared/product.php';
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
						<li><a href="<?php echo get_previous_posts_page_link(); ?>">Previous</a></li>
	<?php
				}
				if($current_page != $num_pages) {
	?>
						<li><a href="<?php echo get_next_posts_page_link(); ?>">Next</a></li>
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

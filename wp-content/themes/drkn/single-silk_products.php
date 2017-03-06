<?php

/**
 *
 * Product pages from Silk.
 *
*/

	Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 

	$product = new EscProduct($post->ID);

	$product->getProductImages();
	$breadcrumbs = EscProduct::getBreadcrumbs();
	//Don't require product uri
	array_pop($breadcrumbs);
	// Remove frontpage
	array_shift($breadcrumbs);
	//Remove "product" which doesn't lead anywhere
	array_shift($breadcrumbs);


	$attachments = get_post_meta( $post->ID, 'attachment_ids', true );
	if ( !$attachments ) {
		$attachments = array();
	} else {
		$nosto_img = wp_get_attachment_image_src( $attachments[0], 'drkn_300' );
	}

	$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'shop'));

?>

		<?php include 'parts/shared/banner.php'; ?>

		<div class="nosto_product" style="display:none">
			<span class="url"><?php the_permalink(); ?></span>
			<span class="product_id"><?php echo (isset($product->product_meta['sku']) ? $product->product_meta['sku'] : '') ?></span>
			<span class="name"><?php echo (isset($product->product_meta['name']) ? $product->product_meta['name'] : '') ?></span>
			<span class="image_url"><?php echo (isset($nosto_img) ? $nosto_img[0] : '') ?></span>
			<?php
			$pricelists = $product->getAllPricelists();
			$first = true;
			foreach ($pricelists as $pl_key => $pl) {
				if(!$first) {
					echo '<div class="variation">';
				}
			?>
				<span class="variation_id"><?php echo (isset($pl['name']) ? $pl['name'] : '') ?></span>
				<span class="price"><?php echo (isset($pl['priceAsNumber']) ? $pl['priceAsNumber'] : '') ?></span>
				<span class="list_price"><?php echo (isset($pl['priceBeforeDiscountAsNumber']) ? $pl['priceBeforeDiscountAsNumber'] : '') ?></span>
				<span class="price_currency_code"><?php echo (isset($pl['name']) ? $pl['name'] : '') ?></span>
				<span class="availability"><?php echo (EscGeneral::isAvailable($post->ID) ? 'InStock' : 'OutOfStock') ?></span>

			<?php
				if(!$first) {
					echo '</div>';
				}
				$first = false;
			}

			foreach ($product->product_meta['categories'] as $category) {
				echo '<span class="category">/shop/' . $category['uri'] . '</span>';
			}
			?>
			<!-- Optional properties -->
			<span class="description"><?php echo get_the_excerpt(); ?></span>
		</div>

		<section id="js-product" class="shop-product">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-9 div-center no-padding">

						<div class="breadcrumbs hidden-lg hidden-md">
							<p class="no-margin"><?php
								foreach ($breadcrumbs as $key => $crumb) {
									echo '<a href="' . $crumb['url'] . '">' . $crumb['name'] . '</a>';
									if(!isset($crumb['sec_last'])) echo ' / ';
								}
							?></p>
						</div>

			<?php 
			if(have_posts()) {
				while(have_posts()) {
					the_post();

			?>

					<div class="big-image"></div>
					<div class="col-md-6">
						<div class="product-image">
							<?php if ( isset($attachments[0]) && $attachment_id = $attachments[0] ): ?>
								<?php responsive_img($attachment_id,'',true); ?>
							<?php endif; ?>
						</div>
						<!-- <div class="shareProduct">
							<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php urlencode(the_permalink()); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/facebook_share.png" alt=""></a>
							<a target="_blank" href="http://twitter.com/intent/tweet?text=<?php urlencode(the_title()); ?>&amp;url=<?php urlencode(the_permalink()); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/twitter_share.png" alt=""></a>
						</div> -->

						<div class="thumb-outer">
							<div class="thumb-holder">
								<ul class="thumbnails">
									<?php if ( count($attachments) > 1 ): ?>
									<?php foreach ( $attachments as $attachment_id ): ?>
										<li class="product-thumnbail">
											<?php responsive_img($attachment_id,'','thumb'); ?>
										</li>
									<?php endforeach; ?>
									<?php endif; ?>
								</ul>
							</div>
							<a href="#" class="nav-left"></a>
							<a href="#" class="nav-right"></a>
						</div>
						

						</div>
						<div class="col-md-6">
							<br/>
							<br/>
							<div class="product-inner">
								<div class="breadcrumbs no-margin hidden-sm hidden-xs">
									<p class="no-margin"><?php
									foreach ($breadcrumbs as $key => $crumb) {
										echo '<a href="' . $crumb['url'] . '">' . $crumb['name'] . '</a>';
										if(!isset($crumb['sec_last'])) echo ' / ';
									}
								?></p>
								</div>

								<div class="product-header row">
									<div class="col-xs-7"><h5 class="black selected-product-title"><?php the_title(); ?></h5></div>
									<div class="col-xs-5"><h5 class="black selected-product-price"><?php get_template_part('parts/shop/price'); ?></h5></div>

									<div id="js-productPurchase" class="col-xs-12 js-productPurchase clearfix">
									<?php
										get_template_part('parts/shop/product-purchase');
									?>
									</div>
								</div>

								<div class="post-content">
									<?php the_content(); ?>
								</div>
							</div>
							<div class="product-description-bottom">
							<?php

							$product_meta = $product->product_meta;
							if($product_meta['measurementChart'] != 0) {
								$chart_info = EscProduct::getMeasurementChart($product_meta['measurementChart']);
								$conversion_info = EscProduct::getMeasurementChart(5);
							?>							
								<div class="wrap-size-guide float-left">
									<a href="" class="policy" id="size-guide-button">Size guide</a>		
									<div class="size-guide">
										<div class="inner-size-guide">
											<p>SIZE GUIDE</p>
											<table style="width:100%">
												<thead>
													<tr>
														<th>PRODUCT MEASUREMENTS</th>
													<?php
													for ($i=0; $i < count($chart_info['columnNames']); $i++) { 
														echo '<th>' . $chart_info['columnNames'][$i] . '</th>';
													}
													?>
													</tr>
												</thead>
												<tbody>
													<tr class="dark">
													<?php
													for ($i=0; $i < count($chart_info['columnNames']); $i++) { 
														if($i === 0) echo '<th>' . $chart_info['name'] . '</th>';
														echo '<th></th>';
													}
													?>													
													</tr>
													<?php
													foreach ($chart_info['rows'] as $chart_name => $chart_row) {
													?>
													<tr>
														<th><?php echo $chart_name; ?></th>
														<?php
														foreach ($chart_row as $chart_item) {
														?>
														<th><?php echo $chart_item; ?></th>
														<?php
														}
														?>
													</tr>
													<?php
													}
													?>
												</tbody>
											</table>
											<p class="small-p">
												Body length measured from collar to bottom her in the back <br>
												Chest width measured around, you guessed it, the chest <br>
												Sleeve length measured from shoulder point to sleeve hem
											</p>
											<table style="width:100%">
												<thead>
													<tr>
													<?php
													for ($i=0; $i < count($conversion_info['columnNames']); $i++) {
														if($i === 0) echo '<th>' . $conversion_info['name'] . '</th>';
														echo '<th>' . $conversion_info['columnNames'][$i] . '</th>';
													}
													?>
													</tr>
												</thead>
												<tbody>
													<?php
													foreach ($conversion_info['rows'] as $conversion_name => $conversion_row) {
													?>
													<tr>
														<th><?php echo $conversion_name; ?></th>
														<?php
														foreach ($conversion_row as $conversion_item) {
														?>
														<th><?php echo $conversion_item; ?></th>
														<?php
														}
														?>
													</tr>
													<?php
													}
													?>
												</tbody>
											</table>
											<p class="small-p no-border">All measurements in centimeters.</p>
										</div>

										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pop-arrow2.png" class="pop-arrow2 hidden-sm hidden-xs">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pop-arrow3.png" class="pop-arrow3 hidden-lg hidden-md">
									</div>
								</div>
							<?php
							}
							?>
							
								<a href="<?php echo get_permalink(get_page_by_path('returns')); ?>" class="policy">Return Policy</a>
								<a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>" class="terms">Terms & Conditions</a>
							</div>

							<div class="socials">
								<ul>
									<li class="social-mail"><a href="#">mail</a></li>
									<li class="social-facebook"><a href="http://www.facebook.com/sharer.php?u=<?php urlencode(the_permalink()); ?>">facebook</a></li>
									<li class="social-twitter"><a href="http://twitter.com/intent/tweet?text=<?php urlencode(the_title()); ?>&amp;url=<?php urlencode(the_permalink()); ?>">twitter</a></li>
									<li class="social-googleplus"><a href="#">google plus</a></li>
									<li class="social-tumblr"><a href="#">tumblr</a></li>
									<li class="social-pinterest"><a href="#">pinterest</a></li>
								</ul>
							</div>
							<?php
								/*<ul class="social-medium">
								<li><a target="_blank" href=""></a></li>
								<li><a target="_blank" href=""></a></li>
								<li><a href=""></a></li>
								<li><a href=""></a></li>
							</ul>*/
							?>

						</div>
					</div>
		<?php

			}
		}

		?>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-9 div-center no-padding">
						<div class="nosto_element" id="nosto-product-list-responsive"></div>
					</div>
				</div>
			</div>
		</section>

		<div class="clearfix"></div>

	<?php 

	Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) );
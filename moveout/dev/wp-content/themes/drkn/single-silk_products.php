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

	$attachments = get_post_meta( $post->ID, 'attachment_ids', true );
	if ( !$attachments )
		$attachments = array();

	$banner = CustomPostType::getInstance('banner')->getPost(array('displayed_in' => 'shop'));
	
?>

		<?php include 'parts/shared/banner.php'; ?>

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
								<?php responsive_img($attachment_id); ?>
							<?php endif; ?>
						</div>
						<?php /*
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/product.jpg" class="full-image div-center">
						*/ ?>
						<ul class="thumbnails">
							<?php foreach ( $attachments as $attachment_id ): ?>
								<li class="col-md-3 col-sm-3 col-xs-3 product-thumnbail">
									<?php responsive_img($attachment_id); ?>
								</li>
							<?php endforeach; ?>
							<?php /*
							<li class="col-md-3 col-sm-3 col-xs-3"><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/product-thumb.jpg" class="full-image"></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/product-thumb.jpg" class="full-image"></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/product-thumb.jpg" class="full-image"></a></li>
							<li class="col-md-3 col-sm-3 col-xs-3"><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/product-thumb.jpg" class="full-image"></a></li>
 							*/ ?>
						</ul>

						</div>
						<div class="col-md-6">
							<br/>
							<br/>
							<div class="breadcrumbs no-margin hidden-sm hidden-xs">
								<p class="no-margin"><?php
								foreach ($breadcrumbs as $key => $crumb) {
									echo '<a href="' . $crumb['url'] . '">' . $crumb['name'] . '</a>';
									if(!isset($crumb['sec_last'])) echo ' / ';
								}
							?></p>
							</div>

							<h5 class="black"><?php the_title(); ?> <span class="float-right"><?php get_template_part('parts/shop/price'); ?></span></h5>

							<div class="post-content">
								<?php the_content(); ?>
							</div>

<?php
							$product->renderStartPurchaseForm();
?>
							<ul id="js-productSizes" class="sizes">
<?php
								$product->renderSizesLoop('<li class="{selectedClass}{disabledClass}"><label for="{id}"><input id="{id}" type="radio" {disabled}name="{selector}" {selected}value="{value}">{name}</label></li>');
?>
							</ul>	
							<div class="wrap-buy-button">
								<button id="js-submitPurchase" class="u-mainButton buy" data-hover-text="Choose Size" data-orig-text="Buy" data-co-text="Go To Checkout" type="submit"><span>BUY</span></button>
							</div>
<?php

							$product->renderEndPurchaseForm();

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
							
							<a href="<?php echo get_permalink(get_page_by_path('returns')); ?>" class="policy">Read our return policy</a>
							<a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>" class="terms">Terms & Conditions</a>


							<ul class="social-medium">
								<li><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php urlencode(the_permalink()); ?>"></a></li>
								<li><a target="_blank" href="http://twitter.com/intent/tweet?text=<?php urlencode(the_title()); ?>&amp;url=<?php urlencode(the_permalink()); ?>"></a></li>
<?php
								/*<li><a href=""></a></li>
								<li><a href=""></a></li>*/
?>
							</ul>

						</div>
					</div>
<?php

			}
		}

?>
				</div>
			</div>
		</section>

		<div class="clearfix"></div>

<?php 

	Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) );
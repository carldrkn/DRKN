<?php

$product = new EscProduct($post->ID);

/**
 *
 * Product pages from Silk.
 *
 */

$attachments = get_post_meta( $post->ID, 'attachment_ids', true );
if ( !$attachments ) {
	$attachments = array();
} else {
	$nosto_img = wp_get_attachment_image_src( $attachments[0], 'drkn_300' );
}

function get_related_products($related_ids) {

	global $wpdb;

	$product_ids = implode(',',$related_ids);

	$related_product_data = array();

	$related_products = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'product_id' AND  meta_value IN ($product_ids)", ARRAY_A);

	if( ! empty( $related_products ) && is_array( $related_products ) ) {
		foreach( $related_products as $related_product ) {
			$related_product_data[] = new EscProduct($related_product['post_id']);
		}
	}

	return $related_product_data;

}

?>
<?php get_template_part( 'parts/shared/header' ); ?>
<?php get_template_part( 'parts/shared/header-nav-bar' ); ?>
<div class="nosto_product" style="display:none">
	<span class="url"><?php the_permalink(); ?></span>
	<span class="product_id"><?php echo (isset($product->product_meta['sku']) ? $product->product_meta['sku'] : '') ?></span>
	<span class="name"><?php echo (isset($product->product_meta['name']) ? $product->product_meta['name'] : '') ?></span>
	<span class="image_url"><?php echo (isset($nosto_img) ? $nosto_img[0] : '') ?></span>
	<?php

	if( ! empty( $product->product_meta['relatedProducts'] ) ) {

		$related_ids = array();

		foreach( $product->product_meta['relatedProducts'] as $related ) {
			$related_ids[] = $related['product'];
		}

		$related_products = get_related_products($related_ids);

	}

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
<div id="sel-prod" class="wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3 col-sm-3 product-sidemenu">
				<div class="cat-nav">
					<div class="nav-sbmenu hidden-xs">
						<?php wp_nav_menu( array( 'theme_location' => 'sidebar-menu' ) ); ?>
					</div>
					<div class="nav-menuselect visible-xs">
						<select></select>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-sm-9 product-selected">
				<div class="row">
					<div class="col-md-8">
						<div class="item-pop">
							<div class="slide-desktop hidden-xs">
								<?php if ( count($attachments) > 0 ): ?>
									<?php foreach ( $attachments as $attachment_id ): ?>
										<div class="swiper-slide">
											<a href="<?php echo wp_get_attachment_image_src( $attachment_id, 'original' )[0]; ?>" class="prod-item swipebox">
												<img class="img-responsive" src="<?php echo wp_get_attachment_image_src( $attachment_id, 'drkn_1000' )[0]; ?>" alt="" />
											</a>
										</div>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
							<div class="swiper-container visible-xs"></div>
						</div>
					</div>
					<div class="col-md-4 psc-selected">
						<div class="content">
							<div class="psc-pin">
								<h1><?php echo (isset($product->product_meta['name']) ? $product->product_meta['name'] : '') ?></h1>

								<div class="price"><?php get_template_part('parts/shop/price'); ?></div>

								<?php

								$product_meta = $product->product_meta;

								?>

								<p><?php echo $product_meta['excerpt'] ?></p>


								<a href="#js-details" data-toggle="collapse" class="arr call">Details</a>

								<div id="js-details" class="c-content collapse">
									<p>
										<?php echo $product_meta['description'] ?>
									</p>
								</div>



								<?php

								$product_meta = $product->product_meta;
								if($product_meta['measurementChart'] != 0) {
									$chart_info = EscProduct::getMeasurementChart($product_meta['measurementChart']);
									$conversion_info = EscProduct::getMeasurementChart(5);
									?>

									<h2>
										<a href="#js-size-guide" data-toggle="collapse" class="arr call">Size Guide</a>
									</h2>

									<div id="js-size-guide" class="c-content collapse">
										<p>&nbsp;</p>
										<table style="width:100%">
											<thead>

											<tr>
												<th><?php echo  $chart_info['name'] ?></th>
												<?php
												for ($i=0; $i < count($chart_info['columnNames']); $i++) {
													echo '<th>' . $chart_info['columnNames'][$i] . '</th>';
												}
												?>
											</tr>
											</thead>
											<tbody>
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
										<p>&nbsp;</p>
										<p>
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

									<?php
								}
								?>



								<h2 class="arr">Color</h2>
								<ul class="color-list">
									<li><a href="" class="active"><?php echo $product_meta['swatch']['desc'] ?></a></li>

									<?php
									if( ! empty($related_products) ) {

										foreach( $related_products as $related_product ) {

											echo '<li><a href="' . $related_product->product_meta['canonicalUri'] . '">' . $related_product->product_meta['swatch']['desc'] . '</a></li>';

										}

									}

									?>
								</ul>

								<?php if(count($product->product_meta['items']) > 1) : ?>
									<h2 class="arr">Choose Size</h2>
								<?php endif; ?>

								<?php
								get_template_part('parts/shop/product-purchase');

								if(!empty( $product_meta['type'] ) && $product_meta['type'] == 'patchable' ) {

									get_template_part('parts/shop/patch-pack');

								}
								?>
							</div> <!-- /.psc-pin -->
						</div>
					</div>
				</div>
			</div><!-- /.product-selected -->
		</div>
	</div>
</div><!-- /.wrapper -->

<?php get_template_part( 'parts/shared/footer' ); ?>

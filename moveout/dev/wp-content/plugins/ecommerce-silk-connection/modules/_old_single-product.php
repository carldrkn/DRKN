<?
	function init_product($product) {
		
		$jsonParams = json_decode(get_post_meta( $product->ID, 'json', true ), true);
	
		$hasSubscription = $jsonParams['subscription'];

		$availability = esc_get_availability($jsonParams);
		if(empty($availability)) return;

?>		
	<div class="row">
		<div id="main-prod-cont" class="col-md-4">
			<ul class="ul-clean main-prod-images">
<?
			$first = true;
			foreach ($jsonParams['media'] as $media_key => $media) {
?>
				<li<?=($first?' class="current"':'')?>><img src="<?=$media['sources']['litomove-big']['url']?>" alt="" /></li>
<?				
				$first = false;
			}	
?>
			</ul>
		</div>
		<div class="col-md-8">
			<div class="single-product-info product-info">
				<div class="product-text">
					<h2><?=the_title()?></h2>
					<div class="price"><?=($availability['price']?$availability['price']:'')?></div>
<?						
			if($availability['stock'] && $availability['price']) {
				//Add to selection functionality
				$item = reset($jsonParams['items']);
				echo esc_add_to_selection($product->ID, $item['item'], $hasSubscription);
			}
?>
					<?=the_content()?>
				</div>

			</div>
		</div>
	</div>
		
<?
		dynamic_sidebar('silk-product-page');
?>
		<h2 class="spacing">Våra Andra Produkter</h2>
		<ul class="inline-list related-prods">
<?
		$args = array( 'post_type' => 'silk_products', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args );

		while ($loop->have_posts()) {
			$loop->the_post();
			if($loop->post->post_name === 'retrieve-prods') continue;
			if($product->ID === $loop->post->ID) continue;

			$jsonParams = json_decode(get_post_meta( $loop->post->ID, 'json', true ), true);
			$img = $jsonParams['media'][0]['sources']['litomove-listing'];
			
			$availability = esc_get_availability($jsonParams);
			if(empty($availability)) continue;

		  ?><li>
				<a href="<?=the_permalink()?>" class="product-images">
					<img src="<?=$img['url']?>" width="160" height="169" />
					<h4><?=the_title()?></h4>
					<p class="price"><?=($availability['price']?$availability['price']:'')?></p>
				</a>
			</li><?

		}
?>
		</ul>
<?
	}
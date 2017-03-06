<?

	function init_selection($ajax = false) {
		
		$selection_is_set = false;
		$items = array();
		$posts = array();
		$totals = array();

		esc_create_selection();

/*

		if(isset($_SESSION['silk_store']['selection_id'])) {
			$selection_is_set = true;
			$items = $_SESSION['selection']['items'];
			$posts = $_SESSION['wp_selection'];
			$totals = $_SESSION['selection']['totals'];
		}

		ob_start();

?>
		<?=(!$ajax?'<div class="selection-menu" id="selection">':'')?>
			<a href="/kassa" class="sub-menu-heading"><?=($selection_is_set?'<span class="selection-count">'.$totals['totalQuantity'].' Produkt'.($totals['totalQuantity']>1?'er':'').'</span>':'<span class="selection-count">0 Produkter</span>')?><span class="selection-item"></span></a>
			<div class="under-menu">
				<ul class="ul-clean shopping-list">
<?				
				foreach ($items as $item) {
					//Retrieve post info
					$post_id = $posts[$item['item']]['post_id'];
					$post_data = get_post($post_id,'ARRAY_A');
					$meta_data = json_decode(get_post_meta($post_id, 'json', true ), true);
					$media = $meta_data['media'][0]['sources']['litomove-small'];
?>
					<li>
						<a href="<?php the_field('page_category', $post_id);?>#product-<?=$post_id?>">
							<img height="100" width="95" alt="" src="<?=$media['url']?>" /><div class="prod-info">
								<span><?=$post_data['post_title']?><br><strong><?=$item['quantity']?> x <?=$item['priceEach']?></strong></span>
							</div>
						</a>
					</li>
<?
				}
?>
				</ul>
				<a class="button button-full" href="/kassa">Till Kassan</a>
			</div>
		<?=(!$ajax?'</div>':'')?>
<?
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
*/
	}
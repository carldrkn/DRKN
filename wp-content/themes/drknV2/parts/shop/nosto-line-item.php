<?php

	$selection = EscGeneral::getSelection();
	$priceListName = EscGeneral::getCurrentPricelistName();

	if(isset($selection['items'])) {
		foreach($selection['items'] as $key => $item) {
?>
	<div class="line_item">
		<span class="product_id"><?php echo rtrim($item['sku'], $item['size']); ?></span>
		<span class="quantity"><?php echo $item['quantity']; ?></span>
		<span class="name"><?php echo (isset($item['name']) ? $item['name'] : isset($item['productName']) ? $item['productName'] : ''); ?></span>
		<span class="unit_price"><?php echo $item['priceEachAsNumber']; ?></span>
		<span class="price_currency_code"><?php echo $priceListName; ?></span>
	</div>

<?php
	
		}
	}
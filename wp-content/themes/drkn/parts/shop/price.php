<?php
	
	$price_data = EscGeneral::getPrice($post->ID);

	if($price_data['success']) {

		if($price_data['info']['showAsOnSale']) {
			$percent_off = isset($price_data['info']['discountPercent']) && !empty($price_data['info']['discountPercent']) ? ' (' . $price_data['info']['discountPercent'] . '% Off)' : '';

		//On Sale
		?><s><?php echo $price_data['info']['priceBeforeDiscount']; ?></s> <span class="sale-product"><?php echo $price_data['info']['price']; ?></span><span class="sale-percent"><?php echo $percent_off; ?></span><?php 

		} else if($price_data['info']['newProduct']) {

		//New product
		?><span class="new-product"><strong>New!</strong> <?php echo $price_data['info']['price']; ?></span><?php

		} else {

			//Normal
			echo $price_data['info']['price'];
	
		}
	}
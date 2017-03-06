<?php
	
	$price_data = EscGeneral::getPrice($post->ID);

	if($price_data['success']) {

		if($price_data['info']['showAsOnSale']) {

		//On Sale
		?><s><?php echo $price_data['info']['priceBeforeDiscount']; ?></s> <?php echo $price_data['info']['price']; 

		} else if($price_data['info']['newProduct']) {

		//New product
		?><span class="new-product"><strong>New!</strong> <?php echo $price_data['info']['price']; ?></span><?php

		} else {

			//Normal
			echo $price_data['info']['price'];
	
		}
	}
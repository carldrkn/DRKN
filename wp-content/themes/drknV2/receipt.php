<?php

/**
 *
 * Template Name: Receipt
 *
*/
	$success = new EscSuccess();
	$receipt_info = $success->getReceiptInfo();
	add_action('wp_head', array($success, 'conversionScriptGTM'));

	Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) );

?>
<?php get_template_part( 'parts/shared/header' ); ?>
<?php get_template_part( 'parts/shared/header-nav-bar' ); ?>
	<section class="checkout">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 text-center">
						<h1>Receipt</h1>
					</div>
				</div>
				<div class="row">
<?php 
			if(isset($receipt_info['code']) && $receipt_info['code'] == 'COUNTRY_MISMATCH') {
?>
				<div class="col-md-8 col-md-offset-2 div-center">
					<h4 class="text-center">Your pamyent country is not correct</h4>
					<p>You are trying to purchase products in the wrong country. Please go back to the checkout and choose the country that matches your payment information.</p>
				</div>				
<?php
			} else if(isset($receipt_info['errors'])) {
?>
				<div class="col-md-8 col-md-offset-2 div-center">
					<h4 class="text-center">An error has occurred</h4>
					<p>If you have placed an order and refreshed the page then your order is complete and you should recieve an email shortly with your receipt.</p>
					<p>If you have come here without seeing first your receipt contact customer service to ensure your purchase has been received.</p>
				</div>
<?php	
			}	else if(isset($receipt_info['paymentMethodData']['snippet'])) {

					//Successful klarna checkout selection
?>
				<div class="col-md-8 col-md-offset-2 div-center">
					<h4 class="text-center">ORDER</h4>
					<div class="nosto_purchase_order" style="display:none">
						<span class="order_number"><?php echo $receipt_info['order']; ?></span>
						<div class="buyer">
							<span class="email"><?php echo $receipt_info['address']['email']; ?></span>
							<span class="first_name"><?php echo $receipt_info['address']['firstName']; ?></span>
							<span class="last_name"><?php echo $receipt_info['address']['lastName']; ?></span>
						</div>
						<div class="purchased_items">
							<?php get_template_part('parts/shop/nosto-line-item'); ?>
						</div>
					</div>
					<div class="post-content">
<?php
					//Echo out klara checkout
					echo $receipt_info['paymentMethodData']['snippet'];
?>
					</div>
				</div>
<?php
				EscSuccess::clearSession();

			} else if(have_posts()) {
				while(have_posts()) {
					the_post();
?>
					<div class="col-md-8 col-md-offset-2 div-center">
						<h4 class="text-center">ORDER</h4>

						<div class="post-content">
							<?php the_content(); ?>
						</div>

						<h5>ORDER SPECS</h5>

						<div class="nosto_purchase_order" style="display:none">
							<span class="order_number"><?php echo $receipt_info['order']; ?></span>
							<div class="buyer">
								<span class="email"><?php echo $receipt_info['address']['email']; ?></span>
								<span class="first_name"><?php echo $receipt_info['address']['firstName']; ?></span>
								<span class="last_name"><?php echo $receipt_info['address']['lastName']; ?></span>
							</div>
							<div class="purchased_items">
								<?php get_template_part('parts/shop/nosto-line-item'); ?>
							</div>
						</div>

						<div class="wrap-confirmation">
							<table style="width: 100%">
								<tbody class="first">
									<?php get_template_part('parts/shop/receipt-selection'); ?>
								</tbody>
								<tbody id="selectedTotals" class="second">
									<tr>
										<td colspan="2">
											<p>
												Shipping:
											</p>
										</td>
										<td colspan="2">
											<p class="text-right">
												<?php echo $receipt_info['totals']['shippingPrice']; ?>
											</p>
										</td>
									</tr>

									<tr class="totals-row">
										<td colspan="2">
											<p>
												Total:
											</p>
										</td>
										<td colspan="2">
											<p class="text-right">
												<?php echo $receipt_info['totals']['grandTotalPrice']; ?>
											</p>
										</td>
									</tr>
								</tbody>
								<tbody class="third">
									<tr>
										<td colspan="2">
											<p>
												E-mail: <br/>
												<?php echo $receipt_info['address']['email'] ?>
											</p>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="fourth">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p>Billing address</p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p>Shipping address</p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['address']['firstName'] . ' ' . $receipt_info['address']['lastName'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['shippingAddress']['firstName'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['address']['address1'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['shippingAddress']['address1'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['address']['zipCode'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['shippingAddress']['zipCode'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['address']['city'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['shippingAddress']['city'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['address']['country'] ?></p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['shippingAddress']['country'] ?></p>
								</div>
							</div>
						</div>



						<div class="wrap-confirmation" style="display: none;">
							
							<div class="first">
								<div class="col-md-6 col-sm-6 col-xs-6"><p>Item</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-center">Size</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-center">Price</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-right">Subtotal</p></div>

								<?php get_template_part('parts/shop/checkout-selection'); ?>
							</div>
							<div class="second">
								<div class="col-md-6 col-sm-6 col-xs-6"><p>Shipping:</p></div>
								<div class="col-md-6"><p class="text-right"></p></div>
								<div class="col-md-6"><p>Total:</p></div>
								<div class="col-md-6"><p class="total-price text-right"><?php echo $receipt_info['totals']['grandTotalPrice']; ?></p></div>
							</div>

							<div class="third">
								<div class="col-md-12"><p>E-mail</p></div>
								<div class="col-md-12"><p></p></div>
							</div>


						</div>

						<a style="display: none;" id="print" class="u-mainButton" type="submit"><span>Print Receipt</span></a>

					</div>

<?php 
				}

				EscSuccess::clearSession();
			}
?>
				</div>
			</div>
			<div>
		</section>

		<div class="clearfix"></div>


<?php 
/*
// Google analytics create transaction
$error = isset($receipt_info['code']) && $receipt_info['code'] == 'COUNTRY_MISMATCH';
$error = $error || isset($receipt_info['errors']);
?>
<?php if ( !$error ): ?>
	<?php $order = (object) $receipt_info ?>
	<?php $order->totals = (object) $order->totals ?>
	<script>
		ga('require', 'ecommerce');

		ga('ecommerce:addTransaction', <?php echo json_encode(array(
			'id' =>	$order->order,
			'affiliation' => 'DRKN',
			'revenue' => $order->totals->grandTotalPriceAsNumber,
			'tax' => $order->totals->grandTotalPriceTaxAsNumber,
			'shipping' => $order->totals->shippingPriceAsNumber,
			'currency' => $order->currency
		)); ?>);

		<?php foreach ($order->items as $item ): $item = (object) $item; ?>
		ga('ecommerce:addItem', <?php echo json_encode(array(
			'id' =>	$order->order,
			'name' => $item->productName,
			'sku' => $item->sku,
			//'category' => UNAVAILABLE,
			'price' => $item->priceEachAsNumber,
			'quantity' => $item->quantity
		)); ?>);
		<?php endforeach ?>

		ga('ecommerce:send');
	</script>
<?php 

endif; 

*/ ?>


<?php 

	Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) );

	/*
	[email] => richard@coalescecreate.com
	[firstName] => Richard
	[lastName] => Herries
	[company] => asdjfhaskjdfh
	[address1] => sadjfhksjh
	[address2] => 
	[zipCode] => asdjkfhsadkjh
	[city] => sadjfhsakjdhf
	[state] => 
	[country] => SE
	[countryName] => Sweden
	[phoneNumber] => 09823459348
	[vatNumber]
	*/
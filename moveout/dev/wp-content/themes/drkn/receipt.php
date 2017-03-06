<?php

/**
 *
 * Template Name: Receipt
 *
*/

	Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 
	$receipt_info = EscSuccess::init();

?>

	<section class="confirmation">
			<div class="container-fluid">
				<div class="row">
<?php 
			if(isset($receipt_info['code']) && $receipt_info['code'] == 'COUNTRY_MISMATCH') {
?>
				<div class="col-md-4 div-center">
					<h4 class="text-center">Your pamyent country is not correct</h4>
					<p>You are trying to purchase products in the wrong country. Please go back to the checkout and choose the country that matches your payment information.</p>
				</div>				
<?php
			} else if(isset($receipt_info['errors'])) {
?>
				<div class="col-md-4 div-center">
					<h4 class="text-center">An error has occurred</h4>
					<p>If you have placed an order and refreshed the page then your order is complete and you should recieve an email shortly with your receipt.</p>
					<p>If you have come here without seeing first your receipt contact customer service to ensure your purchase has been received.</p>
				</div>
<?php	
			}  else if(isset($receipt_info['paymentMethodData']['snippet'])) {

					//Successful klarna checkout selection
?>
				<div class="col-md-4 div-center">
					<h4 class="text-center">ORDER #<?php echo $receipt_info['order'] ?></h4>
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
					<div class="col-md-4 div-center">
						<h4 class="text-center">ORDER #<?php echo $receipt_info['order'] ?></h4>
						<p><?php the_content(); ?></p>

						<h5>ORDER SPECS</h5>

						<div class="wrap-confirmation">
							
							<div class="first">
								<div class="col-md-6 col-sm-6 col-xs-6"><p>Item</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-center">Size</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-center">Price</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-right">Subtotal</p></div>

								<?php get_template_part('parts/shop/checkout-selection'); ?>
							</div>
							<div class="second">
								<div class="col-md-6 col-sm-6 col-xs-6"><p>Shipping:</p></div>
								<div class="col-md-6"><p class="text-right"><?php echo $receipt_info['totals']['shippingPrice']; ?></p></div>
								<div class="col-md-6"><p>Total:</p></div>
								<div class="col-md-6"><p class="total-price text-right"><?php echo $receipt_info['totals']['grandTotalPrice']; ?></p></div>
							</div>

							<div class="third">
								<div class="col-md-12"><p>E-mail</p></div>
								<div class="col-md-12"><p><?php echo $receipt_info['address']['email'] ?></p></div>
							</div>

							<div class="fourth">	
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p>Billing address</p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p>Shipping address</p>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<p><?php echo $receipt_info['address']['firstName'] ?></p>
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

						<a id="print" class="u-mainButton" type="submit"><span>Print Receipt</span></a>

					</div>

<?php 
				}

				EscSuccess::clearSession();
			}
?>
				</div>
			</div>
		</section>

		<div class="clearfix"></div>

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
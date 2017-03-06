<?php

	function init_checkout() {
		global $esc_errors;

?>
<?php $prevForm = isset($_REQUEST) ? $_REQUEST : array();

	$isSubscription = false;
	if (isset($_REQUEST['get_address'])) {
		//{"country": "SE","identityNumber": "198309139676"}
		//http://maxim.se/litomove/api/shop/payment-methods/klarna/address-search
		$idn = sanitize_text_field($_REQUEST['address_identityNumber']);
		$rest = esc_rest('payment-methods/klarna/address-search');
		$addressKlarna = $rest -> post(array("country" => "SE", "identityNumber" => $idn));
		$httpCode = $rest -> httpCode();
		if ($httpCode === 200) {
			foreach ($addressKlarna as $field_key => $field) {
				$prevForm['address_' . $field_key] = $field;
			}
		} else {
			$prevForm['get_address_errors'] = $addressKlarna['reason'];
		}

	} else {

		if (isset($_REQUEST['subscribe']) && isset($_REQUEST['post_id'])) {
			$item = intval($_REQUEST['post_id']);
			$post_data = get_post($item, 'ARRAY_A');
			$meta = json_decode(get_post_meta($item, 'json', true), true);
			$packageId = $meta['subscription']['id'];
			$isSubscription = true;

			//Set geolocation, market and pricelist.
			if (!isset($_SESSION['geo_location'])) {
				/*$remote_ip = ($_SERVER['REMOTE_ADDR'] === '127.0.0.1') ? '5.35.187.68' : $_SERVER['REMOTE_ADDR'];
				 $location = esc_rest($remote_ip, 'http://freegeoip.net/json/', false)->get();*/
				$location = array('country_code' => 'SE');
				$_SESSION['geo_location'] = $location;

				$silk_store_settings = esc_rest('countries/' . $location['country_code']) -> get();
				$_SESSION['silk_store'] = $silk_store_settings;

			}

			//create a selection to retrieve shipping.
			$create_selection = esc_rest('selections') -> post($_SESSION['silk_store']);
			if (!empty($create_selection['selection'])) {
				$_SESSION['silk_store']['selection_id'] = $create_selection['selection'];
				$silk_selection = esc_rest('selections/' . $_SESSION['silk_store']['selection_id'] . '/items/' . $meta['items'][0]['item'] . '/quantity/1') -> post();
				$_SESSION['selection'] = $silk_selection;
				if ($silk_selection) {
					$freight = $silk_selection['totals']['shippingPrice'];
				}
			}

		} else {
			if (!isset($_SESSION['silk_store']['selection_id']) || !isset($_SESSION['selection']['items'])) {
				//No selection no checkout.
				echo '<p><br/><br/><br/><br/><br/><br/>Inga produkter vald.</p>';
				return;
			} else {
				//Refresh selection with latest items
				$silk_selection = esc_rest('selections/' . $_SESSION['silk_store']['selection_id']) -> get();
				$_SESSION['selection'] = $silk_selection;
			}
		}

	}

	$_SESSION['silk_store']['payment-method'] = 'dummy';
	
	// Get countries
	$uploadsDir = wp_upload_dir();	
	$file = $uploadsDir['basedir'] . '/countries.txt';
	$countries = file_get_contents($file);	
	$countries = json_decode($countries);
	
	// Get country
	$currentCountryCode = isset($_SERVER['GEOIP_COUNTRY_CODE']) ? $_SERVER['GEOIP_COUNTRY_CODE'] : 'SE';
?>

<div class="main checkout">
	<form id="purchase" action="" method="post">
		<div class="row full-width">
			<div class="large-9 large-centered columns">
				<center><p class="checkout-text">Checkout</p></center>
				
				<div class="row full-width">

					<div class="large-4 columns">
						<h2>1. Only Visa or Mastercard</h2>

						<label for="cc_payment_rd">
							<input id="cc_payment_rd" type="radio" value="dummy" checked="checked" name="paymentMethod"/>
							Dummy 
						</label>

					</div>
					<div class="large-4 columns">
						
						<h2>2. Enter your shipping address</h2>
						
						<button type="submit" style="position: absolute; top: -9999px; left: -9999px;"></button>

							<input type="hidden" name="checkout" value="1" />
							
							<?php /*
							
							<?php if($isSubscription) {	?>
							<input type="hidden" name="package" value="<?=$packageId?>">
							<input type="hidden" name="subscription" value="1">
							<?php } ?>

							
								<li class="show-cc show-invoice">
									
									<label for="address_identityNumber">Personnummer</label>
									<input id="address_identityNumber" class="validate-val" type="text" name="address_identityNumber" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_identityNumber']):'')?>" />
									<button id="get-address" type="submit" class="button" name="get_address" value="1">
										Get Address
									</button>
									<?
if(isset($prevForm['get_address_errors'])) {
									?>
									<div class="errors">
										<?=sanitize_text_field($prevForm['get_address_errors'])?>
									</div>
									<? } ?>
								</li>								 
								 */ ?>

							<input id="address_firstName" class="validate-val" type="text" name="address_firstName" placeholder="First Name:" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_firstName']):'')?>"/>

							<input id="address_lastName" class="validate-val" type="text" name="address_lastName" placeholder="Last Name:" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_lastName']):'')?>"/>

							<input id="address_email" class="validate-val" data-type="email" type="email" name="address_email" placeholder="Email:" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_email']):'')?>"/>

							<input id="address_phoneNumber" class="validate-val" type="text" name="address_phoneNumber" placeholder="Phone:" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_phoneNumber']):'')?>"/>

							<input id="address_address1" class="validate-val xl-in" type="text" name="address_address1" placeholder="Address:" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_address1']):'')?>"/>

							<?php /*
							<li class="show-cc show-invoice" >
								<label for="address_address2">Adress linje 2</label>
								<input id="address_address2" class="xl-in" type="text" name="address_address2" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_address2']):'')?>"/>
							</li>
							 */ ?>

							<input id="address_city" class="validate-val" type="text" name="address_city" placeholder="City:" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_city']):'')?>"/>

							<input id="address_zipCode" class="validate-val" type="text" name="address_zipCode" placeholder="Zip code:" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['address_zipCode']):'')?>"/>

							<select name="address_country">
								<option value="0">Choose country</option>
								<?php if(isset($countries) and ! empty($countries)): ?>								
									<?php foreach($countries as $key => $country):  ?>
										<?php if ($country->name != ''): ?>
											<option <?php echo $currentCountryCode == $key ? 'selected' : ''; ?> value="<?php echo $key; ?>"><?php echo $country->name; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>

<?php /*
	<?php if(!$isSubscription) :
	?>
	<h4 class="heading-cb"><label for="shippingAddress_used">Leverera till annan adress?<span class="input-area">
			<input value="1" type="checkbox" name="shippingAddress_used" id="shippingAddress_used"/>
			<span class="check-butt"></span></span></label></h4>
	<div class="trigger-section">
	<input type="hidden" name="prioritize_alternative_shipping" value="1" />
	<ul id="shipping-form" class="ul-clean co-form">
	<li class="clearfix">
	<a id="copy-above" class="button smaller right-side" href="#">Kopiera ovan</a>
	</li>
	<li class="show-cc show-invoice" >
	<label for="shippingAddress_firstName">Förnamn</label><input id="shippingAddress_firstName" class="validate-val" type="text" name="shippingAddress_firstName" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['shippingAddress_firstName']):'')?>"/>
	</li>
	<li class="show-cc show-invoice" >
	<label for="shippingAddress_lastName">Efternamn</label><input id="shippingAddress_lastName" class="validate-val" type="text" name="shippingAddress_lastName" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['shippingAddress_lastName']):'')?>"/>
	</li>
	<li class="show-cc show-invoice" >
	<label for="shippingAddress_email">Epost</label><input id="shippingAddress_email" class="validate-val" data-type="email" type="email" name="shippingAddress_email" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['shippingAddress_email']):'')?>"/>
	</li>
	<li class="show-cc show-invoice" >
	<label for="shippingAddress_phoneNumber">Telefon</label><input id="shippingAddress_phoneNumber" class="validate-val" type="text" name="shippingAddress_phoneNumber" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['shippingAddress_phoneNumber']):'')?>"/>
	</li>
	<li class="show-cc show-invoice" >
	<label for="shippingAddress_address1">Adress linje 1</label><input id="shippingAddress_address1" class="validate-val xl-in" type="text" name="shippingAddress_address1" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['shippingAddress_address1']):'')?>"/>
	</li>
	<li class="show-cc show-invoice" >
	<label for="shippingAddress_address2">Adress linje 2</label><input id="shippingAddress_address2" class="xl-in" type="text" name="shippingAddress_address2" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['shippingAddress_address2']):'')?>"/>
	</li>
	<li class="show-cc show-invoice" >
	<label for="shippingAddress_zipCode">Postkod</label><input id="shippingAddress_zipCode" class="validate-val" type="text" name="shippingAddress_zipCode" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['shippingAddress_zipCode']):'')?>"/>
	</li>
	<li class="show-cc show-invoice" >
	<label for="shippingAddress_city">Stad</label><input id="shippingAddress_city" class="validate-val" type="text" name="shippingAddress_city" value="<?=(!empty($prevForm)?sanitize_text_field($prevForm['shippingAddress_city']):'')?>"/>
	</li>
	<li id="shippingAddress_cou_id" class="co-select show-cc show-invoice show-pp" >
	<label for="shippingAddress_country">Land</label>
	<select id="shippingAddress_country" class="validate-val l-in" data-type="dropdown" name="shippingAddress_country">
	<option value="">Välj land</option>
	<option selected value="SE">Sverige</option>
	</select>
	</li>
	</ul>
	</div><!-- .trigger-section-->
	<?php endif; ?>
*/ ?>	


					</div>
					<div class="large-4 columns">
						
						<h2>3. Here's what's in you cart</h2>
						
						<?=esc_checkout_selection(); ?>
						
						<?php /*
						<?php if(!$isSubscription) {
						?>
						<?=esc_checkout_selection()
						?>
						<?php } else { echo esc_checkout_subscription($item, @$freight);	}
						?>
						*/ ?>

							<? if(!$isSubscription) { ?>
								
							<div id="checkout-totals" class="checkout-totals">
								<?=esc_checkout_totals()?>
							</div>
							
							<? } else {
								// echo esc_checkout_subscription($item, @$freight);
								}
							?>

							<label for="newsletter">
								<input value="1" type="checkbox" name="newsletter" id="newsletter" />
								<span class="tiny-text">Avicii's Newsletter</span>
							</label>

							<label for="termsAndConditions">
								<input value="1" type="checkbox" name="termsAndConditions" id="termsAndConditions" />
							 	<span class="tiny-text">I agree with <a href="#" target="_blank"><u>terms and conditions</u></a></span>
							 </label>


							<div id="error-cont">
								<?php if($esc_errors !== false && isset($esc_errors)) :
								?>
								<div class="errors">
									<h3>Error:</h3>
									<?php pr($esc_errors);

										echo sanitize_text_field($esc_errors['message']);
										foreach ($esc_errors as $error) {
											if ($error === 'email') {
												echo 'Epost är inskrivit felaktig';
											}
										}
									?>
								</div>
								<?php endif; ?>
							</div><!--error-cont -->
							
							
							<button class="product-black-btn" type="submit">
								Continue with purchase
							</button>
							<center>
								<p class="tiny-text">									
									Visa and Mastercard only																	
								</p>
							</center>
					</div>

				</div>
			</div>

		</div>
	</form>
</div>

<?php

}

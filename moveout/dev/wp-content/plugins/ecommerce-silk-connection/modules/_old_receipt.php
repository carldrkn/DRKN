<?

	function init_receipt() {

        $payment_response = esc_rest('selections/'.$_SESSION['silk_store']['selection_id'].'/payment-result');
        $receipt_details = $payment_response->post($_REQUEST);
        $http_code = $payment_response->httpCode();
        $response = $payment_response->response();

        if($http_code == 404) {
            $str = "secret=xxx";
            foreach($_REQUEST as $key => $val) {
                $str .= ($str?'&':'').urlencode($key).'='.urlencode($val);
            }
            $rest = esc_rest('payment', 'subscription', false);
            $receipt_details = $rest->post($str, false);
            $subscription = ($receipt_details['status'] == 'ok');
            $receipt_details['order'] = $receipt_details['id'];
            /*pr($receipt_details);*/
            /*pr($_SESSION);*/
        }

        if($http_code == 200 || $subscription) {

?>
		<div class="row reciept-container">
			<div class="col-md-4 product-reciept">
				<?php if(!$subscription) : ?>
				<h3>Produkter</h3>
				<div id="co-prod-list" class="ul-clean co-prod-list">
					<?=esc_checkout_selection($receipt_details['items'])?>
				</div><!--- #co-prod-list -->
				<?php else : ?>
					<?php $check_subs = 'subscribe'; ?>
				<?php endif; ?>
			</div><!--- .product-reciept -->
			<div class="col-md-4 address-reciept">
				<h3>Leverans Detaljer</h3>
				<ul class="add-details ul-clean">
					<li class="clearfix"><strong>Ordernummer</strong><span><?=$receipt_details['order']?></span></li>
					<li class="clearfix"><strong>Datum</strong><span><?=date("Y/m/d")?></span></li>
					<li class="clearfix"><strong>Namn</strong><span><?=$receipt_details['address']['firstName']?> <?=$receipt_details['address']['lastName']?></span></li>
					<li class="clearfix"><strong>Tel</strong><span><?=$receipt_details['address']['phoneNumber']?></span></li>
				</ul><!--- .add-details -->
				<ul class="add-delivery ul-clean">
					<li class="clearfix">
						<strong>Lev.adress</strong>
						<span>
							<?=($receipt_details['address']['address1']) ? $receipt_details['address']['address1'].'<br>' : ''?>
							<?=($receipt_details['address']['address2']) ? $receipt_details['address']['address2'].'<br>' : ''?>
							<?=($receipt_details['address']['zipCode']) ? $receipt_details['address']['zipCode'].'<br>' : ''?>
							<?=($receipt_details['address']['city']) ? $receipt_details['address']['city'].'<br>' : ''?>
							<?=($receipt_details['address']['state']) ? $receipt_details['address']['state'].'<br>' : ''?>
							<?=($receipt_details['address']['country']) ? $receipt_details['address']['country'].'<br>' : ''?>
						</span>
					</li>
				</ul><!--- .add-delivery -->
			</div><!--- .address-reciept -->
			<div class="col-md-4 total-reciept">
				<?php if(!$subscription) : ?>
					<h3>Betalningsuppgifter</h3>
					<div id="checkout-totals" class="checkout-totals">
						<?=esc_checkout_totals($receipt_details['totals'],$receipt_details['items'])?>
					</div><!--- #checkout-totals -->  
				<?php else : ?>
					<h3 class="bottom-line">Sumering</h3>
					<div id="checkout-totals" class="checkout-totals">
						<div id="checkout-cont" class="checkout-cont" data-item-count="<?=$receipt_details['itemCount']?>">
							<ul id="co-summary" class="ul-clean">
								<li>Frakt <span class="lighter-text">(Sverige)</span><span class="right-side"><?=$receipt_details['shipping'].' '.$receipt_details['currency']?></span></li>
								<li class="grand-total">
									<h3 class="left-align clearfix"><span class="right-side"><?=$receipt_details['amount'].' '.$receipt_details['currency']?></span>Betalt<br><span class="lighter">(inkl moms &amp; leverans)</span></h3>
								</li>
							</ul><!--- #co-summary -->  
						</div><!--- #checkout-cont -->  
					</div><!--- #checkout-totals -->  
				<?php endif; ?>
				<a href="#" class="button print">Skriv ut</a>
				<p class="back-to-shop">Till shoppen <a href="<?=get_permalink(239)?>">visa fler produkter</a></p>
			</div><!--- .total-reciept -->    
		</div><!--- .reciept-container -->

<?
            //Kill basket if payment is successful
            $_SESSION = array();

		} else if($http_code == 412) {
?>			 <div class="failed-payment">
				<h2>Betalning har misslyckats</h2>
				<p>Betalningen har misslyckats av någon anledning. Inga pengar har dragits.</p>
			</div><!--- .failed-payment -->
<?
        } else {
?>
            
        <div class="no-proof">
            <h2>Ingen kvitto att visa</h2>
            <p>Om du har lagd en beställlning och genomfört betalning och inte fått en kvitto kontakta Litomove för att får en kopia.</p>
            <a href="/" class="button or-section">Till startsidan</a>
        </div><!--- .no-proof -->

<?
        }
	}

	/*

	

    Array
    (
        [order] => 6144
        [items] => Array
            (
                [0] => Array
                    (
                        [item] => 271-99
                        [product] => 271
                        [sku] => 451135806
                        [ean] => 
                        [quantity] => 1
                        [priceEach] => 250 SEK
                        [totalPrice] => 250 SEK
                        [priceEachBeforeDiscount] => 250 SEK
                        [taxPercent] => 25
                    )

            )

        [totals] => Array
            (
                [itemsTotalPrice] => 250 SEK
                [voucherPrice] => 0 SEK
                [shippingPrice] => 69 SEK
                [totalQuantity] => 1
                [grandTotalPrice] => 319 SEK
                [grandTotalPriceTax] => 64 SEK
            )

        [address] => Array
            (
                [firstName] => shippingAddress_firstName
                [lastName] => shippingAddress_lastName
                [phoneNumber] => shippingAddress_phoneNumber
                [email] => example@example.com
                [address1] => shippingAddress_address1
                [address2] => shippingAddress_address2
                [zipCode] => 90210
                [city] => shippingAddress_city
                [state] => 
                [country] => SE
            )

        [shippingAddress] => Array
            (
                [email] => example@example.com
                [firstName] => shippingAddress_firstName
                [lastName] => shippingAddress_lastName
                [address1] => shippingAddress_address1
                [address2] => shippingAddress_address2
                [zipCode] => 90210
                [city] => shippingAddress_city
                [state] => 
                [country] => SE
                [phoneNumber] => shippingAddress_phoneNumber
            )

    )

    Array
    (
        [transactionId] => 70d998fd4eb24f40b868065c6b9c19ef
        [responseCode] => OK
    )



	*/
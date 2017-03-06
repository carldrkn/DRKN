<?php

/*
 * ABOUT:
 * Silk specific characteristics needed for display of receipt page.
 * Runs prior to product page being displayed.
 *
*/

class EscSuccess {

	public $receipt_info;

	function __construct() {

		$return_variables = array('paymentMethodFields' => $_REQUEST);
		
		if(isset($_SESSION['esc_store'])) {
			$esc_init = EscConnect::init('selections/' . $_SESSION['esc_store']['selection_id'] . '/payment-result');
			$this->receipt_info = $esc_init->post($return_variables);
		} else {
			$this->receipt_info = array('success' => false, 'errors' => 'Session has expired');
		}

	}

	public function getReceiptInfo() {
		return $this->receipt_info;
	}

	public function conversionScriptGTM() {
		$receipt_info = $this->receipt_info;

		$error = isset($receipt_info['code']) && $receipt_info['code'] == 'COUNTRY_MISMATCH';
		$error = $error || isset($receipt_info['errors']);
		$str = "";

		if(!$error) {
			$order = (object) $receipt_info;
			$order->totals = (object) $order->totals;
			$order->discounts = (object) $order->discounts;
			$voucher_str = "";

			foreach($order->discounts->vouchers as $voucher_key => $voucher_obj) {
				$voucher_str = $voucher_key . ' ';
			}

			ob_start();
?>

			<script>
				if(typeof dataLayer == 'undefined') dataLayer=[];
				dataLayer.push({
					'ecommerce': {
						'currencyCode': '<?php echo esc_js($order->currency)?>',
						'purchase': {
							'actionField': {
								'id': '<?php echo esc_js($order->order)?>',
								'affiliation': 'DRKN',
								'revenue': '<?php echo esc_js($order->totals->grandTotalPriceAsNumber) ?>',
								'tax':'<?php echo esc_js($order->totals->grandTotalPriceTaxAsNumber) ?>',
								'shipping': '<?php echo esc_js($order->totals->shippingPriceAsNumber) ?>',
								'coupon': '<?php echo esc_js(trim($voucher_str))?>'
							},
							'products': [
							<?php foreach ($order->items as $item ): $item = (object) $item; ?>
							{
								'name': '<?php echo esc_js($item->productName) ?>',
								'sku': '<?php echo esc_js($item->sku) ?>',
								'price': '<?php echo esc_js($item->priceEachAsNumber) ?>',
								'brand': '<?php echo esc_js($item->brandName) ?>',
								'variant': '<?php echo esc_js($item->silkVariant) ?>',
								'quantity': <?php echo esc_js($item->quantity) ?>
							 },
							 <?php endforeach ?>
							 ]
						}
					}
				});
			</script>

<?php
			$str = ob_get_contents();
			ob_end_clean();

		}

		echo $str;
	}

	static public function clearSession() {
		unset($_SESSION['esc_store']);
		unset($_SESSION['esc_selection']);
	}

}
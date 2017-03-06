<?php
	$totals = EscGeneral::getSelection();
	$totals = $totals['totals'];
?>

	<div class="col-md-6 col-sm-6 col-xs-6"><p>Sub Total:</p></div>
	<div class="col-md-6"><p class="text-right"><?php echo $totals['itemsTotalPrice'] ?></p></div>
	<div class="col-md-6 col-sm-6 col-xs-6"><p>Shipping with DHL:</p></div>
	<div class="col-md-6"><p class="text-right"><?php echo $totals['shippingPrice'] ?></p></div>
<?php  
if(EscSelection::isVoucherSet()) {
	//Voucher is set.
?>
	<div class="col-md-6"><p>Discount:</p></div>
	<div class="col-md-6"><p class="text-right"><?php echo $totals['totalDiscountPrice'] ?></p></div>
<?php
}
?>
	<div class="col-md-6"><p class="total-price">Grand Total:</p></div>
	<div class="col-md-6"><p class="total-price text-right"><?php echo $totals['grandTotalPrice']; ?></p></div>
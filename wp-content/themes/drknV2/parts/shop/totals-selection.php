<?php
	$totals = EscGeneral::getSelection();
	$totals = $totals['totals'];
	if(!empty($totals)):
?>
	<tr>
		<td colspan="3">
			<h4> Sub Total: </h4>
		</td>
		<td colspan="3">
			<p class="text-right"> <?php echo $totals['itemsTotalPrice'] ?> </p>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<h4> Shipping: </h4>
		</td>
		<td colspan="3">
			<p class="text-right">
				<?php echo $totals['shippingPrice'] ?>
			</p>
		</td>
	</tr>

	<?php if( class_exists('EscSelection') && EscSelection::isVoucherSet() && $totals['totalDiscountPriceAsNumber']): //Voucher is set. ?>
	<tr>
		<td colspan="3">
			<h4>Discount: </h4>
		</td>
		<td colspan="3">
			<p class="text-right"> <?php echo $totals['totalDiscountPrice'] ?></p>
		</td>
	</tr>
	<?php endif; ?>

	<?php if( $totals['taxDeductedAsNumber'] ): //Tax deducted EU fast inte :) ?>
	<tr class="totals-row">
		<td colspan="3">
			<h4>Tax Deducted (Outside EU): </h4>
		</td>
		<td colspan="3">
			<p class="text-right"> <?php echo $totals['taxDeducted'] ?></p>
		</td>
	</tr>
	<?php endif; ?>
	
	<tr class="totals-row">
		<td colspan="3">
			<h3>Grand Total: </h3>
		</td>
		<td colspan="3">
			<p class="text-right"> <?php echo $totals['grandTotalPrice'] ?></p>
		</td>
	</tr>
<?php endif; ?>
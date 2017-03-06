<?php
	$totals = EscGeneral::getSelection();
	$totals = $totals['totals'];
	if(!empty($totals)):
?>
	<tr>
		<td colspan="2">
			<p>
				Sub Total:
			</p>
		</td>
		<td colspan="2">
			<p class="text-right">
				<?php echo $totals['itemsTotalPrice'] ?>
			</p>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>
				Shipping:
			</p>
		</td>
		<td colspan="2">
			<p class="text-right">
				<?php echo $totals['shippingPrice'] ?>
			</p>
		</td>
	</tr>

	<?php if( class_exists('EscSelection') && EscSelection::isVoucherSet() && $totals['totalDiscountPriceAsNumber']): //Voucher is set. ?>
	<tr>
		<td colspan="2">
			<p>
				Discount:
			</p>
		</td>
		<td colspan="2">
			<p class="text-right">
				<?php echo $totals['totalDiscountPrice'] ?>
			</p>
		</td>
	</tr>
	<?php endif; ?>

	<?php if( $totals['taxDeductedAsNumber'] ): //Tax deducted EU fast inte :) ?>
	<tr class="totals-row">
		<td colspan="2">
			<p>
				Tax Deducted (Outside EU):
			</p>
		</td>
		<td colspan="2">
			<p class="text-right">
				<?php echo $totals['taxDeducted'] ?>
			</p>
		</td>
	</tr>
	<?php endif; ?>
	
	<tr class="totals-row">
		<td colspan="2">
			<p>
				Grand Total:
			</p>
		</td>
		<td colspan="2">
			<p class="text-right">
				<?php echo $totals['grandTotalPrice'] ?>
			</p>
		</td>
	</tr>
<?php endif; ?>
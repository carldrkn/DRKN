	<tr class="header-t">
		<td>
			<h4>
				Item
			</h4>
		</td>
		<td>
			<h4 class="text-right">
				Size
			</h4>
		</td>
		<td>
			<h4 class="text-right">
				Qty
			</h4>
		</td>
		<td>
			<h4 class="text-right">
				Price
			</h4>
		</td>
		<td>
			<h4 class="text-right">
				Sub Total
			</h4>
		</td>
	</tr>
<?php

	$selection = EscGeneral::getSelection();

	foreach($selection['items'] as $key => $item):
		
		//On Sale
		if($item['anyDiscount']) {
			$price = '<s>' . $item['priceEachBeforeDiscount'] . '</s><br><span class="sale-product">' . $item['priceEach'] . '</span>';
		} else {
			$price = $item['priceEach'];
		}

?>
	<tr>
		<td>
			<p>
				<?php echo $item['productName']; ?><br>
			</p>
		</td>
		<td>
			<p class="text-right">
				<?php echo $item['size']; ?>
			</p>
		</td>
		<td>
			<p class="text-right">
				<?php echo $item['quantity']; ?>
			</p>
		</td>
		<td>
			<p class="text-right">
				<?php echo $price; ?>
			</p>
		</td>
		<td>
			<p class="text-right">
				<?php echo $item['totalPrice']; ?>
			</p>
		</td>
	</tr>

<?php
	endforeach;
?>
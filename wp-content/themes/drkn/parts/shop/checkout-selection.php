	<tr>
		<td>
			<p>
				Item
			</p>
		</td>
		<td>
			<p class="text-right">
				Size
			</p>
		</td>
		<td>
			<p class="text-right">
				Price
			</p>
		</td>
		<td>
			<p class="text-right">
				Sub Total
			</p>
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
				<?php echo $item['productName']; ?>
			</p>
		</td>
		<td>
			<p class="text-right">
				<?php echo $item['size']; ?>
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
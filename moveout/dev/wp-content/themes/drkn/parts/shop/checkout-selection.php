<?php
	
	$selection = EscGeneral::getSelection();

	foreach($selection['items'] as $key => $item) {
?>
	<div class="col-md-6 col-sm-6 col-xs-6"><p><?php echo $item['productName']; ?></p></div>
	<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-right"><?php echo $item['size']; ?></p></div>
	<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-right"><?php echo $item['priceEach']; ?></p></div>
	<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-right"><?php echo $item['totalPrice']; ?></p></div>
<?php
	}
?>
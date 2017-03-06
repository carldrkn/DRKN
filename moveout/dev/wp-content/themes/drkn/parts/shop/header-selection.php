<?php
	
	$selection = EscGeneral::getSelection();

?>

<ul class="u-cleanList selectedItems-list">
<?php
	foreach($selection['items'] as $key => $item) {
?>
		<li>
			<a class="selectedItems-imageCont" href="<?php echo get_permalink($item['post_id']); ?>">
				<img class="selectedItems-image" src="" alt="" width="60" height="60">
			</a><div class="selectedItems-info">
				<a href="<?php echo get_permalink($item['post_id']); ?>"><h6><?php echo $item['productName']; ?><span class="float-right"><?php echo $item['priceEach']; ?></span></h6></a>
				<div class="selectedItems-details"><span>Size: <?php echo $item['size']; ?></span> <span>Qty: <?php echo $item['quantity']; ?></span></div>
				<div class="selectedItems-edit"><a href="<?php echo EscGeneral::getQueryAddProduct($item) ?>">+ Add</a><a href="<?php echo EscGeneral::getQueryRemoveProduct($item) ?>">- Remove</a></div>
			</div>
		</li>
<?php
	}
?>
</ul>
<div class="selectedItems-subTotal">
	<h5>Sub Total <?php echo $selection['totals']['itemsTotalPrice']; ?></h5>
	<a href="<?php get_bloginfo('url') ?>/selection" class="u-mainButton u-mainButton--small"><span>Checkout</span></a>
</div>
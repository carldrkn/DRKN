<?php
$product = new EscProduct($post->ID);
$is_limited = isset($product->product_meta['limited_product']) && $product->product_meta['limited_product'];

//Need to check if there already is a selection with that voucher.
if($is_limited && !$product->unlockedForPurchase()) {
?>
<div class="unlockProduct">
	<?php $product->renderStartUnlockForm(); ?>
		<h4><label for="unlockProduct-input" class="unlockProduct-description">Enter code to proceed</label></h4>
		<div class="unlockProduct-submitArea">
			<input id="unlockProduct-input" class="unlockProduct-input" type="text" name="esc_unlock_code">
			<button class="u-mainButton u-mainButton--small unlockProduct-submit"><span>Submit</span></button>
			<?php EscGeneral::renderVoucherErrors('<span class="voucherErrors">{content}</span>'); ?>
		</div>
	<?php $product->renderEndForm(); ?>
</div>
<?php

} else if($is_limited && $product->unlockedForPurchase()) {
?>
	<div class="unlockProduct">
		<?php $product->renderStartUnlockForm(); ?>
			<input type="hidden" name="esc_current_code" value="<?php echo $product->current_code; ?>">
			<h4>Unlocked!</h4>
			<p>Using: <?php echo $product->current_code; ?> <button class="unlockProduct-remove" type="submit" name="esc_remove_unlock_code" value="">Remove Code</button></p>
		<?php $product->renderEndForm(); ?>
	</div>
<?php
}

if(($is_limited && $product->unlockedForPurchase()) || !$is_limited) {
	$product->renderStartPurchaseForm();
?>
	<div class="buy-container clearfix">
		<ul id="js-productSizes" class="sizes">
		<?php
		$product->renderSizesLoop('<li class="{selectedClass}{disabledClass}"><label for="{id}"><input id="{id}" type="radio" {disabled}name="{selector}" {selected}value="{value}">{name}</label></li>');
		?>
		</ul>	
		<div class="wrap-buy-button">
			<?php $is_available = EscGeneral::isAvailable($post->ID); ?>
			<button id="js-submitPurchase" class="js-submitPurchaseSingle u-mainButton buy" data-hover-text="Choose Size" data-orig-text="BAG IT" data-co-text="Go To Checkout" type="submit"<?php echo ($is_available['info']['stockOfAllItems'] == 0 ? 'disabled="disabled"' : ''); ?>>
				<?php echo ($is_available['info']['stockOfAllItems'] == 0 ? '<span>SOLD OUT</span>' : '<span>BAG IT</span>'); ?>
			</button>
		</div>
	</div>
<?php

	$product->renderEndForm();
}
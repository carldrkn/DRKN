<?php
$product = new EscProduct($post->ID);
$is_limited = isset($product->product_meta['limited_product']) && $product->product_meta['limited_product'];

//Need to check if there already is a selection with that voucher.
if($is_limited && !$product->unlockedForPurchase()) {
?>
<div class="unlockProduct">
	<?php $product->renderStartUnlockForm(); ?>
		<h5><label for="unlockProduct-input" class="unlockProduct-description">Enter code to proceed</label></h5>
		<div class="unlockProduct-submitArea">
			<div class="input-group">
				<input id="unlockProduct-input" class="unlockProduct-input" type="text" name="esc_unlock_code">
				<span class="input-group-btn">
					<button class="u-mainButton u-mainButton--small unlockProduct-submit btn btn-default"><div>Submit</div></button>
				</span>
			</div>
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
			<h3>Unlocked!</h3>
			<p>Using: <?php echo $product->current_code; ?></p>
			<button class="unlockProduct-remove" type="submit" name="esc_remove_unlock_code" value="">Remove Code</button>
		<?php $product->renderEndForm(); ?>
	</div>
<?php
}

if(($is_limited && $product->unlockedForPurchase()) || !$is_limited) {
	$product->renderStartPurchaseForm();

	$buy_button = ( ( isset( $product->product_meta['type'] ) && $product->product_meta['type'] == 'is_patch' ) ? 'ADD PATCH' : 'BUY' );

	$hidden = '';

	if( count( $product->product_meta['items'] ) == 1 ) {
		$hidden = 'hidden';
	}
?>
	<div class="button-size">
		<ul class="size-link">
		<?php
		$product->renderSizesLoop('<li class="{selectedClass}{disabledClass} '.$hidden.'"><input id="{id}" type="radio" {disabled}name="{selector}" {selected}value="{value}"><label for="{id}">{name}</label></li>');
		?>
		</ul>


		<div class="wrap-buy-button">
			<?php $is_available = EscGeneral::isAvailable($post->ID); ?>
			<button id="js-submitPurchase" class="js-submitPurchaseSingle u-mainButton <?php echo ($hidden ? 'btn-border' : 'btn-no-border') ?>" data-hover-text="Choose Size" data-orig-text="BAG IT" data-co-text="Go To Checkout" type="submit"<?php echo ($is_available['info']['stockOfAllItems'] == 0 ? 'disabled="disabled"' : ''); ?>>
				<?php echo ($is_available['info']['stockOfAllItems'] == 0 ? '<span>SOLD OUT</span>' : '<span>' . $buy_button . '</span>'); ?>
			</button>
		</div>
	</div>
<?php

	$product->renderEndForm();
}
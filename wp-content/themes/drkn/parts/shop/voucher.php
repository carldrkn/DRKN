<?php 
	if(class_exists('EscSelection')) {
		$selection = new EscSelection();
		$selection->inputFieldTemplate('<div class="input-field{classes}"><label for="{id}">{content}</label><input id="{id}" type="{type}" name="{name}" value="{value}"></div>');
		$selection->submitFieldTemplate('<button class="u-mainButton{class_0}" name="{name}" value="{value}"><span>{content}</span></button>');
		$vouchers = EscSelection::getVouchers();


		if(EscSelection::isVoucherSet()) echo '<div class="voucher-fields-current clearfix">';

		foreach ($vouchers as $voucher) {
			if(strpos($voucher['voucher'], 'drkn-unlock:') !== false) continue;
?>
			<div class="voucher-fields-item">
				<p class="voucher-fields-code"><?php echo $voucher['voucher']; ?></p>
				<?php $selection->renderField('remove_voucher_' . $voucher['voucher'], 'Remove Voucher?', false, array('u-mainButton--small')); ?>
			</div>
<?php
		}

		if(EscSelection::isVoucherSet()) echo '</div>';
		if(count($vouchers) < 2) {
?>
		<?php $selection->renderField('voucher', ''); ?>
		<?php $selection->renderField('submit_voucher', 'Add Voucher', false, array('u-mainButton--small voucher-fields-add')); ?>
		<?php EscGeneral::renderVoucherErrors('<span class="voucherErrors">{content}</span>'); ?>
<?php
		}
	}
?>
<?php 
	if(class_exists('EscSelection')) {
		$selection = new EscSelection();

		$selection->submitFieldTemplate('<span class="input-group-btn"><button class="btn" name="{name}" value="{value}"><span>{content}</span></button> </span>');
		$selection->inputFieldTemplate('<div class="input-field{classes}"><label for="{id}">{content}</label><input id="{id}" type="{type}" name="{name}" class="form-control" value="{value}"></div>');
		$vouchers = EscSelection::getVouchers();


		if(EscSelection::isVoucherSet()) echo '<div class="voucher-fields-current clearfix">';

		foreach ($vouchers as $voucher) {
			if(strpos($voucher['voucher'], 'drkn-unlock:') !== false) continue;
?>
			<div class="voucher-fields-item input-group">
				<div class="voucher-fields-code"><strong>Voucher:</strong> <?php echo $voucher['voucher']; ?></div>
				<?php $selection->renderField('remove_voucher_' . $voucher['voucher'], 'Remove', false, array('u-mainButton--small')); ?>
			</div>
<?php
		}

		if(EscSelection::isVoucherSet()) echo '</div>';
		if(count($vouchers) < 2) {
?>
		<?php EscGeneral::renderVoucherErrors('<span class="voucherErrors">{content}</span>'); ?>
		<div class="input-group">
		<?php $selection->renderField('voucher', ''); ?>
		<?php $selection->renderField('submit_voucher', 'Add Voucher', false, array('u-mainButton--small voucher-fields-add')); ?>
		</div>
<?php
		}
	}
?>
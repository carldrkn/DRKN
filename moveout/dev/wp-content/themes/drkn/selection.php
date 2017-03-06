<?php

/**
 *
 * Template Name: Selection
 *
*/

	Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); 
	$selection = new EscSelection();
	$selection->inputFieldTemplate('<div class="input-field{classes}"><label for="{id}">{content}</label><input id="{id}" type="{type}" name="{name}" value="{value}"></div>');
	$selection->selectFieldTemplate('<div class="input-field{classes}"><label for="{id}">{content}</label><select id="{id}" name="{name}" value="{value}">{options}</select></div>');
	$selection->checkFieldTemplate('<div class="input-field{classes}"><label for="{id}"><input id="{id}" class="{class_0}" type="{type}" name="{name}" value="{value}"{checked}><span></span>{content}</label></div>');
	$selection->submitFieldTemplate('<button class="u-mainButton{class_0}" type="{type}" name="{name}" value="{value}"><span>{content}</span></button>');

	$totals = EscGeneral::getSelection();
	$totals = $totals['totals'];

	/*
	"email": "e-mail address",
  "company": "string",
  "firstName": "string",
  "lastName": "string",
  "address1": "string",
  "address2": "string",
  "zipCode": "string",
  "city": "string",
  "state": "string",
  "country": "Country ISO 3166-1 alpha-2, for example SE",
  "phoneNumber": "string",
  "identityNumber": "string",
  "vatNumber": "string",
  "newsletter": "boolean",
  "loggedIn": "boolean",
  "register": "boolean",
  "password": "string"
  */

?>

	<section id="js-checkout" class="checkout">
			<div class="container-fluid">
				<div class="row">
						
					<div class="wrap-checkout col-md-8 div-center">
						
						<div class="breadcrumbs no-margin col-md-12">
							<p class="no-margin"><a href="">SHOP</a> / <a href="">CHECKOUT</a></p>
						</div>

<?php
						$selection->renderStartSelectionForm();
?>
						<div class="col-md-12">
							<h5>INFORMATION</h5>
						</div>
						<div class="clearfix">
							<div class="col-md-6">
								<?php $selection->renderField('email', 'Email:'); ?>
							</div>
							<div class="col-md-6">
								<?php $selection->renderField('country', 'Country:'); ?>
							</div>
							<div id="js-stateCont" class="col-md-6<?php echo (EscSelection::showStates() ? '' : ' hide') ?>">
								<?php $selection->renderField('state', 'State:'); ?>
							</div>
						</div>
						<div class="col-md-6 voucher is-openSection<?php echo (EscSelection::isVoucherSet() ? ' sectionOpen' : '') ?>">
							<?php $selection->renderField('add_voucher', 'Add voucher?', false, array('js-openSection')); ?>
							<div class="voucher-fields">
<?php  
							if(EscSelection::isVoucherSet()) {
								//Voucher is set.
?>
								<p class="u-fakeInput"><?php echo $_SESSION['esc_store']['voucher']['voucher_name']; ?></p>
								<?php $selection->renderField('remove_voucher', 'Remove Voucher?', false, array('u-mainButton--small')); ?>
<?php
							} else {
								//Voucher is not set.
?>
								<?php $selection->renderField('voucher', ''); ?>
								<?php $selection->renderField('submit_voucher', 'Add Voucher', false, array('u-mainButton--small')); ?>
<?php
							}
?>
							</div>
						</div>

						<div class="clearfix"></div>
						<div class="col-md-6">
							<h5>PAYMENT METHOD</h5>

							<div id="js-paymentFields" class="input-field">
								<?php get_template_part('parts/shop/payments-selection'); ?>
							</div>
						</div>
<?php
/*
						<div class="col-md-6">
							
							<h5>SHIPPING</h5>

							<div class="input-field">
								
								<input type="radio" name="shipping" id="shipping" checked>
								<label for="shipping"></label>
								<span class="col-md-5 col-sm-5 col-xs-6 no-padding">Standard shipping</span>
								<span>4-5 days</span>
								<span class="float-right">$0</span>
							</div>	

							<div class="input-field">
								
								<input type="radio" name="shipping" id="shipping2">
								<label for="shipping2"></label>
								<span class="col-md-5 col-sm-5 col-xs-6 no-padding">Express shipping</span>
								<span>2-3 days	</span>
								<span class="float-right">$20</span>
							</div>	

						</div>
*/?>

						<div class="clearfix"></div>
<?php /*
						<div class="col-md-12">
							<h5>BILLING ADDRESS</h5>
						</div>
						<div class="col-md-6">	
							<?php $selection->renderField('firstName', 'First name:'); ?>
						</div>
						<div class="col-md-6">	
							<?php $selection->renderField('lastName', 'Last name:'); ?>
						</div>
						<div class="col-md-6">	
							<?php $selection->renderField('phoneNumber', 'Telephone:'); ?>
						</div>
						<div class="col-md-6">
							<?php $selection->renderField('company', 'Company:'); ?>
						</div>
						<div class="col-md-6">
							<?php $selection->renderField('address1', 'Address:'); ?>
						</div>
						<div class="col-md-6">
							<?php $selection->renderField('zipCode', 'Zip code:'); ?>
						</div>
						<div class="col-md-6">
							<?php $selection->renderField('city', 'City:'); ?>
						</div>
						<div class="clearfix"></div>

						<div class="is-openSection shipping">
							<div class="col-md-6">
								<?php $selection->renderField('ship_to_another_address', 'Ship to another address?', false, array('js-openSection')); ?>
							</div>

							<div class="shipping-fields">
								<div class="col-md-12">
									<h5>SHIPPING ADDRESS</h5>
								</div>

								<div class="col-md-6">	
									<?php $selection->renderField('firstName', 'First name:', true); ?>
								</div>
								<div class="col-md-6">	
									<?php $selection->renderField('lastName', 'Last name:', true); ?>
								</div>
								<div class="col-md-6">	
									<?php $selection->renderField('phoneNumber', 'Telephone:', true); ?>
								</div>
								<div class="col-md-6">
									<?php $selection->renderField('company', 'Company:', true); ?>
								</div>
								<div class="col-md-6">
									<?php $selection->renderField('address1', 'Address:', true); ?>
								</div>
								<div class="col-md-6">
									<?php $selection->renderField('zipCode', 'Zip code:', true); ?>
								</div>
								<div class="col-md-6">
									<?php $selection->renderField('city', 'City:', true); ?>
								</div>
								<div class="col-md-6">
									<?php $selection->renderField('country', 'Country:', true); ?>
								</div>
							
							</div>
						</div>

						<div class="clearfix"></div>
*/ ?>
						<div class="col-md-12 orderItems">
							<h5>ORDER ITEMS</h5>
						</div>

						<div class="wrap-confirmation col-md-12">
							
							<div class="first">
								<div class="col-md-6 col-sm-6 col-xs-6"><p>Item</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-right">Size</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-right">Price</p></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><p class="text-right">Sub Total</p></div>
								<div id="js-selectedItems--selection">
									<?php get_template_part('parts/shop/checkout-selection'); ?>
								</div>
							</div>
							<div class="second">
								<div id="js-selectedTotals">
									<?php get_template_part('parts/shop/totals-selection'); ?>
								</div>
							</div>

							<?php $selection->renderField('newsletter', 'Join the community'); ?>
							<?php $selection->renderField('termsAndConditions', 'I agree to the <a href="' . get_permalink(get_page_by_path('terms-and-conditions')) . '" target="_blank">Terms & Conditions</a>'); ?>
						</div>

						<div class="col-md-12 placeOrder">
							<button class="u-mainButton" type="submit"><span>CONTINUE</span></button>
						</div>

						<div class="input-field col-md-12 returns">
							<p><a href="<?php echo get_permalink(get_page_by_path('returns')); ?>" target="_blank">Read our return policy</a></p>
						</div>

					</div>

<?php
					$selection->renderEndSelectionForm();
?>
				</div>
			</div>
		</section>

		<div class="clearfix"></div>

<?php 

	Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) );
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

	$country = $_SESSION['esc_store']['country'];
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
							<p class="no-margin"><a href="<?php bloginfo('url') ?>/shop">SHOP</a> / <a href="">CHECKOUT</a></p>
						</div>
						<div class="errorContainer">
<?php
						EscSelection::renderPossibleErrors();
?>
						</div>
<?php
					if(!EscSelection::hasSelection()) {
?>
						<div class="col-md-12">
							<h5>NO ITEMS SELECTED</h5>
							<p class="no-items-in-selection">You have no items in your selection <a href="<?php echo get_bloginfo('url'); ?>/shop">head to the shop to make add items to your selection</a></p>
						</div>
<?php
					} else {

						$selection->renderStartSelectionForm();

// Removed Nosto tag below
// <div class="nosto_element" id="cartpage-nosto-3"></div>
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
							<?php /* Commented out for the moment, reactivate by removing comment. */ ?>
<?php /*
							<div class="col-md-6">
								<?php $selection->renderField('internalComment_steam', 'Steam Handle: (optional)'); ?>
							</div>
							<div class="col-md-6">
								<?php $selection->renderField('internalComment_twitter', 'Twitter Handle: (optional)'); ?>
							</div>
 */
?>

<?php
// ADDED HIDDEN FIELD FOR CUSTOM TEE
if( isset($_SESSION['customId']) && strlen( $_SESSION['customId'] ) > 0 ) :
?>

	<input id="internalComment_customtee" type="hidden" name="internalComment[customtee]" value="<?php echo( $_SESSION['customId'] ); ?>">

<?php
endif;
?>
						</div>
						<div class="col-md-6 voucher is-openSection<?php echo (EscSelection::isVoucherSet() ? ' sectionOpen' : '') ?>">
							<?php $selection->renderField('newsletter', 'Join the community'); ?>
							<?php $selection->renderField('add_voucher', 'Add gift code/discount token', false, array('js-openSection')); ?>
							<div id="js-voucher-fields" class="voucher-fields">
							
							<?php get_template_part('parts/shop/voucher'); ?>

							</div>
						</div>

						<div class="col-md-12">
							<h5>ORDER ITEMS</h5>
						</div>

						<div class="wrap-confirmation col-md-12">
							<table>
								<tbody id="js-selectedItems--selection" class="first">
									<?php get_template_part('parts/shop/checkout-selection'); ?>
								</tbody>
								<tfoot id="js-selectedTotals" class="second">
									<?php get_template_part('parts/shop/totals-selection'); ?>
								</tfoot>
							</table>
						</div>

						<div class="clearfix"></div>
						<div class="col-md-12 paymentMethod">
							<h5>PAYMENT METHOD</h5>
							<div class="post-content german-terms" <?php if ( $country !== 'DE' ) echo 'style="display: none;"' ?>>
								<p>
									We offer Klarna Checkout in our checkout, which offers a simplified purchase experience. If choose to use Klarna your email address will be automatically transferred to Klarna AB, enabling the provision of Klarna Checkout.
								</p>
								<p>
									These
									<a href="https://cdn.klarna.com/1.0/shared/content/legal/terms/EID/de_de/checkout" target="_blank">User Terms</a> apply for the use of Klarna Checkout.
									<br/>
									<br/>
								</p>
							</div>
							<div class="col-md-12 no-padding">
							<div id="js-paymentFields" class="input-field">
								<?php get_template_part('parts/shop/payments-selection'); ?>
							</div>
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
						<div id="klarnaCheckout"></div>
						<div id="adyenCheckout">

							<div class="col-md-12">
								<h5>SHIPPING ADDRESS</h5>
							</div>
							<div class="errorContainer" style="display: none">

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
								<?php $selection->renderField('address1', 'Address:'); ?>
							</div>
							<div class="col-md-6">
								<?php $selection->renderField('zipCode', 'Zip code:'); ?>
							</div>
							<div class="col-md-6">
								<?php $selection->renderField('city', 'City:'); ?>
							</div>
							<div class="clearfix"></div>

							<div class="wrap-confirmation col-md-12">
								<input type="hidden" name="termsAndConditions" value="1" />
							</div>

							<div class="col-md-12 placeOrder">
								<button class="u-mainButton" type="submit"><span>CONTINUE TO PAYMENT</span></button>
							</div>

							<div class="input-field col-md-12 selection-returns">
								<p>By clicking CONTINUE you confirm that you have read, understood and accept our <a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions'))?>" target="_blank">Terms & Conditions</a> and <a href="<?php echo get_permalink(get_page_by_path('returns'))?>" target="_blank">Return Policy</a></p>
							</div>
						</div>
						<div id="paypalCheckout">
							<div class="wrap-confirmation col-md-12">
								<input type="hidden" name="termsAndConditions" value="1" />
							</div>

							<div class="col-md-12 placeOrder">
								<button class="u-mainButton" type="submit"><span>CONTINUE</span></button>
							</div>

							<div class="input-field col-md-12 selection-returns">
								<p>By clicking CONTINUE you confirm that you have read, understood and accept our <a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions'))?>" target="_blank">Terms & Conditions</a> and <a href="<?php echo get_permalink(get_page_by_path('returns'))?>" target="_blank">Return Policy</a></p>
							</div>
						</div>
					</div>

<?php
					$selection->renderEndSelectionForm();
				} //End if for products in selection.
?>
				</div>
			</div>
		</section>

		<div class="clearfix"></div>

<?php 

	Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) );
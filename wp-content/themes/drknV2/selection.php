<?php

/**
 *
 * Template Name: Selection
 *
*/

	get_template_part( 'parts/shared/header' );
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

<?php get_template_part( 'parts/shared/header' ); ?>
<?php get_template_part( 'parts/shared/header-nav-bar' ); ?>

	<section id="js-checkout" class="checkout">
		<div class="wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 text-center">
						<h1>Checkout</h1>
					</div>
				</div>
				<div class="row">
					<div class="errorContainer">
					<?php EscSelection::renderPossibleErrors(); ?>
					</div>
					<?php if(!EscSelection::hasSelection()) { ?>

						<div class="col-md-8 col-md-offset-2 div-center">
						<h2>NO ITEMS SELECTED</h2>
						<p class="no-items-in-selection">You have no items in your selection <a href="<?php echo get_bloginfo('url'); ?>/shop">head to the shop to make add items to your selection</a></p>
					</div>
					
					<?php } else {

						$selection->renderStartSelectionForm();

					?>
					<div class="col-md-6">
						<h2>INFORMATION</h2>
						<?php $selection->renderField('email', 'Email:'); ?>
						<div class="checkbox-s">
							<?php $selection->renderField('newsletter', 'Join the community'); ?>
						</div>
						<?php $selection->renderField('country', 'Country:'); ?>

						<div id="js-stateCont" class="<?php echo (EscSelection::showStates() ? '' : ' hide') ?>">
							<?php $selection->renderField('state', 'State:'); ?>
						</div>
						<div class="voucher is-openSection<?php echo (EscSelection::isVoucherSet() ? ' sectionOpen' : '') ?>">


							<div id="js-voucher-fields" class="voucher-fields">
								<div class="input-group">
									<?php get_template_part('parts/shop/voucher'); ?>
								</div>
							</div>
						</div>
						<h2>ORDER SUMMARY</h2>
						<div class="wrap-confirmation">
							<table style="width: 100%">
								<tbody id="js-selectedItems--selection" class="first">
								<?php get_template_part('parts/shop/checkout-selection'); ?>
								</tbody>
								<tfoot id="js-selectedTotals" class="second">
								<?php get_template_part('parts/shop/totals-selection'); ?>
								</tfoot>
							</table>
						</div>
					</div>



					<div class="paymentMethod hidden">
						<h2>PAYMENT METHOD</h2>
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

					<div class="col-md-6">
						<h2>SHIPPING ADDRESS</h2>
						<div class="errorContainer" style="display: none"></div>

						<?php $selection->renderField('firstName', 'First name:'); ?>

						<?php $selection->renderField('lastName', 'Last name:'); ?>

						<?php $selection->renderField('phoneNumber', 'Telephone:'); ?>

						<?php $selection->renderField('address1', 'Address:'); ?>

						<?php $selection->renderField('zipCode', 'Zip code:'); ?>

						<?php $selection->renderField('city', 'City:'); ?>

						<input type="hidden" name="termsAndConditions" value="1" />
						<div class="btn-wrapper">
							<button class="u-mainButton inverted-btn" type="submit"><span>CONTINUE TO PAYMENT</span></button>
						</div>
						<p>By clicking CONTINUE you confirm that you have read, understood and accept our <a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions'))?>" target="_blank">Terms & Conditions</a> and <a href="<?php echo get_permalink(get_page_by_path('returns'))?>" target="_blank">Return Policy</a></p>
					</div>

					<?php
							$selection->renderEndSelectionForm();
						} //End if for products in selection.
					?>
				</div>
			</div>
		</div>
	</section>


<?php get_template_part( 'parts/shared/footer' ); ?>
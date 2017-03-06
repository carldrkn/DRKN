<?

	//Helper functions

	function prettyJSON($json, $tab = '  ') {
		$json = (string)$json;
		$return = '';
		$indent = 0;
		$line = "\n";
		$last = '';
		for($a = 0; $a < strlen($json); ++$a) {
			$c = $json[$a];
			if(ord($c) <= 0x20)
				continue;
			if($c == '"') {
				for($b = ''; ++$a < strlen($json) && ($json[$a] != '"' || $b == "\\");) {
					$c .= $json[$a];
					$b = ($json[$a] == '\\' && $b == '\\') ? '' : $json[$a];
				}
				$c .= '"';
			}
			if($c == '}' || $c == ']')
				$return .= $line = "\n" . str_repeat($tab, $indent ? --$indent : 0);
			else if($c != ',' && in_array($last, array('{', '}', '[', ']', ',')))
				$return .= $line;
			if($c == '[' || $c == '{')
				$line = "\n" . str_repeat($tab, ++$indent);
			else if($c == ':')
				$c = ': ';
			$return .= $last = $c;
		}
		return $return;
	}

	function esc_create_checkout() {

		$success = 19;
		$fail = 21;

		if($_REQUEST['get_address']) {
			return;
		}

		if($_REQUEST['subscription']) {
			//Fix requests so that they match Shop API
			$plugin_options = get_option('esc_options');

			//Need to check information

			$request = array(
				'secret' => $plugin_options['esc_subscription_code'],
				'pricelist' => 'SEK',
				'payment' => 'dummy',
				'doneurl' => get_permalink($success),
				'failurl' => get_permalink($fail),
				'name' => $_POST['address_firstName'],
				'sname' => $_POST['address_lastName'],
				'address' => $_POST['address_address1'],
				'coaddress' => $_POST['address_address2'],
				'city' => $_POST['address_city'],
				'zipcode' => $_POST['address_zipCode'],
				'state' => '',
				'country' => $_POST['address_country'],
				'email' => $_POST['address_email'],
				'phone' => $_POST['address_phoneNumber'],
				'package[]' => $_POST['package'],
				'sendNewsletter' => $_POST['address_newsletter'],
				'pnr' => ''
			);

			$str = '';
			foreach($request as $key => $val) { $str .= ($str?'&':'').$key.'='.urlencode($val); }

			$rest = esc_rest('order', 'subscription', false);
			$payment = $rest->post($str, false);
			$payment = @$payment['payment'];
			$httpCode = $rest->httpCode();

			if($httpCode != 200) {
				return $payment;
			} else {

				switch(@$payment['type']) {
					case 'form':
						echo $payment['formHtml'];
						break;
					case 'url':
						wp_redirect($payment['data']);
						break;
					case 'success':
						wp_redirect(get_permalink($success));
						break;
					case 'failed':
						wp_redirect(get_permalink($fail));
						break;
				}

				die;
			}

		} else {
			//POST with json object
			//payment method -> string
			//payment return page -> string
			//payment failed page -> string
			//address -> array() + newsletter + identityNumber
			//shipping address -> array()
			$request = array(
				'paymentReturnPage' => get_permalink($success), //receipt
				'paymentFailedPage' => get_permalink($fail) //failed page
			);
	
			foreach ($_POST as $formKey => $formValue) {
				if(strpos($formKey, '_') !== false) {
					$split = explode('_', $formKey);
					if(count($split) == 2)
						$request[$split[0]][$split[1]] = $formValue;
				} else {
					$request[$formKey] = $formValue;
				}
			}

			if($_POST['shippingAddress_used'] !== '1') {
				//don't send shipping address
				unset($request['shippingAddress']);
			}

			$rest = esc_rest('selections/'.$_SESSION['silk_store']['selection_id'].'/payment');

			$payment = $rest->post($request);
			$httpCode = $rest->httpCode();

			if($httpCode != 200) {
				die('test2');
				return $payment;
			} else {

				switch(@$payment['action']) {
					case 'form':
						echo $payment['formHtml'];
						break;
					case 'redirect':
						wp_redirect($payment['url']);
						break;
					case 'success':
						wp_redirect(get_permalink($success));
						break;
					case 'failed':
						wp_redirect(get_permalink($fail));
						break;
				}

				die;
			}
			
		}

	}

	function esc_create_selection() {
		if(isset($_REQUEST['update_selection']) && isset($_REQUEST['post_id'])) {
			if(!isset($_SESSION['silk_store']['selection_id'])) {				
				
				$create_selection = esc_rest('selections')->post($_SESSION['silk_store']);
				if(!empty($create_selection['selection'])) {
					$_SESSION['silk_store']['selection_id'] = $create_selection['selection'];
				} else {
					//selection not created...
					//fix later - error on 404 return
				}
			}

			if(isset($_SESSION['silk_store']['selection_id'])) {

				//Sanitize data
				//$qnty = isset($_REQUEST['add_item']) ? intval($_REQUEST['quantity']) : 1;
				$qnty = 1;
				
								
				$add_item = isset($_REQUEST['add_item']) ? esc_sI($_REQUEST['add_item']) : false;
				$remove_item = isset($_REQUEST['remove_item']) ? esc_sI($_REQUEST['remove_item']) : false;
				$delete_item = isset($_REQUEST['delete_item']) ? esc_sI($_REQUEST['delete_item']) : false;
				$post_id = intval($_REQUEST['post_id']);

				if($add_item !== false) {
					$silk_selection = esc_rest('selections/'.$_SESSION['silk_store']['selection_id'].'/items/'.$add_item.'/quantity/'.$qnty)->post();					
				} else if($remove_item !== false) {
					$silk_selection = esc_rest('selections/'.$_SESSION['silk_store']['selection_id'].'/items/'.$remove_item.'/quantity/'.$qnty)->delete();
				} else if ($delete_item !== false) {
					$silk_selection = esc_rest('selections/'.$_SESSION['silk_store']['selection_id'].'/items/'.$delete_item)->delete();
				}

				if($silk_selection !== false) {
					$_SESSION['selection'] = $silk_selection;
					$wp_selection = isset($_SESSION['wp_selection']) ? $_SESSION['wp_selection'] : array();
					foreach ($silk_selection['items'] as $item) {
						if(empty($wp_selection[$item['item']])) {
							$wp_selection[$item['item']] = array('post_id' => $post_id);
						}
					}
					$_SESSION['wp_selection'] = $wp_selection;
				}
			}

		}
	}

	function esc_get_availability($jsonParams) {

		$market = $_SESSION['silk_store']['market'];
		$pricelist = $_SESSION['silk_store']['pricelist'];
		$price = false;
		$stock = false;

		//Not in market don't show product
		if(!isset($jsonParams['markets'][$market])) return array();

		//Get Pricelist
		if(isset($jsonParams['markets'][$market]['pricesByPricelist'][$pricelist])) {
			$price = $jsonParams['markets'][$market]['pricesByPricelist'][$pricelist]['price'];
		}

		//If theres is stock
		$item = reset($jsonParams['items']);
		$stock = $item["stockByMarket"][$market];

		return array('price' => $price, 'stock' => $stock);

	}

	function esc_sI($str) {
		$str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
		$str = htmlentities($str, ENT_QUOTES, 'UTF-8');
		return $str;
	}

	function esc_add_to_selection($post_id, $silk_item, $hasSubscription = false) {

		ob_start();
?>
		<a class="button to-checkout" href="/kassa">Gå till kassan</a>
		<div class="add-to-selection">
			<form class="to-selection" action="" method="POST">
				<input type="hidden" name="update_selection" value="1" />
				<input type="hidden" name="post_id" value="<?=$post_id?>" />
				<input type="hidden" name="add_item" value="<?=$silk_item?>" />
				<div class="qnty-selector">
					<label class="choose-qnty">Antal</label>
					<select name="quantity">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<button class="button" type="submit" href="#">Lägg i varukorg</button>
			</form>
		</div>
<?
		if($hasSubscription) {

?>
			<div class="or-section">eller</div>
			<div class="price"><?=(isset($hasSubscription['displayPrice'])?$hasSubscription['displayPrice'].' / gång':'')?></div >
			<div class="add-to-selection">
				<form action="/kassa" method="POST">
					<input type="hidden" name="subscribe" value="1">
					<input type="hidden" name="post_id" value="<?=$post_id?>" />
					<button class="button" type="submit">Prenumerera</button>
					<span class="information text-center"><?=@$hasSubscription['intervalDescription']?></span>
				</form>
			</div>
<?
		}

		$str = ob_get_contents();
		ob_end_clean();
		return $str;

	}

	function esc_checkout_selection($items = array()) {
		$before_receipt = false;

		if(empty($items)) {
			$items = $_SESSION['selection']['items'];
			$before_receipt = true;
		}
		$posts = $_SESSION['wp_selection'];

		ob_start();

		foreach ($items as $item) {
			//Retrieve post info
			$post_id = $posts[$item['item']]['post_id'];
			$post_data = get_post($post_id,'ARRAY_A');
			$meta_data = json_decode(get_post_meta($post_id, 'json', true ), true);
			$media = $meta_data['media'][0]['sources']['thumb'];

?>

			<div class="row">
				<div class="large-5 columns">
					<img alt="<?=$post_data['post_title']?>" src="<?=$media['url']?>" />
				</div>
				<div class="large-5 columns">
					<p><?=$post_data['post_title']?></p>
					<p>- <?= $item['quantity']; ?> +</p>
					<p><?= $item['priceEach']; ?></p>
				</div>
				<div class="large-2 columns">x</div>
			</div>

<?php /*
			<div class="row checkout-selection">
				<div class="col-md-12">
					<div class="row">
					<a href="" class="col-md-5 col-sm-5 col-xs-12">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-4"><img alt="" src="<?=$media['url']?>" /></div>
							<div class="col-md-8 col-sm-8 col-xs-8"><span><?=$post_data['post_title']?><br><strong><?=($before_receipt?'':$item['quantity'].' x ').($item['anyDiscount']?'<span class="line-through lighter">'.$item['priceEachBeforeDiscount'].'</span> '.$item['priceEach']:$item['priceEach'])?></strong></span></div>
						</div>	
					</a>
					
					<?php /*
					<?
						if($before_receipt) {
					?>
					
					
					<div class="col-md-3 alter-amount col-sm-3 col-xs-8">
						quantity,update_selection,post_id,add_item,remove_item,delete_item
						<a class="change-amount remove" href="?update_selection=1&quantity=1&post_id=<?=$post_id?>&remove_item=<?=$item['item']?>" alt="Decrease quantity">-</a>
						<span class="co-qnty"><?=$item['quantity']?></span>
						<a class="change-amount add" href="?update_selection=1&quantity=1&post_id=<?=$post_id?>&add_item=<?=$item['item']?>" alt="Increase quantity">+</a>
					</div>
					<div class="col-md-4 alter-amount col-sm-4 col-xs-4">	
						<a class="change-amount delete" href="?update_selection=1&quantity=1&post_id=<?=$post_id?>&delete_item=<?=$item['item']?>" alt="Remove item from shopping bag">&times;</a>
					</div>
					<?
						}
					?>	
			
					</div>
					<hr />
				</div>
			</div>
*/ ?>	
<?
		}

		$str = ob_get_contents();
		ob_end_clean();
		return $str;

	}

	function esc_checkout_totals($totals = array(), $items = array()) {
		$before_receipt = false;

		if(empty($totals)) {
			$totals = $_SESSION['selection']['totals'];
			$before_receipt = true;
		}
		if(empty($items)) $items = $_SESSION['selection']['items'];

		ob_start();
		
?>
		<div id="checkout-cont" class="checkout-cont" data-item-count="<?=count($items)?>"></div>

		<div class="checkout-totals">
			<div class="row full-width collapse">
				<div class="large-6 columns">Subtotal</div>
				<div class="large-6 columns"><?=$totals['itemsTotalPrice']?></div>				
			</div>		
			<div class="row full-width collapse">
				<div class="large-6 columns">Shipping</div>
				<div class="large-6 columns"><?=$totals['shippingPrice']?></div>				
			</div>
			<div class="row full-width collapse">
				<div class="large-6 columns"><?=($before_receipt?'Grand total':'Paid')?></div>
				<div class="large-6 columns"><?=$totals['grandTotalPrice']?></div>
			</div>				
		</div>
			
				
<?
/*
			if($_SESSION['selection']['discounts']['anyDiscount']) {
?>
				<li class="sales-tax lighter-text">Total rabatt<span class="right-side"><?=$totals['totalDiscountPrice']?></span></li>
<?
			}
 */
 
 
?>
<?php /* <li class="sales-tax lighter-text">Moms<span class="right-side">(<?=$totals['grandTotalPriceTax']?>)</span></li>

		<?=($before_receipt?'Att betala':'Betalt')?><br><span class="lighter">(inkl moms &amp; leverans)</span><br/><span class="total"><?=$totals['grandTotalPrice']?></span></h3>
 */ ?>
 
 
<?
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
	}

	function esc_checkout_subscription($post_id, $freight = 'Frakt okänd') {
		
		$post_data = get_post($post_id,'ARRAY_A');
		$meta_data = json_decode(get_post_meta($post_id, 'json', true ), true);
		$media = $meta_data['media'][0]['sources']['litomove-small'];
		$subscription = $meta_data['subscription'];
		ob_start();
?>
		<h2>Prenumerera</h2>
		<div class="row">
			<div class="col-md-4">
				<img alt="" src="<?=$media['url']?>" class="col-md-6 col-sm-6"/>
			</div>
			<div class="col-md-6">
				<span><?=isset($subscription['name']) && !empty($subscription['name'])?$subscription['name']:$post_data['post_title']?><br><strong><?=$subscription['displayPrice']?></strong></span>
				<span class="information"><?=$subscription['intervalDescription']?><br>Frakt tillkommer på <?=$freight?></span>
			</div>
		</div>
		<?php if($hide):?>
			<ul class="ul-clean row">
			<li class="prod-info co-prod-info col-md-6 col-sm-6 col-xs-12">
				<a href="<?=get_permalink($post_id)?>" class="row">
					<img alt="" src="<?=$media['url']?>" class="col-md-6 col-sm-6"/>
					<div class="col-md-6 col-sm-6">
						<span><?=isset($subscription['name']) && !empty($subscription['name'])?$subscription['name']:$post_data['post_title']?><br><strong><?=$subscription['displayPrice']?></strong></span>
						<span class="information"><?=$subscription['intervalDescription']?><br>Frakt tillkommer på <?=$freight?></span>
					</div>
				</a>
			</li>
		</ul>
		<?php endif;?>
<?
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
	}

	function esc_voucher() {

		$vouchers = $_SESSION['selection']['discounts']['vouchers'];
		$hasVoucher = (count($vouchers) > 0);

		ob_start();
?>
		<h4 class="heading-cb"><label for="address_vou"><?=$hasVoucher?'Din rabattkod':'Har du en rabattkod?'?><span class="input-area"><input type="checkbox" name="address_vou" id="address_vou"<?=($hasVoucher?' checked="checked"':'')?> value="1"/><span class="check-butt"></span></span></label></h4>
		<div class="trigger-section">
			<form id="voucher-form" class="clearfix voucher-cont co-form" method="post" action="">
				<input type="hidden" name="update_voucher" value="1">
				<ul class="ul-clean co-form">
					<li>
<?					if($hasVoucher) {
						//Show voucher
?>
						<input type="hidden" name="voucher_code_remove" value="<?=$vouchers[0]['voucher']?>">
						<label for="voucher_code">Rabattkoden</label><input id="voucher_code" disabled type="text" name="voucher_code" value="<?=$vouchers[0]['voucher']?>" />
<?					} else {
?>
						<label for="voucher_code">Rabattkod <span class="lighter-text">(om tillämpligt)</span></label><input id="voucher_code" type="text" name="voucher_code" value="" />
<?					}
?>
					</li>
					<li>
						<button type="submit" class="button smaller right-side"><?=($hasVoucher?'Ta bort':'Lägg till')?></button>
					</li>
				</ul>
			</form>
		</div>
<?
		$str = ob_get_contents();
		ob_end_clean();
		return $str;
	}

	//Setup REST API
	function esc_rest($uri, $whichAPI = 'shop', $sendHeader = true, $urlStart = false) {
		$plugin_options = get_option('esc_options');
		if($urlStart === false) {
			if($whichAPI === 'shop') {
				$urlStart = rtrim($plugin_options['esc_silk_url'], '/ ');
			} else {
				$urlStart = rtrim($plugin_options['esc_subscription_url'], '/ ');
			}
		}
		if($sendHeader) {
			$authorization = $plugin_options['esc_authorization_code'];
			return rest()->url($urlStart.'/'.$uri)->header('API-Authorization: '.$authorization);
		} else {
			if($whichAPI !== 'shop') {
				$code = $plugin_options['esc_subscription_code'];
				return rest()->url($urlStart.'/'.$uri.'?secret='.$code.'&pricelist=SEK');
			}
			return rest()->url($urlStart.$uri);
		}
	}

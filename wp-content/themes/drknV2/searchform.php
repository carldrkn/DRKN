<?php

/**
 * Created by PhpStorm.
 * User: eskilkeskikangas
 * Date: 19/10/16
 * Time: 15:46
 */

$argsShop = array(
	'post_type' => 'page',
	'posts_per_page' => 1,
	'meta_key' => '_wp_page_template',
	'meta_value' => 'shop_landing.php'
);

$wpQueryShop = new WP_Query( $argsShop );
$shopPage = reset( $wpQueryShop->posts );

$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . get_permalink( $shopPage ) . '">
	<div>
		<label class="screen-reader-text" for="sq">' . _x( 'Search:', 'label' ) . '</label>
		<input type="text" value="' . get_search_query() . '" name="sq" id="sq" />
		<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
	</div>
</form>';

echo $form;
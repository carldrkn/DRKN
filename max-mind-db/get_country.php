<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 09/05/15
 * Time: 18:10
 */

function mmd_get_client_ip() {

	if ( isset($_SERVER['REMOTE_ADDR']) )
		return $_SERVER['REMOTE_ADDR'];

	if ( isset($_SERVER['REMOTE_HOST']) )
		return $_SERVER['REMOTE_HOST'];

	return null;
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';
use MaxMind\Db\Reader;

function mmd_get_country_code() {
	$database_file = dirname(__FILE__) . '/GeoLite2-Country.mmdb';
	$reader = new Reader($database_file);

	$result = $reader->get(mmd_get_client_ip());

	if ( isset($result['country']) && isset($result['country']['iso_code'] ) )
		return $result['country']['iso_code'];
	else
		return null;
}


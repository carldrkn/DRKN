<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */


if ( !isset($_COOKIE["DRKN_ISO_CODE"]) ) {
	include 'max-mind-db/get_country.php';
	$code = mmd_get_country_code();
	setcookie("DRKN_ISO_CODE", $code, time()+3600*24*60*60, '/');
	$_SERVER['geo_location'] = $code;
} else {
	$code = $_COOKIE["DRKN_ISO_CODE"];
	$_SERVER['geo_location'] = $code;
}

define('GET_LOCATION', $code);



/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );

<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */


define('GOOGLE_ANALYTICS_ID', 'UA-61680664-1');

//define('WP_DEBUG_LOG', true);

ini_set('log_errors', '1');
ini_set('display_errors', '0');
ini_set( 'error_reporting', E_ALL ^ E_NOTICE ^ E_WARNING ); /* the php parser to  all errors, excreportept notices.  */

/** Amazon Web Services settings **/
define( 'AWS_ACCESS_KEY_ID', 'AKIAIFZ4DUH5KSFJORIA' );
define( 'AWS_SECRET_ACCESS_KEY', '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' );

define('WP_HOME','http://drkn:8888/');
define('WP_SITEURL','http://drkn:8888/');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'drkn-wp');

define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'E!i|Z%~]klR-|<zKTt!+5o!@5]7qG?sE7&#k@u--U:9M!^]ys#[U4.i%5Kdk*@FK1');
define('SECURE_AUTH_KEY',  'U:HKj(|&*GX|VUH!3? TL%Z;fIc^?T+uT#da@gW@c~[j_5F=ua5kw,CNg$aqv#CjS');
define('LOGGED_IN_KEY',    'Oer-Sj-=Z^:_+6:N|V,&++-8s^>2@yY$Q??^t,i@@-3_TM;z|h+j%|]k+(tmAy+%I');
define('NONCE_KEY',        '&0^)`$!~fST]3nVUw=y9{3w2I3iF~<yOg8t&aB^!R5shcrw~G|<@+%!4gI]31gLeX');
define('AUTH_SALT',        '4/%|*3oK0DI{ph&6YJB/Wd%/?X&fVi[]Wy&?e[}C:+`m-zF^hL)D~p+_RU?V)gLyP');
define('SECURE_AUTH_SALT', 'Pw(YM&QRfK9/kRJj^1A2aV||T#]`}BF32=,}3*hVRUw89nU$E[Q,Bh$4,f?MkgF|Z');
define('LOGGED_IN_SALT',   '(CH-0.N*+J4oW7,k2eFg+1yZDIFm<vhOgK@aTP8<PxSxaL(5R4w<|^wxvcvz;i{8s');
define('NONCE_SALT',       '=f2tm12)v-wB]~i*sYE8*7MzK<{$xvhg8x?XSX|3DyuE4@a`mzJZZyAF|t8&$/YWEl');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

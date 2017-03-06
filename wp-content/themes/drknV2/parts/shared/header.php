<?php

$attachments = get_post_meta( $post->ID, 'attachment_ids', true );
$social_image = get_post_meta( $post->ID, 'social_image', true );

if( !$attachments ) {
	$attachments = array();
}

$meta_desc = 'Welcome to DRKN, A streetwear brand inspired by the gaming community and the digital culture. Shop online at drkn.com worldwide shipping.';
$excerpt = get_the_excerpt();

if( !empty( $excerpt ) ) {
	$meta_desc = esc_attr( $excerpt );
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>

		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


		<meta name="twitter:card" content="summary_large_image" />
		<meta name="twitter:site" content="@wearedrkn" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:title" content="<?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?>" />
		<meta name="description" content="<?php echo $meta_desc; ?>">
		<meta property="og:description" content="<?php echo $meta_desc; ?>" />

		<?php

		if( $social_image ) {
			echo '<meta property="og:image" content="' . $social_image . '" />';
			echo '<meta property="og:image:width" content="1200" />';
			echo '<meta property="og:image:height" content="630" />';
		} else {
			foreach( $attachments as $attachment_id ) {
				$image = wp_get_attachment_image_src( $attachment_id, 'full' );

				echo '<meta property="og:image" content="' . $image[ 0 ] . '" />';
				echo '<meta property="og:image:width" content="' . $image[ 1 ] . '" />';
				echo '<meta property="og:image:height" content="' . $image[ 2 ] . '" />';
			}
		}
		?>

		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
		<script>window.drkn = window.drkn || {};drkn.base_uri = "<?php bloginfo('url') ;?>/"</script>
		<?php wp_head(); ?>

		<script>window.console = window.console || { log: function() {} };</script>
		<script>
			window.fbAsyncInit = function() {
				FB.init( {
					appId: '1573069796278009',
					xfbml: true,
					version: 'v2.3'
				} );
			};

			( function( d, s, id ) {
				var js, fjs = d.getElementsByTagName( s )[0];
				if( d.getElementById( id ) ) {
					return;
				}
				js = d.createElement( s );
				js.id = id;
				js.src = "//connect.facebook.net/en_US/sdk.js";
				fjs.parentNode.insertBefore( js, fjs );
			}( document, 'script', 'facebook-jssdk' ) );
		</script>
		<script type="text/javascript">
			//<![CDATA[
			( function() {
				function a( a ) {
					var b, c, d = window.document.createElement( "iframe" );
					d.src = "javascript:false", ( d.frameElement || d ).style.cssText = "width: 0; height: 0; border: 0";
					var e = window.document.createElement( "div" );
					e.style.display = "none";
					var f = window.document.createElement( "div" );
					e.appendChild( f ), window.document.body.insertBefore( e, window.document.body.firstChild ), f.appendChild( d );
					try {
						c = d.contentWindow.document
					} catch( g ) {
						b = document.domain, d.src = "javascript:var d=document.open();d.domain='" + b + "';void(0);", c = d.contentWindow.document
					}
					return c.open()._l = function() {
						b && ( this.domain = b );
						var c = this.createElement( "scr".concat( "ipt" ) );
						c.src = a, this.body.appendChild( c )
					}, c.write( "<bo".concat( 'dy onload="document._l();">' ) ), c.close(), d
				}
				var b = "nostojs";
				window[b] = window[b] || function( a ) {
					( window[b].q = window[b].q || [ ] ).push( a )
				}, window[b].l = new Date;
				var c = function( d, e ) {
					if( !document.body )
						return setTimeout( function() {
							c( d, e )
						}, 30 );
					e = e || { }, window[b].o = e;
					var f = document.location.protocol, g = [ "https:" === f ? f : "http:", "//", e.host || "connect.nosto.com", e.path || "/include/", d ].join( "" );
					a( g )
				};
				window[b].init = c
			} )();

			nostojs.init( 'xkc68y8j' );

			//]]>
		</script>
	</head>

	<body <?php body_class(); ?>>
		<div class="nosto_variation" style="display:none"><?php echo EscGeneral::getCurrentPricelistName(); ?></div>

		<!-- Google Tag Manager -->
		<noscript>
			<iframe src="//www.googletagmanager.com/ns.html?id=GTM-NZ5MQV" height="0" width="0" style="display:none;visibility:hidden"></iframe>
		</noscript>

		<script>
			( function( w, d, s, l, i ) {
				w[l] = w[l] || [ ];
				w[l].push( { 'gtm.start': new Date().getTime(), event: 'gtm.js' } );

				var f = d.getElementsByTagName( s )[0],
					j = d.createElement( s ), dl = l != 'dataLayer' ? '&l=' + l : '';
					j.async = true;j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
					f.parentNode.insertBefore( j, f );
			} )( window, document, 'script', 'dataLayer', 'GTM-NZ5MQV' );
		</script>
		<!-- End Google Tag Manager -->

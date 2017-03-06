<?php
include 'config.php';

$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

function sanitize_output($buffer) {

	$search = array(
		'/\>[^\S ]+/s',  // strip whitespaces after tags, except space
		'/[^\S ]+\</s',  // strip whitespaces before tags, except space
		'/(\s)+/s'       // shorten multiple whitespace sequences
	);

	$replace = array(
		'>',
		'<',
		'\\1'
	);

	$buffer = preg_replace($search, $replace, $buffer);


	$message =
'

<!--
      :::::::::  :::::::::  :::    ::: ::::    :::
     :+:    :+: :+:    :+: :+:   :+:  :+:+:   :+:
    +:+    +:+ +:+    +:+ +:+  +:+   :+:+:+  +:+
   +#+    +:+ +#++:++#:  +#++:++    +#+ +:+ +#+
  +#+    +#+ +#+    +#+ +#+  +#+   +#+  +#+#+#
 #+#    #+# #+#    #+# #+#   #+#  #+#   #+#+#
#########  ###    ### ###    ### ###    ####

You read. We serve. Four episodes. Enter 8 digit access code when the gate is open. First one to enter will be respectfully rewarded. Eternally grateful to our original pioneer*.

           __                       __                                           __                   __
______    |__|_____   ____ ___.__._/  |_  ____  ____ ______   ____     ____     |__|____    ____     |__| ____
\____ \   |  \____ \ / ___<   |  |\   __\/ ___\/  _ \\____ \ / ___\  _/ __ \    |  \__  \ _/ ___\    |  |/ __ \
|  |_> >  |  |  |_> > /_/  >___  | |  | \  \__(  <_> )  |_> > /_/  > \  ___/    |  |/ __ \\  \___    |  \  ___/
|   __/\__|  |   __/\___  // ____| |__|  \___  >____/|   __/\___  /   \___  >\__|  (____  /\___  >\__|  |\___  >
|__|  \______|__|  /_____/ \/                \/      |__|  /_____/        \/\______|    \/     \/\______|    \/


This is OUR world now... the world of the electron soon overshadows the real one. From Star Citizen to DeepMind. We are too many to not set the rules. From players and creators to hackers and machines. Be proud. Promote our culture. As the world DRKNs. Another age must be the judge. Connect at #weareDRKN.

-->


';


	return $message . $buffer;
}

function encodeURIComponent($str) {
	$revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
	return strtr(rawurlencode($str), $revert);
}

$url = 'http://www.drkn.com/';

$facebook_share_link =
	'https://www.facebook.com/sharer/sharer.php'
	. '?u=' . encodeURIComponent( $url );
/*
$facebook_share_link =
	'https://www.facebook.com/dialog/feed?'.
	'app_id=1573069796278009' .
	'&display=popup' .
	'&name=DRKN' .
	'?link=' . encodeURIComponent( $url ) .
	'?picture=' . encodeURIComponent( 'https://i.vimeocdn.com/video/516216031.jpg?mw=960&mh=540' ) .
	'?source=' . encodeURIComponent( 'http://vimeo.com/moogaloop.swf?clip_id=127149560&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=00ADEF&amp;fullscreen=1&amp;autoplay=0&amp;loop=0' )
	;
	//'&redirect_uri=http://www.drkn.com/';
*/
$twitter_share_link =
	'http://twitter.com/share'
	. '?url=' . encodeURIComponent( $url )
 	. '&text=' . encodeURIComponent('DRKN -');

$tumblr_share_link =
	'http://tumblr.com/widgets/share/tool'
	. '?canonicalUrl=' . encodeURIComponent( $url )
	. '&type=video'
	. '&content=' . encodeURIComponent( $url )
	. '';

setcookie(
	"drkn-teaser-site",
	"1",
	time() + (10 * 365 * 24 * 60 * 60)
);


ob_start("sanitize_output");
?>
<!DOCTYPE html>
<html>
<head lang="en">

    <meta charset="UTF-8">
    <title>DRKN</title>
    <link rel="stylesheet" href="<?php echo $cdn ?>css/style.css?v=4"/>

	<?php if ( true ): ?>
    <script src="<?php echo $cdn ?>js/script.js?v=3"></script>
	<?php else: ?>
    <script src="js/jquery-1.11.2.js"></script>
    <script src="js/imagesloaded.js"></script>
    <script src="js/webfont.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/teaser.js"></script>
	<?php endif; ?>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="We've taken the first step. Join us as the world DRKNs."/>
	<link rel="canonical" href="<?php echo $url ?>">

	<meta property="og:site_name" content="DRKN"/>
	<meta property="fb:app_id" content="1573069796278009" />
	<meta property="og:url"
          content="<?php echo $url ?>" />
    <meta property="og:type"
          content="website" />
    <meta property="og:title"
          content="DRKN" />
    <meta property="og:description"
          content="We've taken the first step. Join us as the world DRKNs." />
	<?php if ( false ): ?>
    <meta property="og:image"
          content="<?php echo $url ?>img/logo.jpg" />
	<?php endif; ?>

	<meta property="og:image" content="https://i.vimeocdn.com/video/517833625.jpg?mw=960&mh=540"/>
	<?php if ( false ): ?>
	<meta property="og:video" content="http://player.vimeo.com/video/127149560" />
	<meta property="og:video:type" content="text/html" />
	<meta property="og:video" content="http://vimeo.com/moogaloop.swf?clip_id=127149560&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=1&amp;color=00ADEF&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" />
	<meta property="og:video:type" content="application/x-shockwave-flash" />
	<?php endif; ?>
	<meta property='og:video' content='https://www.youtube.com/v/eOreJXe_DgU' />
	<meta property="og:video:height" content="360" />
	<meta property="og:video:width" content="640" />

	<meta name="twitter:card"
		  content="player" />
	<meta name="twitter:title"
          content="DRKN" />
	<?php if (false): ?>
	<meta name="twitter:image"
          content="<?php echo $url ?>img/logo.jpg" />
	<?php endif; ?>
	<meta property="twitter:image" content="https://i.vimeocdn.com/video/517833625.jpg?mw=960&mh=540"/>
	<meta name="twitter:player"
          content="https://player.vimeo.com/video/127149560" />
	<meta property="twitter:player:height" content="360" />
	<meta property="twitter:player:width" content="640" />


	<link rel="shortcut icon" href="favicon.ico">

	<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-61680664-1', 'auto');
		ga('send', 'pageview');
	</script>

	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '1573069796278009',
				xfbml      : true,
				version    : 'v2.3'
			});
		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

</head>
<body>
    <header>
        <div class="left-side">
            <div class="logo">
				<img src="<?php echo $cdn ?>img/logo.jpg" alt=""/>
            </div>
            <div class="share-buttons">
                <p>Share</p>

                <a data-name="facebook" href="<?php echo $facebook_share_link ?>" target="_blank">
                    <img src="<?php echo $cdn ?>img/icon-facebook.jpg" alt=""/>
                </a>
                <a data-name="twitter" href="<?php echo $twitter_share_link ?>" target="_blank">
                    <img src="<?php echo $cdn ?>img/icon-twitter.jpg" alt=""/>
                </a>
                <a data-name="tumblr" href="<?php echo $tumblr_share_link ?>" target="_blank">
                    <img src="<?php echo $cdn ?>img/icon-tumblr.jpg" alt=""/>
                </a>

				<p class="countdown" style="">

				</p>
            </div>
        </div>
        <div class="right-side">
            <div class="right-side-inner">
                <div class="right-side-inner-content">
                    <div class="follow">
                        <p>Follow DRKN</p>
                        <a data-name="facebook" href="https://www.facebook.com/wearedrkn" target="_blank">
                            <img src="<?php echo $cdn ?>img/icon-facebook.jpg" alt=""/>
                        </a>
                        <a data-name="twitter" href="http://twitter.com/wearedrkn" target="_blank">
                            <img src="<?php echo $cdn ?>img/icon-twitter.jpg" alt=""/>
                        </a>
                        <a data-name="instagram" href="http://instagram.com/wearedrkn" target="_blank">
                            <img src="<?php echo $cdn ?>img/icon-instagram.jpg" alt=""/>
                        </a>
                        <a data-name="tumblr" href="http://wearedrkn.tumblr.com/" target="_blank">
                            <img src="<?php echo $cdn ?>img/icon-tumblr.jpg" alt=""/>
                        </a>
                    </div>
                    <div class="connect">
                        <a href="#" class="toggle-dialog">
                            Get news alerts
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="circles">
			<p>Episode</p>
			<div class="circle active"></div>
            <div class="circle active"></div>
            <div class="circle active"></div>
            <div class="circle active"></div>
        </div>
    </header>

    <article>
        <div class="video-overlay"></div>
        <iframe
            src='https://player.vimeo.com/video/127149560?autoplay=1&loop=1'
            frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen
            ></iframe>
    </article>

    <div class="newsletter-dialog">
		<div class="close-dialog">&times;</div>
		<input type="text" placeholder="Enter E-mail"/>
		<p class="form-error">Invalid e-mail</p>
		<div class="button">
			<div class="button-left"><img src="<?php echo $cdn ?>img/button-side-left.jpg" alt=""/></div>
			<div class="button-title">Sign up</div>
			<div class="button-right"><img src="<?php echo $cdn ?>img/button-side-right.jpg" alt=""/></div>
		</div>

    </div>

</body>
</html>
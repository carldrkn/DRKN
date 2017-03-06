/**
 * Header fix
 */
$(function(){

	var $left_side = $('.left-side'),
		$right_side = $('.right-side');

	$(window).bind('resize', function(){
		$right_side.css('height', $left_side.height());
	});
});

/**
 * Flash of unstyled content fix
 */
$(function(){
	$('img').imagesLoaded(function(){
		$('body').css('opacity', 1);
	});

	WebFont.load({
		custom: {
			families: ['AkzidenzGrotesk']
		}
	});
});

/**
 * Share buttons
 */
$(function(){
	$('.share-buttons a').click(function(e){

		var name = $(this).data('name');
		ga('send', 'event', 'social', 'click', name + '-share');

		if ( this.name == 'facebook' ) {
			e.preventDefault();

			FB.ui({
				method: 'share',
				href: 'https://developers.facebook.com/docs/'
			}, function(response){});

			return;
		}

		var popup = window.open( $(this).attr('href'), 'share-dialog', 'width=626,height=436');

		if ( popup )
			e.preventDefault();

	});
});


/**
 * Follow buttons
 */
$(function(){
	$('.follow a').click(function(e){
		ga('send', 'event', 'social', 'click', $(this).data('name') + '-follow');
	});
});

/**
 *  Timer
 */
$(function(){

	var request_frame = window.requestAnimationFrame ?
		function(callback){
			window.requestAnimationFrame(callback);
		}
		:
		function(callback) {
			setTimeout(callback, 1)
		};

	function pad(n, width, z) {
		z = z || '0';
		n = n + '';
		return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
	}

	var end = moment('2015-05-09T15:00:00+02:00');

	request_frame(function step(){

		var now = moment(),
			days = end.diff(now, 'days'),
			hours = end.diff(now, 'hours'),
			minutes = end.diff(now, 'minutes'),
			seconds = end.diff(now, 'seconds'),
			milliseconds = end.diff(now, 'milliseconds');

		milliseconds -= seconds * 1000;
		seconds -= minutes * 60;
		minutes -= hours * 60;
		hours -= days * 24;

		days = 0 < days ? days : 0;
		hours = 0 < hours ? hours : 0;
		minutes = 0 < minutes ? minutes : 0;
		seconds = 0 < seconds ? seconds : 0;
		milliseconds = 0 < milliseconds ? milliseconds : 0;

		milliseconds = pad(milliseconds, 3);
		seconds = '' + pad(seconds, 2);
		minutes = '' + pad(minutes, 2);
		hours = '' + pad(hours, 2);

		var str =
			( days ? days + ':' : '') +
			hours + ':' + minutes + ':' + seconds + ':' + milliseconds;

		$('.countdown').html( str );

		request_frame(step);

	});

});

/**
 * Newsletter dialog
 */
$(function(){

	function validateEmail(email) {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		return re.test(email);
	}

	var $dialog = $('.newsletter-dialog');

	$('.toggle-dialog').click(function(e){
		e.preventDefault();
		$dialog[ !$dialog.is('.active') ? 'addClass' : 'removeClass' ]('active');
	});

	$('body, iframe').click(function(e){
		var $target = $(e.target);
		if ( $target.is('.close-dialog') || (!$target.closest($dialog).length && !$target.is('.toggle-dialog') ) ) {
			$dialog.removeClass('active');
		}
	});

	var $error_msg = $('.form-error');
	var $input = $('input[type="text"]');
	$('.button').click(function(){

		if ( !validateEmail( $input.val() ) ) {
			$error_msg.show();
			return;
		}

		$error_msg.hide();

		$.ajax({
			type: "POST",
			url: 'signup',
			data: {email: $input.val()},
			success: function(){
				ga('send', 'event', 'newsletter', 'click', 'newsletter-signup');

				$('.newsletter-dialog').html('You have signed up');
				$(window).trigger('resize');
			}
		});

	});

	$(window).bind('resize', function(){
		return;
		$dialog.css({
			marginLeft: Math.floor( - $dialog.outerWidth() / 2 ),
			marginTop: - $dialog.height() / 2
		});
	});
});

/**
 * Video embed 
 */

$(function(){
	
	var $window = $(window),
		$header = $('header'),
		$container = $('article');

	$window.bind('resize', function(){

		var width = $window.width(),
			height = $window.height(),
			header_height = $header.outerHeight(),
			max_height = $window.height() - header_height;

		var video_width = width,
			video_height = width * 0.5625;

		if ( max_height < video_height )
			video_width = max_height / 0.5625,
			video_height = max_height;

		var top = ( height - video_height ) / 2;

		if ( top < header_height )
			top = header_height;

		//console.log('max_height', max_height);
		//console.log('width', width);
		//console.log('video_width', video_width);

		$container.css({
			width: video_width,
			height: video_height,
			top: top - header_height,
			left: ( width - video_width ) / 2
		});

	}).trigger('resize');

	var i = 0;
	var interval_id = setInterval(function(){
		i++;
		if ( 50 < i )
			clearInterval(interval_id);
		$window.trigger('resize');
		//console.log('trigger');
	}, 100);

});
/**
 * Created by vilhelm on 07/05/15.
 */

/**
 * Newsletter dialog
 */
jQuery(function($){

	function validateEmail(email) {
		var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
		return re.test(email);
	}

	var $dialog = $('.newsletter-dialog');

	$('.toggle-dialog').on('click', 'a', function(e){
		e.preventDefault();
		$dialog[ !$dialog.is('.active') ? 'addClass' : 'removeClass' ]('active');
	});

	$('body, iframe').click(function(e){
		var $target = $(e.target);
		if ( $target.is('.close-dialog') || (!$target.closest($dialog).length && !$target.is('.toggle-dialog a') ) ) {
			$dialog.removeClass('active');
		}
	});

	$('.newsletter-form').each(function(){

		var $form = $(this);
		var $error_msg = $form.find('.form-error');
		var $input = $form.find('input[type="email"]');

		$form.on('submit', function(e) {
			e.preventDefault();

			var sendData = $(this).serialize();

			if ( !validateEmail( $input.val() ) ) {
				$error_msg.show();
				return;
			}

			$error_msg.hide();

			$.ajax({
				type: "POST",
				data: sendData + '&ajax=1',
				dataType: 'JSON',
				success: function(returnData) {
					console.log('var returnData', returnData);
					if(returnData.success) {
						if ( window.ga )
							ga('send', 'event', 'newsletter', 'click', 'newsletter-signup');

						$form.html(returnData.message);
						$(window).trigger('resize');
					}
				}
			});

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

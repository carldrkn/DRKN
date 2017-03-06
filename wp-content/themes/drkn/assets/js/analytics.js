
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
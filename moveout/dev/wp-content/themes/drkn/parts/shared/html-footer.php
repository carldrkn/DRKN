
	<?php wp_footer(); ?>
	<script type="text/javascript">

		window.drkn = window.drkn || {};
		drkn.images = <?php echo json_encode(Drkn::$images); ?>;

		jQuery(document).ready(function($){
			if($("#mySlider").length > 0) $("#mySlider").zmSlider( { 'responsive':[[1, 100]] } );

		/*	var heightCol = $('.height img').height();
			var singleImage = $('section.promo-section .container-fluid .row .height.col-md-4 img');
			singleImage.height(heightCol);

	

			$(window).resize(function(){
				var heightCol = $('.height img').height();
				var singleImage = $('section.promo-section .container-fluid .row .height.col-md-4 img');
				singleImage.height(heightCol);			
			});  */

		


		});

	</script>
	</body>
</html>
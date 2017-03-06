
	<?php wp_footer(); ?>
	<script type="text/javascript" data-images="1">
		window.drkn = window.drkn || {};
		drkn.images = drkn.images || {};
		drkn.images = _.extend(drkn.images, <?php echo json_encode(Drkn::$images); ?>);
	</script>
	</body>
</html>
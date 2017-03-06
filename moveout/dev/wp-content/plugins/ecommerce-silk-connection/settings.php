<?php

	/*
		/admin/     relates to settings and Admin console.
		/includes/  are constructor files that don't execute any code.
		/modules/ 	are the views that connect to the shortcodes.

		Shortcodes enable the user to control where and what should be displayed
		[esc id="product_list" count="5"]
		Create a list of 5 products
	*/

	include_once(ESC_PLUGIN_DIR.'/includes/functions.php');
	include_once(ESC_PLUGIN_DIR.'/includes/shortcodes.php');
	include_once(ESC_PLUGIN_DIR.'/widgets/ys_chooseposts_widget.php');
	include_once(ESC_PLUGIN_DIR.'/widgets/ys_products_widget.php');

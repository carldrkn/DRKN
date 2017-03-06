<?php

/*
 * ABOUT:
 * Silk specific characteristics needed for the display of the category page.
 * Runs prior to category page being displayed.
 *
 * TODO:
 * Seperate categories out into tiers.
 *
*/

class EscCategory {

	static public function getPrice($post_id) {
		return EscGeneral::getPrice($post_id);
	}

	static public function isAvailable($post_id) {
		return EscGeneral::isAvailable($post_id);
	}

	static public function getBreadcrumbs() {
		return EscGeneral::getBreadcrumbs();
	}

}
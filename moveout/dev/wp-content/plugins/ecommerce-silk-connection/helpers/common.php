<?php

/**
	*
	* General functions used for debugging non-code specific.
	*
*/

	if(!function_exists('pr')) {
		function pr($str = "", $str2 = "") {
			echo "<pre>";
			print_r($str2);
			print_r($str);
			echo "</pre>";
		}
	}

	if(!function_exists('logIt')) {
		function logIt($message) {
			if(WP_DEBUG === true) {
				if(is_array($message) || is_object($message)) {
					error_log(print_r($message, true));
				} else {
					error_log($message);
				}
			}
		}
	}

	//Returns a default if key is not set in array
	if(!function_exists('check')) {
		function check($array, $arg, $default = "") {
			if(isset($array[$arg])) return $array[$arg];
			return $default;
		}
	}

	//Closes tags in a string for wrappers
	//i.e. <ul class="u-clean"><li><a href="#"> = </a></li></ul>
	if(!function_exists('closeTags')) {
		function closeTags($str) {
			if($str === '') return $str;
			preg_match_all('/<(\w+)/i', $str, $matches);
			$matches = array_reverse($matches[1]);
			$str = '';
			foreach ($matches as $tag) {
				$str .= '</' . $tag . '>';
			}
			return $str;
		}
	}

	if(!function_exists('sanitize_alphanumeric')) {
		function sanitize_alphanumeric($str) {
			return preg_replace('/\W/', '', $str);
		}
	}

	if(!function_exists('is_ajax_request')) {
		function is_ajax_request() {
			return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		}
	}
<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 28/04/15
 * Time: 16:41
 */

$cache = true;

function post_to_url($url, $data) {
	$fields = '';
	foreach($data as $key => $value) {
		$fields .= $key . '=' . urlencode($value) . '&';
	}
	rtrim($fields, '&');

	$post = curl_init();

	curl_setopt($post, CURLOPT_URL, $url);
	curl_setopt($post, CURLOPT_POST, count($data));
	curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
	curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($post);

	curl_close($post);

	return $result;
}

function minify_js( $code ) {
	$url = 'http://closure-compiler.appspot.com/compile';
	$data = array(
		'js_code' => $code,
		'compilation_level' => 'ADVANCED_OPTIMIZATIONS',
		'compilation_level' => 'SIMPLE_OPTIMIZATIONS',
		'output_format' => 'text',
		'output_info' => 'compiled_code'
	);
	$result = post_to_url($url, $data);
	if ( $result )
		return $result;
	else
		return $code;
}

$script = file_get_contents('jquery-1.11.2.min.js')
	.	file_get_contents('webfont.js')
	.	file_get_contents('imagesloaded.js')
	.	file_get_contents('moment.js')
	.	file_get_contents('teaser.js');

//$script = minify_js($script);

if ( $cache )
	file_put_contents('script.js', $script);

echo $script;



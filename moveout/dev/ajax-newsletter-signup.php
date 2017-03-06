<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 28/04/15
 * Time: 16:31
 */

$filename = 'data/newsletter' . uniqid() . '.json';
file_put_contents( $filename, json_encode($_POST) );

if ( !isset($_POST['email']) ) {
	exit();
}

function post_to_url($url, $data) {

	$post = curl_init();

	curl_setopt($post, CURLOPT_URL, $url);
	curl_setopt($post, CURLOPT_POST, true);
	curl_setopt($post, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($post);

	curl_close($post);

	return $result;
}

$url = 'http://app.rule.io/api/v2/subscribers';

$data = array(
	'apikey' => '21f28dd7-b9a87de-cc5251f-bc3a351-1cbac2282ab',
	'tags' => array('signup', 'teaser'),
	'auto_create_tags' => true,
	'subscribers' => array(
		'email' => $_POST['email']
	)
);

$result = post_to_url($url, $data);
exit();

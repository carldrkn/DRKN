<?php
/**
 * Created by PhpStorm.
 * User: vilhelm
 * Date: 28/04/15
 * Time: 16:31
 */


if ( !isset($_POST['email']) ) {
	exit();
}

if ( !isset($_POST['code']) ) {
	exit();
}

if ( $_POST['code'] === '26121791' ) {
	setcookie("DRKN_CODE_SUCCESS", '1', time()+3600*24, '/');  /* expire in 24 hour */
	echo '1';
	exit();
}

$filename = 'code-tries/' . uniqid() . '.' . time() . '.json';
file_put_contents( $filename, json_encode($_POST) );

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
	'tags' => array('signup', 'teaser', 'code'),
	'auto_create_tags' => true,
	'subscribers' => array(
		'email' => $_POST['email']
	)
);

$result = post_to_url($url, $data);
exit();

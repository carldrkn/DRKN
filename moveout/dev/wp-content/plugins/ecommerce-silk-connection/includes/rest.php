<?php

class EscRest {

	function __construct($url = '', $requestHeaders = array()) {
		$this->url = $url;
		$this->request = '';
		$this->response = false;
		$this->requestHeaders = $requestHeaders;
		$this->responseHeaders = array();
		$this->httpCode = 0;
		$this->method = 'GET';
	}

	function delete($a = null) {
		return $this->method('DELETE')->send($a);
	}

	function get($a = array()) {
		return $this->method('GET')->send($a);
	}

	function post($a = null, $json = true) {
		return $this->method('POST')->send($a, $json);
	}

	function put($a = null) {
		return $this->method('PUT')->send($a);
	}

	function method($a = null) {
		if($a === null)
			return $this->method;
		$this->method = $a;
		return $this;
	}

	function httpCode() {
		return $this->httpCode;
	}

	function info() {
		return $this->info;
	}

	function header($arrayOrText = null) {
		if($arrayOrText === null)
			return $this->responseHeaders;
		if(is_array($arrayOrText))
			$this->requestHeaders = array_merge($this->requestHeaders, $arrayOrText);
		else
			$this->requestHeaders[] = $arrayOrText;
		return $this;
	}

	function request() {
		return $this->request;
	}

	function send($request = null, $json = true) {

		$this->responseHeaders = array();
		$this->httpCode = 0;
		$url = $this->url;

		if($this->method == 'GET' && count($request)) $url .= '?' . ($this->request = http_build_query($request));

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		if($json) {
			curl_setopt($curl, CURLOPT_HTTPHEADER, array_merge(
				array(
					"Content-Type: application/json",
					"Accept: application/json",
				),
				$this->requestHeaders
			));
		}

		curl_setopt($curl, CURLOPT_HEADERFUNCTION, array($this, 'headerCallback'));

		if($this->method != 'GET') {
			if($this->method == 'POST')
				curl_setopt($curl, CURLOPT_POST, true);
			else
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->method); // put delete
			if($json) {
				$this->request = $request === null ? '' : json_encode($request);
			} else {
				$this->request = $request === null ? '' : $request;
			}
			curl_setopt($curl, CURLOPT_POSTFIELDS, $this->request);
		}

		$this->response = curl_exec($curl);
		$this->httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$this->info = curl_getinfo($curl);
		curl_close($curl);
		$decode = json_decode($this->response, true); // nobody encodes plain null or false

		return $decode === null ? false : $decode;
	}

	function response() {
		return $this->response;
	}

	function url($a) {
		$this->url = $a;
		return $this;
	}

	function dump() {
		$r = '';
		$r .= "HTTP response code: " . $this->httpCode() . "\n\n";
		$r .= "Request header:\n" . trim($this->info['request_header']) . "\n\n";
		$r .= "Response header:\n" . implode("\n", $this->header()) . "\n\n";
		$r .= "Request:\n" . $this->request() . "\n\n";
		$r .= "Response:\n" . $this->response() . "\n\n";
		$r .= "cURL info:\n";
		$i = $this->info;
		unset($i['request_header']);
		$pad = 0;

		foreach($i as $key => $value) {
			if($pad < strlen($key)) $pad = strlen($key);
		}

		foreach($i as $key => $value) {
			$r .= substr(str_pad($key . ' ', $pad, '.'), 0, $pad) . ' ' . $value . "\n";
		}

		return $r;
	}

	private function headerCallback($curl, $line) {
		$l = trim($line);

		if(strlen($l)) $this->responseHeaders[] = $l;

		return strlen($line);
	}

}

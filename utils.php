<?php

class OpenSSLAES {

	/**
	 * $data 需要加密的字符串
	 *
	 * $method 可通过openssl_get_cipher_methods()获得
	 *
	 * $secret_key 加解密的密钥
	 *
	 * $iv 加解密的向量，有些方法需要设置比如CBC
	 *
	 *  $options 以下标记的按位或： OPENSSL_RAW_DATA 、 OPENSSL_ZERO_PADDING
	 **/

	static public function encrypt($data, $method, $secret_key, $options, $iv) {
		$res = openssl_encrypt($data, $method, $secret_key, $options, $iv);
		if (!$res) {
			return "";
		} else {
			return $res;
		}
	}

	static public function decrypt($data, $method, $secret_key, $options, $iv) {
		$res = openssl_decrypt($data, $method, $secret_key, $options, $iv);
		if (!$res) {
			return "";
		} else {
			return $res;
		}
	}
}

class IP {

	static public function get_ip() {

		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "")) {
			$ip = getenv("REMOTE_ADDR");
		} else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "")) {
			$ip = $_SERVER['REMOTE_ADDR'];
		} else {
			$ip = "";
		}

		return ($ip);
	}
}
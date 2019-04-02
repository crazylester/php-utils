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

/**
 * 打印错误的详细信息,打印到文件
 */
class LOGGER {
	static private function get_caller_info() {
		$c = '';
		$file = '';
		$func = '';
		$class = '';
		$line = '';
		$trace = debug_backtrace();
		if (isset($trace[2])) {
			$file = $trace[1]['file'];
			$line = $trace[1]['line'];
			$func = $trace[2]['function'];
			if ((substr($func, 0, 7) == 'include') || (substr($func, 0, 7) == 'require')) {
				$func = '';
			}
		} else if (isset($trace[1])) {
			$file = $trace[1]['file'];
			$line = $trace[1]['line'];
			$func = '';
		}
		if (isset($trace[3]['class'])) {
			$class = $trace[3]['class'];
			$func = $trace[3]['function'];
			$file = $trace[2]['file'];
			$line = $trace[2]['line'];

		} else if (isset($trace[2]['class'])) {
			$class = $trace[2]['class'];
			$func = $trace[2]['function'];
			$line = $trace[1]['line'];

			$file = $trace[1]['file'];
		}
		if ($file != '') {
			$file = basename($file);
		}

		$c = $file . ": ";
		$c .= ($line != '') ? $line : "";
		$c .= ($class != '') ? ":" . $class . "->" : "";
		$c .= ($func != '') ? $func . "(): " : "";
		return ($c);
	}

	static public function log_server($log_path, $err_msg) {
		$caller_info = self::get_caller_info();
		error_log(date('Y-m-d H:i:s') . "|" . $err_msg . "---" . $caller_info . "\n", 3, $log_path);
	}

}
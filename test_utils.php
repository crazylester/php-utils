<?php

require_once "utils.php";

//===加密演示===\\

echo "===============加密演示=================" . PHP_EOL;
//16个字节
$iv = "1234567812345678";
//此处秘钥长度应该和加密方法需要的长度一致，因为不同语言对长度不一致的处理可能会不同
$aes_key = "abc4567812345678";

$plain_text = "hello";
echo "use AES-128-CBC" . PHP_EOL;
echo "plain_text:" . $plain_text . PHP_EOL;

$enc_text = base64_encode(OpenSSLAES::encrypt($plain_text, "AES-128-CBC", $aes_key, OPENSSL_RAW_DATA, $iv));
echo "enc_text:" . $enc_text . PHP_EOL;

$dec_text = OpenSSLAES::decrypt(base64_decode($enc_text), "AES-128-CBC", $aes_key, OPENSSL_RAW_DATA, $iv);
echo "dec_text:" . $dec_text . PHP_EOL;

//16个字节
$iv = "1234567812345678";
//此处秘钥长度应该和加密方法需要的长度一致，因为不同语言对长度不一致的处理可能会不同
$aes_key = "12345678123456781234567812345678";
$plain_text = "hello";
//AES-256不等同于RIJNDAEL-256. AES中指的是秘钥大小, RIJNDAEL中指的是块大小.
//AES-256只是使用了256位的秘钥长度的RIJNDAEL-128.

/* 如果对比 http://www.seacha.com/tools/aes.html的加密结果，那么注意此处

https://www.php.net/manual/en/function.mcrypt-encrypt.php#117667

https://en.wikipedia.org/wiki/Advanced_Encryption_Standard

AES is a variant of Rijndael which has a fixed block size of 128 bits, and a key size of 128, 192, or 256 bits. By contrast, the Rijndael specification per se is specified with block and key sizes that may be any multiple of 32 bits, with a minimum of 128 and a maximum of 256 bits.

 */
echo "================================" . PHP_EOL;
echo "use AES-256-CBC" . PHP_EOL;
echo "plain_text:" . $plain_text . PHP_EOL;

$enc_text = base64_encode(OpenSSLAES::encrypt($plain_text, "AES-256-CBC", $aes_key, OPENSSL_RAW_DATA, $iv));
echo "enc_text:" . $enc_text . PHP_EOL;

$dec_text = OpenSSLAES::decrypt(base64_decode($enc_text), "AES-256-CBC", $aes_key, OPENSSL_RAW_DATA, $iv);
echo "dec_text:" . $dec_text . PHP_EOL;

//===LOG演示===\\
echo "===============LOG演示=================" . PHP_EOL;
$log_path = "./err.log";
$err_msg = "this is a log";
LOGGER::log_server($log_path, $err_msg);
echo "please check the file: err.log" . PHP_EOL;

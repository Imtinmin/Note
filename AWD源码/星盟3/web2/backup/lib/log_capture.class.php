<?php
namespace PHPWAF\lib;
/**
author: Adolph
version: 2.0
date: 2019-6-5
**/

class WAF_LOG_CAPTURE{
	public function WAF_WRITE($filepath,$filecontent,$FILE_APPEND){
		file_put_contents($filepath, $filecontent, $FILE_APPEND);
	}
	public function WAF_LOG($WAF_PATH,$WAF_LEVEL){
		$WAF_HEADER = array();
		$WAF_FILES = array();
		if (!file_exists($WAF_PATH)) {
			mkdir($WAF_PATH, 0777);
		}
		$arr = array("REQUEST_METHOD","HTTP_HOST","SERVER_PORT","REQUEST_URI","REMOTE_ADDR","HTTP_USER_AGENT","HTTP_X_FORWARDED_FOR","HTTP_ACCEPT","HTTP_ACCEPT_ENCODING","HTTP_CONNECTION","HTTP_REFERER","HTTP_COOKIE");
		foreach ($arr as $value) {
			if (isset($_SERVER[$value])) {
				$WAF_HEADER[$value] = $_SERVER[$value];
			}
			else{
					$WAF_HEADER[$value] = "Null";
				}
			}
		if ($_POST !== null) {
			$this->post = file_get_contents("php://input");
		}
		$WAF_TIME = date("Y-m-d H:i:s");
		if (isset($WAF_LEVEL)&$WAF_LEVEL<4) {
			if ($WAF_LEVEL === 1) {
				$WAF_LOG_NAME = "waf_log_1";
				$WAF_LOG_IP = $WAF_HEADER["REMOTE_ADDR"]; 
			}
			elseif ($WAF_LEVEL === 2) {
				$WAF_LOG_NAME = "waf_log_2";
			}
			$WAF_LOG_CONTENT = PHP_EOL."---------------".PHP_EOL.$WAF_TIME."\t".$WAF_HEADER["REQUEST_METHOD"]."\t".$WAF_HEADER["HTTP_HOST"].":".$WAF_HEADER["SERVER_PORT"].$WAF_HEADER["REQUEST_URI"].PHP_EOL."Remot-Ip:".$WAF_HEADER["REMOTE_ADDR"].PHP_EOL."User-Agent:".$WAF_HEADER["HTTP_USER_AGENT"].PHP_EOL."X-Forwarded-For:".$WAF_HEADER["HTTP_X_FORWARDED_FOR"].PHP_EOL."Http-Accept:".$WAF_HEADER["HTTP_ACCEPT"].PHP_EOL."Http-Accept-Encoding:".$WAF_HEADER["HTTP_ACCEPT_ENCODING"].PHP_EOL."Http-Connect:".$WAF_HEADER["HTTP_CONNECTION"].PHP_EOL."Http-Referer:".$WAF_HEADER["HTTP_REFERER"].PHP_EOL."Cookie:".$WAF_HEADER["HTTP_COOKIE"].PHP_EOL.PHP_EOL."Post-Data:".$this->post.PHP_EOL;
		if (isset($_FILES)) {
			foreach ($_FILES as $key => $value) {
				if (!empty(($value["tmp_name"]))) {
					$WAF_FILES = array('file-name' => $value["name"], "file-type" => $value["type"],"file-content" => file_get_contents($value["tmp_name"]));
					$WAF_LOG_CONTENT = $WAF_LOG_CONTENT."*********FILE********".PHP_EOL."File-Name: ".$WAF_FILES["file-name"].PHP_EOL."File-Type: ".$WAF_FILES["file-type"].PHP_EOL;
				}
			}
		}
			if ($WAF_PATH == null) {
				$WAF_PATH == "/tmp";
			}
			$this->WAF_WRITE($WAF_PATH."/".$WAF_LOG_NAME,$WAF_LOG_CONTENT,FILE_APPEND);
			if (isset($WAF_LOG_IP)) {
				if (!is_dir($WAF_PATH."/ip_log")) {
					mkdir($WAF_PATH."/ip_log", 0777);
			}
				$this->WAF_WRITE($WAF_PATH."/ip_log/".$WAF_LOG_IP,$WAF_LOG_CONTENT,FILE_APPEND);
			}
			
		}

	}
}

?>
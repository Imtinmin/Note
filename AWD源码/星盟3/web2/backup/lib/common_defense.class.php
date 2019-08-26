<?php
namespace PHPWAF\lib;
/**
author: Adolph
version: 2.0
date: 2019-6-5
**/
//require("log_capture.class.php");

//use PHPWAF\lib\WAF_LOG_CAPTURE;

class WAF_COMMON{
//对GET、POST请求数据进行防护,传入$_GET,$_POST,$_SERVER,$_FILES
	public function WAF_DATA_FILTER($WAF_GET,$WAF_POST,$WAF_HEADER,$WAF_FILE,$WAF_LOG_FILE){
		$WAF_DANGER_GET = 0;
		$WAF_LOG_GET = 0;
		if (ini_get("ini_set")) {
			ini_set("disable_functions","pcntl_alarm,pcntl_fork,pcntl_waitpid,pcntl_wait,pcntl_wifexited,pcntl_wifstopped,pcntl_wifsignaled,pcntl_wifcontinued,pcntl_wexitstatus,pcntl_wtermsig,pcntl_wstopsig,pcntl_signal,pcntl_signal_get_handler,pcntl_signal_dispatch,pcntl_get_last_error,pcntl_strerror,pcntl_sigprocmask,pcntl_sigwaitinfo,pcntl_sigtimedwait,pcntl_exec,pcntl_getpriority,pcntl_setpriority,pcntl_async_signals,system,assert,exec,shell_exec,scandir");
		}
		$WAF_PATTERN_1 = array("file_get_contents(","file_put_contents(","eval(","assert(","preg_replace(","create_function(","array_filter(","system(","exec(","pcntl_exec(","stream_socket_server(","openlog(","phpinfo(","passthru(","scandir(","chroot(","chgrp(","chown(","shell_exec(","proc_open(","proc_get_status(","error_log(","ini_set(","ini_alter(","ini_restore(","syslog(","readlink(","popen(","fopen(","fread(","fgets(","readfile(","fpassthru(","fwrite(","fputs(","\$_GET","\$_POST","base64_encode(","base64_decode(","curl ","<?php");
		$WAF_PATTERN_2 = array("select ","insert ","update ","delete ","and ","union ","load_file ","outfile ","dumpfile ","hex(");
		$WAF_PATTERN_3 = array("php://","file://","zip://","data://","compress.zlib://","compress.bzip2://","phar://");
		$WAF_PATTERN_4 = array("php","php1","php2","php3","php4","php5","phtml","phtm","htaccess","jsp","asp","aspx");
		$WAF_PATTERN_5 = array("php","<?php","?php","AddType","application/x-httpd-php","eval","\$_GET","\$_POST");
		if (isset($WAF_GET)&is_array($WAF_GET)) {
			foreach ($WAF_GET as $key => $value) {
				$WAF_GET[$key] = strtolower(htmlspecialchars(addslashes(urldecode($value))));//去除url编码，防护'',"",/,&,>,<
				foreach ($WAF_PATTERN_1 as $key_1 => $value_1) {
					if (strpos($WAF_GET[$key], $value_1) !== false) {
						$WAF_GET[$key] = str_replace($value_1, "disable_value", $WAF_GET[$key]);
						$WAF_DANGER_GET = $WAF_DANGER_GET + 1;
					}
				}
				foreach ($WAF_PATTERN_2 as $key_2 => $value_2){
					if (strpos($WAF_GET[$key], $value_2) !== false) {
						$WAF_GET[$key] = str_replace($value_2, "disable_value", $WAF_GET[$key]);
						$WAF_DANGER_GET = $WAF_DANGER_GET + 1;
					}
				}
				foreach ($WAF_PATTERN_3 as $key_3 => $value_3){
					if (strpos($WAF_GET[$key], $value_3) !== false) {
						$WAF_GET[$key] = str_replace($value_3, "disable_value", $WAF_GET[$key]);
						$WAF_DANGER_GET = $WAF_DANGER_GET + 1;
					}
				}
				if ($WAF_DANGER_GET > 0&$WAF_LOG_GET<1) {
					$WAF_LOG_MODEL = new WAF_LOG_CAPTURE();
					$WAF_LOG_MODEL->WAF_LOG($WAF_LOG_FILE,2);
					$WAF_LOG_GET = $WAF_LOG_GET + 1;
				}
				$_GET[$key] = $WAF_GET[$key];
				
			}
		}
		if (isset($WAF_POST)&is_array($WAF_POST)) {
			$WAF_DANGER_POST = 0;
			$WAF_LOG_POST = 0;
			foreach ($WAF_POST as $key => $value) {
				$WAF_POST[$key] = strtolower(htmlspecialchars(addslashes(urldecode($value))));//去除url编码，防护'',"",/,&,>,<
				foreach ($WAF_PATTERN_1 as $key_1 => $value_1) {
					if (strpos($WAF_POST[$key], $value_1) !== false) {
						$WAF_POST[$key] = str_replace($value_1, "disable_value", $WAF_POST[$key]);
						$WAF_DANGER_POST = $WAF_DANGER_POST + 1;
					}
				}
				foreach ($WAF_PATTERN_2 as $key_2 => $value_2){
					if (strpos($WAF_POST[$key], $value_2) !== false) {
						$WAF_POST[$key] = str_replace($value_2, "disable_value", $WAF_POST[$key]);
						$WAF_DANGER_POST = $WAF_DANGER_POST + 1;
					}
				}
				foreach ($WAF_PATTERN_3 as $key_3 => $value_3){
					if (strpos($WAF_POST[$key], $value_3) !== false) {
						$WAF_POST[$key] = str_replace($value_3, "disable_value", $WAF_POST[$key]);
						$WAF_DANGER_POST = $WAF_DANGER_POST + 1;
					}
				}
				if ($WAF_DANGER_POST > 0 & $WAF_LOG_POST < 1 & $WAF_DANGER_GET === 0) {
					$WAF_LOG_MODEL = new WAF_LOG_CAPTURE();
					$WAF_LOG_MODEL->WAF_LOG($WAF_LOG_FILE,2);
					$WAF_LOG_POST = $WAF_LOG_POST + 1;
				}
				$_POST[$key] = $WAF_POST[$key];
			}
		}
		if (isset($WAF_HEADER)&is_array($WAF_HEADER)) {
			$WAF_DANGER_HEADER = 0;
			$WAF_LOG_HEADER = 0;
			foreach ($WAF_HEADER as $key => $value) {
				$WAF_HEADER[$key] = strtolower(htmlspecialchars(addslashes(urldecode($value))));//去除url编码，防护'',"",/,&,>,<
				foreach ($WAF_PATTERN_1 as $key_1 => $value_1) {
					if (strpos($WAF_HEADER[$key], $value_1) !== false) {
						$WAF_HEADER[$key] = str_replace($value_1, "disable_value", $WAF_HEADER[$key]);
						$WAF_DANGER_HEADER = $WAF_DANGER_HEADER + 1;
					}
				}
				foreach ($WAF_PATTERN_2 as $key_2 => $value_2){
					if (strpos($WAF_HEADER[$key], $value_2) !== false) {
						$WAF_HEADER[$key] = str_replace($value_2, "disable_value", $WAF_HEADER[$key]);
						$WAF_DANGER_HEADER = $WAF_DANGER_HEADER + 1;
					}
				}
				if ($WAF_DANGER_HEADER > 0 & $WAF_LOG_HEADER < 1 & $WAF_DANGER_POST === 0 & $WAF_DANGER_GET === 0) {
					$WAF_LOG_MODEL = new WAF_LOG_CAPTURE();
					$WAF_LOG_MODEL->WAF_LOG($WAF_LOG_FILE,2);
					$WAF_LOG_HEADER = $WAF_LOG_HEADER + 1;
				}
				$_SERVER[$key] = $WAF_HEADER[$key];
			}
		}

		if (isset($WAF_FILE)){
			foreach ($WAF_FILE as $key => $value) {
				if (!empty($value["tmp_name"])) {
					$WAF_DANGER_FILE = 0;
					$WAF_LOG_FILE = 0;
					$WAF_FILE["name"] = $value["name"];
					$WAF_FILE["type"] = $value["type"];
					$WAF_FILE["content"] = file_get_contents($value["tmp_name"]);
					$WAF_FILE_EXT = strtolower(substr(strrchr($WAF_FILE["name"], "."), 1));
					$WAF_FILE_NAME = substr($WAF_FILE["name"], strripos($WAF_FILE["name"],"."));
					foreach ($WAF_PATTERN_4 as $key_4 => $value_4) {
						if (strpos($WAF_FILE_EXT, $value_4) !== false) {
							$WAF_FILE["name"] = substr_replace($WAF_FILE["name"], "png", strripos($WAF_FILE["name"], ".")+1, strlen($WAF_FILE_EXT));
							$WAF_DANGER_FILE = $WAF_DANGER_FILE + 1;
						}
					}
					foreach ($WAF_PATTERN_5 as $key_5 => $value_5) {
						if (strpos($WAF_FILE["content"], $value_5) !== false) {
							$WAF_FILE["content"] = str_replace($value_5, "disable_value", $WAF_FILE["content"]);
							$WAF_DANGER_FILE = $WAF_DANGER_FILE + 1;
						}
					}
					foreach ($_FILES as $key => $value) {
						if ($WAF_DANGER_FILE > 0 & $WAF_LOG_FILE < 0 & $WAF_DANGER_GET === 0 & $WAF_DANGER_POST === 0 & $WAF_DANGER_HEADER === 0) {
							$WAF_LOG_MODEL = new WAF_LOG_CAPTURE();
							$WAF_LOG_MODEL->WAF_LOG($WAF_LOG_FILE,2);
							$WAF_LOG_FILE = $WAF_LOG_FILE + 1;
							if (!is_dir("/tmp/danger_file/")) {
								mkdir("/tmp/danger_file/", 0777);
							}
							file_put_contents("/tmp/danger_file/".$_FILES[$key]["name"], file_get_contents($_FILES[$key]["tmp_name"]));
						}
						$_FILES[$key]["name"] = $WAF_FILE["name"];
						$_FILES[$key]["type"] = $WAF_FILE["type"];
						$WAF_FILE_RE = file_put_contents($_FILES[$key]["tmp_name"], $WAF_FILE["content"]);
					}
				}
				
			}
		}

	}
}
?>
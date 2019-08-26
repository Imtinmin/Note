<?php 
namespace PHPWAF;
//定义命名空间
/**
author: Adolph
version: 2.0
date: 2019-6-5
**/

require("lib/common_defense.class.php");
require("lib/log_capture.class.php");

use PHPWAF\lib\WAF_COMMON;
use PHPWAF\lib\WAF_LOG_CAPTURE;
//防止变量名冲突
//define('WAF_PREFIX') or define('WAF_PREFIX','WAF_');
//定义页面编码
header("Content-type:text/html;charset=utf-8");
//关闭错误回显
//@error_reporting(0);


class PHPWAF{
//初始化防御
	public function __construct($filepath){
		$this->filepath = $filepath;
		$this->header = array();
		$this->files = array();
		$this->get = $_GET;
		$this->post = file_get_contents("php://input");
	}
	
//加载防御,分级防御，1级防御只记录所有日志不进行拦截过滤，2级防御加载普通防御模块并记录普通访问日志和敏感日志,3级分类精细防御待开发
	public function WAF_DEFENSE($level){
		if (isset($level)&$level<4&$level>0) {
			$WAF_LOG_MODEL = new WAF_LOG_CAPTURE();
			$WAF_LOG_MODEL->WAF_LOG($this->filepath,1);
			if ($level == 2) {
				$WAF_COMMON = new WAF_COMMON();
				$WAF_COMMON->WAF_DATA_FILTER($_GET,$_POST,$_SERVER,$_FILES,$this->filepath);
			}
		}
		
	}
}

$WAF = new PHPWAF("/tmp/waf_log");
$WAF->WAF_DEFENSE(1);

?>
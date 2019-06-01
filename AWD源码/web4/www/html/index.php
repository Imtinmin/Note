<?php
//print_r($_SERVER);
if( !empty($_SERVER['HTTP_X_REWRITE_URL']) ) $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
@set_time_limit(1000); //函数最久执行时间
@set_magic_quotes_runtime(0);   //关闭特殊字符提交的时候提示数据库错误
header("Centent-Type:text/html;charset=UTF-8");   //设置系统编码格式
header("Pragma: no-cache");  //禁止缓存
 //根目录
define('ROOT_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
require( 'protected/core.php' );
?> 
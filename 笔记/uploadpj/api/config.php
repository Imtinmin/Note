<?php

/**
 * @Author: Imtinmin
 * @Date:   2019-08-25 22:14:28
 * @Last Modified by:   Imtinmin
 * @Last Modified time: 2019-08-26 00:01:23
 */

//error_reporting(0);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin:*');

define('MYSQL_HOST', '127.0.0.1');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', 'root');
define('DATABASE', 'member');

define('UPLOADDIR', '../uploads/');
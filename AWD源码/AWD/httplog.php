<?php
date_default_timezone_set('Asia/Shanghai');

$data = '';
$line = '********************************************';
$data .= date("Y-m-d H:i:s",$_SERVER['REQUEST_TIME']);
$data .=$_SERVER['REQUEST_METHOD'].' '.$_SERVER['REQUEST_URI']."\r\n";

    foreach($_SERVER as $key => $value){
        if(substr($key,0,4)=='HTTP'){
            $data .= $key.': '.$value."\r\n";
        }
    }
    $data .= 'HTTP_COOKIE: '.$_SERVER['HTTP_COOKIE']."\r\n";
    $data .= 'POST_DATA: '.file_get_contents('php://input');
    $data .= "\r\n".$line."\r\n"."\r\n";
    $f = fopen('./log.txt', 'a');
    fwrite($f, $data);
    fclose($f);
?>
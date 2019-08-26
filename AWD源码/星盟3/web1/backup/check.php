<?php
    header("Content-Type: text/html;charset=utf-8");
    header("Charset=utf-8");
    if($_SESSION[admin]!='true'){
        echo '请登陆，<a href="/index.html">返回</a>';
        exit();}
?>
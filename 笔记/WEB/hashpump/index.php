<?php
include "secret.php";
@$username=(string)$_POST['username'];
function enc($text){
    global $key;
    return md5($key.$text);
}
#echo $username.PHP_EOL;
#echo enc($username);
if(enc($username) === $_COOKIE['verify']){
    if(is_numeric(strpos($username, "admin"))){
        die($flag);
    }
    else{
        die("you are not admin");
    }
}
else{
    setcookie("verify", enc("guest"), time()+60*60*24*7);
    setcookie("len", strlen($key), time()+60*60*24*7);
}
show_source(__FILE__);

#curl --cookie "verify=2e6b517128bcb194ac9e8943e8409753" --data "username=guest%80%00%00%00%00%98%01%00%00%00%00%00%00admin" http://localhost:7000
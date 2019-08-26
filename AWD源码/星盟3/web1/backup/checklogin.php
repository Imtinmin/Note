<?php
    header("Content-Type: text/html;charset=utf-8");
	
    session_start();

    ini_set('register_globals','1');
 #   require_once('./../config/sql.php');
    
    foreach(array_keys($_REQUEST) as $v){
        var_dump($v);
        $key = $v;
        $$key = $_REQUEST[$v]; 
    }

  #  $sql = new sql;

 #   $userinfo = $sql->select("`admin`","*","where `user`='$user'");
$username_tmp =$_REQUEST["username"]; 
$password_tmp =$_REQUEST["password"]; 
$servername = "localhost";
$username = "root";
$password = "";
$conn = mysql_connect($servername, $username, $password);

// 检测连接
if (!$conn) {
echo "fail to connect Mysql";
}
mysql_select_db("jy",$conn);

 $result=mysql_query("select * from jy_member where nickname ='".$username_tmp."'");


 while ($row=mysql_fetch_array($result)) {//while循环将$result中的结果找出来 
 $dbusername=$row["nickname"]; 
 $dbpassword=$row["avatar"]; 
 } 

echo $password_tmp ;
$password_tmp = md5($password_tmp);
echo '<pre>'."
[!] 请注意：密码原文：ilove***d
 密码原文中的‘***’ 匹配 [a-z][0-9a-z][a-zA-Z]
 此为管理员密码，不允许更改此处密码。".'</pre>';


echo $password_tmp;
echo "<hr>";
echo $dbpassword;
mysql_close($conn);


    if($password_tmp===$dbpassword){
        $_SESSION[admin] = 'true';

    }else{
        echo '<h1>密码错误！</h1>';
    }


if($_SESSION[admin] == 'true'){
        echo "<h1>Welcome , My Admin!!</h1>";
    }
?>
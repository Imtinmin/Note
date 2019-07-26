<?php

include_once("vendor/autoload.php");

const KEY = '****';
$salt="randbyte";

function login_init(){
    global $salt;
    $time = time();
    $token = [
      'iat'=>$time,
      'exp'=>$time+3600,
      'data'=>[
          'auth'=>base64_encode($_POST['username']."|".md5($_POST['password'].$salt)),
          'role'=>'guest'
      ]
    ];
    $jwt = \Firebase\JWT\JWT::encode($token,KEY);
    setcookie("token",$jwt);
    header("location:index.php");
    exit();
}

function login_check(){
    try {
        $token=$_COOKIE['token'];
        $data=\Firebase\JWT\JWT::decode($token,KEY,['HS256']);
        $role=$data->data->role;
        $auth=$data->data->auth;
    } catch (\Throwable $th) {
        setcookie("token",NULL);
        header("location:index.php");
        // print_r($th);
        exit();
    }
    $userinfo=explode("|",base64_decode($auth));
    $username=$userinfo[0];
    if($role==='admin'){
        include_once("flag.php");
    }
    include_once("./template/m4nager.html");
}
if(!isset($_COOKIE['token'])||empty($_COOKIE['token'])){
    if(isset($_POST['username']) && isset($_POST['password']) && $_POST['username']!='' && $_POST['password']!=''){
        login_init();
    }
    else{
        include_once("./template/login.html");
    }
}
else{
    login_check();
}


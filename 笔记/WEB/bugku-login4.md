```php
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form</title>
<link href="static/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="static/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
        $(".username").focus(function() {
                $(".user-icon").css("left","-48px");
        });
        $(".username").blur(function() {
                $(".user-icon").css("left","0px");
        });

        $(".password").focus(function() {
                $(".pass-icon").css("left","-48px");
        });
        $(".password").blur(function() {
                $(".pass-icon").css("left","0px");
        });
});
</script>
</head>

<?php
define("SECRET_KEY", file_get_contents('/root/key'));
define("METHOD", "aes-128-cbc");
session_start();

function get_random_iv(){
    $random_iv='';
    for($i=0;$i<16;$i++){
        $random_iv.=chr(rand(1,255));
    }
    return $random_iv;
}

function login($info){
    $iv = get_random_iv();
    $plain = serialize($info);
    $cipher = openssl_encrypt($plain, METHOD, SECRET_KEY, OPENSSL_RAW_DATA, $iv);
    $_SESSION['username'] = $info['username'];
    setcookie("iv", base64_encode($iv));
    setcookie("cipher", base64_encode($cipher));
}

function check_login(){
    if(isset($_COOKIE['cipher']) && isset($_COOKIE['iv'])){
        $cipher = base64_decode($_COOKIE['cipher']);
        $iv = base64_decode($_COOKIE["iv"]);
        if($plain = openssl_decrypt($cipher, METHOD, SECRET_KEY, OPENSSL_RAW_DATA, $iv)){
            $info = unserialize($plain) or die("<p>base64_decode('".base64_encode($plain)."') can't unserialize</p>");
            $_SESSION['username'] = $info['username'];
        }else{
            die("ERROR!");
        }
    }
}

function show_homepage(){
    if ($_SESSION["username"]==='admin'){
        echo '<p>Hello admin</p>';
        echo '<p>Flag is $flag</p>';
    }else{
        echo '<p>hello '.$_SESSION['username'].'</p>';
        echo '<p>Only admin can see flag</p>';
    }
    echo '<p><a href="loginout.php">Log out</a></p>';
}

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = (string)$_POST['username'];
    $password = (string)$_POST['password'];
    if($username === 'admin'){
        exit('<p>admin are not allowed to login</p>');
    }else{
        $info = array('username'=>$username,'password'=>$password);
        login($info);
        show_homepage();
    }
    }else{
        echo '<body class="login-body">
                <div id="wrapper">
                    <div class="user-icon"></div>
                    <div class="pass-icon"></div>
                    <form name="login-form" class="login-form" action="" method="post">
                        <div class="header">
                        <h1>Login Form</h1>
                        <span>Fill out the form below to login to my super awesome imaginary control panel.</span>
                        </div>
                        <div class="content">
                        <input name="username" type="text" class="input username" value="Username" onfocus="this.value=\'\'" />
                        <input name="password" type="password" class="input password" value="Password" onfocus="this.value=\'\'" />
                        </div>
                        <div class="footer">
                        <input type="submit" name="submit" value="Login" class="button" />
                        </div>
                    </form>
                </div>
            </body>';
    }
}
?>
</html>
<!--
```


`payload`

```php
<?php
$iv = base64_decode(urldecode("WuSocCAZYtQFCXPGBlZ7Vw%3D%3D"));
$cipher = base64_decode(urldecode("iQb%2BZ5su93XHPYMn5bnUT5%2FdzM1IEZltTDPuI09SMc3uhlsqgHxAHvQbC4GJxe23HpuhPhzCM9n5Z65frG78NA%3D%3D"));
//echo $iv.PHP_EOL;
//echo $cipher.PHP_EOL;
$cipher[13] = $cipher[13] ^ 'n' ^ 'k';
echo urlencode(base64_encode($cipher)).PHP_EOL;

//echo strlen($new);

/*
a:2:{s:8:"userna
me";s:5:"admik";
s:8:"password";s
:3:"123";}*/
$fail = "/Ir7Mq8uovgQVBQR+3gQsG1lIjtzOjU6ImFkbWluIjtzOjg6InBhc3N3b3JkIjtzOjM6IjEyMyI7fQ==";

//echo base64_decode($fail).PHP_EOL;
$first = 'a:2:{s:8:"userna';
$new_iv = "";
$oldcipher = base64_decode($fail);
echo $oldcipher.PHP_EOL;


for ($i=0; $i < 16; $i++) { 
        $new_iv .= chr(ord($first[$i]) ^ ord($oldcipher[$i]) ^ ord($iv[$i]));
}
echo urlencode(base64_encode($new_iv));
```
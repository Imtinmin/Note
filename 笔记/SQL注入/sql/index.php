<?php
	require_once('conn.php');
	@$username = preg_replace('/(sleep|\||or|benchmark|outfile|dumpfile|load_file|case|join|if)/i','',$_POST['username']);
	echo $username;
	@$password = $_POST['password'];
	if(isset($username) && strlen($username) > 0 && isset($password) && strlen($password) > 0){
		$res = query("SELECT * FROM user WHERE username='$username' and password='password'");
		$row = (!$res)  ? NULL:$res->fetch_array();
		$a = ($row) ? '登录成功':'登录失败';
		if(!$res){$a='数据库操作失败';}

	}
?>
<!DOCTYPE html>
<html>
<head>
<title>垃圾复现</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<script type="text/javascript" src="1.js"></script>
<style type="text/css">
.center1{padding-top:50px;width:60%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}
</style>
<body>
<body onload="auth()">
<div class="center1">
<?php if(isset($a)){ ?>
<div class="alert alert-primary" role="alert">
<?php  echo $a;?>
</div>
<?php }?>
<div class="jumbotron">
<h1 class="display-4">SQL注入</h1>
<form method="POST" action="index.php">
  <div class="row">
    <div class="col">
      <input type="text" name="username" class="form-control" placeholder="用户名">
    </div>
    <div class="col">
      <input type="text" name="password" class="form-control" placeholder="密码">
    </div>
	  <div class="col">
      <button type="submit" class="btn btn-primary">登录</button>
	  </div>
	</div>
</div>
</div>
</form>
</body>
</html>
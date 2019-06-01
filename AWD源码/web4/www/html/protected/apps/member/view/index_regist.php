<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/login.css" />
<script language="javascript">
function fleshVerify()
{
var timenow = new Date().getTime();
document.getElementById('verifyImg').src= "{url('index/verify')}/"+timenow;
}
</script>
<div class="reg_bg">
<div class="login_bg_top"></div>
<div class="login_con">
<div class="login_banner"> 
   <span>注册会员</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="{url('default/index/index')}"> <i class="icon-home"></i> 首页</a>&nbsp;&nbsp;
   <a href="{url('member/index/login')}"><i class="icon-user"></i> 登录</a>&nbsp;&nbsp;
   <a href="{url('member/index/getpassword')}"> <i class="icon-question-sign"></i> 忘记密码</a>&nbsp;&nbsp;
</div>
<form action="" method="post">
<table class="table table-bordered">
			  <tr>
				<th  width="120" align="right">用户名</th>
				<td><input type="text" name="name" class="login_input" ></td>
			  </tr>
			  <tr>
				<th  width="120" align="right">密&nbsp;&nbsp;&nbsp;码</th>
				<td><input type="password" class="login_input"  name="word"></td>
			  </tr>
              <tr>
				<th  width="120" align="right">确认密码</th>
				<td><input type="password" class="login_input"  name="sureword"></td>
			  </tr>
			  <tr>
				<th  width="120" align="right">昵&nbsp;&nbsp;&nbsp;称</th>
				<td><input type="text" name="nickname" class="login_input" ></td>
			  </tr>
              <tr>
				<th  width="120" align="right">邮&nbsp;&nbsp;&nbsp;箱</th>
				<td><input type="text" name="email" class="login_input" ></td>
			  </tr>
			  <tr>
				<th  width="120" align="right">验证码</th>
				<td><input type="text" class="login_yz" name="checkcode" id="checkcode" class="intext" size="4"> <img src="{url('index/verify')}" border="0"  height="25" width="50" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/></td>
			  </tr>
			  <tr>
				<th>&nbsp;</th>
				<td><input class="btn" type="submit" value="注册"></td>
			  </tr>
</table>
</form>
</div>
</div>
<script language="javascript">
fleshVerify();
</script>
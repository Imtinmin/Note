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
<div class="login_bg">
<div class="login_bg_top"></div>
<div class="login_con">
<div class="login_banner"> 
   <span>会员登录</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="{url('default/index/index')}"> <i class="icon-home"></i> 首页</a>&nbsp;&nbsp;
   <a href="{url('member/index/regist')}"> <i class="icon-edit"></i> 注册</a>&nbsp;&nbsp;
    <a href="{url('member/index/getpassword')}"> <i class="icon-question-sign"></i> 忘记密码</a>&nbsp;&nbsp;
</div>
<form action="" method="post">
<table class="table table-bordered">
			  <tr>
				<th align="right" width="120">用户名</th>
				<td><input type="text" name="name" ></td>
			  </tr>
			  <tr>
				<th align="right" width="120">密&nbsp;&nbsp;&nbsp;码</th>
				<td><input type="password"  name="word"></td>
			  </tr>
              <tr>
				<th align="right" width="120">登录状态</th>
				<td>
                <select name="cooktime" style="width:110px">
                     <option value="0">浏览器关闭</option>
                     <option value="3600">一小时</option>
                     <option value="86400">一天</option>
                     <option value="604800">一星期</option>
                     <option value="2592000">一个月</option>
                     <option value="31536000">一年</option>
                 </select>
                </td>
			  </tr>
			  <tr>
				<th align="right" width="120">验证码</th>
				<td><input type="text" class="login_yz" name="checkcode" id="checkcode" class="intext" size="4"> <img src="{url('index/verify')}" border="0"  height="25" width="50" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/></td>
			  </tr>
			  <tr>
				<th>&nbsp;</th>
				<td><input type="hidden" value="{$returnurl}" name="returnurl"><input class="btn" type="submit" value="登 录"></td>
			  </tr>
</table>
</form>
</div>

<div class="login_bg_bot"></div>
</div>
<script language="javascript">
fleshVerify();
</script>
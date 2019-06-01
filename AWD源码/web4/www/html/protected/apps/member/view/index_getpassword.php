<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/login.css" />
<div class="back_bg">
<div class="login_bg_top"></div>
<div class="login_con">
<div class="login_banner"> 
   <span>密码重置</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="{url('default/index/index')}"> <i class="icon-home"></i> 首页</a>&nbsp;&nbsp;
   <a href="{url('member/index/login')}"><i class="icon-user"></i> 登录</a>&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="{url('member/index/regist')}"><i class="icon-edit"></i> 注册</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<form action="" method="post">
<table  class="table table-bordered">
        <tr>
           <th align="right">找回方式</th><td align="left">账户 <input type="radio" checked="checked" name="type" value="acc"/>&nbsp;&nbsp; Email <input type="radio" name="type" value="email"/></td>
        </tr>
		<tr>
           <th align="right">账户或者Email</th>
           <td align="left"><input type="text" name="backname" class="login_input" ></td>
        </tr>
		<tr><td align="center" colspan="2"><input class="btn" type="submit" value="申请重置"></td></tr>    
</table>
</form>
</div>
</div>
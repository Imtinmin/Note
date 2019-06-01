<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<div id="contain">
<ul class="breadcrumb">
     <li> <span>账户管理</span><span class="divider">/</span><span>修改密码</span></li>
</ul>
  <form method="post" action="">
        <table  class="table table-bordered">
            <tr>
              <td width="100" align="right">旧密码</td>
              <td><input type="password" name="oldpassword" value=""/></td>
            </tr>
            <tr>
              <td width="100" align="right">新密码</td>
              <td><input type="password" name="password" value=""/></td>
            </tr>
            <tr>
              <td width="100" align="right">密码确认</td>
              <td><input type="password" name="surepassword" value=""/></td>
            </tr>
            <tr>
              <td></td>
              <td align="left"><input type="hidden" name="id" value="{$info['id']}"><input type="submit" name="dosubmit" value="修改" class="btn"></td>
            </tr>
        </table>
  </form>
</div>
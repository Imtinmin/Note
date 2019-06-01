<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script	language="javascript">
  $(function ($) { 
	//行颜色效果
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);	
  });
</script>
<title>添加会员</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">你当前的位置：【添加会员】</div>
		<div class="list_head_mr"></div>
		</div>


		<table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<form action="" method="post" id="info" name="info">
            <tr>
               <td align="right">账户：</td>
               <td><input type="text" name="name" class="login_input" ></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">会员级别：</td>
               <td>
               <select name="groupid">
				 {$select}
               </select>
               </td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">密码：</td>
               <td><input type="password" name="password"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">昵称：</td>
               <td><input type="text" name="nickname"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">邮箱：</td>
               <td><input type="text" name="email"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">手机：</td>
               <td><input type="text" name="tel"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">QQ：</td>
               <td><input type="text" name="qq"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">累计充值：</td>
               <td>￥<input type="text" name="rmb" size="5"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">消费金额：</td>
               <td>￥<input type="text" name="crmb" size="5"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">注册IP：</td>
               <td><input type="text" name="regip" value="{get_client_ip()}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">注册时间：</td>
               <td><input type="text" name="addtime" value="{date($addtime,Y-m-d H:i:s)}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">上次登录IP：</td>
               <td><input type="text" name="lastip" value="{get_client_ip()}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">上次登录时间：</td>
               <td><input type="text" name="lasttime" value="{date($lasttime,Y-m-d H:i:s)}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">是否前台显示：</td>
               <td><?php if ($info['islock']){ ?>
                     冻结:<input name="islock" type="radio" value="1" checked="checked" />&nbsp;开启:<input name="islock" type="radio" value="0" />
                   <?php }else{ ?>
                   冻结:<input name="islock" type="radio" value="1"/>&nbsp;开启:<input name="islock" type="radio" value="0"  checked="checked" />
                   <?php } ?>
                </td>
               <td class="inputhelp"></td>
            </tr>
			<tr>
				<td width="200">&nbsp;</td>
				<td align="left" colspan="2"><input type="hidden" name="id" value="{$info['id']}"> <input type="submit" value="添加" class="btn btn-primary btn-small"></td>
			</tr>
			</form>
		</table>
</div>
</body>
</html>
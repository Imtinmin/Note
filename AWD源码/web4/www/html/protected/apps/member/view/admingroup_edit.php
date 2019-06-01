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
<title>编辑会员组</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">你当前的位置：【编辑会员组】</div>
		<div class="list_head_mr"></div>
		</div>



		<table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
			<form action="" method="post" id="info" name="info">
            <tr>
               <td align="right">组名：</td>
               <td><input type="text" name="gname" value="{$info['name']}"></td>
               <td class="inputhelp"></td>
            </tr>
            <tr>
               <td align="right">不允许的操作：</td>
               <td><textarea name="notallow" cols="60" rows="10">{$info['notallow']}</textarea></td>
               <td class="inputhelp">应用/控制器/方法,键=值/键=值/键=值....<回车></td>
            </tr>
			<tr>
				<td width="200">&nbsp;</td>
				<td align="left" colspan="2"><input type="hidden" name="id" value="{$info['id']}"> <input type="submit" value="修改" class="btn btn-primary btn-small"></td>
			</tr>
			</form>
		</table>
        </div>
</body>
</html>
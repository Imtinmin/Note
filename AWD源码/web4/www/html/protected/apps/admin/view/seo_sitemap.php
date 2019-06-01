<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">
  $(function ($) { 
	//行颜色效果
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	});
   //表单验证
	var items_array = [
		{ name:"webname",min:3,max:30,simple:"站点名称",focusMsg:'3-30个字符'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>SiteMap生成</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【SiteMap生成】</div>
        </div>

        <form action="" method="post" id="info" name="info" >
         <table border="0" cellpadding="0" cellspacing="1"   class="all_cont">
         <tr><th colspan="4">首页</th></tr> 
         <tr>
            <td align="right">权重：</td>
            <td align="left" width="70">
              <select name="index[priority]">
                <option value="0">1</option>
                <option value="1">0.9</option>
                <option value="2">0.8</option>
                <option value="3">0.7</option>
                <option value="4">0.6</option>
                <option value="5">0.5</option>
              </select>
            </td>
            <td align="right" width="100">更新频率：</td>
            <td align="left">
              <select name="index[changefreq]">
                <option value="always">经常</option>
                <option value="hourly">每小时</option>
                <option value="daily">每天</option>
                <option value="weekly">每周</option>
                <option value="monthly">每月</option>
                <option value="yearly">每年</option>
              </select>
            </td>
          </tr>
          <tr><th colspan="4">栏目</th></tr> 
         <tr>
            <td align="right">权重：</td>
            <td align="left" width="70">
              <select name="list[priority]">
                <option value="0">1</option>
                <option value="1">0.9</option>
                <option value="2">0.8</option>
                <option value="3">0.7</option>
                <option value="4">0.6</option>
                <option value="5">0.5</option>
              </select>
            </td>
            <td align="right" width="100">更新频率：</td>
            <td align="left">
              <select name="list[changefreq]">
                <option value="always">经常</option>
                <option value="hourly">每小时</option>
                <option value="daily">每天</option>
                <option value="weekly">每周</option>
                <option value="monthly">每月</option>
                <option value="yearly">每年</option>
              </select>
            </td>
          </tr>

         <tr><th colspan="4">内容</th></tr> 
         <tr>
            <td align="right">权重：</td>
            <td align="left" width="70">
              <select name="con[priority]">
                <option value="0">1</option>
                <option value="1">0.9</option>
                <option value="2">0.8</option>
                <option value="3">0.7</option>
                <option value="4">0.6</option>
                <option value="5">0.5</option>
              </select>
            </td>
            <td align="right" width="100">更新频率：</td>
            <td align="left">
              <select name="con[changefreq]">
                <option value="always">经常</option>
                <option value="hourly">每小时</option>
                <option value="daily">每天</option>
                <option value="weekly">每周</option>
                <option value="monthly">每月</option>
                <option value="yearly">每年</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="right">记录不超过：</td>
            <td align="left" width="100">
              <input type="text" name="num" size="6" value="500"> 条
            </td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="开始生成"></td>
          </tr>           
        </table>
</form>
</div>
</body>
</html>

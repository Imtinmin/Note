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
		{ name:"tname",simple:"用途描述",focusMsg:''},
		{ name:"tableinfo",type:"eng",min:2,simple:"自定义表名",focusMsg:'必须是英文字符'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>{$info['tableinfo']}表的字段添加</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【{$info['tableinfo']}表的字段添加】</div>
        </div>


        <form  action="{url('extendfield/fieldadd')}"  method="post" id="info" name="info" >
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   > 
          <tr>
            <td width="100" align="right">字段描述：</td>
            <td><input type='text' id="tname" name="tname"  /></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td width="100" align="right">字段名：</td>
            <td><input type='text' id="tableinfo" name="tableinfo" /></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td width="100" align="right">字段类型：</td>
            <td>
            <select name="type" id="type">
              <option value="1">单行文本</option>
              <option value="2">多行文本</option>
              <option value="3">大型文本</option>
              <option value="4">下拉列表</option>
              <option value="5">上传框</option>
              <option value="6">多选按钮</option>
            </select>
            </td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td width="100" align="right">默认值：</td>
            <td>
            <input name="pid" id="pid" type="hidden" value="{$info['id']}" />
            <textarea name="defvalue" id="defvalue" cols="0" class="regular-textarea" style="width:300px !important; height:80px"></textarea>
            </td>
            <td class="inputhelp">如果为下拉(单选)或者多选按钮，请一行一个数值与描述并以半角逗号分割。<br>例如：value,描述</td>
          </tr>
          <tr>
            <td width="100" align="right">支持搜索：</td>
            <td> 否<input type="radio" name="ifsearch" value="0" checked> 是<input type="radio" name="ifsearch" value="1" ></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td width="100" align="right">排序：</td>
            <td><input type='text' size="3" id="norder" name="norder" value="0" /></td>
            <td class="inputhelp">越大越靠前</td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="添加"></td>
          </tr>           
        </table>
</form>
</div>
</body>
</html>

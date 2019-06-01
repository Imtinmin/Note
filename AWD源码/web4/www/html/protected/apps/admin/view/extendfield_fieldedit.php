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
		{ name:"tableinfo",type:"eng",min:3,simple:"自定义表名",focusMsg:'必须是英文字符'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>字段编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">你当前的位置：【字段编辑】</div>
        </div>

        <form  action="{url('extendfield/fieldedit')}"  method="post" id="info" name="info" >
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   > 
          <tr>
            <td width="100" align="right">字段描述：</td>
            <td><input type='text' id="tname" name="tname" value="{$info['name']}" /></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td width="100" align="right">字段名：</td>
            <td>{$info['tableinfo']}</td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td width="100" align="right">字段类型：</td>
            <td>
            <?php
                       switch($info['type']) {
                                  case 1:        
                                        echo "单行文本";
                                        break;
                                  case 2:        
                                        echo "多行文本";
                                        break;
                                  case 3:        
                                        echo "大型文本";
                                        break;
                                  case 4:        
                                       echo "下拉列表";
                                       break;
                                  case 5:        
                                       echo "上传框";
                                       break;
								  case 6:        
                                       echo "多选按钮";
                                       break;
                          }
            ?>
            </td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td width="100" align="right">默认值：</td>
            <td>
            <textarea name="defvalue" id="defvalue" cols="0" class="regular-textarea" style="width:300px !important; height:80px">{$info['defvalue']}</textarea>
            </td>
            <td class="inputhelp">如果为下拉(单选)或者多选按钮，请一行一个数值与描述并以半角逗号分割。<br>例如：value,描述</td>
          </tr>
          <tr>
            <td width="100" align="right">支持搜索：</td>
            <td>
            <?php 
			  if($info['ifsearch']){
			?>
            否<input type="radio" name="ifsearch" value="0"> 是<input type="radio" name="ifsearch" value="1" checked></td>
            <?php
			  }else{
		    ?>
            否<input type="radio" name="ifsearch" value="0" checked> 是<input type="radio" name="ifsearch" value="1" ></td>
            <?php
			  }
			?>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td width="100" align="right">排序：</td>
            <td><input type='text' size="3" id="norder" name="norder" value="{$info['norder']}" /></td>
            <td class="inputhelp">越大越靠前</td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="hidden" value="{$info['id']}" name="id"><input type="submit" class="btn btn-primary btn-small" value="编辑">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>

</form>
</div>
</body>
</html>

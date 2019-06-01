<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">
var edcon='';
KindEditor.ready(function(K) {
	edcon=K.create('#content', {
		allowFileManager : true,
		filterMode:false,
		uploadJson : "{url('fragment/UploadJson',array('sessionid'=>session_id()))}",
		fileManagerJson : "{url('fragment/FileManagerJson')}"
	});
});
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
		{ name:"title",simple:"碎片名称",focusMsg:''},
		{ name:"sign",type:"eng",min:5,simple:"调用标识",focusMsg:'必须是英文字符'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
	  //图片本地化
  $('#saveimage').click(function(){
	 var now=$(this);
	 now.html('图片下载中...');
	var con=edcon.html();
	$.post("{url('fragment/saveimage')}", {con:con},
   		  function(data){
			edcon.html(data);
			now.html('图片本地化');
			alert('执行完成~');
   	});
  });
  });
</script>
<title>碎片添加</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【碎片添加】</div>
        </div>


        <form  action="{url('fragment/add')}"  method="post" id="info" name="info" >
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   > 
          <tr>
            <td align="right" width="100">用途描述：</td>
            <td align="left"><input name="title" id="title" type="text" value="" /></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">调用标识：</td>
            <td align="left">{piece:<input name="sign" id="sign" type="text" value="" />}</td>
            <td class="inputhelp">请避免使用系统关键词作为标识，否则调用会出现错误</td>
          </tr>
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:450px;visibility:hidden;"></textarea><br><div id="saveimage" class="btn">图片本地化</div></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="添加">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>

</form>
</div>
</body>
</html>

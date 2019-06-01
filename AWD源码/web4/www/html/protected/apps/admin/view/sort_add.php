<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/laydate/laydate.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script language="javascript">
var edcon='';
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
	//默认加载资讯栏目
	$("#colsort").focus();
	$('#sortcon').html('<div id="loading"></div>');
	$.get("{url('sort/add')}", {sortaction : 'newsadd'},
   		 function(data){
		   $('#sortcon').html(data);
   	    });
  });
  function getcon() {
	  $('#sortcon').html('<div id="loading"></div>');
	  var sortaction=$('#colsort').val();
      $.get("{url('sort/add')}", {sortaction : sortaction},
   		 function(data){
		   $('#sortcon').html(data);
		   if(sortaction=='pageadd'){
                edcon=KindEditor.create('#content', {
		            allowFileManager : true,
		            filterMode:false,
		            uploadJson : "{url('sort/PageUploadJson',array('sessionid'=>session_id()))}",
		            fileManagerJson : "{url('sort/PageFileManagerJson')}"
	            });
				 //图片本地化
  $('#saveimage').click(function(){
	 var now=$(this);
	 now.html('图片下载中...');
	var con=edcon.html();
	$.post("{url('sort/pagesaveimage')}", {con:con},
   		  function(data){
			edcon.html(data);
			now.html('图片本地化');
			alert('执行完成~');
   	});
  });
		   }
   	    });
  }
</script>
<title>添加栏目</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【添加栏目】</div>
           <div class="list_head_mr">

           </div>
</div>
    <table width="100%" border="0" cellpadding="0" cellspacing="1">       
          <tr>
            <td align="center">
             <select id="colsort" onChange="getcon()" style="color:#137cd8">
               <option selected="selected" value="newsadd" >资讯栏目</option>
               <option value="photoadd" >图集栏目</option>
               <option value="pageadd" >单页栏目</option>
               <option value="pluginadd" >应用栏目</option>
               <option value="extendadd" >表单栏目</option>
               <option value="linkadd" >自定义栏目</option>
             </select>
            </td>
          </tr>
    </table>
    <div id="sortcon"></div>

</div>
</body>
</html>
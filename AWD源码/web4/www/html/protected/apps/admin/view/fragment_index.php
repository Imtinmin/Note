<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script language="javascript">
function CheckAll(form) { //复选框全选/取消
	for (var i=0;i<form.elements.length;i++) { 
		var e = form.elements[i]; 
		if (e.Name != "chkAll"&&e.disabled!=true) 
		e.checked = form.chkAll.checked; 
	} 
  } 
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
	$('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('fragment/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>碎片列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【碎片列表】</div>
           <div class="list_head_mr"><a href="{url('fragment/add')}" class="add">新增</a></div>                           
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
         <form action="{url('fragment/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
          <tr>
            <th width="70"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th width="20%">ID</th>
            <th width="30%">调用标签</th>
            <th width="40%">用途描述</th>            
            <th width="10%">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $cont.= '<tr id="'.$vo['id'].'"><td align="center" width="60"><input type="checkbox" name="delid[]" value="'.$vo['id'].'"/></td>';
                          $cont.='<td align="center">'.$vo['id'].'</td>';
                          $cont.= '<td align="center">{piece:'.$vo['sign'].'}</td>';
                          $cont.= '<td align="center">'.$vo['title'].'</td>';                         
                          $cont.='<td><a href="'.url('fragment/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a><div class="del">删除</div></td></tr>';
                       }
                       echo $cont;
                     }  
          ?>
          <tr>
             <td align="center"><input type="submit" class="btn btn-small"  value="删除"></td>
             <td colspan="5"><div class="pagelist">{$page}</div></td>
          </tr>
          </form>
        </table>
</div>
</body>
</html>
<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
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
			$.get("{url('admingroup/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>会员组列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">你当前的位置：【会员组列表】</div>
           <div class="list_head_mr"><a href="{url('admingroup/add')}" class="add">新增</a></div>
        </div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont" >
          <tr>
              <th width="100">ID</th>
              <th>会员组名</th>
              <th width="100">管理选项</th>
          </tr>
            <?php 
              if(!empty($list)){
                   foreach($list as $vo){
                     $book.='<tr id="'.$vo['id'].'"><td align="center">'.$vo['id'].'</td><td align="center">'.$vo['name'].'</td>';
                     $book.='<td><a href="'.url('admingroup/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a>';
                     $book.=($vo['id']==1 || $vo['id']==2)?'':'<div class="del">删除</div>';
                     $book.='</td></tr>';
                    } 
                   echo $book;
               }               
            ?>   
            <tr>
             <td colspan="3"><div class="pagelist">{$page}</div></td>
          </tr>
        </table>
</div>

</body>
</html>
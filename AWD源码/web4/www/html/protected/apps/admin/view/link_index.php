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
//锁定
function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('link/lock')}", {id:id,ispass:0},
   				function(data){
					if(data==1){
                      nowobj.html("审核");
					  nowobj.attr('class','unlock');
					  nowobj.unbind("click");
					  unlock(nowobj);
					}else alert(data);
   			});
		});
}
//解锁
function unlock(obj){
		obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('link/lock')}", {id:id,ispass:1},
   				function(data){
					if(data==1){
            nowobj.html("取消");
					  nowobj.attr('class','lock');
					  nowobj.unbind("click");
					  lock(nowobj);
					}else alert(data);
   			});
		});
}
$(function ($) { 
  $('#group').change(function(){
    $('#groups').submit()
  });
	//行颜色效果
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);
	lock($('.lock'));
	unlock($('.unlock'));
	$('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('link/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>单页列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【链接列表】</div>
           <div class="list_head_mr"><a href="{url('link/add')}" class="add">新增</a></div>                           
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
         <form action="{url('link/index')}" method="get" id="groups" >
           <tr>
             <td colspan="2"></td>
             <td align="center">
             <input name="r" type="hidden" value="{$_GET['r']}" />
               <select name="group" id="group">
                 <option value="">=所有分组=</option>
                 {$options}
               </select>
             </td>
             <td colspan="4"></td>
           </tr>
         </form>
          <form action="{url('link/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
          <tr>
            <th width="70"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th width="70">ID</th>
            <th width="120">分组名称</th>
            <th>链接信息</th>
            <th>链接详细</th>
            <th width="90">排序</th>
            <th width="120">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $logo=empty($vo['picture'])?empty($vo['logourl'])?'':$vo['logourl']:$path.$vo['picture'];
                          $cont.= '<tr id="'.$vo['id'].'"><td align="center" width="70"><input type="checkbox" name="delid[]" value="'.$vo['id'].'"/></td>';
                          $cont.= '<td align="center">'.$vo['id'].'</td>';
                          $cont.= '<td align="center">'.$vo['groupname'].'</td>';
                          $cont.= '<td align="center"><a target="_blank" href="'.$vo['url'].'">';
                          $cont.= ($logo=='')?$vo['name']:'<img src="'.$logo.'" title="'.$vo['name'].'" border="0">';
                          $cont.='</a></td><td align="center">'.$vo['info'].'</td>';
                          $cont.='<td align="center">'.$vo['norder'].'</td><td>';
                          $cont.=$vo['ispass']?'<div class="lock" >取消</div>':'<div class="unlock">审核</div>';
                          $cont.='<a href="'.url('link/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a><div class="del">删除</div></td></tr>';
                       }
                       echo $cont;
                     }
          ?>
          <tr>
             <td align="center"><input type="submit" class="btn btn-small"  value="删除"></td>
             <td colspan="6"><div class="pagelist">{$page}</div></td>
          </tr>
         </table>
       </form>
</div>
</body>
</html>
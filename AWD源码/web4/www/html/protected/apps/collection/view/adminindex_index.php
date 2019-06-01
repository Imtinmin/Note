<?php if(!defined('APP_NAME')) exit;?>
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
			$.get("{url('adminindex/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>

<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【采集项目列表】</div>
           <div class="list_head_mr"><a href="{url('adminindex/add')}" class="add">新增</a></div>                           
        </div>
         
         <form action="{url('adminindex/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="70"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th width="50">ID</th>
            <th>项目名称</th>
            <th>所属栏目</th>
            <th>上次采集时间</th>
            <th>操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
						  $vo['sort']=substr($vo['sort'],-6);
                          $cont.= '<tr id="'.$vo['id'].'"><td align="center" width="70"><input type="checkbox" name="delid[]" value="'.$vo['id'].'"/></td>';
						  $cont.= '<td align="center" width="50">'.$vo['id'].'</td>';
                          $cont.= '<td align="center">'.$vo['pname'].'</td>';
                          $cont.= '<td align="center">'.$sortinfo[$vo['sort']]['name'].'【'.$sortinfo[$vo['sort']]['type'].'】</td><td align="center">';
                          $cont.=$vo['lasttime']?date("Y-m-d H:i:s",$vo['lasttime']):'没有采集过';
						  $cont.='</td><td  width="130">';
                          $cont.='<a onClick="if(confirm(\'确定开始采集?\')) return true;return false" class="edt" href="'.url('adminindex/collecting',array('id'=>$vo['id'])).'">开始采集</a><a href="'.url('adminindex/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a><div class="del">删除</div></td></tr>';
                       }
                       echo $cont;
                     }
          ?>
          <tr>
             <td align="center"  width="70"><input type="submit" class="btn btn-small"  value="删除"></td>
             <td colspan="5"><div class="pagelist">{$page}</div></td>
          </tr>
         </table>
       </form>
</div>
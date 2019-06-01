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
			$.get("{url('tags/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
	  //更新点击
	 $('.hits').blur(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			var hits=nowobj.val();
			$.post("{url('tags/hits')}", {id:id,hits:hits},
   				function(data){
					if(data==1){
                      
					}else{
					  alert(data);
					}
   			});
		});
	//更新文档数量
	  $('.mesnum').click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().attr('id');
			$.post("{url('tags/mesup')}", {id:id},
   				function(data){
					if(data){
                       nowobj.html(data);
					}
   			});
		});
  });
</script>
<title>标签列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【标签列表】</div>   
           <div class="list_head_mr"><a href="{url('tags/hadd')}" class="btn btn-small btn-primary">手动添加</a></div>                  
        </div>
         
         <form action="{url('tags/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="70"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th>标签名称</th>
            <th  width="10%">点击量</th>
            <th  width="20%">文档数量&nbsp;<font size="-1">[点击更新]</font></th>
            <th  width="20%">链接地址</th>
            <th  width="20%">创建时间</th>
            <th width="10%">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
						  $vo["mesnum"]=empty($vo["mesnum"])?'未知':$vo["mesnum"];
                          $cont.= '<tr id="'.$vo['id'].'"><td align="center" width="70"><input type="checkbox" name="delid[]" value="'.$vo['id'].'"/></td>';
                          $cont.='<td align="center">'.$vo['name'].'</td>';
						  $cont.='<td align="center"><input type="text" size="3" class="hits" value="'.$vo['hits'].'"></td>';
						  $cont.='<td align="center" class="mesnum" title="点击更新">'.$vo['mesnum'].'</td>';
						  $cont.='<td align="center">'.$vo['url'].'</td>';
                          $cont.='<td align="center">'.date("Y-m-d H:i:s",$vo['addtime']).'</td>';
                          $cont.='<td><a class="edt" href="'.url('tags/edit',array("id"=>$vo["id"])).'">编辑</a><div class="del">删除</div></td></tr>';
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
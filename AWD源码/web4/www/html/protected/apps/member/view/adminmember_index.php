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

function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('adminmember/lock')}", {id:id,islock:1},
   				function(data){
					if(data==1){
                      nowobj.html("解冻");
					  nowobj.attr('class','unlock');
					  nowobj.unbind("click");
					  unlock(nowobj);
					}else alert(data);
   			});
		});
}

function unlock(obj){
		obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			
			$.post("{url('adminmember/lock')}", {id:id,islock:0},
   				function(data){
					if(data==1){
                      nowobj.html("冻结");
					  nowobj.attr('class','lock');
					  nowobj.unbind("click");
					  lock(nowobj);
					}else alert(data);
   			});
		});
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
	//ajax操作
	lock($('.lock'));
	unlock($('.unlock'));
	 $('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('adminmember/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>会员列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">你当前的位置：【会员列表】</div>
           <div class="list_head_mr">
		   	<div class="list_head_mr"><a href="{url('adminmember/add')}" class="add">新增</a></div>
           </div>
        </div>


         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont" >
         <form action="{url('adminmember/del')}" method="post" onSubmit="return confirm('删除不可以恢复~确定要删除吗？');"> 
          <tr>
              <th align="center" width="70"><input type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
              <th width="10%">账户</th>
              <th width="10%">昵称</th>
              <th width="10%">级别</th>
              <th width="10%">注册IP</th>
              <th width="18%">注册时间</th>
              <th width="10%">上次登录IP</th>
              <th width="18%">上次登录时间</th>
              <th width="14%">管理选项</th>
          </tr>
          <?php 
              if(!empty($list)){
                   foreach($list as $vo){
                     $book.='<tr id="'.$vo['id'].'"><td align="center"><input type="checkbox" name="delid[]" value="'.$vo['id'].'" /></td><td align="center">'.$vo['account'].'</td><td align="center">'.$vo['nickname'].'</td><td align="center">'.$vo['name'].'</td><td align="center">'.$vo['regip'].'</td>';
                     $book.='<td align="center">'.date('Y/m/d H:m:s',$vo['regtime']).'</td><td align="center">'.$vo['lastip'].'</td>'; 
					 $book.='<td align="center">'.date('Y/m/d H:m:s',$vo['lasttime']).'</td><td>';
                     $book.=$vo['islock']?'<div class="unlock">解冻</div>':'<div class="lock">冻结</div>';
                     $book.='<a href="'.url('adminmember/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a><div class="del">删除</div></td></tr>';
                    } 
                   echo $book;
               }               
            ?>   
            <tr>
             <td align="center"><input type="submit" class="btn btn-small"  value="删除"></td>
             <td colspan="8"><div class="pagelist">{$page}</div></td>
          </tr>
          </form>  
        </table>
  </div>
</body>
</html>
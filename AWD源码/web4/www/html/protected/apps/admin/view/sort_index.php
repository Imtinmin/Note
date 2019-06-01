<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script language="javascript">
//封面图效果
hs.graphicsDir = "__PUBLIC__/images/graphics/";
hs.showCredits = false;
hs.outlineType = 'rounded-white';
hs.restoreTitle = '关闭';

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
	lock($('.lock'));
	unlock($('.unlock'));
	//排序
	$('.order').click(function(){
		if(!$(this).has('input').length){
		   var order=$(this).html();
		   $(this).html('<input type="text" size="3" class="orderinput" value="'+order+'">');
		   $(this).find('.orderinput').select();
		   orderchange($(this).find('.orderinput'));
		}
	});
	//删除
	 $('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('sort/del')}", {id:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
	 //折叠
	 var hode='<img src="__PUBLICAPP__/images/minus.gif">';
	 var show='<img src="__PUBLICAPP__/images/plus.gif">';
	 $.each($(".all_cont tr"), function(i,val){  
        var id=$(this).attr('id');
		if(id){//初始化收缩图标
		  if($("."+id).length <= 0){
			$(this).find(".fold").remove();
		  }else{
			$(this).find(".fold").html(hode);
		  }
		}
		//if($(this).attr('class')){$(this).hide()}
     });
	 $('.fold').click(function(){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			if(hode==$(this).html()){
				$('.'+id).hide();
				$(this).html(show);
			}else {
				$('.'+id).find(".fold").html(hode);
				$('.'+id).show();
				$(this).html(hode);
			}
	  });
	 //折叠
	  $('#cl').click(function(){
	    $.each($(".all_cont tr"), function(i,val){  
            var id=$(this).attr('id');
		    if(id){
			  var mark=$(this).find(".fold");
			  if($(this).attr('class')){$(this).hide();mark.html(hode);}
			  else {mark.html(show);}
		  }
        });
	 });
	  //展开
	  $('#op').click(function(){
	    $.each($(".all_cont tr"), function(i,val){  
            $(this).show();
			var mark=$(this).find(".fold");
			if(mark){mark.html(hode);}
        });
	 });
	 //处理执行选择
	$('#dotype').change(function(){
		var delaction= "{url('sort/del')}" ;
		var moveaction="{url('sort/sortsmove')}";
		var editaction="{url('sort/sortsedit')}";
		if('del'==$(this).val()){
		   	$('#dos').attr('action',delaction);
			$('#dos').attr('onSubmit',"return confirm('删除后不可以恢复~确定要执行吗？');");
			$('#parentid').hide();
		}else if('move'==$(this).val()){
		    $('#dos').attr('action',moveaction);
			$('#dos').attr('onSubmit',"return confirm('移动后不可以恢复~确定要执行吗？');");
			$('#parentid').show();
		}else if('edit'==$(this).val()){
		    $('#dos').attr('action',editaction);
			$('#dos').attr('onSubmit',"");
			$('#parentid').hide();
		}
	});
  });
function orderchange(nowobj){
    //修改栏目排序
	  nowobj.blur(function(){
			var id=nowobj.parent().attr('id');
			var order=nowobj.val();
			$.post("{url('sort/orderchange')}", {id:id,order:order},
   				function(data){
					if(data==1){
                       nowobj.parent().html(nowobj.val());
					}else{
					  alert(data);
					}
   			});
		});
}
function delcover(obj){
  //删除封面
	if(confirm('是否要删除此封面图？')){
		var id=$(obj).attr('title');
		var pic=$(obj).attr('alt');
		$.post("{url('sort/delcover')}", {id:id,pic:pic},
   		  function(data){
			if(data==1){
              hs.close();
		      $('#c'+id).remove();
			}else alert(data);
   		});
	    
	}
	return false;
}
//隐藏
function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('sort/ifmenu')}", {id:id,ifmenu:0},
   				function(data){
					if(data==1){
                      nowobj.html("显示");
					  nowobj.attr('class','unlock');
					  nowobj.unbind("click");
					  unlock(nowobj);
					}else alert(data);
   			});
		});
}
//显示
function unlock(obj){
		obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.post("{url('sort/ifmenu')}", {id:id,ifmenu:1},
   				function(data){
					if(data==1){
                      nowobj.html("隐藏");
					  nowobj.attr('class','lock');
					  nowobj.unbind("click");
					  lock(nowobj);
					}else alert(data);
   			});
		});
}
</script>
<title>栏目管理</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【栏目管理】</div>
           <div class="list_head_mr"><a href="{url('sort/add')}" class="add">新增</a></div>  
</div>
<form action="{url('sort/del')}" method="post" id="dos"  onSubmit="return confirm('执行后不可以恢复~确定要执行吗？');"> 
         <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
          <tr>
            <th width="70"><input style="color:#E2E2E2" type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th width="70">ID</th>
            <th width="90">模型</th> 
            <th>栏目名称&nbsp;&nbsp;<a href="#" id="op"><img src="__PUBLICAPP__/images/plus.gif"></a>&nbsp;&nbsp;<a href="#" id="cl"><img src="__PUBLICAPP__/images/minus.gif"></a></th>  
            <th width="80">英文路径名</th>
            <th width="80">内容管理</th>    
            <th width="120">排序<font size="-2">[点击修改]</font></th>
            <th width="130">栏目管理</th>
          </tr>
          <?php          
             if(!empty($list)){
                foreach($list as $vo){
					if($vo['picture']!='NoPic.gif' && !empty($vo['picture'])){
					  switch ($vo['type']) {
			            case 1:
				          $vo['picture']='news/image/'.$vo['picture'];
				        break;
						case 2:
				          $vo['picture']='photos/'.$vo['picture'];
				        break;
						case 3:
				          $vo['picture']='pages/image/'.$vo['picture'];
				        break;
		              }
					}
                     $ext=($vo['extendid'] && ($vo['type']==1 || $vo['type']==2))? '&nbsp;<font color=green>[字段拓展]</font>':'';
					 if($vo['picture']!='NoPic.gif' && !empty($vo['picture'])) $ext.= '&nbsp;<span id="c'.$vo['id'].'"><a title="点击查看封面" href="'.$path.$vo['picture'].'" onClick="return hs.expand(this);"><img src="'.$public.'/images/pic.png"></a><a onClick="return delcover(this);" href="#" class="highslide-caption" alt="'.$vo['picture'].'" title="'.$vo['id'].'"><img src="'.$public.'/images/del.gif">删除</a></span>';  
                     $space = str_repeat('├┈┈┈', $vo['deep']-1); 
					 $class = str_replace(',',' ', substr($vo['path'], 8));
					 
					 $tlist.= '<tr id="'.$vo['id'].'" class="'.$class.'"><td align="center"><input type="checkbox" name="delid['.$vo['deep'].'][]" value="'.$vo['id'].'" /></td>';
					 $tlist.= '<td align="center">'.$vo['id'].'</td>';  
					 $tlist.= '<td align="center">'.$sort[$vo['type']]['name'].'模型</td>'; 
                     $tlist.= '<td>'.$space.'<a title="点击预览"  target="_blank" href="'.$vo['url'].'">'.$vo['name'].'</a>'.$ext.'&nbsp;&nbsp;<span class="fold"></span></td><td>'.$vo['ename'].'</td><td>'; 
					 $tlist.=($vo['type']==1 || $vo['type']==2)?'<a href="'.url($sort[$vo['type']]['mark'].'/index',array('sort'=>urlencode($vo['path'].','.$vo['id']))).'" class="edt">查看</a><a href="'.url($sort[$vo['type']]['mark'].'/add',array('sort'=>urlencode($vo['path'].','.$vo['id']))).'" class="edt">添加</a>':'';
                     $tlist.= '</td><td align="center" id="'.$vo['id'].'" class="order">'.$vo['norder'].'</td><td>';
					 $tlist.=$vo['ifmenu']?'<div class="lock" >隐藏</div>':'<div class="unlock">显示</div>';
                     $tlist.='<a href="'.url('sort/'.$sort[$vo['type']]['mark'].'edit',array('id'=>$vo['id'])).'" class="edt">编辑</a>';
					 $tlist.='<div class="del">删除</div></td></tr>';
                    }
                echo $tlist;
             }
           ?>     
           <tr> 
            <td colspan="8">
                 <div class="listdo">
                     <select name="dotype" id="dotype">
                        <option value="del">删除</option>
                        <option value="move">移动</option>
                        <option value="edit">编辑</option>
                     </select>
                 </div>
                 <div class="listdo" id="parentid" style="display:none; cursor:pointer">
                   <select  name="parentid">
                   <option value="" selected>=选择栏目=</option>
                    <option value="top" style="color:#137cd8">顶级栏目</option>
                   <?php
                     foreach($list as $vo){
                        $space = str_repeat('├┈', $vo['deep']-1);
                        $option.= '<option value="'.$vo['id'].'">'.$space.$vo ['name'].'</option>';
                     }
				     echo $option;
			       ?>
                   </select>
                 </div>
                 <div class="listdo"><input type="submit" class="btn btn-small"  value="执行"></div>
             </td>
          </tr>
        </table>
    </form>  
</div>
</body>
</html>
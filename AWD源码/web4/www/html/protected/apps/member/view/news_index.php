<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
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
	//下拉分类跳转
	$('#sort').change(function(){$('#colum').submit()});
	//处理执行选择
	$('#dotype').change(function(){
		var delaction= "{url('news/del')}" ;
		var changeaction="{url('news/colchange')}";
		if('del'==$(this).val()){
		   	$('#dos').attr('action',delaction);
			$('#col').hide();
		}else if('change'==$(this).val()){
		    $('#dos').attr('action',changeaction);
			$('#col').show();
		}
	});
	//ajax操作
	 $('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('news/del')}", {id:id},
   				function(data){
					if(data==1){
              delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
function delcover(obj){
  //删除封面
	if(confirm('是否要删除此封面图？')){
		var id=$(obj).attr('title');
		var pic=$(obj).attr('alt');
		$.post("{url('news/delcover')}", {id:id,pic:pic},
   		  function(data){
			if(data==1){
              hs.close();
		      $('#c'+id).remove();
			}else alert(data);
   		});
	    
	}
	return false;
}
</script>
<div id="contain">
<ul class="breadcrumb">
     <li> <span>信息列表</span><span class="divider">/</span><span>资讯列表</span></li>
</ul>
<table class="table table-bordered">
         <form action="{url('news/index')}" method="GET" id="colum" >
          <tr>
            <td></td>
            <td></td>
            <td align="center">
                <input name="r" type="hidden" value="{$_GET['r']}" />
                <select name="sort" id="sort">
                  <option value="">=所有资讯栏目=</option>
                  {$option}
               </select>
            </td>
            <td align="center"><a href="{url('news/add')}" class="btn btn-success">添加资讯</a></td>
            <td colspan="2" align="right">
                  <div style="float:right"> <input class="btn btn-success btn-small" type="submit" value="搜索"></div>
                  <div style="float:right">新闻标题：<input type="text" name="keyword" size="20"> </div>
                  <input name="r" type="hidden" value="{$_GET['r']}" />     
            </td>
          </tr>
          </form>
         <form action="{url('news/del')}" method="post" id="dos"  onSubmit="return confirm('执行后不可以恢复~确定要执行吗？');"> 
          <tr>
            <th align="center" width="50"><input style="color:#E2E2E2" type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <th width="50">ID</th>
            <th>所属栏目</th>
            <th>新闻标题(点击)</th>
            <th width="150" >添加日期</th>	
            <th width="150" align="center">管理选项</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $sortid=explode(',',$vo['sort']);
						              $vo['realname']=empty($vo['realname'])?"已被删除":$vo['realname'];
                          $sid=substr($vo['sort'], -6);
						              $vo['url']= Check::url($vo['method'])?$vo['method']:url('default/column/content',array('col'=>$sorts[$sid]['ename'],'id'=>$vo['id']));
                          $sortstr='';
                          foreach($sortid as $v){
                              $sortstr.=empty($sortname[$v])?'':$sortname[$v].'→';
                          }
                          $cont.= '<tr id="'.$vo['id'].'"><td align="center"><input type="checkbox" name="delid[]" value="'.$vo['id'].'" /></td>';
                          $cont.= '<td  align="center">'.$vo['id'].'</td>';
                          $cont.= '<td >'.$sortstr.'</td>';
                          $cont.= '<td><a title="点击预览" style="color:'.$vo['color'].'" target="_blank" href="'.$vo['url'].'">';
                          $cont.= str_replace($keyword,"<font color=green>$keyword</font>",$vo['title']).'</a><font color=green>（'.$vo['hits'].'点击）</font>';
                          $cont.= $vo['picture']=='NoPic.gif'?'':'<span id="c'.$vo['id'].'"><a title="点击查看封面" href="'.$path.$vo['picture'].'" onClick="return hs.expand(this);"><i class="icon-picture"></i></a><a onClick="return delcover(this);" href="#" class="highslide-caption" alt="'.$vo['picture'].'" title="'.$vo['id'].'"><img src="'.$public.'/images/del.gif">删除</a></span></td>';
                          $cont.= '<td width="150" align="center"><font size="-1">'.date("Y-m-d H:i:s",$vo['addtime']).'</font></td><td align="center"  width="150">';
                          $cont.=$vo['ispass']?'已审核&nbsp;':'待审核&nbsp;';
                          $cont.= '&nbsp;<a href="'.url('news/edit',array('id'=>$vo['id'])).'" class="edt">编辑</a>&nbsp;<a class="del" href="javascript:void(0);">删除</a</td></tr>';
                       }
                        echo $cont;
                     }else echo '<tr><td align="center" colspan="6" >还没有信息~</td></tr>';
          ?>
          <tr>
             <td colspan="3">
                 <span class="listdo">
                     <select name="dotype" id="dotype">
                        <option value="del">删除信息</option>
                        <option value="change">栏目移动</option>
                     </select>
                 </span>
                 <span class="listdo" id="col" style="display:none"><select  name="col"><option value="">=选择栏目=</option>{$option}</select></span>
                 <span class="listdo"><input type="submit" class="btn"  value="执行"></span>
             </td>
             <td colspan="5"><div class="pagelist">{$page}</div></td>
          </tr>
          </form>      
        </table>
</div>
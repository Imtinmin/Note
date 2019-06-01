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
  });
</script>
<title>自定义列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【自定义列表】</div>
           <div class="list_head_mr"><a href="{url('extendfield/tableadd')}" class="add">新增</a></div>                           
        </div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="60">ID</th>
            <th>类型</th>
            <th>用途描述</th>
            <th>表名</th>        
            <th width="200">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
						  $type=($vo['type']==0)?'附属表':'独立表';
                          $cont.='<tr><td align="center">'.$vo['id'].'</td>';
						  $cont.= '<td align="center">'.$type.'</td>';
                          $cont.= '<td align="center">'.$vo['name'].'</td>';
                          $cont.= '<td align="center">'.$vo['tableinfo'].'</td>';                         
                          $cont.='<td  width="200"><a href="'.url('extendfield/fieldlist',array('id'=>$vo['id'])).'" class="edt">字段管理</a><a href="'.url('extendfield/tableedit',array('id'=>$vo['id'])).'" class="edt">编辑</a>';
						  $cont.=$vo['type']==0?'':'<a href="'.url('extendfield/meslist',array('id'=>$vo['id'])).'" class="edt">内容管理</a>';
						  $cont.='<a href="'.url('extendfield/tabledel',array('id'=>$vo['id'])).'" class="del" onClick="return confirm(\'删除不可以恢复~确定要删除吗？\')">删除</a></td></tr>';
                       }
                       echo $cont;
                     }
          ?>
        </table>
</div>
</body>
</html>
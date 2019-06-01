<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script	language="javascript">
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
			var url=$(this).attr('title');
            location.href=url;
			}
	  });
  });

</script>
<title>前台模板{$tpfile}文件列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【前台模板"{$tpfile}"文件列表】</div>
		<div class="list_head_mr"><a href="{url('set/tpadd',array('Mname'=>$tpfile))}" class="add">新建</a></div>
		</div>
		<table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
           <tr>
              <th width="60%">文件名称</th>
              <th width="10%">文件大小</th>
              <th width="20%">修改时间</th>
              <th width="10%">操作</th>
           </tr>
           <?php 
              if(!empty($flist)){
                   foreach ($flist as $vo){
                       $list.='<tr><td align="center"><font color=green>'.$vo['name'].'</font></td>';
                       $list.='<td align="center">'.$vo['size'].'KB</td>';
                       $list.='<td align="center">'.$vo['time'].'</td>';
					   $list.='<td align="center"><a class="edt" href="'.url('set/tpedit',array('Mname'=>$tpfile,'fname'=>$vo['name'])).'">编辑</a><div class="del" title="'.url('set/tpdel',array('Mname'=>$tpfile,'fname'=>$vo['name'])).'" href="#" >删除<div></td></tr>';
                   }
                 echo $list;
               }
            ?>
		</table>
</div>
</body>
</html>
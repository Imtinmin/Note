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
	$('.del').click(function(){
			if(confirm('删除将不可恢复~')){
			var delobj=$(this).parent().parent();
			var id=delobj.attr('id');
			$.get("{url('files/del')}", {fname:id},
   				function(data){
					if(data==1){
                      delobj.remove();
					}else alert(data);
   			});
			}
	  });
  });
</script>
<title>上传文件列表</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：{$daohang}</div>                      
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="90%">文件信息</th>
            <th width="10%">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $cont.='<tr id="'.$dirget.",".$vo['name'].'">';
						  switch ($vo['type']) {
	   	                        case 1:
								  if(empty($dirget)){
									  switch ($vo['name']) {
	   	                                 case 'extend':
                                           $vo['cname']='自定义表';
	   		                             break;
	   	                                 case 'fragment':
                                           $vo['cname']='碎片信息';
	   		                             break;
										 case 'links':
                                           $vo['cname']='友情链接';
	   		                             break;
										 case 'news':
                                           $vo['cname']='资讯内容';
	   		                             break;
										 case 'pages':
                                           $vo['cname']='单页栏目';
	   		                             break;
										 case 'photos':
                                           $vo['cname']='图集内容';
	   		                             break;
										 default:
                                           $vo['cname']=$vo['name'];
	   		                             break;
	                                  }
									  $cont.='<td align="left" colspan="2"><a class="files" href="'.url('files/index',array('dirget'=>$dirget.",".$vo['name'])).'">'.$vo['cname'].'</a></td>';
								  }else $cont.='<td align="left"><a class="files" href="'.url('files/index',array('dirget'=>$dirget.",".$vo['name'])).'">'.$vo['name'].'</a></td><td><div class="del">删除</div></td>';
	   		                    break;
								
								case 2: //图片
	   		                      $cont.='<td align="left"><a href="'.$upload.$urls.$vo['name'].'" onClick="return hs.expand(this)">'.$vo['name'].'</a>&nbsp;<font size="-1" color="#999">'.$vo['size'].'KB&nbsp;&nbsp;'.$vo['time'].'</font></td><td><div class="del">删除</div></td>';
	   		                    break;
								
								case 3: //合法文件
	   		                      $cont.='<td align="left"><a href="'.$upload.$urls.$vo['name'].'">'.$vo['name'].'</a>&nbsp;<font size="-1" color="#999">'.$vo['size'].'KB&nbsp;&nbsp;'.$vo['time'].'</font></td><td><div class="del">删除</div></td>';
	   		                    break;
								
								case 4: //非法文件
	   		                      $cont.='<td align="left" title="非法文件请马上删除" style="color:red">'.$vo['name'].'&nbsp;<font size="-1" color="#999">'.$vo['size'].'KB&nbsp;&nbsp;'.$vo['time'].'</font></td><td><div class="del">删除</div></td>';
	   		                    break;
	                      }
                          $cont.='</tr>';
                       }
                       echo $cont;
                 }
          ?>
         </table>
</div>
</body>
</html>
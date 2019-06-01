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
	  //更新点击
	 $('#begin').click(function(){
		    $('#backdata').html('标签生成，中请耐心等待~');
			var sortid=$('#sortid').val();
			var num=$('#num').val();
			$.post("{url('tags/add')}", {sortid:sortid,num:num<!--TOKEN-->},
   				function(data){
					$('#backdata').html('生成了'+data+'个TAG标签'+'<a href="{url('tags/index')}">TAG列表</a>');
   			});
		});
  });
</script>
<title>标签生成</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【标签生成】</div>                    
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <td width="15%" align="right">选择栏目：</td>
            <td>
              <select name="sortid" id="sortid">
               <option selected="selected" value="0">=所有栏目=</option>
                  <?php 
                      if(!empty($list)){
                      foreach($list as $vo){
						  $disable=($vo['type']==1 || $vo['type']==2)?'':'disabled';
                          $space = str_repeat('├┈┈┈', $vo['deep']-1);                     
                           $option.= '<option value="'.$vo['id'].'" '.$disable.' >'.$space.$vo ['name'].'</option>';
                        }
                      echo $option;
                     }
                  ?>
             </select>
            </td>
            <td align="left" class="inputhelp">将根据栏目下信息的“SEO关键词”，生成TAG标签</td>
          </tr>
          <tr>
            <td width="15%" align="right">预计生成TAG：</td>
            <td><input type="text" id="num" size="4" value=""> 个</td>
            <td align="left" class="inputhelp">不填写则默认无限制</td>
          </tr>
          <tr>
             <td align="center" colspan="2"><button class="btn btn-small" id="begin">开始生成</button></td>
             <td align="left" id="backdata" style="color:green"></td>
          </tr>
         </table>
</div>
</body>
</html>
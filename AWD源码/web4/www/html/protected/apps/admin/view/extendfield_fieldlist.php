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
<title>{$info['tableinfo']}表中的字段</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">你当前的位置：【{$info['name']}（{$info['tableinfo']}）表字段列表】</div>
           <div class="list_head_mr"><a class="btn btn-primary btn-small" href="{url('extendfield/fieldadd',array('id'=>$info['id']))}" >新增字段</a></div>                           
        </div>



         <table  border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="60">ID</th>
            <th>字段描述</th>
            <th>字段名</th>     
            <th>类型</th>  
            <th>默认值</th> 
            <th>排序</th> 
            <th width="80">管理操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      $type='';
                      foreach($list as $vo){
                            switch($vo['type']) {
                                  case 1:        
                                        $type= "单行文本";
                                        break;
                                  case 2:        
                                        $type= "多行文本";
                                        break;
                                  case 3:        
                                        $type= "大型文本";
                                        break;
                                  case 4:        
                                       $type= "下拉列表";
                                       break;
                                  case 5:        
                                       $type= "上传框";
                                       break;
							      case 6:        
                                       $type= "多选按钮";
                                       break;
                          }
                          $cont.='<tr><td align="center">'.$vo['id'].'</td>';
                          $cont.= '<td align="center">'.$vo['name'].'</td>';
                          $cont.= '<td align="center">'.$vo['tableinfo'].'</td>'; 
                          $cont.= '<td align="center">'.$type.'</td>';   
                          $cont.= '<td align="center">'.$vo['defvalue'].'</td>';       
						  $cont.= '<td align="center">'.$vo['norder'].'</td>';                   
                          $cont.='<td  width="80"><a href="'.url('extendfield/fieldedit',array('id'=>$vo['id'])).'" class="edt">修改</a><a href="'.url('extendfield/fielddel',array('id'=>$vo['id'])).'" class="del" onClick="return confirm(\'删除不可以恢复~确定要删除吗？\')">删除</a></td></tr>';
                       }
                       echo $cont;
                     }
          ?>
        </table>
</div>
</body>
</html>
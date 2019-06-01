<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
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
  });
</script>
<title>添加独立表信息</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">你当前的位置：【添加独立表信息】</div>
		<div class="list_head_mr"></div>
		</div>

<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KindEditor.ready(function(K) {
	K.create('.editori', {
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']

	});
});
</script>
		<form action="{url('extendfield/mesadd',array('tabid' => $tableid))}" method="post" id="info" >
		<table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   > 
            <?php 
			  $cont.='';
			  for($i=1;$i<count($tableinfo);$i++){
				 $cont.= '<tr><td align="right">'.$tableinfo[$i]['name'].'：</td><td align="left">';
				 switch ($tableinfo[$i]['type']) {
           	        case 1:
           		    $cont.= '<input type="text" name="'.$tableinfo[$i]['tableinfo'].'" value="'.$info[$tableinfo[$i]['tableinfo']].'">';
           		    break;
					
					case 2:
           		    $cont.= '<textarea name="'.$tableinfo[$i]['tableinfo'].'" style="width:300px !important; height:80px">'.$info[$tableinfo[$i]['tableinfo']].'</textarea>';
           		    break;
					
					case 3:
           		    $cont.= '<textarea class="editori" name="'.$tableinfo[$i]['tableinfo'].'" style="width:100%;height:250px;visibility:hidden;">'.$info[$tableinfo[$i]['tableinfo']].'</textarea>';
           		    break;
					
					case 4:
           		    $cont.= '<select name="'.$tableinfo[$i]['tableinfo'].'" >';	
					$chooses=explode("\r\n",$tableinfo[$i]['defvalue']);
					foreach ($chooses as $vo) {
						$vos=explode(",",$vo);
        		        $cont.= ($info[$tableinfo[$i]['tableinfo']]==$vos[0])?'<option selected value="'.$vos[0].'">'.$vos[1].'</option>':'<option value="'.$vos[0].'">'.$vos[1].'</option>';
        	        }
					$cont.= '</select>';
           		    break;
					
					case 5:
           		    $cont.= '<input name="'.$tableinfo[$i]['tableinfo'].'" id="'.$tableinfo[$i]['tableinfo'].'" type="text"  value="'.$info[$tableinfo[$i]['tableinfo']].'" />';
					$cont.= '<iframe scrolling="no"; frameborder="0" src="'.url("extendfield/file",array('inputName'=>$tableinfo[$i]['tableinfo'])).'" style="width:300px; height:30px;"></iframe>';
           		    break;
					
					case 6:
					$chooses=explode("\r\n",$tableinfo[$i]['defvalue']);
					foreach ($chooses as $vo) {
						$vos=explode(",",$vo);
						$nowval=array();
						$nowval=explode(",",$info[$tableinfo[$i]['tableinfo']]);
						$cont.= (in_array($vos[0],$nowval))?$vos[1].'<input checked type="checkbox" name="'.$tableinfo[$i]['tableinfo'].'[]" value="'.$vos[0].'" />':$vos[1].'<input type="checkbox" name="'.$tableinfo[$i]['tableinfo'].'[]" value="'.$vos[0].'" />';
        	        }
           		    break;
                 }
				 $cont.= '</td></tr>';
			  }
			  echo $cont;
			?>
          <tr>
            <td></td>
            <td align="left"><input type="submit" class="btn btn-primary btn-small" value="添加">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>
		</form>
</div>
</body>
</html>
<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script language="javascript">
KindEditor.ready(function(K) {
	K.create('.editori', {
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		items : [
				'source','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']

	});
});
  $(function ($) { 
	//行颜色效果
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	});
  });
</script>
<title>独立表信息编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【独立表信息编辑】</div>
        </div>

        <form  action="{url('extendfield/mesedit',array('tabid'=>$tableid,'id'=>$id))}"  method="post" id="info" name="info" >
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
           		    $cont.= '<textarea class="editori" name="'.$tableinfo[$i]['tableinfo'].'" style="width:100%;height:250px;visibility:hidden;">'.html_out($info[$tableinfo[$i]['tableinfo']]).'</textarea>';
           		    break;
					
					case 4:
           		    $cont.= '<select name="'.$tableinfo[$i]['tableinfo'].'" >';	
					$chooses=explode("\r\n",$tableinfo[$i]['defvalue']);
					$flog=false;
					foreach ($chooses as $vo) {
						$vos=explode(",",$vo);
                        if($info[$tableinfo[$i]['tableinfo']]==$vos[0]) {
                        	$flog=true;
                        	$cont.='<option selected value="'.$vos[0].'">'.$vos[1].'</option>';
                        }else{
                        	$cont.='<option value="'.$vos[0].'">'.$vos[1].'</option>';
                        }
        	        }
        	        if(!$flog) $cont.='<option selected value="">=没有选择=</option>';
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
						$cont.= (in_array($vos[0],$nowval))?$vos[1].'<input checked type="checkbox" name="'.$tableinfo[$i]['tableinfo'].'[]" value="'.$vos[0].'" />':$vos[1].'<input type="checkbox" name="'.$tableinfo[$i]['tableinfo'].'[]" value="'.$vos[0].'" /><br>';
        	        }
           		    break;
                 }
				 $cont.= '</td></tr>';
			  }
			  echo $cont;
			?>
          <tr>
            <td align="right">提交时间：</td>
            <td align="left">{date($info['addtime'],Y-m-d h:i:s)}</td>
          </tr>
          <tr>
            <td align="right">IP：</td>
            <td align="left">{$info['ip']}</td>
          </tr>
          <tr>
            <td></td>
            <td align="left"><input type="submit" class="btn btn-primary btn-small" value="编辑">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>
</form>
</div>
</body>
</html>
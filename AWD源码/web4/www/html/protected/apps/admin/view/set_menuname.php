<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<title>【后台模型】</title>
<script language="javascript">
  $(function ($) { 
	//多选框
	$('.group_con input:checkbox').click(function(){
	    var id='#'+$(this).attr('class');
		var tclass='.'+$(this).attr('class');
		var judge=false;
		$(tclass).each( function(n){
           if($(this).attr('checked'))
		      judge=true;
        });
		if(judge)  $(id).attr('checked',true);
		else $(id).attr('checked',false);
	});
  });
</script>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【后台功能地图】</div>
           <div class="list_head_mr">

           </div>
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form action="{url('set/menuname')}"  method="post">
          <tr>
            <td align="left">
            <?php          
             if(!empty($list)){
                $menus='<fieldset><legend></legend>';
                foreach($list as $vo){
                    if(empty($vo['name'])) $vo['name']=$vo['operate'];
                    $check=$vo['ifmenu']?'checked="checked"':'';
					$style=$vo['ifmenu']?'style="color:green"':'';
					if($vo['rootid']!=0){
                       if($vo['pid']==0)
                          $menus.='</fieldset><fieldset class="pgroup"><legend class="group_tit" title="'.$vo['operate'].'"><input  name="menu[]" '.$check.' style="display:none" id="check'.$vo['id'].'" type="checkbox" value="'.$vo['id'].'" /><input class="gname" name="mname['.$vo['id'].']"  type="text" value="'.$vo['name'].'" /></legend>';
                       else 
                          $menus.='<div class="group_con" title="'.$vo['operate'].'"><input style="display:none" name="menu[]" '.$check.' class="check'.$vo['pid'].'" type="checkbox" value="'.$vo['id'].'" /><input class="cname" '.$style.' name="mname['.$vo['id'].']"  type="text" value="'.$vo['name'].'" /></div>';
                    }
				}
                echo $menus;
             }
           ?>
            </td>
          </tr>         
          <tr>
            <td align="center">
              
              <input  type="submit" value="设置" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </form>      
        </table>
</div>
</body>
</html>
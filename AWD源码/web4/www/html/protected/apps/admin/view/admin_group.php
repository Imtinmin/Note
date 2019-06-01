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
	$('#selectAll').click(function(){   
       $("[name='power[]']").attr("checked",'true');//全选 ,name为input标签name属性值
    });

    $('#selectNone').click(function(){   
       $("[name='power[]']").removeAttr("checked");//取消全选   
    });	
  });
</script>
<title>权限管理</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【权限管理】</div>
           <div class="list_head_mr">

           </div>
        </div>


         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th width="100">ID</th>
            <th>权限组名</th>
            <th width="110">管理选项</th>
          </tr>          
          <?php          
             if(!empty($grouplist)){
                foreach($grouplist as $vo){  
                     $glist.= '<tr><td align="center">'.$vo ['id'].'</td>';
                     $glist.= '<td align="center">'.$vo ['name'].'</td>'; 
                     $glist.= '<td><a href="'.url('admin/groupedit',array('id'=>$vo['id'])).'" class="edt">编辑</a><a href="'.url('admin/groupdel',array('id'=>$vo['id'])).'" class="del" onClick="return confirm(\'删除不可以恢复~确定要删除吗？\')">删除</a></td></tr>';
                    }
                echo $glist;
             }else{echo '<tr><td colspan="3"  align="center" style="color:green">您还没有添加任何权限组~</td></tr>';}
           ?> 
        </table>


         <table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont mt20">
          <form action="{url('admin/group')}"  method="post">
          <tr>
            <td align="right" width="100">权限组名：</td>
            <td align="left"><input type="text" name="gname" id="gname"><span class="inputhelp">&nbsp;&nbsp;&nbsp;&nbsp;请在下方勾选该管理权限组的管理员可以操作的功能</span></td>
          </tr> 
          
          <tr>
            <td align="right">管理权限：</td>
            <td align="left">
            <?php          
             if(!empty($powerlist)){
                $powers='<fieldset class="pgroup"><legend class="group_tit"><font color=green>拓展应用</font></legend>';
                foreach($powerlist as $vo){
                    if(empty($vo['name'])) $vo['name']=$vo['operate'];
                    if($vo['pid']==0&&$vo['rootid']!=0)
                       $powers.='</fieldset><fieldset class="pgroup"><legend class="group_tit"><input name="power[]" id="check'.$vo['id'].'"   style="display:none" type="checkbox" value="'.$vo['id'].'" />'.$vo['name'].'</legend>';
                    else 
                       $powers.='<div class="group_con"><input name="power[]" class="check'.$vo['pid'].'" type="checkbox" value="'.$vo['id'].'" />'.$vo['name'].'</div>';
                    }
                echo $powers;
             }
           ?>
            </td>
          </tr> 
          
          <tr>
            <td>&nbsp;</td>
            <td align="left">
              <input type="submit" value="添加" class="btn btn-primary btn-small">
              <input type="button" value="全选" class="btn btn-primary btn-small" id="selectAll" >
              <input type="reset" value="清空" class="btn btn-primary btn-small" id="selectNone" >
            </td>
          </tr> 
          </form>       
        </table>
</div>
</body>
</html>
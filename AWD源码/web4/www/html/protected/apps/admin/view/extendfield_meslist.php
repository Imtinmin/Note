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
function CheckAll(form) { //复选框全选/取消
	for (var i=0;i<form.elements.length;i++) { 
		var e = form.elements[i]; 
		if (e.Name != "chkAll"&&e.disabled!=true) 
		e.checked = form.chkAll.checked; 
	} 
  } 
   //锁定
function lock(obj){
	     obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.get("{url('extendfield/meslock')}", {id:id,tabid:"{$tableid}",ispass:0},
   				function(data){
					if(data==1){
                      nowobj.html("审核");
					  nowobj.attr('class','unlock');
					  nowobj.unbind("click");
					  unlock(nowobj);
					}else alert(data);
   			});
		});
}
//解锁
function unlock(obj){
		obj.click(function(){
			var nowobj=$(this);
			var id=nowobj.parent().parent().attr('id');
			$.get("{url('extendfield/meslock')}", {id:id,tabid:"{$tableid}",ispass:1},
   				function(data){
					if(data==1){
                      nowobj.html("取消");
					  nowobj.attr('class','lock');
					  nowobj.unbind("click");
					  lock(nowobj);
					}else alert(data);
   			});
		});
}
$(function ($) { 
	lock($('.lock'));
	unlock($('.unlock'));
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
<title>独立表中数据</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【独立表中数据】</div>
		   <div class="list_head_mr">
		   	<div class="list_head_mr"><a href="{url('extendfield/mesadd',array('tabid' => $tableid))}" class="add">新增</a></div>
           </div>
</div>                           
    <form action="{url('extendfield/mesdel',array('tabid' => $tableid))}" method="post"  onSubmit="return confirm('执行后不可以恢复~确定要执行吗？');"> 
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <th align="center" width="85"><input style="color:#E2E2E2" type="checkbox" name="chkAll" value="checkbox" onClick="CheckAll(this.form)"/></th>
            <?php 
			   for($i=1;$i<6;$i++){
				 if($tableinfo[$i]['name']){
			?>
                    <th><?php echo $tableinfo[$i]['name']; ?></th>
			<?php 	 
			     }
			   }
			?>       
            <th width="200">操作</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $cont.='<tr id="'.$vo['id'].'">';
						  $cont.='<td align="center"><input type="checkbox" name="delid[]" value="'.$vo['id'].'" /></td>';
						  for($i=1;$i<6;$i++){
							if($tableinfo[$i]['tableinfo']) $cont.= '<td align="center">'.html_out($vo[$tableinfo[$i]['tableinfo']]).'</td>';
						  }
						  $cont.='<td><a href="'.url('extendfield/mesedit',array('tabid'=>$tableinfo[0]['id'],'id'=>$vo['id'])).'" class="edt">编辑查看</a>';
						  $cont.=$vo['ispass']?'<div class="lock" >取消</div>':'<div class="unlock">审核</div>';
						  $cont.='</td></tr>';
                       }
                       echo $cont;
                     }
          ?>
          <tr>
            <td align="center"><input type="submit" class="btn btn-small"  value="删除"></td>
            <td colspan="<?php echo count($tableinfo);?>"><div class="pagelist">{$page}</div></td>
          </tr>
        </table>
        </form>
</div>
</body>
</html>
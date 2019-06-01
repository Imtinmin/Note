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
<script language="javascript">
  $(function ($) { 
	//行颜色效果
	$('#tableh tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);
	$('#sp').click(function(){
		var obj=$("#sortpower");
		if(obj.css('display')=='none') {
			obj.show();
			$(this).html('－栏目权限');
		}else{
		    obj.hide();
			$(this).html('＋栏目权限');
		}
    });
	$('#tp').click(function(){
		var obj=$("#extendpower");
		if(obj.css('display')=='none')  {
			obj.show();
			$(this).html('－独立表权限');
		}else{
		    obj.hide();
			$(this).html('＋独立表权限');
		}
    });
	//栏目权限
  var hode='<img src="__PUBLICAPP__/images/minus.gif">';
  var show='<img src="__PUBLICAPP__/images/plus.gif">';
  $.each($(".exsort"), function(i,val){  
       if($(this).next().html()){
	      $(this).find('.fold').html(show);
	   }
   });
  $('.exsort a').click(function(){
	var obj=$(this).parent().next();
	if(obj.css('display')=='none') {
      if(obj.html()=='') {$(this).html('');}else {$(this).html(hode);obj.show();}
    }else{
       obj.hide();
	   $(this).html(show);
    }  
  });
	  //表单验证
	var items_array = [
	    { name:"username",max:10,simple:"账户",focusMsg:'10位内'},
		{ name:"rpassword",min:6,simple:"密码",focusMsg:'大于6位'},
		{ name:"spassword",type:'eq',to:'rpassword',simple:"确认密码",focusMsg:'再次输入密码'},
		{ name:"realname",type:'chn',simple:"真实姓名",max:5,focusMsg:'小于5字'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>管理员管理</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【管理员列表】{}</div>
           <div class="list_head_mr">
             
           </div>
</div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
          <form action="{url('admin/index')}"  method="post" id="info" name="info">
          <tr>
            <td align="right" width="200">权限组：</td>
            <td align="left">
             <select name="groupid" id="groupid">
                  <?php
                     if(!empty($grouplist)){
                        foreach($grouplist as $vo){
                          if($vo['id']==1&&1!=$_SESSION['auth_groupid']) continue;
                          $option.='<option value="'.$vo['id'].'">'.$vo['name'].'</option>';
                        }
                      echo $option;
                      }
                 ?>
             </select>
             &nbsp; &nbsp; &nbsp;[<a href="#" id="sp">＋栏目权限</a>] &nbsp; 
             [<a href="#" id="tp">＋独立表权限</a>]
            </td>
            <td align="left" class="inputhelp">权限级别请在<a href="{url('admin/group')}">这里设置</a></td>
          </tr> 
          <tr id="sortpower" style="display:none">
            <td align="right" width="200">栏目内容权限：</td>
            <td align="left"><p>
                 <?php 
                      if(!empty($sortlist)){
                      foreach($sortlist as $vo){
                          $space = str_repeat('├┈┈┈', $vo['deep']-1); 
                          $sortpower.= $vo['deep']==1?'</p><p class="exsort">'.$space.'<input type="checkbox" name="sortpower[]" value="'.$vo['id'].'">'.$vo['name'].'&nbsp;<a href="#" class="fold" onclick="return false;"></a></p><p style="display:none">':$space.'<input type="checkbox" name="sortpower[]" value="'.$vo['id'].'">'.$vo['name'].'<br>';
                        }
                        echo $sortpower;
                     }
                  ?>
            </td>&nbsp;
            <td align="left" class="inputhelp">不勾选则默认为拥有所有栏目权限</td>
          </tr>
          <tr id="extendpower" style="display:none">
            <td align="right" width="200">独立表内容权限：</td>
            <td align="left">
                 <?php 
                      if(!empty($extendlist)){
                      foreach($extendlist as $vo){ 
                          $extendpower.= $space.'<input type="checkbox" name="extendpower[]" value="'.$vo['id'].'">'.$vo['name'].'&nbsp;&nbsp;&nbsp;&nbsp;';
                        }
                        echo $extendpower;
                     }
                  ?>
            </td>
            <td align="left" class="inputhelp">不勾选默认为拥有所有独立表内容管理权限</td>
          </tr>
          <tr>
            <td align="right">账户名：</td>
            <td align="left">
              <input type="text" name="username" id="username">
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          
          <tr>
            <td align="right">密码：</td>
            <td align="left">
              <input type="password" name="rpassword" id="rpassword">
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          
          <tr>
            <td align="right">确认密码：</td>
            <td align="left">
              <input type="password" name="spassword" id="spassword">
            </td>
            <td align="left" class="inputhelp">&nbsp;</td>
          </tr> 
          
          <tr>
            <td align="right">真实姓名：</td>
            <td align="left">
              <input type="text" name="realname" id="realname">
            </td>
            <td align="left" class="inputhelp">该管理员所有操作将会以这个名称标记</td>
          </tr> 
          
          <tr>
            <td align="right">是否锁定</td>
            <td align="left">
              <input name="iflock"  type="radio" value="1" />是 <input checked="checked"  name="iflock" type="radio" value="0" />否
            </td>
            <td align="left" class="inputhelp">锁定后管理员将不能登陆</td>
          </tr> 
          
          <tr>
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">
              <input type="submit" value="添加" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </form>         
        </table>



         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont mt20" id="tableh">
          <tr>
              <th>管理员</th>
              <th>信息数量</th>
              <th>最后登录IP</th>
              <th>最后登录时间</th>
              <th>权限级别</th>
              <th width="150">管理选项</th>
          </tr>
          <?php 
                 if(!empty($list)){
                      foreach($list as $vo){
                          $vo['lastlogin_ip'] = $vo['lastlogin_ip']?$vo['lastlogin_ip']:'该用户没有登陆过';
                          $vo['lastlogin_time'] = $vo['lastlogin_time']?date('Y-m-d H:i:s',$vo['lastlogin_time']):'该用户没有登陆过';
                          $cont.= '<tr><td align="center">'.$vo['username'];
						  if($vo['realname']) $cont.='['.$vo['realname'].']';
						  $cont.= '</td><td align="center">'.$vo['num'].'条</td>';
                          $cont.= '<td align="center">'.$vo['lastlogin_ip'].'</td>';
                          $cont.= '<td align="center">'.$vo['lastlogin_time'].'</td>';
                          $cont.= '<td align="center">'.$vo['name'].'</td>';
                          $cont.= '<td align="center"><a href="'.url('admin/adminedit',array('id'=>$vo['id'])).'" class="edt">修改</a><a href="'.url('admin/admindel',array('id'=>$vo['id'])).'" class="del" onClick="return confirm(\'删除不可以恢复~确定要删除吗？\')">删除</a>';
                          $cont.=$vo['iflock']?'<a class="unlock" href="'.url('admin/adminlock',array('id'=>$vo['id'],'l'=>0)).'">解锁</a>':'<a class="lock" href="'.url('admin/adminlock',array('id'=>$vo['id'],'l'=>1)).'">锁定</a>';
                          $cont.='</td></tr>';
                       }
                        echo $cont;
                     }
          ?>      
          <tr><td colspan="6" align="right"><div class="pagelist">{$page}</div></td></tr>  
        </table>
</div>
</body>
</html>

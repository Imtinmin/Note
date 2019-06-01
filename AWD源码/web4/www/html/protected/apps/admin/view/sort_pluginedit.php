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
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);
	//自动获取栏目名称
	$('#method').change(function(){
		 $('#sortname').val($(this).find('option:selected').text());
	});
	 //表单验证
	var items_array = [
		{ name:"sortname",simple:"栏目名称",focusMsg:'填写栏目名称'},
		{ name:"method",simple:"模型/方法",focusMsg:'选择模型/方法'},
		{ name:"tplist",simple:"模板",focusMsg:'模板'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>应用栏目编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【应用栏目编辑】</div>
           <div class="list_head_mr">

           </div>
        </div>



         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form action="{url('sort/pluginedit',array('id'=>$id))}"  method="post" id="info">
          <tr>
            <td align="right" width="200">所属类别：</td>
            <td align="left">
             <select name="parentid" id="parentid">
               <option value="0">=作为顶级分类=</option>
                  <?php 
                      if(!empty($list)){
                      foreach($list as $vo){
                          $space = str_repeat('├——', $vo['deep']-1);  
                          $ifselect =($oldparentid==$vo['id'])?'selected="selected"':'';
                          $option.= '<option '.$ifselect.' value="'.$vo['id'].'">'.$space.$vo['name'].'</option>';
                        }
                        echo $option;
                     }
                  ?>
             </select>
            </td>
            <td align="left" class="inputhelp">支持无限分类</td>
          </tr> 
          
          <tr>
            <td align="right">栏目名称：</td>
            <td align="left">
              <input type="text" value="{$info['name']}" name="sortname" id="sortname">
            </td>
            <td align="left" class="inputhelp">请填写要添加分类的名称</td>
          </tr> 
           <tr>
            <td align="right">应用控制器：</td>
            <td align="left">
              <select name="method" id="method">
               {$choose}
              </select>  
            </td>
            <td align="left" class="inputhelp">默认为应用中index控制器的index方法</td>
          </tr>
          <tr>
            <td align="right">排序：</td>
            <td align="left">
              <input type="text" value="{$info['norder']}" name="norder" id="norder" value="0" size="3">
            </td>
            <td align="left" class="inputhelp">请以数字表示分类的排序（值越小越靠前）</td>
          </tr> 
          <tr>
            <td align="right">是否前台显示：</td>
            <td align="left"><input <?php echo ($info['ifmenu']==1)?'checked="checked"':''; ?> name="ifmenu"  type="radio" value="1" />是 <input <?php echo ($info['ifmenu']==0)?'checked="checked"':''; ?>  name="ifmenu" type="radio" value="0" />否</td>
            <td class="inputhelp">选择是否在前台各种导航菜单中显示</td>
          </tr> 
          
          <tr>
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">
              <input type="submit" value="编辑" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </form>         
        </table>
</div>
</body>
</html>

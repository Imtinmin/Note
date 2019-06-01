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
   $('#formid').change(function(){
		 $('#sortname').val($(this).find('option:selected').text());
	});
	//行颜色效果
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);
	 //表单验证
	var items_array = [
		{ name:"sortname",simple:"栏目名称",focusMsg:'填写栏目名称'},
		{ name:"formid",simple:"自定义表",focusMsg:'自定义表'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
</script>
<title>表单栏目编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【表单栏目编辑】</div>
           <div class="list_head_mr">

           </div>
        </div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form action="{url('sort/extendedit',array('id'=>$id))}"  method="post" id="info">
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
            <td align="right">自定义表：</td>
            <td align="left">
              <select name="formid">
                <?php
				$formcon='';
                foreach ($forminfo as $vo) {
				  $selected=($vo['id']==$info['extendid'])?'selected="selected"':'';
				  $formcon.='<option '.$selected.' value="'.$vo['id'].'">'.$vo['name'].'</option>';
			    }
				echo $formcon;
				?>
              </select>
            </td>
            <td align="left" class="inputhelp"><a style="color:green" href="{url('extendfield/tableadd')}">创建自定义表单</a></td>
          </tr>
          <tr>
            <td align="right">自定义名称：</td>
            <td align="left">
              <input type="text" value="{$info['name']}" name="sortname" id="sortname">
            </td>
            <td align="left" class="inputhelp">请填写要添加栏目的名称</td>
          </tr> 
          <tr>
            <td align="right"  width="100">栏目英文名称：</td>
            <td align="left">
              <input type="text" name="ename" id="ename" value="{$info['ename']}">
            </td>
            <td align="left" class="inputhelp">留空则采用栏目ID,用于url路径</td>
          </tr>
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input value="{$info['keywords']}" type="text" name="keywords" id="keywords" size="40"></td>
            <td class="inputhelp">将被用来作为栏目页标题，用英文逗号隔开，留空时将根据标题和内容自动生成</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="40" rows="5" name="description" id="description">{$info['description']}</textarea></td>
            <td class="inputhelp">将被用来作栏目描述，用英文逗号隔开，留空时将根据内容自动生成</td>
          </tr> 
          <tr>
            <td align="right">前台栏目模板：</td>
            <td align="left">
              <select name="tplist" id="tplist">
               {$choose}
              </select>
            </td>
            <td align="left" class="inputhelp">默认为模板路径下{$md}_index.php<br><a style="color:green" href="{url('set/tpchange')}"> 管理模板>> </a></td>
          </tr> 
          <tr>
            <td align="right">前台每页显示条数：</td>
            <td align="left"><input type="text" name="num" id="num" value="{$info['url']}" size="4"></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">提交后跳转地址：</td>
            <td align="left">
              <input type="text" name="jurl" id="jurl" value="{$info['jurl']}">
            </td>
            <td align="left" class="inputhelp">格式：应用/控制器/方法,键=值/键=值/键=值...，若不填写则跳转上一页</td>
          </tr>
          <tr>
            <td align="right">提交成功信息：</td>
            <td align="left">
              <input type="text" name="mes" id="mes" value="{$info['mes']}">
            </td>
            <td align="left" class="inputhelp"></td>
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
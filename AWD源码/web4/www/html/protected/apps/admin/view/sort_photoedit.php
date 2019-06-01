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
<script type="text/javascript" src="__PUBLIC__/js/jquery.imgareaselect.min.js"></script><!--剪切插件-->
<script language="javascript">
//封面处理
function covershow(){
	$('#covershow').click(function(){
		$("#coverimg").attr("src","{$path}{$info['picture']}?"+(new Date()).getTime());
		$('.arcover').show();
		$(this).unbind("click");
		$(this).html('－编辑封面');
		$(this).attr('id','coverhide');
		coverhide();
	});
}
function coverhide(){
	$('#coverhide').click(function(){
		imgcover.cancelSelection();
		$('.arcover').hide();
		$(this).unbind("click");
		$(this).html('＋编辑封面');
		$(this).attr('id','covershow');
		covershow();
	});
}
function sizschange(width,height){
	imgcover.cancelSelection();
	imgcover=$("#coverimg").imgAreaSelect({ aspectRatio: width+':'+height,onSelectChange: preview,instance: true}); //图片剪切框效果加
}
function preview(img, selection) { //剪切区域改变触发函数
	  $('#x1').val(selection.x1);
	  $('#y1').val(selection.y1);
	  $('#w').val(selection.width);
	  $('#h').val(selection.height);
} 
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
	 //表单验证
	var items_array = [
		{ name:"sortname",simple:"栏目名称",focusMsg:'填写栏目名称'},
		{ name:"tplist",simple:"模板",focusMsg:'模板'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
	//封面图剪切处理
	imgcover = $("#coverimg").imgAreaSelect({ aspectRatio: '{$twidth}:{$theight}',onSelectChange: preview,instance: true}); //图片剪切框效果加载,aspectRatio为选择框长宽
	covershow();
	coverhide();
	$("#resize").click(function(){//设置比例
			var width=$("#thumb_w").val();
			var height=$("#thumb_h").val();
			sizschange(width,height);				
	});
	$("#cut").click(function(){//剪切图片
		var x1 = $('#x1').val(); var y1 = $('#y1').val(); var w = $('#w').val(); var h = $('#h').val();var thumb_w=$('#thumb_w').val(); var name="{$info['picture']}";
		if(x1=="" || y1=="" || w=="" || h==""){
			alert("您必须先选择剪切区域~");
			return false;
		}
		$.post("{url('sort/cutcover')}", { name: name, x1: x1, y1: y1, w: w, h: h,thumb_w: thumb_w,file:'photos'}, 
			   function(data){
				   if(data){
					$("#coverimg").hide();
					$("#coverimg").attr("src","{$path}"+data+"?"+(new Date()).getTime());
					$("#coverimg").show();
					$("#setinfo").hide();
					imgcover.cancelSelection();
					imgcover.setOptions({disable:true});
					$('#cut,.imgareaselect-outer,.imgareaselect-border1,.imgareaselect-border2,.imgareaselect-border3,.imgareaselect-border4,.imgareaselect-handle').remove();
				   }else alert('剪切失败,请检查是否是图片太大超出屏幕,或者是您使用了非主流浏览器~');
			  });
	});
  });
</script>
<title>图集栏目编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【图集栏目编辑】</div>
           <div class="list_head_mr">

           </div>
        </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form  enctype="multipart/form-data" action="{url('sort/photoedit',array('id'=>$id))}"  method="post" id="info">
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
            <td align="right">图集栏目名称：</td>
            <td align="left">
              <input type="text" value="{$info['name']}" name="sortname" id="sortname">
            </td>
            <td align="left" class="inputhelp">请填写要添加分类的名称</td>
          </tr> 
          <tr>
            <td align="right"  width="100">栏目英文名称：</td>
            <td align="left">
              <input type="text" name="ename" id="ename" value="{$info['ename']}">
            </td>
            <td align="left" class="inputhelp">留空则采用栏目ID,用于url路径</td>
          </tr>
          <tr>
            <td align="right">封面图：</td>
            <td align="left">
            <input type="file" name="picture" id="picture" size="10"><input type="hidden" name="oldpicture" value="{$info['picture']}">
            <?php if(!empty($info['picture']) && $info['picture']!='NoPic.gif'){ ?>
                [<a href="#" id="covershow">＋编辑封面</a>]
                <div class="arcover">
                  <div style="clear:both; z-index:10000; margin-bottom:20px" id="setinfo">
                     宽：<input type="text" name="thumb_w" value="{$twidth}" id="thumb_w" size="4"/>px&nbsp;&nbsp;&nbsp;&nbsp;
                     高：<input type="text" name="thumb_h" value="{$theight}" id="thumb_h" size="4"/>px
                     <input type="button" id="resize" class="btn btn-primary btn-small" value="重设">&nbsp;&nbsp;&nbsp;&nbsp;
                     <input type="button" title="剪切" value="" id="cut" />  
                   </div>
                   <div style="clear:both">
                     <img id="coverimg" src="{$path}{$info['picture']}" border="0">
                   </div>  
                </div>
            
               <input type="hidden" name="x1" value="" id="x1" />
	          <input type="hidden" name="y1" value="" id="y1" />
	          <input type="hidden" name="w" value="" id="w" />
	          <input type="hidden" name="h" value="" id="h" />
            <?php } ?>
            </td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">内容缩略图(长X宽)：</td>
            <td align="left"><input type="text" name="picwidth" value="{$info['picwidth']}" size="4"> X <input type="text" value="{$info['picheight']}" name="picheight"  size="4">px</td>
            <td class="inputhelp">用于生成缩略图</td>
          </tr>
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input value="{$info['keywords']}" type="text" name="keywords" id="keywords" size="20"></td>
            <td class="inputhelp">将被用来作为栏目页标题，用英文逗号隔开，留空时将采用"网站基本设置"中的关键字</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="30" rows="3" name="description" id="description">{$info['description']}</textarea></td>
            <td class="inputhelp">将被用来作栏目描述，用英文逗号隔开，留空时将采用"网站基本设置"中的描述</td>
          </tr>
          <tr>
            <td align="right">前台每页显示条数：</td>
            <td align="left"><input type="text" name="num" id="num" value="{$info['url']}" size="4"></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">前台栏目模板：</td>
            <td align="left">
              <select name="tplist" id="tplist">
               {$chooseL}
              </select>
            </td>
            <td align="left" class="inputhelp">默认为模板路径下{$md}_index.php<br><a style="color:green" href="{url('set/tpchange')}"> 管理模板 </a></td>
          </tr> 
          <tr>
            <td align="right">前台默认内容模板：</td>
            <td align="left">
              <select name="cnlist" id="cnlist">
               {$chooseC}
              </select>
            </td>
            <td align="left" class="inputhelp">默认为模板路径下{$md}_content.php<br><a style="color:green" href="{url('set/tpchange')}"> 管理模板</a></td>
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
            <td align="right">字段拓展：</td>
            <td align="left">
              <select name="extendid" id="extendid">
                <option value="0">=不使用字段拓展=</option>
                {$extendoption}
              </select>
            </td>
            <td align="left" class="inputhelp">可以<a style="color:green" href="{url('extendfield/tableadd')}">在这里</a>拓展字段</td>
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

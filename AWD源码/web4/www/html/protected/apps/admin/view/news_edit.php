<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/laydate/laydate.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/farbtastic.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.imgareaselect.min.js"></script><!--剪切插件-->
<script language="javascript">
var imgcover=new Object(); //图片剪切对象
//编辑器
var edcon='';
KindEditor.ready(function(K) {
	edcon=K.create('#content', {
		allowFileManager : true,
		filterMode:false,
		uploadJson : "{url('news/UploadJson',array('sessionid'=>session_id()))}",
		fileManagerJson : "{url('news/FileManagerJson')}"
	});
});
//封面处理
 
$(function ($) { 
 //标题颜色
  $('#picker').farbtastic('#color');
  $('#PickCoShow').click(function(){
	  $('#picker').toggle();
	  if(''==$('#color').val()) $('#color').val("#FFFFFF");
  });
  $('#DelColor').click(function(){
	  $('#picker').hide();
	  $('#color').val('');
	  $('#color').css('background-color','#ffffff');
  });
	//行颜色效果
	$('.all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	});
	 //副栏目
  $('#exs').click(function(){
    var obj=$("#exsort");
    if(obj.css('display')=='none') {
      obj.show();
      $(this).html('－副栏目');
    }else{
        obj.hide();
      $(this).html('＋副栏目');
    }
    });
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
  //图片本地化
  $('#saveimage').click(function(){
	 var now=$(this);
	 now.html('图片下载中...');
	var con=edcon.html();
	$.post("{url('news/saveimage')}", {con:con},
   		  function(data){
			edcon.html(data);
			now.html('图片本地化');
			alert('执行完成~');
   	});
  });
    //封面选项
  $('#ifget').click(function(){
	  if (!!$(this).attr("checked")) {
		  $('#getnum').show();
	  }else {
		  $('#getnum').hide();
	  }
  });
   //表单验证
	var items_array = [
	    { name:"sort",min:6,simple:"类别",focusMsg:'选择类别'},
		{ name:"title",min:2,simple:"标题",focusMsg:'3-30个字符'},
		{ name:"method",simple:"模型/方法",focusMsg:'填写模型/方法'},
		{ name:"tpcontent",simple:"模板",focusMsg:'选择模板'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
	//获取拓展字段
	ajax_fields();
//封面图剪切处理开始
function covershow(){
	$('#covershow').click(function(){
		$("#coverimg").attr("src","{$path}{$info['picture']}?"+(new Date()).getTime());
		$('.arcover').show();
		$(this).unbind("click");
		$(this).html('－封面');
		$(this).attr('id','coverhide');
		coverhide();
	});
}
function coverhide(){
	$('#coverhide').click(function(){
		imgcover.cancelSelection();
		$('.arcover').hide();
		$(this).unbind("click");
		$(this).html('＋封面');
		$(this).attr('id','covershow');
		covershow();
	});
}
	function preview(img, selection) { //剪切区域改变触发函数
	  $('#x1').val(selection.x1);
	  $('#y1').val(selection.y1);
	  $('#w').val(selection.width);
	  $('#h').val(selection.height);
    } 
	function cutfresh(){//刷新剪切大小设置
		var width=$("#thumb_w").val();
		var height=$("#thumb_h").val();
		imgcover.cancelSelection();
		imgcover.setOptions({aspectRatio:!!$("#ifsize").attr("checked")?width+':'+height:0});			
	}
	imgcover = $("#coverimg").imgAreaSelect({ aspectRatio: '{$twidth}:{$theight}',onSelectChange: preview,instance: true,handles:true}); //图片剪切框效果加载,aspectRatio为选择框长宽
	covershow();
	coverhide();
	$("#ifsize").bind("click",cutfresh);
	$("#thumb_w,#thumb_h").bind("blur",cutfresh);
	
	$("#cut").click(function(){//剪切图片
		var x1 = $('#x1').val(); 
		var y1 = $('#y1').val(); 
		var w = $('#w').val(); 
		var h = $('#h').val();
		var thumb_w=$('#thumb_w').val(); 
		var name="{$info['picture']}";
		if(x1=="" || y1=="" || w=="" || h==""){
			alert("您必须先选择剪切区域~");
			return false;
		}
		$.post("{url('news/cutcover')}", { name: name, x1: x1, y1: y1, w: w, h: h,thumb_w: thumb_w}, 
			   function(data){
				   if(data){
					imgcover.cancelSelection();
					imgcover.setOptions({remove:true});
          data=data.replace(/\s/g,'');
					$("#coverbox").html('<img src="{$path}'+data+'?'+(new Date()).getTime()+'" border="0">');
					$("#setinfo").hide();
				   }else alert('剪切失败,请检查是否是图片太大超出屏幕,或者是您使用了非主流浏览器~');
			  });
	});
  });
//封面图剪切处理结束
function ajax_fields()
 {
	var sid = $('#sort').val();
	var extfield = $('#extfield').val();//拓展表id
	var sid = sid.substring(sid.lastIndexOf(',')+1);
	$.ajax({
		type: 'POST',
		url: "{url('news/ex_field')}",
		data: {
			sid: sid,
			extfield:extfield
		},
		dataType: "json",
		success: function(data) {
			$('#extend').html('');
			if(typeof(data[0].tableinfo)!='undefined'){
			for (var i in data) {
				var list_html = '<tr>';
				list_html += '<td width="100"  align="right" valign="middle">' + data[i].name + ':</td>';
				list_html += '<td>';
				if (data[i].type == 1) {
					list_html += '<input name="ext_' + data[i].tableinfo + '" type="text"  value="' + data[i].defvalue + '" />';
				}
				if (data[i].type == 2) {
					list_html += '<textarea name="ext_' + data[i].tableinfo + '"  cols="0"  style="width:300px !important; height:80px">' + data[i].defvalue + '</textarea>';
				}
				if (data[i].type == 3) {
					list_html += '<textarea class="excontent" name="ext_' + data[i].tableinfo + '"  cols="0"  style="width:100%;height:300px;visibility:hidden;">' + data[i].defvalue + '</textarea>';
				}
				if (data[i].type == 4) {
					list_html += '<select name="ext_' + data[i].tableinfo + '"  >';
					ary = data[i].defvalue.split("\r\n");
					var choose_value=data[i].choosevalue;//选中值
					for (var x in ary) {
						strary = ary[x].split(",");
						if(choose_value==strary[0]) var checked="selected='selected'";
						else var checked="";
						list_html += '<option '+checked+' value="' + strary[0] + '">' + strary[1] + '</option>';
					}
					list_html += '</select>';
				}
				if (data[i].type == 5) {
					list_html += '<input name="ext_' + data[i].tableinfo + '" id="ext_' + data[i].tableinfo + '" type="text"  value="' + data[i].defvalue + '" /><br>';
					list_html += '<iframe scrolling="no" frameborder="0" src="{url("extendfield/file")}/&inputName=ext_' + data[i].tableinfo + '" style="width:300px; height:35px;"></iframe>';
				}
				if(data[i].type == 6){
					var ary = data[i].defvalue.split("\r\n");
					var choose_value=data[i].choosevalue;//选中值
					for (var x in ary) {
						var strary = ary[x].split(",");
						var valuearr = choose_value.split(",");
						for (var y in valuearr) {
						    if(valuearr[y]==strary[0]){ var checked="checked";}
						}
						list_html += strary[1] + '<input '+checked+' type="checkbox" name="ext_' + data[i].tableinfo + '[]" value="' + strary[0] + '" />';
						var checked="";
					}
				}
				list_html += '<input type="hidden" name="tableid" value="' + data[i].pid + '">';
				list_html += '</td><td></td>';
				list_html += '</tr>';
				$('#extend').append(list_html);
			}
			KindEditor.create('.excontent', {
              allowFileManager : true,
              filterMode:false,
              uploadJson : "{url('news/UploadJson')}",
              fileManagerJson : "{url('news/FileManagerJson')}"
           });
			}
		}
	});
}
function tpchange()
{
   var tpc={$tpc};
   var paths = $('#sort').val();
   if(''!=tpc[paths]){
        $("#tpcontent").val(tpc[paths]);
   }
}
</script>
<title>资讯信息编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：资讯编辑</div>
        </div>

        <form enctype="multipart/form-data" action="{url('news/edit',array('id' => $info['id']))}" method="post" id="info" >
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   >
          <tr>
            <td align="right" width="100">选择类别：</td>
            <td align="left">
               <select name="sort" id="sort" onChange="ajax_fields();tpchange();">
                  <option selected="selected" value="">=请选择类别=</option>
                  {$option}
               </select>&nbsp; &nbsp; &nbsp;[<a href="javascript:void(0);" id="exs">＋副栏目</a>]
               <input type="hidden" id="oldsort" value="{$info['sort']}" name="oldsort">
            </td>
            <td class="inputhelp"></td>
          </tr> 
           <tr id="exsort"  style="display:none">
            <td align="right" width="100">副栏目：</td>
            <td align="left"><p>
                    <?php 
                      if(!empty($sortlist)){
                      foreach($sortlist as $vo){
						  $ifable=$vo['type']==$type?'':'disabled';
                          $space = str_repeat('├┈┈┈', $vo['deep']-1);  
						  $exsort.= $vo['deep']==1?'</p><p class="exsort">'.$space.'<input type="checkbox" '.$ifable.' name="exsort[]" '.$vo["checked"].'  value="'.$vo['id'].'">'.$vo['name'].'&nbsp;<a class="fold" onclick="return false;"></a></p><p style="display:none">':$space.'<input type="checkbox" '.$ifable.' name="exsort[]" '.$vo["checked"].'  value="'.$vo['id'].'">'.$vo['name'].'<br>';
                      }
                        echo $exsort;
                     }
                  ?>
            </td>
            <td align="left" class="inputhelp"></td>
          </tr>
          <?php if(!empty($places)) { ?>
          <tr>
            <td align="right">内容定位：</td>
            <td align="left">
        <?php
			  foreach ($places as $vo) {
				if(!empty($info['places'])){
				    if(in_array($vo['id'],explode(',',$info['places']))) $check='checked';
					  else $check='';
				}
				echo '<input '.$check.' type="checkbox" name="places[]" value="'.$vo['id'].'">'.$vo['name'].'&nbsp;&nbsp;';
			  }
			 ?>
            </td>
            <td class="inputhelp"></td>
          </tr>
          <?php } ?>
          <tr>
            <td align="right">标题：</td>
            <td align="left">     
               <div>
               <input type="text" name="title" id="title" value="{$info['title']}" maxlength="60" size="30" >
               <a href="javascript:" title="点击选择颜色" id="PickCoShow"><img src="__PUBLICAPP__/images/pick.gif" width="11" height="11" border="0" /></a>
               <input value="{$info['color']}" type="text" name="color" id="color" size="9">
               <a href="javascript:" title="点击清除颜色" id="DelColor"><img src="__PUBLICAPP__/images/del.gif" width="16" height="16" border="0" /></a>
              </div>
               <div id="picker"></div> 
            </td>
            <td class="inputhelp">可选择前台显示的标题字体颜色</td>
          </tr>
            <tr>
            <td align="right">状态：</td>
            <td align="left">
                <input type="checkbox" name="ispass" value="1" <?php echo ($info['ispass']==1)?'checked':''; ?>> 审核
                <input type="checkbox" name="recmd" value="1" <?php echo ($info['recmd']==1)?'checked':''; ?> >推荐
            </td>
            <td class="inputhelp"></td>
          </tr> 
          <tr>
            <td align="right">封面图：</td>
            <td align="left">
           <?php if(empty($info['picture']) || $info['picture']=='NoPic.gif'){ ?>
            <input type="text" name="picurl" size="20" value="">
            <input type="file" name="picture" id="picture" size="10">
            &nbsp;&nbsp;
               <input type="checkbox" name="ifget" id="ifget" value="1" >是否从内容获取
               <span id="getnum" style="display:none">第<input type="text" name="getnum" value="1" size="2">张图片</span>
            <?php }else{ 
			   if(Check::url($info['picture'])){ ?>
               <input type="text" name="picurl" size="20" value="{$info['picture']}">
               <input type="file" name="picture" id="picture" size="10">
               &nbsp;&nbsp;
               <input type="checkbox" name="ifget" id="ifget" value="1" >是否从内容获取
               <span id="getnum" style="display:none">第<input type="text" name="getnum" value="1" size="2">张图片</span>
                &nbsp;&nbsp;
                <a href="javascript:void(0);" id="covershow">＋封面</a>
               <div class="arcover">
                  <img  src="{$info['picture']}" border="0"> 
               </div>
               <?php }else{ ?>
               <input type="text" name="picurl" size="20" value="">
               <input type="file" name="picture" id="picture" size="10"><input type="hidden" name="oldpicture" value="{$info['picture']}">
               &nbsp;&nbsp;
               <input type="checkbox" name="ifget" id="ifget" value="1" >是否从内容获取
               <span id="getnum" style="display:none">第<input type="text" name="getnum" value="1" size="2">张图片</span>
                &nbsp;&nbsp;
                <a href="javascript:void(0);" id="covershow">＋封面</a>
                <div class="arcover">
                  <div style="clear:both; z-index:10000; margin-bottom:20px" id="setinfo">
                  <input name="ifsize" id="ifsize" type="checkbox" value="" checked>按照宽 X 高：<input type="text" name="thumb_w" value="{$twidth}" id="thumb_w" size="4"/>&nbsp;X&nbsp;
                     <input type="text" name="thumb_h" value="{$theight}" id="thumb_h" size="4"/>px
                     <input type="button" title="剪切" value="" id="cut" />  
                   </div>
                   <div style="clear:both" id="coverbox">
                     <img id="coverimg" src="{$path}{$info['picture']}" border="0">  
                   </div>  
                </div>
            
               <input type="hidden" name="x1" value="" id="x1" />
	          <input type="hidden" name="y1" value="" id="y1" />
	          <input type="hidden" name="w" value="" id="w" />
	          <input type="hidden" name="h" value="" id="h" />
            <?php } }?>

            </td>
            <td class="inputhelp">本地选择图片或者填写图片url地址<br>在列表页删除封面图</td>
          </tr> 
          <tr>
            <td align="right">新闻来源：</td>
            <td align="left"><input type="text" value="{$info['origin']}" name="origin" id="origin" size="20"></td>
            <td class="inputhelp">若是转载内容，请在此注明，以避免知识产权纠纷</td>
          </tr>  
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input type="text" value="{$info['keywords']}" name="keywords" id="keywords" size="40"><input name="iftag" type="checkbox" value="1">生成TAG标签</td>
            <td class="inputhelp">将被用来作为keywords标签，用英文逗号隔开，留空时将根据标题和SEO描述自动生成</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="70" rows="5" name="description" id="description">{$info['description']}</textarea></td>
            <td class="inputhelp">将被用来作description标签，用英文逗号隔开，留空时将根据内容自动生成</td>
          </tr>
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:450px;visibility:hidden;">{$info['content']}</textarea><br><div id="saveimage" class="btn">图片本地化</div> <input type="checkbox" name="iflink" value="1">替换Tag链接</td>
          </tr>
          <tr>
            <td align="right">前台模型/方法：</td>
            <td align="left"><input type="text" value="{$info['method']}" name="method" id="method" size="20"></td>
            <td class="inputhelp">默认为news模型中content方法,如果是外链则直接填写网址</td>
          </tr>
          <tr>
            <td align="right">前台显示模板：</td>
            <td align="left">
            <select name="tpcontent" id="tpcontent">
               {$choose}
              </select>
            </td>
            <td class="inputhelp">默认为模板路径下news_content.php<br><a style="color:green" href="{url('set/tpchange')}"> 管理模板>> </a></td>
          </tr> 
          <tbody id="extend"></tbody>
          <tr>
            <td align="right">排序：</td>
            <td align="left"><input name="norder" id="norder" type="text" value="{$info['norder']}" size="4"/></td>
            <td class="inputhelp">排序值越大越靠前(不指定将按最新发表排序)</td>
          </tr> 
          <tr>
            <td align="right">点击：</td>
            <td align="left"><input name="hits" type="text" value="{$info['hits']}" size="6"/></td>
            <td class="inputhelp">不建议修改</td>
          </tr> 
          <tr>
            <td align="right">发表时间：</td>
            <td align="left"><input name="addtime" id="addtime" type="text" value="{$info['addtime']}" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"/></td>
            <td class="inputhelp">不建议修改</td>
          </tr> 
          <tr>
            <td align="right">资讯关联：</td>
            <td align="left"><input name="releids" id="releids" type="text" value="{$info['releids']}" size="30" /></td>
            <td class="inputhelp">用于内页调用其他关联（推荐）信息。格式:资讯ID1,资讯ID2,资讯ID3....</td>
          </tr> 
          <tr>
            <td><input type="hidden" id="extfield" value="{$info['extfield']}" name="extfield"></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="编辑">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>
</form>
</div>
</body>
</html>
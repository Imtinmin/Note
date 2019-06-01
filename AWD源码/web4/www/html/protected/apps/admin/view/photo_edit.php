<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script src="__PUBLIC__/laydate/laydate.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/farbtastic.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify-3.1.min.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">
KindEditor.ready(function(K) {
	edcon=K.create('#content', {
		allowFileManager : true,
		filterMode:false,
		uploadJson : "{url('photo/UploadJson',array('sessionid'=>session_id()))}",
		fileManagerJson : "{url('photo/FileManagerJson')}"
	});
});
//封面图效果
hs.graphicsDir = "__PUBLIC__/images/graphics/";
hs.showCredits = false;
hs.outlineType = 'rounded-white';
hs.restoreTitle = '关闭';

function addcover(){//提取封面图事件绑定
	 $(".photo").click(function(){
		var tag=$(this).attr('id');
		$("#picture").val(tag);
		$("#cover").attr('href','{$picpath}'+tag);
	 });
}
function picdel(){//单图删除
	$('.picdel').click(function(){
		var picname=$(this).prev().val();
		var tag=$(this).parent().parent();
		$.post("{url('photo/delpic')}", { picname: picname },
				function(data){
                 alert(data);
				tag.remove();
			});
	});
}
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
  //图片手动改变
  $('#picture').blur(function(){
     $('#cover').attr('href',$(this).val());
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
	//图片批量上传
     function getval(domid,ifcheck){
		if(ifcheck){
			if($("#"+domid).attr("checked")) return $("#"+domid).val();
		}else{
			return $("#"+domid).val();
		}
		return false;
    }
	 $('#file_upload').uploadify({
			'auto'     : false,
      'buttonImage' : '__PUBLIC__/uploadify/downbut.jpg',
            'swf'      : '__PUBLIC__/uploadify/uploadify.swf',
            'uploader' : "{url('photo/images_upload',array('sessionid'=>session_id()))}",
          'onUploadStart': function (file) {
             $("#file_upload").uploadify("settings", "formData", {'ifthumb':getval('ifthumb',true),'ttype':getval('thumbtype',false),width:getval('thumbwidth',false),height:getval('thumbheight',false)});  
           },
			'onUploadSuccess' : function(file, data, response) {
                  // alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				  if(data){
			      var pstr=$("#imginfo").html();
				  var ifthumb=getval('ifthumb',true)?"thumb_":"";
		          var itml = pstr + '<div class="photolist"><div class="pcon"><img width="{$twidth}" height="{$theight}" class="photo" id="'+data+'" src="{$picpath}'+ifthumb+data+'" title="点击设置为封面"></div><div class="pinfo"><input style="width:{$twidth}px" type="text" name="conlist[]"><input type="hidden" name="photolist[]" value="'+data+'"><a href="javascript:void(0);" class="picdel"></a></div></div>';
		          $("#imginfo").html(itml);
		          addcover();
		           picdel();
				  }
             }
        });
   //表单验证
	var items_array = [
	    { name:"sort",min:6,simple:"类别",focusMsg:'选择类别'},
		{ name:"title",min:3,simple:"标题",focusMsg:'3-30个字符'},
		{ name:"method",simple:"模型/方法",focusMsg:'填写模型/方法'},
		{ name:"tpcontent",simple:"模板",focusMsg:'选择模板'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
    addcover();
    picdel();
	//获取拓展字段
	ajax_fields();
  });

function ajax_fields()
 {
	var sid = $('#sort').val();
	var extfield = $('#extfield').val();//拓展表id
	var sid = sid.substring(sid.lastIndexOf(',')+1);
	$.ajax({
		type: 'POST',
		url: "{url('photo/ex_field')}",
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
              uploadJson : "{url('photo/UploadJson')}",
              fileManagerJson : "{url('photo/FileManagerJson')}"
         });
			}
		}
	});
}
function tpchange()
{
   var tpc={$tpc};
   var paths = $('#sort').val();
   if(!!tpc[paths]){
        $("#tpcontent").val(tpc[paths]['n']);
		if(tpc[paths]['w']!=0) $("#thumbwidth").val(tpc[paths]['w']);
		if(tpc[paths]['h']!=0) $("#thumbheight").val(tpc[paths]['h']);
   }
}
</script>
<title>图集编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">图集编辑</div>
        </div>

        <form  action="{url('photo/edit',array('id'=>$info['id']))}" method="post" id="info" onSubmit="return check_form(document.add);">
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   >
          <tr>
            <td align="right" width="10%">选择类别：</td>
            <td align="left" width="70%">
               <select name="sort" id="sort" onChange="ajax_fields();tpchange();">
                  <option selected="selected" value="">=请选择类别=</option>
                  {$option}
               </select>&nbsp; &nbsp; &nbsp;[<a href="#" id="exs">＋副栏目</a>]
                <input type="hidden" id="oldsort" value="{$info['sort']}" name="oldsort">
            </td>
            <td class="inputhelp" width="20%"></td>
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
               审核 <input type="checkbox" name="ispass" value="1" <?php echo ($info['ispass']==1)?'checked':''; ?>> 
               推荐 <input type="checkbox" name="recmd" value="1" <?php echo ($info['recmd']==1)?'checked':''; ?> >
            </td>
            <td class="inputhelp"></td>
          </tr> 
          <tr>
            <td align="right">封面图：</td>
            <td align="left"><input type="text" value="{$info['picture']}" name="picture" id="picture" size="20" ><a id="cover" href="<?php if(!empty($info['picture'])) echo Check::url($info['picture'])?$info['picture']:$picpath.$info['picture']; ?>" onClick="return hs.expand(this)">查看封面图</a></td>
            <td class="inputhelp">若需设置请点击“上传图片管理”栏中图片,或者直接填写url地址</td>
          </tr>  
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input type="text" value="{$info['keywords']}" name="keywords" id="keywords" size="40"><input name="iftag" type="checkbox" value="1">生成TAG标签</td>
            <td class="inputhelp">将被用来作为keywords标签，用英文逗号隔开，留空时将根据标题和SEO描述自动生成</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="40" rows="5" name="description" id="description">{$info['description']}</textarea></td>
            <td class="inputhelp">将被用来作description标签，用英文逗号隔开，留空时将根据内容自动生成</td>
          </tr>
          <tr>
            <td align="right">图片上传：</td>
            <td width="50%">     
               <div style="float:left; width:40%"><input type="file" name="file_upload" id="file_upload" /></div>
               <div style="float:left; width:10%"><a id="up_img" class="btn" href="javaScript:$('#file_upload').uploadify('upload','*');">上传</a></div>
               <div style="float:left; width:50%; ">
               是否缩略图：<input type="checkbox" name="ifthumb" id="ifthumb" value="1" checked>
                   <select name="thumbtype" id="thumbtype">
                        <option value='1' selected>中心剪切</option>
                        <option value='2' >左上剪切</option>
                        <option value='3' >右上剪切</option>
                        <option value='4' >左下剪切</option>
                        <option value='5' >右下剪切</option>
                        <option value='6'>等比缩小</option>
                    </select>
                宽：<input type="text" name="width" id="thumbwidth" size="3" value="{$twidth}">
                高：<input type="text" name="height" id="thumbheight" size="3" value="{$theight}">
               </div>
            </td>
            <td class="inputhelp">支持批量上传图片,浏览器需要安装flash插件,且不支持FireFox浏览器<br><a href="{url('set/index')}">设置缩略图默认长宽</a></td>
         </tr>
          <tr>
             <td align="right">上传图片管理：</td>
             <td id="imginfo" colspan="2">
             <?php 
               if(!empty($info['photolist'])){
                 $photoarr=explode(',',$info['photolist']);
                 $exparr=explode(',',$info['conlist']);
                 $i=0;
                 foreach($photoarr as $vo){
                     $list.='<div class="photolist">';
                     $list.='<div class="pcon"><img width="'.$twidth.'" height="'.$theight.'" class="photo" id="'.$vo.'" title="点击设置为封面" src="'.$picpath.$vo.'"></div>';
                     $list.='<div class="pinfo"><input style="width:'.$twidth.'px" type="text" value="'.$exparr[$i].'" name="conlist[]"><input type="hidden" name="photolist[]" value="'.$vo.'"><a href="javascript:void(0);" class="picdel"></a></div>';
                     $list.='</div>';
                     $i++;
                 }          
                 echo $list;
               }
             ?>
             </td>
          </tr>
          <tr>
            <td align="right">图集说明：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:400px;visibility:hidden;">{$info['content']}</textarea><br><input type="checkbox" name="iflink" value="1">替换Tag链接</td>
          </tr>
          <tr>
            <td align="right">前台模型/方法：</td>
            <td align="left"><input type="text" value="{$info['method']}" name="method" id="method" size="20"></td>
            <td class="inputhelp">默认为photo模型中content方法,如果是外链则直接填写网址</td>
          </tr>
          <tr>
            <td align="right">前台显示模板：</td>
            <td align="left">
            <select name="tpcontent" id="tpcontent">
               {$choose}
              </select>
              </td>
            <td class="inputhelp">默认为模板路径下photo_content.php<br><a style="color:green" href="{url('set/tpchange')}"> 管理模板>> </a></td>
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
            <td align="right">图集关联：</td>
            <td align="left"><input name="releids" id="releids" type="text" value="{$info['releids']}" size="30" /></td>
            <td class="inputhelp">用于内页调用其他关联（推荐）信息。格式:图集ID1,图集ID2,图集ID3....</td>
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
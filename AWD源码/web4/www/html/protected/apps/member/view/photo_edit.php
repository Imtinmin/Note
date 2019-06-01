<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/highslide.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" />
<script type="text/javascript" src="__PUBLIC__/js/highslide.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify-3.1.min.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">

KindEditor.ready(function(K) {
	K.create('#content', {
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		items : [
				'source', '|','fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright','lineheight', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image','pagebreak','link','clearhtml']

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
		$("#cover").attr('href','{$picpath}thumb_'+tag);
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
            'uploader' : "{url('photo/images_upload',array('phpsessid'=>session_id()))}",
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
		{ name:"title",min:1,simple:"标题",focusMsg:'1-30个字符'},
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
					list_html += '<iframe scrolling="no"; frameborder="0" src="{url("extendfield/file")}/&inputName=ext_' + data[i].tableinfo + '" style="width:300px; height:35px;"></iframe>';
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
   if(''!=tpc[paths]){
        $("#tpcontent").val(tpc[paths]);
   }
}
</script>
<div id="contain">
<ul class="breadcrumb">
   <li> <span>信息列表</span><span class="divider">/</span><span>图集投稿</span></li>
</ul>
        <form  action="{url('photo/edit',array('id'=>$info['id']))}" method="post" id="info" onSubmit="return check_form(document.add);">
         <table class="table table-bordered">
          <tr>
            <td align="right" width="10%">选择栏目：</td>
            <td align="left" width="70%">
               <select name="sort" id="sort" onChange="ajax_fields();tpchange();">
                  <option selected="selected" value="">=请选择类别=</option>
                  {$option}
               </select>&nbsp; &nbsp; &nbsp;<a href="#" id="exs">＋副栏目</a>
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
         
          <tr>
            <td align="right">标题：</td>
            <td align="left"><input type="text" name="title" id="title" value="{$info['title']}" maxlength="60" size="30" ></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">封面图：</td>
            <td align="left"><input type="text" readonly="readonly" value="{$info['picture']}" name="picture" id="picture" size="20" ><a id="cover" href="<?php echo $info['picture']?$picpath.'thumb_'.$info['picture']:''; ?>" onClick="return hs.expand(this)">查看封面图</a></td>
            <td class="inputhelp">若需设置请点击“上传图片管理”栏中图片</td>
          </tr>  
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input type="text" value="{$info['keywords']}" name="keywords" id="keywords" size="40"></td>
            <td class="inputhelp">将被用来作为keywords标签，用英文逗号隔开</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="40" rows="5" name="description" id="description">{$info['description']}</textarea></td>
            <td class="inputhelp">将被用来作description标签，用英文逗号隔开</td>
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
                宽：<input type="text" name="width" id="thumbwidth" size="3" value="{config('thumbMaxwidth')}">
                高：<input type="text" name="height" id="thumbheight" size="3" value="{config('thumbMaxheight')}">
               </div>
            </td>
            <td class="inputhelp">支持批量上传图片</td>
         </tr>
          <tr>
             <td align="right">图片管理：</td>
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
            <td align="left"><textarea name="content" id="content" style=" width:100%;height:300px;visibility:hidden;">{$info['content']}</textarea></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">显示模板：</td>
            <td align="left"><input type="text" value="{$info['tpcontent']}" name="tpcontent" id="tpcontent" readonly="readonly"></td>
            <td class="inputhelp"></td>
          </tr> 
          <tbody id="extend"></tbody>
          <tr>
            <td><input type="hidden" id="extfield" value="{$info['extfield']}" name="extfield"></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="编辑">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>
</form>
</div>
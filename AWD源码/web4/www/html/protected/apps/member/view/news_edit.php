<?php if(!defined('APP_NAME')) exit;?>
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
		filterMode:true
	});
});
//封面处理
function covershow(){
	$('#covershow').click(function(){
		$('.arcover').show();
		$(this).unbind("click");
		$(this).html('－隐藏封面');
		$(this).attr('id','coverhide');
		coverhide();
	});
}
function coverhide(){
	$('#coverhide').click(function(){
		$('.arcover').hide();
		$(this).unbind("click");
		$(this).html('＋查看封面');
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
  covershow();
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
  });

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
<div id="contain">
<ul class="breadcrumb">
   <li> <span>信息列表</span><span class="divider">/</span><span>资讯编辑</span></li>
</ul>

        <form enctype="multipart/form-data" action="{url('news/edit',array('id' => $info['id']))}" method="post" id="info" >
         <table class="table table-bordered">
          <tr>
            <td align="right" width="100">选择栏目：</td>
            <td align="left">
               <select name="sort" id="sort" onChange="ajax_fields();tpchange();">
                  <option selected="selected" value="">=请选择类别=</option>
                  {$option}
               </select>&nbsp; &nbsp; &nbsp;<a href="#" id="exs">＋副栏目</a>
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
          <tr>
            <td align="right">标题：</td>
            <td align="left">     
                <input type="text" name="title" id="title" value="{$info['title']}" maxlength="60" size="30" >
            </td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">封面图：</td>
            <td align="left">
            <input type="file" name="picture" id="picture" size="10"><input type="hidden" name="oldpicture" value="{$info['picture']}">
            <?php if(!empty($info['picture']) && $info['picture']!='NoPic.gif'){ ?>
                <a href="#" id="covershow">＋查看封面</a>
                <div class="arcover" style="display:none">
                  <img id="coverimg" src="{$path}{$info['picture']}" border="0">
                </div>
            <?php } ?>
            </td>
            <td class="inputhelp"></td>
          </tr> 
          <tr>
            <td align="right">新闻来源：</td>
            <td align="left"><input type="text" value="{$info['origin']}" name="origin" id="origin" size="20"></td>
            <td class="inputhelp">若是转载内容，请在此注明，以避免知识产权纠纷</td>
          </tr>  
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input type="text" value="{$info['keywords']}" name="keywords" id="keywords" size="40"></td>
            <td class="inputhelp">将被用来作为keywords标签，用英文逗号隔开</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="70" rows="5" name="description" id="description">{$info['description']}</textarea></td>
            <td class="inputhelp">将被用来作description标签，用英文逗号隔开</td>
          </tr>
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:450px;visibility:hidden;">{$info['content']}</textarea></td>
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
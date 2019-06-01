<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/kindeditor/kindeditor.js"></script>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script language="javascript">
var edcon='';
KindEditor.ready(function(K) {
	edcon=K.create('#content', {
		allowFileManager : true,
		filterMode:true
	});
});

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
		{ name:"tpcontent",simple:"模板",focusMsg:'选择模板'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
  });
  
function ajax_fields()
 {
	var sid = $('#sort').val();
	var sid = sid.substring(sid.lastIndexOf(',')+1);
	$.ajax({
		type: 'POST',
		url: "{url('news/ex_field')}",
		data: {
			sid: sid
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
					list_html += '<input name="ext_' + data[i].tableinfo + '" type="text" value="' + data[i].defvalue + '" />';
				}
				if (data[i].type == 2) {
					list_html += '<textarea name="ext_' + data[i].tableinfo + '"  cols="0" style="width:300px !important; height:80px">' + data[i].defvalue + '</textarea>';
				}
				if (data[i].type == 3) {
					list_html += '<textarea  class="excontent" name="ext_' + data[i].tableinfo + '"  cols="0" style="width:100%;height:450px;visibility:hidden;">' + data[i].defvalue + '</textarea>';
				}
				if (data[i].type == 4) {
					list_html += '<select name="ext_' + data[i].tableinfo + '"  >';
					default_ary = data[i].defvalue;
					ary = default_ary.split("\n");
					for (var x in ary) {
						strary = ary[x].split(",");
						list_html += '<option value="' + strary[0] + '">' + strary[1] + '</option>';
					}
					list_html += '</select>';
				}
				if (data[i].type == 5) {
					list_html += '<input name="ext_' + data[i].tableinfo + '" id="ext_' + data[i].tableinfo + '" type="text" value="' + data[i].defvalue + '" /><br>';
					list_html += '<iframe scrolling="no"; frameborder="0" src="{url("extendfield/file")}/&inputName=ext_' + data[i].tableinfo + '" style="width:300px; height:35px;"></iframe>';
				}
				if (data[i].type == 6) {
					default_ary = data[i].defvalue;
					ary = default_ary.split("\r\n");
					for (var x in ary) {
						strary = ary[x].split(",");
						list_html += '<option value="' + strary[0] + '">' + strary[1] + '</option>';
						list_html += strary[1] + '<input type="checkbox" name="ext_' + data[i].tableinfo + '[]" value="' + strary[0] + '" />';
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
   <li> <span>信息列表</span><span class="divider">/</span><span>资讯投稿</span></li>
</ul>
        <form enctype="multipart/form-data" action="{url('news/add')}" method="post" id="info" name="info">
         <table class="table table-bordered">
          <tr>
            <td align="right" width="100">选择栏目：</td>
            <td align="left">
               <select name="sort" id="sort" onChange="ajax_fields();tpchange();">
                  <option selected="selected" value="">=请选择栏目=</option>
                  {$option}
               </select>&nbsp; &nbsp; &nbsp;<a href="#" id="exs">＋副栏目</a>
             </td>
            <td class="inputhelp"></td>
          </tr> 
          <tr id="exsort"  style="display:none">
            <td align="right" width="100">副栏目：</td>
            <td align="left">
             <p>
                 <?php 
                      if(!empty($sortlist)){
                      foreach($sortlist as $vo){
						  $ifable=$vo['type']==$type?'':'disabled';
                          $space = str_repeat('├┈┈┈', $vo['deep']-1);  
                          $exsort.= $vo['deep']==1?'</p><p class="exsort">'.$space.'<input type="checkbox" '.$ifable.' name="exsort[]" value="'.$vo['id'].'">'.$vo['name'].'&nbsp;<a class="fold" href="#" onclick="return false;"></a></p><p style="display:none">':$space.'<input type="checkbox" '.$ifable.' name="exsort[]" value="'.$vo['id'].'">'.$vo['name'].'<br>';
                      }
                        echo $exsort;
                     }
                  ?>
            </td>
            <td align="left" class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">标题：</td>
            <td align="left"><input type="text" name="title" id="title" maxlength="60" size="30" ></td>
            <td class="inputhelp"></td>
          </tr>
          <tr>
            <td align="right">封面图：</td>
            <td align="left">
               <input type="file" name="picture" id="picture" size="10">
            </td>
            <td class="inputhelp"></td>
          </tr> 
          <tr>
            <td align="right">新闻来源：</td>
            <td align="left"><input type="text" name="origin" id="origin" size="20"></td>
            <td class="inputhelp">若是转载内容，请在此注明，以避免知识产权纠纷</td>
          </tr>  
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input type="text" name="keywords" id="keywords" size="40"></td>
            <td class="inputhelp">将被用来作为keywords标签，用英文逗号隔开</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="70" rows="5" name="description" id="description"></textarea></td>
            <td class="inputhelp">将被用来作description标签，用英文逗号隔开</td>
          </tr>
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:450px;visibility:hidden;"></textarea></div></td>
          </tr>
          <tr>
            <td align="right">显示模板：</td>
            <td align="left"><input type="text" value="" name="tpcontent" id="tpcontent" readonly="readonly"></td>
            <td class="inputhelp"></td>
          </tr> 
           <tbody id="extend"></tbody>
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="添加">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>

</form>
</div>
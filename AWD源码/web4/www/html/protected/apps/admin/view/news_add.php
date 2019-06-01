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
<script language="javascript">
var edcon='';
KindEditor.ready(function(K) {
	edcon=K.create('#content', {
		allowFileManager : true,
		filterMode:false,
		uploadJson : "{url('news/UploadJson',array('sessionid'=>session_id()))}",
		fileManagerJson : "{url('news/FileManagerJson')}"
	});
});

  $(function ($) { 
    ajax_fields();
    tpchange();
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
  });
function ajax_fields()
 {
	var sid = $('#sort').val();
	if(sid.length!=0){
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
					list_html += '<iframe scrolling="no" frameborder="0" src="{url("extendfield/file")}/&inputName=ext_' + data[i].tableinfo + '" style="width:300px; height:35px;"></iframe>';
				}
				if (data[i].type == 6) {
					default_ary = data[i].defvalue;
					ary = default_ary.split("\r\n");
					for (var x in ary) {
						strary = ary[x].split(",");
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
<title>文章添加</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【资讯发布】</div>
        </div>
        <form enctype="multipart/form-data" action="{url('news/add')}" method="post" id="info" name="info">
         <table class="all_cont" width="100%" border="0" cellpadding="5" cellspacing="1"   >
          <tr>
            <td align="right" width="100">选择栏目：</td>
            <td align="left">
               <select name="sort" id="sort" onChange="ajax_fields();tpchange();">
                  <option selected="selected" value="">=请选择栏目=</option>
                  {$option}
               </select>&nbsp; &nbsp; &nbsp;[<a href="#" id="exs">＋副栏目</a>]
             </td>
            <td class="inputhelp"><a href="{url('sort/add')}">点击添加栏目</a></td>
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
          <?php if(!empty($places)) { ?>
          <tr>
            <td align="right">内容定位：</td>
            <td align="left">
            <?php
			        foreach ($places as $vo) {
				         echo '<input type="checkbox" name="places[]" value="'.$vo['id'].'">'.$vo['name'].'&nbsp;&nbsp;';
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
               <input type="text" name="title" id="title" maxlength="60" size="30" >
               <a href="javascript:" title="点击选择颜色" id="PickCoShow"><img src="__PUBLICAPP__/images/pick.gif" width="11" height="11" border="0" /></a>
               <input value="" type="text" name="color" id="color" size="9">
               <a href="javascript:" title="点击清除颜色" id="DelColor"><img src="__PUBLICAPP__/images/del.gif" width="16" height="16" border="0" /></a>
              </div>
               <div id="picker"></div> 
              
            </td>
            <td class="inputhelp">可选择前台显示的标题字体颜色</td>
          </tr>
          <tr>
            <td align="right">状态：</td>
            <td align="left">
                <input type="checkbox" name="ispass" value="1" checked>审核
                <input type="checkbox" name="recmd" value="1" >推荐
            </td>
            <td class="inputhelp"></td>
          </tr> 
          <tr>
            <td align="right">封面图：</td>
            <td align="left">
               <input type="text" name="picurl" size="20"> <input type="file" name="picture" id="picture" size="10">&nbsp;&nbsp;
               <input type="checkbox" name="ifget" id="ifget" value="1" checked>是否从内容获取
               <span id="getnum" style="display:none">第<input type="text" name="getnum" value="1" size="2">张图片</span>
               
            </td>
            <td class="inputhelp">本地选择图片或者填写图片url地址<br>在列表页删除封面图</td>
          </tr> 
          <tr>
            <td align="right">新闻来源：</td>
            <td align="left"><input type="text" name="origin" id="origin" size="20"></td>
            <td class="inputhelp">若是转载内容，请在此注明，以避免知识产权纠纷</td>
          </tr>  
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input type="text" name="keywords" id="keywords" size="40"> <input name="iftag" type="checkbox" value="1">生成TAG标签</td>
            <td class="inputhelp">将被用来作为keywords标签，用英文逗号隔开，留空时将根据标题和SEO描述自动生成</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="70" rows="5" name="description" id="description"></textarea></td>
            <td class="inputhelp">将被用来作description标签，用英文逗号隔开，留空时将根据内容自动生成</td>
          </tr>
          <tr>
            <td align="right">内容：</td>
            <td align="left" colspan="2"><textarea name="content" id="content" style=" width:100%;height:450px;visibility:hidden;"></textarea><br><div id="saveimage" class="btn">图片本地化</div> <input type="checkbox" name="iflink" value="1">替换Tag链接</td>
          </tr>
          <tr>
            <td align="right">前台模型/方法：</td>
            <td align="left"><input type="text" value="default/column/content" name="method" id="method" size="20"></td>
            <td class="inputhelp">默认为news模型中content方法,如果是外链则直接填写网址</td>
          </tr>
          <tr>
            <td align="right">前台显示模板：</td>
            <td align="left">
             <select name="tpcontent" id="tpcontent">
               {$choose}
              </select>
             </td>
            <td class="inputhelp">默认为模板路径下news_content.php<br><a style="color:green" href="{url('set/tpchange')}"> 管理模板 </a></td>
          </tr> 
           <tbody id="extend"></tbody>
           <tr>
            <td align="right">排序：</td>
            <td align="left"><input name="norder" id="norder" type="text" value="100" size="4"/></td>
            <td class="inputhelp">排序值越大越靠前(不指定将按最新发表排序)</td>
          </tr> 
          <tr>
            <td align="right">点击：</td>
            <td align="left"><input name="hits" type="text" value="30" size="6"/></td>
            <td class="inputhelp">不建议修改</td>
          </tr> 
          <tr>
            <td align="right">发表时间：</td>
            <td align="left"><input name="addtime" id="addtime" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"/></td>
            <td class="inputhelp">不建议修改</td>
          </tr> 
          <tr>
            <td align="right">资讯关联：</td>
            <td align="left"><input name="releids" id="releids" type="text" value="" size="30" /></td>
            <td class="inputhelp">用于内页调用其他关联（推荐）信息。格式:资讯ID1,资讯ID2,资讯ID3....</td>
          </tr> 
          <tr>
            <td></td>
            <td colspan="2" align="left"><input type="submit" class="btn btn-primary btn-small" value="添加">&nbsp;<input class="btn btn-primary btn-small" type="reset" value="重置"></td>
          </tr>           
        </table>

</form>
</div>
</body>
</html>
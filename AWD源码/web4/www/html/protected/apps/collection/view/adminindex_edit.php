<?php if(!defined('APP_NAME')) exit;?>
<script  type="text/javascript" language="javascript" src="__PUBLIC__/js/jquery.skygqCheckAjaxform.js"></script>
<script	language="javascript">

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
 var hode='<img src="__PUBLIC__/admin/images/minus.gif">';
  var show='<img src="__PUBLIC__/admin/images/plus.gif">';
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
	    { name:"pname",simple:"项目名",focusMsg:'项目名'},
	    { name:"url",simple:"采集地址",type:'url',focusMsg:'采集地址'},
	    { name:"sort",min:6,simple:"类别",focusMsg:'选择类别'},
		{ name:"titlerule",simple:"标题规则",focusMsg:'标题规则'},
		{ name:"method",simple:"模型/方法",focusMsg:'填写模型/方法'},
		{ name:"tpcontent",simple:"模板",focusMsg:'选择模板'},
		{ name:"code",simple:"编码",focusMsg:'编码'},
		{ name:"contentrule",simple:"内容规则",focusMsg:'内容规则'}
	];

	$("#info").skygqCheckAjaxForm({
		items			: items_array
	});
	
	$('#sort').change(function(){
		//模板改变
        var tpc={$tpc};
        var paths = $(this).val();
        if(''!=tpc[paths]['tp']){
          $("#tpcontent").val(tpc[paths]['tp']);
        }
		//判断资讯和图集
		$("#type").val(tpc[paths]['type']);
		if(tpc[paths]['type']==2){
			$(".newsfiled").remove();
		   $('#extend').after('<tr class="photofiled"><td align="right">图集规则：</td><td><input type="text" value="{$info["photolistrule"]}" name="photolistrule" size="30"/></td><td class="inputhelp"><font color="red">暂不支持</font></td></tr><tr class="photofiled"><td align="right">图集描述规则：</td><td><input type="text" value="{$info["conlistrule"]}" name="conlistrule" size="30"/></td><td class="inputhelp"><font color="red">暂不支持</font></td></tr>');
		}else{
			$(".photofiled").remove();
			$('#extend').after('<tr class="newsfiled"><td align="right">来源：</td><td><input type="text" value="{$info["origin"]}" name="origin" size="20"/></td><td class="inputhelp">用于资讯来源字段</td></tr>');
		}

   });
});
$(document).ready(function() {
     jQuery.jqtab = function(tabtit,tab_conbox,shijian) {
        $(tab_conbox).find("li").hide();
        $(tabtit).find("li:first").addClass("btn-primary").show(); 
        $(tab_conbox).find("li:first").show();
        $(tabtit).find("li").bind(shijian,function(){
              $(this).addClass("btn-primary").siblings("li").removeClass("btn-primary"); 
              var activeindex = $(tabtit).find("li").index(this);
             $(tab_conbox).children().eq(activeindex).show().siblings().hide();
             return false;
        });

};
/*调用方法如下：*/
$.jqtab("#tabs","#tab_conbox","click");
});
</script>

<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">当前位置：【采集规则编辑】</div>
		<div class="list_head_mr"></div>
		</div>
        <ul class="tabs" id="tabs">
             <li class="btn btn-small">项目设置</li>
             <li class="btn btn-small">内容设置</li>
        </ul>
        <form action="{url('adminindex/edit',array('id' => $info['id']))}" method="post" id="info" name="info">
        <ul class="tab_conbox" id="tab_conbox">
           <li class="tab_con">
           <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
			<tr>
				<td align="right">项目名称：</td>
				<td><input id="sitename" type='text' value="{$info['pname']}" name="pname" /></td>
				<td class="inputhelp"></td>
			</tr>
      <tr>
        <td align="right">列表页地址：</td>
        <td><input type='text' value="{$info['url']}" name="url" id="url" size="50"/></td>
        <td class="inputhelp">网址中*将根据以下分页设置替换</td>
      </tr>
            <tr>
              <td align="right">分页设置：</td>
              <td><input type='text' value="{$info['pages']}" name="pages" size="30" /></td>
              <td class="inputhelp">格式：1~3(只适用于正整数)或者1,2,3</td>
            </tr>
      <tr>
        <td align="right">栏目：</td>
        <td>
        <select name="sort" id="sort" >
                  <option selected="selected" value="">=请选择类别=</option>
                  {$option}
               </select>&nbsp; &nbsp; &nbsp;[<a href="javascript:void(0);" id="exs">＋副栏目</a>]
               <input type="hidden" id="oldsort" value="{$info['sort']}" name="oldsort">
                </td>
        <td class="inputhelp"><input type="hidden" value="{$type}" name="type" id="type"></td>
      </tr>
            <tr id="exsort"  style="display:none">
            <td align="right" width="100">副栏目：</td>
            <td align="left"><p>
                    <?php 
                      if(!empty($sortlist)){
                      foreach($sortlist as $vo){
              $ifable=($vo['type']==1||$vo['type']==2)?'':'disabled';
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
          <td align="right">内容src规则：</td>
          <td><input type='text' value="{$info['listsrcrule']}" name="listsrcrule" size="30" /> </td>
          <td class="inputhelp">用于获取采集内容页的url</td>
        </tr>
    </table>
    </li>
           
       <li class="tab_con">
        <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
        <tr>
          <td align="right">标题规则：</td>
          <td><input type='text' value="{$info['titlerule']}" name="titlerule" size="30"/></td>
          <td class="inputhelp">用以获取标题</td>
        </tr>
        <tr>
        <td align="right">后台发布账户：</td>
        <td><input  type='text' value="{$info['account']}" name="account" /></td>
        <td class="inputhelp"></td>
      </tr>
        <tr>
            <td align="right">状态：</td>
            <td align="left">
                <input type="checkbox" name="ispass" value="1" <?php echo ($info['ispass']==1)?'checked':''; ?>> 审核
                <input type="checkbox" name="recmd" value="1" <?php echo ($info['recmd']==1)?'checked':''; ?> >推荐
            </td>
            <td class="inputhelp"></td>
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
          <td align="right">封面图规则：</td>
          <td><input type='text' value="{$info['picturerule']}" name="picturerule" size="30"/></td>
          <td class="inputhelp">用以获取封面图</td>
        </tr>
        <tr>
          <td align="right">关键词规则：</td>
          <td><input type='text' value="{$info['keywordsrule']}" name="keywordsrule" size="30"/></td>
          <td class="inputhelp">用以获取SEO关键词</td>
        </tr>
        <tr>
          <td align="right">描述规则：</td>
          <td><input type='text' value="{$info['descriptionrule']}" name="descriptionrule" size="30"/></td>
          <td class="inputhelp">用以获取SEO描述</td>
        </tr>
        <tr>
          <td align="right">内容规则：</td>
          <td><input type='text' value="{$info['contentrule']}" name="contentrule" size="30"/></td>
          <td class="inputhelp">用以获取SEO描述</td>
        </tr>
        <tr>
          <td align="right">内容替换：</td>
          <td><textarea name="replaces" cols="60" rows="5" >{$info['replaces']}</textarea></td>
          <td class="inputhelp">格式：需要替换的字符|替换后的字符，一行一个</td>
        </tr>
         <tr>
            <td align="right">前台模型/方法：</td>
            <td align="left"><input type="text" value="{$info['method']}" name="method" id="method" size="25"></td>
            <td class="inputhelp">默认为news模型中content方法,如果是外链则直接填写网址</td>
          </tr>
          <tr>
            <td align="right">前台显示模板：</td>
            <td align="left">
             <select name="tpcontent" id="tpcontent">
               {$choose}
              </select>
             </td>
            <td class="inputhelp"></td>
          </tr> 
          <tbody id="extend"></tbody>
          <?php if($type==1){?> 
          <tr class="newsfiled"><td align="right">来源：</td><td><input type="text" value="{$info["origin"]}" name="origin" size="20"/></td><td class="inputhelp">用于资讯来源字段</td></tr>
          <?php }elseif($type==2){ ?>
          <tr class="photofiled"><td align="right">图集规则：</td><td><input type="text" value="{$info["photolistrule"]}" name="photolistrule" size="30"/></td><td class="inputhelp">用于获取图集图片src</td></tr><tr class="photofiled"><td align="right">图集描述规则：</td><td><input type="text" value="{$info["conlistrule"]}" name="conlistrule" size="30"/></td><td class="inputhelp">用于获取每张图片描述</td></tr>
          <?php }?>
          <tr>
            <td align="right">排序：</td>
            <td align="left"><input name="norder" id="norder" type="text" value="{$info['norder']}" size="4"/></td>
            <td class="inputhelp">排序值越大越靠前(不指定将按最新发表排序)</td>
          </tr> 
          <tr>
            <td align="right">点击：</td>
            <td align="left"><input name="hitsrule" type="text" value="{$info['hitsrule']}" size="6"/></td>
            <td class="inputhelp">格式：1,100 随机在1到100之间生成</td>
          </tr> 
          <tr>
            <td align="right">发表时间范围：</td>
            <td align="left"><input name="addtimerule" id="addtimerule" type="text" value="{$info['addtimerule']}" size="40"/></td>
            <td class="inputhelp">格式：2013-11-15 11:10:10,2014-11-15 11:10:10 随机在两个时间之间生成</td>
          </tr> 
          <tr>
            <td align="right">关联：</td>
            <td align="left"><input name="releids" id="releids" type="text" value="{$info['releids']}" size="30" /></td>
            <td class="inputhelp">用于内页调用其他关联（推荐）信息。格式:ID1,ID2,ID3....</td>
          </tr>
        </table>
           </li>
     </ul>
      <table width="100%" border="0" cellpadding="0" >
		<tr>
			<td align="center" ><input type="submit" value="编辑" class="btn btn-primary btn-small"></td>
		</tr>	
      </table>
     </form>
</div>
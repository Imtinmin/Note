<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript" src="__PUBLIC__/js/jquery.imgareaselect.min.js"></script><!--剪切插件-->
<script language="javascript">
$(function ($) { 
//封面图剪切处理开始
	function preview(img, selection) { //剪切区域改变触发函数
	  $('#x1').val(selection.x1);
	  $('#y1').val(selection.y1);
	  $('#w').val(selection.width);
	  $('#h').val(selection.height);
    } 
	imgcover = $("#coverimg").imgAreaSelect({ aspectRatio: '{$twidth}:{$theight}',onSelectChange: preview,instance: true,handles:true}); //图片剪切框效果加载,aspectRatio为选择框长宽
	
	$("#cut").click(function(){//剪切图片
		var x1 = $('#x1').val(); 
		var y1 = $('#y1').val(); 
		var w = $('#w').val(); 
		var h = $('#h').val();
		var thumb_w={$twidth}; 
		var name="{$info['headpic']}";
		if(x1=="" || y1=="" || w=="" || h==""){
			alert("您必须先选择剪切区域~");
			return false;
		}
		$.post("{url('infor/cutcover')}", { name: name, x1: x1, y1: y1, w: w, h: h,thumb_w: thumb_w}, 
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
</script>
<div id="contain">
  <ul class="breadcrumb">
     <li> <span>账户管理</span><span class="divider">/</span><span>资料完善</span></li>
  </ul>
  <form enctype="multipart/form-data" method="post" action="">
        <table class="table table-bordered">
            <tr>
              <td align="right" width="100">昵称：</td>
              <td><input type="text" name="nickname" value="{$info['nickname']}"/></td>
            </tr>
             <tr>
              <td align="right"  width="100">头像：</td>
              <td>
                  <input type="file" name="headpic" id="headpic" size="10"><input type="hidden" name="oldheadpic" value="{$info['headpic']}">
                   <?php if(!empty($info['headpic'])){ ?>
                <div class="arcover">
                   <div style="clear:both; z-index:10000; margin:10px 0" id="setinfo">
                     <input type="button" title="剪切" value="剪切" id="cut" class="btn btn-primary" />  
                   </div>
                   <div style="clear:both" id="coverbox">
                     <img id="coverimg" src="{$path}{$info['headpic']}" border="0">  
                   </div>  
                   
                </div>
            
               <input type="hidden" name="x1" value="" id="x1" />
	          <input type="hidden" name="y1" value="" id="y1" />
	          <input type="hidden" name="w" value="" id="w" />
	          <input type="hidden" name="h" value="" id="h" />
            <?php } ?>
              </td>
            </tr>
            <tr>
              <td align="right"  width="100">Email：</td>
              <td><input type="text" name="email" value="{$info['email']}"/></td>
            </tr>
            <tr>
              <td align="right"  width="100">手机：</td>
              <td><input type="text" name="tel" value="{$info['tel']}"/></td>
            </tr>
            <tr>
              <td align="right"  width="100">QQ：</td>
              <td><input  type="text" name="qq" value="{$info['qq']}"/></td>
            </tr>
            <tr>
              <td colspan="2" align="center">
              <input type="submit" name="dosubmit" value="修改" class="btn btn-primary">
              </td>
            </tr>
        </table>
  </form>
</div>

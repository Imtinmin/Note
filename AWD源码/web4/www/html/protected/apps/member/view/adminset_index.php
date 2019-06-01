<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script language="javascript">
$(function ($) { 
   var hode='<img src="__PUBLICAPP__/images/minus.gif">';
  var show='<img src="__PUBLICAPP__/images/plus.gif">';
  $.each($(".alsort"), function(i,val){  
       if($(this).next().html()){
	      $(this).find('.fold').html(show);
	   }
   });
  $('.alsort a').click(function(){
	var obj=$(this).parent().next();
	if(obj.css('display')=='none') {
      if(obj.html()=='') {$(this).html('');}else {$(this).html(hode);obj.show();}
    }else{
       obj.hide();
	   $(this).html(show);
    }  
  });
});
</script>
<title>会员设置</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【会员设置】</div>
           <div class="list_head_mr"></div>  
</div>
  <form action="" method="post" id="info" name="info">
   <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont">
			<tr>
				 <td align="right" width="100">允许投稿栏目：</td>
                 <td align="left"><p>
                 {loop $sortlist $vo}
                     {if $vo['deep']==1}</p><p class="alsort"><input type="checkbox" name="alsort[]" {$vo["checked"]}  value="{$vo['id']}">{$vo['name']}&nbsp;<a class="fold" onClick="return false;"></a></p><p style="display:none">{else}
                        {$vo['space']}<input type="checkbox" name="alsort[]" {$vo['checked']}  value="{$vo['id']}">{$vo['name']}<br>
                     {/if}
                 {/loop}
                </td>
                <td class="inputhelp"></td>
			</tr>
			<tr>
				<td align="right" width="150">上传图片单张大小：</td>
				<td><input type='text' value="{$config['imgupSize']}" name="imgupSize" size="36"/>b</td>
                <td class="inputhelp">1024b=1kb,1024kb=1M</td>
			</tr>
            <tr>
				<td align="right" width="150">头像宽X高：</td>
				<td><input type='text' value="{$config['HEAD_W']}" name="HEAD_W" size="6"/> X <input type='text' value="{$config['HEAD_H']}" name="HEAD_H" size="6"/> PX</td>
                <td class="inputhelp"></td>
			</tr>
      <tr>
        <td align="right" width="150">订单邮费支付方：</td>
        <td>
        <select name="PAYMENT">
           <option value="SELLER_PAY" {if $config['PAYMENT']=='SELLER_PAY'}selected{/if}>卖家承担</option>
           <option value="BUYER_PAY" {if $config['PAYMENT']=='BUYER_PAY'}selected{/if}>买家承担</option>
        </select>
        </td>
        <td class="inputhelp"></td>
      </tr>
       <tr>
        <td align="right" width="150">物流设置：</td>
        <td>
        {loop $config['MAIL_TYPE'] $key $vo}
           {$vo[0]}:<input name="MAIL_TYPE[{$key}][1]" value="{$vo[1]}" type="text" size="4">元 <br>
        {/loop}
        </td>
        <td class="inputhelp">默认方式为快递</td>
      </tr>
      </table>
      <table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont" style="margin-top:10px">
           <tr><th colspan="4">SMTP邮件服务器设置</th></tr>
           <tr>
				<td align="right" width="150">smtp服务器地址：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_HOST']}" name="EMAIL[SMTP_HOST]" size="36"/></td>
               <td align="right" width="150">smtp服务器端口：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_PORT']}" name="EMAIL[SMTP_PORT]" size="6"/></td>
			</tr>
            <tr>	
                <td align="right" width="150">smtp服务器帐号：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_USERNAME']}" name="EMAIL[SMTP_USERNAME]" size="36"/></td>
                <td align="right" width="150">smtp服务器帐号密码：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_PASSWORD']}" name="EMAIL[SMTP_PASSWORD]" size="36"/></td>
			</tr>
             <tr>
                <td align="right" width="150">是否启用SSL安全连接：</td>
				<td>
                <?php if($config['EMAIL']['SMTP_SSL']){ ?> 
				<input type="radio" name="EMAIL[SMTP_SSL]" value="true" checked="checked" />开启 
				<input type="radio" name="EMAIL[SMTP_SSL]" value="false" />关闭 
				<?php }else{?> 
				<input type="radio" name="EMAIL[SMTP_SSL]" value="true" />开启 
				<input type="radio" name="EMAIL[SMTP_SSL]" value="false" checked="checked" />关闭 
				<?php }?>
                </td>
                <td align="right" width="150">是否开启SMTP验证功能：</td>
				<td>
                <?php if($config['EMAIL']['SMTP_AUTH']){ ?> 
				<input type="radio" name="EMAIL[SMTP_AUTH]" value="true" checked="checked" />开启 
				<input type="radio" name="EMAIL[SMTP_AUTH]" value="false" />关闭 
				<?php }else{?> 
				<input type="radio" name="EMAIL[SMTP_AUTH]" value="true" />开启 
				<input type="radio" name="EMAIL[SMTP_AUTH]" value="false" checked="checked" />关闭 
				<?php }?>
                </td>
			</tr>
             <tr>
				<td align="right" width="150">发送的邮件内容编码：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_CHARSET']}" name="EMAIL[SMTP_CHARSET]" size="6"/></td>
                <td align="right" width="150">发件人邮件地址：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_FROM_TO']}" name="EMAIL[SMTP_FROM_TO]" size="36"/></td>
			</tr>
             <tr>
				<td align="right" width="150">发件人姓名：</td>
				<td><input type='text' value="{$config['EMAIL']['SMTP_FROM_NAME']}" name="EMAIL[SMTP_FROM_NAME]" size="36"/></td>
                <td align="right" width="150">是否显示调试信息	：</td>
				<td>
                <?php if($config['EMAIL']['SMTP_DEBUG']){ ?> 
				<input type="radio" name="EMAIL[SMTP_DEBUG]" value="true" checked="checked" />开启 
				<input type="radio" name="EMAIL[SMTP_DEBUG]" value="false" />关闭 
				<?php }else{?> 
				<input type="radio" name="EMAIL[SMTP_DEBUG]" value="true" />开启 
				<input type="radio" name="EMAIL[SMTP_DEBUG]" value="false" checked="checked" />关闭 
				<?php }?>
                </td>
			</tr>
            <tr>
              <td align="center" colspan="4"><input type="submit" class="btn btn-primary btn-small" value="设置"></td>
            </tr> 
    </table>
  </form>
</div>
</body>
</html>
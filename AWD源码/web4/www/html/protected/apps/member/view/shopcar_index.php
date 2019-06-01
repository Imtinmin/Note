<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<script language="javascript">
$(function(){    
	del($(".del"));
	//修改数量
	$('.nums').click(function(){
		if(!$(this).has('input').length){
		   var code=$(this).parent().attr('id');
		   var num=$(this).html();
		   $(this).html('<input type="text" size="3" class="num" value="'+num+'" >');
		   var nowobj=$(this).find('.num');
		   nowobj.select();
		   nowobj.blur(function(){
			   var num=nowobj.val();
			   $.post("{url('member/shopcar/caredit')}", {code:code,num:num<!--TOKEN-->},
   			     function(data){
					 if(data==1){
                       nowobj.parent().html(num);
					}else{
					  alert(data);
					}
   			     });
		   });
		}
	});
});

function del(obj){
	 obj.click(function(){
		if(confirm('确定要移除么？')){
			var targ=$(this);
			var code=targ.parent().parent().attr('id');
			$.post("{url('member/shopcar/cardel')}", {code:code<!--TOKEN-->},
   				function(data){
					if(data==1){
					   targ.parent().parent().remove();
					}else alert(data);
   			});
		}
		});	
}
</script>
<div id="contain">
  <ul class="breadcrumb">
     <li> <span>在线购物</span><span class="divider">/</span><span>购物车</span></li>
  </ul>
        <table width="100%" class="table table-bordered">
            <tr>
              <th>编号</th>
              <th>名称</th>
              <th>单价</th>
              <th>数量<font size="-1">[点击修改]</font></th>
              <th><a href="{url('shopcar/carclear')}"  class="button">清空购物车</a></th>
            </tr>
            {if empty($list)}<tr><td colspan="5">您的购物车是空的~</td></tr>{/if}
            {loop $list $val}
              <tr id="{$val['code']}">
                  <td align="center">{$val['code']}</td>
                  <td align="center">{$val['name']}</td>
                  <td align="center">￥{number_format($val['price'],2)}</td>
                  <td align="center" class="nums">{$val['num']}</td>
                  <td align="center"><a class="del" href="javascript:void(0);">[ 移除 ]</a></td>
              </tr>
            {/loop}
        </table>
        
       <form action="{url('order/orderadd')}" method="post" class="form-horizontal">
        <table width="100%" class="table table-bordered">
            <tr>
               <th align="right">收货人：</th><td><input type="text" name='uname' value=""></td>
               <th align="right">电话：</th><td><input type="text" name='phone' value=""></td>
               <th align="right">手机：</th><td><input type="text" name='mobile' value=""></td>
            </tr>
            <tr>
               <th align="right">邮编：</th><td><input type="text" name='zip' value=""></td>
               <th align="right">配送：<br>（{if $payment=='BUYER_PAY'}买家承担{elseif $payment=='SELLER_PAY'}卖家承担{/if}）</th>
                  <td> 
                  {if $payment=='BUYER_PAY'}
                   <select name="type">
                     {loop $mailtype $key $vo}
                       <option value="{$key}" {if $vo[2]} selected {/if}>{$vo[0]}({$vo[1]}元)</option>
                     {/loop}
                   </select>
                   {elseif $payment=='SELLER_PAY'}
                       {loop $mailtype $key $vo}
                          {if $vo[2]} {$vo[0]}({$vo[1]}元)<input type="hidden" value="{$key}" name="type"> {/if}
                       {/loop}
                   {/if}
               </td>
              
                  <th align="right">收货人地址：</th>
                  <td> <textarea name="address" cols="40" rows="2"></textarea>
               </td>
            </tr>
            <tr> <th align="right">订单备注：</th><td colspan="5" ><textarea name="mess" cols="60" rows="3"></textarea></td></tr>
            <tr><td colspan="6" align="center"><input type="submit" class="btn" value="生成订单"></td></tr>
          
        </table>
     </form>
</div>

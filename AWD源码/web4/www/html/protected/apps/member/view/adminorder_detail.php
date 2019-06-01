<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__PUBLIC__/admin/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script	language="javascript">
  $(function ($) { 
	//行颜色效果
	$('#all_cont tr').hover(
	function () {
        $(this).children().css('background-color', '#f2f2f2');
	},
	function () {
        $(this).children().css('background-color', '#fff');
	}
	);	
  });
</script>
<title>订单详细</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
		<div class="list_head_ml">你当前的位置：【订单详细】<a  href="javascript:history.back(-1)">【返回上一页】</a></div>
		<div class="list_head_mr">订单号：{$info['ordernum']}<font color="green">【{if $info['state']==0}未支付{elseif $info['state']==1}已支付等待发货{elseif $info['state']==2}等待确认收货{elseif $info['state']==3}交易完成{/if}】</font></div>
		</div>
		<table width="100%" border="0" cellpadding="0" cellspacing="1"  class="all_cont" id="all_cont" style="margin-bottom:20px">
			 <tr>
              <th >编号</th>
              <th >名称</th>
              <th >数量</th>
              <th >单价</th>
              <th >总价</th>
            </tr>
            {loop $list $val}
              <tr>
                  <td align="center">{$val['code']}</td>
                  <td align="center">{$val['name']}</td>
                  <td align="center">{$val['num']}</td>
                  <td align="center">￥{number_format($val['price'],2)}</td>
                  <td align="center">￥{number_format($val['price']*$val['num'],2)}</td>
              </tr>
            {/loop}
		</table>
        {if 0==$info['state']}
        <form action="" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
             <tr>
              <td align="right">总价：</td>
              <td><input type="text" value="{sprintf('%1.0f',$info['total'])}" name="total">￥</td>
              <td align="right">运费：</td>
              <td><input type="text" value="{$info['freight']}" name="freight" size="6">￥
                   <select name="freightpayment">
                       <option value="SELLER_PAY" {if $info['freightpayment']=='SELLER_PAY'} selected {/if}>卖家支付</option>
                       <option value="BUYER_PAY" {if $info['freightpayment']=='BUYER_PAY'} selected {/if}>买家支付</option>
                   </select>
                   <select name="freighttype">
                       {loop $mailtype $key $vo}
                            <option value="{$key}" {if $info['freighttype']==$key} selected {/if}>{$vo[0]}</option>
                       {/loop}
                   </select>
              </td>
              <td align="right">支付总额：</td>
              <td><font color="#CC0000">￥{if $payment=='BUYER_PAY'}{number_format($info['total']+$info['freight'],2)}{elseif $payment=='SELLER_PAY'}{number_format($info['total'],2)}{/if}</font></td>
            </tr>
            <tr>
              <td align="right">收货人：</td>
              <td><input type="text" value="{$info['receivename']}" name="receivename"></td>
              <td align="right">收货电话：</td>
              <td><input type="text" value="{$info['receivephone']}" name="receivephone"></td>
              <td align="right">收货手机：</td>
              <td><input type="text" value="{$info['receivemobile']}" name="receivemobile"></td>
            </tr>
            <tr>
              <td align="right">邮编：</td>
              <td><input type="text" value="{$info['receivezip']}" name="receivezip"></td>
              <td align="right">地址：</td>
              <td colspan="3"><textarea name="receiveaddress" cols="50" rows="2">{$info['receiveaddress']}</textarea></td>
            </tr>
            <tr><td align="right">订单备注：</td><td colspan="5"><textarea name="mess" cols="70" rows="2">{$info['mess']}</textarea></td></tr>
            <input type="hidden" name="ordernum" value="{$info['ordernum']}">
            <tr>
               <td align="right">物流公司：</td><td colspan="2"><input name="freightname" id="freightname" value="{$info['freightname']}" type="text" size="40"></td>
               <td align="right">物流发货单号：</td><td colspan="2"><input name="freightnum" id="freightnum" value="{$info['freightnum']}" type="text"></td>
            </tr>
            <tr>
               <td colspan="6" align="center">
                  {loop $payapi $vo} 
                   <a class="btn btn-warning" href="{url($vo['seller']['method'],array('order'=>$info['ordernum']))}">{$vo['seller']['name']}</a>&nbsp;
                  {/loop}
                  <input type="submit" value="编辑" class="btn">&nbsp;<a class="btn" href="{url('order/del',array('id'=>$info['id']))}">删除订单</a>
               </td>
            </tr>
        </table>
        </form>
        {elseif 1==$info['state']}
        <form action="" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
             <tr>
              <td align="right">总价：</td>
              <td><font color="#CC0000">￥{number_format($info['total'],2)}</font></td>
              <td align="right">运费：</td>
              <td><font color="#CC0000">￥{number_format($info['freight'],2)}</font>（{$mailtype[$info['freighttype']][0]}-{if $payment=='BUYER_PAY'}买家承担{elseif $payment=='SELLER_PAY'}卖家承担{/if}）</td>
              <td align="right">支付总额：</td>
              <td><font color="#CC0000">￥{if $payment=='BUYER_PAY'}{number_format($info['total']+$info['freight'],2)}{elseif $payment=='SELLER_PAY'}{number_format($info['total'],2)}{/if}</font></td>
            </tr>
            <tr>
              <td align="right">收货人：</td>
              <td>{$info['receivename']}</td>
              <td align="right">收货电话：</td>
              <td>{$info['receivephone']}</td>
              <td align="right">收货手机：</td>
              <td>{$info['receivemobile']}</td>
            </tr>
            <tr>
              <td align="right">邮编：</td>
              <td>{$info['receivezip']}</td>
              <td align="right">地址：</td>
              <td colspan="3">{$info['receiveaddress']}</td>
            </tr>
            <tr><td align="right">订单备注：</td><td colspan="5"><font color="green">{$info['mess']}</font></td></tr>
            <input type="hidden" name="ordernum" value="{$info['ordernum']}">
            <tr>
               <td align="right">物流公司：</td><td colspan="2"><input name="freightname" id="freightname" value="{$info['freightname']}" type="text" size="40"></td>
               <td align="right">物流发货单号：</td><td colspan="2"><input name="freightnum" id="freightnum" value="{$info['freightnum']}" type="text"></td>
            </tr>
            <tr>
               <td colspan="6" align="center">
                  {loop $payapi $vo} 
                   <a class="btn btn-warning" href="{url($vo['seller']['method'],array('order'=>$info['ordernum']))}">{$vo['seller']['name']}</a>&nbsp;
                  {/loop}
                  <input type="submit" value="编辑" class="btn">
               </td>
            </tr>
        </table>
        </form>
        {else}
        <table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
             <tr>
              <td align="right">总价：</td>
              <td><font color="#CC0000">￥{number_format($info['total'],2)}</font></td>
              <td align="right">运费：</td>
              <td><font color="#CC0000">￥{number_format($info['freight'],2)}</font>（{$mailtype[$info['freighttype']][0]}-{if $payment=='BUYER_PAY'}买家承担{elseif $payment=='SELLER_PAY'}卖家承担{/if}）</td>
              <td align="right">支付总额：</td>
              <td><font color="#CC0000">￥{if $payment=='BUYER_PAY'}{number_format($info['total']+$info['freight'],2)}{elseif $payment=='SELLER_PAY'}{number_format($info['total'],2)}{/if}</font></td>
            </tr>
            <tr>
              <td align="right">收货人：</td>
              <td>{$info['receivename']}</td>
              <td align="right">收货电话：</td>
              <td>{$info['receivephone']}</td>
              <td align="right">收货手机：</td>
              <td>{$info['receivemobile']}</td>
            </tr>
            <tr>
              <td align="right">邮编：</td>
              <td>{$info['receivezip']}</td>
              <td align="right">地址：</td>
              <td colspan="3">{$info['receiveaddress']}</td>
            </tr>
            <tr><td align="right">订单备注：</td><td colspan="5"><font color="green">{$info['mess']}</font></td></tr>
            <tr>
               <td align="right">物流公司：</td><td colspan="2">{$info['freightname']}</td>
               <td align="right">物流发货单号：</td><td colspan="2">{$info['freightnum']}</td>
            </tr>
            <tr>
               <td colspan="6" align="center">
                 {if $info['state']==3}<a class="btn" href="{url('order/del',array('id'=>$info['id']))}">删除订单</a>{/if}
               </td>
            </tr>
        </table>
        {/if}
        
    </div>
</body>
</html>
<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<div id="contain">
<ul class="breadcrumb">
     <li> <span>订单号：{$info['ordernum']}<font color="green">【{if $info['state']==0}等待付款{elseif $info['state']==1}已支付等待发货{elseif $info['state']==2}等待确认收货{elseif $info['state']==3}交易完成{/if}】</font></span><span class="divider">/</span><span><a href="javascript:history.back(-1)">返回上一页</a></span></li>
</ul>
        <table width="100%"  class="table table-bordered">
            <tr>
              <th>编号</th>
              <th>名称</th>
              <th>数量</th>
              <th>单价</th>
              <th>总价</th>
            </tr>
            {loop $list $val}
              <tr>
                  <td align="center">{$val['code']}</td>
                  <td align="center">{$val['name']}</td>
                  <td align="center">{$val['num']}</td>
                  <td align="center">￥{number_format($val['price'],2)}</td>
                  <td align="center">￥{number_format($val['price']*intval($val['num']),2)}</td>
              </tr>
            {/loop}
        </table>
        <table width="100%" class="table table-bordered">
            <tr>
              <th align="right">总价：</th>
              <td><font color="#CC0000">￥{number_format($info['total'],2)}</font></td>
              <th align="right">运费：</th>
              <td><font color="#CC0000">￥{number_format($info['freight'],2)}</font>（{$mailtype[$info['freighttype']][0]}-{if $payment=='BUYER_PAY'}买家承担{elseif $payment=='SELLER_PAY'}卖家承担{/if}）</td>
              <th align="right">支付总额：</th>
              <td><font color="#CC0000">￥{if $payment=='BUYER_PAY'}{number_format($info['total']+$info['freight'],2)}{elseif $payment=='SELLER_PAY'}{number_format($info['total'],2)}{/if}</font></td>
            </tr>
            <tr>
              <th align="right">收货人：</th>
              <td>{$info['receivename']}</td>
              <th align="right">收货电话：</th>
              <td>{$info['receivephone']}</td>
              <th align="right">收货手机：</th>
              <td>{$info['receivemobile']}</td>
            </tr>
            <tr>
              <th align="right">邮编：</th>
              <td>{$info['receivezip']}</td>
              <th align="right">地址：</th>
              <td colspan="3">{$info['receiveaddress']}</td>
            </tr>
            <tr>
            </tr>
            <tr><th align="right">订单备注：</th><td colspan="5"><font color="green">{$info['mess']}</font></td></tr>
            <tr>
               <td colspan="6" align="center">
                {if $info['state']==0}
                   {loop $payapi $vo} 
                      <a class="btn btn-warning" href="{url($vo['buyer']['method'],array('order'=>$info['ordernum']))}">{$vo['buyer']['name']}</a>&nbsp;
                   {/loop}
                   <a class="btn" href="{url('order/pay',array('order'=>$info['ordernum']))}">账户余额购买</a>&nbsp;
                {elseif $info['state']==2}
                    <font color="green"><a class="btn" href="{url('order/sure',array('id'=>$info['id']))}">确认收货</a>&nbsp;
                {/if}
                 {if $info['state']!=1 && $info['state']!=2}<a class="btn" href="{url('order/del',array('id'=>$info['id']))}">删除订单</a>{/if}
               </td>
            </tr>
        </table>
</div>

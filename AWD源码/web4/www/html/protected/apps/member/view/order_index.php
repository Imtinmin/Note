<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<div id="contain">
<ul class="breadcrumb">
     <li> <span>在线购物</span><span class="divider">/</span><span>订单管理</span></li>
  </ul>
        <table width="100%" class="table table-bordered">
            <tr>
              <th>订单号</th>
              <th>订单名称</th>
              <th>总价</th>
              <th>下单时间</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
            {if empty($list)}<tr><td colspan="5">您还没有订单~</td></tr>{/if}
            {loop $list $val}
              <tr>
                  <td align="center">{$val['ordernum']}</td>
                  <td align="center">{$val['ordersubject']}</td>
                  <td align="center"><font color="#CC0000">￥{number_format($val['total'],2)}</font></td>
                  <td align="center">{date($val['ordertime'],Y-m-d H:i:s)}</td>
                  <td align="center"><font color="green">{if $val['state']==0}等待付款{elseif $val['state']==1}已支付等待发货{elseif $val['state']==2}等待确认收货{elseif $val['state']==3}交易完成{/if}</font></td>
                  <td align="center"><a href="{url('order/detail',array('id'=>$val['id']))}">[ 管理 ]</a>{if $val['state']!=1 && $val['state']!=2}<a href="{url('order/del',array('id'=>$val['id']))}"  onClick="return confirm('删除不可恢复~确定要删除吗？')">[ 删除 ]</a>{/if}</td>
              </tr>
            {/loop}
            {if !empty($page)}<tr><td colspan="5">{$page}</td></tr>{/if}
        </table>
</div>

{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The browse view file of order for mobile template of chanzhiEPS.
 * The file should be used as ajax content
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side')}
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-shopping-cart'></i> {$lang->order->admin}</div>
  </div>
  <div class='panel-body' id='orderListWrapper'>
    <div class='cards' id='orderList'>
      {foreach($orders as $order)}
        <div class='card'>
          <div class='card-heading bg-gray-pale'>
            #{$order->id} &nbsp; &nbsp;
            <span>{$lang->order->amount}: 
              <strong class='text-danger'>
                {!echo isset($order->balance) ? $order->amount + $order->balance : $order->amount}
                {!echo isset($control->config->product->currencySymbol) ? $control->config->product->currencySymbol : ''}
              </strong>
            </span> 
            <div class='pull-right'>
              {$order->status == ''}
              {if($order->status == 'normal' and 'not_paid')} {$statusClass = 'danger'}    {/if}
              {if($order->status == 'paid' and 'not_send')}   {$statusClass = 'important'} {/if}
              {if($order->status == 'send')}                  {$statusClass = 'special'}   {/if}
              {if($order->status == 'confirmed')}             {$statusClass = 'primary'}   {/if}
              {if($order->status == 'finished')}              {$statusClass = 'success'}   {/if}
              {if($order->status == 'canceled')}              {$statusClass = 'muted'}     {/if}
              <span class='text-{$statusClass}'>{$control->order->processStatus($order)}</span>
            </div>
          </div>
          <div class='list-group simple'>
          {foreach($order->products as $product)}
            <div class='list-group-item'>
              {!html::a(helper::createLink('product', 'view', "id={{$product->productID}}", "target='_blank'"), $product->productName, "class='text-primary'")}
              <div class='pull-right'>
                <small class="text-muted">{$lang->order->price}{$lang->colon}</small>{$product->price} &nbsp;
                <small class="text-muted">{$lang->order->count}{$lang->colon}</small>{$product->count}
              </div>
            </div>
          {/foreach}
          </div>
          <div class='card-footer'>
            {$history = '<li>' . $lang->order->createdDate . $lang->colon .  $order->createdDate . '</li>'}
            {if($order->payment != 'COD' and ($order->paidDate > $order->createdDate))}
              {$history .= '<li>' . $lang->order->paidDate . $lang->colon .  $order->paidDate . '</li>'}
            {/if}
            {if($order->deliveriedDate > $order->createdDate)}
              {$history .= '<li>' . $lang->order->deliveriedDate . $lang->colon .  $order->deliveriedDate . '</li>'}
            {/if}
            {if($order->confirmedDate > $order->deliveriedDate)} 
              {$history .= '<li>' . $lang->order->confirmedDate . $lang->colon .  $order->confirmedDate . '</li>'}
            {/if}
            {if($order->payment == 'COD' and ($order->paidDate > $order->createdDate))}
              {$history .= '<li>' . $lang->order->paidDate . $lang->colon .  $order->paidDate . '</li>'}
            {/if}
            {if($order->note)}
              {$history .= '<li>' . $lang->order->note . $lang->colon . $order->note . '</li>'}
            {/if}
            <ul class='order-track-list text-muted'>{$history}</ul>
          </div>
          <div class='card-footer order-actions text-right'>
            {$control->order->printActions($order)}
          </div>
        </div>
      {/foreach}
    </div>
  </div>
  <div class='panel-footer'>
    {$pager->show('justify')}
  </div>
</div>
<script>
$(function()
{
    var cancelWarning  = '{$lang->order->cancelWarning}';
    var confirmWarning = '{$lang->order->confirmWarning}';

    {noparse}
    var refreshOrderList = function()
    {
        $('#orderListWrapper').load(window.location.href + ' #orderList');
    };

    $(document).on('click', '.cancelLink', function(e)
    {
        var $this   = $(this);
        var options = $.extend({url: $this.data('rel'), confirm: cancelWarning, onSuccess: refreshOrderList}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    }).on('click', '.confirmDelivery', function(e)
    {
        var $this   = $(this);
        var options = $.extend({url: $this.data('rel'), confirm: confirmWarning, onSuccess: refreshOrderList}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    });
    {/noparse}
});
</script>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

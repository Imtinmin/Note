{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The browse view file of address for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     address
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side')}

<div class='panel-section'>
  <div class='panel-heading'>
    <button type='button' class='btn primary block' data-toggle='modal' data-remote='{!inlink('create')}'><i class='icon icon-plus'></i>{$lang->address->create}</button>
  </div>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-map-marker'></i>{$lang->address->browse}</div>
  </div>
  <div id='addressListWrapper'>
    <div class='cards condensed cards-list' id='addressList'>
      {foreach($addresses as $address)}
        {$checked = isset($checked) ? '' : 'checked'}
        <div class='card'>
          <div class='card-heading'>
            {if(helper::isAjaxRequest())} <input type='radio' {$checked} name='deliveryAddress' value='{$address->id}'/> {/if}
            <strong class='lead'>{$address->contact}</strong>
            &nbsp;&nbsp;<span class='text-special'><i class='icon icon-phone'></i>{!str2Entity($address->phone)}</span>
          </div>
          <div class='card-content'>
            {$address->address}<span class='text-muted'>({$lang->address->zipcode} : {$address->zipcode})</span>
          </div>
          <div class='card-footer'>
            {!html::a(helper::createLink('address', 'edit', "id={{$address->id}}"), $lang->edit, "class='editor text-primary' data-toggle='modal'")}&nbsp;&nbsp
            {!html::a(helper::createLink('address', 'delete', "id={{$address->id}}"), $lang->delete, "class='deleter text-danger'")}
          </div>
        </div>
      {/foreach}
    </div>
  </div>
  {if(count($addresses) >= 5)}
    <div class='panel-footer'>
      <button type='button' class='btn primary block' data-toggle='modal' data-remote='{!inlink('create')}'><i class='icon icon-plus'></i> {$lang->address->create}</button>
    </div>
  {/if}
</div>
<script>
$(function()
{
    $.refreshAddressList = function()
    {
        $('#addressListWrapper').load(window.location.href + ' #addressList');
    };
});
</script>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

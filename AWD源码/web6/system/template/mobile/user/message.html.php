{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The message view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side')}
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-comments-alt'></i> {$lang->user->messages} <span>({!count($messages)})</span> </div>
  </div>
  <div class='panel-body' id='cardListWarpper'>
    <div class='cards cards-list' id='cardList'>
    {foreach($messages as $message)}
      <div class='card'>
        <div class='card-heading'>
          <strong class='{!echo $control->app->user->account === $message->from ? 'text-danger' : 'text-special' }'>{$message->from}</strong> &nbsp; 
          <small class='text-muted'>{!substr($message->date, 5)}</small>
        </div>
        <div class='card-content'>
          {$message->content}
        </div>
        <div class='card-footer'>
          <span class='{!echo $message->readed ? 'text-muted' : 'text-success'}'>{$lang->message->readedStatus[$message->readed]}</span>
          <div class="pull-right">
            {if(!$message->readed)}
              {!html::a($control->createLink('message', 'view', "message=$message->id"), $message->link ? $lang->message->view : $lang->message->readed, "class='text-primary markread'")}
            {else}
              {!echo $message->link ? html::a($control->createLink('message', 'view', "message=$message->id"), $lang->message->view) : ''}
            {/if}
            &nbsp; {!html::a($control->createLink('message', 'batchDelete'), $lang->delete, "class='delete text-danger' data-id='{{$message->id}}'")}
          </div>
        </div>
      </div>
    {/foreach}
    </div>
  </div>
</div>
<script>
$(function()
{
    var readed        = '{$lang->message->readed}';
    var deleteSuccess = '{$lang->deleteSuccess}';

    {noparse}
    $(document).on('click', '.markread', function(e) {

        var $this   = $(this);
        var options = $.extend({url: $this.attr('href'), onSuccess: function(response)
        {
            var $response = $(response);
            $('#cardList').html($response.find('#cardList').html());
            $.messager.success(readed);
        }
        }, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    }).on('click', '.delete', function(e) {

        var $this   = $(this);
        var options = $.extend(
        {
            method: 'post',
            url: $this.attr('href'), 
            confirm: window.v.lang.confirmDelete,
            data: "messages[]=" + $this.data('id'),
            onResultSuccess: function(response)
            {
                response.locate = null;
                var $card = $this.closest('.card').addClass('fade');
                setTimeout(function(){$card.remove();}, 300);
                $.messager.success(deleteSuccess)
            }
         }, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    });
    {/noparse}
});
</script>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

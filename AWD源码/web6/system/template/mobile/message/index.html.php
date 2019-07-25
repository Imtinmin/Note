{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The index view file of message for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{* TODO: check follow methods: showDetail and hideDetail *}
<div class='block-region region-top blocks' data-region='message_index-top'>{$control->loadModel('block')->printRegion($layouts, 'message_index', 'top')}</div>
<div class='panel-section'>
  <div id='commentsListWrapper'><div id='commentsList'> {* Double div for ajax load. *}
    {if(!empty($messages))}
      <div class='panel-heading'>
        <a href='#commentDialog' data-toggle='modal' class='btn primary block'>
          <i class='icon-comment-alt'></i>
          {$lang->message->post}
        </a>
      </div>
      <div class='panel-heading'>
        <div class='title'><i class='icon-comments'></i> {$lang->message->list}</div>
      </div>
      <div class='cards condensed bordered'>
        {foreach($messages as $number => $message)}
          <div class='card comment'>
            <div class='card-heading'>
              <span class='text-special name'>{$message->from}</span> &nbsp; <small class='text-muted time'>{!formatTime($message->date, 'Y/m/d H:m')}</small>
              <div class='actions'>
                {!html::a($control->createLink('message', 'reply', "commentID=$message->id"), $lang->message->reply, "data-toggle='modal' data-type='ajax' data-icon='reply' data-title='{{$lang->message->reply}}'")}
              </div>
            </div>
            <div class='card-content'>{!nl2br($message->content)}</div>
            {$control->message->getFrontReplies($message, 'simple')}
          </div>
        {/foreach}
      </div>
      <div class='panel-body'>
        <hr class='space'>
        {$pager->show('justify')}
      </div>
    {else}
      <div class='panel-body'>
        <hr class='space'>
        <div class='alert text-center bg-primary-pale text-info'>
          <p><i class='icon-comments-alt icon-s3'></i></p><strong>0 {$lang->message->common}</strong>
        </div>
      </div>
    {/if}
  </div></div>
  <div class='panel-heading'>
    <a href='#commentDialog' data-toggle='modal' class='btn primary block'><i class='icon-comment-alt'></i> {$lang->message->post}</a>
  </div>
</div>

<div class='modal fade' id='commentDialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
        <h5 class='modal-title'><i class='icon-comment-alt'></i> {$lang->message->post}</h5>
      </div>
      <div class='modal-body'>
        <form method='post' id='commentForm' action="{$control->createLink('message', 'post', 'type=message')}">
          <div class='form-group'>
            {!html::textarea('content', '', "class='form-control' rows='3' placeholder='{{$lang->message->content}}'")}
            {!html::hidden('objectType', 'message')}
            {!html::hidden('objectID', 0)}
          </div>
          {if($control->session->user->account == 'guest')}
            <div class='form-group required'>
              {!html::input('from', '', "class='form-control' placeholder='{{$lang->message->from}}'")}
            </div>
            <div class='form-group'>
              <label><small class='text-important'>{$lang->message->contactHidden}</small></label>
              {!html::input('phone', '', "class='form-control' placeholder='{{$lang->message->phone}}'")}
            </div>
            <div class='form-group'>
              {!html::input('qq', '', "class='form-control' placeholder='{{$lang->message->qq}}'")}
            </div>
            <div class='form-group'>
              {!html::input('email', '', "class='form-control' placeholder='{{$lang->message->email}}'")}
            </div>
          {else}
            <div class='form-group'>
              <span class='signed-user-info'>
                <i class='icon-user text-muted'></i> <strong>{$control->session->user->realname}</strong>
                {if($control->session->user->email != '')}
                  <span class='text-muted'>&nbsp;({!str2Entity($control->session->user->email)})</span>
                {/if}
              </span>
                {!html::hidden('from',   $control->session->user->realname)}
                {!html::hidden('email',  $control->session->user->email)}
                {!html::hidden('qq',     $control->session->user->qq)}
                {!html::hidden('phone',  $control->session->user->phone)}
            </div>
          {/if}
          <div class='form-group'>
            <div class='checkbox'>
              <label><input type='checkbox' name='receiveEmail' value='1' checked /> {$lang->comment->receiveEmail}</label>
            </div>
          </div>
          <div class='form-group hide captcha-box'></div>
          <div class='form-group'>
            {!html::submitButton('', 'btn primary')}&nbsp; 
            <small class="text-important">{$lang->comment->needCheck}</small>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class='block-region region-bottom blocks' data-region='message_index-bottom'>{$control->loadModel('block')->printRegion($layouts, 'message_index', 'bottom')}</div>
{include TPL_ROOT . 'common/form.html.php'}
{if(isset($pageJS))} {!js::execute($pageJS)} {/if}
{noparse}
<script>
$(function()
{
    $.refreshCommentList = function()
    {
        $('#commentsListWrapper').load(window.location.href + ' #commentsList');
    };

    var $commentForm = $('#commentForm');
    $commentForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $('#commentDialog').modal('hide');
            if(window.v)
            {
                $commentForm.find('#content').val('');
                setTimeout($.refreshCommentList, 200)
            }
        }
        if(response.reason == 'needChecking')
        {
            $commentForm.find('.captcha-box').html(Base64.decode(response.captcha)).removeClass('hide');
        }
    } });
});
</script>
{/noparse}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

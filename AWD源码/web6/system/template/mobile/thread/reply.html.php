{if(!defined("RUN_MODE"))} {!die()} {/if}
<div class='panel panel-section' id='repliesListWrapper'>
  <div id='repliesList' class='panel-body cards cards-list'>
    {foreach($replies as $reply)}
    {$floor = $floors[$reply->id]}
    <div class='card thread reply' id='{$reply->id}'>
      <div class='card-heading'>
        <div class='pull-right'>
          {if($floor > 2)}
            <strong class='level-number'>#{$floor}</strong>
          {elseif($floor === 1)}
            <strong class='level-number'>{$lang->reply->sofa}</strong>
          {elseif($floor === 2)}
            <strong class='level-number'>{$lang->reply->stool}</strong>
          {/if}
        </div>
        <div>
          <span class='reply-time'>
            <i class='icon-comment-alt'></i> {$reply->addedDate}
            {if(!$thread->discussion and $reply->reply)} {!sprintf($lang->thread->replyFloor, zget($floors, $reply->reply))} {/if}
          </span> &nbsp;&nbsp; 
          <span class='reply-user{if($control->app->user->account == $reply->author)} {!echo ' text-danger'} {/if}'>
            <i class='icon-user'></i> {!echo isset($speakers[$reply->author]) ? $speakers[$reply->author]->realname : $reply->author}
          </span>
        </div>
      </div>
      <section class='card-content article-content'>{$reply->content}</section>
      <section>
        {if($thread->discussion)} {$control->reply->getByReply($reply)} {/if}
      </section>
      {if(!empty($reply->files))}
        <div class='card-content'>{$control->reply->printFiles($reply, $control->thread->canManage($board->id, $reply->author))}</div>
      {/if}
      <div class='card-footer'>
        {if($reply->editor)}
          <small class='hide last-edit'><i class="icon-pencil"></i> {!printf($lang->thread->lblEdited, $reply->editorRealname, $reply->editedDate)}</small>
        {/if}
        <div class='actions text-right'>
          {if($control->app->user->account != 'guest')}
            {if($control->thread->canManage($board->id))} {!html::a($control->createLink('reply', 'delete', "replyID=$reply->id"), '<i class="icon-trash"></i> ' . $lang->delete, "class='deleter text-muted'")} &nbsp; {/if}
            {if($control->thread->canManage($board->id, $reply->author))} {!html::a($control->createLink('reply', 'edit',   "replyID=$reply->id"), '<i class="icon-pencil"></i> ' . $lang->edit, "data-toggle='modal' class='text-muted'")} &nbsp; {/if}
            {if(!$thread->readonly)}
              <a href='#replyDialog' data-toggle='modal' class='text-muted thread-reply-btn'><i class='icon-reply'></i> {$lang->reply->common}</a>
            {/if}
          {else}
            {if(!$thread->readonly)}
              <a href="{!$control->createLink('user', 'login', 'referer=' . helper::safe64Encode($control->app->getURI(true)))}#reply" class="thread-reply-btn text-muted"><i class="icon-reply"></i> {$lang->reply->common}</a>
            {/if}
          {/if}
        </div>
      </div>
    </div>
    {/foreach}
    {$pager->show('justify')}
    <hr class='space' id='bottomSpace'>
  </div>
</div>

{if(!$thread->readonly)}
  <div class='modal fade' id='replyDialog'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
          <h5 class='modal-title'><i class='icon-reply'></i> {$lang->reply->common}</h5>
        </div>
        <div class='modal-body'>
          <form method='post' enctype='multipart/form-data' id='replyForm' action='{$control->createLink('reply', 'post', "thread=$thread->id")}'>
            <div class='form-group' id='reply'>
              {!html::textarea('content', '', "rows='6' class='form-control' placeholder='{{$lang->reply->content}}'")}
            </div>
            <div class='form-group clearfix captcha-box hide'></div>
            <div class='form-group'>{!html::submitButton('', 'btn primary block')}</div>
            {!html::hidden('reply', 0)}
          </form>
        </div>
      </div>
    </div>
  </div>
  {noparse}
  <script>
  $(function()
  {
      $.refreshRepliesList = function()
      {
          $('#repliesListWrapper').load(window.location.href + ' #repliesList', function()
          {
              $(window).scrollTop($('#bottomSpace').offset().top);
          });
      };
  
      var $replyForm = $('#replyForm');
      $replyForm.ajaxform({onResultSuccess: function(response)
      {
          $('#replyDialog').modal('hide')
          if($.isFunction($.refreshRepliesList))
          {
              response.locate = false;
              setTimeout($.refreshRepliesList, 200);
          }
      }, onSuccess: function(response)
      {
          if(response.reason == 'needChecking')
          {
              $replyForm.find('.captcha-box').html(Base64.decode(response.captcha)).removeClass('hide');
          }
      }
      });
  
      $('.thread-reply-btn').click(function()
      {
          if($(this).data('reply')) $('input[name=reply]').val($(this).data('reply'));
      })
  });
  </script>
  {/noparse}
{/if}

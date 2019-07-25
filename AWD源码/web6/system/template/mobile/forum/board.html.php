{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The board view file of forum for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<div class='block-region region-top blocks' data-region='forum_board-top'>{$control->loadModel('block')->printRegion($layouts, 'forum_board', 'top')}</div>
<div class='panel-section'>
  {if(count($threads) > 5 && $control->forum->canPost($board))}
    <div class='panel-heading'>
      {!html::a($control->createLink('thread', 'post', "boardID=$board->id"), '<i class="icon-pencil"></i>&nbsp;&nbsp;' . $lang->forum->post, "class='btn primary block' data-toggle='modal'")}
    </div>
  {/if}

  <div class='panel-heading page-header'>
    <div class='title'><i class='icon icon-comments-alt'></i> <strong>{$board->name}</strong>
    {if($board->moderators)} {!printf(" <small class='text-muted'>" . $lang->forum->lblOwner . '</small>', trim($board->moderators, ','))} {/if} </div>
  </div>

  <div class='cards cards-list condensed bordered'>
    {foreach($sticks as $thread)}
      {$style = ($thread->color or $thread->stickBold) ? "style='" : ''}
      {$style .= $thread->color ? "color:{{$thread->color}};" : ''}
      {$style .= $thread->stickBold ? "font-weight:bold;" : ''}
      {$style .= ($thread->color or $thread->stickBold) ? "'" : ''}
      <a class='card' href='{$control->createLink('thread', 'view', "id=$thread->id")}' data-ve='thread' id='thread{$thread->id}'>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-heading'><h5 {$style}><i class='icon-comment-alt'></i> {$thread->title} <span class='text-danger'>[{$lang->thread->stick}]</span></h5></div>
            <div class='card-content text-muted small'><i class='icon icon-eye-open'></i> {$thread->views} &nbsp; <i class='icon-user'></i> {$thread->authorRealname} {!substr($thread->addedDate, 5, -3)}</div>
          </div>
          <div class='table-cell middle thumbnail-cell text-right'>
            <div class='counter text-right'><div class='title'>{$thread->replies}</div><div class='caption text-muted small'>{$lang->thread->replies}</div></div>
          </div>
        </div>
      </a>
      {@unset($threads[$thread->id])}
    {/foreach}

    {foreach($threads as $thread)}
      {$style = $thread->color ? " style='color:{{$thread->color}}'" : ''}
      <a class='card' href='{$control->createLink('thread', 'view', "id=$thread->id")}' data-ve='thread' id='thread{$thread->id}'>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-heading{if($thread->isNew)} {!echo ' text-success'} {/if}'><h5{ $style}><i class='icon-comment-alt'></i> {$thread->title}</h5></div>
            <div class='card-content text-muted small'><i class='icon icon-eye-open'></i> {$thread->views} &nbsp; <i class='icon-user'></i> {$thread->authorRealname} {!substr($thread->addedDate, 5, -3)}</div>
          </div>
          <div class='table-cell middle thumbnail-cell text-right'>
            <div class='counter text-right'><div class='title{if($thread->isNew)} {!echo ' text-success'} {/if}'>{$thread->replies}</div><div class='caption text-muted small'>{$lang->thread->replies}</div></div>
          </div>
        </div>
      </a>
    {/foreach}
  </div>

  <div class='panel-footer'>
    {$pager->show('justify')}
    <hr class='space'>
    {if($control->forum->canPost($board))} {!html::a($control->createLink('thread', 'post', "boardID=$board->id"), '<i class="icon-pencil"></i>&nbsp;&nbsp;' . $lang->forum->post, "class='btn primary block' data-toggle='modal'")} {/if}
  </div>
</div>
<div class='block-region region-bottom blocks' data-region='forum_board-bottom'>{$control->loadModel('block')->printRegion($layouts, 'forum_board', 'bottom')}</div>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

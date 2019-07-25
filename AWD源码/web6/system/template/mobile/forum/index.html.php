{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The index view file of forum for mobile template of chanzhiEPS.
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
<div class='block-region region-top blocks' data-region='forum_index-top'>{$control->loadModel('block')->printRegion($layouts, 'forum_index', 'top')}</div>
<div class='panel-section'>
  <div class='row'>
    {foreach($lang->forum->indexModeOptions as $modeCode => $modeName)}
      {$class=($modeCode == $mode) ? 'primary' : ''}
      <div class='col-4'>{!html::a(inlink('index', "mode=$modeCode"),  $modeName,  "class='btn $class block'")}</div> 
    {/foreach}
  </div>
  {if($mode == 'latest')}
    <div class='cards cards-list condensed bordered'>
      {foreach($threads as $thread)}
        {$style = $thread->color ? " style='color:{{$thread->color}}'" : ''}
        <a class='card' href='{$control->createLink('thread', 'view', "id=$thread->id")}' data-ve='thread' id='thread{$thread->id}'>
          <div class='table-layout'>
            <div class='table-cell'>
              <div class='card-heading text-success'><h5{ $style}><i class='icon-comment-alt'></i> {$thread->title}</h5></div>
              <div class='card-content text-muted small'><i class='icon icon-eye-open'></i> {$thread->views} &nbsp; <i class='icon-user'></i> {$thread->authorRealname} {!substr($thread->addedDate, 5, -3)}</div>
            </div>
            <div class='table-cell middle thumbnail-cell text-right'>
              <div class='counter text-right'><div class='title text-success'>{$thread->replies}</div><div class='caption text-muted small'>{$lang->thread->replies}</div></div>
            </div>
          </div>
        </a>
      {/foreach}
    </div>
    <div class='panel-footer'>{$pager->show('justify')}</div>
  {elseif($mode == 'stick')}
    <div class='cards cards-list condensed bordered'>
      {foreach($threads as $thread)}
        {$style = $thread->color ? " style='color:{{$thread->color}}'" : ''}
        <a class='card' href='{$control->createLink('thread', 'view', "id=$thread->id")}' data-ve='thread' id='thread{$thread->id}'>
          <div class='table-layout'>
            <div class='table-cell'>
              <div class='card-heading'><h5{ $style}><i class='icon-comment-alt'></i> {$thread->title}</h5></div>
              <div class='card-content text-muted small'><i class='icon icon-eye-open'></i> {$thread->views} &nbsp; <i class='icon-user'></i> {$thread->authorRealname} {!substr($thread->addedDate, 5, -3)}</div>
            </div>
            <div class='table-cell middle thumbnail-cell text-right'>
              <div class='counter text-right'><div class='title'>{$thread->replies}</div><div class='caption text-muted small'>{$lang->thread->replies}</div></div>
            </div>
          </div>
        </a>
      {/foreach}
    </div>
    <div class='panel-footer'>{$pager->show('justify')}</div>
  {else}
    <div id='boards'>
    {foreach($boards as $parentBoard)}
        <div class='panel-heading page-header'>
          <div class='title'><i class='icon icon-comments'></i> <strong>{$parentBoard->name}</strong></div>
        </div>
        <div class='panel-body'>
          <div class='cards cards-list'>
          {foreach($parentBoard->children as $childBoard)}
            {$isNewBoard = $control->forum->isNew($childBoard)}
            {$moderators = ''}
            {foreach($childBoard->moderators as $moderator)}
              {if(!empty($moderator))}
                {$moderators .= $moderator . ' '}
              {/if}
            {/foreach}
            <a class='card' href='{!inlink('board', "id=$childBoard->id", "category={{$childBoard->alias}}")}'>
              <div class='table-layout'>
                <div class='table-cell'>
                  <div class='card-heading'>
                    <h5>
                      {$childBoard->name}
                      {if(!empty($moderators))} {!printf('<small>' . $lang->forum->lblOwner . '</small>', $moderators)} {/if}
                    </h5>
                  </div>
                  <div class='card-content text-muted small'>{$childBoard->desc}</div>
                  {if($childBoard->postedBy)}
                    <div class='card-footer small text-muted'>{$lang->forum->lastPost . ':'}
                      {!substr($childBoard->postedDate, 5, -3) . " {{$childBoard->postedByRealname}}"}
                    </div>
                  {/if}
                </div>
                <div class='table-cell middle thumbnail-cell text-right'>
                  <div class='counter text-center'><div class='title{if($isNewBoard)} {!echo ' text-success'} {/if}'>{$childBoard->threads}</div><div class='caption text-muted small'>{$lang->forum->threadCount}</div></div>
                </div>
              </div>
            </a>
          {/foreach}
          </div>
        </div>
      </div>
    {/foreach}
  {/if}
</div>
<div class='block-region region-bottom blocks' data-region='forum_index-bottom'>{$control->loadModel('block')->printRegion($layouts, 'forum_index', 'bottom')}</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

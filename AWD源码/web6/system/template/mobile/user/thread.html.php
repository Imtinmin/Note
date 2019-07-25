{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The thread view file of user for mobile template of chanzhiEPS.
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
    <div class='title strong'><i class='icon icon-share'></i> {$lang->user->thread}</div>
  </div>
  <div class='cards condensed cards-list'>
    {foreach($threads as $thread)}
      <a href='{!$control->createLink('thread', 'view', "id=$thread->id")}' class='card'>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-heading'>
              <h5>{$thread->title}</h5>
            </div>
            <div class='card-content text-muted'>
              {$lang->thread->postedDate} {!substr($thread->addedDate, 2, -3)}
              &nbsp;&nbsp;
              <i class='icon-eye-open'></i> {$thread->views}
            </div>
            {if($thread->replies)}
              <div class='card-footer text-muted'>
                {$lang->thread->lastReply} {!substr($thread->repliedDate, 2, -3) . ' ' . $thread->repliedByRealname}
              </div>
            {/if}
          </div>
          <div class='table-cell middle thumbnail-cell text-right'>
            <div class='counter text-right'><div class='title {!echo $thread->replies > 0 ? '' : 'text-muted'}'>{$thread->replies}</div><div class='caption text-muted small'>{$lang->thread->replies}</div></div>
          </div>
        </div>
      </a>
    {/foreach}
  </div>
  <div class='panel-footer'>
    {$pager->show('justify')}
  </div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The blog view file for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     blog
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'blog', 'header')}
{include TPL_ROOT . 'common/files.html.php'}
{!js::set('pageLayout', $control->block->getLayoutScope('blog_view', $article->id))}

<div class='block-region region-top blocks' data-region='blog_view-top'>{$control->loadModel('block')->printRegion($layouts, 'blog_view', 'top')}</div>

<div class='appheader'>
  <div class='heading'>
    <h2>{$article->title}</h2>
    <div class='caption text-muted'>
      <small><i class='icon-time icon-large'></i> {!formatTime($article->addedDate)}</small> &nbsp;&nbsp;
      <small><i class='icon-user icon-large'></i> {$article->author}</small> &nbsp;&nbsp;
      <small><i class='icon-eye-open'></i> {$config->viewsPlaceholder}</small> &nbsp;&nbsp;
      {if($article->source != 'original' and $article->copyURL != '')}
        <small>
          {!echo $article->source ? $lang->article->lblSource : $lang->article->sourceList[$article->source] . $lang->colon}
          {$article->copyURL ? print(html::a($article->copyURL, $article->copySite, "target='_blank'")) : print($article->copySite)}
        </small>
      {else}
        <small class='text-success bg-success-pale'>{$lang->article->sourceList[$article->source]}</small>
      {/if}
    </div>
  </div>
</div>

<div class='panel-section article' id="blog{$article->id}" data-ve='blog'>
  {if($article->summary)}
    <section class='abstract hide bg-gray-pale small with-padding'><strong>{$lang->article->summary}</strong>{!echo $lang->colon . $article->summary}</section>
  {/if}
  <div class='panel-body'>
    <hr class="space">
    <section class='article-content'> {$article->content} </section>
  </div>
  {if(!empty($article->files))}
    <section class="article-files"> {$control->loadModel('file')->printFiles($article->files)} </section>
  {/if}
  <div class='panel-footer'>
    <div class='article-moreinfo hide clearfix'>
      {if($article->editor)} {$editor = $control->loadModel('user')->getByAccount($article->editor)} {/if}
      {if(!empty($editor))} <p class='text-right pull-right'>{!printf($lang->article->lblEditor, $editor->realname, formatTime($article->editedDate))}</p> {/if}
      {if($article->keywords)} <p class='small'><strong class="text-muted">{$lang->article->keywords}</strong><span class="article-keywords">{!echo $lang->colon . $article->keywords}</span></p> {/if}
    </div>
    {@extract($prevAndNext)}
    <ul class='pager pager-justify'>
      {if($prev)}
        <li class='previous'>{!html::a(inlink('view', "id=$prev->id", "category={{$category->alias}}&name={{$prev->alias}}"), '<i class="icon-arrow-left"></i> ' . $lang->article->previous, "title='{{$prev->title}}'")}</li>
      {else}
        <li class='previous disabled'><a href='###'><i class='icon-arrow-left'></i> {!print($lang->article->none)}</a></li>
      {/if}
      {if($next)}
        <li class='next'>{!html::a(inlink('view', "id=$next->id", "category={{$category->alias}}&name={{$next->alias}}"), $lang->article->next . ' <i class="icon-arrow-right"></i>', "title='{{$next->title}}'")}</li>
      {else}
        <li class='next disabled'><a href='###'>{!print($lang->article->none)}<i class='icon-arrow-right'></i></a></li>
      {/if}
    </ul>
  </div>
</div>

{if(commonModel::isAvailable('message'))}
  <div id='commentBox'>
    {$control->fetch('message', 'comment', "objectType=article&objectID={{$article->id}}")}
  </div>
{/if}

<div class='block-region region-bottom blocks' data-region='blog_view-bottom'>{$control->loadModel('block')->printRegion($layouts, 'blog_view', 'bottom')}</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'blog', 'footer')}

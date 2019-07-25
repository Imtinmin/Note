{if(!defined("RUN_MODE"))} {!die()} {/if}
{*
/**
 * The browse view file of article for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{$path = array_keys($category->pathNames)}
{!js::set('path', $path)}
{!js::set('categoryID', $category->id)}
{!js::set('pageLayout', $control->block->getLayoutScope('article_browse', $category->id))}
{if(isset($articleList))}
  <script>{!echo "place" . md5(time()). "='" . $config->idListPlaceHolder . $articleList . $config->idListPlaceHolder . "';"}</script>
{else}
  <script>{!echo "place" . md5(time()) . "='" . $config->idListPlaceHolder . '' . $config->idListPlaceHolder . "';"}</script>
{/if}
<div class='block-region blocks region-top' data-region='article_browse-top'>{$control->loadModel('block')->printRegion($layouts, 'article_browse', 'top')}</div>
<div class='panel panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'><strong>{$category->name}</strong></div>
  </div>
  <div class='cards condensed cards-list bordered' id='articles'>
    {foreach($articles as $article)}
      {$url = inlink('view', "id=$article->id", "category={{$article->category->alias}}&name=$article->alias")}
      <a class='card' href='{$url}' id="article{{$article->id}}" data-ve='article'>
        <div class='card-heading'>
          {if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')))}
            <div class='pull-right'>
              <small class='bg-danger-pale text-danger'>{$lang->article->stick}</small>
            </div>
          {/if}
          <h5 style='color:{$article->titleColor}'>{$article->title}</h5>
        </div>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-content text-muted small'>
              {!helper::substr($article->summary, 40, '...')}
              <div>
                <span title="{!echo $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder}"> <i class='icon-eye-open'></i> {!echo $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder} </span>
                {if(isset($article->comments))} &nbsp;&nbsp; <span title="{$lang->article->comments}"><i class='icon-comments-alt'></i> {$article->comments}</span> &nbsp; {/if}
                &nbsp;&nbsp; <span title="{$lang->article->addedDate}"><i class='icon-time'></i> {!substr($article->addedDate, 0, 10)}</span>
              </div>
            </div>
          </div>
          {if(!empty($article->image))}
            <div class='table-cell thumbnail-cell'>
              {$title = $article->image->primary->title ? $article->image->primary->title : $article->title}
              {$article->image->primary->objectType = 'article'}
              {!html::image($control->loadModel('file')->printFileURL($article->image->primary, 'smallURL'), "title='{{$title}}' class='thumbnail'")}
            </div>
          {/if}
        </div>
      </a>
    {/foreach}
  </div>
  <div class='panel-footer'>
    {$pager->show('justify')}
  </div>
</div>

<div class='block-region blocks region-bottom' data-region='article_browse-bottom'>{$control->loadModel('block')->printRegion($layouts, 'article_browse', 'bottom')}</div>

{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

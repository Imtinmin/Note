{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The blog index view file for mobile template of chanzhiEPS.
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
{if(!empty($category->id))} {!js::set('pageLayout', $control->block->getLayoutScope('blog_index', $category->id))} {/if}
{if(isset($articleIdList))}
  <script>{!echo "place" . md5(time()). "='" . $config->idListPlaceHolder . $articleIdList . $config->idListPlaceHolder . "';"}</script>
{else}
  <script>{!echo "place" . md5(time()) . "='" . $config->idListPlaceHolder . '' . $config->idListPlaceHolder . "';"}</script>
{/if}
<div class='block-region region-top blocks' data-region='blog_index-top'>{$control->loadModel('block')->printRegion($layouts, 'blog_index', 'top')}</div>
<hr class='space'>
<div class='panel panel-section'>
  <div class='cards condensed cards-list bordered' id='blogList'>
    {foreach($sticks as $stick)}
      {if(!isset($category))} {$category = array_shift($stick->categories)} {/if}
      {$url = inlink('view', "id=$stick->id", "category={{$category->alias}}&name=$stick->alias")}
      <a class='card' href='{$url}' id="blog{$stick->id}" data-ve='blog'>
        <div class='card-heading'>
          <div class='pull-right'>
            <small class='bg-danger-pale text-danger'>{$lang->article->stick}</small>
          </div>
          <h5 style='color:{$stick->titleColor}'>{$stick->title}</h5>
        </div>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-content text-muted small'>
              {$stick->summary}
              <div><span title="{$lang->article->views}"><i class='icon-eye-open'></i> {!echo $config->viewsPlaceholder . $stick->id . $config->viewsPlaceholder}</span>
                {if(commonModel::isAvailable('message') and isset($stick->comments) and $stick->comments)}&nbsp;&nbsp; <span title="{$lang->article->comments}"><i class='icon-comments-alt'></i> {$stick->comments}</span> &nbsp; {/if}
                &nbsp;&nbsp; <span title="{$lang->article->addedDate}"><i class='icon-time'></i> {!substr($stick->addedDate, 0, 10)}</span></div>
            </div>
          </div>
          {if(!empty($stick->image))}
            <div class='table-cell thumbnail-cell'>
              {$title = $stick->image->primary->title ? $stick->image->primary->title : $stick->title}
              {$stick->image->primary->objectType = 'article'}
              {!html::image($control->loadModel('file')->printFileURL($stick->image->primary, 'smallURL'), "title='{{$title}}' class='thumbnail'")}
            </div>
          {/if}
        </div>
      </a>
      {@unset($articles[$stick->id])}
    {/foreach}

    {foreach($articles as $article)}
      {if(!isset($category))} {$category = array_shift($article->categories)} {/if}
      {$url = inlink('view', "id=$article->id", "category={{$category->alias}}&name=$article->alias")}
      <a class='card' href='{$url}' id="blog{$article->id}" data-ve='blog'>
        <div class='card-heading'>
          <h5 style='color:{$article->titleColor}'>{$article->title}</h5>
        </div>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-content text-muted small'>
              {$article->summary}
              <div><span title="{$lang->article->views}"><i class='icon-eye-open'></i> {!echo $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder}</span>
                {if(commonModel::isAvailable('message') and $article->comments)} &nbsp;&nbsp; <span title="{$lang->article->comments}"><i class='icon-comments-alt'></i> {$article->comments}</span> &nbsp; {/if}
                &nbsp;&nbsp; <span title="{$lang->article->addedDate}"><i class='icon-time'></i>{!substr($article->addedDate, 0, 10)}</span></div>
            </div>
          </div>
          {if(!empty($article->image))}
            <div class='table-cell thumbnail-cell'>
              {$title = $article->image->primary->title ? $article->image->primary->title : $article->title}
              {$stick->image->primary->objectType = 'article'}
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

<div class='block-region region-bottom blocks' data-region='blog_index-bottom'>{$control->loadModel('block')->printRegion($layouts, 'blog_index', 'bottom')}</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'blog', 'footer')}

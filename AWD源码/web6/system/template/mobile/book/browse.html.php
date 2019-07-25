{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The browse view file of book for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{if(!empty($control->config->book->fullScreen) or $control->get->fullScreen)}
  {include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.lite')}
  {!js::set('fullScreen', 1)}
  {$bookModel = $control->loadModel('book')}
  <div class='fullScreen-book'>
    <div class='fullScreen-content panel'>
      <div class='fullScreen-inner'>
        <div class='panel-body'>
          <div class='dropdown selector'>
            <a data-toggle='dropdown' href='###' class='btn strong block primary text-left'><i class='icon icon-book'></i>
              {if(!empty($book) && $book->title)}
                {$book->title}
              {else}
                {$lang->book->list}
              {/if}
              <div class='pull-right'><i class='icon-caret-down pull-right'></i></div>
            </a>
            {if(!empty($books))}
              <ul class='dropdown-menu responsive'>
                <li class='dropdown-header'>{$lang->book->list}</li>
                {foreach($books as $menu)}
                  <li{!echo $menu->title == $book->title ? " class='active'" : ''}>{!html::a(inlink('browse', "bookID=$menu->id", "book=$menu->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : ''), '<i class="icon-book"></i> &nbsp;' . $menu->title)}</li>
                {/foreach}
              </ul>
            {/if}
          </div>
          {$orginsTree = $bookModel->getOriginsTree($node)}
          {if(!empty($orginsTree))}
            {foreach($orginsTree as $originTree)}
              <div class='dropdown selector'>
                <a href='###' data-toggle='dropdown' class='btn strong block default text-left'>
                  <i class='icon icon-list-ul'></i>
                  {$serials[$originTree->current->id]} {$originTree->current->title}
                  <div class='pull-right'><i class='icon-caret-down pull-right'></i></div>
                </a>
                <ul class='dropdown-menu responsive'>
                  {foreach($originTree->nodes as $nodeChild)}
                    {if($nodeChild->type != 'book')}    {$serial = $serials[$nodeChild->id]} {/if}
                    {if($nodeChild->type == 'chapter')} {$link = helper::createLink('book', 'browse', "nodeID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : '')} {/if}
                    {if($nodeChild->type == 'article')} {$link = helper::createLink('book', 'read', "articleID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : '')} {/if}
                    {$class =  $originTree->current->id === $nodeChild->id ? " class='active'" : ''}
                    <li {$class}> {!html::a($link, ($nodeChild->type == 'chapter' ? "<i class='icon icon-list-ul'></i>" : "<i class='icon icon-file-text-o'></i>") . " {{$serial}} &nbsp;{{$nodeChild->title}}")} </li>
                  {/foreach}
                </ul>
              </div>
            {/foreach}
          {/if}
          <hr class="space">
          <div class='list-group'>
            {foreach($bookModel->getChildren($node->id) as $nodeChild)}
              {if($nodeChild->type != 'book')} {$serial = $serials[$nodeChild->id]} {/if}
              {if($nodeChild->type == 'chapter')} {$link = helper::createLink('book', 'browse', "nodeID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : '')} {/if}
              {if($nodeChild->type == 'article')}  {$link = helper::createLink('book', 'read', "articleID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : '')} {/if}
              {!html::a($link, ($nodeChild->type == 'chapter' ? "<i class='icon icon-list-ul'></i>" : "<i class='icon icon-file-text-o'></i>") . " {{$serial}} &nbsp;{{$nodeChild->title}} <i class='pull-right icon-chevron-right'></i>", "class='list-group-item" . ($nodeChild->type == 'chapter' ? ' strong' : '') . "'")}
            {/foreach}
            {if(!$control->get->fullScreen)}
              <a href='/' class='btn block text-left default home'><i class='icon-home'></i> {$lang->book->goHome}</a>
            {/if}
          </div>
        </div>
      </div>
      <div class='block-region region-bottom blocks' data-region='book_browse-bottom'>{$control->loadModel('block')->printRegion($layouts, 'book_browse', 'bottom')}</div>
    </div>
  </div>
  {if(isset($pageJS))} {!js::execute($pageJS)} {/if}
  </body>
  </html>
{else}
  {include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
  {!js::set('fullScreen', 0)}
  {$bookModel = $control->loadModel('book')}
  <div class='block-region region-top blocks' data-region='book_browse-top'>{$control->loadModel('block')->printRegion($layouts, 'book_browse', 'top')}</div>
  <hr class='space'>
  <div class='panel-section panel' id='bookCatalog' data-id='{$node->id}'>
    <div class='panel-body'>
      <div class='dropdown selector'>
        <a data-toggle='dropdown' href='###' class='btn strong block primary text-left'>
          <i class='icon icon-book'></i>
          {!echo (!empty($book) && $book->title) ? $book->title : $lang->book->list}
          <div class='pull-right'><i class='icon-caret-down pull-right'></i></div>
        </a>
        {if(!empty($books))}
          <ul class='dropdown-menu responsive'>
            <li class='dropdown-header'>{$lang->book->list}</li>
            {foreach($books as $menu)}
              <li {!echo $menu->title == $book->title ? " class='active'" : ''}>
                {!html::a(inlink('browse', "bookID=$menu->id", "book=$menu->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : ''), '<i class="icon-book"></i> &nbsp;' . $menu->title)}
              </li>
            {/foreach}
          </ul>
        {/if}
      </div>
      {$orginsTree = $bookModel->getOriginsTree($node)}
      {if(!empty($orginsTree))}
        {foreach($orginsTree as $originTree)}
          <div class='dropdown selector'>
            <a href='###' data-toggle='dropdown' class='btn strong block default text-left'>
              <i class='icon icon-list-ul'></i>
              {$serials[$originTree->current->id]} {$originTree->current->title}
              <div class='pull-right'><i class='icon-caret-down pull-right'></i></div>
            </a>
            <ul class='dropdown-menu responsive'>
              {foreach($originTree->nodes as $nodeChild)}
                {if($nodeChild->type != 'book')} {$serial = $serials[$nodeChild->id]} {/if}
                {if($nodeChild->type == 'chapter')} {$link = helper::createLink('book', 'browse', "nodeID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : '')} {/if}
                {if($nodeChild->type == 'article')} {$link = helper::createLink('book', 'read', "articleID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : '')} {/if}
                {$class =  $originTree->current->id === $nodeChild->id ? " class='active'" : ''}
                <li {$class}> {!html::a($link, ($nodeChild->type == 'chapter' ? "<i class='icon icon-list-ul'></i>" : "<i class='icon icon-file-text-o'></i>") . " {{$serial}} &nbsp;{{$nodeChild->title}}")}</li>
              {/foreach}
            </ul>
          </div>
        {/foreach}
      {/if}
  
      <hr class="space">
      <div class='list-group'>
        {foreach($bookModel->getChildren($node->id) as $nodeChild)}
            {if($nodeChild->type != 'book')} {$serial = $serials[$nodeChild->id]} {/if}
            {if($nodeChild->type == 'chapter')} {$link = helper::createLink('book', 'browse', "nodeID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : '')} {/if}
            {if($nodeChild->type == 'article')} {$link = helper::createLink('book', 'read', "articleID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : '')} {/if}
            {!html::a($link, ($nodeChild->type == 'chapter' ? "<i class='icon icon-list-ul'></i>" : "<i class='icon icon-file-text-o'></i>") . " {{$serial}} &nbsp;{{$nodeChild->title}} <i class='pull-right icon-chevron-right'></i>", "class='list-group-item" . ($nodeChild->type == 'chapter' ? ' strong' : '') . "'")}
        {/foreach}
      </div>
    </div>
  </div>
  <div class='block-region region-bottom blocks' data-region='book_browse-bottom'>{$control->loadModel('block')->printRegion($layouts, 'book_browse', 'bottom')}</div>
  {include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
{/if}

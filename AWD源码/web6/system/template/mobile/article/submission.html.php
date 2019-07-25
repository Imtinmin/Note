{if(!defined("RUN_MODE"))} {!die()} {/if}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side')}
<div class='panel-section'>
  <div class='panel-heading'>
    <button type='button' class='btn primary block' data-toggle='modal' data-remote="{!inlink('post')}"><i class='icon-plus'></i> {$lang->article->post}</button>
  </div>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-envolope-alt'></i> {$lang->user->submission}</div>
  </div>
  <div class='cards condensed cards-list'>
    {foreach($articles as $article)}
      <div class='card' id="article{$article->id}" data-ve='article'>
        <div class='card-heading'>
          <div class='pull-right'>
            <small class='bg-danger-pale text-danger'>{$lang->submission->status[$article->submission]}</small>
          </div>
          <h5>
            {if($article->submission == 2)} {!html::a($control->article->createPreviewLink($article->id), $article->title, "target='_blank'")} {/if}
            {if($article->submission != 2)} {$article->title} {/if}
          </h5>
        </div>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-content'>
              <div class='pull-right'>
                {if($article->submission != 2)}
                  {!html::a(helper::createLink('article', 'modify', "articleID={{$article->id}}"), $lang->edit, "class='editor text-primary' data-toggle='modal'")}&nbsp;&nbsp;
                  {!html::a(helper::createLink('article', 'delete', "articleID={{$article->id}}"), $lang->delete, "class='deleter text-danger' data-locate='self'")}
                {else}
                  <a class='disabled'>{$lang->edit}</a>
                  <a class='disabled'>{$lang->delete}</a>
                {/if}
              </div>
              <div class='text-muted small'>
                <span title="{$lang->article->views}"><i class='icon-eye-open'></i> {$article->views}</span>
                &nbsp;&nbsp; <span title="{$lang->article->submissionTime}"><i class='icon-time'></i> {$article->editedDate}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    {/foreach}
  </div>
  <div class='panel-footer'>{$pager->show('justify')}</div>
</div>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

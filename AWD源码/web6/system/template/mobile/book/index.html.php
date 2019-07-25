{if(!defined("RUN_MODE"))} {!die()} {/if}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<div class='cards'>
  {foreach($books as $book)}
    <div class='col-xs-6 col-sm-4 col-md-3'>
      <div class='card book-card'>
        <h5 class='card-heading text-center'>{!html::a($control->createLink('book', 'browse', "nodeID=$book->id", "book=$book->alias") . ($control->get->fullScreen ? "?fullScreen={{$control->get->fullScreen}}" : ''), $book->title)}</h5>
        <div class='card-content text-muted'>{$book->summary}</div>
        <div class='card-actions'>
          <span class='text-muted'><i class='icon-user'></i> {$book->author}</span>
          <span class='text-muted'><i class='icon-time'></i> {$book->addedDate}</span>
        </div>
      </div>
    </div>
  {/foreach}
</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

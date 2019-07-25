<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>



<?php echo die(); ?>

<?php } ?>

<?php $tpl = new RainTPL;$tpl->assign($this->var);$tpl->draw($control->loadModel('ui')->getEffectViewFile('default', 'common', 'header'));?>



<?php $path=$this->var['path']=array_keys($category->pathNames);?>



<?php echo js::set('path', $path); ?>



<?php echo js::set('categoryID', $category->id); ?>



<?php echo js::set('pageLayout', $control->block->getLayoutScope('article_browse', $category->id)); ?>



<?php echo $common->printPositionBar($category);?>



<?php if(isset($articleList)){ ?>



  <script><?php echo "place" . md5(time()). "='" . $config->idListPlaceHolder . $articleList . $config->idListPlaceHolder . "';"; ?></script>
<?php }else{ ?>

  <script><?php echo "place" . md5(time()) . "='" . $config->idListPlaceHolder . '' . $config->idListPlaceHolder . "';"; ?></script>
<?php } ?>

<div class='row blocks' data-region='article_browse-topBanner'><?php echo $control->block->printRegion($layouts, 'article_browse', 'topBanner', true);?>


</div>
<div class='row' id='columns' data-page='article_browse'>
  <?php if(!empty($layouts['article_browse']['side']) and !empty($sideFloat) && $sideFloat != 'hidden'){ ?>



  <div class="col-md-<?php echo 12 - $sideGrid; ?> col-main<?php echo ($sideFloat === 'left') ? ' pull-right' : '' ; ?>" id="mainContainer">
  <?php }else{ ?>

  <div class="col-md-12" id="mainContainer">
  <?php } ?>

    <div class='list list-condensed' id='articleList'>
    <div class='row blocks' data-region='article_browse-top'><?php echo $control->block->printRegion($layouts, 'article_browse', 'top', true);?>


</div>
      <header id='articleHeader'>
        <h2><?php echo $category->name;?></h2>
        <div class='header'><?php echo html::a('javascript:;', $lang->article->orderBy->time, "data-field='addedDate' class='addedDate setOrder'"); ?>


</div>
        <div class='header'><?php echo html::a('javascript:;', $lang->article->orderBy->hot, "data-field='views' class='views setOrder'"); ?>


</div>
      </header>
      <section class='items items-hover' id='articles'>
        <?php foreach($articles as $article): ?>



          <?php $stick=$this->var['stick'] = isset($sticks[$article->id]) ? true : false;?>

          <?php $url=$this->var['url'] = inlink('view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");?>



          <div class='item' id="article<?php echo $article->id;?>" data-ve='article'>
            <?php if(!empty($article->image)){ ?>



              <?php $pull=$this->var['pull']     = (isset($control->config->article->imagePosition) and $control->config->article->imagePosition == 'left') ? 'pull-left' : 'pull-right';?>

              <?php $imageURL=$this->var['imageURL'] = !empty($control->config->article->imageSize) ? $control->config->article->imageSize . 'URL' : 'smallURL';?>

              <div class='media <?php echo $pull;?>'>
                <?php $maxWidth=$this->var['maxWidth'] = !empty($control->config->article->imageWidth) ? $control->config->article->imageWidth . 'px' : '120px';?>

                <?php $title=$this->var['title']    = $article->image->primary->title ? $article->image->primary->title : $article->title;?>

                <?php $article->image->primary->objectType = 'article';$this->var['article'] = $article;?>

                <?php echo html::a($url, html::image($control->loadModel('file')->printFileURL($article->image->primary, 'smallURL'), "title='$title' style='max-width:$maxWidth' class='thumbnail'")); ?>



              </div>
            <?php } ?>

            <div class='item-heading'>
              <div class="text-muted pull-right">
                <span title="<?php echo $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder; ?>"><i class='icon-eye-open'></i> <?php echo $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder; ?></span> &nbsp;
                <?php if(commonModel::isAvailable('message') and $article->comments){ ?>


<span title="<?php echo $lang->article->comments;?>"><i class='icon-comments-alt'></i> <?php echo $article->comments;?></span> &nbsp;<?php } ?>

                <span title="<?php echo $lang->article->addedDate;?>"><i class='icon-time'></i> <?php echo substr($article->addedDate, 0, 10); ?>


</span>
              </div>
              <h4>
                <?php echo empty($article->titleColor) ? html::a($url, $article->title) : html::a($url, $article->title, "style='color:$article->titleColor;'"); ?>



                <?php if($stick){ ?>


<span class='label label-danger'><?php echo $lang->article->stick;?></span><?php } ?>

              </h4>
            </div>
            <div class='item-content'>
              <div class='text text-muted'><?php echo helper::substr($article->summary, 120, '...'); ?>


</div>
            </div>
          </div>
        <?php endforeach; ?>

      </section>
      <footer class='clearfix'><?php echo $pager->show('right', 'short');?>


</footer>
    </div>
    <div class='row blocks' data-region='article_browse-bottom'><?php echo $control->block->printRegion($layouts, 'article_browse', 'bottom', true);?>


</div>
  </div>
  <?php if(!empty($layouts['article_browse']['side']) and !(empty($sideFloat) || $sideFloat === 'hidden')){ ?>



    <div class='col-md-<?php echo $sideGrid ;?> col-side'><side class='page-side blocks' data-region='article_browse-side'><?php echo $control->block->printRegion($layouts, 'article_browse', 'side');?>


</side></div>
  <?php } ?>

</div>
<div class='row blocks' data-region='article_browse-bottomBanner'><?php echo $control->block->printRegion($layouts, 'article_browse', 'bottomBanner', true);?>


</div>
<?php $tpl = new RainTPL;$tpl->assign($this->var);$tpl->draw($control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'));?>




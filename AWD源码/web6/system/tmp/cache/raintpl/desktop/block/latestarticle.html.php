<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>




<?php echo die(); ?>

<?php } ?>


<?php $themeRoot=$this->var['themeRoot'] = $model->config->webRoot . 'theme/';?>


<?php $content=$this->var['content']  = json_decode($block->content);?>




<?php $method=$this->var['method']   = 'get' . ucfirst(str_replace('article', '', strtolower($block->type)));?>




<?php $articles=$this->var['articles'] = $model->loadModel('article')->$method(empty($content->category) ? 0 : $content->category, !empty($content->limit) ? $content->limit : 6);?>




<?php if(isset($content->image)){ ?>




<?php $articles=$this->var['articles'] = $model->loadModel('file')->processImages($articles, 'article');?>

<?php } ?>

<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title; ?></strong>
    <?php if(isset($content->moreText) and isset($content->moreUrl)){ ?>




      <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText); ?>



</div>
    <?php } ?>

  </div>
  <?php if(isset($content->image)){ ?>




    <?php $pull=$this->var['pull']     = $content->imagePosition == 'right' ? 'pull-right' : 'pull-left';?>

    <?php $imageURL=$this->var['imageURL'] = !empty($content->imageSize) ? $content->imageSize . 'URL' : 'smallURL';?>

    <div class='panel-body'>
      <div class='items'>
      <?php foreach($articles as $article): ?>




        <?php $url=$this->var['url'] = helper::createLink('article', 'view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");?>




        <div class='item'>
          <div class='item-heading'>
            <?php $blod=$this->var['blod'] = '';?>

            <?php if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')) and $article->stickBold){ ?>




            <?php $blod=$this->var['blod'] = 'font-weight:bold;';?>

<?php } ?>

            <?php if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s'))){ ?>



 <span class='red'><i class="icon icon-arrow-up"></i></span><?php } ?>

            <?php if(isset($content->showCategory) and $content->showCategory == 1){ ?>




              <?php if($content->categoryName == 'abbr'){ ?>




                <?php $blockContent=$this->var['blockContent']    = json_decode($block->content);?>




                <?php $blockCategories=$this->var['blockCategories'] = '';?>

                <?php if(isset($blockContent->category)){ ?>



 <?php $blockCategories=$this->var['blockCategories'] = $blockContent->category;?>

<?php } ?>

         
                <?php $categoryName=$this->var['categoryName'] = $article->category->name;?>

                <?php foreach($article->categories as $id => $category): ?>




                  <?php if(strpos(",$blockCategories,", ",$id,") !== false){ ?>




                    <?php $categoryName=$this->var['categoryName'] = $category->name;?>

                    <?php break; ?>

<?php } ?>

                <?php endforeach; ?>

       
                <?php $categoryName=$this->var['categoryName'] = '[' . ($article->category->abbr ? $article->category->abbr : $categoryName) . '] ';?>

                <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName); ?>




              <?php }else{ ?>

                <?php echo '[' . $article->category->name . '] '; ?>

<?php } ?>

<?php } ?>

            <strong><?php echo html::a($url, $article->title, "style='color: {$article->titleColor}'"); ?>



</strong>
          </div>
          <div class='item-content'>
            
            <div class='text small text-muted'>
              <div class='media <?php echo $pull;?>' style="max-width: <?php echo !empty($content->imageWidth) ? $content->imageWidth . 'px' : '100px'; ?>">
              <?php if(!empty($article->image)){ ?>




                <?php $title=$this->var['title'] = $article->image->primary->title ? $article->image->primary->title : $article->title;?>

                <?php $article->image->primary->objectType = 'article';$this->var['article'] = $article;?>

                <?php echo html::a($url, html::image($model->loadModel('file')->printFileURL($article->image->primary, $imageURL), "title='$title' class='thumbnail'" )); ?>

<?php } ?>

              </div>
              <strong class='text-important text-nowrap'>
                <?php if(isset($content->time)){ ?>



 <i class='icon-time'></i> <?php echo formatTime($article->addedDate, DT_DATE4); ?>

<?php } ?>

              </strong> 
              <?php echo $article->summary;?>

            </div>
          </div>
        </div>
      <?php endforeach; ?>

      </div>
    </div>
  <?php }else{ ?>

    <div class='panel-body'>
      <ul class='ul-list'>
        <?php foreach($articles as $article): ?>




          <?php $categoryAlias=$this->var['categoryAlias'] = isset($article->category->alias) ? $article->category->alias : '';?>

          <?php $alias=$this->var['alias']         = "category={$categoryAlias}&name={$article->alias}";?>

          <?php $url=$this->var['url']           = helper::createLink('article', 'view', "id=$article->id", $alias);?>




          <?php if(isset($content->time)){ ?>




            <li class='addDataList'>
              <span class='article-list'>
                <?php if(isset($content->showCategory) and $content->showCategory == 1){ ?>




                  <span class='pull-left category'>
                  <?php if($content->categoryName == 'abbr'){ ?>




                    <?php $blockContent=$this->var['blockContent']    = json_decode($block->content);?>




                    <?php $blockCategories=$this->var['blockCategories'] = '';?>

                    <?php if(isset($blockContent->category)){ ?>



 <?php $blockCategories=$this->var['blockCategories'] = $blockContent->category;?>

<?php } ?>

                    <?php $categoryName=$this->var['categoryName'] = '';?>

                    <?php foreach($article->categories as $id => $categorie): ?>




                      <?php if(strpos(",$blockCategories,", ",$id,") !== false){ ?>




                        <?php $categoryName=$this->var['categoryName'] = $categorie->name;?> <?php break; ?>

<?php } ?>

                    <?php endforeach; ?>

                    <?php $categoryName=$this->var['categoryName'] = '[' . ($article->category->abbr ? $article->category->abbr : $categoryName) . '] ';?>

                    <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$categoryAlias}"), $categoryName); ?>




                  <?php }else{ ?>

                    <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] '); ?>

<?php } ?>

                  </span>
                <?php } ?>


                <?php $bold=$this->var['bold'] = '';?>

                <?php if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')) and $article->stickBold){ ?>




                <?php $bold=$this->var['bold'] = 'font-weight:bold;';?>

<?php } ?>

                <?php echo html::a($url, $article->title, "title='{$article->title}' class='articleTitleA text-nowrap text-ellipsis pull-left' style='{$bold}color:{$article->titleColor}'"); ?>




                <span class='pull-left sticky'><?php if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s'))){ ?>



<span class='red'><i class="icon icon-arrow-up"></i></span><?php } ?></span>
              </span>
              <span class='pull-right article-date'><?php echo substr($article->addedDate, 0, 10); ?>



</span>
            </li>
          <?php }else{ ?>

            <li class='notDataList'>
              <?php if(isset($content->showCategory) and $content->showCategory == 1){ ?>




                <span class='pull-left category'>
                <?php if($content->categoryName == 'abbr'){ ?>




                  <?php $blockCntent=$this->var['blockCntent']     = json_decode($block->content);?>




                  <?php $blockCategories=$this->var['blockCategories'] = '';?>

                  <?php if(isset($blockCntent->category)){ ?>



 <?php $blockCategories=$this->var['blockCategories'] = $blockCntent->category;?>

<?php } ?>

                  <?php $categoryName=$this->var['categoryName'] = '';?>

                  <?php foreach($article->categories as $id => $categorie): ?>




                    <?php if(strpos(",$blockCategories,", ",$id,") !== false){ ?>




                      <?php $categoryName=$this->var['categoryName'] = $categorie->name;?> <?php break; ?>

<?php } ?>

                  <?php endforeach; ?>

                  <?php $categoryName=$this->var['categoryName'] = '[' . ($article->category->abbr ? $article->category->abbr : $categoryName) . '] ';?>

                  <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName); ?>




                <?php }else{ ?>

                  <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] '); ?>

<?php } ?>

                </span>
              <?php } ?>


              <?php $bold=$this->var['bold'] = '';?>

              <?php if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')) and $article->stickBold){ ?>



<?php $bold=$this->var['bold'] = 'font-weight:bold;';?>

<?php } ?>

              <?php echo html::a($url, $article->title, "title='{$article->title}' class='articleTitleB text-nowrap text-ellipsis pull-left' style='{$bold}color:{$article->titleColor}'"); ?>




              <span class='pull-left sticky'><?php if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s'))){ ?>



<span class='red'><i class="icon icon-arrow-up"></i></span><?php } ?></span>
            </li>
          <?php } ?>

        <?php endforeach; ?>

      </ul>
    </div>
  <?php } ?>

</div>

<style>
.ul-list .addDataList.withStick{padding-right:126px !important;}
.ul-list .addDataList.withoutStick{padding-right:80px !important;}
.ul-list .notDataList.withStick{padding-right:60px !important;}
.ul-list .notDataList.withoutStick{padding-right:5px !important;}
.articleTitleA{display:inline-block;}
.articleTitleB{display:inline-block;}
.sticky{padding-left: 5px;}
</style>
<script>

var currentBlockID = <?php echo $block->id;?>;


if(typeof($('#block' + currentBlockID).parent('.col').data('grid')) === 'undefined')
{
    var grid = $('#block' + currentBlockID).parents('.blocks').data('grid');
    grid = typeof(grid) == 'undefined' ? 12 : grid;

    $('#block' + currentBlockID).parent('.col').attr('data-grid', grid).attr('class', 'col col-' + grid);
}

$('.articleTitleA').each(function()
{
    $(this).css('max-width', $(this).parents('li').width() - $(this).prev('.category').width() - $(this).next('.sticky').width() - $(this).parent().next('.article-date').width() - 10);
})
$('.articleTitleB').each(function()
{
    $(this).css('max-width', $(this).parent('li').width() - $(this).next('.sticky').width() - 10);
})
</script>


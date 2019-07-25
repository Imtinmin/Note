<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>


<?php $block->content  = json_decode($block->content);$this->var['block'] = $block;?>

<?php $type=$this->var['type']            = str_replace('tree', '', strtolower($block->type));?>

<?php $browseLink=$this->var['browseLink']      = $type == 'article' ? 'createBrowseLink' : 'create' . ucfirst($type) . 'BrowseLink';?>

<?php $startCategory=$this->var['startCategory'] = 0;?>

<?php if(isset($block->content->fromCurrent) and $block->content->fromCurrent){ ?>

  <?php if($type == 'article' and $app->getModuleName() == 'article' and $model->session->articleCategory){ ?>

    <?php $category=$this->var['category'] = $model->loadModel('tree')->getByID($model->session->articleCategory);?>

    <?php $startCategory=$this->var['startCategory'] = $category->parent;?>

<?php } ?>

  <?php if($type == 'blog' and $app->getModuleName() == 'blog' and $model->session->blogCategory){ ?>

    <?php $category=$this->var['category'] = $model->loadModel('tree')->getByID($model->session->blogCategory);?>

    <?php $startCategory=$this->var['startCategory'] = $category->parent;?>

<?php } ?>

  <?php if($type == 'product' and $app->getModuleName() == 'product' and $model->session->productCategory){ ?>

    <?php $category=$this->var['category'] = $model->loadModel('tree')->getByID($model->session->productCategory);?>

    <?php $startCategory=$this->var['startCategory'] = $category->parent;?>

<?php } ?>

<?php } ?>

<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title; ?></strong>
  </div>
  <div class='panel-body'>
    <?php if($block->content->showChildren){ ?>

    <?php $treeMenu=$this->var['treeMenu'] = $model->loadModel('tree')->getTreeMenu($type, $startCategory, array('treeModel', $browseLink), zget($block->content, 'initialExpand', 1));?>

    <?php echo $treeMenu;?>

    <?php }else{ ?>

    <?php $topCategories=$this->var['topCategories'] = $model->loadModel('tree')->getChildren($startCategory, $type);?>

    <ul class='nav nav-secondary nav-stacked'>
      <?php foreach($topCategories as $topCategory): ?>

        <?php $browseLink=$this->var['browseLink'] = helper::createLink($type, 'browse', "categoryID={$topCategory->id}", "category={$topCategory->alias}");?>

        <?php if($type == 'blog'){ ?>

<?php $browseLink=$this->var['browseLink'] = helper::createLink('blog', 'index', "categoryID={$topCategory->id}", "category={$topCategory->alias}");?>

<?php } ?>

        <li><?php echo html::a($browseLink, "<i class='icon-folder-close-alt '></i> &nbsp;" . $topCategory->name, "id='category{$topCategory->id}'"); ?></li>
      <?php endforeach; ?>

    </ul>
    <?php } ?>

  </div>
</div>
<script>
$(document).ready(function()
{
    $('.tree .list-toggle').mousedown(function(){$(this).parents('.panel-block').height('auto');})
    $('.row.blocks .tree').resize(function(){$(this).parents('.row.blocks').tidy({force: true});})
})
</script>

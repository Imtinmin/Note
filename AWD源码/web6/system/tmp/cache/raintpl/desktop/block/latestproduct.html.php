<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>


<?php $content=$this->var['content']  = json_decode($block->content);?>

<?php $type=$this->var['type']     = str_replace('product', '', strtolower($block->type));?>

<?php $method=$this->var['method']   = 'get' . $type;?>

<?php if(empty($content->category)){ ?>

<?php $content->category = 0;$this->var['content'] = $content;?>

<?php } ?>

<?php if(empty($content->limit)){ ?>

<?php $content->limit = 6;$this->var['content'] = $content;?>

<?php } ?>

<?php $image=$this->var['image'] = isset($content->image) ? true : false;?>

<?php $products=$this->var['products'] = $model->loadModel('product')->$method($content->category, $content->limit, $image);?>

<div id="block<?php echo $block->id; ?>" class="panel-cards panel panel-block <?php echo $blockClass; ?>">
  <div class='panel-heading'>
    <strong><?php echo $icon; ?> <?php echo $block->title; ?></strong>
    <?php if(isset($content->moreText) and isset($content->moreUrl)){ ?>

    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText); ?></div>
    <?php } ?>

  </div>
   <?php if(isset($content->image)){ ?>

     <?php $tpl = new RainTPL;$tpl->assign($this->var);$tpl->draw(TPL_ROOT . 'block' . DS . 'latestproduct.image.html.php');?>

   <?php }else{ ?>

     <?php $tpl = new RainTPL;$tpl->assign($this->var);$tpl->draw(TPL_ROOT . 'block' . DS . 'latestproduct.noimage.html.php');?>

<?php } ?>

</div>

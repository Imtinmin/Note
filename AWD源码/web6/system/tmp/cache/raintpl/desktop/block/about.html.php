<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>


<?php $block->content = json_decode($block->content);$this->var['block'] = $block;?>


<div id="block<?php echo $block->id; ?>" class='panel panel-block <?php echo $blockClass; ?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title; ?></strong>
    <?php if(!empty($block->content->moreText) and !empty($block->content->moreUrl)){ ?>

      <div class='pull-right'><?php echo html::a($block->content->moreUrl, $block->content->moreText); ?></div>
    <?php } ?>

  </div>
  <div class='panel-body'>
    <div id='companyDesc<?php echo $block->id; ?>' data-ve='companyDesc'><?php echo $config->company->desc; ?></div>
  </div>
</div>

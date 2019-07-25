<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>


<?php if($app->getModuleName() != 'links' and !empty($config->links->index)){ ?>

<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><i class='icon'><?php echo $icon;?></i><?php echo $block->title;?></strong>
    <div class='pull-right'>
      <?php if(trim(strip_tags($config->links->all, '<a>'))){ ?>

        <?php echo html::a(helper::createLink('links', 'index'), $lang->more); ?>

<?php } ?>

    </div>
  </div>
  <div class='panel-body'>
    <div id='links<?php echo $block->id;?>' data-ve='links'><?php echo $config->links->index;?></div>
  </div>
</div>
<?php } ?>


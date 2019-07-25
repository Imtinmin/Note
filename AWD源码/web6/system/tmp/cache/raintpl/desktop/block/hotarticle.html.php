<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>


<?php $tpl = new RainTPL;$tpl->assign($this->var);$tpl->draw($model->loadModel('ui')->getEffectViewFile('default', 'block', 'latestarticle'));?>


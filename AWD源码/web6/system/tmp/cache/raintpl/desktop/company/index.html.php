<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>


<?php echo die(); ?>

<?php } ?>

<?php $tpl = new RainTPL;$tpl->assign($this->var);$tpl->draw($control->loadModel('ui')->getEffectViewFile('default', 'common', 'header'));?>


<?php echo $common->printPositionBar($control->app->getModuleName());?>


<div class='row blocks' data-region='company_index-topBanner'><?php echo $control->block->printRegion($layouts, 'company_index', 'topBanner', true);?>

</div>
<div class='row' id='columns' data-page='company_index'>
  <?php if(!empty($layouts['company_index']['side']) and !empty($sideFloat) && $sideFloat != 'hidden'){ ?>


  <div class="col-md-<?php echo 12 - $sideGrid; ?> col-main <?php if($sideFloat === 'left'){ ?>

 pull-right <?php } ?>">
  <?php }else{ ?>

  <div class="col-md-12">
  <?php } ?>

    <div class='row blocks' data-region='company_index-top'><?php echo $control->block->printRegion($layouts, 'company_index', 'top', true);?>

</div>
    <div class='panel' id='company'>
      <div class='panel-heading'><strong><i class='icon-group'></i> <?php echo $lang->aboutUs;?></strong></div>
      <div class="panel-body">
        <div class='article-content'>
          <?php echo $company->content;?>

        </div>
      </div>
    </div>
    <div class='row blocks' data-region='company_index-bottom'><?php echo $control->block->printRegion($layouts, 'company_index', 'bottom', true);?>

</div>
  </div>
  <?php if(!empty($layouts['company_index']['side']) and !(empty($sideFloat) || $sideFloat === 'hidden')){ ?>


  <div class='col-md-<?php echo $sideGrid; ?> col-side'><side class='page-side blocks' data-region='company_index-side'><?php echo $control->block->printRegion($layouts, 'company_index', 'side');?>

</side></div>
  <?php } ?>

</div>
<div class='row blocks' data-region='company_index-bottomBanner'><?php echo $control->block->printRegion($layouts, 'company_index', 'bottomBanner', true);?>

</div>
<?php $tpl = new RainTPL;$tpl->assign($this->var);$tpl->draw($control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'));?>



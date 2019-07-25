<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The browse view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong class='pull-left text-danger'> <?php printf($lang->block->currentLayout, $plans[$plan]);?> </strong> &nbsp;
    <ul class='pull-left'>
      <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <?php echo $lang->block->switchPlan;?> <i class="icon icon-chevron-down"></i>
        </a>
        <ul class="dropdown-menu layout-menu">
          <?php foreach($plans as $planID => $name):?>
          <li<?php if($plan == $planID) echo " class='active'";?>>
            <?php echo html::a(inlink('switchlayout', "plan={$planID}"), $name);?>
            <div class='actions'>
              <?php if($planID) echo html::a(inlink('renamelayout',   "plan={$planID}"), "<i class='icon icon-pencil'></i>", "data-toggle='modal'");?>
              <?php if($planID) echo html::a(inlink('removelayout',   "plan={$planID}"), "<i class='icon icon-remove'></i>", "class='deleter'");?>
            </div>
          </li>
          <?php endforeach;?>
        </ul>
      </li>
    </ul>
    <div class='panel-actions'>
      <?php if($plan != 0) echo html::a(inlink('renamelayout', "plan={$plan}"), $lang->block->renameLayout, "class='btn btn-sm btn-default' data-toggle='modal'");?>
      <?php echo html::a(inlink('clonelayout', "plan={$plan}"), $lang->block->cloneLayout, "class='btn btn-primary' data-toggle='modal'");?>
    </div>
  </div>
  <table class='table' style='margin-top:10px;'>
    <tr>
      <?php $i = 0;?>
      <?php foreach($config->block->pageGroupList as $group => $pageList):?>
      <?php ++$i;?>
      <?php $j = 0;?>
      <td class='w-p25'>
        <?php foreach($pageList as $page):?>
        <div class='panel page-panel'>
          <div class='label label-badge label-<?php echo $group;?>'><?php echo $i . '.' . ++$j;?></div>
          <div class='text-center text-important page-name'><?php echo $lang->block->{$template}->pages[$page];?></div>
          <div class='panel-body text-center'>
            <?php foreach($lang->block->{$template}->regions->{$page} as $region => $regionName):?>
            <?php commonModel::printLink('block', 'setregion', "page={$page}&region=$region", $regionName, "class='btn-region' data-toggle='modal'");?>
            <?php endforeach;?>
          </div>
        </div>
        <?php endforeach;?>
      </td>
      <?php endforeach;?>
    </tr>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>

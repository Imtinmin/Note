<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>


<?php $block->content = json_decode($block->content);$this->var['block'] = $block;?>

<?php $publicList=$this->var['publicList'] = $model->loadModel('wechat')->getList();?>

<?php if(!empty($publicList)){ ?>

<div id="block<?php echo $block->id; ?>" class='panel panel-block hidden-sm hidden-xs <?php echo $blockClass; ?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title; ?></strong>
    <?php if(!empty($block->content->moreText) and !empty($block->content->moreUrl)){ ?>

    <div class='pull-right'><?php echo html::a($block->content->moreUrl, $block->content->moreText); ?></div>
    <?php } ?>

  </div>
  <table class='w-p100'>
    <?php foreach($publicList as $public): ?>

    <?php if(!$public->qrcode){ ?>

<?php continue; ?>

<?php } ?>

    <tr class='text-center'>
      <td class='wechat-block'>
        <div class='name'><i class='icon-weixin'>&nbsp;</i><?php echo $public->name; ?></div>
        <div class='qrcode'><?php echo html::image($public->qrcode, "class='w-220px'"); ?></div>
      </td>
    </tr>
    <?php endforeach; ?>

  </table>
</div>
<?php } ?>


<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>



<?php $block->content = json_decode($block->content);$this->var['block'] = $block;?>

<?php $contact=$this->var['contact'] = $model->loadModel('company')->getContact();?>


<div id="block<?php echo $block->id; ?>" class='panel-block-contact panel panel-block <?php echo $blockClass; ?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title; ?></strong>
    <?php if(!empty($block->content->moreText) and !empty($block->content->moreUrl)){ ?>

    <div class='pull-right'><?php echo html::a($block->content->moreUrl, $block->content->moreText); ?></div>
    <?php } ?>

  </div>
  <div class='panel-body'>
    <div id='companyContact<?php echo $block->id; ?>' data-ve='companyContact'>
      <table class='table table-data'>
        <?php foreach($contact as $item => $value): ?>

        <tr>
          <th><?php echo $lang->company->$item . $lang->colon; ?></th>
          <td><?php echo $value; ?></td>
        </tr>
        <?php endforeach; ?>

      </table>
    </div>
  </div>
</div>

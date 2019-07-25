<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>


<form id='createForm' action='<?php echo inlink('create'); ?>' method='post'>
  <table class='table table-borderless address-form table-list'>
    <tr>
      <td class='w-100px'><?php echo html::input('contact', '', "class='form-control' placeholder='{$lang->address->contact}'"); ?></td>
      <td class='w-130px'><?php echo html::input('phone', '', "class='form-control' placeholder='{$lang->address->phone}'"); ?></td>
      <td><?php echo html::input('address', '', "class='form-control' placeholder='{$lang->address->address}'"); ?></td>
      <td class='w-100px'><?php echo html::input('zipcode', '', "class='form-control' placeholder='{$lang->address->zipcode}'"); ?></td>
      <td class='w-50px'><?php echo html::submitButton(); ?></td>
    </tr>
  </table>
</form>

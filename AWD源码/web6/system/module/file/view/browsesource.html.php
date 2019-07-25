<?php if(!defined("RUN_MODE")) die();?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::import($jsRoot . 'zeroclipboard/zeroclipboard.min.js');?>
<?php js::set('copySuccess', $lang->file->copySuccess);?>
<?php js::set('noFlashTip', $lang->file->noFlashTip);?>
<div class='panel'>
  <div class='panel-heading'>
    <?php echo $lang->file->sourceList?>
    <span class='panel-actions'>
      <div class="btn-group">
        <?php echo html::a('javascript:void(0)', "<i class='icon icon-th-large'></i>", "class='image-view active btn'")?>
        <?php echo html::a('javascript:void(0)', "<i class='icon icon-list'></i>", "class='list-view btn'")?>
      </div>
      <?php $template = $this->config->template->{$this->app->clientDevice}->name;?>
      <?php $theme    = $this->config->template->{$this->app->clientDevice}->theme;?>
      <?php commonModel::printLink('file', 'browse', "objectType=source&objectID={$template}_{$theme}", $lang->file->uploadSource, "data-toggle='modal' class='btn btn-primary'");?>
    </span>
  </div>
  <div id='imageView' class='panel-body'>
    <ul class='files-list clearfix'>
    <?php foreach($files as $file):?>
        <?php
        $imageHtml = '';
        $fileHtml  = '';
        $fullURL   = html::input('', $file->fullURL, "size='" . strlen($file->fullURL) . "' style='border:none; background:none;' onmouseover='this.select()'");
        $imagePath = $this->file->printFileURL($file);
        if($file->isImage)
        {
            $imageHtml .= "<li class='file-image file-{$file->extension}'>";
            $imageHtml .= html::a(helper::createLink('file', 'download', "fileID=$file->id&mose=left"), html::image($imagePath), "target='_blank' data-toggle='lightbox'");
            $imageHtml .= "<div class='file-source'><div class='input-group'><input disabled='disabled' id='fullURL{$file->id}' type='text' value='{$imagePath}' class='form-control file-url'/><span class='input-group-btn'><button class='copyBtn btn' data-clipboard-target='fullURL{$file->id}'>{$lang->copy}</button></span></div></div>";
            $imageHtml .= "<div class='file-actions'>";
            $imageHtml .= html::a(helper::createLink('file', 'deletesource', "id=$file->id"), "<i class='icon-trash'></i>", "class='deleter'");
            $imageHtml .= html::a(helper::createLink('file', 'editsource', "id=$file->id"), "<i class='icon-pencil'></i>", "data-toggle='modal' data-title='{$lang->file->editSource}'");
            $imageHtml .= '</div>';
            $imageHtml .= '</li>';
        }
        else
        {
            $file->title = $file->title . ".$file->extension";
            $fileHtml .= "<li class='file file-{$file->extension}'>";
            $fileHtml .= html::a(helper::createLink('file', 'download', "fileID=$file->id&mouse=left"), $file->title, "target='_blank'");
            $fileHtml .= "<div class='file-source'><div class='input-group'><input disabled='disabled' id='fullURL{$file->id}' type='text' value='{$imagePath}' class='form-control file-url'/><span class='input-group-btn'><button class='copyBtn btn' data-clipboard-target='fullURL{$file->id}'>{$lang->copy}</button></span></div></div>";
            $fileHtml .= "<span class='file-actions'>";
            $fileHtml .= html::a(helper::createLink('file', 'deletesource', "id=$file->id"), "<i class='icon-trash'></i>", "class='deleter'");
            $fileHtml .= html::a(helper::createLink('file', 'editsource', "id=$file->id"), "<i class='icon-edit'></i>", "data-toggle='modal' data-title='{$lang->file->editSource}'");
            $fileHtml .= '</span>';
            $fileHtml .= '</li>';
        }
        if($imageHtml or $fileHtml) echo $imageHtml . $fileHtml;
        ?>
    <?php endforeach;?>          
    </ul>
    <div class='clearfix'><?php $pager->show();?></div>
  </div>
  <div id='listView' class='hide'>
    <table class='table table-bordered'>
      <thead>
        <tr class='text-center'>
          <th class=' w-60px'><?php echo $lang->file->id;?></th>
          <th><?php echo $lang->file->source;?></th>
          <th><?php echo $lang->file->sourceURI;?></th>
          <th class='w-60px'><?php echo $lang->file->extension;?></th>
          <th class='w-80px'><?php echo $lang->file->size;?></th>
          <th class='w-100px'><?php echo $lang->file->addedBy;?></th>
          <th class='w-160px'><?php echo $lang->file->addedDate;?></th>
          <th class='w-80px'><?php echo $lang->actions;?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($files as $file):?>
        <tr class='text-center text-middle'>
          <td><?php echo $file->id;?></td>
          <td>
            <?php
            if($file->isImage)
            {
                echo html::a(inlink('download', "id=$file->id"), html::image($this->file->printFileURL($file, 'smallURL'), "class='image-small' title='{$file->title}'"), "data-toggle='lightbox' target='_blank'");
            }
            else
            {
                echo html::a(inlink('download', "id=$file->id"), $file->title, "target='_blank'");
            }
            ?>
          </td>
          <td class='text-left'><?php echo $this->file->printFileURL($file);?></td>
          <td><?php echo $file->extension;?></td>
          <td><?php echo number_format($file->size / 1024 , 1) . 'K';?></td>
          <td><?php echo isset($users[$file->addedBy]) ? $users[$file->addedBy] : '';?></td>
          <td><?php echo $file->addedDate;?></td>
          <td class='text-center'>
            <?php
            commonModel::printLink('file', 'editsource',   "id=$file->id", $lang->edit, "data-toggle='modal'");
            commonModel::printLink('file', 'deletesource', "id=$file->id", $lang->delete, "class='deleter'");
            ?>
          </td>
        </tr>
        <?php endforeach;?>          
      </tbody>
      <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
    </table>
  </div>
</div>
<script type="text/javascript">
var copyBtns = $('.copyBtn');
var clip = new ZeroClipboard(copyBtns);
clip.on('aftercopy', function(){$.zui.messager.success(v.copySuccess); });
</script>
<?php include '../../common/view/footer.admin.html.php';?>

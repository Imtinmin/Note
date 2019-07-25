<?php if(!class_exists('raintpl')){exit;}?><?php if(!defined("RUN_MODE")){ ?>

<?php echo die(); ?>

<?php } ?>


<?php $block->content = json_decode($block->content);$this->var['block'] = $block;?>

<?php $groupID=$this->var['groupID']        = !empty($block->content->group) ? $block->content->group : '';?>

<?php $slides=$this->var['slides']         = $model->loadModel('slide')->getList($groupID);?>

<?php $slideID=$this->var['slideID']        = 'slide' . $block->id . '-' . $groupID;?>

<?php $group=$this->var['group']          = $model->loadModel('tree')->getByID($groupID);?>

<?php $globalButtons=$this->var['globalButtons']  = zget($group, 'desc', '') ? json_decode($group->desc, true) : array();?>

<?php $slideStyle=$this->var['slideStyle']     = !empty($block->content->style) ? $block->content->style : 'carousel';?>

<?php if($slides){ ?>

<div class='block <?php echo $blockClass; ?>' id='block<?php echo $block->id; ?>'>
  <?php if($slideStyle == 'tile'){ ?>

  <div id="<?php echo $slideID; ?>" class='tile slide' data-id='<?php echo $groupID; ?>'>
  <?php }else{ ?>

  <div id='<?php echo $slideID; ?>' class='carousel slide' data-ride='carousel' data-ve='carousel' data-id='<?php echo $groupID; ?>'>
    <div class='carousel-inner'>
  <?php } ?>

      <?php $height=$this->var['height'] = 0; $index = 0;?>

      <?php foreach($slides as $slide): ?>

        <?php $url=$this->var['url']    = empty($slide->mainLink) ? '' : " data-url='" . $slide->mainLink . "'";?>

        <?php $target=$this->var['target'] = " data-target='" . ($slide->target ? '_blank' : '_self') . "'";?>

        <?php if($height == 0 and $slide->height){ ?>

<?php $height=$this->var['height'] = $slide->height;?>

<?php } ?>

        <?php $itemClass=$this->var['itemClass'] = 0 === $index++ ? 'item active' : 'item';?>

        <?php if($slide->backgroundType == 'image'){ ?>

          <div data-id='<?php echo $slide->id; ?>' class='<?php echo $itemClass ; ?>'<?php echo $url . ' ' . $target; ?>>
          <?php print(html::image($slide->image)); ?>

        <?php }else{ ?>

          <div data-id='<?php echo $slide->id; ?>' class='<?php echo $itemClass ; ?>'<?php echo $url . ' ' . $target; ?> style='<?php echo 'background-color: ' . $slide->backgroundColor . '; height: ' . $height . 'px'; ?>'>
        <?php } ?>

          <div class="<?php echo $slideStyle . '-caption'; ?>">
            <h2 style='color:<?php echo $slide->titleColor; ?>'><?php echo $slide->title; ?></h2>
            <div><?php echo $slide->summary; ?></div>
            <?php foreach($globalButtons as $id => $globalButton): ?>

              <?php foreach($globalButton as $key => $global): ?>

                <?php if(!$global){ ?>

<?php continue; ?>

<?php } ?>

                <?php if(trim($slides["$id"]->label["$key"]) != ''){ ?>

                  <?php if($slides["$id"]->buttonUrl["$key"]){ ?>

<?php echo html::a($slides["$id"]->buttonUrl["$key"], $slides["$id"]->label["$key"], "class='btn btn-lg btn-{$slides["$id"]->buttonClass["$key"]}' target='{$slides["$id"]->buttonTarget["$key"]}'"); ?>

<?php } ?>

                  <?php if(!$slides["$id"]->buttonUrl["$key"]){ ?>

<?php echo html::commonButton($slides["$id"]->label["$key"], "btn btn-lg btn-{$slides["$id"]->buttonClass["$key"]}"); ?>

<?php } ?>

                <?php } ?>

              <?php endforeach; ?>

            <?php endforeach; ?>


            <?php foreach($slide->label as $key => $label): ?>

              <?php if(!empty($globalButtons[$slide->id][$key])){ ?>

<?php continue; ?>

<?php } ?>

              <?php if(trim($label) != ''){ ?>

                <?php if($slide->buttonUrl["$key"]){ ?>

<?php echo html::a($slide->buttonUrl["$key"], $label, "class='btn btn-lg btn-{$slide->buttonClass["$key"]}' target='{$slide->buttonTarget["$key"]}'"); ?>

<?php } ?>

                <?php if(!$slide->buttonUrl["$key"]){ ?>

<?php echo html::commonButton($label, "btn btn-lg btn-{$slide->buttonClass["$key"]}"); ?>

<?php } ?>

              <?php } ?>

            <?php endforeach; ?>

          </div>
        </div>
      <?php endforeach; ?>

    <?php if($slideStyle == 'carousel'){ ?>

      </div>
      <?php if(count($slides) > 1){ ?>

      <a class='left carousel-control' href='#<?php echo $slideID; ?>' data-slide='prev'><i class='icon icon-chevron-left'></i></a>
      <a class='right carousel-control' href='#<?php echo $slideID; ?>' data-slide='next'><i class='icon icon-chevron-right'></i></a>
      <?php } ?>

<?php } ?>

  </div>
</div>
<?php } ?>


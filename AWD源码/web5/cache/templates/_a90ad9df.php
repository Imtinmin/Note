    <?php if($lang['tagshow_1']){ ?>
<section class="met-crumbs hidden-sm-down" m-id='met_position' m-type='nocontent'>
    <div class="container">
        <div class="row">
            <div class="border-bottom clearfix">
                <ol class="breadcrumb m-b-0 subcolumn-crumbs breadcrumb-arrow">
                    <li class='breadcrumb-item'>
                        <?php echo $lang['position_text'];?>
                    </li>
                    <li class='breadcrumb-item'>
                        <a href="<?php echo $c['met_weburl'];?>" title="<?php echo $word['home'];?>" class='icon wb-home'><?php echo $word['home'];?></a>
                    </li>
                    <?php
    $cid = 0;
    if(!$cid){
        $cid = $data['classnow'];
    }
    $result = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($cid);
    $location_data = array();
    $location_data[0] = $result['class1'];
    $location_data[1] = $result['class2'];
    $location_data[2] = $result['class3'];
    unset($result);
    foreach($location_data as $index=> $v):
?>
                        <?php if($v){ ?>
                        <li class='breadcrumb-item'>
                            <a href="<?php echo $v['url'];?>" title="<?php echo $v['name'];?>" class='<?php echo $v['class'];?>'><?php echo $v['name'];?></a>
                        </li>
                    <?php } ?>
                    <?php endforeach;?>
                </ol>
            </div>
        </div>
    </div>
</section>
<?php } ?>
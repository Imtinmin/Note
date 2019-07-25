    <?php if($lang['tagshow_2']){ ?>
<?php
    $type=strtolower(trim('current'));
    $cid=$data['class1'];
    $column = load::sys_class('label', 'new')->get('column');
    
    unset($result);
    switch ($type) {
            case 'son':
                $result = $column->get_column_son($cid);   
                break;
            case 'current':
                $result[0] = $column->get_column_id($cid);
                break;
            case 'head':
                $result = $column->get_column_head();
                break;
            case 'foot':
                $result = $column->get_column_foot();
                break;
            default:
                $result[0] = $column->get_column_id($cid);
                break;
        }
    $sub = count($result);
    foreach($result as $index=>$m):
        $hides = 1;
        $hide = explode("|",$hides);
        $m['_index']= $index;
        if($data['classnow']==$m['id'] || $data['class1']==$m['id'] || $data['class2']==$m['id']){
            $m['class']="";
        }else{
            $m['class'] = '';
        }
        if(in_array($m['name'],$hide)){
            unset($m['id']);
            unset($m['class']);
            $m['hide'] = $hide;
            $m['sub'] = 0;
        }
    

        if(substr(trim($m['icon']),0,1) == 'm' || substr(trim($m['icon']),0,1) == ''){
            $m['icon'] = 'icon fa-pencil-square-o '.$m['icon'];
        }
        $m['urlnew'] = $m['new_windows'] ? "target='_blank'" :"target='_self'";
        $m['_first']=$index==0 ? true:false;
        $m['_last']=$index==(count($result)-1)?true:false;
        $$m = $m;
?>
    <?php if($m['sub']){ ?>
<section class="met-column-nav" m-id="subcolumn_nav" m-type="nocontent">
    <div class="container">
        <div class="row">
            <ul class="clearfix met-column-nav-ul">
                <?php
    $type=strtolower(trim('current'));
    $cid=$data['class1'];
    $column = load::sys_class('label', 'new')->get('column');
    
    unset($result);
    switch ($type) {
            case 'son':
                $result = $column->get_column_son($cid);   
                break;
            case 'current':
                $result[0] = $column->get_column_id($cid);
                break;
            case 'head':
                $result = $column->get_column_head();
                break;
            case 'foot':
                $result = $column->get_column_foot();
                break;
            default:
                $result[0] = $column->get_column_id($cid);
                break;
        }
    $sub = count($result);
    foreach($result as $index=>$m):
        $hides = 1;
        $hide = explode("|",$hides);
        $m['_index']= $index;
        if($data['classnow']==$m['id'] || $data['class1']==$m['id'] || $data['class2']==$m['id']){
            $m['class']="active";
        }else{
            $m['class'] = '';
        }
        if(in_array($m['name'],$hide)){
            unset($m['id']);
            unset($m['class']);
            $m['hide'] = $hide;
            $m['sub'] = 0;
        }
    

        if(substr(trim($m['icon']),0,1) == 'm' || substr(trim($m['icon']),0,1) == ''){
            $m['icon'] = 'icon fa-pencil-square-o '.$m['icon'];
        }
        $m['urlnew'] = $m['new_windows'] ? "target='_blank'" :"target='_self'";
        $m['_first']=$index==0 ? true:false;
        $m['_last']=$index==(count($result)-1)?true:false;
        $$m = $m;
?>
                    <?php if($m['module']<>1){ ?>
                    <li>
                        <a href="<?php echo $m['url'];?>"  title="<?php echo $lang['sub_all'];?>"     <?php if($data['classnow']==$m['id']){ ?>
                    class="active"
                    <?php } ?>
><?php echo $lang['sub_all'];?></a>
                    </li>
                    <?php }else{ ?>
                        <?php if($m[isshow]){ ?>
                        <li>
                        <a href="<?php echo $m['url'];?>"  title="<?php echo $m['name'];?>"     <?php if($data['classnow']==$m['id']){ ?>
                    class="active"
                    <?php } ?>
><?php echo $m['name'];?></a>
                    </li>
                    <?php } ?>
                <?php } ?>
                <?php
    $type=strtolower(trim('son'));
    $cid=$m['id'];
    $column = load::sys_class('label', 'new')->get('column');
    
    unset($result);
    switch ($type) {
            case 'son':
                $result = $column->get_column_son($cid);   
                break;
            case 'current':
                $result[0] = $column->get_column_id($cid);
                break;
            case 'head':
                $result = $column->get_column_head();
                break;
            case 'foot':
                $result = $column->get_column_foot();
                break;
            default:
                $result[0] = $column->get_column_id($cid);
                break;
        }
    $sub = count($result);
    foreach($result as $index=>$m):
        $hides = 1;
        $hide = explode("|",$hides);
        $m['_index']= $index;
        if($data['classnow']==$m['id'] || $data['class1']==$m['id'] || $data['class2']==$m['id']){
            $m['class']="active";
        }else{
            $m['class'] = '';
        }
        if(in_array($m['name'],$hide)){
            unset($m['id']);
            unset($m['class']);
            $m['hide'] = $hide;
            $m['sub'] = 0;
        }
    

        if(substr(trim($m['icon']),0,1) == 'm' || substr(trim($m['icon']),0,1) == ''){
            $m['icon'] = 'icon fa-pencil-square-o '.$m['icon'];
        }
        $m['urlnew'] = $m['new_windows'] ? "target='_blank'" :"target='_self'";
        $m['_first']=$index==0 ? true:false;
        $m['_last']=$index==(count($result)-1)?true:false;
        $$m = $m;
?>
                        <?php if($m['sub']){ ?>
                        <li class="dropdown">
                            <a href="<?php echo $m['url'];?>" title="<?php echo $m['name'];?>" class="dropdown-toggle     <?php if($data['classnow']==$m['id']){ ?>active<?php } ?>" data-toggle="dropdown"><?php echo $m['name'];?></a>
                            <div class="dropdown-menu animate">
                                    <?php if($data['class1']['module']<>1){ ?>
                                    <a href="<?php echo $m['url'];?>"  title="<?php echo $lang['sub_all'];?>" class='dropdown-item <?php echo $m['class'];?>'><?php echo $lang['sub_all'];?></a>
                                <?php } ?>
                                <?php
    $type=strtolower(trim('son'));
    $cid=$m['id'];
    $column = load::sys_class('label', 'new')->get('column');
    
    unset($result);
    switch ($type) {
            case 'son':
                $result = $column->get_column_son($cid);   
                break;
            case 'current':
                $result[0] = $column->get_column_id($cid);
                break;
            case 'head':
                $result = $column->get_column_head();
                break;
            case 'foot':
                $result = $column->get_column_foot();
                break;
            default:
                $result[0] = $column->get_column_id($cid);
                break;
        }
    $sub = count($result);
    foreach($result as $index=>$m):
        $hides = 1;
        $hide = explode("|",$hides);
        $m['_index']= $index;
        if($data['classnow']==$m['id'] || $data['class1']==$m['id'] || $data['class2']==$m['id']){
            $m['class']="active";
        }else{
            $m['class'] = '';
        }
        if(in_array($m['name'],$hide)){
            unset($m['id']);
            unset($m['class']);
            $m['hide'] = $hide;
            $m['sub'] = 0;
        }
    

        if(substr(trim($m['icon']),0,1) == 'm' || substr(trim($m['icon']),0,1) == ''){
            $m['icon'] = 'icon fa-pencil-square-o '.$m['icon'];
        }
        $m['urlnew'] = $m['new_windows'] ? "target='_blank'" :"target='_self'";
        $m['_first']=$index==0 ? true:false;
        $m['_last']=$index==(count($result)-1)?true:false;
        $$m = $m;
?>
                                <a href="<?php echo $m['url'];?>" title="<?php echo $m['name'];?>" class='dropdown-item <?php echo $m['class'];?>'><?php echo $m['name'];?></a>
                                <?php endforeach;?>
                            </div>
                        </li>
                        <?php }else{ ?>
                        <li>
                            <a href="<?php echo $m['url'];?>" title="<?php echo $m['name'];?>" class='<?php echo $m['class'];?>'><?php echo $m['name'];?></a>
                        </li>
                    <?php } ?>
                <?php endforeach;?>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</section>
<?php } ?>
<?php endforeach;?>
<?php } ?>
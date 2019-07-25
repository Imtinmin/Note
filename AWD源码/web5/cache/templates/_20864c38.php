<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $data['page_title'];?></title>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=0,minimal-ui">
<meta name="format-detection" content="telephone=no" />
<meta name="description" content="<?php echo $data['page_description'];?>" />
<meta name="keywords" content="<?php echo $data['page_keywords'];?>" />
<meta name="generator" content="MetInfo <?php echo $c['metcms_v'];?>" data-variable="<?php echo $c['met_weburl'];?>|<?php echo $data['lang'];?>|<?php echo $data['classnow'];?>|<?php echo $data['id'];?>|<?php echo $data['module'];?>|<?php echo $c['met_skin_user'];?>"/>
<link href="<?php echo $c['met_weburl'];?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel='stylesheet' type='text/css' href='http://192.168.0.117/daimashenji/MetInfo6.0.0/public/ui/v2/static/css/basic.css'>
<?php if(file_exists(PATH_TEM."cache/common.css")){
$common_css_time = filemtime(PATH_TEM."cache/common.css");
    ?>
<link rel="stylesheet" type="text/css" href="<?php echo $c['met_weburl'];?>templates/<?php echo $c['met_skin_user'];?>/cache/common.css?<?php echo $common_css_time;?>">
<?php } ?>
<?php if(!isset($met_page) && $_M[config][template_type]=="ui") $met_page = 404;if($met_page){ if($met_page == 404){$met_page = "show";}  $page_css_time = filemtime(PATH_TEM."cache/".$met_page."_".$_M[lang].".css");?>
<link rel="stylesheet" type="text/css" href="<?php echo $c['met_weburl'];?>templates/<?php echo $c['met_skin_user'];?>/cache/<?php echo $met_page;?>_<?php echo $_M[lang];?>.css?<?php echo $page_css_time;?>"/>
<?php }?>

<?php echo $_M[html_plugin][head_script];?>
<style>
body{background-image: url(<?php echo $g['bodybgimg'];?>);background-position: center;background-repeat: no-repeat;background-color: <?php echo $g['bodybgcolor'];?>;font-family:<?php echo $g['met_font'];?>;}
</style>
<?php if(is_mobile()){ ?>
<?php echo $c['met_headstat_mobile'];?>
<?php }else{?>
<?php echo $c['met_headstat'];?>
<?php }?>
<!--[if lte IE 9]>
<script src="<?php echo $_M[url][site];?>public/ui/v2/static/js/lteie9.js"></script>
<![endif]-->
</head>
<!--[if lte IE 8]>
<div class="text-xs-center m-b-0 bg-blue-grey-100 alert">
    <button type="button" class="close" aria-label="Close" data-dismiss="alert">
        <span aria-hidden="true">×</span>
    </button>
    <?php echo $_M[word][browserupdatetips];?>
</div>
<![endif]-->
<body>
<header class='met-head' m-id='met_head' m-type="head_nav">
    <nav class="navbar navbar-default box-shadow-none met-nav">
        <div class="container">
            <div class="row">
                    <?php if($data[classnow]==10001){ ?>
                    <h1 hidden><?php echo $c['met_webname'];?></h1>
                    <?php }else{ ?>
                    <h3 hidden><?php echo $c['met_webname'];?></h3>
                <?php } ?>
                <div class="navbar-header pull-xs-left">
                    <a href="<?php echo $c['index_url'];?>" class="met-logo vertical-align block pull-xs-left" title="<?php echo $c['met_webname'];?>">
                        <div class="vertical-align-middle">
                            <img src="<?php echo $c['met_logo'];?>" alt="<?php echo $c['met_webname'];?>"></div>
                    </a>
                </div>
                    <?php if(($data[classnow]<>10001&&!$data[id])||$data[module]==1){ ?>
                    <h1 hidden><?php echo $data['name'];?></h1>
                        <?php if($data[classtype]<>1){ ?>
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
                            <h2 hidden><?php echo $m['name'];?></h2>
                        <?php endforeach;?>
                    <?php } ?>
                    <?php }else{ ?>
                        <?php if(!$data[id]){ ?>
                        <h1 hidden><?php echo $data['name'];?></h1>
                    <?php } ?>
                <?php } ?>
                <button type="button" class="navbar-toggler hamburger hamburger-close collapsed p-x-5 met-nav-toggler" data-target="#met-nav-collapse" data-toggle="collapse">
                    <span class="sr-only"></span>
                    <span class="hamburger-bar"></span>
                </button>
                    <?php if($c['met_member_register']){ ?>
                <button type="button" class="navbar-toggler collapsed m-0 p-x-5 met-head-user-toggler" data-target="#met-head-user-collapse" data-toggle="collapse"> <i class="icon wb-user-circle" aria-hidden="true"></i>
                </button>
                <?php } ?>
                <div class="collapse navbar-collapse navbar-collapse-toolbar pull-md-right p-0" id='met-head-user-collapse'>
                        <?php if($c['met_member_register']){ ?>
                            <?php if($user){ ?>
                            <ul class="navbar-nav pull-md-right vertical-align p-l-0 margin-bottom-0 met-head-user" m-id="member" m-type="member">
    <li class="dropdown">
        <a
            href="javascript:;"
            class="navbar-avatar dropdown-toggle"
            data-toggle="dropdown"
            aria-expanded="false"
        >
            <span class="avatar m-r-5"><img src="<?php echo $user['head'];?>" alt="<?php echo $user['username'];?>"/></span>
            <?php echo $user['username'];?>
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-right animate">
            <li class="dropdown-item" role="presentation">
                <a href="<?php echo $c['met_weburl'];?>member/basic.php?lang=<?php echo $_M[lang];?>" title='<?php echo $word['memberIndex9'];?>' role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> <?php echo $word['memberIndex9'];?></a>
            </li>
            <li class="dropdown-item" role="presentation">
                <a href="<?php echo $c['met_weburl'];?>member/basic.php?lang=<?php echo $_M[lang];?>&a=dosafety" title='<?php echo $word['accsafe'];?>' role="menuitem"><i class="icon wb-lock" aria-hidden="true"></i> <?php echo $word['accsafe'];?></a>
            </li>

            <li class="divider" role="presentation"></li>
            <li class="dropdown-item" role="presentation">
                <a href="<?php echo $c['met_weburl'];?>member/login.php?lang=<?php echo $_M[lang];?>&a=dologout" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> <?php echo $word['memberIndex10'];?></a>
            </li>
        </ul>
    </li>
</ul>
                            <?php }else{ ?>
                            <ul class="navbar-nav pull-md-right vertical-align p-l-0 m-b-0 met-head-user no-login text-xs-center" m-id="member" m-type="member">
                                <li class=" text-xs-center vertical-align-middle animation-slide-top">
                                    <a href="<?php echo $c['met_weburl'];?>member/login.php?lang=<?php echo $_M[lang];?>" class="met_navbtn"><?php echo $word['login'];?></a>
                                    <a href="<?php echo $c['met_weburl'];?>member/register_include.php?lang=<?php echo $_M[lang];?>" class="met_navbtn"><?php echo $word['register'];?></a>
                                </li>
                            </ul>
                        <?php } ?>
                    <?php } ?>
                    <div class="metlang m-l-15 pull-md-right text-xs-center">
                            <?php if($c['met_ch_lang'] && $lang['cn1_position']==1){ ?>
                                <?php if($lang['cn1_ok']){ ?>
                                    <?php if($data[lang]==cn || $data[lang]==zh){ ?>
                                    <span id='btn-convert' class="met_navbtn" m-id="lang" m-type="lang">繁体</span>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                            <?php if($c['met_lang_mark'] && $lang['langlist_position']==1){ ?>
                        <div class="met-langlist vertical-align" m-type="lang" m-id="lang">
                            <div class="inline-block  dropdown">
                                <?php
    $language = load::sys_class('label', 'new')->get('language')->get_lang();
    $sub = count($language);
    $i = 0;
    foreach($language as $index=>$v):

        $v['_index']   = $index;
        $v['_first']   = $i == 0 ? true:false;

        $v['_last']    = $index == (count($language)-1) ? true : false;
        $v['sub'] = $sub;
        $i++;
?><?php endforeach;?>
                                    <?php if($sub>1){ ?>
                                <?php
    $language = load::sys_class('label', 'new')->get('language')->get_lang();
    $sub = count($language);
    $i = 0;
    foreach($language as $index=>$v):

        $v['_index']   = $index;
        $v['_first']   = $i == 0 ? true:false;

        $v['_last']    = $index == (count($language)-1) ? true : false;
        $v['sub'] = $sub;
        $i++;
?>
                                    <?php if($data['lang']==$v['mark']){ ?>
                                <span data-toggle="dropdown" class="met_navbtn dropdown-toggle">
                                        <?php if($lang['langlist1_icon_ok']){ ?>
                                    <span class="flag-icon flag-icon-<?php echo $v['iconname'];?>"></span>
                                    <?php } ?>
                                    <span ><?php echo $v['name'];?></span>
                                </span>
                                <?php } ?>
                                <?php endforeach;?>
                                <ul class="dropdown-menu dropdown-menu-right animate animate-reverse" id="met-langlist-dropdown" role="menu">
                                    <?php
    $language = load::sys_class('label', 'new')->get('language')->get_lang();
    $sub = count($language);
    $i = 0;
    foreach($language as $index=>$v):

        $v['_index']   = $index;
        $v['_first']   = $i == 0 ? true:false;

        $v['_last']    = $index == (count($language)-1) ? true : false;
        $v['sub'] = $sub;
        $i++;
?>
                                    <a href="<?php echo $v['met_weburl'];?>" title="<?php echo $v['name'];?>"     <?php if($v[newwindows]==1){ ?>target="_blank"<?php } ?> class='dropdown-item'>
                                            <?php if($lang['langlist1_icon_ok']){ ?>
                                        <span class="flag-icon flag-icon-<?php echo $v['iconname'];?>"></span>
                                        <?php } ?>
                                        <?php echo $v['name'];?>
                                    </a>
                                    <?php endforeach;?>
                                </ul>
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="collapse navbar-collapse navbar-collapse-toolbar pull-md-right p-0" id="met-nav-collapse">
                    <ul class="nav navbar-nav navlist">
                        <li class='nav-item'>
                            <a href="<?php echo $c['index_url'];?>" title="<?php echo $word['home'];?>" class="nav-link
                                <?php if($data['classnow']==10001){ ?>
                            active
                            <?php } ?>
                            "><?php echo $word['home'];?></a>
                        </li>
                        <?php
    $type=strtolower(trim('head'));
    $cid=0;
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
                            <?php if($lang['navbarok'] && $m['sub']){ ?>
                        <li class="nav-item dropdown m-l-<?php echo $lang['nav_ml'];?>">
                                <?php if($lang['navbarok']){ ?>
                            <a
                                href="<?php echo $m['url'];?>"
                                title="<?php echo $m['name'];?>"
                                <?php echo $m['urlnew'];?>
                                class="nav-link dropdown-toggle <?php echo $m['class'];?>"
                                data-toggle="dropdown" data-hover="dropdown"
                            >
                            <?php }else{ ?>
                            <a
                                href="<?php echo $m['url'];?>"
                                <?php echo $m['urlnew'];?>
                                title="<?php echo $m['name'];?>"
                                class="nav-link dropdown-toggle <?php echo $m['class'];?>"
                                data-toggle="dropdown"
                            >
                            <?php } ?>
                            <?php echo $m['name'];?><span class="fa fa-angle-down p-l-5"></span></a>
                                <?php if($lang['navbullet_ok']){ ?>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-bullet">
                            <?php }else{ ?>
                            <div class="dropdown-menu dropdown-menu-right animate">
                            <?php } ?>
                                <?php if($m['module']<>1){ ?>
                                <a href="<?php echo $m['url'];?>" <?php echo $m['urlnew'];?>  title="<?php echo $lang['all'];?>" class='dropdown-item nav-parent hidden-lg-up <?php echo $m['class'];?>'><?php echo $lang['all'];?></a>
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
                                <div class="dropdown-item dropdown-submenu">
                                    <a href="<?php echo $m['url'];?>" <?php echo $m['urlnew'];?> class="dropdown-item <?php echo $m['class'];?>"><?php echo $m['name'];?></a>
                                    <div class="dropdown-menu animate">
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
                                            <a href="<?php echo $m['url'];?>" <?php echo $m['urlnew'];?> class="dropdown-item <?php echo $m['class'];?>" ><?php echo $m['name'];?></a>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <a href="<?php echo $m['url'];?>" <?php echo $m['urlnew'];?> title="<?php echo $m['name'];?>" class='dropdown-item <?php echo $m['class'];?>'><?php echo $m['name'];?></a>
                                <?php } ?>
                                <?php endforeach;?>
                            </div>
                        </li>
                        <?php }else{ ?>
                        <li class='nav-item'>
                            <a href="<?php echo $m['url'];?>" <?php echo $m['urlnew'];?> title="<?php echo $m['name'];?>" class="nav-link <?php echo $m['class'];?>"><?php echo $m['name'];?></a>
                        </li>
                        <?php } ?>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<?php 
    $banner = load::sys_class('label', 'new')->get('banner')->get_column_banner($data['classnow']);
    $sub = count($banner['img']);
    foreach($banner['img'] as $index=>$v):
        $v['_index']   = $index;
        $v['_first']   = $index == 0 ? true:false;
        $v['_last']    = $index == (count($result)-1) ? true : false;
        $v['type'] = $banner['config']['type'];
        $v['y'] = $banner['config']['y'];
        $v['sub'] = $sub;
?><?php endforeach;?>
    <?php if($sub || $data['classnow']==10001){ ?>
<div class="met-banner carousel slide" id="exampleCarouselDefault" data-ride="carousel" m-id='banner'  m-type='banner'>
    <ol class="carousel-indicators carousel-indicators-fall">
        <?php 
    $banner = load::sys_class('label', 'new')->get('banner')->get_column_banner($data['classnow']);
    $sub = count($banner['img']);
    foreach($banner['img'] as $index=>$v):
        $v['_index']   = $index;
        $v['_first']   = $index == 0 ? true:false;
        $v['_last']    = $index == (count($result)-1) ? true : false;
        $v['type'] = $banner['config']['type'];
        $v['y'] = $banner['config']['y'];
        $v['sub'] = $sub;
?>
            <li data-slide-to="<?php echo $v['_index'];?>" data-target="#exampleCarouselDefault" class="    <?php if($v['_first']){ ?>active<?php } ?>"></li>
        <?php endforeach;?>
    </ol>
    <div class="carousel-inner     <?php if($data['classnow']==10001 && $sub==0){ ?>met-banner-mh<?php } ?>" role="listbox">
        <?php 
    $banner = load::sys_class('label', 'new')->get('banner')->get_column_banner($data['classnow']);
    $sub = count($banner['img']);
    foreach($banner['img'] as $index=>$v):
        $v['_index']   = $index;
        $v['_first']   = $index == 0 ? true:false;
        $v['_last']    = $index == (count($result)-1) ? true : false;
        $v['type'] = $banner['config']['type'];
        $v['y'] = $banner['config']['y'];
        $v['sub'] = $sub;
?>
            <div class="carousel-item     <?php if($v['_first']){ ?>active<?php } ?>">
                <?php if($v['img_link']){ ?>
                <a href="<?php echo $v['img_link'];?>" title="<?php echo $v['img_des'];?>" target='_blank'>
            <?php } ?>
                <img class="w-full" src="<?php echo $v['img_path'];?>" srcset='<?php echo $v['img_path'];?> 767w,<?php echo $v['img_path'];?>' sizes="(max-width: 767px) 767px" alt="<?php echo $v['img_title'];?>" pch="<?php echo $v['height'];?>" adh="<?php echo $v['height_t'];?>" iph="<?php echo $v['height_m'];?>">
                    <?php if($v['img_title']){ ?>
                    <div class="met-banner-text" met-imgmask>
                        <div class='container'>
                            <div class='met-banner-text-con p-<?php echo $v['img_text_position'];?>'>
                                <div>
                                    <h3 class="animation-slide-top animation-delay-300 font-weight-500" style="color:<?php echo $v['img_title_color'];?>"><?php echo $v['img_title'];?></h3>
                                    <p class="animation-slide-bottom animation-delay-600" style='color:<?php echo $v['img_des_color'];?>'><?php echo $v['img_des'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if($v['img_link']){ ?>
                </a>
            <?php } ?>
            </div>
        <?php endforeach;?>
        <a class="left carousel-control" href="#exampleCarouselDefault" role="button" data-slide="prev">
          <span class="icon" aria-hidden="true"><</span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#exampleCarouselDefault" role="button" data-slide="next">
          <span class="icon" aria-hidden="true">></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<?php }else{ ?>
    <?php if($data['classnow']<>10001){ ?>
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
    <div class="met-banner-ny vertical-align text-center" m-id="banner">
            <?php if($m[module]==1){ ?>
            <h1 class="vertical-align-middle"><?php echo $m[name];?></h1>
            <?php }else{ ?>
            <h2 class="vertical-align-middle"><?php echo $m[name];?></h2>
        <?php } ?>
    </div>
    <?php endforeach;?>
<?php } ?>
<?php } ?>
    <?php if($data['classnow']<>10001){ ?>
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
<?php } ?>
<footer class='met-foot-info p-y-20 border-top1' m-id='met_foot' m-type="foot">
    <div class="$langcss text-xs-center p-b-20" m-id='noset' m-type='foot_nav'>
    <div class="container">
        <div class="row mob-masonry">
            <?php
    $type=strtolower(trim('foot'));
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
                <?php if($m['_index']<4){ ?>
            <div class="col-lg-2 col-md-3 col-xs-6 list masonry-item foot-nav">
                <h4 class='font-size-16 m-t-0'>
                    <a href="<?php echo $m['url'];?>" <?php echo $m['urlnew'];?>  title="<?php echo $m['name'];?>"><?php echo $m['name'];?></a>
                </h4>
                    <?php if($m['sub']){ ?>
                <ul class='ulstyle m-b-0'>
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
                    <li>
                        <a href="<?php echo $m['url'];?>" <?php echo $m['urlnew'];?> title="<?php echo $m['name'];?>"><?php echo $m['name'];?></a>
                    </li>
                    <?php endforeach;?>
                </ul>
                <?php } ?>
            </div>
            <?php } ?>
            <?php endforeach;?>
            <div class="col-lg-3 col-md-12 col-xs-12 info masonry-item font-size-20" m-id='met_contact' m-type="nocontent">
                    <?php if($lang['footinfo_tel']){ ?>
                <p class='font-size-26'><a href="tel:<?php echo $lang['footinfo_tel'];?>" title=""><?php echo $lang['footinfo_tel'];?></a></p>
                <?php } ?>
                    <?php if($lang['footinfo_dsc']){ ?>
                <p><?php echo $lang['footinfo_dsc'];?></p>
                <?php } ?>
                    <?php if($lang['footinfo_wx_ok']){ ?>
                <a class="p-r-5" id="met-weixin" data-plugin="webuiPopover" data-trigger="hover" data-animation="pop" data-placement='top' data-width='155' data-padding='0' data-content="<div class='text-xs-center'>
                    <img src='<?php echo $lang['footinfo_wx'];?>' alt='<?php echo $c['met_webname'];?>' width='150' height='150' id='met-weixin-img'></div>
                ">
                    <i class="fa fa-weixin light-green-700"></i>
                </a>
                <?php } ?>
                    <?php if($lang['footinfo_qq_ok']){ ?>
                <a
                    <?php if($lang['foot_info_qqtype']==1){ ?>
                href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $lang['footinfo_qq'];?>&site=qq&menu=yes"
                <?php }else{ ?>
                href="http://crm2.qq.com/page/portalpage/wpa.php?uin={<?php echo $lang['footinfo_qq'];?>&aty=0&a=0&curl=&ty=1"
                <?php } ?>
                rel="nofollow" target="_blank" class="p-r-5">
                    <i class="fa fa-qq"></i>
                </a>
                <?php } ?>
                    <?php if($lang['footinfo_sina_ok']){ ?>
                <a href="<?php echo $lang['footinfo_sina'];?>" rel="nofollow" target="_blank" class="p-r-5">
                    <i class="fa fa-weibo red-600"></i>
                </a>
                <?php } ?>
                    <?php if($lang['footinfo_twitterok']){ ?>
                <a href="<?php echo $lang['footinfo_twitter'];?>" rel="nofollow" target="_blank" class="p-r-5">
                    <i class="fa fa-twitter red-600"></i>
                </a>
                <?php } ?>
                    <?php if($lang['footinfo_googleok']){ ?>
                <a href="<?php echo $lang['footinfo_google'];?>" rel="nofollow" target="_blank" class="p-r-5">
                    <i class="fa fa-google red-600"></i>
                </a>
                <?php } ?>
                    <?php if($lang['footinfo_facebookok']){ ?>
                <a href="<?php echo $lang['footinfo_facebook'];?>" rel="nofollow" target="_blank" class="p-r-5">
                    <i class="fa fa-facebook red-600"></i>
                </a>
                <?php } ?>
                    <?php if($lang['footinfo_emailok']){ ?>
                <a href="mailto:<?php echo $lang['footinfo_email'];?>" rel="nofollow" target="_blank" class="p-r-5">
                    <i class="fa fa-envelope red-600"></i>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
        <?php if($lang['link_ok'] && $data['classnow']==10001){ ?>
    <?php
    $result = load::sys_class('label', 'new')->get('link')->get_link_list();
    $sub = count($result);
     foreach($result as $index=>$v):
        $v['sub']      = $sub;
        $v['_index']   = $index;
        $v['_first']   = $index == 0 ? true:false;
        $v['_last']    = $index == (count($result)-1) ? true : false;
?><?php endforeach;?>
        <?php if($sub){ ?>
    <div class="met-link border-top1 text-xs-center p-y-10" m-id='noset' m-type='link'>
        <div class="container">
            <ul class="breadcrumb p-0 link-img m-0">
                <li class='breadcrumb-item'><?php echo $lang['footlink_title'];?> :</li>
                <?php
    $result = load::sys_class('label', 'new')->get('link')->get_link_list();
    $sub = count($result);
     foreach($result as $index=>$v):
        $v['sub']      = $sub;
        $v['_index']   = $index;
        $v['_first']   = $index == 0 ? true:false;
        $v['_last']    = $index == (count($result)-1) ? true : false;
?>
                <li class='breadcrumb-item'>
                    <a href="<?php echo $v['weburl'];?>" title="<?php echo $v['webname'];?>" target="_blank">
                        <?php if($v['link_type']==1){ ?>
                        <img data-original="<?php echo $v['weblogo'];?>" alt="<?php echo $v['webname'];?>" height='40'>
                    <?php }else{ ?>
                        <span><?php echo $v['webname'];?></span>
                    <?php } ?>
                    </a>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
    <div class="copy p-y-10 border-top1">
        <div class="container text-xs-center">
                <?php if($c['met_footright'] || $c['met_footstat']){ ?>
            <p><?php echo $c['met_footright'];?></p>
            <?php } ?>
                <?php if($c['met_footaddress']){ ?>
            <p><?php echo $c['met_footaddress'];?></p>
            <?php } ?>
                <?php if($c['met_foottel']){ ?>
            <p><?php echo $c['met_foottel'];?></p>
            <?php } ?>
            <div class="powered_by_metinfo">
                Powered&nbsp;by&nbsp;
                <a href="http://www.MetInfo.cn/#copyright" target="_blank" title="<?php echo $word['Info1'];?>">MetInfo</a>
                &nbsp;<?php echo $c['metcms_v'];?>
            </div>
                    <?php if($c['met_ch_lang'] && $lang['cn1_position']==0){ ?>
                        <?php if($lang['cn1_ok']){ ?>
                        <?php if($data[lang]==cn || $data[lang]==zh){ ?>
                        <button type="button" class="btn btn-outline btn-default btn-squared btn-lang" id='btn-convert' m-id="lang" m-type="lang">繁体</button>
                    <?php } ?>
                    <?php } ?>
                <?php } ?>
                    <?php if($c['met_lang_mark'] && $lang['langlist_position']==0){ ?>
                <div class="met-langlist vertical-align" m-id="lang"  m-type="lang">
                    <div class="inline-block dropup">
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
                        <button type="button" data-toggle="dropdown" class="btn btn-outline btn-default btn-squared dropdown-toggle btn-lang">
                                <?php if($lang['langlist1_icon_ok']){ ?>
                            <span class="flag-icon flag-icon-<?php echo $v['iconname'];?>"></span>
                            <?php } ?>
                            <span><?php echo $v['name'];?></span>
                        </button>
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
                            <a href="<?php echo $v['met_weburl'];?>" title="<?php echo $v['name'];?>" class='dropdown-item'     <?php if($v[newwindows]==1){ ?>target="_blank"<?php } ?>>
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
    </div>
</footer>
<input type="hidden" name="met_lazyloadbg" value="<?php echo $g['lazyloadbg'];?>">
<?php if($c["shopv2_open"]){ $shop_lang_time = filemtime(PATH_WEB."app/app/shop/lang/shop_lang_cn.js"); ?>
<script>
var jsonurl="<?php echo $url['shop_cart_jsonlist'];?>",
    totalurl="<?php echo $url['shop_cart_modify'];?>",
    delurl="<?php echo $url['shop_cart_del'];?>",
    price_prefix="<?php echo $c['shopv2_price_str_prefix'];?>",
    price_suffix="<?php echo $c['shopv2_price_str_suffix'];?>";
</script>
<?php }?>
<script src="<?php echo $c['met_weburl'];?>public/ui/v2/static/js/basic.js"></script>
<?php if(file_exists(PATH_TEM."cache/common.js")){ $common_js_time = filemtime(PATH_TEM."cache/common.js");?>
<script src="<?php echo $c['met_weburl'];?>templates/<?php echo $c['met_skin_user'];?>/cache/common.js?<?php echo $common_js_time;?>"></script>
<?php } ?>
<?php if($met_page){ $page_js_time = filemtime(PATH_TEM."cache/".$met_page."_".$_M[lang].".js");?>
<script src="<?php echo $c['met_weburl'];?>templates/<?php echo $c['met_skin_user'];?>/cache/<?php echo $met_page;?>_<?php echo $_M[lang];?>.js?<?php echo $page_js_time;?>"></script>
<?php }?>
<?php if($c["shopv2_open"]){ ?>
<script src="<?php echo $c['met_weburl'];?>app/app/shop/lang/shop_lang_<?php echo $data['lang'];?>.js?<?php echo $shop_lang_time;?>"></script>
<script src="<?php echo $c['met_weburl'];?>app/app/shop/web/templates/met/static/js/shop_own.js"></script>
<?php }?>
</body>
<?php if(is_mobile()){ ?>
<?php echo $c['met_footstat_mobile'];?>
<?php }else{?>
<?php echo $c['met_footstat'];?>
<?php }?>
<?php echo $_M[html_plugin][foot_script];?>
</html>
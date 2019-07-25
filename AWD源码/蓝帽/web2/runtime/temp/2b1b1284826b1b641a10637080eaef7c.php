<?php if (!defined('THINK_PATH')) exit(); /*a:7:{s:36:"template/adminblue/Wchat/wxMenu.html";i:1501897094;s:28:"template/adminblue/base.html";i:1501813202;s:45:"template/adminblue/controlCommonVariable.html";i:1501656000;s:28:"template/admin/urlModel.html";i:1501551326;s:45:"template/adminblue/Wchat/controlWxDialog.html";i:1501579286;s:34:"template/adminblue/pageCommon.html";i:1500458992;s:34:"template/adminblue/openDialog.html";i:1500263974;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1"/>
	<?php if($frist_menu['module_name']=='首页'): ?>
	<title><?php echo $title_name; ?> - 商家管理</title>
	<?php else: ?>
		<title><?php echo $title_name; ?> - <?php echo $frist_menu['module_name']; ?>管理</title>
	<?php endif; ?>
		<link rel="shortcut  icon" type="image/x-icon" href="ADMIN_IMG/admin_icon.ico" media="screen"/>
		<link rel="stylesheet" type="text/css" href="__STATIC__/blue/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="__STATIC__/blue/css/ns_blue_common.css" />
		<link rel="stylesheet" type="text/css" href="__STATIC__/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="__STATIC__/simple-switch/css/simple.switch.three.css" />
		<style>
		.Switch_FlatRadius.On span.switch-open{background-color: #0072D2;border-color: #0072D2;}
		</style>
		<script src="__STATIC__/js/jquery-1.8.1.min.js"></script>
		<script src="__STATIC__/blue/bootstrap/js/bootstrap.js"></script>
		<script src="__STATIC__/bootstrap/js/bootstrapSwitch.js"></script>
		<script src="__STATIC__/simple-switch/js/simple.switch.js"></script>
		<script src="__STATIC__/js/jquery.unobtrusive-ajax.min.js"></script>
		<script src="__STATIC__/js/common.js"></script>
		<script src="__STATIC__/js/seller.js"></script>
		<script src="__STATIC__/js/load_task.js"></script>
		<script src="__STATIC__/js/load_bottom.js" type="text/javascript"></script>
		<script src="ADMIN_JS/jquery-ui.min.js"></script>
		<script src="ADMIN_JS/ns_tool.js"></script>
		<link rel="stylesheet" type="text/css" href="__STATIC__/blue/css/ns_table_style.css">
		<script>
	/**
	 * Niushop商城系统 - 团队十年电商经验汇集巨献!
	 * ========================================================= Copy right
	 * 2015-2025 山西牛酷信息科技有限公司, 保留所有权利。
	 * ---------------------------------------------- 官方网址:
	 * http://www.niushop.com.cn 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
	 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
	 * =========================================================
	 * 
	 * @author : 小学生王永杰
	 * @date : 2016年12月16日 16:17:13
	 * @version : v1.0.0.0 商品发布中的第二步，编辑商品信息
	 */
	var PLATFORM_NAME = "<?php echo $title_name; ?>";
	var ADMINIMG = "ADMIN_IMG";//后台图片请求路径
	var ADMINMAIN = "ADMIN_MAIN";//后台请求路径
	var UPLOAD = "__UPLOAD__";//上传文件根目录
	var PAGESIZE = "<?php echo $pagesize; ?>";//分页显示页数
	var ROOT = "__ROOT__";//根目录
	var _STATIC = "__STATIC__";
	//上传文件路径
	var UPLOADGOODS = 'UPLOAD_GOODS';//存放商品图片
	var UPLOADGOODSSKU = 'UPLOAD_GOODS_SKU';//存放商品SKU
	var UPLOADGOODSBRAND = 'UPLOAD_GOODS_BRAND';//存放商品品牌图
	var UPLOADGOODSGROUP = 'UPLOAD_GOODS_GROUP';////存放商品分组图片
	var UPLOADGOODSCATEGORY = 'UPLOAD_GOODS_CATEGORY';////存放商品分类图片
	var UPLOADCOMMON = 'UPLOAD_COMMON';//存放公共图片、网站logo、独立图片、没有任何关联的图片
	var UPLOADAVATOR = 'UPLOAD_AVATOR';//存放用户头像
	var UPLOADPAY = 'UPLOAD_PAY';//存放支付生成的二维码图片
	var UPLOADADV = 'UPLOAD_ADV';//存放广告位图片
	var UPLOADEXPRESS = 'UPLOAD_EXPRESS';//存放物流图片
	var UPLOADCMS = 'UPLOAD_CMS';//存放文章图片
</script>
		
<link rel="stylesheet" href="ADMIN_CSS/wxMenu/wx_base.css">
<link rel="stylesheet" href="ADMIN_CSS/wxMenu/wx_index.css">
<link rel="stylesheet" href="ADMIN_CSS/wxMenu/wx_tooltip.css">
<link rel="stylesheet" href="ADMIN_CSS/wxMenu/wx_lib.css" />
<link rel="stylesheet" href="ADMIN_CSS/wxMenu/wx_richvideo.css" />
<link rel="stylesheet" type="text/css" href="ADMIN_CSS/defau.css">
<style>
.draggable-element {display: inline-block;text-align: center;color: rgb(51, 51, 51);cursor: move;}
.menu_setting_area{margin:30px;}
</style>
<script src="ADMIN_JS/plugin/drag-arrange.js"></script>
<script src="ADMIN_JS/wx_menu/wx_menu.js"></script>

	</head>
<body>
<input type="hidden" id="niushop_rewrite_model" value="<?php echo rewrite_model(); ?>">
<input type="hidden" id="niushop_url_model" value="<?php echo url_model(); ?>">
<input type="hidden" id="niushop_admin_model" value="<?php echo admin_model(); ?>">
<script>
function __URL(url)
{
    url = url.replace('SHOP_MAIN', '');
    url = url.replace('APP_MAIN', 'wap');
    url = url.replace('ADMIN_MAIN', $("#niushop_admin_model"));
    if(url == ''|| url == null){
        return 'SHOP_MAIN';
    }else{
        var str=url.substring(0, 1);
        if(str=='/' || str=="\\"){
            url=url.substring(1, url.length);
        }
        if($("#niushop_rewrite_model").val()==1 || $("#niushop_rewrite_model").val()==true){
            return 'SHOP_MAIN/'+url;
        }
        var action_array = url.split('?');
        //检测是否是pathinfo模式
        url_model = $("#niushop_url_model").val();
        if(url_model==1 || url_model==true)
        {
            var base_url = 'SHOP_MAIN/'+action_array[0];
            var tag = '?';
        }else{
            var base_url = 'SHOP_MAIN?s=/'+ action_array[0];
            var tag = '&';
        }
        if(action_array[1] != '' && action_array[1] != null){
            return base_url + tag + action_array[1];
        }else{
        	 return base_url;
        }
    }
}
</script>
<header class="ns-base-header">
	<div class="ns-logo" onclick="location.href='<?php echo __URL('ADMIN_MAIN'); ?>';">
		<img src="__STATIC__/blue/img/top_logo.png"/>
	</div>
	<div class="ns-search">
		<span class="js-nav">导航管理</span>
		<div class="ns-navigation-management">
			<div class="ns-navigation-title">
				<h4>导航管理</h4>
				<span>x</span>
			</div>
			<div style="height:40px;"></div>
			<?php if(is_array($nav_list) || $nav_list instanceof \think\Collection || $nav_list instanceof \think\Paginator): if( count($nav_list)==0 ) : echo "" ;else: foreach($nav_list as $key=>$nav): ?>
			<dl>
				<dt><?php echo $nav['data']['module_name']; ?></dt>
				<?php if(is_array($nav['sub_menu']) || $nav['sub_menu'] instanceof \think\Collection || $nav['sub_menu'] instanceof \think\Paginator): if( count($nav['sub_menu'])==0 ) : echo "" ;else: foreach($nav['sub_menu'] as $key=>$nav_sub): ?>
				<dd onclick="location.href='<?php echo __URL('ADMIN_MAIN/'.$nav_sub['url']); ?>';"><?php echo $nav_sub['module_name']; ?></dd>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</dl>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
		<i class="fa fa-sort-desc"></i>
		<i class="ns-vertical-bar"></i>
		<div class="ns-search-block">
			<input type="text" id="search_goods" placeholder="商品搜索" />
			<i class="ns-icon-base i-search" title="商品搜索" onclick="search()"></i>
		</div>
	</div>
	<nav>
		<ul>
			<?php if(is_array($headlist) || $headlist instanceof \think\Collection || $headlist instanceof \think\Paginator): if( count($headlist)==0 ) : echo "" ;else: foreach($headlist as $key=>$per): if(strtoupper($per['module_id']) == $headid): ?>
			<li class="selected" onclick="location.href='<?php echo __URL('ADMIN_MAIN/'.$per['url']); ?>';">
				<span><?php echo $per['module_name']; ?></span>
				<?php if($per['module_id'] == 10000): ?>
					<span class="is-upgrade"></span>
				<?php endif; ?>
			</li>
			
			<?php else: ?>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/'.$per['url']); ?>';">
				<span><?php echo $per['module_name']; ?></span>
				<?php if($per['module_id'] == 10000): ?>
					<span class="is-upgrade"></span>
				<?php endif; ?>
			</li>
			<?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</nav>
	<div class="ns-base-tool">
		<div class="ns-version-info">
			<span><?php echo $niu_version; ?></span>
		</div>
		<i class="ns-vertical-bar"></i>
		<div class="ns-home" title="返回首页" onclick="javascript:window.open('SHOP_MAIN','_blank');">
			<img src="__STATIC__/blue/img/home.png" />
		</div>
		<i class="ns-vertical-bar"></i>
		<?php if(is_array($headlist) || $headlist instanceof \think\Collection || $headlist instanceof \think\Paginator): if( count($headlist)==0 ) : echo "" ;else: foreach($headlist as $key=>$per): if($per['module_id'] == 10000): ?>
		<div class="ns-upgrade" title="发现新的升级" onclick="location.href='<?php echo __URL('ADMIN_MAIN/'.$per['url']); ?>';">
			<img src="__STATIC__/blue/img/upgrade.png" />
			<span class="is-upgrade"></span>
		</div>
		<i class="ns-vertical-bar" style="border-width: 1px;"></i>
		<?php endif; endforeach; endif; else: echo "" ;endif; ?>
		<div class="ns-clear" title="清除缓存" onclick="delcache()">
			<img src="__STATIC__/blue/img/clear.png" />
		</div>
	</div>
</header>
<article class="ns-base-article">
	<aside class="ns-base-aside">
		<header>
			<article class="ns-base-user">
				<div class="ns-head-portrait">
					<?php if($user_headimg != ''): ?>
					<img src="__ROOT__/<?php echo $user_headimg; ?>"/>
					<?php else: ?>
					<img src="__STATIC__/blue/img/head_portrait_default.png"/>
					<?php endif; ?>
				</div>
				<div class="ns-base-info">
					<span>欢迎您：<?php echo $user_name; ?></span>
					<span>角色：<?php echo $group_name; ?></span>
				</div>
			</article>
			<a href="#edit-password" data-toggle="modal" title="修改密码">修改密码</a>
			<a href="<?php echo __URL('ADMIN_MAIN/login/logout'); ?>" title="安全退出">安全退出</a>
		</header>
		<nav>
			<ul>
				<?php if(is_array($leftlist) || $leftlist instanceof \think\Collection || $leftlist instanceof \think\Paginator): if( count($leftlist)==0 ) : echo "" ;else: foreach($leftlist as $key=>$leftitem): if(strtoupper($leftitem['module_id']) == $second_menu_id): ?>
				<li class="selected" onclick="location.href='<?php echo __URL('ADMIN_MAIN/'.$leftitem['url']); ?>';" title="<?php echo $leftitem['module_name']; ?>"><?php echo $leftitem['module_name']; ?></li>
				<?php else: ?>
				<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/'.$leftitem['url']); ?>';" title="<?php echo $leftitem['module_name']; ?>"><?php echo $leftitem['module_name']; ?></li>
				<?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</nav>
		<div style="height:50px;"></div>
		<div id="bottom_copyright">
			<footer>
				<img src="" id="copyright_logo"/>
				<p>
					<span id="copyright_meta"></span>
					<br/>
					<span id="copyright_companyname"></span>
					<br/>
					<span id="copyright_desc"></span>
				</p>
			</footer>
		</div>
	</aside>
	<section class="ns-base-section">
		<div class="ns-notice">
			<nav>
				<ul>
					<li>网站名称:<span><?php echo $title_name; ?></span></li>
					<li>最后登录时间：<span><?php echo getTimeStampTurnTime($user_info['last_login_time'] ); ?></span></li>
					<li>最后登录IP：<span><?php echo $user_info['last_login_ip']; ?></span></li>
				</ul>
			</nav>
			<div class="ns-service-telephone">
				<img src="__STATIC__/blue/img/logo.png"/>
				<span>提供技术支持服务电话：400-886-7993</span>
			</div>
		</div>
		
		<!-- 操作提示 -->
		
		<div class="ns-warm-prompt" <?php if($warm_prompt_is_show == 'hidden'): ?>style="display:none;"<?php endif; ?>>
			<div class="alert alert-info">
				<button type="button" class="close">&times;</button>
				<h4>
					<i class="fa fa-bell"></i>
					<span>操作提示</span>
				</h4>
				<div style="font-size:12px;text-indent:18px;">
					
						<?php if(is_array($leftlist) || $leftlist instanceof \think\Collection || $leftlist instanceof \think\Paginator): if( count($leftlist)==0 ) : echo "" ;else: foreach($leftlist as $key=>$leftitem): if(strtoupper($leftitem['module_id']) == $second_menu_id): ?>
						<?php echo $leftitem['module_name']; endif; endforeach; endif; else: echo "" ;endif; ?>
					
				</div>
			</div>
		</div>
		
		<div style="position:relative;margin:10px 0;">
			<!-- 三级导航菜单 -->
			
			<nav class="ns-third-menu">
				<ul>
				<?php if(is_array($child_menu_list) || $child_menu_list instanceof \think\Collection || $child_menu_list instanceof \think\Paginator): if( count($child_menu_list)==0 ) : echo "" ;else: foreach($child_menu_list as $k=>$child_menu): if($child_menu['active'] == '1'): ?>
					<li class="selected" onclick="location.href='<?php echo __URL('ADMIN_MAIN/'.$child_menu['url']); ?>';"><?php echo $child_menu['menu_name']; ?></li>
				<?php else: ?>
					<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/'.$child_menu['url']); ?>';"><?php echo $child_menu['menu_name']; ?></li>
				<?php endif; endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</nav>
			
			
			<div class="right-side-operation">
				<ul>
					
					
					<li <?php if($warm_prompt_is_show == 'show'): ?>style="display:none;"<?php endif; ?>><a class="js-open-warmp-prompt"><i class="fa fa-bell"></i>提示</a></li>
					
				</ul>
			</div>
		</div>
		<div class="ns-main">
			

<?php if($menu_list_count == 0): ?>
<!-- 你尚未添加任何菜单 -->
<div class="menu_initial_box js_startMenuBox">
	<p class="tips_global">你尚未添加任何菜单</p>
	<a class="btn btn_primary btn_add js_openMenu" href="javascript:void(0);">
	<i class="icon14_common add_white"></i>添加菜单</a>
</div>
<?php else: ?>
<script>
	// 在关闭页面时弹出确认提示窗口
// 	$(window).bind('beforeunload', function() {
// 		 return '为确保内容不丢失，建议点击页面的绿色“保存并发布”按钮后再离开';
// 	});
</script>
<?php endif; ?>
<!-- 菜单编辑 -->
<div class="menu_setting_area js_editBox" <?php if($menu_list_count == 0): ?>style="display:none;"<?php endif; ?>>
	<div class="menu_preview_area">
		<div class="mobile_menu_preview">
			<div class="mobile_hd tc"><?php echo $wx_name; ?></div>
			<div class="mobile_bd">
				<!-- 菜单 -->
				<ul class="pre_menu_list grid_line" id="menuList">
					<?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $k=>$menu): ?>
					<!-- 加载菜单 -->
					<li class="pre_menu_item size1of<?php echo $class_index+1; if(($k+1)==$menu_list_count): ?> current<?php endif; ?>" data-menu-index="<?php echo $k+1; ?>">
					
						<!-- 一级菜单 -->
						<a href="javascript:void(0);" ondragstart="return false" class="pre_menu_link jsMenu" data-menuid="<?php echo $menu['menu_id']; ?>" data-pid="0" data-menu-eventurl = "<?php echo $menu['menu_event_url']; ?>" data-menu-type = "<?php echo $menu['menu_event_type']; ?>" data-detault-menu-type = "<?php echo $menu['menu_event_type']; ?>" data-mediaid="<?php echo $menu['media_id']; ?>" data-sort="<?php echo $menu['sort']; ?>">
						
							<?php if($menu['child_count'] > 0): ?>
							<!-- 有二级菜单，显示小图标 -->
							<i class="icon_menu_dot js_icon_menu_dot dn"></i>
							<?php endif; ?>
							<span><?php echo $menu['menu_name']; ?></span>
						</a>
						<!-- 一级菜单 -->
						
						
						<!-- 二级菜单 -->
						<div class="sub_pre_menu_box" data-submenulist="<?php echo $k+1; ?>" <?php if(($k+1)!=$menu_list_count): ?>style="display: none;"<?php endif; ?>>
							<ul class="sub_pre_menu_list">
							<?php if(is_array($menu['child']) || $menu['child'] instanceof \think\Collection || $menu['child'] instanceof \think\Paginator): if( count($menu['child'])==0 ) : echo "" ;else: foreach($menu['child'] as $key=>$sub_menu): ?>
								<li class="jsSubMenuInner">
									<a href="javascript:void(0);" ondragstart="return false" data-pid="<?php echo $sub_menu['pid']; ?>" data-menuid="<?php echo $sub_menu['menu_id']; ?>" data-menu-eventurl="<?php echo $sub_menu['menu_event_url']; ?>" data-menu-type = "<?php echo $sub_menu['menu_event_type']; ?>" data-detault-menu-type = "<?php echo $sub_menu['menu_event_type']; ?>" data-mediaid="<?php echo $sub_menu['media_id']; ?>" data-sort="<?php echo $sub_menu['sort']; ?>">
										<span class="sub_pre_menu_inner"><?php echo $sub_menu['menu_name']; ?></span>
									</a>
								</li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
							
							<!-- 限制二级菜单数量的添加 -->
								<li class="jsSubMenu" data-pid="<?php echo $menu['menu_id']; ?>" data-subindex="<?php echo $k+1; ?>" <?php if($menu['child_count'] == $MAX_SUB_MENU_LENGTH): ?>style="display:none;"<?php endif; ?>>
									<a href="javascript:void(0);" title="最多添加<?php echo $MAX_SUB_MENU_LENGTH; ?>个子菜单">
										<span class="sub_pre_menu_inner">
											<i class="icon14_menu_add" style="background-position: 0 0;"></i>
										</span>
									</a>
								</li>
							</ul>
							<i class="arrow arrow_out"></i> <i class="arrow arrow_in"></i><!-- 箭头 -->
						</div>
						<!-- 二级菜单 -->
						
						
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					
					
					
					<!-- 限制一级菜单数量的添加 -->
					<li class="js-addMenuBtn pre_menu_item size1of<?php echo $class_index+1; ?>" <?php if($menu_list_count >= $MAX_MENU_LENGTH): ?>style="display:none;"<?php endif; ?> data-class-index="<?php echo $class_index+1; ?>">
						<a href="javascript:void(0);" class="pre_menu_link " title="最多添加<?php echo $MAX_MENU_LENGTH; ?>个一级菜单">
							<i class="icon14_menu_add"></i>
							<?php if($menu_list_count==0): ?>
							<span>添加菜单</span>
							<?php endif; ?>
						</a>
					</li>
					
					
				</ul>
				<!-- 菜单 -->
			</div>
		</div>

		
		<!-- 菜单排序，后期实现拖拽 -->
		<div class="sort_btn_wrp" <?php if($menu_list_count == 0): ?>style="display:none;"<?php endif; ?>>
			<a id="orderBt" class="<?php if($menu_list_count <2): ?> dn <?php endif; ?>btn btn_default" href="javascript:void(0);">菜单排序</a>
			<span id="orderDis" class="<?php if($menu_list_count >1): ?> dn <?php endif; ?>btn btn_disabled">菜单排序</span>
			<a id="finishBt" href="javascript:void(0);" class="dn btn btn_default">完成</a>
		</div>
		
		
	</div>


	<div class="menu_form_area">
		<!-- 点击左侧菜单进行编辑操作 -->
		<div id="js_none" class="menu_initial_tips tips_global" style="display: none;">请通过拖拽左边的菜单进行排序</div>
		<div id="js_rightBox" class="portable_editor to_left">
			<div class="editor_inner">
				<div class="global_mod float_layout menu_form_hd js_second_title_bar">
					<h4 class="global_info"><?php echo $default_menu_info['menu_name']; ?></h4>
					<div class="global_extra">
						<a href="javascript:void(0);" id="jsDelBt" data-menuid="<?php echo $default_menu_info['menu_id']; ?>" data-menuname="<?php echo $default_menu_info['menu_name']; ?>">删除菜单</a>
					</div>
				</div>
				<div class="menu_form_bd" id="view">
					<div id="js_innerNone"  class="msg_sender_tips tips_global"<?php if($default_menu_info['child_count']==0): ?>style="display: none;"<?php endif; ?>>已添加子菜单，仅可设置菜单名称。</div>
					<div class="frm_control_group js_setNameBox">
						<label for="menuname" class="frm_label"><strong class="title js_menuTitle">菜单名称</strong></label>
						<div class="frm_controls">
							<span class="frm_input_box with_counter counter_in append">
								<input type="text" id="menuname"  data-switch="menuname" class="frm_input" style="box-shadow: none; padding: 0;" value="<?php echo $default_menu_info['menu_name']; ?>">
							</span>
							<p class="frm_msg fail js_titleEorTips dn" style="display: none;">字节超过上限</p>
							<p class="frm_msg fail js_titlenoTips dn" style="display: none;">请输入菜单名称</p>
							<p class="frm_tips js_titleNolTips">字数不超过4个汉字或8个字母</p>
						</div>
					</div>
					<div class="frm_control_group js_setGraphic" <?php if($default_menu_info['child_count']>0): ?>style="display:none;"<?php endif; ?>>
						<label for="" class="frm_label"> <strong class="title js_menuContent">菜单内容</strong></label>
						<div class="frm_controls frm_vertical_pt">
							<label class="frm_radio_label js_radio_sendMsg <?php if($default_menu_info['menu_event_type'] == 2|| $default_menu_info['menu_event_type'] == 3): ?>selected<?php endif; ?>">
								<i class="icon_radio"></i> <span class="lbl_content">发送消息</span>
							</label>
							<label class="frm_radio_label js_radio_url  <?php if($default_menu_info['menu_event_type'] == 1): ?>selected<?php endif; ?>">
								<i class="icon_radio"></i> <span class="lbl_content">跳转网页</span>
							</label>
						</div>
					</div>
					<div class="menu_content_container js_setGraphic" <?php if($default_menu_info['child_count']>0): ?>style="display:none;"<?php endif; ?>>
						<!-- 发送消息 -->
						
						<div class="menu_content send jsMain" id="edit" <?php if($default_menu_info['menu_event_type'] == 2|| $default_menu_info['menu_event_type'] == 3): ?> style="display: block;"<?php else: ?> style="display:none;"<?php endif; ?>>
							<div class="msg_sender" id="editDiv">
								<div class="msg_tab">
									<div class="tab_navs_panel"> 
										<div class="tab_navs_wrp">
											<ul class="tab_navs js_tab_navs">

												<li class="tab_nav tab_appmsg width4 selected" data-type="10" data-tab=".js_appmsgArea" data-tooltip="图文消息">
													<a href="javascript:void(0);">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">图文消息</span></a>
												</li>
												<!-- 
												<li class="tab_nav tab_img width4" data-type="2" data-tab=".js_imgArea" data-tooltip="图片">
													<a href="javascript:void(0);">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">图片</span></a>
												</li>

												<li class="tab_nav tab_audio width4" data-type="3" data-tab=".js_audioArea" data-tooltip="语音">
													<a href="javascript:void(0);">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">语音</span></a>
												</li>
												<li class="tab_nav tab_video width4 no_extra" data-type="15" data-tab=".js_videoArea" data-tooltip="视频">
													<a href="javascript:void(0);">&nbsp;<i class="icon_msg_sender"></i><span class="msg_tab_title">视频</span></a>
												</li> -->

											</ul>
										</div>
									</div>
									<div class="tab_panel">

										<div class="tab_content">
											<div class="js_appmsgArea inner ">
											
												
												<div class="tab_cont_cover jsMsgSendTab" <?php if($default_menu_info['media_id'] != 0): ?>style="display:none;"<?php endif; ?>>
													<div class="media_cover">
														<span class="create_access">
															<a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;">
															<i class="icon36_common add_gray"></i> <strong>从素材库中选择</strong>
														</a>
														</span>
													</div>
													<div class="media_cover">
														<span class="create_access">
															<a target="_blank" class="add_gray_wrp" href="ADMIN_MAIN/Wchat/addMedia">
																<i class="icon36_common add_gray"></i> <strong>新建图文消息</strong>
															</a>
														</span>
													</div>
												</div>
												
												<div id="show_media" <?php if($default_menu_info['media_id'] == 0): ?>style="display:none;"<?php endif; ?>>
													<div class="appmsg multi has_first_cover">
														<div class="appmsg_content">
															<div class="appmsg_info">
																<em class="appmsg_date">
																	<?php echo getTimeStampTurnTime($default_menu_info['media_list']['create_time'] ); ?>
																</em>
															</div>
															<div class="cover_appmsg_item">
																<h4 class="appmsg_title js-media-title">
																	<a href="" target="_blank">
																		<?php echo $default_menu_info['media_list']['title']; ?>
																	</a>
																</h4>
																
																<!-- 封面 -->
																<div class="appmsg_thumb_wrp" 
																	<?php if($default_menu_info['media_list']['item_list_count'] >0): ?>
																	style="background-image:url('__UPLOAD__/<?php echo $default_menu_info['media_list']['item_list'][0]["cover"]; ?>')"
																	<?php endif; ?>
																>
																	
																</div>
																<a href="javascript:showDialog('微信还没有给您生成呢，想啥呢？不能预览！！！');" class="edit_mask preview_mask js_preview" >
																	<div class="edit_mask_content">
																		<p style="color:#fff;">预览文章</p>
																	</div>
																	<span class="vm_box"></span>
																</a>
															</div>
															<?php if($default_menu_info['media_list']['item_list_count'] >1): if(is_array($default_menu_info['media_list']['item_list']) || $default_menu_info['media_list']['item_list'] instanceof \think\Collection || $default_menu_info['media_list']['item_list'] instanceof \think\Paginator): if( count($default_menu_info['media_list']['item_list'])==0 ) : echo "" ;else: foreach($default_menu_info['media_list']['item_list'] as $key=>$media): ?>
															<div class="appmsg_item has_cover">
																<div class="appmsg_thumb_wrp" style="background-image:url('__UPLOAD__/<?php echo $media['cover']; ?>');"></div>
																<h4 class="appmsg_title js_title"><a href="javascript:;" target="_blank"><?php echo $media['title']; ?></a></h4>
																<a href="" class="edit_mask preview_mask js_preview" >
																	<div class="edit_mask_content">
																		<p style="color:#fff;">预览文章</p>
																	</div>
																	<span class="vm_box"></span>
																</a>
															</div>
															<?php endforeach; endif; else: echo "" ;endif; endif; ?>
														</div>
													</div>
													<a href="javascript:;" class="jsmsgSenderDelBt link_dele" data-mediaid="<?php echo $default_menu_info['media_id']; ?>">删除</a>
												</div>

											</div>
										</div>
										<!-- 
										<div class="tab_content" style="display: none;">
											<div class="js_imgArea inner ">

												<div class="tab_cont_cover jsMsgSendTab" data-index="1" data-type="2">
													<div class="media_cover">
														<span class="create_access">
															<a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;" data-type="2" data-index="1">
																<i class="icon36_common add_gray"></i> <strong>从素材库中选择</strong>
															</a>
														</span>
													</div>
													<div class="media_cover">
														<span class="create_access">
															<a class="add_gray_wrp" id="msgSendImgUploadBt" data-type="2" href="javascript:;">
																<i class="icon36_common add_gray"></i> <strong>上传图片</strong>
															</a>
														</span>
													</div>
												</div>

											</div>
										</div>

										<div class="tab_content" style="display: none;">
											<div class="js_audioArea inner ">

												<div class="tab_cont_cover jsMsgSendTab" data-index="2" data-type="3">
													<div class="media_cover">
														<span class="create_access">
															<a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;" data-type="3" data-index="2">
																<i class="icon36_common add_gray"></i> <strong>从素材库中选择</strong>
															</a>
														</span>
													</div>
													<div class="media_cover">
														<span class="create_access">
															<a class="add_gray_wrp " id="msgSendAudioUploadBt" href="javascript:;">
																<i class="icon36_common add_gray"></i> <strong>新建语音</strong>
															</a>
														</span>
													</div>
												</div>

											</div>
										</div>

										<div class="tab_content" style="display: none;">
											<div class="js_videoArea inner ">

												<div class="tab_cont_cover jsMsgSendTab" data-index="3">
													<div class="media_cover">
														<span class="create_access">
															<a class="add_gray_wrp jsMsgSenderPopBt" href="javascript:;" data-type="15" data-index="3">
																<i class="icon36_common add_gray"></i> <strong>从素材库中选择</strong>
															</a>
														</span>
													</div>
													<div class="media_cover">
														<span class="create_access">
															<a target="_blank" class="add_gray_wrp" href="/cgi-bin/appmsg?t=media/videomsg_edit&amp;action=video_edit&amp;type=15&amp;lang=zh_CN&amp;token=65573610">
																<i class="icon36_common add_gray"></i> <strong>新建视频</strong>
															</a>
														</span>
													</div>
												</div>

											</div>
										</div> -->

									</div>
								</div>
							</div>
							<p class="profile_link_msg_global menu_send mini_tips warn dn js_warn">请勿添加其他公众号的主页链接</p>
						</div>
						
						<!-- 发送消息 -->
						
						<!-- 跳转网页 -->
						
						<div class="menu_content url jsMain" id="url"  <?php if($default_menu_info['menu_event_type'] == 1): ?> style="display: block;"<?php else: ?> style="display:none;"<?php endif; ?>>
							<!-- <form action="" id="urlForm" onsubmit="return false;"> -->
								<p class="menu_content_tips tips_global">订阅者点击该子菜单会跳到以下链接</p>
								<div class="frm_control_group">
									<label for="urltext" class="frm_label"><strong class="title">页面地址</strong></label>
									<div class="frm_controls">
										<span class="frm_input_box">
											<input type="text" class="frm_input" id="urltext" data-switch="url" value="<?php echo $default_menu_info['menu_event_url']; ?>" name="urlText" style="border: 0; box-shadow: none; padding: 0;">
										</span>
										<p class="profile_link_msg_global menu_url mini_tips warn dn js_warn">请勿添加其他公众号的主页链接</p>
										<!-- <p class="frm_tips" id="js_urlTitle" style="display: none;">
											来自<span class="js_name"></span><span style="display: none;">
												-《<span class="js_title"></span>》
											</span>
										</p> -->
									</div>
								</div>
								<!--
								<div class="frm_control_group btn_appmsg_wrap">
									<div class="frm_controls">
										<p class="frm_msg fail dn" id="urlUnSelect" style="display: none;">
											<span for="urlText" class="frm_msg_content" style="display: inline;">请选择一篇文章</span>
										</p>
										 <a href="javascript:;" id="js_appmsgPop">从公众号图文消息中选择</a> 
										<a href="javascript:void(0);" class="dn btn btn_default" id="js_reChangeAppmsg">重新选择</a>
									</div>
								</div>
								-->
							<!-- </form> -->
						</div>
						
						<!-- 跳转网页 -->
						
					<!-- 	<div class="menu_content sended" style="display: none;">
							<p class="menu_content_tips tips_global">订阅者点击该子菜单会跳到以下链接</p>
							<div class="msg_wrp" id="viewDiv"></div>
							<p class="frm_tips">
								来自<span class="js_name">素材库</span><span style="display: none;">
									-《<span class="js_title"></span>》
								</span>
							</p>
						</div> -->
						
						<div id="js_errTips" style="display: none;" class="msg_sender_msg mini_tips warn"></div>
					</div>
				</div>
			</div>
			
			<!-- 左箭头 -->
			
			<span class="editor_arrow_wrp">
				<i class="editor_arrow editor_arrow_out"></i>
				<i class="editor_arrow editor_arrow_in"></i>
			</span>
			
			<!-- 左箭头 -->
			
		</div>
		<!-- 点击左侧菜单进行编辑操作 -->

	</div>
</div>
<!-- 菜单编辑 -->

<div class="tool_bar tc js_editBtn" <?php if($menu_list_count == 0): ?>style="visibility: hidden;"<?php endif; ?>>
	<span id="pubBt" class="btn btn_input btn_primary" style="display: inline-block;"><button>保存并发布</button></span>
	<a href="javascript:void(0);" class="btn btn_default" id="viewBt" style="display: inline-block;">预览</a>
</div>


<!-- 删除菜单弹出框 -->
<div class="dialog_wrp  ui-draggable" style="width: 720px; margin-left: -360px; margin-top: -186px; display: none;" id="wxDelDialog">
	<div class="dialog">
		<div class="dialog_hd">
			<h3>温馨提示</h3>
			<a href="javascript:;" class="pop_closed">关闭</a>
		</div>
		<div class="dialog_bd">
			<div class="page_msg large simple default ">
				<div class="inner group">
					<span class="msg_icon_wrapper"><i class="icon_msg warn "></i></span>
					<div class="msg_content ">
						<h4>删除确认</h4>
						<p></p>
					</div>
				</div>
			</div>
		</div>
		<div class="dialog_ft">
			<a href="javascript:;" class="btn btn_primary js_btn">确定</a>
			<a href="javascript:;" class="btn btn_default js_btn">取消</a>
		</div>
	</div>
</div>

<!-- 删除菜单弹出框 -->
<!-- 手机预览 -->
<div class="mobile_preview" id="mobileDiv" style="display: none;">
	<div class="mobile_preview_hd">
		<strong class="nickname"><?php echo $wx_name; ?></strong>
	</div>
	<div class="mobile_preview_bd">
		<ul id="viewShow" class="show_list"></ul>
	</div>
	<div class="mobile_preview_ft">
		<ul class="pre_menu_list grid_line" id="viewList">
			<?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): if( count($menu_list)==0 ) : echo "" ;else: foreach($menu_list as $k=>$menu): ?>
			<li class="pre_menu_item grid_item size1of<?php echo $menu_list_count; ?>" data-mobile-menu-index="<?php echo $k+1; ?>">
				<a href="javascript:void(0);" class="jsView pre_menu_link" title="<?php echo $menu['menu_name']; ?>" data-menuid="<?php echo $menu['menu_id']; ?>">
					<?php if($menu['child_count'] > 0): ?>
					<i class="icon_menu_dot"></i>
					<?php endif; ?>
					<span><?php echo $menu['menu_name']; ?></span>
				</a>
				<div class="sub_pre_menu_box jsSubViewDiv" data-subIndex="<?php echo $k+1; ?>" style="display: none">
					<ul class="sub_pre_menu_list">
						<?php if(is_array($menu['child']) || $menu['child'] instanceof \think\Collection || $menu['child'] instanceof \think\Paginator): if( count($menu['child'])==0 ) : echo "" ;else: foreach($menu['child'] as $key=>$sub_menu): ?>
						<li>
							<a href="javascript:void(0);" data-pid="<?php echo $sub_menu['pid']; ?>" data-menuid="<?php echo $sub_menu['menu_id']; ?>" class="jsSubView" title="<?php echo $sub_menu['menu_name']; ?>"><?php echo $sub_menu['menu_name']; ?></a>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<i class="arrow arrow_out"></i><i class="arrow arrow_in"></i>
				</div>
			</li>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
	<a href="javascript:void(0);" class="mobile_preview_closed btn btn_default" id="viewClose">退出预览</a>
</div>
<!-- 遮罩层 -->
<div class="mask" style="display: none;" id="maskLayer"></div>
<!-- 操作反馈弹出框 erro 失败-->
<div class="JS_TIPS page_tips success" id="wxTips" style="display:none;">
	<div class="inner"></div>
</div>
<input type="hidden" id="hidden_default_sort" />
<input type="hidden" id="hidden_default_sub_sort" />
<!-- 选择图文素材 -->
<link rel="stylesheet" href="ADMIN_CSS/wxMenu/wx_base.css">
<link rel="stylesheet" href="ADMIN_CSS/wxMenu/wx_tooltip.css">
<link rel="stylesheet" href="ADMIN_CSS/wxMenu/wx_lib.css" />
<style>
.table tr td{text-align:center;vertical-align:middle;}
.table tr td:first-child{width:50%;}
.table tr td:last-child{width:20%;}
ul.mater{border:1px solid #e7e7eb;border-radius:5px;}
ul.mater li{padding:5px;border-bottom:1px solid #e7e7eb;}
ul.mater li:first-child{padding:13px 5px;}
ul.mater li:last-child{border-bottom:0px solid #e7e7eb;}
ul.mater li .btn_primary{display:inline-block;padding:3px;border-radius:3px;margin-right:10px;}
.dialog_ft .page{background:#f4f5f9;margin-top:10px;}
.btn:hover, .btn:focus{background-position: 0 0;}
.btn:focus{color:#ffffff;}
.btn{text-shadow: 0 0 0;}
</style>
<div class="dialog_wrp media align_edge ui-draggable" style="display:none;width: 960px; margin-left: -480px; margin-top: -313.5px;" id="dialog_media">
	<div class="dialog">
		<div class="dialog_hd">
			<h3>选择素材</h3>
			<a href="javascript:;" onclick="closeMaterial()" class="icon16_opr closed pop_closed">关闭</a>
		</div>
		<div class="dialog_bd">
			<div class="dialog_media_container appmsg_media_dialog">
				<div class="sub_title_bar in_dialog">
					<div class="search_bar js-btn-media">
						<a class="btn btn_default" value="1" href="javascript:;" onclick="checkBtn(this)"> 文本 </a>
						<a class="btn btn_primary btn_default" value="2" href="javascript:;" onclick="checkBtn(this)"> 单图文 </a>
						<a class="btn btn_default" href="javascript:;" value="3" onclick="checkBtn(this)"> 多图文 </a>
					</div>
					<div class="appmsg_create tr">
						<a class="btn btn_primary btn_add" target="_blank" href="<?php echo __URL('ADMIN_MAIN/wchat/addmedia'); ?>"><i class="icon14_common add_white"></i>新建图文消息</a>
					</div>
				</div>
				<div class="dialog_media_inner" style="overflow:auto;">
					<div class="table_wrp user_list">
						<table class="table" cellspacing="0">
							<tbody class="tbody" id="materia_data"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="dialog_ft">
			<script src="__STATIC__/js/page.js"></script>
<div class="page" id="turn-ul" style="display: none;">
	<div class="pagination">
		<ul>
			<li class="total-data">共0有条数据</li>
			<li class="according-number">每页显示<input type="text" class="input-medium" id="showNumber" value="<?php echo $pagesize; ?>" data-default="<?php echo $pagesize; ?>" autocomplete="off"/>条</li>
			<li><a id="beginPage" class="page-disable" style="border: 1px solid #dddddd;">首页</a></li>
			<li><a id="prevPage" class="page-disable">上一页</a></li>
			<li id="pageNumber"></li>
			<li><a id="nextPage">下一页</a></li>
			<li><a id="lastPage">末页</a></li>
			<li class="page-count">共0页</li>
		</ul>
	</div>
</div>
<input type="hidden" id="page_count" />
<input type="hidden" id="page_size" />
<script>
$(function() {
	try{
		$("#turn-ul").show();//显示分页
		LoadingInfo(1);//通过此方法调用分页类
	}catch(e){
		$("#turn-ul").hide();
	}
	
	//首页
	$("#beginPage").click(function() {
		if(jumpNumber!=1){
			jumpNumber = 1;
			LoadingInfo(1);
			changeClass("begin");
		}
		return false;
	});

	//上一页
	$("#prevPage").click(function() {
		var obj = $(".currentPage");
		var index = parseInt(obj.text()) - 1;
		if (index > 0) {
			obj.removeClass("currentPage");
			obj.prev().addClass("currentPage");
			jumpNumber = index;
			LoadingInfo(index);
			//判断是否是第一页
			if (index == 1) {
				changeClass("prev");
			} else {
				changeClass();
			}
		}
		return false;
	});

	//下一页
	$("#nextPage").click(function() {
		var obj = $(".currentPage");
		//当前页加一（下一页）
		var index = parseInt(obj.text()) + 1;
		if (index <= $("#page_count").val()) {
			jumpNumber = index;
			LoadingInfo(index);
			obj.removeClass("currentPage");
			obj.next().addClass("currentPage");
			//判断是否是最后一页
			if (index == $("#page_count").val()) {
				changeClass("next");
			} else {
				changeClass();
			}
		}
		return false;
	});

	//末页
	$("#lastPage").click(function() {
		jumpNumber = $("#page_count").val();
		if(jumpNumber>1){
			LoadingInfo(jumpNumber);
			$("#pageNumber a:eq("+ (parseInt($("#page_count").val()) - 1) + ")").text($("#page_count").val());
			changeClass("next");
		}
		return false;
	});

	//每页显示页数
	$("#showNumber").blur(function(){
		if(isNaN($(this).val())){
			$("#showNumber").val(20);
			jumpNumber = 1;
			LoadingInfo(jumpNumber);
			return;
		}
		//页数没有变化的话，就不要再执行查询
		if(parseInt($(this).val()) != $(this).attr("data-default")){
// 			jumpNumber = 1;//设置每页显示的页数，并且设置到第一页
			$(this).attr("data-default",$(this).val());
			LoadingInfo(jumpNumber);
		}
		return false;
	}).keyup(function(event){
		if(event.keyCode == 13){
			if(isNaN($(this).val())){
				$("#showNumber").val(20);
				jumpNumber = 1;
				LoadingInfo(jumpNumber);
			}
			//页数没有变化的话，就不要再执行查询
			if(parseInt($(this).val()) != $(this).attr("data-default")){
// 				jumpNumber = 1;//设置每页显示的页数，并且设置到第一页
				$(this).attr("data-default",$(this).val());
				//总数据数量
				var total_count = parseInt($(".total-data").attr("data-total-count"));
				//计算用户输入的页数是否超过当前页数
				var curr_count = Math.ceil(total_count/parseInt($(this).val()));
				if( curr_count !=0 && curr_count < jumpNumber){
					jumpNumber = curr_count;//输入的页数超过了，没有那么多
				}
				LoadingInfo(jumpNumber);
			}
		}
		return false;
	});
});

//跳转页面
function JumpForPage(obj) {
	jumpNumber = $(obj).text();
	LoadingInfo($(obj).text());
	$(".currentPage").removeClass("currentPage");
	$(obj).addClass("currentPage");
	if (jumpNumber == 1) {
		changeClass("prev");
	} else if (jumpNumber < parseInt($("#page_count").val())) {
		changeClass();
	} else if (jumpNumber == parseInt($("#page_count").val())) {
		changeClass("next");
	}
}
</script>
		</div>
	</div>
</div>
<div class="mask mask_metar" style="display: none;"></div>
<script>
function checkBtn(event){
	$(".js-btn-media").find('.btn').removeClass('btn_primary');
	$(event).addClass('btn_primary');
	LoadingInfo(1);
}

//显示素材
function showMaterial(){
	$("#dialog_media").fadeIn(500);
	$(".mask_metar").fadeIn(300);
}

//加载 素材 数据
function LoadingInfo(page_index){
	var type = $(".js-btn-media .btn_primary").attr('value');
	var search_text = '';
	$.ajax({
		type : "post",
		url : "<?php echo __URL('ADMIN_MAIN/wchat/onloadmaterial'); ?>",
		data : {
			"page_index" : page_index,
			"page_size" : $("#showNumber").val(),
			"search_text" : search_text, 
			"type" : type
		},
		success : function(data) {
			var html = '';
			if(data['data'].length > 0){
				for(var i=0; i<data['data'].length; i++){
					if(data['data'][i]['type'] == 1){
						var type_name = '文本 ';
					}else if(data['data'][i]['type'] == 2){
						var type_name = '单图文 ';
					}else if(data['data'][i]['type'] == 3){
						var type_name = '多图文 ';
					}
					html += '<tr><td class="table_cell"><ul class="mater">';
					for(var l=0; l<data['data'][i]['item_list'].length; l++){
						var k = l+1;
						html += '<li><span class="btn_primary">'+ type_name + k+' </span><a href="#">'+data['data'][i]['item_list'][l]['title']+'</a></li>';
					}
					html += '</ul></td>';
					html += '<td>'+timeStampTurnTime(data['data'][i]['create_time'])+'</td>';
					html += '<td class="table_cell user_opr tr"><a class="btn remark js_msgSenderRemark" onclick="selectedMaterial('+data['data'][i]['media_id']+')">选取</a></td>';
					html += '</tr>';
				}
			}else{
				html += '<tr>';
				html += '<td colspan="3" class="table_cell" style="text-align:center;">暂无素材</td>';
				html += '</tr>';
			}
			$("#materia_data").html(html);
			initPageData(data["page_count"],data['data'].length,data['total_count']);
			$("#pageNumber").html(pagenumShow(jumpNumber,$("#page_count").val(),<?php echo $pageshow; ?>));
		}
	});
}

//选择 图文素材
function selectedMaterial(media_id){
	getMaterial(media_id);
	closeMaterial();
}

//取消  关闭
function closeMaterial(){
	$("#dialog_media").fadeOut(300);
	$(".mask_metar").fadeOut();
}
</script>

			<script src="__STATIC__/js/page.js"></script>
<div class="page" id="turn-ul" style="display: none;">
	<div class="pagination">
		<ul>
			<li class="total-data">共0有条数据</li>
			<li class="according-number">每页显示<input type="text" class="input-medium" id="showNumber" value="<?php echo $pagesize; ?>" data-default="<?php echo $pagesize; ?>" autocomplete="off"/>条</li>
			<li><a id="beginPage" class="page-disable" style="border: 1px solid #dddddd;">首页</a></li>
			<li><a id="prevPage" class="page-disable">上一页</a></li>
			<li id="pageNumber"></li>
			<li><a id="nextPage">下一页</a></li>
			<li><a id="lastPage">末页</a></li>
			<li class="page-count">共0页</li>
		</ul>
	</div>
</div>
<input type="hidden" id="page_count" />
<input type="hidden" id="page_size" />
<script>
$(function() {
	try{
		$("#turn-ul").show();//显示分页
		LoadingInfo(1);//通过此方法调用分页类
	}catch(e){
		$("#turn-ul").hide();
	}
	
	//首页
	$("#beginPage").click(function() {
		if(jumpNumber!=1){
			jumpNumber = 1;
			LoadingInfo(1);
			changeClass("begin");
		}
		return false;
	});

	//上一页
	$("#prevPage").click(function() {
		var obj = $(".currentPage");
		var index = parseInt(obj.text()) - 1;
		if (index > 0) {
			obj.removeClass("currentPage");
			obj.prev().addClass("currentPage");
			jumpNumber = index;
			LoadingInfo(index);
			//判断是否是第一页
			if (index == 1) {
				changeClass("prev");
			} else {
				changeClass();
			}
		}
		return false;
	});

	//下一页
	$("#nextPage").click(function() {
		var obj = $(".currentPage");
		//当前页加一（下一页）
		var index = parseInt(obj.text()) + 1;
		if (index <= $("#page_count").val()) {
			jumpNumber = index;
			LoadingInfo(index);
			obj.removeClass("currentPage");
			obj.next().addClass("currentPage");
			//判断是否是最后一页
			if (index == $("#page_count").val()) {
				changeClass("next");
			} else {
				changeClass();
			}
		}
		return false;
	});

	//末页
	$("#lastPage").click(function() {
		jumpNumber = $("#page_count").val();
		if(jumpNumber>1){
			LoadingInfo(jumpNumber);
			$("#pageNumber a:eq("+ (parseInt($("#page_count").val()) - 1) + ")").text($("#page_count").val());
			changeClass("next");
		}
		return false;
	});

	//每页显示页数
	$("#showNumber").blur(function(){
		if(isNaN($(this).val())){
			$("#showNumber").val(20);
			jumpNumber = 1;
			LoadingInfo(jumpNumber);
			return;
		}
		//页数没有变化的话，就不要再执行查询
		if(parseInt($(this).val()) != $(this).attr("data-default")){
// 			jumpNumber = 1;//设置每页显示的页数，并且设置到第一页
			$(this).attr("data-default",$(this).val());
			LoadingInfo(jumpNumber);
		}
		return false;
	}).keyup(function(event){
		if(event.keyCode == 13){
			if(isNaN($(this).val())){
				$("#showNumber").val(20);
				jumpNumber = 1;
				LoadingInfo(jumpNumber);
			}
			//页数没有变化的话，就不要再执行查询
			if(parseInt($(this).val()) != $(this).attr("data-default")){
// 				jumpNumber = 1;//设置每页显示的页数，并且设置到第一页
				$(this).attr("data-default",$(this).val());
				//总数据数量
				var total_count = parseInt($(".total-data").attr("data-total-count"));
				//计算用户输入的页数是否超过当前页数
				var curr_count = Math.ceil(total_count/parseInt($(this).val()));
				if( curr_count !=0 && curr_count < jumpNumber){
					jumpNumber = curr_count;//输入的页数超过了，没有那么多
				}
				LoadingInfo(jumpNumber);
			}
		}
		return false;
	});
});

//跳转页面
function JumpForPage(obj) {
	jumpNumber = $(obj).text();
	LoadingInfo($(obj).text());
	$(".currentPage").removeClass("currentPage");
	$(obj).addClass("currentPage");
	if (jumpNumber == 1) {
		changeClass("prev");
	} else if (jumpNumber < parseInt($("#page_count").val())) {
		changeClass();
	} else if (jumpNumber == parseInt($("#page_count").val())) {
		changeClass("next");
	}
}
</script>
		</div>
		
	</section>
</article>
	
<!-- 公共的操作提示弹出框 common-success：成功，common-warning：警告，common-error：错误，-->
<div class="common-tip-message js-common-tip">
	<div class="inner"></div>
</div>

<!--修改密码弹出框 -->
<div id="edit-password" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:562px;">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3>修改密码</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label" for="pwd0"><span class="color-red">*</span>原密码</label>
				<div class="controls">
					<input type="password" id="pwd0" placeholder="请输入原密码" class="input-common" />
					<span class="help-block"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="pwd1"><span class="color-red">*</span>新密码</label>
				<div class="controls">
					<input type="password" id="pwd1" placeholder="请输入新密码" class="input-common" />
					<span class="help-block"></span>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="pwd2"><span class="color-red">*</span>再次输入密码</label>
				<div class="controls">
					<input type="password" id="pwd2" placeholder="请输入确认密码" class="input-common" />
					<span class="help-block"></span>
				</div>
			</div>
			<div style="text-align: center; height: 20px;" id="show"></div>
		</form>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" onclick="submitPassword()" style="display:inline-block;">保存</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="ADMIN_CSS/jquery-ui-private.css">
<script>
var platform_shopname= 'Niushop开源商城';
</script>
<script type="text/javascript" src="ADMIN_JS/jquery-ui-private.js" charset="utf-8"></script>
<script type="text/javascript" src="ADMIN_JS/jquery.timers.js"></script>
<div id="dialog"></div>
<script type="text/javascript">
function showMessage(type, message,url,time){
	if(url == undefined){
		url = '';
	}
	if(time == undefined){
		time = 2;
	}
	//成功之后的跳转
	if(type == 'success'){
		$( "#dialog").dialog({
			buttons: {
				"确定,#51A351": function() {
					$(this).dialog('close');
				}
			},
			contentText:message,
			time:time,
			timeHref: url,
		});
	}
	//失败之后的跳转
	if(type == 'error'){
		$( "#dialog").dialog({
			buttons: {
				"确定,#e57373": function() {
					$(this).dialog('close');
				}
			},
			time:time,
			contentText:message,
			timeHref: url,
		});
	}
}

function showConfirm(content){
	$( "#dialog").dialog({
		buttons: {
			"确定": function() {
				$(this).dialog('close');
				return 1;
			},
			"取消,#e57373": function() {
				$(this).dialog('close');
				return 0;
			}
		},
		contentText:content,
	});
}
</script>
<script src="ADMIN_JS/ns_common_base.js"></script>
<script src="__STATIC__/blue/js/ns_common_blue.js"></script>
<script>
$(function(){
	//顶部导航管理显示隐藏
	$(".ns-navigation-title>span").click(function(){
		$(".ns-navigation-management").slideUp(400);
	});
	
	$(".js-nav").toggle(function(){
		$(".ns-navigation-management").slideDown(400);
	},function(){
		$(".ns-navigation-management").slideUp(400);
	});
});

</script>

</body>
</html>
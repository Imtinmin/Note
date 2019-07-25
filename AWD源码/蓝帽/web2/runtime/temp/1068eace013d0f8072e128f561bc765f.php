<?php if (!defined('THINK_PATH')) exit(); /*a:7:{s:42:"template/adminblue/Wchat/replayConfig.html";i:1501579286;s:28:"template/adminblue/base.html";i:1501813202;s:45:"template/adminblue/controlCommonVariable.html";i:1501656000;s:28:"template/admin/urlModel.html";i:1501551326;s:45:"template/adminblue/Wchat/controlWxDialog.html";i:1501579286;s:34:"template/adminblue/pageCommon.html";i:1500458992;s:34:"template/adminblue/openDialog.html";i:1500263974;}*/ ?>
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
		
<style>
.step_0{text-align:center;margin:30px;}
.step_1{margin:20px;}
.reply-div{border:1px solid #d3d3d3;width:360px;padding:15px;}
.cover-div{background:#f5f5f5;position:relative;}
.cover-title{position:absolute;left:0;bottom:0;background:#000;color:#fff;width:350px;padding:5px;opacity:0.6;}
.cover-pic{max-width:360px;max-height:200px;margin:auto;display:block;}
.reply-one p,h5{padding:3px 0;}
.reply-one p{color:#999;font-size:13px;}
ul.reply-more li{border-bottom:1px solid #d3d3d3;padding:10px 0;}
ul.reply-more li:after{content:'';clear:both;display:block;}
ul.reply-more li:last-child{border-bottom:0px solid #d3d3d3;padding-bottom:0;}
ul.reply-more li:first-child{padding-top:0;}
.media-div-l{width:270px;margin-right:10px;float:left;}
.media-div-r{width:80px;float:right;}
.media-img{max-width:80px;max-height:200px;margin:auto;display:block;}
.media-button{border:1px solid #d3d3d3;width:390px;border-top:0px solid #d3d3d3;background:#e7e7eb;display:table;}
.media-button a{display:inline-block;width:194.5px;text-align:center;padding:10px 0;}
.media-button a:first-child{border-right:1px solid #d3d3d3;}
</style>

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
					
<?php if($type == '2'): ?>
	<li><a href="<?php echo __URL(ADMIN_MAIN/wchat/addorupdatekeyreplay); ?>"><i class="fa fa-plus-circle"></i>&nbsp;添加关键词回复</a></li>
<?php endif; ?>

					
					<li <?php if($warm_prompt_is_show == 'show'): ?>style="display:none;"<?php endif; ?>><a class="js-open-warmp-prompt"><i class="fa fa-bell"></i>提示</a></li>
					
				</ul>
			</div>
		</div>
		<div class="ns-main">
			
<!-- 关注时回复 -->
<?php if($type == '1'): ?>
<div id="type1">
	<p class="step_0" <?php if(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty())): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>您还未设置回复内容，
		<a href="javascript:;" onclick="showMaterial()">我要马上设置。</a>
	</p>
	
	<div class="step_1" <?php if(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty())): ?>style="display:none;"<?php else: ?>style="display:block;"<?php endif; ?>>
	<!-- 样式模板 -->
		<?php if(!(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty()))): if($info['media_info']['type'] == '1'): ?>
				<div class="reply-div">
					<div class="reply-text">
						<p><?php echo $info['media_info']['title']; ?></p>
					</div>
				</div>
			<?php endif; if($info['media_info']['type'] == '2'): ?>
				<div class="reply-div">
					<div class="reply-one">
						<h5><?php echo $info['media_info']['title']; ?></h5>
						<p>xx月xx日</p>
						<div class="cover-div">
							<?php if($info['media_info']['item_list'][0]['cover'] != ''): ?>
							<img class="cover-pic" src="__UPLOAD__/<?php echo $info['media_info']['item_list'][0]['cover']; ?>">
							<?php else: ?>
							<img class="cover-pic">
							<?php endif; ?>
						</div>
						<p><?php echo $info['media_info']['item_list'][0]['summary']; ?></p>
					</div>
				</div>
			<?php endif; if($info['media_info']['type'] == '3'): ?>
				<div class="reply-div">
					<ul class="reply-more">
					<?php if(is_array($info['media_info']['item_list']) || $info['media_info']['item_list'] instanceof \think\Collection || $info['media_info']['item_list'] instanceof \think\Paginator): if( count($info['media_info']['item_list'])==0 ) : echo "" ;else: foreach($info['media_info']['item_list'] as $k=>$v): if($k == '0'): ?>
							<li>
								<div class="cover-div">
									<?php if($v['cover'] != ''): ?>
									<img class="cover-pic" src="__UPLOAD__/<?php echo $v['cover']; ?>">
									<?php else: ?>
									<img class="cover-pic">
									<?php endif; ?>
									<p class="cover-title"><?php echo $v['title']; ?><p>
								</div>
							</li>
						<?php endif; if($k > '0'): ?>
							<li>
								<div class="media-div-l"><p class="media-title"><?php echo $v['title']; ?></p></div>
								<div class="media-div-r">
									<?php if($v['cover'] != ''): ?>
									<img class="media-img" src="__UPLOAD__/<?php echo $v['cover']; ?>">
									<?php else: ?>
									<img class="media-img">
									<?php endif; ?>
								</div>
							</li>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			<?php endif; endif; ?>
		<div class="media-button">
			<a class="" href="javascript:;" onclick="showMaterial()">修改</a>
			<a class="" href="javascript:;" onclick="delReply()">删除</a>
		</div>
	</div>
</div>
<input type="hidden" id="id" value="<?php echo $info['id']; ?>">
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
<?php endif; if($type == '3'): ?>
<div id="type3">
	<p class="step_0" <?php if(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty())): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>您还未设置回复内容，
		<a href="javascript:;" onclick="showMaterial()">我要马上设置。</a>
	</p>
	
	<div class="step_1" <?php if(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty())): ?>style="display:none;"<?php else: ?>style="display:block;"<?php endif; ?>>
	<!-- 样式模板 -->
		<?php if(!(empty($info) || (($info instanceof \think\Collection || $info instanceof \think\Paginator ) && $info->isEmpty()))): if($info['media_info']['type'] == '1'): ?>
				<div class="reply-div">
					<div class="reply-text">
						<p><?php echo $info['media_info']['title']; ?></p>
					</div>
				</div>
			<?php endif; if($info['media_info']['type'] == '2'): ?>
				<div class="reply-div">
					<div class="reply-one">
						<h5><?php echo $info['media_info']['title']; ?></h5>
						<p>xx月xx日</p>
						<div class="cover-div">
							<?php if($info['media_info']['item_list'][0]['cover'] == ''): ?>
							<img class="cover-pic" >
							<?php else: ?>
							<img class="cover-pic" src="__UPLOAD__/<?php echo $info['media_info']['item_list'][0]['cover']; ?>">
							<?php endif; ?>
						</div>
						<p><?php echo $info['media_info']['item_list'][0]['summary']; ?></p>
					</div>
				</div>
			<?php endif; if($info['media_info']['type'] == '3'): ?>
				<div class="reply-div">
					<ul class="reply-more">
					<?php if(is_array($info['media_info']['item_list']) || $info['media_info']['item_list'] instanceof \think\Collection || $info['media_info']['item_list'] instanceof \think\Paginator): if( count($info['media_info']['item_list'])==0 ) : echo "" ;else: foreach($info['media_info']['item_list'] as $k=>$v): if($k == '0'): ?>
							<li>
								<div class="cover-div">
									<?php if($v['cover'] !=''): ?>
									<img class="cover-pic" src="__UPLOAD__/<?php echo $v['cover']; ?>">
									<?php else: ?>
									<img class="cover-pic">
									<?php endif; ?>
									<p class="cover-title"><?php echo $v['title']; ?><p>
								</div>
							</li>
						<?php endif; if($k > '0'): ?>
							<li>
								<div class="media-div-l"><p class="media-title"><?php echo $v['title']; ?></p></div>
								<div class="media-div-r">
									<?php if($v['cover'] != ''): ?>
									<img class="media-img" src="__UPLOAD__/<?php echo $v['cover']; ?>">
									<?php else: ?>
									<img class="media-img">
									<?php endif; ?>
								</div>
							</li>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			<?php endif; endif; ?>
		<div class="media-button">
			<a href="javascript:;" onclick="showMaterial()">修改</a>
			<a href="javascript:;" onclick="delReply()">删除</a>
		</div>
	</div>
</div>
<input type="hidden" id="id" value="<?php echo $info['id']; ?>">
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
<?php endif; ?>
<!-- 关键字回复 -->
<?php if($type == '2'): ?>
<table class="table-class">
	<colgroup>
		<col style="width: 40%;">
		<col style="width: 20%;">
		<col style="width: 30%;">
	</colgroup>
	<thead>
		<tr>
			<th>关键字</th>
			<th>匹配类型</th>
			<th>操作</th>
		</tr>
	</thead>
	<colgroup>
		<col style="width: 40%;">
		<col style="width: 20%;">
		<col style="width: 30%;">
	</colgroup>
	<tbody></tbody>
</table>
<script>
$(function(){
	var type = $("#type").val();
	if(type == 2){
		LoadingInfo(1);
	}
});

function LoadingInfo(page_index) {
	$.ajax({
		type : "post",
		url : "<?php echo __URL('ADMIN_MAIN/wchat/keyreplaylist'); ?>",
		data : { "page_index" : page_index, "page_size" : $("#showNumber").val() },
		success : function(data) {
			var html = '';
			if (data["data"].length > 0) {
				for (var i = 0; i < data["data"].length; i++) {
					html += '<tr align="center">';
					html += '<td>' + data["data"][i]["key"] + '</td>';
					if(data["data"][i]["match_type"] == 1){
						html += '<td>模糊匹配</td>';
					}else{
						html += '<td>全部匹配</td>';
					}
					html += '<td><a href="'+__URL('ADMIN_MAIN/wchat/addorupdatekeyreplay?id=' + data["data"][i]["id"])+'">修改</a>&nbsp;&nbsp; ';
					html += '<a href="javascript:void(0);" onclick="delKeyReply(' + data["data"][i]["id"] + ')">删除</a></td>';
					html += '</tr>';
				}
			} else {
				html += '<tr align="center"><td colspan="3">暂无符合条件的数据记录</td></tr>';
			}
			$(".table-class tbody").html(html);
			initPageData(data["page_count"],data['data'].length,data['total_count']);
			$("#pageNumber").html(pagenumShow(jumpNumber,$("#page_count").val(),<?php echo $pageshow; ?>));
		}
	});
}
</script>
<?php endif; ?>
<input type="hidden" id="type" value="<?php echo $type; ?>">
<script>
function delKeyReply(id){
	$( "#dialog" ).dialog({
		buttons: {
			"确定": function() {
			$(this).dialog('close');
				$.ajax({
					url : __URL(ADMINMAIN + "/wchat/delkeyreply"),
					type : "post",
					data : { "id" : id },
					success : function(data){
						if(data['code'] > 0){
							showMessage('success', data['message'], __URL(ADMINMAIN + "/wchat/replayconfig?type=2"));
						}else{
							showMessage('error', data['message']);
						}
					}
				});
			},
			"取消,#e57373": function() {
				$(this).dialog('close');
			}
		},
		contentText:"确定删除？",
	});
}

function getMaterial(media_id){
	$.ajax({
		url : __URL(ADMINMAIN + "/wchat/getweixinmediadetail"),
		type : "post",
		data : { "media_id" : media_id },
		success : function(data){
			var html = '';
			if(data){
				html += '<div class="reply-div">';
				if(data['type'] == 1){
					html += '<div class="reply-text">';
					html += '<p>'+data['title']+'</p>';
					html += '</div>';
				}else if(data['type'] == 2){
					html += '<div class="reply-one">';
					html += '<h5>'+data['item_list'][0]['title']+'</h5>';
					html += '<p>xx月xx日</p>';
					html += '<div class="cover-div"><img class="cover-pic" src="'+UPLOAD+'/'+data['item_list'][0]['cover']+'"></div>';
					html += '<p>'+data['item_list'][0]['summary']+'</p>';
					html += '</div>';
				}else if(data['type'] == 3){
					html += '<ul class="reply-more">';
					for(var i=0; i < data['item_list'].length; i++){
						if(i < 1){
							html += '<li><div class="cover-div">';
							html += '<img class="cover-pic" src="'+UPLOAD+'/'+data['item_list'][i]['cover']+'">';
							html += '<p class="cover-title">'+data['item_list'][i]['title']+'<p>';
							html += '</div></li>';
						}else{
							html += '<li>';
							html += '<div class="media-div-l"><p class="media-title">'+data['item_list'][i]['title']+'</p></div>';
							html += '<div class="media-div-r"><img class="media-img" src="'+UPLOAD+'/'+data['item_list'][i]['cover']+'"></div>';
							html += '</li>';
						}
					}
					html += '</ul>';
				}
				html += '</div>';
			}
			var type = $("#type").val();
			$("#type"+type+" .step_0").hide();
			$("#type"+type+" .step_1").show();
			$("#type"+type+" .step_1 .reply-div").remove();
			$("#type"+type+" .step_1 .media-button").before(html);
			if(type == 1){
				addOrUpdateFollowReply(media_id);
			}else if(type == 3){
				addOrUpdateDefaultReply(media_id);
			}
		}
	})
}

//添加 或 修改 关注时回复
function addOrUpdateFollowReply(media_id){
	var id = $("#id").val();
	var type = $("#type").val();
	$.ajax({
		url : __URL(ADMINMAIN + "/wchat/addorupdatefollowreply"),
		type : "post",
		data : { "media_id" : media_id, "id" : id },
		success : function(data){
			if(data['code'] > 0){
				showMessage('success', data['message']);
			}else{
				showMessage('error', data['message']);
			}
		}
	})
}

//添加 或 修改 默认回复
function addOrUpdateDefaultReply(media_id){
	var id = $("#id").val();
	var type = $("#type").val();
	$.ajax({
		url : __URL(ADMINMAIN + "/wchat/addorupdatedefaultreply"),
		type : "post",
		data : { "media_id" : media_id, "id" : id },
		success : function(data){
			if(data['code'] > 0){
				showMessage('success', data['message']);
			}else{
				showMessage('error', data['message']);
			}
		}
	})
}

//删除 回复
function delReply(){
	var type = $("#type").val();
	$.ajax({
		url : __URL(ADMINMAIN + "/wchat/delreply"),
		type : "post",
		data : { "type" : type},
		success : function(data){
			if(data['code'] > 0){
				showMessage('success', data['message'], __URL(ADMINMAIN + "/wchat/replayconfig?type="+type));
			}else{
				showMessage('error', data['message']);
			}
		}
	})
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
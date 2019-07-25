<?php if (!defined('THINK_PATH')) exit(); /*a:21:{s:35:"template/shop/blue/Index/index.html";i:1499844462;s:28:"template/shop/blue/base.html";i:1501842882;s:32:"template/shop/blue/urlModel.html";i:1501656016;s:43:"template/shop/blue/Index/controlHeadAd.html";i:1501656022;s:34:"template/shop/blue/controlTop.html";i:1501656020;s:41:"template/shop/blue/controlHeadSerach.html";i:1501656020;s:44:"template/shop/blue/controlHeadSearchAdv.html";i:1500458998;s:43:"template/shop/blue/controlHeadGoodType.html";i:1501808090;s:40:"template/shop/blue/controlCommonNav.html";i:1501551342;s:44:"template/shop/blue/Index/controlHeadNav.html";i:1499844462;s:49:"template/shop/blue/Index/controlHeadNavRight.html";i:1501743912;s:43:"template/shop/blue/controlRightSidebar.html";i:1501656026;s:45:"template/shop/blue/Index/controlIndexAdv.html";i:1499844462;s:56:"template/shop/blue/Index/controlLimitedTimeDiscount.html";i:1501656022;s:49:"template/shop/blue/Index/controlCommendBlock.html";i:1501656022;s:45:"template/shop/blue/Index/controlRecFloor.html";i:1501656022;s:51:"template/shop/blue/Index/controlFriendshipLink.html";i:1501656022;s:45:"template/shop/blue/controlBottomLinkHelp.html";i:1501551342;s:37:"template/shop/blue/controlBottom.html";i:1501752182;s:36:"template/shop/blue/controlLogin.html";i:1501836248;s:37:"template/shop/blue/baidu_js_push.html";i:1499844478;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-COMPATIBLE" content="IE=edge,chrome=1"/>
<meta charset="UTF-8">
<meta name="renderer" content="webkit"> 
<title><?php echo $title_before; ?><?php echo $title; if($seoconfig['seo_title'] != ''): ?>&nbsp;-&nbsp;<?php echo $seoconfig['seo_title']; endif; ?></title>
<meta name="keywords" content="<?php echo $seoconfig['seo_meta']; ?>" />
<meta name="description" content="<?php echo $seoconfig['seo_desc']; ?>"/>
<link rel="shortcut  icon" type="image/x-icon" href="__TEMP__/<?php echo $style; ?>/public/images/favicon.ico" media="screen"/>
<!--可共用-->
<link type="text/css" rel="stylesheet" href="__TEMP__/<?php echo $style; ?>/public/css/ns_common.css">
<link type="text/css" rel="stylesheet" href="__TEMP__/<?php echo $style; ?>/public/css/ns_color_style.css">
<link type="text/css" rel="stylesheet" href="__TEMP__/<?php echo $style; ?>/public/css/iconfont.css">
<link type="text/css" rel="stylesheet" href="__TEMP__/<?php echo $style; ?>/public/css/ns_bottom.css">
<link rel="stylesheet" href="__TEMP__/<?php echo $style; ?>/public/css/layer.css" id="layuicss-skinlayercss">
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.js"></script>
<script type="text/javascript">
	var shop_main='SHOP_MAIN';//外置JS调用
	var app_main='APP_MAIN';//外置JS调用
	var upload = "__UPLOAD__";//外置JS调用
	var ADMINMAIN='ADMIN_MAIN';
	var TEMP_IMG = "__TEMP__/<?php echo $style; ?>/public/images";
	var temp = "__TEMP__/";//外置JS调用
	$(function(){
		//一级菜单选中	
		$('#nav li>a').removeClass('current');
		var path_info='<?php echo $path_info; ?>';
		if(path_info==''){
			$("#nav li>a[href^='<?php echo __URL('SHOP_MAIN/index/index'); ?>']").addClass('current');
		}else{
			$("#nav li>a[href^='<?php echo __URL('SHOP_MAIN/'.$path_info); ?>']").addClass('current');
		}
	})
	
	window.onload=function(){
		$.footer();
	}
</script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/ns_cart.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/common.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/ns_components.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.fly.min.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/layer.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.method.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/nav.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.cookie.js"></script>
<script src="__STATIC__/js/ajax_file_upload.js" type="text/javascript"></script>
<script src="__STATIC__/js/file_upload.js" type="text/javascript"></script>
<script src="__STATIC__/js/load_task.js" type="text/javascript"></script>
<script src="__STATIC__/js/load_bottom.js" type="text/javascript"></script>
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
<!--继承base可重写-->




<!-- 右侧购物车 -->

<!-- 添加css、字体文件文件 -->
<link type="text/css" rel="stylesheet" href="__TEMP__/<?php echo $style; ?>/public/css/ns_default.css">
<style>
body{
	background: #F5F5F5;
}
</style>

</head>
<body>
<!-- 头部广告 -->

<!--
	创建人：王永杰
	创建时间：2017年2月7日 12:02:25
	功能描述： 首页顶部广告图，可以关闭。此广告只在网站首页展示 
-->
<div class="top-active">
	<div class="top-active-wrap"></div>
</div>
<script type="text/javascript">
var ap_id=1051;
var data=platformAdvLoadNew(ap_id);
if(data !=null && data != ''){
	var width = data['ap_width'];
	var height = data['ap_height'];
	if(data['adv_list'][0]['adv_image'] != ''){
		$(".top-active").css("background-color",data['adv_list'][0]["background"]);
		$('.top-active-wrap').html('<a href="'+data['adv_list'][0]['adv_url']+'" target="_blank"><img src="__UPLOAD__/'+data['adv_list'][0]['adv_image']+'"></a><a href="javascript:void(0);" title="关闭" class="top-active-close"></a>');
	}else{
		$(".top-active").css("background-color","#0287E1");
		$('.top-active-wrap').html('<a href="javascript:;" target="_blank"><img src="__TEMP__/<?php echo $style; ?>/public/images/style_blue_head_adv.png"></a><a href="javascript:void(0);" title="关闭" class="top-active-close"></a>');
	}
}
</script>


<!-- 公共的顶部（部分界面不用，例如，商家入驻） -->

	<!--
	创建时间：2017年2月7日 12:08:45
	功能描述： 顶部， 
-->
<div class="header-top">
	<div class="header-box">
		<font id="login-info" class="login-info"></font>
		<ul>
			<li><a class="menu-hd home" href="<?php echo __URL('SHOP_MAIN'); ?>" target="_top"><i></i>商城首页</a></li>
			<li class="menu-item">
				<div class="menu">
					<a class="menu-hd myinfo" href="<?php echo __URL('SHOP_MAIN/member/index'); ?>" target="_blank"><i></i> 个人中心 <b></b></a>
					<div id="menu-2" class="menu-bd">
						<span class="menu-bd-mask"></span>
						<div class="menu-bd-panel">
							<a href="<?php echo __URL('SHOP_MAIN/member/orderlist'); ?>" target="_blank">已买到的宝贝</a>
							<a href="<?php echo __URL('SHOP_MAIN/member/addresslist'); ?>" target="_blank">我的地址管理</a>
							<a href="<?php echo __URL('SHOP_MAIN/member/goodscollectionlist'); ?>" target="_blank">我收藏的宝贝</a>
						</div>
					</div>
				</div>
			</li>
			<!-- <li class="menu-item cartbox"><a class="menu-hd cart" href="<?php echo __URL('SHOP_MAIN/goods/cart'); ?>" target="_top"><i></i>&nbsp;购物车</a></li> -->
			<li class="menu-item">
				<div class="menu">
					<a class="menu-hd we-chat"
						href="javascript:;" target="_top"> <i></i>
						关注商城 <b></b>
					</a>
					<div id="menu-5" class="menu-bd we-chat-qrcode">
						<span class="menu-bd-mask"></span> <a target="_top"> <img src="__UPLOAD__/<?php echo $web_info['web_qrcode']; ?>" alt="官方微信"></a>
						<p class="font-14">关注官方微信</p>
					</div>
				</div>
			</li>
<!-- 			<li class="menu-item"> -->
<!-- 				<div class="menu"> -->
<!-- 					<a href="<?php echo __URL('SHOP_MAIN/helpcenter/index'); ?>" class="menu-hd site-nav" target="_blank"> 商家支持 <b></b></a> -->
<!-- 					<div id="menu-7" class="menu-bd site-nav-main"> -->
<!-- 						<span class="menu-bd-mask"></span> -->
<!-- 						<div class="menu-bd-panel"> -->
<!-- 							<div class="site-nav-con"> -->
<!-- 								<a href="<?php echo __URL('SHOP_MAIN/helpcenter/index','id=2'); ?>" target="_blank" title="常见问题">常见问题</a> -->
<!-- 								<a href="<?php echo __URL('SHOP_MAIN/helpcenter/index','id=7'); ?>" target="_blank" title="网上支付">网上支付</a> -->
<!-- 								<a href="<?php echo __URL('SHOP_MAIN/helpcenter/index','id=5'); ?>" target="_blank" title="验货与签收">验货与签收</a> -->
<!-- 								<a href="<?php echo __URL('SHOP_MAIN/helpcenter/index','id=9'); ?>" target="_blank" title="退款说明">退款说明</a> -->
<!-- 							</div> -->
<!-- 						</div> -->
<!-- 					</div> -->
<!-- 				</div> -->
<!-- 			</li> -->
			<li class="menu-item"><a  href="<?php echo __URL('APP_MAIN'); ?>" class="menu-hd wap-nav" > <i></i>手机端</a></li>
			<li class="menu-item"><a href="<?php echo __URL('SHOP_MAIN/helpcenter/index'); ?>" class="menu-hd site-nav" target="_blank">帮助中心</a></li>
		</ul>
	</div>
</div>

<script type="text/javascript">
$.ajax({
	type:"post",
	url:"<?php echo __URL('SHOP_MAIN/components/getlogininfo'); ?>",
	success:function(data){
		var login_info_html='';
		if(data!=null && data!=""){
// 			if(data["user_info"]["nick_name"]!= null && data["user_info"]["nick_name"] != ""){
				login_info_html='<a class="sn-login color" href="<?php echo __URL('SHOP_MAIN/member/index'); ?>" target="_top">'+data["user_info"]["nick_name"]+'</a><em>欢迎您回来！</em><a class="sn-register" href="javascript:logout();" target="_top">退出</a>';
				$('div.login-info').html('<font id="login-info" class="login-info NS-USER-ALREADY-LOGIN"><em><a href="<?php echo __URL('SHOP_MAIN/member/index'); ?>" target="_blank" class="color NS-USER-NAME">'+data["user_info"]["nick_name"]+'</a></em><a href="javascript:logout();" data-method="post" class="logout bg-color">退出</a></font>');
// 			}
		}else{
			login_info_html='<em>欢迎来到<?php echo $title; ?></em><a class="login color" href="<?php echo __URL('SHOP_MAIN/login/index'); ?>" target="_top">请登录</a><a class="register" href="<?php echo __URL('SHOP_MAIN/login/registerbox'); ?>" target="_top">免费注册</a>';
			$('div.login-info').html('<font id="login-info" class="login-info"><a class="login color" href="<?php echo __URL('SHOP_MAIN/login/index'); ?>" target="_top">登录</a><a class="register bg-color" href="<?php echo __URL('SHOP_MAIN/login/registerbox'); ?>" target="_top">免费注册</a></font>');
		}
		$('#login-info').html(login_info_html);
	}
});

//退出登录
function logout(){
	$.ajax({
		url: "<?php echo __URL('SHOP_MAIN/member/logout'); ?>",
		type: "post",
		success: function (res) {
			if (res['code'] > 0) {
// 				location.href='SHOP_MAIN';
				$.msg("退出成功！");
				window.location.reload();
			} else {
				if(res["message"]!=null){
					$.msg(res["message"]);
				}
			}
		}
	})
}
</script>


<!-- 头部，菜单栏、搜索、导航栏 -->

	<!--
	创建人：王永杰
	创建时间：2017年2月7日 12:09:42
	功能描述：顶部logo、搜索 
-->
<script type="text/javascript">
	//显示搜索历史
	function SearRecord(){
		var arrSear=new Array();
		var strSear = $.cookie("searchRecord");
		var sear_html='<span>最近搜索</span>';
		if(typeof(strSear)!='undefined' && strSear!='null'){
			var arrSear=JSON.parse(strSear);
			sear_html+='<a href="javascript:clearSearRecord();" class="clear-history"> <i></i>清空</a><br/>';
			for(var i=0;i<arrSear.length;i++){
				sear_html+='<a href="'+__URL('SHOP_MAIN/goods/goodslist?keyword='+arrSear[i])+'" style="display:inline-block;">'+arrSear[i]+'</a>';
			}
		}
		$('#search_titles').html(sear_html);
	}
	//清除搜索历史
	function clearSearRecord(){
		clear = JSON.stringify(new Array());
		$.cookie("searchRecord", clear);
		SearRecord();
	}
	
	$(function(){
		SearRecord();
	});
</script>
<div class="as-shelter"></div>
<div class="follow-box">
	<div class="follow-box-con">
		<a href="<?php echo __URL('SHOP_MAIN'); ?>" class="logo"><img src="__UPLOAD__/<?php echo $web_info['logo']; ?>" class="web-logo"/></a>
		<div class="search NS-SEARCH-BOX-TOP">
			<form class="search-form NS-SEARCH-BOX-FORM" method="get"  onsubmit="return false">
				<div class="search-info">
					<div class="search-type-box">
						<ul class="search-type" style="height: 36px; overflow: hidden;">
							<li class="search-li-top curr" num="0">宝贝</li>
<!-- 							<li class="search-li-top" num="1" >店铺</li> -->
						</ul>
<!-- 						<i></i> -->
					</div>
					<div class="search-box">
						<div class="search-box-con">
							<input type="text"
								class="search-box-input NS-SEARCH-BOX-KEYWORD" name="keyword" tabindex="9" autocomplete="off" data-searchwords="<?php echo $default_keywords; ?>" placeholder="<?php echo $default_keywords; ?>"  value="<?php if($keyword !=''): ?><?php echo $keyword; endif; ?>">
						</div>
					</div>
					<input type="hidden" id="searchtypeTop" name="type" value="0" class="searchtype">
					<input type="button" id="btn_search_box_submit_top" value="搜索" class="button NS-SEARCH-BOX-SUBMIT-TOP">
				</div>
			</form>
		</div>
		<div class="login-info"></div>
	</div>
</div>
<div class="header">
	<div class="w1210">
		<div class="logo-info">
			<a href="<?php echo __URL('SHOP_MAIN'); ?>" class="logo"> <img src="__UPLOAD__/<?php echo $web_info['logo']; ?>" class="web-logo"/></a>
		</div>
		<div class="search NS-SEARCH-BOX">
			<form class="search-form NS-SEARCH-BOX-FORM" method="get"  onsubmit="return false">
				<div class="search-info">
					<div class="search-type-box">
						<ul class="search-type">
							<li class="search-li curr" num="0">宝贝</li>
<!-- 							<li class="search-li" num="1">店铺</li> -->
						</ul>
<!-- 						<i></i> -->
					</div>
					<div class="search-box">
						<div class="search-box-con">
							<input type="text" class="keyword search-box-input NS-SEARCH-BOX-KEYWORD" name="keyword" tabindex="9" autocomplete="off" data-searchwords="<?php echo $default_keywords; ?>" placeholder="<?php echo $default_keywords; ?>" value="<?php if($keyword !=''): ?><?php echo $keyword; endif; ?>" />
						</div>
					</div>
					<!-- <input type="hidden" id="searchtype" name="type" value="0" class="searchtype"> --> 
					<input type="button" id="btn_search_box_submit" value="搜索" class="button btn_search_box_submit NS-SEARCH-BOX-SUBMIT">
				</div>
				<!-- -热门搜索热搜词显示 -->
				<div class="search-results hide NS-SEARCH-BOX-HELPER" style="display: none;">
					<ul class="history-results">
						<li class="title" id="search_titles" style="word-wrap:break-word "></li>
						
					</ul>
					<ul class="rec-results">
						<li class="title"><span>正在热搜中</span> <i class="close"></i></li>
						<?php if(is_array($hot_keys) || $hot_keys instanceof \think\Collection || $hot_keys instanceof \think\Paginator): $i = 0; $__LIST__ = $hot_keys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hot_key): $mod = ($i % 2 );++$i;?>
						<li><a  href="<?php echo __URL('SHOP_MAIN/goods/goodslist','keyword='.$hot_key); ?>" title="<?php echo $hot_key; ?>"><?php echo $hot_key; ?></a></li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
			</form>
			<ul class="hot-query">
				<!-- 默认搜索词 -->
				<li class="first"><a href="javascript:void(0);"></a></li>
			</ul>
		</div>
		<!-- 搜索框右侧小广告 _start -->
		<div class="header-right">
		<a href="<?php echo __URL('SHOP_MAIN/goods/cart'); ?>" class="my-cart"><span class="ico"></span>购物车结算<span class="right_border"></span></a>
			<a href="<?php echo __URL('SHOP_MAIN/member'); ?>" class="my-mall"><span class="ico"></span>我的商城<span class="right_border"></span></a>
		</div>
		<!-- 搜索框右侧小广告 _end -->
	</div>
</div>
<!-- logo栏小广告  -->
<!-- logo栏小广告 
	李志伟
	2017年2月10日10:28:30
 -->
<script type="text/javascript">
	//logo右侧小广告 
	var ap_id=1052;
	var data=platformAdvLoad(ap_id);
	if(data !=''){
		$('.logo-info').append('<a href="'+data[0]['adv_url']+'" class="logo-right"> <img src="__UPLOAD__/'+data[0]['adv_image']+'" style="max-width:'+data[0]['adv_width']+'px;max-height:'+data[0]['adv_height']+'px;"> </a>');
	}
	//搜索框右侧小广告
	//$('.header-right').html('<a href="'+data[1]['adv_url']+'" target="_blank" title="">  <img src="__UPLOAD__/'+data[1]['adv_image']+'"></a>');
</script>
<script type="text/javascript">
	$(document).ready(function() {
		// 搜索框提示显示
		$('.NS-SEARCH-BOX .NS-SEARCH-BOX-KEYWORD').focus(function() {
			$(".NS-SEARCH-BOX .NS-SEARCH-BOX-HELPER").show();
		});
		// 搜索框提示隐藏
		$(".NS-SEARCH-BOX-HELPER .close").on('click',function() {
			$(".NS-SEARCH-BOX .NS-SEARCH-BOX-HELPER").hide();
		});
		// 清除记录
		$(".NS-SEARCH-BOX-HELPER .clear").click(function() {
			var url = '/search/clear-record.html';
			$.post(
				url,
				{},
				function(result) {
					if (result.code == 0) {
						$(".history-results .active").empty();
					} else {
					}
				},
				'json');
		});
	});
	function search_box_remove(key) {
		var url = '/search/delete-record.html';
		$.post(url, {
			data : key
		}, function(result) {
			if (result.code == 0) {
				$("#" + key).css("display", "none");
			} else {

			}
		}, 'json');
	}
	$(document).on("click", function(e) {
		var target = $(e.target);
		if (target.closest(".NS-SEARCH-BOX").length == 0) {
			$('.NS-SEARCH-BOX-HELPER').hide();
		}
	})
</script>
<script type="text/javascript">
	//固定搜索
	$(document).ready(function() {
		$(".NS-SEARCH-BOX .NS-SEARCH-BOX-SUBMIT").click(function() {
			var keyword_obj = $(this).parents(".NS-SEARCH-BOX").find(".NS-SEARCH-BOX-KEYWORD");
			var keywords = keyword_obj.val();
			if ($.trim(keywords).length == 0
					|| $.trim(keywords) == "请输入关键词") {
				keywords = keyword_obj.attr("data-searchwords");
			}
			
			$(keyword_obj).val(keywords);
			if(keywords==null)
			{
				keywords = "";
			}

			if($.cookie("searchRecord") != undefined){
				var arr = eval($.cookie("searchRecord"));				
			}else{
				var arr = new Array();
			}
			if(arr.length >0 ){
				if($.inArray(keywords,arr)< 0){
					arr.push(keywords);
				}
			}else{
				arr.push(keywords);
			}
			$.cookie("searchRecord",JSON.stringify(arr));

			if ($(".search-li.curr").attr('num') == 0) {
				window.location.href = __URL('SHOP_MAIN/goods/goodslist?keyword='+keywords);
			}else{
				window.location.href = __URL('SHOP_MAIN/shop/shopstreet?shopname='+keywords);
			}
		});
	});
	//浮动搜索
	$(document).ready(function() {
		$(".NS-SEARCH-BOX-TOP .NS-SEARCH-BOX-SUBMIT-TOP").click(function() {
			var keyword_obj = $(this).parents(".NS-SEARCH-BOX-TOP").find(".NS-SEARCH-BOX-KEYWORD");
			var keywords = $(keyword_obj).val();
			if ($.trim(keywords).length == 0
					|| $.trim(keywords) == "请输入关键词") {
				keywords = $(keyword_obj).attr("data-searchwords");
			}

			if($.cookie("searchRecord") != undefined){
				var arr = eval($.cookie("searchRecord"));				
			}else{
				var arr = new Array();
			}
			if(arr.length >0 ){
				if($.inArray(keywords,arr)< 0){
					arr.push(keywords);
				}
			}else{
				arr.push(keywords);
			}
			$.cookie("searchRecord",JSON.stringify(arr));

			$(keyword_obj).val(keywords);
			if ($(".search-li-top.curr").attr('num') == 0) {
				window.location.href = __URL('SHOP_MAIN/goods/goodslist?keyword='+keywords);
			}else{
				window.location.href = __URL('SHOP_MAIN/shop/shopstreet?shopname='+keywords);
			}
		});
	});
</script>


<!--头部商品分类 start-->

<!--
	创建人：李志伟
	创建时间：2017年2月7日 12:22:28
	功能描述：导航栏、菜单栏 、商品分类（与首页的样式不同，没有轮播图）
-->
<?php if($is_head_goods_nav == 1): ?>
<div class="category-box">
<?php else: ?>
<div class="category-box category-box-border">
<?php endif; ?>
	<div class="w1210">
		<div class="home-category fl">
			<a href="SHOP_MAIN/goods/category" class="menu-event" title="查看全部商品分类"><i></i>全部商品分类</a>
			<?php if($is_head_goods_nav == 1): ?>
			<div class="category-layer" style="display: block;">
			<?php else: ?>
			<div class="expand-menu category-layer" style="display: none;">
			<?php endif; ?>
				<!-- 公共的菜单栏-->
				<div class="category-layer">
					<span class="category-layer-bg"></span>
					<?php foreach($goods_category_one as $k=>$vo): if($k < 13): ?>
					<div class="list">
						<dl class="cat">
							<dt class="cat-name">
								<a href="<?php echo __URL('SHOP_MAIN/goods/goodslist?category_id='.$vo['category_id']); ?>" target="_blank" title="<?php echo $vo['category_name']; ?>"><?php echo $vo['category_name']; ?></a>
							</dt>
							<?php if($vo['count'] >0): ?>
							<i class="right-arrow"></i>
							<?php endif; ?>
						</dl>
						<div class="categorys" style="display: none;">
							<div class="item-left fl">
								<div class="subitems">
								<?php foreach($goods_category_two as $vo2): if($vo2['pid'] == $vo['category_id']): ?>
										<dl class="fore1">
											<dt style="width: 5em;">
												<a href="<?php echo __URL('SHOP_MAIN/goods/goodslist', 'category_id='.$vo2['category_id']); ?>" target="_blank" title="<?php echo $vo2['category_name']; ?>">
													<em><?php echo $vo2['category_name']; ?></em>
													<?php if($vo2['count'] >0): ?>
													<i></i>
													<?php endif; ?>
												</a>
											</dt>
											<dd>
												<?php foreach($goods_category_three as $vo3): if($vo3['pid'] == $vo2['category_id']): ?>
													<a href="<?php echo __URL('SHOP_MAIN/goods/goodslist', 'category_id='.$vo3['category_id']); ?>" target="_blank" title="<?php echo $vo3['category_name']; ?>"><?php echo $vo3['category_name']; ?></a>
													<?php endif; endforeach; ?>
											</dd>
										</dl>
									<?php endif; endforeach; ?>
								</div>
							</div>
						</div>
					</div>
					<?php endif; endforeach; ?>
				</div>
			</div>
		</div>
		<!-- 公共的菜单栏-->
	<div class="all-category fl" id="nav">
	<ul>
	<?php if(is_array($navigation_list) || $navigation_list instanceof \think\Collection || $navigation_list instanceof \think\Paginator): if( count($navigation_list)==0 ) : echo "" ;else: foreach($navigation_list as $k=>$nav): ?>
		<li class="fl" >
			<?php if($nav['nav_type'] == 0): if($nav['is_blank'] == 1): ?>
					<a class="nav" target="_blank" href="<?php echo __URL('SHOP_MAIN'.$nav['nav_url']); ?>"  title="<?php echo $nav['nav_title']; ?>"><?php echo $nav['nav_title']; ?></a>
				<?php else: ?>
					<a class="nav" href="<?php echo __URL('SHOP_MAIN'.$nav['nav_url']); ?>"  title="<?php echo $nav['nav_title']; ?>"><?php echo $nav['nav_title']; ?></a>
				<?php endif; else: if($nav['is_blank'] == 1): ?>
					<a class="nav" target="_blank" href="<?php echo __URL($nav['nav_url']); ?>"  title="<?php echo $nav['nav_title']; ?>"><?php echo $nav['nav_title']; ?></a>
				<?php else: ?>
					<a class="nav" href="<?php echo __URL($nav['nav_url']); ?>"  title="<?php echo $nav['nav_title']; ?>"><?php echo $nav['nav_title']; ?></a>
				<?php endif; endif; ?>
		</li>
	<?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<div class="wrap-line">
		<span style="left: 15px;"></span>
	</div>
</div>
	</div>
</div>
<!-- 滚动图片广告位 -->
<div class="template-one">
	<div class="banner">
		<!--
	创建人：王永杰
	创建时间：2017年2月7日 12:05:24
	功能描述： 首页导航栏、 菜单栏、、商品分类、轮播图（目前只有首页才拥有这个组件）
-->
<ul id="fullScreenSlides" class="full-screen-slides"></ul>
<ul class="full-screen-slides-pagination"></ul>
<script type="text/javascript">
	//轮播图
	var ap_id=1053;
	var data=platformAdvLoad(ap_id);
	var bannerhtml='';
	var slideshtml='';
	if(data !=null && data.length>0){

		for(var i=0;i<data.length;i++){
			if(data[i]['adv_image'] == ''){

				if(i==0){
					bannerhtml+='<li style="display: list-item;background: url(__TEMP__/<?php echo $style; ?>/public/images/style_blue_banner.png) no-repeat center;background-size: auto"><a href="javascript:;" target="_blank">&nbsp;</a> </li>';
				}
				
			}else{
				
				if(i==0){
					bannerhtml+='<li style="display: list-item;background: url(__UPLOAD__/'+data[i]['adv_image']+') no-repeat center;background-color:'+data[i]['background']+';background-size: auto"><a href="'+data[i]['adv_url']+'" target="_blank" >&nbsp;</a> </li>';
				}else{
					bannerhtml+='<li style="display: none;background: url(__UPLOAD__/'+data[i]['adv_image']+') no-repeat center;background-color:'+data[i]['background']+';background-size: auto"><a href="'+data[i]['adv_url']+'" target="_blank" >&nbsp;</a> </li>';
				}
			}
		}
		for(var i=1;i<=data.length;i++){
			if(i==1){
				slideshtml+='<li class="current"><a href="javascript:void(0);">'+i+'</a></li>';
			}else{
				slideshtml+='<li><a href="javascript:void(0);">'+i+'</a></li>';
			}
		}
	}
	$('#fullScreenSlides').html(bannerhtml);
	$('.full-screen-slides-pagination').html(slideshtml);
</script>  <!--滚动图-->
		<!--滚动图右侧公告及其小菜单
	2017年2月14日12:28:00
-->
<script type="text/javascript">
$.ajax({
	type:"post",
	url:"<?php echo __URL('SHOP_MAIN/components/getlogininfo'); ?>",
	success:function(data){
		var login_info_html='';
		if(data != null && data !=""){
			if(data["user_info"]["nick_name"]!=null && data["user_info"]["nick_name"] != ""){
				if(data["user_info"]["user_headimg"]==""){
					login_info_html+='<div class="login_img"><img src="__TEMP__/<?php echo $style; ?>/public/images/temp_default_user_portrait_0.png" alt="默认头像" /></div>';
				}else{
					login_info_html+='<div class="login_img"><img src="__UPLOAD__/'+data["user_info"]["user_headimg"]+'" alt="默认头像" /></div>';
				}
				login_info_html+='<div class="login-message"><p class="message-title">Hi,我是<a href="<?php echo __URL('SHOP_MAIN/member/index'); ?>" class="member_name" title="'+data["user_info"]["nick_name"]+'">'+data["user_info"]["nick_name"]+'</a></p><p class="message-operation"><a href="javascript:logout();" class="logout" >安全退出</a></p></div>';
			}
		}else{
			login_info_html += '<div class="login_img">';
			login_info_html += '<img src="__TEMP__/<?php echo $style; ?>/public/images/temp_default_user_portrait_0.png" alt="默认头像" />';
			login_info_html += '</div>';
			login_info_html += '<div class="login-message">';
			login_info_html += '<p class="message-title">Hi,欢迎登录<?php echo $title; ?></p>';
			login_info_html += '<p class="message-operation">';
			login_info_html += '<a href="javascript:;" class="login ajax-login">登录</a>';
			login_info_html += '<a href="'+__URL('SHOP_MAIN/login/registerbox')+'" class="register">注册</a>';
			login_info_html += '</p></div>';
		}
		$('.right-login-message').html(login_info_html);
	}
});
</script>
<div class="right-sidebar NS-TEMPLATE-NAV-CONTAINER">
	<!-- 个人信息 -->
	<div class="right-login-message">
		<div style="text-align:center;">
			<img src="__TEMP__/<?php echo $style; ?>/public/images/load_login.gif"/>
			<p style="margin-top:10px;">加载中</p>
		</div>
	</div>
	
	<p class="right_title">公告</p>
	<div class="proclamation1">
		<ul class="mall-news">
			<?php if(!(empty($notice) || (($notice instanceof \think\Collection || $notice instanceof \think\Paginator ) && $notice->isEmpty()))): ?>
			<?php echo $notice; endif; ?>
		</ul>
	</div>
			
<!-- 	<p class="right_title" style="display:none;"><span>&nbsp;</span>管理</p> -->
<!-- 	<div class="shortcut-menu" style="display:none;"> -->
<!-- 		<a href="ADMIN_MAIN" title="登录商家管理中心" class="store-join-btn" target="_blank">登录管理中心</a> -->
<!-- 	</div> -->
</div>  <!--滚动图右侧公告-->
	</div>
</div>

<!--头部商品分类 end-->

<!-- 右侧固定购物车 -->

	<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/shopping_cart.js"></script>
<script src="__TEMP__/<?php echo $style; ?>/public/js/ns_collections.js" type="text/javascript"></script>
<!-- common.js 刷新了购物车数据 -->
<script>
//当浏览器窗口大小改变时，设置显示内容的高度  
window.onresize = function(){
	$(".sidebar-cartbox").find('.cart-panel-content').height($(window).height() - 90);
	$(".sidebar-cartbox").find('.bonus-panel-content').height($(window).height() - 40);
}
$(function() {
	$(".quick-links").css("top",($(window).height())/2);
	$.ajax({
		type:"post",
		url:"<?php echo __URL('SHOP_MAIN/components/getlogininfo'); ?>",
		success:function(data){
			if(data != null && data != ""){
				var img = data["user_info"]["user_headimg"];
				var name = data["user_info"]["nick_name"];
				$("#not_logged").css("display","none");
				$("#right_login_info").css("display","block");
				$("#right_login_info_name").text(name);
				if(img == '' ||img == null){
					$("#login_member_logo").attr('src',"__TEMP__/<?php echo $style; ?>/public/images/temp_default_user_portrait_0.png"); 
				}else{
					img = '__UPLOAD__/'+img;
					$("#login_member_logo").attr('src',img);
				}
			}else{
				$("#not_logged").css("display","block");
				$("#right_login_info").css("display","none");
			}
		}
	})
	$('.ajax-login').click(function(){
		$('#mask-layer-login').show();
		$('#layui-layer').show();
	})
	$('.layui-layer-close.layui-layer-close1').click(function(){
		$('#mask-layer-login').hide();
		$('#layui-layer').hide();
	})
	refreshShopCart();
});
</script>
<input type="hidden" id="hidden_uid" value="<?php echo $uid; ?>" />
<div class="right-sidebar-con">
	<div class="right-sidebar-main">
		<div class="right-sidebar-panel">
			<div id="quick-links" class="quick-links">
				<ul>
					<li class="quick-area quick-login sidebar-user-trigger">
						<a href="javascript:void(0);" class="quick-links-a" title="个人中心"><i class="user"></i></a>
						<div class="sidebar-user quick-sidebar">
							<i class="arrow-right"></i>
							<div class="sidebar-user-info">
								<!-- 没有登录的情况 _start -->
								<div class="NS-USER-NOT-LOGIN">
										<a href="<?php echo __URL('SHOP_MAIN/member/index'); ?>">
									<div class="user-pic">
										<div class="user-pic-mask"></div>
										<img id="login_member_logo" src="__TEMP__/<?php echo $style; ?>/public/images/temp_default_user_portrait_0.png" />
									</div>
									</a>
									<br>
									<p id="not_logged">你好！请<a href="javascript:void(0);" class="quick-login-a color ajax-login">登录</a> | <a href="<?php echo __URL('SHOP_MAIN/login/registerbox'); ?>" class="color">注册</a></p>
									<p id="right_login_info">你好！<span id="right_login_info_name"></span></p>
								</div>
								<!-- 没有登录的情况 _end -->
								<!-- 有登录的情况 _start -->
								<div class="js-user-already-login" style="display: none;">
									<div class="user-have-login">
										<div class="user-pic">
											<div class="user-pic-mask"></div>
											<img src="" class="NS-USER-PIC">
										</div>
										<div class="user-info">
											<p>
												用&nbsp;&nbsp;&nbsp;户： <span class="NS-USER-NAME"></span>
											</p>
										</div>
									</div>
									<p class="m-t-10">
										<span class="prev-login"> 上次登录时间： 
											<span class="NS-USER-LAST-LOGIN"></span>
										</span>
										<a href="<?php echo __URL('SHOP_MAIN/member/index'); ?>" class="btn account-btn" target="_blank">个人中心</a>
										<a href="<?php echo __URL('SHOP_MAIN/member/orderlist'); ?>" class="btn order-btn" target="_blank">订单中心</a>
									</p>
								</div>
								<!-- 有登录的情况 _end -->
							</div>
						</div>
					</li>
					<li class="sidebar-tabs" data-ns-flag="shopping_cart">
						<!-- 购物车 -->
						<div class="cart-list quick-links-a sidebar-cartbox-trigger" title="购物车">
							<i class="cart"></i>
							<span class="cart_num js-cart-count">0</span>
						</div>
					</li>
					<li id="collectGoods" class="sidebar-tabs" data-ns-flag="collections_goods" title="我的收藏">
						<a href="javascript:;" class="mpbtn_collect quick-links-a">
							<i class="collection"></i>
						</a>
					</li>
					<li class="quick-area">
						<a class="quick-links-a" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $web_info['web_qq']; ?>&site=qq&menu=yes" title="联系客服" target="_blank">
							<i class="customer-service"></i>
						</a>
					</li>
					
					<li class="quick-area">
						<a class="quick-links-a" href="javascript:void(0);" title="商城二维码"><i class="qr-code"></i></a>
						<div class="sidebar-code quick-sidebar" style="display: none;">
							<i class="arrow-right"></i> 
							<img src="__UPLOAD__/<?php echo $web_info['web_qrcode']; ?>">
						</div>
					</li>
					<li class="returnTop" style="display: none;background: #0689e1;">
						<a href="javascript:void(0);" class="return_top quick-links-a">
							<i class="top"></i>
						</a>
						<div class="popup" style="left: -121px; visibility: hidden;">
							返回顶部 <i class="arrow-right"></i>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- 内容 -->

	
<div class="floor"></div>

	<!-- 广告位 -->
	<div class="w1210 ad-groups ad-groups5">
	<div class="ad-groups5-layout">
		<div class="ad-groups5-list"></div>
		<script type="text/javascript">
			var ap_id = 1054;
			var data = platformAdvLoad(ap_id);
			var html = '';//0 1 2 3 4 5	,0:3,1:4,2:5
			if(data[0]['adv_image'] != ''){
				for (var i = 0; i < data.length; i++) {
					if(i == 0 || i == 3){
						//第一个
						html += '<div class="item">';
						if(data[i]['adv_url'] == ""){
	
							html += '<a class="ad-img" href="'+data[i]['adv_url']+'" >';
						}else{
	
							html += '<a class="ad-img" target="_blank" href="'+data[i]['adv_url']+'" >';
						}
							html += '<img class="lazy" src="__UPLOAD__/'+data[i]['adv_image']+'" style="display: inline;height:100%;max-width:100%;">';
						html += '</a>';
						html +='</div>';
					}else if(i == 1 || i == 4){
						//第二个
						html += '<div class="item-children">';
							html += '<div class="item-float">';
							if(data[i]['adv_url'] == ""){
	
								html += '<a class="ad-img" href="'+data[i]['adv_url']+'" >';
							}else{
	
								html += '<a class="ad-img" target="_blank" href="'+data[i]['adv_url']+'" >';
							}
							html += '<img class="lazy" src="__UPLOAD__/'+data[i]['adv_image']+'" style="display: inline;height:100%;max-width:100%;">';
							html += '</a></div>';
					}else if(i == 2 || i == 5){
						//第三个
						html += '<div class="item-float" style="margin-top:14px;">';
	
						if(data[i]['adv_url'] == ""){
	
							html += '<a class="ad-img" href="'+data[i]['adv_url']+'" >';
						}else{
	
							html += '<a class="ad-img" target="_blank" href="'+data[i]['adv_url']+'" >';
						}
						html += '<img class="lazy" src="__UPLOAD__/'+data[i]['adv_image']+'" style="display: inline;height:100%;max-width:100%;">';
						html += '</a></div></div>';
					}
				}
				$('.ad-groups5-list').html(html);
			}else{
				$(".ad-groups5").hide();
			}
		</script>
	</div>
</div>
	
	
	<!--限时折扣-->
	<!--
	创建人：王永杰
	创建时间：2017年2月7日 11:59:16
	功能描述：限时折扣
-->
<?php if(count($discount_list) >0): ?>
<link type="text/css" rel="stylesheet" href="__TEMP__/<?php echo $style; ?>/public/css/ns_style.css">
<!-- <div class="floor"></div> -->
<div class="channel-content" ectype="channel">
	<div class="seckill-channel" id="h-seckill">
		<div class="box-hd clearfix">
			<i class="box-hd-icon"></i>
			<div class="sk-more">
				<a href="<?php echo __URL('SHOP_MAIN/index/discount'); ?>" target="_blank">更多秒杀</a>
			</div>
		</div>
		<hr style="border:0;border-bottom:1px solid #F3F3F3;" />
		
		<article class="main" id="discount">
			<ul>
				<?php if(is_array($discount_list) || $discount_list instanceof \think\Collection || $discount_list instanceof \think\Paginator): $i = 0; $__LIST__ = $discount_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<li onclick="location.href='<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$vo['goods_id']); ?>';">
					<h4><?php echo $vo['goods_name']; ?></h4>
					<strong class="promotion">￥<?php echo $vo['promotion_price']; ?></strong>
					<strong class="del">￥<?php echo $vo['price']; ?></strong>
					<img src="__UPLOAD__/<?php echo $vo['picture']['pic_cover_mid']; ?>" />
					<span class="settime" starttime="<?php echo getTimeStampTurnTime($vo['start_time'] ); ?>" endtime="<?php echo getTimeStampTurnTime($vo['end_time'] ); ?>"></span>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
<!-- 			<a href="javascript:void(0);" class="prev"> -->
<!-- 				<i class="icon-limit i-limited-arrow-left"></i> -->
<!-- 			</a> -->
<!-- 			<a href="javascript:void(0);" class="next"> -->
<!-- 				<i class="icon-limit i-limited-arrow-right"></i> -->
<!-- 			</a> -->
		</article>
	</div>
</div>
<script >
$(function() {
	updateEndTime();
});

//倒计时函数
function updateEndTime() {
	var date = new Date();
	var time = date.getTime(); //当前时间距1970年1月1日之间的毫秒数
	$(".settime").each(function(i) {
		var endDate = this.getAttribute("endTime"); //结束时间字符串
		//转换为时间日期类型
		var endDate1 = eval('new Date(' + endDate.replace(/\d+(?=-[^-]+$)/, function(a) {
			return parseInt(a, 10) - 1;
		}).match(/\d+/g) + ')');

		var endTime = endDate1.getTime(); //结束时间毫秒数
		var lag = (endTime - time) / 1000; //当前时间和结束时间之间的秒数
		if (lag > 0) {
			var second = Math.floor(lag % 60);
			var minite = Math.floor((lag / 60) % 60);
			var hour = Math.floor((lag / 3600) % 24);
			var day = Math.floor((lag / 3600) / 24);
			$(this).html("还剩：<strong>" + day + "</strong>天<strong>" + hour + "</strong>时<strong>" + minite + "</strong>分<strong>" + second + "</strong>秒");
		} else{
			$(this).html("活动已经结束啦！");
		}
	});
	setTimeout("updateEndTime()", 1000);
}
</script>
<?php endif; ?>
	<!--限时折扣-->
	
	<!-- 推荐广告位开始 -->
	<?php if(count($recommend_block) >0): ?>
<div class="w1210 index-sale">
	<ul class="tabs-nav">
		<?php if(is_array($recommend_block) || $recommend_block instanceof \think\Collection || $recommend_block instanceof \think\Paginator): if( count($recommend_block)==0 ) : echo "" ;else: foreach($recommend_block as $k=>$recommend): ?>
		<li <?php if($k == 0): ?>class="tabs-selected"<?php endif; ?>>
<!-- 			<i class="arrow"></i> -->
			<h3 title="<?php echo $recommend['class_name']; ?>"><?php echo $recommend['class_name']; ?></h3></li>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
	<?php if(is_array($recommend_block) || $recommend_block instanceof \think\Collection || $recommend_block instanceof \think\Paginator): if( count($recommend_block)==0 ) : echo "" ;else: foreach($recommend_block as $k=>$recommend_detail): if($k == 0): ?>
	<div class="tabs-panel sale-goods-list">
	<?php else: ?>
	<div class="tabs-panel sale-goods-list tabs-hide">
	<?php endif; ?>
		<ul>
		<?php if(is_array($recommend_detail['goods_list']) || $recommend_detail['goods_list'] instanceof \think\Collection || $recommend_detail['goods_list'] instanceof \think\Paginator): if( count($recommend_detail['goods_list'])==0 ) : echo "" ;else: foreach($recommend_detail['goods_list'] as $key=>$goods_list): ?>
			<li>
				<dl>
					<dt class="goods-name">
						<a title="<?php echo $goods_list['goods_info']['goods_name']; ?>" href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$goods_list['goods_info']['goods_id']); ?>" target="_blank"><?php echo $goods_list['goods_info']['goods_name']; ?></a>
					</dt>
					<dd class="goods-thumb">
						<a title="<?php echo $goods_list['goods_info']['goods_name']; ?>" href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$goods_list['goods_info']['goods_id']); ?>" target="_blank">
							<img src="__UPLOAD__/<?php echo $goods_list['picture_info']['pic_cover_mid']; ?>" />
						</a>
					</dd>
					<dd class="goods-price">
						<em class="second-color" style="font-size:18px;">￥<?php echo $goods_list['goods_info']['promotion_price']; ?></em>
					</dd>
				</dl>
			</li>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
	<?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</div>
<?php endif; ?>
	<!-- 推荐广告位结束-->
	
	<!--推荐商品楼层分类 start-->
	<!--
	创建人：李志伟
	创建时间：2017年2月7日 12:25:20
	功能描述：首页，楼层
-->
<!-- 内容 -->
<?php if(is_array($web_block_list) || $web_block_list instanceof \think\Collection || $web_block_list instanceof \think\Paginator): $i = 0; $__LIST__ = $web_block_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
<div class="w1210 floor-list">
	<div class="floor" color="<?php echo $vo['base_info']['block_color']; ?>">
		<div class="floor-layout">
			<div class="floor-con floor-con5">
				<div class="floor-title">
					<!--推荐名称-->
					<span class="vertical-bar" style="background: <?php echo $vo['base_info']['block_color']; ?>;"></span>
					<h2>
						<a href=javascript:;" target="_blank"><?php echo $vo['base_info']['block_name']; ?></a>
						<input type="hidden" value="<?php echo $vo['base_info']['block_short_name']; ?>" class="NS-SHORT-NAME" />
					</h2>
					<!--推荐类型-->
					<ul class="floor-tabs-nav">
						<!-- 如果多图广告位不为空 -->
						<?php if($vo['base_info']['recommend_ad_images'] != 0): ?>
						<li class="floor-tabs-selected"><h3 style="color: <?php echo $vo['base_info']['block_color']; ?>;"><?php echo $vo['base_info']['recommend_ad_images_name']; ?></h3></li>
						<li><h3><?php echo $vo['base_info']['recommend_goods_category_name_1']; ?></h3></li>
						<?php else: ?>
						<li class="floor-tabs-selected"><h3 style="color: <?php echo $vo['base_info']['block_color']; ?>;"><?php echo $vo['base_info']['recommend_goods_category_name_1']; ?></h3></li>
						<?php endif; ?>
						<li><h3><?php echo $vo['base_info']['recommend_goods_category_name_2']; ?></h3></li>
						<li><h3><?php echo $vo['base_info']['recommend_goods_category_name_3']; ?></h3></li>
					</ul>
				</div>
				<hr style="border:0;border-bottom:1px solid #F5F5F5;" />
				<div class="floor-content floor-content5">
					<?php if($vo['base_info']['recommend_ad_image'] != 0): ?>
					<div class="floor-left">
						<div class="floor-ad">
							<a href="<?php echo $vo['recommend_ad_image']['adv_list'][0]['adv_url']; ?>" target="_blank" class="floor-ad-img">
								<img class="lazy" src="__UPLOAD__/<?php echo $vo['recommend_ad_image']['adv_list'][0]['adv_image']; ?>" width="<?php echo $vo['recommend_ad_image']['ap_width']; ?>" >
							</a>
						</div>
						<ul class="floor-words">
<!-- 						分类推荐 -->
							<?php if(is_array($vo['category_list']) || $vo['category_list'] instanceof \think\Collection || $vo['category_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['category_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
								<li><a href="<?php echo __URL('SHOP_MAIN/goods/goodslist','category_id='.$item['category_id']); ?>" target="_blank" title="<?php echo $item['category_name']; ?>"><?php echo $item['category_name']; ?></a></li>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
					<?php endif; if($vo['base_info']['recommend_ad_slide'] != 0): ?>
					<div class="floor-middle">
						<div class="floor-banner">
							<div class="hiSlider-wrap">
								<ul class="hiSlider NS-FLOOR-HISLIDER">
									<!-- 幻灯片循环 -->
									<?php if(is_array($vo['recommend_ad_slide']['adv_list']) || $vo['recommend_ad_slide']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_slide']['adv_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['recommend_ad_slide']['adv_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vohd): $mod = ($i % 2 );++$i;?> 
									<li class="hiSlider-item">
										<a href="<?php echo $vohd['adv_url']; ?>" target="_blank">
											<img class="lazy" src="__UPLOAD__/<?php echo $vohd['adv_image']; ?>" width="<?php echo $vo['recommend_ad_slide']['ap_width']; ?>">
										</a>
									</li>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
							</div>
						</div>
					</div>
					<?php endif; ?>
					<div class="floor-right"
						<?php if($vo['base_info']['recommend_ad_slide'] == 0  && 	$vo['base_info']['recommend_ad_image'] == 0): ?>
							style="width: 1210px;" 		
						<?php elseif($vo['base_info']['recommend_ad_image'] == 0): ?>
							style="width: 816px" 
						<?php elseif($vo['base_info']['recommend_ad_slide'] == 0): ?>
							style="width: 998px;" 
						<?php endif; ?>
					>
						<!-- 幻灯片广告 _start -->
						<?php if($vo['base_info']['recommend_ad_images'] != 0): if($vo['base_info']['recommend_ad_slide'] == 0  && 	$vo['base_info']['recommend_ad_image'] == 0): ?>
								<div class="floor-tabs-panel" style="width: 1210px;">
									<div class="floor-tabs-ad-up" style="width: 1212px;">
									<?php if(is_array($vo['recommend_ad_images']['adv_list']) || $vo['recommend_ad_images']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_images']['adv_list'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['recommend_ad_images']['adv_list']) ? array_slice($vo['recommend_ad_images']['adv_list'],0,6, true) : $vo['recommend_ad_images']['adv_list']->slice(0,6, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volc): $mod = ($i % 2 );++$i;?>
										<a href="<?php echo $volc['adv_url']; ?>" target="_blank" class="floor-tabs-ad-img first">
											<img class="lazy" src="__UPLOAD__/<?php echo $volc['adv_image']; ?>">
										</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
									<div class="floor-tabs-ad-down" style="width: 1212px;">
									<?php if(is_array($vo['recommend_ad_images']['adv_list']) || $vo['recommend_ad_images']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_images']['adv_list'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['recommend_ad_images']['adv_list']) ? array_slice($vo['recommend_ad_images']['adv_list'],6,4, true) : $vo['recommend_ad_images']['adv_list']->slice(6,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volc): $mod = ($i % 2 );++$i;?>
										<a href="<?php echo $volc['adv_url']; ?>" target="_blank" class="floor-tabs-ad-img first"> 
											<img class="lazy" src="__UPLOAD__/<?php echo $volc['adv_image']; ?>">
										</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>	
							<?php elseif($vo['base_info']['recommend_ad_image'] == 0): ?>
								<div class="floor-tabs-panel">
									<div class="floor-tabs-ad-up" style="width: 868px;">
									<?php if(is_array($vo['recommend_ad_images']['adv_list']) || $vo['recommend_ad_images']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_images']['adv_list'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['recommend_ad_images']['adv_list']) ? array_slice($vo['recommend_ad_images']['adv_list'],0,4, true) : $vo['recommend_ad_images']['adv_list']->slice(0,4, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volc): $mod = ($i % 2 );++$i;?>
										<a href="<?php echo $volc['adv_url']; ?>" target="_blank" class="floor-tabs-ad-img first">
											<img class="lazy" src="__UPLOAD__/<?php echo $volc['adv_image']; ?>">
										</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
									<div class="floor-tabs-ad-down" style="width: 868px;">
									<?php if(is_array($vo['recommend_ad_images']['adv_list']) || $vo['recommend_ad_images']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_images']['adv_list'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['recommend_ad_images']['adv_list']) ? array_slice($vo['recommend_ad_images']['adv_list'],4,2, true) : $vo['recommend_ad_images']['adv_list']->slice(4,2, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volc): $mod = ($i % 2 );++$i;?>
										<a href="<?php echo $volc['adv_url']; ?>" target="_blank" class="floor-tabs-ad-img first" style="width: 404px;"> 
											<img class="lazy" src="__UPLOAD__/<?php echo $volc['adv_image']; ?>">
										</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
							<?php elseif($vo['base_info']['recommend_ad_slide'] == 0): ?>
								<div class="floor-tabs-panel" style="width: 998px;">
									<div class="floor-tabs-ad-up" style="width: 1010px;">
									<?php if(is_array($vo['recommend_ad_images']['adv_list']) || $vo['recommend_ad_images']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_images']['adv_list'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['recommend_ad_images']['adv_list']) ? array_slice($vo['recommend_ad_images']['adv_list'],0,5, true) : $vo['recommend_ad_images']['adv_list']->slice(0,5, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volc): $mod = ($i % 2 );++$i;?>
										<a href="<?php echo $volc['adv_url']; ?>" target="_blank" class="floor-tabs-ad-img first">
											<img class="lazy" src="__UPLOAD__/<?php echo $volc['adv_image']; ?>">
										</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
									<div class="floor-tabs-ad-down" style="width: 1010px;">
									<?php if(is_array($vo['recommend_ad_images']['adv_list']) || $vo['recommend_ad_images']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_images']['adv_list'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['recommend_ad_images']['adv_list']) ? array_slice($vo['recommend_ad_images']['adv_list'],5,3, true) : $vo['recommend_ad_images']['adv_list']->slice(5,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volc): $mod = ($i % 2 );++$i;?>
										<a href="<?php echo $volc['adv_url']; ?>" target="_blank" class="floor-tabs-ad-img first"> 
											<img class="lazy" src="__UPLOAD__/<?php echo $volc['adv_image']; ?>">
										</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
							<?php else: ?>
								<div class="floor-tabs-panel">
									<div class="floor-tabs-ad-up">
									<?php if(is_array($vo['recommend_ad_images']['adv_list']) || $vo['recommend_ad_images']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_images']['adv_list'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['recommend_ad_images']['adv_list']) ? array_slice($vo['recommend_ad_images']['adv_list'],0,3, true) : $vo['recommend_ad_images']['adv_list']->slice(0,3, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volc): $mod = ($i % 2 );++$i;?>
										<a href="<?php echo $volc['adv_url']; ?>" target="_blank" class="floor-tabs-ad-img first">
											<img class="lazy" src="__UPLOAD__/<?php echo $volc['adv_image']; ?>">
										</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
									<div class="floor-tabs-ad-down">
									<?php if(is_array($vo['recommend_ad_images']['adv_list']) || $vo['recommend_ad_images']['adv_list'] instanceof \think\Collection || $vo['recommend_ad_images']['adv_list'] instanceof \think\Paginator): $i = 0;$__LIST__ = is_array($vo['recommend_ad_images']['adv_list']) ? array_slice($vo['recommend_ad_images']['adv_list'],3,2, true) : $vo['recommend_ad_images']['adv_list']->slice(3,2, true); if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$volc): $mod = ($i % 2 );++$i;?>
										<a href="<?php echo $volc['adv_url']; ?>" target="_blank" class="floor-tabs-ad-img first"> 
											<img class="lazy" src="__UPLOAD__/<?php echo $volc['adv_image']; ?>">
										</a>
									<?php endforeach; endif; else: echo "" ;endif; ?>
									</div>
								</div>
							<?php endif; endif; ?>
						<!-- 幻灯片广告 _end -->
						<?php if($vo['base_info']['recommend_ad_images'] != 0): ?>
						<div class="floor-tabs-panel floor-tabs-hide"
							<?php if($vo['base_info']['recommend_ad_slide'] == 0  && 	$vo['base_info']['recommend_ad_image'] == 0): ?>
								style="width: 1212px;" 		
							<?php elseif($vo['base_info']['recommend_ad_image'] == 0): ?>
								style="width: 816px;margin-left: 10px;" 
							<?php elseif($vo['base_info']['recommend_ad_slide'] == 0): ?>
								style="width: 1010px;" 
							<?php endif; ?>
						>
						<?php else: ?>
						<div class="floor-tabs-panel"
							<?php if($vo['base_info']['recommend_ad_slide'] == 0  && 	$vo['base_info']['recommend_ad_image'] == 0): ?>
								style="width: 1212px;" 		
							<?php elseif($vo['base_info']['recommend_ad_image'] == 0): ?>
								style="width: 816px;margin-left: 10px;" 
							<?php elseif($vo['base_info']['recommend_ad_slide'] == 0): ?>
								style="width: 1010px;" 
							<?php endif; ?>
						>
						<?php endif; if(is_array($vo['goods_list_1']) || $vo['goods_list_1'] instanceof \think\Collection || $vo['goods_list_1'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['goods_list_1'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
							<div class="item">
								<div class="wrap">
									<a target="_blank" href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$good['goods_id']); ?>" title="<?php echo $good['goods_name']; ?>">
										<img class="lazy" src="__UPLOAD__/<?php echo $good['picture_detail']['pic_cover_big']; ?>" />
									</a>
									<p class="title">
										<a target="_blank" href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$good['goods_id']); ?>" title="<?php echo $good['goods_name']; ?>"><?php echo $good['goods_name']; ?></a>
									</p>
									<p class="price">
										<span class="second-color">￥<?php echo $good['promotion_price']; ?></span>
									</p>
									<!-- <a class="add-cart" title="加入购物车"></a> -->
								</div>
							</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						
						<div class="floor-tabs-panel floor-tabs-hide"
							<?php if($vo['base_info']['recommend_ad_slide'] == 0  && 	$vo['base_info']['recommend_ad_image'] == 0): ?>
								style="width: 1212px;" 		
							<?php elseif($vo['base_info']['recommend_ad_image'] == 0): ?>
								style="width: 816px;margin-left: 10px;" 
							<?php elseif($vo['base_info']['recommend_ad_slide'] == 0): ?>
								style="width: 1010px;" 
							<?php endif; ?>
						>
						<?php if(is_array($vo['goods_list_2']) || $vo['goods_list_2'] instanceof \think\Collection || $vo['goods_list_2'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['goods_list_2'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
							<div class="item">
								<div class="wrap">
									<a target="_blank"href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$good['goods_id']); ?>" title="<?php echo $good['goods_name']; ?>">
										<img class="lazy" src="__UPLOAD__/<?php echo $good['picture_detail']['pic_cover_big']; ?>" >
									</a>
									<p class="title">
										<a target="_blank" href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$good['goods_id']); ?>" title="<?php echo $good['goods_name']; ?>"><?php echo $good['goods_name']; ?></a>
									</p>
									<p class="price">
										<span class="second-color">￥<?php echo $good['promotion_price']; ?></span>
									</p>
									<!-- <a class="add-cart" title="加入购物车"></a> -->
								</div>
							</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>

						<div class="floor-tabs-panel floor-tabs-hide"
							<?php if($vo['base_info']['recommend_ad_slide'] == 0  && 	$vo['base_info']['recommend_ad_image'] == 0): ?>
								style="width: 1212px;" 		
							<?php elseif($vo['base_info']['recommend_ad_image'] == 0): ?>
								style="width: 816px;margin-left: 10px;" 
							<?php elseif($vo['base_info']['recommend_ad_slide'] == 0): ?>
								style="width: 1010px;" 
							<?php endif; ?>
						>

						<?php if(is_array($vo['goods_list_3']) || $vo['goods_list_3'] instanceof \think\Collection || $vo['goods_list_3'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['goods_list_3'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
							<div class="item">
								<div class="wrap">
									<a target="_blank" href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$good['goods_id']); ?>" title="<?php echo $good['goods_name']; ?>">
										<img class="lazy" src="__UPLOAD__/<?php echo $good['picture_detail']['pic_cover_big']; ?>" />
									</a>
									<p class="title">
										<a target="_blank" href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$good['goods_id']); ?>" title="<?php echo $good['goods_name']; ?>"><?php echo $good['goods_name']; ?></a>
									</p>
									<p class="price">
										<span class="second-color">￥<?php echo $good['promotion_price']; ?></span>
									</p>
									<!-- <a class="add-cart" title="加入购物车"></a> -->
								</div>
							</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if(count($vo['brand_list'])): ?>
<!-- 楼层 _end -->
<div class="w1210">
	<div class="floors-brand">
		<div class="floor-layout">
			<div class="floor-con">
				<div class="floor-brand">
					<div class="tabs-brand">
						<div class="brand">
							<div class="brand-con">
								<ul class="brand-list" style="position: absolute;height: 40px;top:0;left:0;">
									<?php if(is_array($vo['brand_list']) || $vo['brand_list'] instanceof \think\Collection || $vo['brand_list'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['brand_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
									<li class="fore1">
										<a href="<?php echo __URL('SHOP_MAIN/goods/goodslist','brand_id='.$item['brand_id']); ?>" target="_blank" title="<?php echo $item['brand_name']; ?>">
											<img class="lazy" src="__UPLOAD__/<?php echo $item['brand_pic']; ?>" />
										</a>
									</li>
									<?php endforeach; endif; else: echo "" ;endif; ?>
								</ul>
								<div class="brand-btn">
									<a class="brand-left" href="javascript:void(0)">&lt;</a>
									<a class="brand-right" href="javascript:void(0)">&gt;</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; endforeach; endif; else: echo "" ;endif; ?>
	<!--推荐商品楼层分类 end -->

	<!-- #tpl_region_end -->

	<!-- 左侧楼层定位 _start-->
	<div class="elevator" style="visibility: hidden;">
		<div class="elevator-floor" style="transform: scale(1.2); opacity: 0;"></div>
	</div>
	<!--友情链接-->
	<!--
	创建时间：2017年2月7日 12:24:13
	功能描述：友情链接
-->
<!--友情链接-->
<div class="links-box w1210">
	<div class="links-title">
		<span>友情链接</span>
	</div>
	<div class="links-content"></div>
	<script type="text/javascript">
		$.ajax({
			type : "post",
			url : "<?php echo __URL('SHOP_MAIN/components/linklist'); ?>",
			async : false,
			dataType : 'json',
			success : function(data){
				var linkhtml='';
				if(data.length>0){
					for(var i=0;i<data.length;i++){
						if(data[i]['is_blank']==1){
							linkhtml+='<a href="'+data[i]['link_url']+'" target="_blank" title="'+data[i]['link_title']+'">'+data[i]['link_title']+'</a>';
						}else{
							linkhtml+='<a href="'+data[i]['link_url']+'" target="_self" title="'+data[i]['link_title']+'">'+data[i]['link_title']+'</a>';
						}
					}
					$('.links-content').html(linkhtml);
				}else{
					$(".links-box").hide();
				}
			}
		});
	</script>
</div>


<!-- 底部 -->

<!--
	创建时间：2017年2月7日 12:11:41
	功能描述： 底部，联系我们、电话 
-->
<div class="footer">
	<div class="dsc-service">
		<div class="w w1200 relative">
			<ul class="service-list">
				<li>
					<div class="service-tit service-zheng">
						<img src="__TEMP__/<?php echo $style; ?>/public/images/icon-zheng.png">
					</div>
					<div class="service-txt">正品保障</div>
				</li>
				<li>
					<div class="service-tit service-qi">
						<img src="__TEMP__/<?php echo $style; ?>/public/images/icon-qi.png"></i>
					</div>
					<div class="service-txt">七天包退</div>
				</li>
				<li>
					<div class="service-tit service-hao">
						<img src="__TEMP__/<?php echo $style; ?>/public/images/icon-grin.png">
					</div>
					<div class="service-txt">好评如潮</div>
				</li>
				<li>
					<div class="service-tit service-shan">
						<img src="__TEMP__/<?php echo $style; ?>/public/images/icon-light.png"></i>
					</div>
					<div class="service-txt">闪电发货</div>
				</li>
				<li class="last">
					<div class="service-tit service-quan">
						<img src="__TEMP__/<?php echo $style; ?>/public/images/icon-tronphy.png">
					</div>
					<div class="service-txt">权威荣誉</div>
				</li>
			</ul>
		</div>
	</div>
	<div class="dsc-help">
		<div class="w w1200">
			<div class="help-list">
				<?php if(is_array($platform_help_class) || $platform_help_class instanceof \think\Collection || $platform_help_class instanceof \think\Paginator): if( count($platform_help_class)==0 ) : echo "" ;else: foreach($platform_help_class as $key=>$class_vo): ?>
				<div class="help-item">
					<h3><?php echo $class_vo['class_name']; ?></h3>
					<ul>
						<?php if(is_array($platform_help_document) || $platform_help_document instanceof \think\Collection || $platform_help_document instanceof \think\Paginator): if( count($platform_help_document)==0 ) : echo "" ;else: foreach($platform_help_document as $key=>$document_vo): if($class_vo['class_id'] == $document_vo['class_id']): ?>
						<li><a href="<?php echo __URL('SHOP_MAIN/helpcenter/index','id='.$document_vo['id']); ?>"
							title="售后流程" target="_blank"><?php echo $document_vo['title']; ?></a></li> <?php endif; endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="help-cover">
				<div class="help-ctn">
					<div class="help-ctn-mt">
						<span>服务热线</span> <strong><?php echo $web_info['web_phone']; ?></strong>
					</div>
					<div class="help-ctn-mb">

						<a id="IM" im_type="dsc" onclick="openWin(this)"
							href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $web_info['web_qq']; ?>&site=qq&menu=yes"
							target="_blank" class="btn-ctn"><img
							src="__TEMP__/<?php echo $style; ?>/public/images/icon-csu.png"
							style="vertical-align: middle;">&nbsp;&nbsp;咨询客服</a>
					</div>
				</div>
				<div class="help-scan">
					<div class="code">
						<img src="__UPLOAD__/<?php echo $web_info['web_qrcode']; ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
	创建时间：2017年2月7日 12:13:09
	功能描述： 底部、公司信息 
-->
<div class="dsc-copyright">
	<div class="w w1200" id="bottom_copyright">
		<p class="copyright_info">
			<a href="#" id="copyright_meta"></a>
		</p>
		<b> <a href="javascript:;" target="_blank" class="copyright-logo"><?php echo $web_info['third_count']; ?></a>&nbsp;&nbsp;
			<a href="http://www.niushop.com.cn" target="_blank" class="copyright-logo" id="copyright_companyname"></a> 
			<span id="copyright_desc"></span>
		</b>
	</div>
</div>



<!-- 添加js文件 -->
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/layer.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.countdown.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/bubbleup.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/ns_index.js"></script>	
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/tabs.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.hiSlider.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/index_tab.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/tabs.js"></script>
<script type="text/javascript" src="__TEMP__/<?php echo $style; ?>/public/js/jquery.fly.min.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$.cartbox.count = "0";
		// 缓载图片
		$("img").lazyload({
			skip_invisible : false,
			effect : 'fadeIn',
			failure_limit : 20,
			threshold : 200
		});
	});
</script>


<?php if($uid == ''): ?>
	<style>
.verification-code{
	position:relative;
}
.verification-code img{
	position: absolute;
	top: 5px;
	right: 5px;
	z-index:101;
	width:100px;
	height:30px;
}
</style>
<script type="text/javascript"> 
$(document).ready(function(){
	$(window).on("resize",function(){
		//获取当前屏幕的宽度和高度
		var window_width = parseFloat($(window).width());
		var window_height = parseFloat($(window).height());
		//获取登录框的宽度和高度
		var div_width = parseFloat($("#layui-layer").css("width"));
		var div_height = parseFloat($("#layui-layer").css("height"));
		//确定登录框的显示位置
		var top = (window_height-div_height)/2;
		var left = (window_width-div_width)/2;
		$("#layui-layer").css({"top":top,"left":left});
	})
	//自执行一次resize函数
	$(window).trigger("resize");
});
function titleMove() {
	var moveable = true;
	var loginDiv = document.getElementById("layui-layer");
	//以下变量提前设置好
	var clientX = window.event.clientX;//鼠标水平位置
	var clientY = window.event.clientY;//鼠标垂直位置
	var moveTop = parseFloat(loginDiv.style.top);//登录框的top属性
	var moveLeft = parseFloat(loginDiv.style.left);//登录框的left属性
	var docX = parseFloat(window.innerWidth);//可视区域的宽度
	var docY = parseFloat(window.innerHeight);//可视区域的高度
	var divWidth = parseFloat(loginDiv.style.width);//登录框的宽度
	var divHeight = parseFloat(loginDiv.style.height);//登录框的高度 
	var max_width = docX-divWidth;
	var max_height = docY-divHeight;
	document.onmousemove = function MouseMove() {
		if (moveable) {
			var y = moveTop + window.event.clientY - clientY;  //当前鼠标位置减去上次鼠标位置
			var x = moveLeft + window.event.clientX - clientX;
			if (x >= 0 && y >= 0 && moveTop+divHeight<=docY &&	moveLeft+divWidth<=docX) {
				loginDiv.style.top = y + "px";
				loginDiv.style.left = x + "px";
			}else{
				if(x<0){
					loginDiv.style.left = "5px";
			}else if(y<0){
				loginDiv.style.top = "5px";
			}else if(moveTop+divHeight>docY){
				loginDiv.style.top = max_height + "px";
			}else if(moveLeft+divWidth>docX){
				loginDiv.style.left = max_width + "px";
			}
		} 
	}
}

document.onmouseup = function Mouseup() {
		moveable = false;
	}
}
</script>
<input id="goods_id" value="<?php echo $goods_info['goods_id']; ?>" type="hidden">
<div id="mask-layer-login" style="display:none;position:fixed;top:0;width:100%;height:100%;z-index:999999;background:rgba(0,0,0,0.75);"></div>
<div class="layui-layer layui-layer-page layer-anim" id="layui-layer" type="page" times="100002" showtime="0" contype="string" style="display:none;z-index: 19891015;position:fixed;width:346px;height:436px;">
	<div class="layui-layer-title" style="cursor: move;" id="control-trawaaa"  onmousedown="titleMove();">您尚未登录<span style="width:40px;display:inline-block "></span></div>
	<div id="NS_LOGIN_LAYER_DIALOG" class="layui-layer-content">
		<div id="1487644497l6UAoM" class="login-form">
			<div class="login-con pos-r">
				<div class="login-wrap">
					<div class="login-tit">
						还没有账号？<a href="<?php echo __URL('SHOP_MAIN/login/registerbox'); ?>" class="regist-link color">立即注册<i>&gt;</i></a>
					</div>
					<div class="login-radio">
						<ul>
							<li class="active" id="login2" onclick="setTab('login',2,2)">会员登录</li>
						</ul>
					</div>
					<!-- 普通登录 star -->
					<div id="con_login_2" class="form">
						<div class="form-group item-name">
							<!-- 错误项标注 给div另添加一个class值'error' star -->
							<div class="form-control-box">
								<i class="icon"></i>
								<input type="text" name="txtName" id="txtName" placeholder="手机号/会员名/邮箱" class="text" tabindex="1" autocomplete="off" aria-required="true" />
							</div>
							<!-- 错误项标注 给div另添加一个class值'error' end -->
						</div>
						<div class="form-group item-password">
							<div class="form-control-box">
								<i class="icon"></i>
								<input type="password" name="txtPWD" id="txtPWD" placeholder="请输入密码" class="text" tabindex="2"  autocomplete="off" aria-required="true" />
							</div>
						</div>
						<?php if($login_verify_code['pc'] == 1): ?>
						<div class="form-group verification-code">
							<div class="form-control-box">
								<input type="text" id="vertification" class="text vertification" name="vertification" placeholder="请输入验证码 " />
								<img id="verify_img" src="<?php echo __URL('SHOP_MAIN/captcha'); ?>" alt="captcha" onclick="this.src='<?php echo __URL('SHOP_MAIN/captcha'); ?>'" />
							</div>
						</div>
						<input type="hidden" id="hidden_captcha_src" value="<?php echo __URL('SHOP_MAIN/captcha'); ?>" />
						<?php endif; ?>
<!-- 						<div class="safety"> -->
<!-- 							<label for="remember"> -->
<!-- 								<input type="checkbox" name="expire" checked="checked" type="checkbox" value="1"> -->
<!-- 								<span style="display:inline-block;padding-bottom:7px;">7天内自动登录</span> -->
<!-- 							</label> -->
<!-- 							<a class="forget-password fr" href="<?php echo __URL('SHOP_MAIN/login/findpasswd'); ?>" style="margin-top:2px;">忘记密码？</a> -->
<!-- 						</div> -->
						<div class="login-btn">
							<input type="hidden" name="act" value="act_login" />
							<input type="hidden" name="back_act" />
							<input type="button" name="buttom" class="btn-img btn-entry bg-color" id="loginsubmit" onclick="btnlogin(this)" value="立即登录" />
						</div>
						<div class="item-coagent">
							<?php if($Wchat_info['is_use'] == 1): ?>
								<a href="<?php echo __URL('APP_MAIN/login/oauthlogin','type=WCHAT'); ?>" data-id="qq" class="website-login"><i class="weixin"></i></a>
							<?php endif; if($qq_info['is_use'] == 1): ?>
								<a href="<?php echo __URL('APP_MAIN/login/oauthlogin','type=QQLOGIN'); ?>" data-id="wchat" class="website-login"><i class="qq"></i></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<span class="layui-layer-setwin"><a class="layui-layer-ico layui-layer-close layui-layer-close1" href="javascript:;"></a></span><span class="layui-layer-resize"></span>
</div>
<!-- 验证码脚本 -->
<script type="text/javascript">
// 登陆 登录时 登录按钮"变暗"
function btnlogin(event) {
	var goodsid = $("#goods_id").val();
	var userName = $('#txtName').val();
	var password = $('#txtPWD').val();
	var vertification = "";
	if(userName==''){
		$.msg('用户名不可为空');
		$('#txtName').select();
		return;
	}
	if(password==''){
		$.msg('密码不可为空');
		$('#txtPWD').select();
		return;
	}
	if("<?php echo $login_verify_code['pc']; ?>" == 1){
		vertification = $('#vertification').val();
		if(vertification == undefined || vertification==''){
			$.msg('验证码不可为空');
			$("#vertification").select();
			return;
		}
	}
	$.ajax({
		type:"post",
		url:"<?php echo __URL('SHOP_MAIN/login/login'); ?>",
		data:{"userName" : userName,"password" : password,"vertification" : vertification},
		success : function(data){
			if(data['code']>0){
				$("#hidden_uid").val(data['code']);
				var tag = $('#mask-layer-login').attr("data-tag");
				if(goodsid == '' || tag==undefined){
					$.msg('登陆成功！');
					window.location.reload();
				}else{
					login_buy_goods(event);
				}
			}else{
				$.msg(data['message']);
				$("#verify_img").attr("src",'<?php echo __URL('SHOP_MAIN/captcha'); ?>');
			}
		}
	});
}
function login_buy_goods(event){
	var image_url = "";
	var goodsid =  $("#goods_id").val();
	var tag = $('#mask-layer-login').attr("data-tag");
	 $.cart.add(goodsid, $(".amount-input").val(), {
		is_sku: true,
		image_url: image_url,
		event: event,
		tag : tag
	})
}
</script>
<?php endif; ?>

<script>
(function(){
	var bp = document.createElement('script');
	var curProtocol = window.location.protocol.split(':')[0];
	if (curProtocol === 'https') {
		bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
	}
	else {
		bp.src = 'http://push.zhanzhang.baidu.com/push.js';
	}
	var s = document.getElementsByTagName("script")[0];
	s.parentNode.insertBefore(bp, s);
})();
</script>
<?php if($default_client): ?>
<div style="position:fixed;right:0;bottom:10%;z-index:999999;" onclick="location.href='APP_MAIN';" id="go_mobile">
	<img src="__TEMP__/<?php echo $style; ?>/public/images/go_mobile.png"/>
</div>
<script>
$(function(){
	checkTerminal()
});
window.onresize = function(){
	checkTerminal();
}
function checkTerminal(){
	if ((navigator.userAgent.match(/(iPhone|iPod|Android|ios|iPad)/i)) && window.screen.availWidth<768){
		//跳到手机端
		$("#go_mobile").show();
	}else{
		$("#go_mobile").hide();
	}
}
</script>
<?php endif; ?>
</body>
</html>
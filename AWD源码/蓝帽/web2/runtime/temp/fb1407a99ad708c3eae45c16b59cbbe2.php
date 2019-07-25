<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:35:"template/adminblue/Index/index.html";i:1501815114;s:28:"template/adminblue/base.html";i:1501813202;s:45:"template/adminblue/controlCommonVariable.html";i:1501656000;s:28:"template/admin/urlModel.html";i:1501551326;s:34:"template/adminblue/pageCommon.html";i:1500458992;s:34:"template/adminblue/openDialog.html";i:1500263974;}*/ ?>
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
		
<link rel="stylesheet" type="text/css" href="ADMIN_CSS/dashboard.css">
<link rel="stylesheet" type="text/css" href="__STATIC__/blue/css/ns_index.css">
<script src="ADMIN_JS/highcharts.js"></script>
<script src="ADMIN_JS/exporting.js"></script>
<script>
var admin_main = "ADMIN_MAIN";
</script>
<script src="ADMIN_JS/index.js"></script>
<script src="ADMIN_JS/jquery.timers.js"></script>
<!-- ********************【脚本统一写在index.js中】******************** -->

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
		
		<div style="position:relative;margin:10px 0;">
			<!-- 三级导航菜单 -->
			
			
			<div class="right-side-operation">
				<ul>
					
					
				</ul>
			</div>
		</div>
		<div class="ns-main">
			
<div class="statistical">
	<ul>
		<li class="order-amount-statistics">
			<header>
				<i class="ns-icon-base i-order-amount"></i>
				<span>今年订单总金额(元)</span>
			</header>
			<p class="js-order-amount">0.00</p>
		</li>
		<li class="focus-number-statistics">
			<header>
				<i class="ns-icon-base i-focus-number"></i>
				<span>关注人数(个)</span>
			</header>
			<p class="js-weixin-fans-count">0</p>
		</li>
		<li class="goods-release-statistics">
			<header>
				<i class="ns-icon-base i-goods-release"></i>
				<span>商品发布(个)</span>
			</header>
			<p class="js-goods-release-count">0</p>
		</li>
		<li class="order-total-statistics">
			<header>
				<i class="ns-icon-base i-order-total"></i>
				<span>订单总数(笔)</span>
			</header>
			<p class="js-order-total">0</p>
		</li>
		<li class="month-sales-statistics">
			<header>
				<i class="ns-icon-base i-month-sales"></i>
				<span>本月销量(笔)</span>
			</header>
			<p class="js-month-sales">0</p>
		</li>
		<li class="completed-transaction-statistics">
			<header>
				<i class="ns-icon-base i-completed-transaction"></i>
				<span>已完成交易(笔)</span>
			</header>
			<p class="js-order-finish-count">0</p>
		</li>
	</ul>
</div>

<div class="goods-prompt">
	<h3>店铺及商品提示<span>您需要关注的店铺信息以及待处理事项</span></h3>
	<div class="subtitle">
		<img src="__STATIC__/images/orange_picture.png" /><label>图片空间使用情况：<span>不限</span></label>
		<img src="__STATIC__/images/green_giftbag.png" /><label>店铺商品发布情况：<span class="goods_all_count">0/不限</span></label>
	</div>
	<div class="goods-state a-line">
		<ul>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/goods/goodslist'); ?>'"><h4 class="goods_sale_count">0</h4>出售中</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/goods/goodslist'); ?>';"><h4 class="goods_audit_count">0</h4>仓库中</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/saleservice/consultlist?type=to_reply'); ?>';"><h4 class="goods_consult_count">0</h4>待回复咨询</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/member/usercommissionwithdrawlist'); ?>';"><h4 class="member_balance_withdraw">0</h4>会员提现审核</li>
		</ul>
	</div>
</div>

<div class="merchants-help">
	<h3>商家帮助<span>您需要的商家帮助</span></h3>
	<div class="merchants-use">
		<ul>
			<li>
				
				<a href="<?php echo __URL('ADMIN_MAIN/goods/goodslist'); ?>">
					<img src="__STATIC__/blue/img/goods_management.png"/>
					<span>商品管理</span>
				</a>
			</li>
			<li>
				<a href="<?php echo __URL('ADMIN_MAIN/promotion/coupontypelist'); ?>">
					<img src="__STATIC__/blue/img/promotions.png"/>
					<span>促销方式</span>
				</a>
			</li>
			<li>
				<a href="<?php echo __URL('ADMIN_MAIN/order/orderlist'); ?>">
					<img src="__STATIC__/blue/img/order_after.png"/>
					<span>订单及售后</span>
				</a>
			</li>
		</ul>
	</div>
</div>

<div class="goods-prompt">
	<h3>
		交易提示<span>您需要立即处理的交易订单</span>
	</h3>
	<div class="subtitle">
		<img src="__STATIC__/images/green_list.png" /><label>近期售出：<span>交易中的订单</span></label>
		<img src="__STATIC__/images/orange_shield.png" /><label>维权投诉：<span>收到维权投诉</span></label>
	</div>
	<div class="goods-state a-line order">
		<ul>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/order/orderlist?status=0'); ?>';"><h4 class="daifukuan">0</h4>待付款</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/order/orderlist?status=1'); ?>';"><h4 class="daifahuo">0</h4>待发货</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/order/orderlist?status=2'); ?>';"><h4 class="yifahuo">0</h4>已发货</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/order/orderlist?status=3'); ?>';"><h4 class="yishouhuo">0</h4>已收货</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/order/orderlist?status=4'); ?>';"><h4 class="yiwancheng">0</h4>已完成</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/order/orderlist?status=5'); ?>';"><h4 class="yiguanbi">0</h4>已关闭</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/order/orderlist?status=-1'); ?>';"><h4 class="tuikuanzhong">0</h4>退款中</li>
			<li onclick="location.href='<?php echo __URL('ADMIN_MAIN/order/orderlist?status=-2'); ?>';" style="display: none;"><h4 class="yituikuan">0</h4>已退款</li>
		</ul>
	</div>
</div>

<div class="sales">
	<h3>
		销售情况统计<span>按周期统计商家店铺的订单量和订单金额</span>
	</h3>
	
	<table>
		<tr>
			<td colspan="2" align="left" style="padding: 15px 0 0 20px;">昨日销量</td>
		</tr>
		<tr>
			<td>
				<strong class="yesterday_goods">0</strong>
				<span>订单量(件)</span>
			</td>
			<td>
				<strong class="yesterday_money">0</strong>
				<span>订单金额(元)</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" style="padding: 15px 0 0 20px;">本月销量</td>
		</tr>
		<tr>
			<td>
				<strong class="month_goods">0</strong>
				<span>订单量(件)</span>
			</td>
			<td>
				<strong class="month_money">0</strong>
				<span>订单金额(元)</span>
			</td>
		</tr>
	</table>
</div>

<div class="charts">
	<h3>
		订单总数统计<span><i></i>订单数量</span>
	</h3>
	<div id="orderCharts"></div>
</div>

<div class="sales-ranking">
	<h3>
		单品销售排名<span>按周期统计商家店铺的订单量和订单金额</span>
	</h3>
	<table>
		<tr>
			<td>排行</td>
			<td style="text-align:left;">商品信息</td>
			<td>销量</td>
		</tr>
		<?php if(is_array($goods_list) || $goods_list instanceof \think\Collection || $goods_list instanceof \think\Paginator): if( count($goods_list)==0 ) : echo "" ;else: foreach($goods_list as $key=>$goods_info): ?>
		<tr>
			<td>
			<?php if($key == 0): ?>
				<span class="frist">
			<?php elseif($key == 1): ?>
				<span class="second">
			<?php elseif($key == 2): ?>
				<span class="third">
			<?php else: ?>
				<span>
			<?php endif; ?>
				<?php echo $key+1; ?></span></td>
			<td title="<?php echo $goods_info['goods_name']; ?>" style="text-align:left;">
			<a href="<?php echo __URL('SHOP_MAIN/goods/goodsinfo','goodsid='.$goods_info['goods_id']); ?>" target="_blank">
			<?php
			echo strlen($goods_info["goods_name"])>20 ? mb_substr($goods_info["goods_name"],0,20,'utf-8')."...":$goods_info["goods_name"];
			?></a>
			</td>
			<td>
			<?php if($key == 0): ?>
				<span class="frist">
			<?php elseif($key == 1): ?>
				<span class="second">
			<?php elseif($key == 2): ?>
				<span class="third">
			<?php else: ?>
				<span>
			<?php endif; ?>
			<?php echo $goods_info['real_sales']; ?>
				</span>
			</td>
		</tr>
	<?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
</div>
<div class="charts">
	<h3>
		关注人数统计<span><i></i>关注人数</span>
	</h3>
	<div id="focusCharts"></div>
</div>
<div class="system-config">
	<h3><i class="fa fa-cog"></i>系统信息</h3>
	<table>
		<colgroup>
			<col width="15%">
			<col width="40%">
			<col width="15%">
			<col width="30%">
		</colgroup>
		<tr>
			<td>服务器操作系统</td>
			<td><?php echo $system_config['os']; ?></td>
			<td>服务器域名/IP</td>
			<td><?php echo $system_config['dns']; ?>:<?php echo $system_config['port']; ?>&nbsp;[<?php echo $system_config['ip']; ?>]</td>
		</tr>
		<tr>
			<td>服务器环境</td>
			<td><?php echo $system_config['server_software']; ?></td>
			<td>PHP版本</td>
			<td><?php echo $system_config['php_version']; ?></td>
		</tr>
		<tr>
			<td>文件上传限制</td>
			<td><?php echo $system_config['upload_max_filesize']; ?></td>
			<td>GD版本</td>
			<td><?php echo $system_config['gd_version']; ?></td>
		</tr>
<!-- 		<tr> -->
<!-- 			<td>最大执行时间</td> -->
<!-- 			<td colspan="3"><?php echo $system_config['max_execution_time']; ?></td> -->
<!-- 		</tr> -->
	</table>
</div>

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
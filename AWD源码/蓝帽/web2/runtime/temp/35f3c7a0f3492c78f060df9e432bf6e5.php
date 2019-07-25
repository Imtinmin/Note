<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:39:"template/adminblue/Goods/goodsList.html";i:1501656964;s:28:"template/adminblue/base.html";i:1501813202;s:45:"template/adminblue/controlCommonVariable.html";i:1501656000;s:28:"template/admin/urlModel.html";i:1501551326;s:34:"template/adminblue/pageCommon.html";i:1500458992;s:34:"template/adminblue/openDialog.html";i:1500263974;}*/ ?>
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
		
<link rel="stylesheet" type="text/css" href="ADMIN_CSS/product.css">
<script type="text/javascript" src="__STATIC__/My97DatePicker/WdatePicker.js"></script>
<style type="text/css">
#productTbody td{border: 0;}
.tr-title td{background: #e4f2ff !important;}
.table-title th{padding: 10px;border-bottom: 1px solid #e5e5e5;font-weight: normal;background: #F3F1F1 !important;}
.a-pro-view-img {float: left;}
.thumbnail-img {width: 60px;margin-right: 10px;}
.cell i {display: block;}
.remodal-bg.with-red-theme.remodal-is-opening,.remodal-bg.with-red-theme.remodal-is-opened {filter: none;}
.remodal-overlay.with-red-theme {background-color: #f44336;}
.remodal.with-red-theme {background: #fff;}
input[type="radio"], input[type="checkbox"] {margin: -1px 5px 0;margin-left:0px;}
.edit-group{border-bottom: 1px solid #ebebeb;margin-bottom:10px;}
.edit-group label{font-weight:normal;}
.edit-group-title{height:15px;line-height:15px;width:140px;margin-top:3px;margin-bottom:3px;color:#0072D2;}
.edit-group-button{border-color: #3283fa;border: 1px solid #bbb;height: 26px;line-height: 24px;padding: 0 5px;}
.group-button-bg{background: #3283fa;color: #fff;}
.div-pro-view-name {width: 100%;min-height: 60px;}
i.hot,i.recommend,i.new{font-size:12px;margin-right:5px;font-style:normal;color:#fff;background-color:#E84C3D;border-radius:2px;padding:1px 2px;}
.icon-qrcode:before {content: "\f029";}
[class^="icon-"]:before, [class*=" icon-"]:before {text-decoration: inherit;display: inline-block;speak: none;}
[class^="icon-"], [class*=" icon-"] {font-family: FontAwesome;font-weight: normal;font-style: normal;text-decoration: inherit;-webkit-font-smoothing: antialiased;}
.goodsCategory{width: 218px;height: 300px;border: 1px solid #CCCCCC;position: absolute;z-index: 100;background: #fff;right: 580px;display: none;overflow-y: auto;top: 44px;}
.goodsCategory::-webkit-scrollbar{width: 8px;} 
.goodsCategory::-webkit-scrollbar-track{-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);border-radius: 10px;background-color: #f5f5f5;}
.goodsCategory::-webkit-scrollbar-thumb{height: 20px;border-radius: 10px;-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);background-color: #ddd;}
.goodsCategory ul{height: 280px;margin-top: -2px;margin-left: 0;}
.goodsCategory ul li{text-align: left;padding:0 15px;line-height: 30px;}
.goodsCategory ul li i{float: right;line-height: 30px;}
.goodsCategory ul li:hover{cursor: pointer;}
.goodsCategory ul li:hover,.goodsCategory ul li.selected{background: #00C0FF;color: #fff;}
.two{right: 361px;border-left:0;}
.three{right: 162px;width: 198px;border-left:0;}
.selectGoodsCategory{width: 218px;height: 45px;border:1px solid #CCCCCC;position: absolute;z-index: 100;right: 580px;margin-top: 302px;border-collapse: collapse;background: #fff;display: none;}
.selectGoodsCategory a{display: block;height: 30px;width: 100px;text-align: center;color: #fff;line-height: 30px;margin:8px;background: #00C0FF;text-decoration:none;}
input[type=number] {-moz-appearance:textfield;}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {-webkit-appearance: none;margin: 0;}
.table th{font-weight: normal;}
.table th, .table td {vertical-align: middle;}
.recommendBox{width: 360px;display: inline-block;float: right;}
.introduction_box{width: 360px;display: inline-block;float: right;}
.tab-content{overflow: visible;}
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
					
<li><a href="<?php echo __URL('ADMIN_MAIN/goods/addgoods'); ?>"><i class="fa fa-plus-circle"></i>&nbsp;发布商品</a></li>

					
					<li <?php if($warm_prompt_is_show == 'show'): ?>style="display:none;"<?php endif; ?>><a class="js-open-warmp-prompt"><i class="fa fa-bell"></i>提示</a></li>
					
				</ul>
			</div>
		</div>
		<div class="ns-main">
			
<div class="js-mask-category" style="display:none;background: rgba(0,0,0,0);position:fixed;width:100%;height:100%;top:0;left:0;right:0;bottom:0;z-index:90;"></div>
<table class="mytable">
	<tr>
		<th style="line-height:33px;position: relative;">
			商品分类：
			<input type="text" placeholder="请选择商品分类" id="goodsCategoryOne" is_show="false" class="input-common">
			<div class="goodsCategory one">
				<ul>
					<?php if(is_array($oneGoodsCategory) || $oneGoodsCategory instanceof \think\Collection || $oneGoodsCategory instanceof \think\Paginator): $i = 0; $__LIST__ = $oneGoodsCategory;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<li class="js-category-one" category_id="<?php echo $vo['category_id']; ?>">
						<span><?php echo $vo['category_name']; ?></span>
						<?php if($vo['is_parent'] == 1): ?>
							<i class="fa fa-angle-right fa-lg"></i>
						<?php endif; ?>
					</li>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
			</div>
			<div class="goodsCategory two" style="border-left:0;">
				<ul id="goodsCategoryTwo"></ul>
			</div>
			<div class="goodsCategory three">
				<ul id="goodsCategoryThree"></ul>
			</div>
			<div class="selectGoodsCategory">
				<a href="javascript:;" id="confirmSelect" style="float:right;">确认选择</a>
			</div>
			<input type="hidden" id="category_id_1">
			<input type="hidden" id="category_id_2">
			<input type="hidden" id="category_id_3">
			商品名称：<input id="goods_name" class="input-medium input-common" type="text" value="<?php echo $search_info; ?>" placeholder="要搜索的商品名称" >
			上下架
			<select id="state" class="select-common">
				<option value="">全部</option>
				<option value="1">上架</option>
				<option value="0">下架</option>
			</select>
			<input type="button" onclick="searchData()" value="搜索" class="btn-common"/>
		</th>
	</tr>
</table>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane active">
		<table class="table table-striped table-main" border="0">
			<colgroup>
				<col width="3%">
				<col width="43%">
				<col width="12%">
				<col width="6%">
				<col width="6%">
				<col width="7%">
				<col width="7%">
				<col width="15%">
			</colgroup>
			<tbody>
				<tr class="table-title">
					<th></th>
					<th>商品名称</th>
					<th>价格（元）</th>
					<th>总库存</th>
					<th>销量</th>
					<th>上下架</th>
					<th>排序</th>
					<th style="text-align:center;">操作</th>
				</tr>
				<tr class="trcss">
					<td colspan="5">
						<input onclick="CheckAll(this)" type="checkbox" id="chek_all">
						<span style="display: inline-block; margin-left: 0px; margin-right: 10px;font-weight: 400;">全选</span>
						<a class="btn btn-small" href="javascript:batchDelete()">批量删除</a>
						<a class="btn btn-small upstore" href="javascript:void(0)" onclick="goodsIdCount('online')">上架</a>
						<a class="btn btn-small downstore" href="javascript:void(0)" onclick="goodsIdCount('offline')">下架</a>
						<!-- <a class="btn btn-small recommend" href="javascript:void(0)" onclick="ShowRecommend()" data-html="true" id="setRecommend" title="<h6 class='edit-group-title'>推荐</h6>"
						data-container="body" data-placement="bottom"  data-trigger="manual"
						data-content="<div class='edit-group' id='recommendType'>
 							<label class='checkbox-inline'><input type='checkbox' value='1'>热销 </label>
							<label class='checkbox-inline'><input type='checkbox' value='2'>推荐 </label>
							<label class='checkbox-inline'><input type='checkbox' value='3'>新品 </label>
							</div>
							<button class='btn btn-primary btn-small' onclick='setRecommend();'>保存</button>
							<button class='btn btn-small' onclick='hideSetRecommend()'>取消</button>
							"
						>推荐</a> -->
						<a onclick="goodsGroupIdCount();" data-html="true" class="btn btn-small fun-a category" href="javascript:void(0)" id="editGroup" title="<h6 class='edit-group-title'>修改商品标签</h6>" data-container="body" data-placement="bottom"  data-trigger="manual"
							data-content="<div class='edit-group' id='goodsChecked' style='max-width:auto;'>
 							<?php foreach($goods_group as $vo): ?> 
 							<p>
 							<label class='checkbox-inline' style='display:inline-block;' >
								<input type='checkbox' value='<?php echo $vo['group_id']; ?>'><span><?php echo $vo['group_name']; ?></span>&nbsp;&nbsp;&nbsp;
							</label>
							<?php foreach($vo['sub_list']['data'] as $vs): ?>
							<label style='display:inline-block;'>
								<input type='checkbox' value='<?php echo $vs['group_id']; ?>'><?php echo $vs['group_name']; ?>
								</label>
								<?php endforeach; ?>
							</p>
							<?php endforeach; ?>
							</div>
							<button class='btn btn-primary btn-small' onclick='goodsGroupUpdate();'>保存</button>
							<button class='btn btn-small' onclick='hideEditGroup()'>取消</button>
							">
							商品标签</a>
						<a href="javascript:;"  class="btn btn-small fun-a category" title="更新二维码" onclick="batchUpdateGoodsQrcode();">更新二维码</a>	
						<input type='hidden' id='goods_type_ids'/>
					</td>
				</tr>
			</tbody>
			<tbody id="productTbody" style="border: 0px;"></tbody>
		</table>
	</div>
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

<script type="text/javascript">
function searchData(){
	LoadingInfo(1);
}

//隐藏商品分组
function hideEditGroup(){
	$("#editGroup").popover("hide");
}

function hideSetRecommend(){
	$("#setRecommend").popover("hide");
}

function LoadingInfo(page_index) {
	
	var start_date = $("#startDate").val();
	var end_date = $("#endDate").val();
	var state = $("#state").val();
	var goods_name =$("#goods_name").val();
	var category_id_1 = $("#category_id_1").val();
	var category_id_2 = $("#category_id_2").val();
	var category_id_3 = $("#category_id_3").val();
	$.ajax({
		type : "post",
		url : "<?php echo __URL('ADMIN_MAIN/goods/goodslist'); ?>",
		data : {
			"page_index" : page_index,
			"page_size" : $("#showNumber").val(),
			"start_date":start_date,
			"end_date":end_date,
			"state":state,
			"goods_name":goods_name,
			"category_id_1" : category_id_1,
			"category_id_2" : category_id_2,
			"category_id_3" : category_id_3
		},
		success : function(data) {
			var html = '';
			if (data["data"].length > 0) {
				for (var i = 0; i < data["data"].length; i++) {
					html += '<tr class="tr-title" style=" width: 1502px;"><td class="td-'+ data["data"][i]["goods_id"]+'"><label><input value="'
						+ data["data"][i]["goods_id"]
						+ '" tj="" name="sub" data-state="'+data["data"][i]["state"]+'" type="checkbox"></label></td>';
					html += '<td colspan="7" style="width: 97%;"><div style="display: inline-block; width: 100%;" class="pro-code"><span>商家编码'+'：'
						+ data["data"][i]["code"] + '</span>';
					/* if(data["data"][i]["state"] == 1){
						html += '<span class="pro-code" style="color: #f35252; float: right;"> <i class="fa fa-long-arrow-up" style="margin-right: 4px;"></i>已上架';
					}else{
						html += '<span class="pro-code" style="color: #27A9E3; float: right;"> <i class="fa fa-long-arrow-up" style="margin-right: 4px;"></i>已下架';
					} */
					html += '<span class="pro-code" style="margin-left:10px;">创建时间：'+timeStampTurnTime(data["data"][i]["create_time"]);
					html += '<span  class="div-flag-style" style="display: inline-block;margin:0 20px 0 40px;position:relative"> <i class="icon-qrcode"style="background: none; color: #555; font-size: 20px; margin-right: 0;"></i>';
					html += '<div class="QRcode" style="display: none; position: absolute;width:110px;top:28px;left:0;"id="qrcode"><p><img src="__ROOT__/'+ data["data"][i]["QRcode"]+'" style="width:110px;"></p></div></span>';
					html += '</span></div></td></tr>';
					html += '<tr><td colspan="2" style="background: white;"><div><a class="a-pro-view-img" href="'+__URL('SHOP_MAIN/goods/goodsinfo?goodsid='+data["data"][i]["goods_id"])+'" target="_blank"><img class="thumbnail-img"src="__ROOT__/'+data["data"][i]["pic_cover_micro"]+'">';
					html += '<div class="div-pro-view-name"><span style="color: #13A5D5;" class="thumbnail-name title='+ data["data"][i]["goods_name"]+'"><a target="_blank" style="word-break:break-all;" href="'+__URL('SHOP_MAIN/goods/goodsinfo?goodsid='+data["data"][i]["goods_id"])+'">'
						+ data["data"][i]["goods_name"]
						+ '</a></span><br/>';
					//html += '<div class="div-flag-style"><span class="" title=""><i class="icon-tablet"style="background: none; color: #555; font-size: 20px; margin-right: 0;"></i></span><span onmouseover="mouseover(this)" onmouseout="mouseout(this)"style="display: inline-block;"> <i class="icon-qrcode"style="background: none; color: #555; font-size: 20px; margin-right: 0;"></i></span>';
					//html += '<div class="QRcode" style="display: none; position: absolute;"id="qrcode"><p><img src=""></p></div></div>';
					// html += '<div class="introduction_box">'+data["data"][i]["introduction"]+'</div><br>';
					// html += '<span class="recommendBox">';
					// html += data["data"][i]["is_hot"] == 1 ? '<i class="hot">热</i>' : '';
					// html += data["data"][i]["is_recommend"] == 1 ? '<i class="recommend">荐</i>' : '';
					// html += data["data"][i]["is_new"] == 1 ? '<i class="new">新</i>' : '';
					// html += '</span></div>';
				//	html += '<div style="margin-top:10px;">';
				//	html += data["data"][i]["is_hot"] == 1 ? '<i class="hot">热</i>' : '';
				//	html += data["data"][i]["is_recommend"] == 1 ? '<i class="recommend">荐</i>' : '';
				//	html += data["data"][i]["is_new"] == 1 ? '<i class="new">新</i>' : '';
				//	html += '<span  class="div-flag-style" style="display: inline-block;"> <i class="icon-qrcode"style="background: none; color: #555; font-size: 20px; margin-right: 0;"></i></span>';
				//	html += '<div class="QRcode" style="display: none; position: absolute;"id="qrcode"><p><img src="__ROOT__/'+ data["data"][i]["QRcode"]+'" style="width:110px;"></p></div>';
				//	html += '</div>';
				html += '</div></td>';
					html += '<td style="background: white;"><div class="priceaddactive"><span class="price-lable">原&nbsp;&nbsp;&nbsp;价：</span><span class="price-numble" style="color: #666;"id="moreChangePrice'+ data["data"][i]["goods_id"]+'"  >'
						+ data["data"][i]["price"]
						+ '</span></div>';
					html += '<div><span class="price-lable" >销售价：</span><span class="price-numble"id="moreChangePrice'+ data["data"][i]["goods_id"]+'" style="color:red;">'
						+ data["data"][i]["promotion_price"]
						+ '</span>';
					html += '</td>';
					html += '<td style="background: white;"><div class="cell"><span class="pro-stock" style="color: #666;"id="moreChangeStock'+ data["data"][i]["goods_id"] + '">'
						+ data["data"][i]["stock"]
						+ '</span></div></td>';
						html += '<td style="background: white;"><div class="cell"><span class="pro-stock" style="color: #666;"id="moreChangeStock'+ data["data"][i]["goods_id"]+'">'
						+ data["data"][i]["real_sales"]
						+ '</span></div></td>';
					if(data["data"][i]["state"] == 1){
						html += '<td style="background: white;"><a href="javascript:void(0)" onclick="modifyGoodsOnline('+data["data"][i]["goods_id"]+',\'offline\')">已上架</a></td>';
					}else{
						html += '<td style="background: white;"><a href="javascript:void(0)" onclick="modifyGoodsOnline('+data["data"][i]["goods_id"]+',\'online\')" style="color:#999;">已下架</a></td>';
					}
					html += '<td style="background: white;"><div class="cell"><input class="input-mini" goods_id="'
						+ data["data"][i]["goods_id"]
						+ '" style="width:30px;text-align:center;" value="'
						+ data["data"][i]["sort"]
						+ '" onchange="changeSort(this)"' 
						+ 'type="number"></div></td>';
					html += '<td style="background: white;"><div ><div class="bs-docs-example tooltip-demo"style="text-align: center;">';
					html += '<a href="javascript:;" data-placement="bottom" data-original-title="编辑"><span class="edit" style="display: inline-block; width: 19%;" onclick="updateGoodsDetail('
						+ data["data"][i]["goods_id"]
						+ ')"><i class="icon-edit" style="width: initial;"></i>编辑</span></a>';
					html += '<a href="javascript:;" data-placement="bottom" data-original-title="复制"><span class="edit" style="display: inline-block; width: 19%;" onclick="copyGoodsDetail('
						+ data["data"][i]["goods_id"]
						+ ')"><i class="icon-edit" style="width: initial;"></i>复制</span></a>';
					// html += '<a href="javascript:;" data-placement="bottom" ><span class="edit" style="display: inline-block; " onclick="updateGoodsQrcode('
					// 		+ data["data"][i]["goods_id"]
					// 		+ ')"><i class="icon-edit" style="width: initial;"></i>更新二维码</span></a>';
					html += '<a href="javascript:void(0)" data-placement="bottom"onclick="deleteGoods('
						+ data["data"][i]["goods_id"]
						+ ')" data-original-title="删除"><span class="del" style="display: inline-block; width: 19%;"><i class="icon-trash" style="width: initial;"></i>删除</span></a></div></div></td></tr>';
				}
			} else {
				html += '<tr align="center"><td colspan="8" style="text-align: center;font-weight: normal;color: #999;">暂无符合条件的数据记录</td></tr>';
			}
			$("#productTbody").html(html);
			initPageData(data["page_count"],data['data'].length,data['total_count']);
			$("#pageNumber").html(pagenumShow(jumpNumber,$("#page_count").val(),<?php echo $pageshow; ?>));
			code();
		}
	});
}

//二维码
function code(){
	$(".div-flag-style").mouseover(function(){
		$(this).children('.QRcode').show();
	});
	$(".div-flag-style").mouseout(function(){
		$(this).children('.QRcode').hide();
	});
} 

//把值传过去即可
function updateGoodsDetail(goods_id) {
	window.location = __URL("ADMIN_MAIN/goods/addgoods?step=2&goodsId="+ goods_id);
}

//全选
function CheckAll(event){
	var checked = event.checked;
	$("#productTbody input[type = 'checkbox']").prop("checked",checked);
}

//商品上架id合计
function goodsIdCount(line){
	var goods_ids= "";
	$("#productTbody input[type='checkbox']:checked").each(function() {
		if (!isNaN($(this).val())) {
			var state = $(this).data("state");
//			if(line == "online"){
//				if(state == 1){
//					$( "#dialog" ).dialog({
//						buttons: {
//							"确定": function() {
//								$(this).dialog('close');
//							}
//						},
//						contentText:"记录中包含已上架记录",
//						title:"消息提醒",
//					});
//					return false;
//				}
//			}else{
//				if(state == 0){
//					$( "#dialog" ).dialog({
//						buttons: {
//							"确定": function() {
//								$(this).dialog('close');
//							}
//						},
//						contentText:"记录中包含已下架记录",
//						title:"消息提醒",
//					});
//				return false;
//				}
//			}
			goods_ids = $(this).val() + "," + goods_ids;
		}
	});
	goods_ids = goods_ids.substring(0, goods_ids.length - 1);
	if(goods_ids == ""){
		$( "#dialog" ).dialog({
			buttons: {
				"确定": function() {
					$(this).dialog('close');
				}
			},
			contentText:"请选择需要操作的记录",
			title:"消息提醒",
		});
		return false;
	}
	modifyGoodsOnline(goods_ids,line);
}

//商品上下架
function modifyGoodsOnline(goods_ids,line){
	if(line == "online"){
		var url = "<?php echo __URL('ADMIN_MAIN/Goods/modifygoodsonline'); ?>";
		var lingStr = "上架";
	}else{
		var url = "<?php echo __URL('ADMIN_MAIN/Goods/modifygoodsoffline'); ?>";
		var lingStr = "下架";
	}
	$.ajax({
		type : "post",
		url : url,
		data : { "goods_ids" : goods_ids },
		success : function(data) {
			if(data["code"] > 0 ){
				LoadingInfo(getCurrentIndex(goods_ids,'#productTbody','tr[class="tr-title"]'));
				$("#dialog" ).dialog({
					buttons: {
						"确定": function() {
							$(this).dialog('close');
						}
					},
					contentText:"商品"+lingStr+"成功",
					title:"消息提醒",
					time:3
				});
			}
		}
	})
}

function batchDelete() {
	var goods_ids= new Array();
	$("#productTbody input[type='checkbox']:checked").each(function() {
		if (!isNaN($(this).val())) {
			goods_ids.push($(this).val());
		}
	});
	if(goods_ids.length ==0){
		$( "#dialog" ).dialog({
			buttons: {
				"确定,#e57373": function() {
					$(this).dialog('close');
				}
			},
			contentText:"请选择需要操作的记录",
			title:"消息提醒",
		});
		return false;
	}
	deleteGoods(goods_ids);
}

function deleteGoods(goods_ids){
	$( "#dialog" ).dialog({
		buttons: {
			"确定": function() {
				$.ajax({
					type : "post",
					url : "<?php echo __URL('ADMIN_MAIN/goods/deletegoods'); ?>",
					data : { "goods_ids" : goods_ids.toString() },
					dataType : "json",
					success : function(data) {
						if(data["code"] > 0 ){
							LoadingInfo(getCurrentIndex(goods_ids,'#productTbody','tr[class="tr-title"]'));
							$("#dialog").dialog({
								buttons: {
									"确定": function() {
										$(this).dialog('close');
									}
								},
								modal: true,
								contentText:data["message"],
								title:"消息提醒",
								time:1
							});
							$("#chek_all").prop("checked", false);
						}
					}
				});
				$(this).dialog('close');
			},
			"取消,#e57373": function() {
				$(this).dialog('close');
			},
		},
		contentText:"确定要删除吗？",
	});
}

//商品修改分组id合计
function goodsGroupIdCount(){
	var goods_ids= "";
	$("#productTbody input[type='checkbox']:checked").each(function() {
		if (!isNaN($(this).val())) {
			goods_ids = $(this).val() + "," + goods_ids;
		}
	});
	goods_ids = goods_ids.substring(0, goods_ids.length - 1);
	if(goods_ids == ""){
		$( "#dialog" ).dialog({
			buttons: {
				"确定": function() {
					$(this).dialog('close');
				}
			},
			contentText:"请选择需要操作的记录",
			title:"消息提醒",
		});
		return false;
	}
	$("#goods_type_ids").val(goods_ids);
	$("#editGroup").popover("show");
	$(".popover").css("max-width",'1000px');
}

//商品修改分组
function goodsGroupUpdate(){
	var goods_type = "";
	var goods_ids = $("#goods_type_ids").val();
	$("#goodsChecked input[type='checkbox']:checked").each(function(){
		if (!isNaN($(this).val())) {
			goods_type = $(this).val() + "," + goods_type;
		}
	})
	if(goods_type == ""){
		$( "#dialog" ).dialog({
			buttons: {
				"确定": function() {
					$(this).dialog('close');
				}
			},
			contentText:"请选择需要操作的记录",
			title:"消息提醒",
		});
		return false;
	}
	goods_type = goods_type.substring(0, goods_type.length - 1);
	$.ajax({
		type : "post",
		url : "<?php echo __URL('ADMIN_MAIN/goods/modifygoodsgroup'); ?>",
		data : {
			"goods_id" : goods_ids,
			"goods_type" : goods_type
		},
		success : function(data) {
			if(data["code"] > 0 ){
				$("#editGroup").popover("hide");
				LoadingInfo(getCurrentIndex(goods_ids,'#productTbody','tr[class="tr-title"]'));
				$( "#dialog" ).dialog({
					buttons: {
						"确定": function() {
							$(this).dialog('close');
						}
					},
					contentText:data["message"],
					title:"消息提醒",
				});
			}
		}
	})
}

//显示 推荐选项
function ShowRecommend(){
	var goods_ids= "";
	$("#productTbody input[type='checkbox']:checked").each(function() {
		if (!isNaN($(this).val())) {
			goods_ids = $(this).val() + "," + goods_ids;
		}
	});
	goods_ids = goods_ids.substring(0, goods_ids.length - 1);
	if(goods_ids == ""){
		$( "#dialog" ).dialog({
			buttons: {
				"确定": function() {
					$(this).dialog('close');
				}
			},
			contentText:"请选择需要操作的记录",
			title:"消息提醒",
		});
		return false;
	}
	$("#goods_type_ids").val(goods_ids);
	$("#setRecommend").popover("show");
}

//修改为  推荐 商品
function setRecommend(){
	var recommend_type = '';
	var goods_ids = $("#goods_type_ids").val();
	$("#recommendType input[type='checkbox']").each(function(){
		if ($(this).attr("checked") == 'checked') {
			var recommend_type_new = 1;
		}else{
			var recommend_type_new = 0;
		}
		recommend_type = recommend_type_new + "," + recommend_type;
	})
	if(recommend_type == ""){
		$( "#dialog" ).dialog({
			buttons: {
				"确定": function() {
					$(this).dialog('close');
				}
			},
			contentText:"请选择需要操作的记录",
			title:"消息提醒",
		});
		return false;
	}
	recommend_type = recommend_type.substring(0, recommend_type.length - 1);
	$.ajax({
		type : "post",
		url : "<?php echo __URL('ADMIN_MAIN/goods/modifygoodsrecommend'); ?>",
		data : {
			"goods_id" : goods_ids,
			"recommend_type" : recommend_type
		},
		success : function(data) {
			if(data["code"] > 0 ){
				$("#setRecommend").popover("hide");
				LoadingInfo(getCurrentIndex(goods_ids,'#productTbody','tr[class="tr-title"]'));
				$( "#dialog" ).dialog({
					buttons: {
						"确定": function() {
							$(this).dialog('close');
						}
					},
					contentText:data["message"],
					title:"消息提醒",
				});
			} 
		}
	})
}

$("#goodsCategoryOne").click(function(){
	var isShow = $("#goodsCategoryOne").attr('is_show');
	if(isShow == "false"){
		$(".one").show();
		$(".selectGoodsCategory").css({
			'width' : 218,
			'right' : 580
		});
		$(".selectGoodsCategory").show();
		$("#goodsCategoryOne").attr('is_show','true');
		$(".js-mask-category").show();
	}else{
		$(".one").hide();
		$(".two").hide();
		$(".three").hide();
		$(".selectGoodsCategory").css({
			'width' : 218,
			'right' : 580
		});
		$(".selectGoodsCategory").hide();
		$("#goodsCategoryOne").attr('is_show','false');
	}
})

$(".js-mask-category").click(function(){
	$(".one").hide();
	$(".selectGoodsCategory").hide();
	$(".two").hide();
	$(".three").hide();
	$("#goodsCategoryOne").attr('is_show', 'false');
	$(this).hide();
})

$(".js-category-one").click(function(){
	parentId = $(this).attr("category_id");
	category_name = $(this).text();
	$(".one ul li").not($(this)).removeClass("selected");
	$(this).addClass("selected");
	$("#goodsCategoryOne").val($.trim(category_name)+">");
	$("#category_id_1").val(parentId);
	$("#category_id_2").val('');
	$("#category_id_3").val('');
	$.ajax({
		type : 'post',
		url : "<?php echo __URL('ADMIN_MAIN/goods/getcategorybyparentajax'); ?>",
		data : {"parentId":parentId},
		success : function(data){
			if(data.length>0){
				var html = '';
				for (var i = 0; i < data.length; i++) {
					html += '<li class="js-category-two" category_id="'+data[i]['category_id']+'">'+data[i]['category_name'];
					if(data[i]['is_parent'] == 1){
						html += '<i class="fa fa-angle-right fa-lg"></i>';
					}
					html += '</li>';
				}
				$("#goodsCategoryTwo").html(html);
				$(".two").show();
				$(".selectGoodsCategory").css({
					'width' : 437,
					'right' : 361
				});
			}else{
				$(".one").hide();
				$(".two").hide();
				$(".js-mask-category").hide();
				$(".selectGoodsCategory").hide();
				$("#goodsCategoryOne").attr('is_show', 'false');
			}
			$(".three").hide();
		}
	});
	return false;
});

$(".js-category-two").live("click",function(event){
	var parentId = $(this).attr("category_id");
	var category_name = $(this).text();
	$(".two ul li").not($(this)).removeClass("selected");
	$(this).addClass("selected");
	var goodsCategoryOne = $("#goodsCategoryOne").val();
	$("#goodsCategoryOne").val(goodsCategoryOne+''+category_name+'>');
		$("#category_id_2").val(parentId);
	$("#category_id_3").val('');
	$.ajax({
		type : 'post',
		url : "<?php echo __URL('ADMIN_MAIN/goods/getcategorybyparentajax'); ?>",
		data : {"parentId":parentId},
		success : function(data){
			if(data.length>0){
				var html = '';
				for (var i = 0; i < data.length; i++) {
					html += '<li onclick="goodsCategoryThree(this);" category_id="'+data[i]['category_id']+'">'+data[i]['category_name']+'<i class="fa fa-angle-right fa-lg"></i></li>';
				}
				$("#goodsCategoryThree").html(html);
				$(".three").show();
				$(".selectGoodsCategory").css({
					'width' : 636,
					'right' : 162
				});
			}else{
				$(".one").hide();
				$(".two").hide();
				$(".three").hide();
				$(".selectGoodsCategory").hide();
				$(".js-mask-category").hide();
				$("#goodsCategoryOne").attr('is_show', 'false');
			}
		}
	})
	event.stopPropagation();
});

function goodsCategoryThree(obj){
	var parentId = $(obj).attr("category_id");
	var category_name = $(obj).text();
	$(".three ul li").not($(obj)).removeClass("selected");
	$(obj).addClass("selected");
	var goodsCategoryOne = $("#goodsCategoryOne").val();
	$("#goodsCategoryOne").val(goodsCategoryOne+''+category_name);
		$("#category_id_3").val(parentId);
	$(".one").hide();
	$(".two").hide();
	$(".three").hide();
	$(".selectGoodsCategory").hide();
	$(".js-mask-category").hide();

	$(".selectGoodsCategory").css({
		'width' : 218,
		'right' : 580
	});
	$("#goodsCategoryOne").attr('is_show','false');
}

$("#confirmSelect").click(function(){
	$(".one").hide();
	$(".two").hide();
	$(".three").hide();
	$(".selectGoodsCategory").hide();
	$(".selectGoodsCategory").css({
		'width' : 218,
		'right' : 580
	});
})

function copyGoodsDetail(goods_id){
	$( "#dialog" ).dialog({
		buttons: {
			"确定": function() {
				$.ajax({
					type : "post",
					url : "<?php echo __URL('ADMIN_MAIN/goods/copygoods'); ?>",
					data : {"goods_id":goods_id},
					dataType : "json",
					success : function(data) {
						if(data["code"] > 0 ){
							LoadingInfo(getCurrentIndex(goods_id,'#productTbody','tr[class="tr-title"]'));
							$("#dialog").dialog({
								buttons: {
									"确定": function() {
										$(this).dialog('close');
									}
								},
								modal: true,
								contentText:data["message"],
								title:"消息提醒",
								time:1
							});
							$("#chek_all").prop("checked", false);
						}
					}
				});
				$(this).dialog('close');
			},
			"取消,#e57373": function() {
				$(this).dialog('close');
			},
		},
		contentText:"确定要复制一条新的商品信息吗？",
	});
}

function changeSort(event){
	var sort = parseInt($(event).val());
	$(event).val(sort);
	var goods_id = $(event).attr("goods_id");
	$.ajax({
		type : "post",
		url : "<?php echo __URL('ADMIN_MAIN/goods/updateGoodsSortAjax'); ?>",
		data : { "sort" : sort, "goods_id" : goods_id },
		success : function(data){
			if(data.code>0){
				showTip(data.message,"success");
			}else{
				showTip(data.message,"error");
			}
		}
	})
}

	/**
	更新二维码
	*/
	function batchUpdateGoodsQrcode(){
		var goods_ids= new Array();
		$("#productTbody input[type='checkbox']:checked").each(function() {
			if (!isNaN($(this).val())) {
				goods_ids.push($(this).val());
			}
		});
		if(goods_ids.length == 0){
			showMessage("error", "请至少选择一件商品");
			return false;
		}
		$.ajax({
			type : "post",
			url : "<?php echo __URL('ADMIN_MAIN/goods/updateGoodsQrcode'); ?>",
			data : {
				"goods_id" : goods_ids,
			},
			success : function(data){
				if (data["code"] > 0) {
					showMessage('success', '二维码更新成功');
					LoadingInfo(1);
				}else{
					showMessage('error', data['message']);
				}	
			}
		})
	}
</script>

</body>
</html>
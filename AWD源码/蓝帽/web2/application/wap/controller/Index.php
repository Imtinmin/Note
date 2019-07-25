<?php
/**
 * Index.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 山西牛酷信息科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: http://www.niushop.com.cn
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */
namespace app\wap\controller;

use data\service\Goods;
use data\service\GoodsBrand as GoodsBrand;
use data\service\GoodsCategory;
use data\service\Member as MemberService;
use data\service\Platform;
use data\service\Shop;
use data\service\Config;
use data\service\Weixin;
use data\service\WebSite;
use data\service\promotion\PromoteRewardRule;
use data\service\Member;

class Index extends BaseController
{

    /**
     * 平台端首页
     *
     * @return Ambigous <\think\response\View, \think\response\$this, \think\response\View>
     */
    public function index()
    {
        // 分享
        $ticket = $this->getShareTicket();
        $this->assign("signPackage", $ticket);
        $platform = new Platform();
        // 轮播图
        $plat_adv_list = $platform->getPlatformAdvPositionDetail(1105);
        $this->assign('plat_adv_list', $plat_adv_list);
        // 促销模块
        $cx_condition = ['class_type'=> 2, 'is_use'=> 1, 'show_type'=>1];
        $class_list = $platform->getPlatformGoodsRecommendClass($cx_condition);
        $this->assign("class_list", $class_list);
        // 品牌
        $goods_brand = new GoodsBrand();
        $list = $goods_brand->getGoodsBrandList(1, 6, '', 'sort');
        $this->assign('list', $list['data']);
        
        // 限时折扣
        $goods = new Goods();
        $condition['status'] = 1;
        $discount_list = $goods->getDiscountGoodsList(1, 4, $condition, 'end_time');
        foreach ($discount_list['data'] as $k => $v) {
            $v['discount'] = str_replace('.00', '', $v['discount']);
            // $v['promotion_price'] = str_replace('.00', '', $v['promotion_price']);
            // $v['price'] = str_replace('.00', '', $v['price']);
        }
        $this->assign('discount_list', $discount_list['data']);
        
        // 首页商城热卖
        $hot_selling_adv = $platform->getPlatformAdvPositionDetail(1164);
        $this->assign('hot_selling_adv', $hot_selling_adv);
        
        // 公众号配置查询
        $config = new Config();
        $wchat_config = $config->getInstanceWchatConfig($this->instance_id);
        
        $is_subscribe = 0; // 标识：是否显示顶部关注 0：[隐藏]，1：[显示]
                           // 检查是否配置过微信公众号
        if (! empty($wchat_config['value'])) {
            if (! empty($wchat_config['value']['appid']) && ! empty($wchat_config['value']['appsecret'])) {
                // 如何判断是否关注
                if (isWeixin()) {
                    if (! empty($this->uid)) {
                        // 检查当前用户是否关注
                        $user_sub = $this->user->checkUserIsSubscribeInstance($this->uid, $this->instance_id);
                        if ($user_sub == 0) {
                            // 未关注
                            $is_subscribe = 1;
                        }
                    }
                }
            }
        }
        $this->assign("is_subscribe", $is_subscribe);
        // 公众号二维码获取
        $this->web_site = new WebSite();
        $web_info = $this->web_site->getWebSiteInfo();
        // var_dump($web_info);die;
        $this->assign('web_info', $web_info);
        
        $member = new MemberService();
        $source_user_name = "";
        $source_img_url = "";
        if (! empty($_GET['source_uid'])) {
            $_SESSION['source_uid'] = $_GET['source_uid'];
            $user_info = $member->getUserInfoByUid($_SESSION['source_uid']);
            if (! empty($user_info)) {
                $source_user_name = $user_info["nick_name"];
                if (! empty($user_info["user_headimg"])) {
                    $source_img_url = $user_info["user_headimg"];
                }
            }
        }
        /*
         * $notice_arr = [
         * "Niushop开源商城，震撼发布！",
         * "Niushop开源商城，震撼发布！",
         * "Niushop开源商城，震撼发布！",
         * "Niushop开源商城，震撼发布！",
         * "Niushop开源商城，震撼发布！"
         * ];
         */
        
        $notice_arr = $config->getNotice(0);
        $this->assign('notice', $notice_arr);
        $this->assign('source_user_name', $source_user_name);
        $this->assign('source_img_url', $source_img_url);
        
        $member = new Member();
        $coupon_list = $member->getMemberCouponTypeList($this->instance_id, $this->uid);
        $this->assign('coupon_list', $coupon_list);
        //判断是否开启了自定义模块
        
        //$teplate_info = $config->getCustomTeplateInfo(["shop_id"=>$this->instance_id,"is_enable"=>1]);
        $teplate_info = array();
        if(!empty($teplate_info)){
            $custom_template_info = json_decode($teplate_info["template_data"], true);
            foreach($custom_template_info as $k=>$v){
                $custom_template_info[$k]["style_data"] = json_decode($v["control_data"], true);
            }
            //给数组排序
            $sort = array(
                         'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
                         'field'     => 'sort',       //排序字段
            );
            $arrSort = array();
            foreach($custom_template_info as $uniqid => $row){
                foreach($row as $key=>$value){
                    $arrSort[$key][$uniqid] = $value;
                }
            }
            if($sort['direction']){
                array_multisort($arrSort[$sort['field']], constant($sort['direction']), $custom_template_info);
            }
            foreach($custom_template_info as $k=>$v){
                if($v["control_name"] == "goodsList"){
                    if($v["style_data"]["goods_source"] > 0){
                        $goods_list = $goods->getGoodsList(1, $v["style_data"]["goods_limit_count"] , ["ng.category_id"=>$v["style_data"]["goods_source"]], "create_time desc");
                        $goods_query = array();
                        if(!empty($goods_list)){
                            $goods_query = $goods_list["data"];
                        }
                        $custom_template_info[$k]["goods_list"] = $goods_query;
                    }   
                }
            }
            $this->assign("custom_template", $custom_template_info);
//             var_dump($custom_template_info);
//             exit();
            return view($this->style . 'Index/customTemplateIndex');          
        }else{
            return view($this->style . 'Index/index');
        }
    }

    /**
     * 限时折扣
     */
    public function discount()
    {
        $platform = new Platform();
        // 限时折扣广告位
        $discounts_adv = $platform->getPlatformAdvPositionDetail(1163);
        $this->assign('discounts_adv', $discounts_adv);
        if (request()->isAjax()) {
            $goods = new Goods();
            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '0';
            $condition['status'] = 1;
            if (! empty($category_id)) {
                $condition['category_id_1'] = $category_id;
            }
            $discount_list = $goods->getDiscountGoodsList(1, 0, $condition);
            foreach ($discount_list['data'] as $k => $v) {
                $v['discount'] = str_replace('.00', '', $v['discount']);
                $v['promotion_price'] = str_replace('.00', '', $v['promotion_price']);
                $v['price'] = str_replace('.00', '', $v['price']);
            }
            return $discount_list['data'];
        } else {
            $goods_category = new GoodsCategory();
            $goods_category_list_1 = $goods_category->getGoodsCategoryList(1, 0, [
                "is_visible" => 1,
                "level" => 1
            ]);
            
            $this->assign('goods_category_list_1', $goods_category_list_1['data']);
            
            return view($this->style . 'Index/discount');
        }
    }
    
    // 分享送积分
    public function shareGivePoint()
    {
        if (request()->isAjax()) {
            $rewardRule = new PromoteRewardRule();
            $url = request()->post('share_url','');
            $url_arr = parse_url($url);
            if (stristr($url_arr['path'], 'goods/goodsdetail')){
            
                $url_query_arr = explode('&', $url_arr['query']);
                $params = array();
                foreach ($url_query_arr as $param){
                    $item = explode('=', $param);
                    $params[$item[0]] = $item[1];
                }
                if(!empty($params['id'])){
                    hook('pointShareGoods', ['goods_id' => $params['id']]);
                }
            }
            $res = $rewardRule->memberShareSendPoint($this->instance_id, $this->uid);
            return AjaxReturn($res);
        } 
    }

    /**
     * 设置页面打开cookie
     */
    public function setClientCookie()
    {
        $client = request()->post('client', '');
        setcookie('default_client', $client);
        // $cookie = request()->cookie('default_client', '');
        // return $cookie;
        return AjaxReturn(1);
    }

    /**
     * 首页领用优惠券
     */
    public function getCoupon()
    {
        $coupon_type_id = request()->post('coupon_type_id', 0);
        if (! empty($this->uid)) {
            $member = new Member();
            $retval = $member->memberGetCoupon($this->uid, $coupon_type_id, 2);
            return AjaxReturn($retval);
        } else {
            return AjaxReturn(NO_LOGIN);
        }
    }
}

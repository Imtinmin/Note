<?php
/**
 * Order.php
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

use data\service\Express;
use data\service\promotion\GoodsExpress as GoodsExpressService;
use data\service\Goods;
use data\service\Member;
use data\service\Member as MemberService;
use data\service\Order as OrderService;
use data\service\promotion\GoodsMansong;
use data\model\NsCartModel;
use data\model\NsGoodsModel;
use data\model\AlbumPictureModel;
use data\service\Config;
use data\service\Promotion;
use data\service\promotion\GoodsPreference;
use data\service\Shop;

/**
 * 订单控制器
 *
 * @author Administrator
 *        
 */
class Order extends BaseController
{

    /**
     * 待付款订单
     */
    public function paymentOrder()
    {
        $this->orderInfo();
        return view($this->style . '/Order/paymentOrder');
    }

    /**
     * 待付款订单需要的数据
     * 2017年6月28日 15:24:48 王永杰
     */
    public function orderInfo()
    {
        $member = new MemberService();
        $order = new OrderService();
        $goods_mansong = new GoodsMansong();
        $Config = new Config();
        $promotion = new Promotion();
        $shop_service = new Shop();
        // 检测购物车
        $order_tag = isset($_SESSION['order_tag']) ? $_SESSION['order_tag'] : '';
        if (empty($order_tag)) {
            $this->redirect(__URL__); // 没有商品返回到首页
        } else {
            switch ($order_tag) {
                // 立即购买
                case "buy_now":
                    $res = $this->buyNowSession();
                    $goods_sku_list = $res["goods_sku_list"];
                    $list = $res["list"];
                    break;
                case "cart":
                    // 加入购物车
                    $res = $this->addShoppingCartSession();
                    $goods_sku_list = $res["goods_sku_list"];
                    $list = $res["list"];
                    break;
            }
        }
        $this->assign('goods_sku_list', $goods_sku_list);
        
        $address = $member->getDefaultExpressAddress(); // 获取默认收货地址
        $express = 0;
        
        $express_company_list = array();
        $goods_express_service = new GoodsExpressService();
        if (! empty($address)) {
            // 物流公司
            $express_company_list = $goods_express_service->getExpressCompany($this->instance_id, $goods_sku_list, $address['province'], $address['city']);
            if (! empty($express_company_list)) {
                foreach ($express_company_list as $v) {
                    $express = $v['express_fee']; // 取第一个运费，初始化加载运费
                    break;
                }
            }
            $this->assign("address_is_have", 1);
        }else{
            $this->assign("address_is_have", 0);
        }
        $count = $goods_express_service->getExpressCompanyCount($this->instance_id);
        $this->assign("express_company_count", $count); // 物流公司数量
        $this->assign("express", sprintf("%.2f", $express)); // 运费
        $this->assign("express_company_list", $express_company_list); // 物流公司
        
        $discount_money = $goods_mansong->getGoodsMansongMoney($goods_sku_list);
        $this->assign("discount_money", sprintf("%.2f", $discount_money)); // 总优惠
        
        $count_money = $order->getGoodsSkuListPrice($goods_sku_list);
        $this->assign("count_money", sprintf("%.2f", $count_money)); // 商品金额
        $pick_up_money = $order->getPickupMoney($count_money);
        $this->assign("pick_up_money", $pick_up_money);
        $count_point_exchange = 0;
        foreach ($list as $k => $v) {
            $list[$k]['price'] = sprintf("%.2f", $list[$k]['price']);
            $list[$k]['subtotal'] = sprintf("%.2f", $list[$k]['price'] * $list[$k]['num']);
            if ($v["point_exchange_type"] == 1) {
                if ($v["point_exchange"] > 0) {
                    $count_point_exchange += $v["point_exchange"] * $v["num"];
                }
            }
        }
        $this->assign("count_point_exchange", $count_point_exchange); // 总积分
        $this->assign("itemlist", $list);
        
        $shop_id = $this->instance_id;
        $shop_config = $Config->getShopConfig($shop_id);
        $order_invoice_content = explode(",", $shop_config['order_invoice_content']);
        $shop_config['order_invoice_content_list'] = array();
        foreach ($order_invoice_content as $v) {
            if (! empty($v)) {
                array_push($shop_config['order_invoice_content_list'], $v);
            }
        }
        $this->assign("shop_config", $shop_config); // 后台配置
        
        $member_account = $member->getMemberAccount($this->uid, $this->instance_id);
        if ($member_account['balance'] == '' || $member_account['balance'] == 0) {
            $member_account['balance'] = '0.00';
        }
        $this->assign("member_account", $member_account); // 用户余额
        
        $coupon_list = $order->getMemberCouponList($goods_sku_list);
        $this->assign("coupon_list", $coupon_list); // 获取优惠券
        
        $promotion_full_mail = $promotion->getPromotionFullMail($this->instance_id);
        if(! empty($address))
        {
            $no_mail = checkIdIsinIdArr($address['city'], $promotion_full_mail['no_mail_city_id_array']);
            if($no_mail)
            {
                $promotion_full_mail['is_open'] = 0;
            }
        }
        $this->assign("promotion_full_mail", $promotion_full_mail); // 满额包邮
        
        $pickup_point_list = $shop_service->getPickupPointList();
        $this->assign("pickup_point_list", $pickup_point_list); // 自提地址列表
        
        $this->assign("address_default", $address);
    }

    /**
     * 加入购物车
     *
     * @return unknown
     */
    public function addShoppingCartSession()
    {
        // 加入购物车
        $cart_list = isset($_SESSION["cart_list"]) ? $_SESSION["cart_list"] : ""; // 用户所选择的商品
        $cart_id = implode(",", $cart_list);
        if ($cart_id == "") {
            $this->redirect(__URL__); // 没有商品返回到首页
        }
        
        $cart_id_arr = explode(",", $cart_id);
        $goods = new Goods();
        $cart_list = $goods->getCartList($cart_id);
        if (count($cart_list) == 0) {
            $this->redirect(__URL__); // 没有商品返回到首页
        }
        $list = Array();
        $str_cart_id = ""; // 购物车id
        $goods_sku_list = ''; // 商品skuid集合
        for ($i = 0; $i < count($cart_list); $i ++) {
            if ($cart_id_arr[$i] == $cart_list[$i]["cart_id"]) {
                $list[] = $cart_list[$i];
                $str_cart_id .= "," . $cart_list[$i]["cart_id"];
                $goods_sku_list .= "," . $cart_list[$i]['sku_id'] . ':' . $cart_list[$i]['num'];
            }
        }
        $goods_sku_list = substr($goods_sku_list, 1); // 商品sku列表
        $res["list"] = $list;
        $res["goods_sku_list"] = $goods_sku_list;
        return $res;
    }

    /**
     * 立即购买
     */
    public function buyNowSession()
    {
        $order_sku_list = isset($_SESSION["order_sku_list"]) ? $_SESSION["order_sku_list"] : "";
        if (empty($order_sku_list)) {
            $this->redirect(__URL__); // 没有商品返回到首页
        }
        
        $cart_list = array();
        $order_sku_list = explode(":", $_SESSION["order_sku_list"]);
        $sku_id = $order_sku_list[0];
        $num = $order_sku_list[1];
        
        // 获取商品sku信息
        $goods_sku = new \data\model\NsGoodsSkuModel();
        $sku_info = $goods_sku->getInfo([
            'sku_id' => $sku_id
        ], '*');
        
        // 清除非法错误数据
        $cart = new NsCartModel();
        if (empty($sku_info)) {
            $cart->destroy([
                'buyer_id' => $this->uid,
                'sku_id' => $sku_id
            ]);
            $this->redirect(__URL__); // 没有商品返回到首页
        }
        $goods = new NsGoodsModel();
        $goods_info = $goods->getInfo([
            'goods_id' => $sku_info["goods_id"]
        ], 'max_buy,state,point_exchange_type,point_exchange,picture,goods_id,goods_name');
        
        $cart_list["stock"] = $sku_info['stock']; // 库存
        $cart_list["sku_id"] = $sku_info["sku_id"];
        $cart_list["sku_name"] = $sku_info["sku_name"];
        
        $goods_preference = new GoodsPreference();
        $member_price = $goods_preference->getGoodsSkuMemberPrice($sku_info['sku_id'], $this->uid);
        $cart_list["price"] = $member_price < $sku_info['promote_price'] ? $member_price : $sku_info['promote_price'];
        
        $cart_list["goods_id"] = $goods_info["goods_id"];
        $cart_list["goods_name"] = $goods_info["goods_name"];
        $cart_list["max_buy"] = $goods_info['max_buy']; // 限购数量
        $cart_list['point_exchange_type'] = $goods_info['point_exchange_type']; // 积分兑换类型 0 非积分兑换 1 只能积分兑换
        $cart_list['point_exchange'] = $goods_info['point_exchange']; // 积分兑换
        if ($goods_info['state'] != 1) {
            $this->redirect(__URL__); // 商品状态 0下架，1正常，10违规（禁售）
        }
        $cart_list["num"] = $num;
        // 如果购买的数量超过限购，则取限购数量
        if ($goods_info['max_buy'] != 0 && $goods_info['max_buy'] < $num) {
            $num = $goods_info['max_buy'];
        }
        // 如果购买的数量超过库存，则取库存数量
        if ($sku_info['stock'] < $num) {
            $num = $sku_info['stock'];
        }
        // 获取图片信息
        $picture = new AlbumPictureModel();
        $picture_info = $picture->get($goods_info['picture']);
        $cart_list['picture_info'] = $picture_info;
        
        if (count($cart_list) == 0) {
            $this->redirect(__URL__); // 没有商品返回到首页
        }
        $list[] = $cart_list;
        $goods_sku_list = $sku_id . ":" . $num; // 商品skuid集合
        $res["list"] = $list;
        $res["goods_sku_list"] = $goods_sku_list;
        return $res;
    }

    /**
     * 订单数据存session
     *
     * @return number
     */
    public function orderCreateSession()
    {
        $tag = isset($_POST['tag']) ? $_POST['tag'] : '';
        if (empty($tag)) {
            return - 1;
        }
        if ($tag == 'cart') {
            $_SESSION['order_tag'] = 'cart';
            $_SESSION['cart_list'] = $_POST['cart_id'];
        }
        if ($tag == 'buy_now') {
            $_SESSION['order_tag'] = 'buy_now';
            $_SESSION['order_sku_list'] = $_POST['sku_id'] . ':' . $_POST['num'];
        }
        return 1;
    }

    /**
     * 创建订单
     */
    public function orderCreate()
    {
        $order = new OrderService();
        // 获取支付编号
        $out_trade_no = $order->getOrderTradeNo();
        $use_coupon = request()->post('use_coupon', 0); // 优惠券
        $integral = request()->post('integral', 0); // 积分
        $goods_sku_list = request()->post('goods_sku_list', ''); // 商品列表
        $leavemessage = request()->post('leavemessage', ''); // 留言
        $user_money = request()->post("account_balance", 0); // 使用余额
        $pay_type = request()->post("pay_type", 1); // 支付方式
        $buyer_invoice = request()->post("buyer_invoice", ""); // 发票
        $pick_up_id = request()->post("pick_up_id", 0); // 自提点
        $shipping_company_id = request()->post("shipping_company_id", 0); // 物流公司
        
        $shipping_type = 1; // 配送方式，1：物流，2：自提
        if ($pick_up_id != 0) {
            $shipping_type = 2;
        }
        $member = new Member();
        $address = $member->getDefaultExpressAddress();
        $shipping_time = date("Y-m-d H::i:s", time());
        $order_id = $order->orderCreate('1', $out_trade_no, $pay_type, $shipping_type, '1', 1, $leavemessage, $buyer_invoice, $shipping_time, $address['mobile'], $address['province'], $address['city'], $address['district'], $address['address'], $address['zip_code'], $address['consigner'], $integral, $use_coupon, 0, $goods_sku_list, $user_money, $pick_up_id, $shipping_company_id);
        if ($order_id > 0) {
            $order->deleteCart($goods_sku_list, $this->uid);
            $_SESSION['order_tag'] = ""; // 生成订单后，清除购物车
            return AjaxReturn($out_trade_no);
        } else {
            return AjaxReturn($order_id);
        }
    }

    /**
     * 获取当前会员的订单列表
     */
    public function myOrderList()
    {
        $status = isset($_GET['status']) ? $_GET['status'] : 'all';
        if (request()->isAjax()) {
            $status = isset($_POST['status']) ? $_POST['status'] : 'all';
            $condition['buyer_id'] = $this->uid;
            
            if (! empty($this->shop_id)) {
                $condition['shop_id'] = $this->shop_id;
            }
            
            if ($status != 'all') {
                switch ($status) {
                    case 0:
                        $condition['order_status'] = 0;
                        break;
                    case 1:
                        $condition['order_status'] = 1;
                        break;
                    case 2:
                        $condition['order_status'] = 2;
                        break;
                    case 3:
                        $condition['order_status'] = 3;
                        break;
                    case 4:
                        $condition['order_status'] = array(
                            'in',
                            [
                                - 1,
                                - 2,
                                4
                            ]
                        );
                        break;
                }
            }
            // 还要考虑状态逻辑
            
            $order = new OrderService();
            $order_list = $order->getOrderList(1, 0, $condition, 'create_time desc');
            return $order_list['data'];
        } else {
            $this->assign("status", $status);
            return view($this->style . '/Order/myOrderList');
        }
    }

    /**
     * 订单详情
     *
     * @return Ambigous <\think\response\View, \think\response\$this, \think\response\View>
     */
    public function orderDetail()
    {
        $order_id = isset($_GET['orderId']) ? $_GET['orderId'] : 0;
        if ($order_id == 0) {
            $this->error("没有获取到订单信息");
        }
        $order_service = new OrderService();
        $detail = $order_service->getOrderDetail($order_id);
        
        if (empty($detail)) {
            $this->error("没有获取到订单信息");
        }
        
        $count = 0; // 计算包裹数量（不包括无需物流）
        $express_count = count($detail['goods_packet_list']);
        $express_name = "";
        $express_code = "";
        if ($express_count) {
            foreach ($detail['goods_packet_list'] as $v) {
                if ($v['is_express']) {
                    $count ++;
                    if (! $express_name) {
                        $express_name = $v['express_name'];
                        $express_code = $v['express_code'];
                    }
                }
            }
            $this->assign('express_name', $express_name);
            $this->assign('express_code', $express_code);
        }
        $this->assign('express_count', $express_count);
        $this->assign('is_show_express_code', $count); // 是否显示运单号（无需物流不显示）
        
        $this->assign("order", $detail);
        return view($this->style . '/Order/orderDetail');
    }

    /**
     * 物流详情页
     */
    public function orderExpress()
    {
        $order_id = isset($_GET['orderId']) ? $_GET['orderId'] : 0;
        if ($order_id == 0) {
            $this->error("没有获取到订单信息");
        }
        $order_service = new OrderService();
        $detail = $order_service->getOrderDetail($order_id);
        if (empty($detail)) {
            $this->error("没有获取到订单信息");
        }
        // 获取物流跟踪信息
        $order_service = new OrderService();
        $this->assign("order", $detail);
        return view($this->style . '/Order/orderExpress');
    }

    /**
     * 查询包裹物流信息
     * 2017年6月24日 10:42:34 王永杰
     */
    public function getOrderGoodsExpressMessage()
    {
        $express_id = request()->post("express_id", 0); // 物流包裹id
        $res = - 1;
        if ($express_id) {
            $order_service = new OrderService();
            $res = $order_service->getOrderGoodsExpressMessage($express_id);
        }
        return $res;
    }

    /**
     * 订单项退款详情
     */
    public function refundDetail()
    {
        $order_goods_id = isset($_GET['order_goods_id']) ? $_GET['order_goods_id'] : 0;
        if ($order_goods_id == 0) {
            $this->error("没有获取到退款信息");
        }
        $order_service = new OrderService();
        $detail = $order_service->getOrderGoodsRefundInfo($order_goods_id);
        $this->assign("order_refund", $detail);
        $refund_money = $order_service->orderGoodsRefundMoney($order_goods_id);
        $this->assign('refund_money', $refund_money);
        $this->assign("detail", $detail);
        // 查询店铺默认物流地址
        $express = new Express();
        $address = $express->getDefaultShopExpressAddress($this->instance_id);
        //查询商家地址
        $shop_info = $order_service->getShopReturnSet($this->instance_id);
        $this->assign("shop_info",$shop_info);
        $this->assign("address_info", $address);
        return view($this->style . '/Order/refundDetail');
    }

    /**
     * 申请退款
     */
    public function orderGoodsRefundAskfor()
    {
        $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : 0;
        $order_goods_id = isset($_POST['order_goods_id']) ? $_POST['order_goods_id'] : 0;
        $refund_type = isset($_POST['refund_type']) ? $_POST['refund_type'] : 1;
        $refund_require_money = isset($_POST['refund_require_money']) ? $_POST['refund_require_money'] : 0;
        $refund_reason = isset($_POST['refund_reason']) ? $_POST['refund_reason'] : '';
        $order_service = new OrderService();
        $retval = $order_service->orderGoodsRefundAskfor($order_id, $order_goods_id, $refund_type, $refund_require_money, $refund_reason);
        return AjaxReturn($retval);
    }

    /**
     * 买家退货
     *
     * @return Ambigous <multitype:unknown, multitype:unknown unknown string >
     */
    public function orderGoodsRefundExpress()
    {
        $order_id = isset($_POST['order_id']) ? $_POST['order_id'] : 0;
        $order_goods_id = isset($_POST['order_goods_id']) ? $_POST['order_goods_id'] : 0;
        $refund_express_company = isset($_POST['refund_express_company']) ? $_POST['refund_express_company'] : '';
        $refund_shipping_no = isset($_POST['refund_shipping_no']) ? $_POST['refund_shipping_no'] : 0;
        $refund_reason = isset($_POST['refund_reason']) ? $_POST['refund_reason'] : '';
        $order_service = new OrderService();
        $retval = $order_service->orderGoodsReturnGoods($order_id, $order_goods_id, $refund_express_company, $refund_shipping_no);
        return AjaxReturn($retval);
    }

    /**
     * 交易关闭
     */
    public function orderClose()
    {
        $order_service = new OrderService();
        $order_id = $_POST['order_id'];
        $res = $order_service->orderClose($order_id);
        return AjaxReturn($res);
    }

    /**
     * 订单后期支付页面
     */
    public function orderPay()
    {
        $order_id = isset($_GET['id']) ? $_GET['id'] : 0;
        $out_trade_no = isset($_GET['out_trade_no']) ? $_GET['out_trade_no'] : 0;
        $order_service = new OrderService();
        if ($order_id != 0) {
            // 更新支付流水号
            $new_out_trade_no = $order_service->getOrderNewOutTradeNo($order_id);
            $url = 'http://' . $_SERVER['HTTP_HOST'] . \think\Request::instance()->root() . '/wap/pay/getpayvalue?out_trade_no=' . $new_out_trade_no;
            header("Location: " . $url);
            exit();
        } else {
            // 待结算订单处理
            if ($out_trade_no != 0) {
                $url = 'http://' . $_SERVER['HTTP_HOST'] . \think\Request::instance()->root() . '/wap/pay/getpayvalue?out_trade_no=' . $out_trade_no;
                exit();
            } else {
                $this->error("没有获取到支付信息");
            }
        }
    }

    /**
     * 收货
     */
    public function orderTakeDelivery()
    {
        $order_service = new OrderService();
        $order_id = $_POST['order_id'];
        $res = $order_service->OrderTakeDelivery($order_id);
        return AjaxReturn($res);
    }
}
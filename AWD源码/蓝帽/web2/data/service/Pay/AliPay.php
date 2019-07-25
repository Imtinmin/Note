<?php
/**
 * AliPay.php
 *
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
namespace data\service\Pay;
use data\service\Pay\PayParam;
use data\extend\alipay\AlipaySubmit as AlipaySubmit;
use data\extend\alipay\AlipayNotify as AlipayNotify;
/**
 * 功能说明：自定义支付宝支付接入类(应用于商户立即转账create_direct_pay_by_user)
 */

class AliPay extends PayParam{
    function __construct(){
        parent::__construct();
    }

    public function index(){
        //防止默认目录错误
    }
    /**
     * 支付宝基本设置
     * @return unknown
     */
    public function getAlipayConfig(){
         //合作身份者id，以2088开头的16位纯数字
        $alipay_config['partner'] = $this->ali_partnerid;
    
        //收款支付宝账号
        $alipay_config['seller_email']  = $this->ali_seller;
    
        //安全检验码，以数字和字母组成的32位字符
        $alipay_config['key']                   = $this->ali_key; 
        //签名方式 不需修改
        $alipay_config['sign_type']    = strtoupper('MD5');
    
        //字符编码格式 目前支持 gbk 或 utf-8
        $alipay_config['input_charset']= strtolower('utf-8');
    
        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['cacert']    = getcwd().'\\cacert.pem';
    
        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        $alipay_config['transport']    = 'http';
        return $alipay_config;
    }
    /**
     * 设置支付宝支付传入参数
     * @param unknown $orderNumber
     * @param unknown $body
     * @param unknown $detail
     * @param unknown $total_fee
     * @param unknown $payment_type
     * @param unknown $notify_url
     * @param unknown $return_url
     * @param unknown $show_ur
     * @return unknown
     */
    public function setAliPay($orderNumber, $body, $detail, $total_fee, $payment_type, $notify_url, $return_url, $show_url){
      
        $alipay_config = $this->getAlipayConfig();
        /**************************请求参数**************************/
        
        
        //支付类型
        $payment_type = $payment_type;
        //必填，不能修改
        //服务器异步通知页面路径
        $notify_url = $notify_url;
        //需http://格式的完整路径，不能加?id=123这类自定义参数
        
        //页面跳转同步通知页面路径
        $return_url = $return_url;
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        
        //商户订单号
        $out_trade_no = $orderNumber;
        //商户网站订单系统中唯一订单号，必填
        
        //订单名称
        $subject = $body;
        //必填
        
        //付款金额
        $total_fee = $total_fee;
        //必填
        
        //订单描述
        //$body = $body;
        //商品展示地址
        $show_url = $show_url;
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html
        
        //防钓鱼时间戳-安全
        $anti_phishing_key = "";
        //若要使用请调用类文件submit中的query_timestamp函数
        
        //客户端的IP地址-
        $exter_invoke_ip = "";
        //非局域网的外网IP地址，如：221.0.0.1
        
        
        /************************************************************/
        
        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => "create_direct_pay_by_user",
            "partner" => trim($alipay_config['partner']),
            "seller_email" => trim($alipay_config['seller_email']),
            "payment_type"  => $payment_type,
            "notify_url"    => $notify_url,
            "return_url"    => $return_url,
            "out_trade_no"  => $out_trade_no,
            "subject"   => $subject,
            "total_fee" => $total_fee,
            "body"  => $body,
            "show_url"  => $show_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip"   => $exter_invoke_ip,
            "_input_charset"    => trim(strtolower($alipay_config['input_charset']))
        );
        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        
        $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
        //echo $html_text;
        return $html_text;
    }
    /**
     * 获取配置参数是否正确
     * @return unknown
     */
    public function getVerifyResult($type){
        $alipay_config = $this->getAlipayConfig();
        $alipayNotify = new AlipayNotify($alipay_config);
        if($type == 'return')
        {
            $verify_result = $alipayNotify->verifyReturn();
        }else{
            $verify_result = $alipayNotify->verifyNotify();
        }
       
        return $verify_result;
    }
   
    
}
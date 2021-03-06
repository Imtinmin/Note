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
namespace app\api\controller;
use data\service\niushop\Pay\WeiXinPay;
/**
 * 后台主界面
 * 
 * @author Administrator
 *        
 */
class Pay extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //获取信息
        $out_trade_no = !empty($_POST['out_trade_no'])? $_POST['out_trade_no']:'';
        $weixin_pay = new WeiXinPay();
        //随机字符串
        $res['string'] = $weixin_pay->getNonceStr();
        $res['time'] = time();
        //dump($res);
        //返回信息
        if($res){
            return $this->outMessage('niu_index_response', $res);
        }else{
            return $this->outMessage('niu_index_response', $res, -50, '失败！');
        }
        
    }   
}

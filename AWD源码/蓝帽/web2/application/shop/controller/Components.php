<?php
/**
 * Components.php
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
namespace app\shop\controller;

use data\extend\Send;
use data\extend\ThinkOauth as ThinkOauth;
use data\service\Member as MemberService;
use data\service\Platform;
use data\service\Config as Config;
use think\Session;

/**
 * 组件控制器
 * 创建时间：2017年2月7日 11:01:19
 */
class Components extends BaseController
{
    // 验证码配置
    public $login_verify_code;
    //通知配置
    public $notice;
    
    public function __construct(){
        parent::__construct();
        // 是否开启验证码
        $instance_id = 0;
        $web_config = new Config();
        $this->login_verify_code = $web_config->getLoginVerifyCodeConfig($instance_id);
        //是否开启通知
        $noticeMobile = $web_config -> getNoticeMobileConfig($instance_id);
        $noticeEmail = $web_config -> getNoticeEmailConfig($instance_id);
        $this->notice['noticeEmail'] = $noticeEmail[0]['is_use'];
        $this->notice['noticeMobile'] = $noticeMobile[0]['is_use'];
        $this->assign("notice",$this->notice);
    }
    // 获取登录信息
    public function getLoginInfo()
    {
        $member_info = $this->user->getMemberDetail($this->instance_id); // 用户信息查询
        if (! empty($member_info['user_info']['user_headimg'])) {
            $member_info['member_img'] = $member_info['user_info']['user_headimg'];
        } elseif (! empty($member_info['user_info']['qq_openid'])) {
            $member_info['member_img'] = $member_info['user_info']['qq_info_array']['figureurl_qq_1'];
        } elseif (! empty($member_info['user_info']['wx_openid'])) {
            $member_info['member_img'] = '0';
        } elseif (! empty($member_info)) {
            $member_info['member_img'] = '0';
        }
        return $member_info;
    }

    /**
     * 功能：平台广告查询（）ap_id传入广告位
     * 创建人：李志伟
     * 时间：2017年2月10日9:33:21
     */
    public function platformAdvList()
    {
        $condition = '';
        $platform = new Platform();
        $ap_id = isset($_POST['ap_id']) ? $_POST['ap_id'] : '1051';
        $advdetail = $platform->getPlatformAdvPositionDetail($ap_id);
        if(empty($advdetail)) return '';
        if($advdetail['is_use'] == 0){
            return '';
        }
        $key = $ap_id . '_close';
        if (! empty($_COOKIE[$key])) {
            return '';
        } else
            return $advdetail['adv_list'];
    }
    /**
     * 功能：平台广告查询（）ap_id传入广告位，有宽高信息，以后都会用这个方法
     * 2017年7月10日 17:06:41 王永杰
     */
    public function platformAdvListNew()
    {
        $condition = '';
        $platform = new Platform();
        $ap_id = isset($_POST['ap_id']) ? $_POST['ap_id'] : '1051';
        $advdetail = $platform->getPlatformAdvPositionDetail($ap_id);
        if(empty($advdetail)) return '';
        if($advdetail['is_use'] == 0){
            return '';
        }
        $key = $ap_id . '_close';
        if (! empty($_COOKIE[$key])) {
            return '';
        } else
            return $advdetail;
    }

    /**
     * 功能：友情链接
     * 创建人：李志伟
     * 时间：2017年2月10日11:53:51
     * 
     * @return Ambigous <number, unknown>
     */
    public function linkList()
    {
        $platform = new Platform();
        $link_list = $platform->getLinkList(1, 0,["is_show"=>1], 'link_sort ASC');
        return $link_list['data'];
    }

    /**
     * 获取广告位
     * 
     * @return unknown|string
     */
    public function getPlatfromAdvPositionDetial()
    {
        $platform = new Platform();
        $ap_id = isset($_POST['ap_id']) ? $_POST['ap_id'] : '';
        if (! empty($ap_id)) {
            $data = $platform->getPlatformAdvPositionDetail($ap_id);
            return $data;
        } else {
            return '';
        }
    }

    /**
     * 收藏商品或者店铺
     */
    public function collectionGoodsOrShop()
    {
        $fav_id = isset($_POST["fav_id"]) ? $_POST["fav_id"] : '';
        $fav_type = isset($_POST["fav_type"]) ? $_POST["fav_type"] : '';
        $log_msg = isset($_POST["log_msg"]) ? $_POST["log_msg"] : '';
        $member = new MemberService();
        $result = $member->addMemberFavouites($fav_id, $fav_type, $log_msg);
        return AjaxReturn($result);
    }

    /**
     * 取消收藏 商品/店铺
     */
    public function cancelCollGoodsOrShop()
    {
        $fav_id = isset($_POST["fav_id"]) ? $_POST["fav_id"] : '';
        $fav_type = isset($_POST["fav_type"]) ? $_POST["fav_type"] : '';
        $member = new MemberService();
        $result = $member->deleteMemberFavorites($fav_id, $fav_type);
        return AjaxReturn($result);
    }

    /**
     * 上传图片
     * 
     * @return boolean
     */
    public function imgUpload()
    {
        $upFilePath = 'upload/evaluate/';
        $guid = time();
        $extend = explode(".", $_FILES["imgPhoto"]["name"]);
        $key = count($extend) - 1;
        $ext = "." . $extend[$key];
        $newfile = $guid . $ext;
        $size = $_FILES["imgPhoto"]["size"];
        $ext = $_FILES["imgPhoto"]["type"];
        if (substr($ext, - 3) == 'php') {
            echo "非法操作";
            return false;
        }
        if (! file_exists($upFilePath)) {
            $mode = intval('0777',8);
            mkdir($upFilePath,$mode,true);
        }
        $ok = move_uploaded_file($_FILES["imgPhoto"]["tmp_name"], $upFilePath . $newfile);
        /**
         * 存库并返回图片id
         */
        $img_path = $upFilePath . $newfile;
        @unlink($_FILES['imgPhoto']);
        return $img_path;
    }

    /**
     * 删除上传的图片
     */
    public function deleteImgUpload()
    {
        $imgsrc = $_POST['imgsrc'];
        $flag = @unlink($imgsrc);
        return $flag;
    }

    /**
     * 手机验证码发送
     * 
     * @return number
     */
    public function mobileVerificationCode()
    {
        $mobile= isset($_POST['mobile']) ? $_POST['mobile'] : '';
        $vertification = request()->post('vertification', '');
        $member = new MemberService();
        $is_bin_mobile = $member->memberIsMobile($mobile); // 判断手机号是否已被绑定
     /*   if ($is_bin_mobile) {
            return array(
                'code' => 0,
                'message' => '该手机号已被绑定'
            );
        } */
        
/*         $code = rand(100000, 999999);
        $time = '60秒';
        Session::set('mobileVerificationCode', $code);
        $sen = new Send();
        $result = $sen->sms([
            'param' => [
                'code' => (string) $code,
                'time' => $time
            ],
            'mobile' => $mobile,
            'template' => 'SMS_43210099'
        ]);
        if ($result !== true) {
            return AjaxReturn(0);
        }
        return array(
            'code' => 1,
            'time' => $time
        ); */
        if ($this->login_verify_code["value"]["pc"] == 1) {
            if (!captcha_check($vertification)) {
                $result = [
                    'code' => -1,
                    'message' => "验证码错误"
                ];
            }else if($is_bin_mobile){
                $result = [
                    'code' => -1,
                    'message' => '该手机号已被绑定'
                ];
                
            }else{
                $params['mobile']=$mobile;
                $params['shop_id'] = 0;
                $params["user_id"]=$this->uid;
                $result = runhook('Notify', 'bindMobile', $params);
                Session::set('mobileVerificationCode',$result['param']);
            }
            return $result;
        }else{
            if($is_bin_mobile){
                $result = [
                    'code' => -1,
                    'message' => '该手机号已被绑定'
                ];
            
            }else{
                $params['mobile']=$mobile;
                $params['shop_id'] = 0;
                $params["user_id"]=$this->uid;
                $result = runhook('Notify', 'bindMobile', $params);
                Session::set('mobileVerificationCode',$result['param']);
            }
            return $result;
        }
        
        
    }

    /**
     * 邮箱验证码发送
     */
    public function emailVerificationCode()
    {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $vertification = request()->post('vertification', '');
        $member = new MemberService();
        $is_bin_email = $member->memberIsEmail($email); // 判断邮箱是否已被绑定
    /*     if ($is_bin_email) {
            return array(
                'code' => 0,
                'message' => '该邮箱已被绑定'
            );
        }
        
        $code = rand(100000, 999999);
        Session::set('emailVerificationCode', $code);
        $sen = new Send();
        $sen->email($email, "{$this->shop_name}邮箱验证", '验证码为' . $code);
        return AjaxReturn(1);
         */
        if ($this->login_verify_code["value"]["pc"] == 1) {
            if (!captcha_check($vertification)) {
                $result = [
                    'code' => -1,
                    'message' => "验证码错误"
                ];
                 
            }else if($is_bin_email){
                $result = [
                    'code' => -1,
                    'message' => '该邮箱已被绑定'
                ];
            }else{
                $params['email']=$email;
                $params['shop_id'] = 0;
                $params["user_id"]=$this->uid;
                $result = runhook('Notify', 'bindEmail', $params);
                Session::set('emailVerificationCode',$result['param']);
            }
            return $result;
        }else{
            if($is_bin_email){
                $result = [
                    'code' => -1,
                    'message' => '该邮箱已被绑定'
                ];
            }else{
                $params['email']=$email;
                $params['shop_id'] = 0;
                $params["user_id"]=$this->uid;
                $result = runhook('Notify', 'bindEmail', $params);
                Session::set('emailVerificationCode',$result['param']);
            }
            return $result;
        }
    }

    /**
     * 随机验证码生成
     * 
     * @return string
     */
    public function random()
    {
        $len = 4;
        $srcstr = "1a2s3d4f5g6hj8k9qwertyupzxcvbnm";
        mt_srand();
        $strs = "";
        for ($i = 0; $i < $len; $i ++) {
            $strs .= $srcstr[mt_rand(0, 30)];
        }
        
        Session::set('randomCode', $strs);
        
        // 声明需要创建的图层的图片格式
        @ header("Content-Type:image/png");
        
        // 验证码图片的宽度
        $width = 80;
        // 验证码图片的高度
        $height = 35;
        // 创建一个图层
        $im = imagecreate($width, $height);
        // 背景色
        $back = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
        // 模糊点颜色
        $pix = imagecolorallocate($im, 187, 230, 247);
        // 字体色
        $font = imagecolorallocate($im, 41, 163, 238);
        // 绘模糊作用的点
        mt_srand();
        for ($i = 0; $i < 1000; $i ++) {
            imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $pix);
        }
        // 输出字符
        imagestring($im, 10, 15, 10, $strs, $font);
        
        // 输出矩形
        imagerectangle($im, 0, 0, $width - 1, $height - 1, $font);
        // 输出图片
        imagepng($im);
        
        imagedestroy($im);
        
        $strs = md5($strs);
        
        return $strs;
    }
}
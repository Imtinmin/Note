<?php
/**
 * Login.php
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

use data\extend\ThinkOauth as ThinkOauth;
use data\service\Member as Member;
use data\service\Config as Config;
use data\service\WebSite as WebSite;
use think\Controller;
use think\Session;
\think\Loader::addNamespace('data', 'data/');

/**
 * 登录控制器
 * 创建人：李吉
 * 创建时间：2017-02-06 10:59:23
 */
class Login extends Controller
{
    // 验证码配置
    public $login_verify_code;
    // 通知配置
    public $notice;

    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    public function _empty($name)
    {}

    public function init()
    {
        $this->user = new Member();
        $this->web_site = new WebSite();
        $web_info = $this->web_site->getWebSiteInfo();
        if ($web_info['web_status'] == 2) {
            webClose($web_info['close_reason']);
        }
        $this->assign("platform_shopname", $this->user->getInstanceName());
        $this->assign("title", $web_info['title']);
        if (request()->isMobile()) {
                   $redirect = __URL(__URL__.'/wap');
                $this->redirect($redirect);
        }
        switch ($web_info['style_id_pc']) {
            case 1:
                $this->style = STYLE_DEFAULT_PC . "/";
                $this->assign("style", STYLE_DEFAULT_PC);
                break;
            case 2:
                $this->style = STYLE_BLUE_PC . "/";
                $this->assign("style", STYLE_BLUE_PC);
                break;
            default:
                $this->style = STYLE_BLUE_PC . "/";
                $this->assign("style", STYLE_BLUE_PC);
                break;
        }
        
        // 是否开启qq跟微信
        $tencent = new Config();
        $instance_id = 0;
        $qq_info = $tencent->getQQConfig($instance_id);
        $Wchat_info = $tencent->getWchatConfig($instance_id);
        $this->assign("qq_info", $qq_info);
        $this->assign("Wchat_info", $Wchat_info);
        // 是否开启验证码
        $web_config = new Config();
        $this->login_verify_code = $web_config->getLoginVerifyCodeConfig($instance_id);
        $this->assign("login_verify_code", $this->login_verify_code["value"]);
        // 是否开启通知
        $noticeMobile = $web_config->getNoticeMobileConfig($instance_id);
        $noticeEmail = $web_config->getNoticeEmailConfig($instance_id);
        $this->notice['noticeEmail'] = $noticeEmail[0]['is_use'];
        $this->notice['noticeMobile'] = $noticeMobile[0]['is_use'];
        $this->assign("notice", $this->notice);
        
        // 配置头部
        $Config = new Config();
        $seoconfig = $Config->getSeoConfig($instance_id);
        $this->assign("seoconfig", $seoconfig);
    }

    public function index()
    {
        if ($_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->login_verify_code["value"]["pc"] == 1) {
                $vertification = $_POST['vertification'];
                if (! captcha_check($vertification)) {
                    $retval = [
                        'code' => 0,
                        'message' => "验证码错误"
                    ];
                    return $retval;
                }
            }
            $res = $this->user->login($username, $password);
            if ($res == 1) {
                if (! empty($_SESSION['login_pre_url'])) {
                    $retval = [
                        'code' => 1,
                        'url' => $_SESSION['login_pre_url']
                    ];
                } else {
                    $retval = [
                        'code' => 2,
                        'url' => 'index/index'
                    ];
                }
            } else {
                $retval = AjaxReturn($res);
            }
            return $retval;
        }
        
        
        // 点击商品详情没有登录首先要获取上一页
        $pre_url = '';
        $bund_pre_url = $_SESSION['login_pre_url'];
        if(empty($bund_pre_url)){
            if (! empty($_SERVER['HTTP_REFERER'])) {
                $pre_url = $_SERVER['HTTP_REFERER'];
                if (strpos($pre_url, 'login')) {
                    $pre_url = '';
                }
                $_SESSION['login_pre_url'] = $pre_url;
            }
        }
        
        // 获取商场logo
        $website = new WebSite();
        $web_info = $website->getWebSiteInfo();
        
        $tencent = new Config();
        $instance_id = 0;
        $qq_info = $tencent->getQQConfig($instance_id);
        $Wchat_info = $tencent->getWchatConfig($instance_id);
        $this->assign("qq_info", $qq_info);
        $this->assign("Wchat_info", $Wchat_info);
        $this->assign("web_info", $web_info);
        return view($this->style . 'Login/login');
    }

    /*
     * 吴奇
     * 首页登录
     * 2017/3/7 9:55
     */
    public function login()
    {
        $tencent = new Config();
        $instance_id = 0;
        $qq_info = $tencent->getQQConfig($instance_id);
        $Wchat_info = $tencent->getWchatConfig($instance_id);
        $this->assign("qq_info", $qq_info);
        $this->assign("Wchat_info", $Wchat_info);
        
        $username = $_POST['userName'];
        $password = $_POST['password'];
        if ($this->login_verify_code["value"]["pc"] == 1) {
            $vertification = $_POST['vertification'];
            if (! captcha_check($vertification)) {
                
                $retval = [
                    'code' => 0,
                    'message' => "验证码错误"
                ];
                return $retval;
            }
        }
        $res = $this->user->login($username, $password);
        if ($res == 1) {
            if (! empty($_SESSION['login_pre_url'])) {
                $retval = [
                    'code' => 1,
                    'url' => $_SESSION['login_pre_url']
                ];
            } else {
                $retval = [
                    'code' => 2,
                    'url' => 'index/index'
                ];
            }
        } else {
            $retval = AjaxReturn($res);
        }
        return $retval;
    }

    /*
     * 吴奇
     * 2017/2/8 14:30
     * 以下两个分别为注册页面
     */
    public function mobile()
    {
        if (request()->isAjax()) {
            // 获取数据库中的用户列表
            $user_mobile = $_GET['mobile'];
            $exist = false;
            $user_list = $this->user->getMemberList();
            foreach ($user_list["data"] as $user_list2) {
                if ($user_list2["user_tel"] == $user_mobile) {
                    $exist = true;
                }
            }
            return $exist;
        }
        if ($_POST) {
            $member = new Member();
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $email = '';
            $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
            $user_name = '';
            if ($this->notice['noticeMobile'] == 1) {
                $mobile_code = isset($_POST['mobile_code']) ? $_POST['mobile_code'] : '';
                $verification_code = Session::get('mobileVerificationCode');
                if ($mobile_code == $verification_code && ! empty($verification_code)) {
                    $retval = $member->registerMember($user_name, $password, $email, $mobile, '', '', '', '', '');
                    $result = true;
                } else {
                    $retval = "";
                    $result = false;
                }
            } else {
                $retval = $member->registerMember($user_name, $password, $email, $mobile, '', '', '', '', '');
                $result = true;
            }
            
            if ($retval > 0 && $result) {
                if (! empty($_SESSION['login_pre_url'])) {
                    $retval = [
                        'code' => 1,
                        'url' => $_SESSION['login_pre_url']
                    ];
                } else {
                    $retval = [
                        'code' => 2,
                        'url' => 'index/index'
                    ];
                }
                $this->success("注册成功", __URL__ . "/index");
            } else {
                $error_array = AjaxReturn($retval);
                $message = $error_array["message"];
                $this->error($message, __URL__ . "/login/mobile");
            }
        }
        // 获取商场logo
        $website = new WebSite();
        $web_info = $website->getWebSiteInfo();
        
        $config = new Config();
        $instanceid = 0;
        // 验证注册配置
        $this->verifyRegConfig("mobile");
        $phone_info = $config->getMobileMessage($instanceid);
        $this->assign("phone_info", $phone_info);
        $notice_templa_info = $config->getNoticeTemplateOneDetail($instanceid, 'sms', 'register_validate');
        if (! empty($notice_templa_info)) {
            $is_enable = $notice_templa_info['is_enable'];
        } else {
            $is_enable = 0;
        }
        $email_info = $config->getEmailMessage($instanceid);
        $this->assign("email_info", $email_info);
        $this->assign("web_info", $web_info);
        $this->assign("is_enable", $is_enable);
        return view($this->style . "/Login/mobile");
    }

    /**
     * 发送注册短信验证码
     *
     * @return boolean
     */
    public function sendSmsRegisterCode()
    {
        $params['mobile'] = request()->post('mobile', '');
        $vertification = request()->post('vertification', '');
        if ($this->login_verify_code["value"]["pc"] == 1) {
            if (! captcha_check($vertification)) {
                $result = [
                    'code' => - 1,
                    'message' => "验证码错误"
                ];
            } else {
                $params['shop_id'] = 0;
                $result = runhook('Notify', 'registBefor', $params);
                Session::set('mobileVerificationCode', $result['param']);
            }
        } else {
            $params['shop_id'] = 0;
            $result = runhook('Notify', 'registBefor', $params);
            Session::set('mobileVerificationCode', $result['param']);
        }
        
        return $result;
    }

    /**
     * 发送邮箱验证码
     */
    public function sendEmailCode()
    {
        $params['email'] = request()->post('email', '');
        $vertification = request()->post('vertification', '');
        // if ($this->login_verify_code["value"]["pc"] == 1) {
        // if (! captcha_check($vertification)) {
        // $result = [
        // 'code' => -1,
        // 'message' => "验证码错误"
        // ];
        
        // }else{
        // $params['shop_id'] = 0;
        // $result = runhook('Notify', 'registEmailValidation', $params);
        // Session::set('emailVerificationCode',$result['param']);
        // }
        // }else{
        $params['shop_id'] = 0;
        $result = runhook('Notify', 'registEmailValidation', $params);
        Session::set('emailVerificationCode', $result['param']);
        // }
        
        return $result;
    }

    /**
     * 注册手机号验证码验证
     * 任鹏强
     * 2017年6月17日16:26:46
     *
     * @return multitype:number string
     */
    public function register_check_code()
    {
        $send_param = isset($_POST['send_param']) ? $_POST['send_param'] : '';
        $param = session::get('mobileVerificationCode');
        
        if ($send_param == $param && $send_param != '') {
            $retval = [
                'code' => 0,
                'message' => "验证码一致"
            ];
        } else {
            $retval = [
                'code' => 1,
                'message' => "验证码不一致"
            ];
        }
        return $retval;
    }

    public function email()
    {
        if (request()->isAjax()) {
            // 获取数据库中的用户列表
            $user_email = $_GET['email'];
            $exist = false;
            $user_list = $this->user->getMemberList();
            foreach ($user_list["data"] as $user_list2) {
                if ($user_list2["user_email"] == $user_email) {
                    $exist = true;
                }
            }
            return $exist;
        }
        if ($_POST) {
            $min = 1;
            $max = 1000000000;
            $member = new Member();
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $mobile = '';
            $user_name = '';
            $uid = $this->user->getSessionUid();
            $email_code = isset($_POST['email_code']) ? $_POST['email_code'] : '';
            $verification_code = Session::get('emailVerificationCode');
            // 判断邮箱是否开启
            if ($this->notice['noticeEmail'] == 1) {
                // var_dump($verification_code.'++++'.$email_code);
                // exit();
                // 开启的话进行验证
                if ($email_code == $verification_code && ! empty($verification_code)) {
                    $retval = $member->registerMember($user_name, $password, $email, $mobile, '', '', '', '', '');
                    $result = true;
                } else {
                    $retval = "";
                    $result = false;
                }
            } else {
                // 未开启直接进行注册
                $retval = $member->registerMember($user_name, $password, $email, $mobile, '', '', '', '', '');
                $result = true;
            }
            if ($retval > 0) {
                $this->success("注册成功", __URL__ . "/index");
            } else {
                $error_array = AjaxReturn($retval);
                $message = $error_array["message"];
                $this->error($message, __URL__ . "/login/email");
            }
        }
        // 获取商场logo
        $website = new WebSite();
        $web_info = $website->getWebSiteInfo();
        $instanceid = 0;
        $config = new Config();
        // 验证注册配置
        $this->verifyRegConfig("email");
        
        $phone_info = $config->getMobileMessage($instanceid);
        $this->assign("phone_info", $phone_info);
        $email_info = $config->getEmailMessage($instanceid);
        $this->assign("email_info", $email_info);
        
        $this->assign("web_info", $web_info);
        return view($this->style . "Login/email");
    }

    public function register()
    {
        if (request()->isAjax()) {
            // 获取数据库中的用户列表
            $username = $_GET['username'];
            $exist = false;
            $user_list = $this->user->getMemberList();
            foreach ($user_list["data"] as $user_list2) {
                if ($user_list2["user_name"] == $username) {
                    $exist = true;
                }
            }
            return $exist;
        }
        if ($_POST) {
            $min = 10000000000;
            $max = 19999999999;
            $member = new Member();
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            // $email = rand($min, $max) . '@qq.com';
            // $mobile = rand($min, $max);
            $user_name = isset($_POST["username"]) ? $_POST["username"] : '';
            
            $retval = $member->registerMember($user_name, $password, '', '', '', '', '', '', '');
            
            if ($retval > 0) {
                // $this->success("注册成功", __URL__."/index");
                       $redirect = __URL(__URL__.'/index');
                       $this->redirect($redirect);
            } else {
                $error_array = AjaxReturn($retval);
                $message = $error_array["message"];
                $redirect = __URL(__URL__.'/login/register');
                $this->error($message, $redirect);
                // return AjaxReturn($retval);
            }
        }
        $instanceid = 0;
        $config = new Config();
        // 验证注册配置
        $this->verifyRegConfig("plain");
        $website = new WebSite();
        $web_info = $website->getWebSiteInfo();
        $phone_info = $config->getMobileMessage($instanceid);
        $this->assign("phone_info", $phone_info);
        
        $email_info = $config->getEmailMessage($instanceid);
        $this->assign("email_info", $email_info);
        $this->assign("web_info", $web_info);
        return view($this->style . 'Login/register');
    }

    /**
     * 验证码
     *
     * @return multitype:number string
     */
    public function vertify()
    {
        $vertification = $_POST['vertification'];
        if (! captcha_check($vertification)) {
            $retval = [
                'code' => 0,
                'message' => "验证码错误"
            ];
        } else {
            $retval = [
                'code' => 1,
                'message' => "验证码正确"
            ];
        }
        return $retval;
    }

    /*
     * 以下为找回密码页面
     */
    public function findPasswd()
    {
        if (request()->isAjax()) {
            // 获取数据库中的用户列表
            $username = $_GET['username'];
            $exist = false;
            $user_list = $this->user->getMemberList();
            foreach ($user_list["data"] as $user_list2) {
                if ($user_list2["user_tel"] == $username) {
                    $exist = true;
                } else 
                    if ($user_list2["user_email"] == $username) {
                        $exist = true;
                    }
            }
            return $exist;
        }
        
        // 获取商城logo
        $website = new WebSite();
        $web_info = $website->getWebSiteInfo();
        $this->assign("web_info", $web_info);
        return view($this->style . "Login/findPasswd");
    }

    /**
     * 邮箱短信验证
     *
     * @return Ambigous <string, \think\mixed>
     */
    public function forgotValidation()
    {
        $send_type = isset($_POST['type']) ? $_POST['type'] : '';
        $send_param = isset($_POST['send_param']) ? $_POST['send_param'] : '';
        $vertification = isset($_POST['vertification']) ? $_POST['vertification'] : '';
        $shop_id = 0;
        if ($this->login_verify_code["value"]["pc"] == 1) {
            if (! captcha_check($vertification)) {
                $result = [
                    'code' => - 1,
                    'message' => "验证码错误"
                ];
                return $result;
            } else {
                $member = new Member();
                if ($send_type == 'sms') {
                    if (! $member->memberIsMobile($send_param)) {
                        $result = [
                            'code' => - 1,
                            'message' => "该手机号未注册"
                        ];
                        return $result;
                    } else {
                        Session::set("codeMobile", $send_param);
                    }
                } else 
                    if ($send_type == 'email') {
                        $member->memberIsEmail($send_param);
                        if (! $member->memberIsEmail($send_param)) {
                            $result = [
                                'code' => - 1,
                                'message' => "该邮箱未注册"
                            ];
                            return $result;
                        } else {
                            Session::set("codeEmail", $send_param);
                        }
                    }
                $params = array(
                    "send_type" => $send_type,
                    "send_param" => $send_param,
                    "shop_id" => $shop_id
                );
                $res = runhook("Notify", "forgotPassword", $params);
                Session::set('params', $res['param']);
                return $res;
            }
        } else {
            $member = new Member();
            if ($send_type == 'sms') {
                if (! $member->memberIsMobile($send_param)) {
                    $result = [
                        'code' => - 1,
                        'message' => "该手机号未注册"
                    ];
                    return $result;
                } else {
                    Session::set("codeMobile", $send_param);
                }
            } else 
                if ($send_type == 'email') {
                    $member->memberIsEmail($send_param);
                    if (! $member->memberIsEmail($send_param)) {
                        $result = [
                            'code' => - 1,
                            'message' => "该邮箱未注册"
                        ];
                        return $result;
                    } else {
                        Session::set("codeEmail", $send_param);
                    }
                }
            $params = array(
                "send_type" => $send_type,
                "send_param" => $send_param,
                "shop_id" => $shop_id
            );
            $res = runhook("Notify", "forgotPassword", $params);
            Session::set('params', $res['param']);
            return $res;
        }
    }

    /**
     * 找回密码密码重置
     *
     * @return unknown[]
     */
    public function setNewPasswordByEmailOrmobile()
    {
        $userInfo = isset($_POST['userInfo']) ? $_POST['userInfo'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';
        if ($type == "email") {
            $codeEmail = Session::get("codeEmail");
            if ($userInfo != $codeEmail) {
                return $retval = array(
                    "code" => - 1,
                    "message" => "该邮箱与验证邮箱不符"
                );
            } else {
                $res = $this->user->updateUserPasswordByEmail($userInfo, $password);
                Session::delete("codeEmail");
            }
        } else 
            if ($type == "mobile") {
                $codeMobile = Session::get("codeMobile");
                if ($userInfo != $codeMobile) {
                    return $retval = array(
                        "code" => - 1,
                        "message" => "该手机号与验证手机不符"
                    );
                } else {
                    $res = $this->user->updateUserPasswordByMobile($userInfo, $password);
                    Session::delete("codeMobile");
                }
            }
        return AjaxReturn($res);
    }

    /**
     *
     * @return Ambigous <\think\response\View, \think\response\$this, \think\response\View>
     */
    public function check_code()
    {
        $send_param = request()->post('send_param', '');
        $param = Session::get('emailVerificationCode');
        // var_dump($param);
        if ($send_param == $param && $send_param != '') {
            $retval = [
                'code' => 0,
                'message' => "验证码一致"
            ];
        } else {
            $retval = [
                'code' => 1,
                'message' => "验证码不一致"
            ];
        }
        return $retval;
    }

    /**
     * 第三方登录登录
     */
    public function oauthLogin()
    {
        $type = $_GET['type'];
        $test = ThinkOauth::getInstance($type);
        $this->redirect($test->getRequestCodeURL());
    }

    /**
     * qq登录返回
     */
    public function callback()
    {
        $code = isset($_GET['code']) ? $_GET['code'] : '';
        if (empty($code))
            die();
        $qq = ThinkOauth::getInstance('QQLOGIN');
        $token = $qq->getAccessToken($code);
        if (! empty($token['openid'])) {
            if (! empty($_SESSION['bund_pre_url'])) {
                // 1.检测当前qqopenid是否已经绑定，如果已经绑定直接返回绑定失败
                $bund_pre_url = $_SESSION['bund_pre_url'];
                $_SESSION['bund_pre_url'] = '';
                $is_bund = $this->user->checkUserQQopenid($token['openid']);
                if ($is_bund == 0) {
                    // 2.绑定操作
                    $qq = ThinkOauth::getInstance('QQLOGIN', $token);
                    $data = $qq->call('user/get_user_info');
                    $_SESSION['qq_info'] = json_encode($data);
                    // 执行用户信息更新user服务层添加更新绑定qq函数（绑定，解绑）
                    $res = $this->user->bindQQ($token['openid'], json_encode($data));
                    // 如果执行成功执行跳转
                    
                    if ($res) {
                        $this->success('绑定成功', $bund_pre_url);
                    } else {
                        $this->error('绑定失败', $bund_pre_url);
                    }
                } else {
                    $this->error('该qq已经绑定', $bund_pre_url);
                }
            } else {
                $retval = $this->user->qqLogin($token['openid']);
                // 已经绑定
                if ($retval == 1) {
                    if (! empty($_SESSION['login_pre_url'])) {
                        $this->redirect($_SESSION['login_pre_url']);
                    } else
                        $this->redirect(__URL__);
                    // $this->success("登录成功", "Index/index");
                }
                if ($retval == USER_NBUND) {
                    $qq = ThinkOauth::getInstance('QQLOGIN', $token);
                    $data = $qq->call('user/get_user_info');
                    $_SESSION['qq_info'] = json_encode($data);
                    $this->assign("qq_info", json_encode($data));
                    $this->assign("qq_openid", $token['openid']);
                    $this->assign("data", $data);
                    return view($this->style . 'Login/qqcallback');
                }
            }
        }
    }
    // 验证注册配置
    public function verifyRegConfig($type = "plain")
    {
        $instanceid = 0;
        $config = new Config();
        $reg_config_info = $config->getRegisterAndVisit($instanceid);
        $reg_config = json_decode($reg_config_info["value"], true);
        if ($reg_config["is_register"] != 1) {
            $this->error("抱歉,商城暂未开放注册!");
        }
        if ($reg_config['register_info'] != "") {
            if (strpos($reg_config['register_info'], $type) === false) {
                if ($type == "mobile") {
                    $text = "抱歉,商城暂未开放手机注册!";
                } else 
                    if ($type == "email") {
                        $text = "抱歉,商城暂未开放邮箱注册!";
                    } else {
                        $text = "抱歉,商城暂未开放普通注册!";
                    }
                $this->error($text);
            }
        } else {
            $this->error("抱歉,商城暂未开放注册!");
        }
        // 传递本页面上传方式
        $this->assign("login_type", $type);
        $this->assign("reg_config", $reg_config);
    }

    /**
     * 注册公共外层
     */
    public function registerBox()
    {
        $instanceid = 0;
        $config = new Config();
        $reg_config_info = $config->getRegisterAndVisit($instanceid);
        $reg_config = json_decode($reg_config_info["value"], true);
        if (trim($reg_config['register_info']) == "") {
            $this->error("抱歉,商城暂未开放注册!");
        } else {
            if (strpos($reg_config['register_info'], "plain") !== false) {
                $redirect = __URL(__URL__ . "/login/register");
                $this->redirect($redirect);
            } elseif (strpos($reg_config['register_info'], "mobile") !== false) {
                $redirect = __URL(__URL__ . "/login/mobile");
                $this->redirect($redirect);
               
            } elseif (strpos($reg_config['register_info'], "email") !== false) {
                $redirect = __URL(__URL__ . "/login/email");
                $this->redirect($redirect);
            } else {
                $this->error("抱歉,商城暂未开放注册!");
            }
        }
    }
}
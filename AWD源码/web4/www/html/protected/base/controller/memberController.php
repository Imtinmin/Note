<?php
//公共类
class memberController extends baseController{
  protected $auth=array();
	public function __construct()
	{
    parent::__construct(); 
		list($power,$group_id)=api('member','powerCheck');
    if($group_id){//会员应用开启状态
      foreach(getApps() as $app){//前台和会员中使用的模板变量
        if($app!='default' && $app!='admin' && $app!='appmanage' && $app!='install') $this->assign($app,api($app,'params'));
      }
      switch ($power) {
        case 1://没有权限访问
          if(1==$group_id) {
            $_SERVER['HTTP_REFERER']=url('member/index/login');
            $mes='您还没有登录~';
          }elseif(empty($_SERVER['HTTP_REFERER'])) {
            $_SERVER['HTTP_REFERER']=url('default/index/index');
            $mes='您没有没有权限进入~';
          }
          $this->error($mes,$_SERVER['HTTP_REFERER']);
          break;
        case 2://游客有权限访问
          break;
        default://会员信息数组,会员有权限访问
          $this->auth=$power;
          $this->assign('auth',$power);
          break;
      }
    }else $this->assign('memberoff',true);
	}
}
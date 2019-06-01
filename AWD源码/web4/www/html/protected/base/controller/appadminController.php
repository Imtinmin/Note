<?php
//公共类
class appadminController extends baseController{

	public function __construct()
	{
		session_starts();
		$appID = config('appID');
		$this->appID = empty($appID) ? $this->appID : $appID;

		if(isset($_SESSION['admin_uid'])&&isset($_SESSION['admin_username'])){
		   $apppower=$_SESSION['yxapppower'];
		   if($apppower!=-1) {
			   if(!(isset($apppower[APP_NAME]) && $apppower[APP_NAME]==-1)) $this->error('您没有权限操作');
		   }
		 foreach(getApps() as $app){//后台使用的模板变量
             if($app!='default' && $app!='admin' && $app!='appmanage' && $app!='install') $this->assign($app,api($app,'params'));
         }
		}else $this->error('您没有登录');
		parent::__construct();
	}
}
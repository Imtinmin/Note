<?php
class indexController extends commonController
{
	public function __construct()
	{
		parent::__construct();
		// print_r(Auth::getModule());//遍历所有模型和方法初始method表中数据
	}
	//显示管理后台首页
	public function index()
	{
		$groupid=$_SESSION[Auth::$config['AUTH_SESSION_PREFIX'].'groupid'];
		$power=model('group')->find("id = {$groupid}",'power');
		if($power['power']==-1) $where="ifmenu = '1'";
		else $where="ifmenu = '1' AND id IN(".$power['power'].")";
		$methods=model('method')->select($where,'','rootid,id');//所有有权限的节点

		//构造菜单
		if(!empty($methods)){
			$operate='';
			$page=array();
			$pluginlist=array();
			foreach ($methods as $vo){
				if($vo['pid']==0){
					$operate=$vo['operate'];
					$root[$operate]['channel']=$vo['name']?$vo['name']:$vo['operate'];
					$root[$operate]['pages']=array();
					if($vo['rootid']==0){
						$plugmenu=api($operate,'getadminMenu');//获取应用菜单
						if(is_array($plugmenu)){
						   $pluginlist[]=$operate;//记录插件名
						   $root[$operate]['pages']=$plugmenu;
						}
				    } 
				}else{
					$page['name']=$vo['name']?$vo['name']:$vo['operate'];
					$page['url']=url($operate.'/'.$vo['operate']);
					$root[$operate]['pages'][]=$page;
				}
			}
		}else $this->error('获取后台导航菜单失败~');
		//独立表单管理
		$extendtabs=model('extend')->select("pid='0' AND type='1'");
		if(!empty($extendtabs) && !empty($root['extendfield'])){
			foreach ($extendtabs as $vo) {
			  if($this->checkConPower('extend',$vo['id'])){//获取权限
				$page['name']='['.$vo['name'].']';
			    $page['url']=url('extendfield/meslist',array('id'=>$vo['id']));
			    $root['extendfield']['pages'][]=$page;
			  }
			}
		}
        
		$menu=Array(
		   Array('title'=>'管理首页','channels' => Array($root['set'],$root['admin'],$root['dbback'],$root['files'],$root['seo'])),//默认显示菜单
		   Array('title'=>'结构管理','channels' => Array($root['sort'],$root['fragment'],$root['extendfield'])),
		   Array('title'=>'内容管理','channels' => Array($root['news'],$root['photo'],$root['tags'],$root['link'])),
		   Array('title'=>'拓展应用','channels' => Array())
		);
		foreach ($pluginlist as $vo){//添加应用菜单
			$menu[3]['channels'][]=$root[$vo];
		}
		$menulist= json_encode($menu);
		$this->menulist=$menulist;
		$this->username=$_SESSION['admin_realname']?$_SESSION['admin_realname']:$_SESSION['admin_username'];
		$this->framurl=$_GET['url']?urldecode($_GET['url']):url('index/welcome');//内部iframe显示页
		$menuindex=intval($_GET['menuindex']);
		$this->menuindex=$menuindex?$menuindex:0;//设置初始显示菜单
		$this->ver=config('ver_name'); 
		$this->display();
	}
	//登录页面
	public function login()
	{
		if(!$this->isPost())
		{
			$this->ver=config('ver_name');
			$this->display('index_login');
		}else{
		//获取数据
		$username=in($_POST['username']);
		$password=$this->newpwd(in($_POST['password']));
		
		//数据验证
		if(empty($username))
		{
			$this->error('请输入用户名');
		}
		if(empty($_POST['password']))
		{
			$this->error('请输入密码');
		}
		if(empty($_POST['checkcode']))
		{
			$this->error('请输入验证码');
		}
		$verify=session('verify');
		session('verify',null);
		//登录验证session设置
		if(model('admin')->login($username,$password))
		{
			$this->redirect(url('index/index'));
		}
		else
		{
			$this->error('用户名、密码错误或账户已经被锁定~');
		}
	  }
	}
	//用户退出
	public function logout()
	{
		Auth::clear();
		$this->success('您已成功退出系统',url('index/login'));
	}
	//生成验证码
	public function verify()
	{
		Image::buildImageVerify();
	}
	public function welcome()
	{
		$this->ver=config('ver_name');
		$this->display();
	}
}
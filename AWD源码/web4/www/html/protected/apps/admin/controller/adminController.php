<?php
class adminController extends commonController
{
	public function index()//管理员列表
	{
	 if(!$this->isPost()){
	 	$grouplist=model('group')->select('','id,name','id');
	 	//栏目权限
        $sortlist=model('sort')->select('','id,type,name,deep,path,norder');
		if(!empty($sortlist)){
			$sortlist=re_sort($sortlist);
			$this->sortlist=$sortlist;
		}
		//独立表权限
        $extendlist=model('extend')->select("pid='0' AND type='1'",'id,name');
        $this->extendlist=$extendlist;

	 	$listRows=10;//每页显示的信息条数
		$url=url('admin/index',array('page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);

	 	$count=model('admin')->count();
	 	$list=model('admin')->adminANDgroup($limit);
	 	if(!empty($list)){
	 		foreach ($list as $key => $vo){
	 		   $list[$key]['num']=model('news')->count("account='".$vo['username']."'");
	 		   $list[$key]['num']+=model('photo')->count("account='".$vo['username']."'");
	 	    }
	 	}
	 	$this->list=$list;
	 	$this->count=$count;
	 	$this->page=$this->pageShow($count);
	 	$this->grouplist=$grouplist;
	 	$this->display();
	 }else{
	 	if(empty($_POST['username'])||empty($_POST['rpassword'])) $this->error('信息没有填写完整!');
	 	if($_POST['rpassword']!=$_POST['spassword']) $this->error('确认密码与密码不同!');

	 	$data=array();
	 	$data['username']=in($_POST['username']);
	 	$acchas=model('admin')->find("username='".$data['username']."'",'id');
	 	if(!empty($acchas)) $this->error('该账户名已存在!');
	 	$data['sortpower']=empty($_POST['sortpower'])?'':implode(',',$_POST['sortpower']);
	 	$data['extendpower']=empty($_POST['extendpower'])?'':implode(',',$_POST['extendpower']);
	 	$data['groupid']=intval($_POST['groupid']);
	 	$data['password']=$this->newpwd(in($_POST['rpassword']));
	 	$data['realname']=in($_POST['realname']);
	 	$data['iflock']=intval($_POST['iflock']);
	 	if(model('admin')->insert($data))
	 	  $this->success('管理员添加成功~',url('admin/index'));
	 	else $this->error('管理员添加失败!');
	 }
	}

	public function admindel()  //管理员删除
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		$info=model('admin')->count("groupid='1' AND id='{$id}'");
		$num=model('admin')->count("groupid='1'");
		if($num<2 && !empty($info)) $this->error('必须保留至少一个超级管理员~');
		if(model('admin')->delete("id='{$id}'"))
		$this->success('管理员已删除',url('admin/index'));
		else $this->error('没有该管理员');
	}

	public function adminedit()  //管理员修改
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		$info=model('admin')->find("id='{$id}'",'id,groupid,username,realname,password,iflock,sortpower,extendpower');
		if(!$this->isPost()){
			$grouplist=model('group')->select('','id,name','id');
			//栏目权限
            $sortlist=model('sort')->select('','id,type,name,deep,path,norder');
		    if(!empty($sortlist)){
			   $sortlist=re_sort($sortlist);
			   if(!empty($info['sortpower'])){
			   	  $spowers=explode(',', $info['sortpower']);
			   	  foreach ($sortlist as $key => $vo) {
			   	  	if(in_array($vo['id'],$spowers)) $sortlist[$key]['checked']='checked';
			   	  }
			   }
			   $this->sortlist=$sortlist;
		    }
		    //独立表权限
            $extendlist=model('extend')->select("pid='0' AND type='1'",'id,name');
            if(!empty($info['extendpower'])){
			   	  $epowers=explode(',', $info['extendpower']);
			   	  foreach ($extendlist as $key => $vo) {
			   	  	if(in_array($vo['id'],$epowers)) $extendlist[$key]['checked']='checked';
			   	  }
			}
            $this->extendlist=$extendlist;

			$this->info=$info;
			$this->id=$id;
			$this->grouplist=$grouplist;
			$this->display();
		}else{
			$data=array();
			$data['groupid']=intval($_POST['groupid']);
			$data['username']=$_POST['username'];
			if($_POST['rpassword']!=$info['password'])
			   $data['password']=$this->newpwd(in($_POST['rpassword']));
			$data['realname']=$_POST['realname'];
			$data['iflock']=intval($_POST['iflock']);
			$data['sortpower']=empty($_POST['sortpower'])?'':implode(',',$_POST['sortpower']);
	 	    $data['extendpower']=empty($_POST['extendpower'])?'':implode(',',$_POST['extendpower']);
			model('admin')->update("id='{$id}'",$data);
			$this->success('信息修改成功~',url('admin/index'));
		}
	}

	public function adminlock() //管理员锁定
	{
		$id=intval($_GET['id']);
		$lock['iflock']=intval($_GET['l']);
		if(empty($id)) $this->error('非法操作~');
		if($lock['iflock']==0 || $lock['iflock']==1){
			model('admin')->update("id='{$id}'",$lock);
			$this->success('操作成功~',url('admin/index'));
		}
		else $this->error('非法操作~');
	}

	public function group()  //分组添加
	{
		if(!$this->isPost()){
			$powerlist=model('method')->select('','','rootid,id');
			//所有不是超级管理员组的组别
			$grouplist=model('group')->select("power!='-1'",'id,name','id');
			$this->powerlist=$powerlist;
			$this->grouplist=$grouplist;
			$this->display();
		}else{
			if(empty($_POST['gname'])) $this->error('必须填写组名~');
			$data=array();
			$data['name']=$_POST['gname'];
			$data['power']=implode(',',$_POST['power']);
			if(model('group')->insert($data))
			$this->success('权限组添加成功~',url('admin/group'));
		}
	}

	public function groupedit()//分组编辑
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误~');
		$group=model('group')->find("id='{$id}'",'name,power');
		if($group['power']=='-1') $this->error('非法操作');
		if(!$this->isPost()){
			$powerlist=model('method')->select('','','rootid,id');
			$this->powerlist=$powerlist;
			$this->info=$group;
			$this->id=$id;
			$this->display();
		}else{
			if(empty($_POST['gname'])) $this->error('必须填写组名~');
			$data=array();
			$data['name']=$_POST['gname'];
			$data['power']=implode(',',$_POST['power']);
			model('group')->update("id='{$id}'",$data);
			$this->success('权限组编辑成功~',url('admin/group'));
		}
	}

	public function groupdel()  //分组删除
	{
		$id=intval($_GET['id']);
		if(empty($id)||$id==-1) $this->error('非法操作~');
		if(model('admin')->find("groupid='{$id}'",'id'))
		$this->error('请先删除该权限下的管理员~');
		if(model('group')->delete("id='{$id}'"))
		$this->success('删除成功~',url('admin/group'));
		else $this->error('删除失败');
	}

	public function adminnow() //当前账户资料管理
	{
		if(!isset($_SESSION['admin_uid'])) $this->error('未知的账户信息~');
		$id=$_SESSION['admin_uid'];
		$info=model('admin')->find("id='{$id}'",'id,username,realname,password');
		if(!$this->isPost()){
			$this->info=$info;
			$this->display();
		}else{
			$data=array();
			$_POST['opassword']=in($_POST['opassword']);
			if(!empty($_POST['opassword'])){
				if($this->newpwd($_POST['opassword'])!=$info['password']) $this->error('旧密码错误~!');
				$_POST['rpassword']=in($_POST['rpassword']);
				$_POST['spassword']=in($_POST['spassword']);
				if(!empty($_POST['rpassword'])){
				   if($_POST['rpassword']!=$_POST['spassword']) $this->error('确认密码与密码不同~');
			       $data['password']=$this->newpwd($_POST['rpassword']);
			    }else $this->error('如果不需要修改密码，请不要填写旧密码~');
			}
			$data['realname']=$_POST['realname'];
			model('admin')->update("id='{$id}'",$data);
			$this->success('信息修改成功~',url('admin/adminnow'));
		}
	}
}
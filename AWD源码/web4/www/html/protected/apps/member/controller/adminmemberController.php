<?php
class adminmemberController extends appadminController{
	//会员列表
	public function index()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('adminmember/index',array('page'=>'{page}'));
		$limit=$this->pageLimit($url,$listRows);

		$count=model('members')->count();//获取行数
		$list=model('members')->memberANDgroup($limit);

		$this->list=$list;
		$this->page=$this->pageShow($count);
		$this->display();
	}
	
	//会员添加
	public function add()
	{
		if(!$this->isPost()){
			$group=model('memberGroup')->select('','id,name','id DESC');
			foreach ($group as $val) {
				if($val['id']!=1) $select.= "<option value='{$val['id']}'>{$val['name']}</option>";
			}
			$this->select=$select;
			$this->addtime=time();
			$this->lasttime=time();
			$this->display();
		}else{
			$data=array();
			if(!preg_match("/[a-z][a-z0-9_]{3,14}/is",$_POST['name'])) $this->error('账户名必须3-14位字母、数字下划线组成~');
			$data['account']=$_POST['name'];
			$acc=model('members')->find("account='".$data['account']."'");
			if(!empty($acc['account'])) $this->error('该账户已经有人注册~');
			$data['groupid']=$_POST['groupid'];
			$data['password']=codepwd($_POST['password']); 
			$data['nickname']=in($_POST['nickname']);
			$data['email']=in($_POST['email']);
			$data['tel']=in($_POST['tel']);
			$data['qq']=in($_POST['qq']);
			$data['rmb']=$_POST['rmb'];
			$data['crmb']=$_POST['crmb'];
			$data['regip']=$_POST['regip'];
			$data['regtime']=strtotime($_POST['addtime']);
			$data['lastip']=$_POST['lastip'];
			$data['lasttime']=strtotime($_POST['lasttime']);
			$data['islock']=$_POST['islock'];
			if(model('members')->insert($data))
			{
			    $this->success('会员添加成功~');
			}
			else
			{
				$this->error('出错了~');
			}
		}
      }

	//会员修改
	public function edit()
	{
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) $this->error('参数错误');
			$info=model('members')->find("id='$id'");
			$info['rrmb']=$info['rmb']-$info['crmb'];
			$group=model('memberGroup')->select("id !='1'","id,name");
			foreach ($group as $val) {
				$select.=($val['id']==$info['groupid'])?"<option selected='selected' value='{$val['id']}'>{$val['name']}</option>":"<option value='{$val['id']}'>{$val['name']}</option>";
			}
			$this->select=$select;
			$this->info=$info;
			$this->display();
		}else{
			$id=$_POST['id'];
			$oldrmb=intval($_POST['oldrmb']);
			$data=array();
			$data['rmb']=intval($_POST['rmb']);
			if($data['rmb']<$oldrmb || $data['rmb']<0) $this->error('充值累计金额不得比之前少且不小于0~');
			$data['groupid']=intval($_POST['groupid']);
			if($_POST['password']!=$_POST['oldpassword']){
				$data['password']=codepwd($_POST['password']);
				$ucback=api('ucenter','editor',array($_POST['account'],'',$_POST['password']));
				if(is_array($ucback) && !$ucback[0]) $this->error('UC修改密码'.$ucback[1]);
			} 
			$data['nickname']=$_POST['nickname'];
			$data['email']=$_POST['email'];
			$data['tel']=$_POST['tel'];
			$data['qq']=$_POST['qq'];
			$data['islock']=intval($_POST['islock']);
			model('members')->update("id='$id'",$data);
			$this->success('会员信息编辑成功~');
		}
	}

	//删除会员
	public function del()
	{
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) exit('您没有选择~');
			if(api('ucenter','ifopen')){
				$info=model('members')->find("id='$id'","account");
			    $ucback=api('ucenter','del',array($info['account']));
				if(!$ucback[0]) exit($ucback[1]);
			}
			if(model('members')->delete("id='$id'"))
			echo 1;
			else echo '删除失败~';
		}else{
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			if(api('ucenter','ifopen')){
				$dlist=model('members')->select('id in ('.$delid.')',"account");
				$ucback=api('ucenter','del',array($dlist));
				if(!$ucback[0]) $this->error($ucback[1]);
			}
			if(model('members')->delete('id in ('.$delid.')'))
			$this->success('删除成功');
		}
	}
   //会员冻结
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['islock']=intval($_POST['islock']);
		if(model('members')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}

}
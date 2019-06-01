<?php
class admingroupController extends appadminController{
	//会员组列表
	public function index()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('admin/index',array('page'=>'{page}'));
		$limit=$this->pageLimit($url,$listRows);

		$count=model('memberGroup')->count();//获取行数
		$list=model('memberGroup')->select('','id,name','id DESC',$limit);
		$this->list=$list;
		$this->page=$this->pageShow($count);
		$this->display();
	}
    //会员组添加
	public function add()
	{
		if(!$this->isPost()){
			$this->display();
		}else{
			$data=array();
			$data['name']=trim($_POST['gname']);
			$data['notallow']=trim($_POST['notallow']);
			$data['notallow']=str_replace("\r\n","|",$data['notallow']);
			if(model('memberGroup')->insert($data))
			    $this->success('会员组添加成功~');
			else $this->error('出错了~');
		}
	}
	//会员组修改
	public function edit()
	{
		if(!$this->isPost()){
			$id=$_GET['id'];
			if(empty($id)) $this->error('参数错误');
			$info=model('memberGroup')->find("id='$id'");
			$info['notallow']=str_replace("|","\r\n",$info['notallow']);
			$this->info=$info;
			$this->display();
		}else{
			$id=$_POST['id'];
			$data=array();
			$data['name']=trim($_POST['gname']);
			$data['notallow']=trim($_POST['notallow']);
			$data['notallow']=str_replace("\r\n","|",$data['notallow']);
			model('memberGroup')->update("id='$id'",$data);
			$this->success('会员组编辑成功~');
		}
	}

	//删除会员组
	public function del()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('您没有选择~');
		$member=model('members')->find("groupid='$id'");
		if(!empty($member)) {
			echo '有属于该组的会员存在，不能删除~';
			return;
		}
		if(model('memberGroup')->delete("id='$id'"))
		echo 1;
		else echo '删除失败~';
	}

}
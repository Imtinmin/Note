<?php
class linkController extends commonController
{
	static protected $imgpath='';//封面图路径
	static protected $uploadpath='';//封面图上传路径
	public function __construct()
	{
		parent::__construct();
		$this->imgpath = __ROOT__.'/upload/links/';
		$this->uploadpath = ROOT_PATH.'upload/links/';
	}
	public function index()
	{
		$where='';
		if(!empty($_GET['group'])){
			$group=in(urldecode($_GET['group']));
			$where="groupname='{$group}'";
		}
		$groups=model('link')->groups();
		if(!empty($groups)){
			foreach ($groups as $vo) {
				$select=$vo['groupname']==$group?'selected':'';
				$this->options.='<option value="'.urlencode($vo['groupname']).'" '.$select.'>'.$vo['groupname'].'</option>';
			}
		}
		$listRows=20;//每页显示的信息条数
		$url=$group?url('link/index',array('group'=>$group,'page'=>'{page}')):url('link/index',array('page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);

		$count=model('link')->count($where);
		$list=model('link')->select($where,'id,groupname,name,url,picture,logourl,info,norder,ispass','norder DESC,id DESC',$limit);
		$this->page=$this->pageShow($count);
		$this->list=$list;
		$this->path=$this->imgpath;
		$this->display();
	}
	public function add()
	{
		if(!$this->isPost()){
			$this->display();
		}else{
			if(empty($_POST['url'])||empty($_POST['webname']))
			$this->error('请填写完整的信息~');
			$data=array();
			$data['groupname']=in($_POST['groupname']);
			if($data['groupname']=='all') $this->error('不能使用调用关键词all~');
			$data['name']=in($_POST['webname']);
			$data['url']=in($_POST['url']);
			$data['logourl']=in($_POST['logourl']);
			$data['info']=in($_POST['info']);
			$data['norder']=intval(in($_POST['norder']));
			$data['ispass']=intval($_POST['ispass']);
			if (empty($_FILES['picture']['name']) === false){
				$imgupload= $this->upload($this->uploadpath,config('imgupSize'),'jpg,bmp,gif,png');
				$imgupload->upload();
				$fileinfo=$imgupload->getUploadFileInfo();
				$errorinfo=$imgupload->getErrorMsg();
				if(!empty($errorinfo)) $this->alert($errorinfo);
				else $data['picture']=$fileinfo[0]['savename'];
			}
			if(model('link')->insert($data))
			$this->success('链接添加成功~',url('link/index'));
			else $this->error('链接添加失败~');
		}
	}

	public function edit()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost()){
			$info=model('link')->find("id='$id'");
			$this->info=$info;
			$this->path=$this->imgpath;
			$this->display();
		}else{
			if(empty($_POST['url'])||empty($_POST['webname']))
			$this->error('请填写完整的信息~');
			$data=array();
			$data['groupname']=in($_POST['groupname']);
			if($data['groupname']=='all') $this->error('不能使用调用关键词all~');
			$data['name']=in($_POST['webname']);
			$data['url']=in($_POST['url']);
			$data['logourl']=in($_POST['logourl']);
			$data['info']=in($_POST['info']);
			$data['norder']=intval(in($_POST['norder']));
			$data['ispass']=intval($_POST['ispass']);
			if (empty($_FILES['picture']['name']) === false){
				$imgupload= $this->upload($this->uploadpath,config('imgupSize'),'jpg,bmp,gif,png');
				if(!empty($_POST['oldpicture'])){
					$picpath=$this->uploadpath.$_POST['oldpicture'];
					if(file_exists($picpath)) @unlink($picpath);
					$imgupload->saveRule=substr($_POST['oldpicture'],0,strrpos($_POST['oldpicture'],'.'));//固定文件名
					$imgupload->uploadReplace=true;//重名则覆盖
				}
				$imgupload->upload();
				$fileinfo=$imgupload->getUploadFileInfo();
				$errorinfo=$imgupload->getErrorMsg();
				if(!empty($errorinfo)) $this->alert($errorinfo);
				$data['picture']=$fileinfo[0]['savename'];
				$mes='logo已经上传，';
			}
			model('link')->update("id='{$id}'",$data);
			$this->success($mes.'链接编辑成功~',url('link/index'));
		}
	}

	public function del()
	{
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) $this->error('您没有选择~');
			$coverpic=model('link')->find("id='$id'",'picture');
			$picpath=$this->uploadpath.$coverpic[picture];
			if(file_exists($picpath)) @unlink($picpath);
			if(model('link')->delete("id='$id'"))
			echo 1;
			else echo '删除失败~';
		}else{
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			$coverpics=model('link')->select('id in ('.$delid.')','picture');
			foreach($coverpics as $vo){
				if(!empty($vo[picture])){
					$picpath=$this->uploadpath.$vo[picture];
					if(file_exists($picpath)) @unlink($picpath);
				}
			}
			if(model('link')->delete('id in ('.$delid.')'))
			$this->success('删除成功',url('link/index'));
		}
	}
	//审核,ajax
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['ispass']=intval($_POST['ispass']);
		if(model('link')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}
}
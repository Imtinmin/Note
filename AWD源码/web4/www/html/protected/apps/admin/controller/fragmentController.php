<?php
class fragmentController extends commonController
{
	public function index()
	{
		$listRows=10;//每页显示的信息条数
		$url=url('fragment/index',array('page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);

		$count=model('fragment')->count();
		$list=model('fragment')->select('','id,title,sign','',$limit);
		$this->page=$this->pageShow($count);
		$this->url=url('fragment');
		$this->list=$list;
		$this->display();
	}
	public function add()
	{
		if(!$this->isPost()){
			$this->display();
		}else{
			if(empty($_POST['content'])||empty($_POST['sign']))
			$this->error('请填写完整的信息~');
			$data=array();
			$data['title']=in($_POST['title']);
		    if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes(html_in($_POST['content']));
			} else {
				$data['content'] = html_in($_POST['content']);
			}
			$data['sign']=$sign=in($_POST['sign']);
            $ifsigh=model('fragment')->find("sign='{$sign}'");
            if(empty($ifsigh)){
			    if(model('fragment')->insert($data))
			       $this->success('碎片添加成功~',url('fragment/index'));
			    else $this->error('碎片添加失败~');
            }else $this->error('调用标识跟已有碎片重复~');
		}
	}
	public function edit()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost()){
			$info=model('fragment')->find("id='$id'");
			$this->info= $info;
			$this->display();
		}else{
			if(empty($_POST['content']))
			$this->error('请填写完整的信息~');
			$data=array();
			$data['title']=in($_POST['title']);
		    if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes(html_in($_POST['content']));
			} else {
				$data['content'] = html_in($_POST['content']);
			}
			model('fragment')->update("id='{$id}'",$data);
			$this->success('碎片编辑成功~',url('fragment/index'));
		}
	}

	public function del()
	{
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) $this->error('您没有选择~');
			if(model('fragment')->delete("id='$id'"))
			echo 1;
			else echo '删除失败~';
		}else{
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			if(model('fragment')->delete('id in ('.$delid.')'))
			$this->success('删除成功',url('fragment/index'));
		}
	}
	//编辑器上传
	public function UploadJson(){
		$this->EditUploadJson('fragment');
	}
	//编辑器文件管理
	public function FileManagerJson(){
		$this->EditFileManagerJson('fragment');
	}
	//图片本地化
	public function saveimage(){
	  if(!empty($_POST['con'])){
		$content=$_POST['con'];
		$path='fragment/image/'.date("Ymd");
		if(empty($content)) return;
		echo $this->localimage($content,$path);
	   }
	}
}
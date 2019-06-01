<?php
class tagsController extends commonController
{
	public function index()
	{
		$listRows=20;//每页显示的信息条数
		$url=url('tags/index',array('page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);

		$count=model('tags')->count();
		$list=model('tags')->select('','','id DESC',$limit);
		$this->page=$this->pageShow($count);
		$this->list=$list;
		$this->url=url('link');
		$this->display();
	}
    public function add()
	{
      if(!$this->isPost()){
        	$list=model('sort')->select('','id,name,type,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$this->display();
		}else{//Ajax方式调用
			$sortid=intval($_POST['sortid']);
			$num=intval($_POST['num']);
			if(empty($sortid)){
			   $alist=model('news')->select("ispass='1'",'keywords','hits desc','0,500');
			   $plist=model('photo')->select("ispass='1'",'keywords','hits desc','0,500');
			   $list=@array_merge($alist,$plist);
			   unset($alist);
			   unset($plist);
			}else{
				$typea=model('sort')->find("id='{$sortid}'",'type');
			    switch ($typea['type']) {
			    	case 1:
			    		$list=model('news')->select("ispass='1' AND sort like'%{$sortid}%'",'keywords','hits desc','0,1000');
			    		break;
			    	case 2:
			    		$list=model('photo')->select("ispass='1' AND sort like'%{$sortid}%'",'keywords','hits desc','0,1000');
			    		break;
			    	default:
			    		# code...
			    		break;
			    }
			}
			$allnum=0;
			if(!empty($list)){
				foreach ($list as $vo) {
					$enum=$this->crtags($vo['keywords']);
					if(!empty($num) && $allnum>$num) break;
					if(!empty($enum)) $allnum+=$enum;
				}
			}
			echo $allnum;
		}
	}

	public function hadd()
	{
       if(!$this->isPost()){
          $this->display();
       }else{
          $data['name']=in($_POST['name']);
          $data['url']=in($_POST['url']);
          if(empty($data['name'])) $this->error('标签不能为空~');
          $data['hits']=$data['mesnum']=0;
          $data['addtime']=time();
          if(model('tags')->insert($data)) $this->success('标签添加成功~',url('tags/index'));
          else $this->error('标签添加失败~');
       }
	}
	
	public function edit()
	{
	   $id=intval($_GET['id']);
	   if(empty($id)) $this->error('参数错误~');
       if(!$this->isPost()){
       	 $this->info=model('tags')->find("id='$id'");
       	 $this->display();
       }else{
          $data['name']=in($_POST['name']);
          $data['url']=in($_POST['url']);
          if(empty($data['name'])) $this->error('标签不能为空~');
          if(model('tags')->update("id='$id'",$data)) $this->success('标签编辑成功~',url('tags/index'));
          else $this->error('标签编辑失败~');
       }
	}
	public function del()
	{
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) $this->error('您没有选择~');
			if(model('tags')->delete("id='$id'"))
			echo 1;
			else echo '删除失败~';
		}else{
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			if(model('tags')->delete('id in ('.$delid.')'))
			$this->success('删除成功',url('tags/index'));
		}
	}
    
	//编辑点击
	public function hits()
	{
		$id=intval($_POST['id']);
		$hit['hits']=intval($_POST['hits']);
		model('tags')->update("id='{$id}'",$hit);
		echo 1;
	}
	//更新文档数量
	public function mesup()//ajax
	{
		$id=intval($_POST['id']);
		$namea=model('tags')->find("id='{$id}'",'name');
		if(empty($namea)) $num=0;
		else{
          $name=$namea['name'];
          $where="title like '%".$name."%' OR description like '%".$name."%'";
          $count1=model('news')->count($where);
          $count2=model('photo')->count($where);
          $num=$count1+$count2;
		}
		model('tags')->update("id='{$id}'","mesnum={$num}");
		echo $num;
	}
}
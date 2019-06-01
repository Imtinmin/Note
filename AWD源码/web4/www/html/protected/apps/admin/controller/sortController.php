<?php
class sortController extends commonController
{
	static public $sort=array(
	   1=>array('name'=>'文章','mark'=>'news'),
	   2=>array('name'=>'图集','mark'=>'photo'),
	   3=>array('name'=>'单页','mark'=>'page'),
	   4=>array('name'=>'应用','mark'=>'plugin'),
       5=>array('name'=>'自定义','mark'=>'link'),
       6=>array('name'=>'表单','mark'=>'extend')
	);
	static public $uploadpath='';
	//static public $templepath;//前台模板路径
	static public $extendtab=array();
	public function __construct()
	{
		parent::__construct();
		$this->extendtab=model('extend')->select("pid='0' AND type='0'",'id,name');//拓展表信息
	}

    private function sortadd($parentid){
        if($parentid==0){
			$data['path']=',000000';
			$data['deep']=1;
		}else{
			$parent=model('sort')->find("id='{$parentid}'",'id,path,deep');
			$data['path']=$parent['path'].','.$parent['id'];
			$data['deep']=$parent['deep']+1;
		}
		return $data;
    }	
    private function sortmove($newparentid,$id){
    	if(!$this->checkConPower('sort',$id)) return "当前账户没有权限编辑{$id}~";
		if($id==$newparentid) return "{$id}不能将自身作为上级栏目~";
		//判断是否有子类
		$list=model('sort')->select("path like '%{$id}%' OR id='{$id}'",'path,type','path');
		if(!empty($list[1])) return "{$id}下有子栏目不可以移动~";
	    $where='\''.$list[0]['path'].','.$id.'\'';
		if($newparentid==0){
			$data['path']=',000000';
			$data['deep']=1;
		}else{
			$parent=model('sort')->find("id='{$newparentid}'",'id,path,deep');
			$data['path']=$parent['path'].','.$parent['id'];
			$data['deep']=$parent['deep']+1;
		}
        if(in_array($list[0]['type'], array(1,2,3))){//修改分类下所有信息类别
	    	$updata['sort']=$data['path'].','.$id;
            model(self::$sort[$list[0]['type']]['mark'])->update('sort='.$where,$updata);
	    }
		return $data;
    }
    //栏目封面图
    private function sortcoveradd($path)
    {
    	$tfile=date("Ymd");
		$imgupload= $this->upload($path.$tfile.'/',config('imgupSize'),'jpg,bmp,gif,png');
        $imgupload->saveRule='cover_'.time();
		$imgupload->upload();
		$fileinfo=$imgupload->getUploadFileInfo();
		$errorinfo=$imgupload->getErrorMsg();
		if(!empty($errorinfo)){ 
            $picture='NoPic.gif';
            $this->alert($errorinfo);
        }
		else $picture=$tfile.'/'.$fileinfo[0]['savename'];
		return  $picture;
    }
    private function sortcoveredit($path,$oldpicture)
   {
        $tfile=date("Ymd");
		$imgupload= $this->upload($path.$tfile.'/',config('imgupSize'),'jpg,bmp,gif,png');
        $imgupload->saveRule='thumb_'.time();
		if(!empty($oldpicture) && $oldpicture!=$this->nopic){
			$picpath=$path.$oldpicture;
			if(file_exists($picpath)) @unlink($picpath);
		}
		$imgupload->upload();
		$fileinfo=$imgupload->getUploadFileInfo();
		$errorinfo=$imgupload->getErrorMsg();
		if(!empty($errorinfo)) $this->alert($errorinfo);
		$picture=$tfile.'/'.$fileinfo[0]['savename'];
		return  $picture;
   }
   private function ifename($ename)
   {
   	$ename=trim($ename);
   	if(empty($ename)) return false;
     $info=model('sort')->find("ename='$ename'","id");
     if(empty($info)) return false;
     else return true;
   }
   //批量移动栏目
   public function sortsmove()
	{
        if(!$this->isPost()) $this->error('非法操作~',url('sort/index'));
        if('move'!=$_POST['dotype']) $this->error('操作类型错误~',url('sort/index'));
		if(empty($_POST['delid'])||empty($_POST['parentid'])) $this->error('还没有选择栏目~',url('sort/index'));
		$delid=array_reverse($_POST['delid']);
		if('top'==$_POST['parentid']) $_POST['parentid']=0;
        $pid=intval($_POST['parentid']);
		$er='';
		   foreach ($delid as $vo) {
		   	  if(!empty($vo)){
		   		 foreach ($vo as $v) {
		   		 	$v=intval($v);
		   			$data=$this->sortmove($pid,$v);
		   	        if(is_array($data)) {
		   	        	model('sort')->update("id = '$v'",$data);
		   	        }
		   	        else $er.=$data.'<br>';
		   		 }
		   	  }  	  
		   }
		if($er) $this->error($er,url('sort/index'));
		else $this->success('栏目移动成功~',url('sort/index'));
	}
	//批量编辑栏目
   public function sortsedit()
   {
      if(!$this->isPost()) $this->error('非法操作~',url('sort/index'));
      if('edit'==$_POST['dotype']){
         if(empty($_POST['delid'])) $this->error('还没有选择栏目~',url('sort/index'));
         $ids='';
		 foreach ($_POST['delid'] as $vo) {
		   	  if(!empty($vo)){
		   		 foreach ($vo as $v) {
		   			$ids.=$v.',';
		   		 }
		   	  }  	  
		 }
		 $ids=substr($ids, 0, -1);
         $types=model('sort')->select("id IN({$ids})","type");
         if(empty($types)) $this->error('栏目不存在~',url('sort/index'));
         $type=$types[0]['type'];
         for($i=1;$i<count($types);$i++) {
        	if($types[$i]['type']!=$type) $this->error('选中栏目模型必须相同~',url('sort/index'));
         }
         if(!in_array($type,array(1,2))) $this->error('只有资讯和图集栏目可以批量编辑~',url('sort/index'));
         $this->ids=$ids;
         $this->type=$type;
         
         $this->chooseL=$this->tempchoose(self::$sort[$type]['mark'],'');
		 $this->chooseC=$this->tempchoose(self::$sort[$type]['mark'],'');
         $exts=$this->extendtab;
		 if(!empty($exts)){
			$extendoption='';
			foreach($exts as $vo) $extendoption.='<option value="'.$vo['id'].'">'.$vo['name'].'</option>';
			$this->extendoption=$extendoption;
		  }
		 $this->display('sort_sorts'.self::$sort[$type]['mark']);
      }else{
      	$ids=in($_POST['ids']);
      	$type=intval($_POST['type']);
      	if(empty($ids) || empty($type)) $this->error('参数错误~',url('sort/index'));
      	$cright='';
      	$idar=explode(',', $ids);
      	$ids='';
      	foreach ($idar as $v) {
      		if(!$this->checkConPower('sort',$v)) $cright.= "当前账户没有权限编辑{$v}~<br>";
      		else $ids.=$v.',';
      	}
      	$ids=substr($ids, 0, -1);
      	if(empty($ids)) $this->error($cright,url('sort/index'));
      	if(''!=$_POST['keywords']) $data['keywords']=in($_POST['keywords']);
		if(''!=$_POST['description']) $data['description']=in($_POST['description']);
		if(''!=$_POST['num']) $data['url']=intval($_POST['num']);
		if(''!=$_POST['tplist'] && ''!=$_POST['cnlist']) $data['tplist']=$_POST['tplist'].','.$_POST['cnlist'];
		if(''!=$_POST['ifmenu']) $data['ifmenu']=intval($_POST['ifmenu']);
		if(''!=$_POST['norder']) $data['norder']=intval($_POST['norder']);
      	if(''!=$_POST['extendid']){//处理拓展字段编辑
      		$extends=model('sort')->select("id IN({$ids})","id,extendid,path");
      		$er='';
      		$eids='';
      		foreach ($extends as $vo) {
      		    if($_POST['extendid']!=$vo['extendid'] && $vo['extendid']!=0){
			  	    $nsort=$vo['path'].','.$vo['id'];
			        $ifhas=model(self::$sort[$type]['mark'])->find("sort='$nsort' AND extfield!='0'");
			        if(!empty($ifhas)) $er.=$vo['id'].',';
			        else $eids.=$vo['id'].',';
		        }
      		}
      		if($er){
      			$er.='栏目下有使用了附属表的信息，请先删除~';
      			if($eids){
      				$eids=substr($eids, 0, -1);
      				$data1['extendid']=intval($_POST['extendid']);
      				model('sort')->update("id IN({$eids})",$data1);
      			}
      		} else $data['extendid']=intval($_POST['extendid']);
      	}
      	if(isset($data)) model('sort')->update("id IN({$ids})",$data);
      	$er.=$cright;
      	if($er) $this->error($er,url('sort/index'));
      	else $this->success('栏目修改成功~',url('sort/index'));
      }
   }
   //封面图剪切
	public function cutcover()
	{
		//文件保存目录
		$picname=in($_POST['name']);
		$path=ROOT_PATH.'upload/'.$_POST['file'].'/';
		$thumb_image_location=$large_image_location=$path.$picname;
		$thumb_width=intval($_POST["thumb_w"]);//剪切后图片宽度
		$x1 = intval($_POST["x1"]);
		$y1 = intval($_POST["y1"]);
		$w =intval($_POST["w"]);
		$h = intval($_POST["h"]);
		if(empty($thumb_width)||empty($x1)||empty($y1)||empty($w)||empty($h)) echo 0;
		$scale = $thumb_width/$w;
		$cropped = resizeThumbnailImage($thumb_image_location,$large_image_location,$w,$h,$x1,$y1,$scale);
		if(empty($cropped)) echo 0;
		else echo $picname;
	}
	//封面图删除
	public function delcover()
	{
		//文件保存目录
		$this->uploadpath=ROOT_PATH.'upload/';
		$id=in($_POST['id']);
		$pic=in($_POST['pic']);
		$data['picture']= $this->nopic;
		if(model('sort')->update("id='$id'",$data)){
			$picpath=$this->uploadpath.$pic;
			if(file_exists($picpath)) @unlink($picpath);
			echo 1;
		}else echo '删除封面失败~';
	}
	
	//类别管理
	public function index()
	{   
		$sortscan=$_SESSION['admin_sortpower'];
		$where='';
		if($sortscan) $where="id IN({$sortscan})";
		$list=model('sort')->select($where,'id,type,name,ename,deep,ifmenu,picture,path,norder,method,extendid,url');
		if(!empty($list)){
			$list=re_sort($list);
			foreach ($list as $key=>$vo)
			{
				$list[$key]['url']=getURl($vo['type'],$vo['method'],$vo['url'],$vo['id'],$vo['extendid'],$vo['ename']);
			}
			$this->list=$list;
		}
		$this->sort=self::$sort;
		$this->path = __ROOT__.'/upload/';
		$this->public=__PUBLICAPP__;
		$this->display();
	}
	//编辑点击
	public function orderchange()
	{
		$id=intval($_POST['id']);
		$data['norder']=intval($_POST['order']);
		model('sort')->update("id='{$id}'",$data);
		echo 1;
	}
	//隐藏,ajax
	public function ifmenu()
	{
		$id=intval($_POST['id']);
		$menu['ifmenu']=intval($_POST['ifmenu']);
		if(model('sort')->update("id='{$id}'",$menu))
		echo 1;
		else echo '操作失败~';
	}
	public function add()
	{
	    $sortaction=$_GET['sortaction'];
		  switch ($sortaction) {
		  	case 'noadd':
		  		break;
		  	case 'newsadd':
		  		$this->newsadd();
		  		break;
		  	case 'photoadd':
		  		$this->photoadd();
		  		break;
		  	case 'pageadd':
		  		$this->pageadd();
		  		break;
		  	case 'pluginadd':
		  		$this->pluginadd();
		  		break;
		  	case 'linkadd':
		  		$this->linkadd();
		  		break;
		  	case 'extendadd':
		  		$this->extendadd();
		  		break;
		  	default:
		  		$this->display();
		  		break;
		  }
	}
   
	//添加文章栏目
	public function newsadd()
	{
		$type=1;//文章类型
		$this->uploadpath=ROOT_PATH.'upload/'.self::$sort[$type]['mark'].'/image/';
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$chooseL=$this->tempchoose(self::$sort[$type]['mark'],'index');
			$chooseC=$this->tempchoose(self::$sort[$type]['mark'],'content');
            if(!empty($chooseL)) $this->chooseL=$chooseL;
            if(!empty($chooseC)) $this->chooseC=$chooseC;
            $exts=$this->extendtab;
			if(!empty($exts)){//拓展表选项
				$extendoption='';
				foreach($exts as $vo)
				   $extendoption.='<option value="'.$vo['id'].'">'.$vo['name'].'</option>';
				$this->extendoption= $extendoption;
			}
			$this->md=self::$sort[$type]['mark'];
			$this->url=url('sort');
			$this->cwidth=config('coverMaxwidth');
			$this->cheight=config('coverMaxheight');
			$this->display('sort_newsadd');
		}else{
			if(empty($_POST['sortname']) || empty($_POST['tplist'])) $this->error('请填写完整栏目信息！');
			if($this->ifename($_POST['ename'])) $this->error('栏目英文名已存在~');
			$data=array();
			$maxid=model('sort')->maxid();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['picwidth']=intval($_POST['picwidth']);
			$data['picheight']=intval($_POST['picheight']);
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['url']=intval($_POST['num']);
			$data['method']='news/index';
			$data['tplist']=$_POST['tplist'].','.$_POST['cnlist'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['extendid']=intval($_POST['extendid']);
			if (empty($_FILES['picture']['name']) === false){
                $data['picture']=$this->sortcoveradd($this->uploadpath);
			}
            if(empty($_POST['ifnums'])){
               $data['name']=in($_POST['sortname']);
               $_POST['ename']=in($_POST['ename']);
               $data['ename']=empty($_POST['ename'])?$maxid+1:$_POST['ename'];
			   if(model('sort')->insert($data)) $this->success('资讯栏目添加成功~',url('sort/index'));
			   else $this->error('资讯栏目添加失败~');
			}else{
               $sortnames=explode("\r\n",$_POST['sortname']);
               if(!empty($sortnames)){
               	  $mes='';
               	  $i=0;
               	  foreach ($sortnames as $vo) {
               	  	 $vo=in($vo);
               	  	 if(!empty($vo)){
               	  	 	$vos=explode('|', $vo);
               	  	 	$data['name']=$vos[0];
               	  	 	if($this->ifename($vos[1])){
               	  	 	   $mes.="栏目".$vos[0]."英文名".$vos[1].'已存在<br>';
               	  	 	   continue;
               	  	 	} 
               	  	 	$data['ename']=empty($vos[1])?$maxid+$i+1:$vos[1];
               	  	 	model('sort')->insert($data);
               	  	 	$i++;
               	  	 }
               	  }
               	  if($mes) $this->alert($mes);
               	  $this->success('资讯栏目'.$i.'个成功添加~',url('sort/index'));
               }
			}
		}
	}
	//编辑文章栏目
	public function newsedit()
	{
		$type=1;//文章类型
		$this->uploadpath=ROOT_PATH.'upload/'.self::$sort[$type]['mark'].'/image/';
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		if(!$this->checkConPower('sort',$id)) $this->error('当前账户没有权限编辑该资讯栏目~');
		$info=model('sort')->find("id='$id'",'name,ename,picwidth,picheight,norder,path,picture,ifmenu,url,method,tplist,keywords,description,extendid');
		$info['url']=empty($info['url'])?10:$info['url'];
		$oldparentid=intval(substr ($info['path'], -6));
		$tps=explode(',',$info['tplist']);
		$info['tplist']=$tps[0];
		$info['cnlist']=$tps[1];
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$tpdef=explode('_',$info['tplist']);
			if(empty($tpdef[1])) $tpdef[1]='index';
			$chooseL=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);
            if(!empty($chooseL)) $this->chooseL=$chooseL;

            $tpdef=explode('_',$info['cnlist']);
			if(empty($tpdef[1])) $tpdef[1]='content';
			$chooseC=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);
            if(!empty($chooseC)) $this->chooseC=$chooseC;	
            unset($tpdef);

            $exts=$this->extendtab;
			if(!empty($exts)){//拓展表选项
				$extendoption='';
				foreach($exts as $vo){
					if($vo['id']==$info['extendid'])
					$extendoption.='<option value="'.$vo['id'].'" selected="selected">'.$vo['name'].'</option>';
					else $extendoption.='<option value="'.$vo['id'].'">'.$vo['name'].'</option>';
				}
				$this->extendoption=$extendoption;
			}
			$this->id=$id;
			$this->info=$info;
			$this->twidth=config('sortMaxwidth');
			$this->theight=config('sortMaxheight');
			$this->md=self::$sort[$type]['mark'];
			$this->oldparentid=$oldparentid;
			$this->path=__ROOT__.'/upload/'.self::$sort[$type]['mark'].'/image/';
			$this->display();
		}else{
			if(empty($_POST['sortname'])  || empty($_POST['tplist'])) $this->error('请填写完整栏目信息！');
			if($info['ename']!=trim($_POST['ename'])) {
				if($this->ifename($_POST['ename'])) $this->error('栏目英文名已存在~');
			}
			//数据处理
			$data=array();
			$newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid){
				$data=$this->sortmove($newparentid,$id);//分类编辑
			    if(!is_array($data)) $this->error($data);
			} 

			$data['name']=$_POST['sortname'];
			$_POST['ename']=in($_POST['ename']);
            $data['ename']=empty($_POST['ename'])?$id:$_POST['ename'];
			if (empty($_FILES['picture']['name']) === false){
                $data['picture']=$this->sortcoveredit($this->uploadpath,$_POST['oldpicture']);
			}
			$data['picwidth']=intval($_POST['picwidth']);
			$data['picheight']=intval($_POST['picheight']);
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['url']=intval($_POST['num']);
			$data['tplist']=$_POST['tplist'].','.$_POST['cnlist'];
			if($info['cnlist']!=$_POST['cnlist']){//更换信息内容模板
                model('news')->update("sort like '%$id' AND tpcontent='".$info['cnlist']."'","tpcontent='".$_POST['cnlist']."'");
			}
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);
			if($_POST['extendid']!=$info['extendid']){
			  if($info['extendid']!=0){
			  	 $nsort=$info['path'].','.$id;
			     $ifhas=model(self::$sort[$type]['mark'])->find("sort='$nsort' AND extfield!='0'");
			     if(!empty($ifhas)) $this->error('栏目下有使用了附属表的信息，请先删除~');
			  }
			  $data['extendid']=intval($_POST['extendid']);
			}
			//更新数据
			model('sort')->update("id = '$id'",$data);
			$this->success('文章栏目修改成功',url('sort/index'));

		}
	}

	//添加图集栏目
	public function photoadd()
	{
		$type=2;//图集类型
		$this->uploadpath=ROOT_PATH.'upload/'.self::$sort[$type]['mark'].'s/';
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			
			$chooseL=$this->tempchoose(self::$sort[$type]['mark'],'index');
			$chooseC=$this->tempchoose(self::$sort[$type]['mark'],'content');
            if(!empty($chooseL)) $this->chooseL=$chooseL;
            if(!empty($chooseC)) $this->chooseC=$chooseC;

			$exts=$this->extendtab;
			if(!empty($exts)){
				$extendoption='';
				foreach($exts as $vo)
				$extendoption.='<option value="'.$vo['id'].'">'.$vo['name'].'</option>';
				$this->extendoption=$extendoption;
			}
			$this->md=self::$sort[$type]['mark'];
			$this->url=url('sort');
			$this->twidth=config('thumbMaxwidth');
			$this->theight=config('thumbMaxheight');
			$this->display('sort_photoadd');
		}else{
			if(empty($_POST['sortname'])  || empty($_POST['tplist'])) $this->error('请填写完整栏目信息！');
			if($this->ifename($_POST['ename'])) $this->error('栏目英文名已存在~');
			$data=array();
			$maxid=model('sort')->maxid();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['picwidth']=intval($_POST['picwidth']);
			$data['picheight']=intval($_POST['picheight']);
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['url']=intval($_POST['num']);
			$data['method']='photo/index';
			$data['tplist']=$_POST['tplist'].','.$_POST['cnlist'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['extendid']=intval($_POST['extendid']);
			if (empty($_FILES['picture']['name']) === false){
                $data['picture']=$this->sortcoveradd($this->uploadpath);
			}

			if(empty($_POST['ifnums'])){
               $data['name']=in($_POST['sortname']);
               $_POST['ename']=in($_POST['ename']);
               $data['ename']=empty($_POST['ename'])?$maxid+1:$_POST['ename'];
			   if(model('sort')->insert($data)) $this->success('图集栏目添加成功~',url('sort/index'));
			   else $this->error('图集栏目添加失败~');
			}else{
               $sortnames=explode("\r\n",$_POST['sortname']);
               if(!empty($sortnames)){
               	  $mes='';
               	  $i=0;
               	  foreach ($sortnames as $vo) {
               	  	 $vo=in($vo);
               	  	 if(!empty($vo)){
               	  	 	$vos=explode('|', $vo);
               	  	 	$data['name']=$vos[0];
               	  	 	if($this->ifename($vos[1])){
               	  	 	   $mes.="栏目".$vos[0]."英文名".$vos[1].'已存在<br>';
               	  	 	   continue;
               	  	 	} 
               	  	 	$data['ename']=empty($vos[1])?$maxid+$i+1:$vos[1];
               	  	 	model('sort')->insert($data);
               	  	 	$i++;
               	  	 }
               	  }
               	  if($mes) $this->alert($mes);
               	  $this->success('图集栏目'.$i.'个成功添加~',url('sort/index'));
               }
			}
		}

	}
	//编辑图集栏目
	public function photoedit()
	{
		$type=2;//图集类型
		$this->uploadpath=ROOT_PATH.'upload/'.self::$sort[$type]['mark'].'s/';
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		if(!$this->checkConPower('sort',$id)) $this->error('当前账户没有权限编辑该图集栏目~');
		$info=model('sort')->find("id='$id'",'name,ename,picwidth,picheight,norder,path,ifmenu,picture,url,method,tplist,keywords,description,extendid');
		$info['url']=empty($info['url'])?10:$info['url'];
		$oldparentid=intval(substr ($info['path'], -6));
		$tps=explode(',',$info['tplist']);
		$info['tplist']=$tps[0];
		$info['cnlist']=$tps[1];
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$tpdef=explode('_',$info['tplist']);
			if(empty($tpdef[1])) $tpdef[1]='index';
			$chooseL=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);
            if(!empty($chooseL)) $this->chooseL=$chooseL;

            $tpdef=explode('_',$info['cnlist']);
			if(empty($tpdef[1])) $tpdef[1]='content';
			$chooseC=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);
            if(!empty($chooseC)) $this->chooseC=$chooseC;	
            unset($tpdef);

			$exts=$this->extendtab;
			if(!empty($exts)){//拓展表选项
				$extendoption='';
				foreach($exts as $vo){
					if($vo[id]==$info['extendid'])
					$extendoption.='<option value="'.$vo['id'].'" selected="selected">'.$vo['name'].'</option>';
					else $extendoption.='<option value="'.$vo['id'].'">'.$vo['name'].'</option>';
				}
				$this->extendoption=$extendoption;
			}
			$this->id=$id;
			$this->info=$info;
			$this->md=self::$sort[$type]['mark'];
			$this->path=__ROOT__.'/upload/'.self::$sort[$type]['mark'].'s/';
			$this->twidth=config('sortMaxwidth');
			$this->theight=config('sortMaxheight');
			$this->oldparentid=$oldparentid;
			$this->display();
		}else{
			if(empty($_POST['sortname']) || empty($_POST['tplist'])) $this->error('请填写完整栏目信息！');
			if($info['ename']!=trim($_POST['ename'])) {
				if($this->ifename($_POST['ename'])) $this->error('栏目英文名已存在~');
			}
			//数据处理
			$data=array();
			$newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid) {
			   $data=$this->sortmove($newparentid,$id);//分类编辑
               if(!is_array($data)) $this->error($data);
            }
			$data['name']=$_POST['sortname'];
			$_POST['ename']=in($_POST['ename']);
            $data['ename']=empty($_POST['ename'])?$id:$_POST['ename'];
			if (empty($_FILES['picture']['name']) === false){
                $data['picture']=$this->sortcoveredit($this->uploadpath,$_POST['oldpicture']);
			}
			$data['picwidth']=intval($_POST['picwidth']);
			$data['picheight']=intval($_POST['picheight']);
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['url']=intval($_POST['num']);
			$data['tplist']=$_POST['tplist'].','.$_POST['cnlist'];
			if($info['cnlist']!=$_POST['cnlist']){//更换信息内容模板
                model('photo')->update("sort like '%$id' AND tpcontent='".$info['cnlist']."'","tpcontent='".$_POST['cnlist']."'");
			}
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);
			if($_POST['extendid']!=$info['extendid']){
			  if($info['extendid']!=0){
			  	 $nsort=$info['path'].','.$id;
			     $ifhas=model(self::$sort[$type]['mark'])->find("sort='$nsort' AND extfield!='0'");
			     if(!empty($ifhas)) $this->error('栏目下有使用了附属表的信息，不能随意更换拓展表~');
			  }
			  $data['extendid']=intval($_POST['extendid']);
			}
			//更新数据
			model('sort')->update("id = '$id'",$data);
			$this->success('图集栏目修改成功',url('sort/index'));
		}
	}

	//添加单页栏目
	public function pageadd()
	{
		$type=3;//单页类型
		$this->uploadpath=ROOT_PATH.'upload/'.self::$sort[$type]['mark'].'s/image/';
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$choose=$this->tempchoose(self::$sort[$type]['mark'],'index');
            if(!empty($choose)) $this->choose=$choose;	
			$this->url=url('sort');
			$this->md=self::$sort[$type]['mark'];
			$this->display('sort_pageadd');
		}else{
			if(empty($_POST['sortname']) || empty($_POST['content']) || empty($_POST['tplist'])) $this->error('请填写完整栏目信息！');
			if($this->ifename($_POST['ename'])) $this->error('栏目英文名已存在~');
			$data=array();
			$maxid=model('sort')->maxid();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$_POST['ename']=in($_POST['ename']);
            $data['ename']=empty($_POST['ename'])?$maxid+1:$_POST['ename'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['method']='page/index';
			$data['tplist']=$_POST['tplist'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			if (empty($_FILES['picture']['name']) === false){
                $data['picture']=$this->sortcoveradd($this->uploadpath);
			}
            if (empty($data['description'])) {
                   $data['description']=in(substr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
                }
                 if(empty($data['keywords'])){    
                     $data['keywords']= $this->getkeyword($data['name'],$data['description']); //自动获取中文关键词 
                     if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
                 }
			$data1=array();
			if (get_magic_quotes_gpc()) {
				$data1['content'] = stripslashes(html_in($_POST['content']));
			} else {
				$data1['content'] = html_in($_POST['content']);
			}
			$data1['edittime']=in($_POST['edittime']);
			//插入数据
			$newid=model('sort')->insert($data);
			if($newid){
				$data1['sort']=$data['path'].','.$newid;
				if(model('page')->insert($data1))
				$this->success('单页添加成功~',url('sort/index'));
			}
			else $this->error('单页添加失败~');
		}
	}
	//编辑单页栏目
	public function pageedit()
	{
		$type=3;//单页类型
		$this->uploadpath=ROOT_PATH.'upload/'.self::$sort[$type]['mark'].'s/image/';
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		if(!$this->checkConPower('sort',$id)) $this->error('当前账户没有权限编辑该单页栏目~');
		$info=model('sort')->find("id='$id'",'name,ename,norder,path,ifmenu,picture,method,tplist,keywords,description');
		$oldparentid=intval(substr ($info['path'], -6));
		$oldsort=$info['path'].','.$id;//单页sort字段
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$tpdef=explode('_',$info['tplist']);
			if(!isset($tpdef[1])) $this->error('非法的模板参数~');
			$choose=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);
            if(!empty($choose)) $this->choose=$choose;	

			$info1=model('page')->find("sort='$oldsort'");
			$this->id=$id;
			$this->info=$info;//栏目信息
			$this->info1=$info1;//单页信息
			$this->type=$type;
			$this->md=self::$sort[$type]['mark'];
			$this->oldparentid=$oldparentid;
			$this->path=__ROOT__.'/upload/'.self::$sort[$type]['mark'].'s/image/';
			$this->twidth=config('sortMaxwidth');
			$this->theight=config('sortMaxheight');
			$this->display();
		}else{
            $pageid=intval($_GET['pageid']);
		    if(empty($pageid)) $this->error('空的单页id参数');
			if(empty($_POST['sortname']) || empty($_POST['content']) || empty($_POST['tplist'])) $this->error('请填写完整的栏目信息！');
			if($info['ename']!=trim($_POST['ename'])) {
				if($this->ifename($_POST['ename'])) $this->error('栏目英文名已存在~');
			}
			//数据处理
			$data=array();
			$data1=array();
            $newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid){
				$data=$this->sortmove($newparentid,$id);//分类编辑
				if(!is_array($data)) $this->error($data);
			}
			$data['name']=$_POST['sortname'];
			$_POST['ename']=in($_POST['ename']);
            $data['ename']=empty($_POST['ename'])?$id:$_POST['ename'];
			if (empty($_FILES['picture']['name']) === false){
                $data['picture']=$this->sortcoveredit($this->uploadpath,$_POST['oldpicture']);
			}
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['tplist']=$_POST['tplist'];
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);
            if (empty($data['description'])) {
                $data['description']=in(substr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
            }
            if(empty($data['keywords'])){    
                $data['keywords']= $this->getkeyword($data['name'],$data['description']); //自动获取中文关键词 
                if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
            }
			
			if (get_magic_quotes_gpc()) {
				$data1['content'] = stripslashes(html_in($_POST['content']));
			} else {
				$data1['content'] = html_in($_POST['content']);
			}
			$data1['edittime']=in($_POST['edittime']);
			model('page')->update("id = '$pageid'",$data1);
			model('sort')->update("id = '$id'",$data);
			$this->success('单页修改成功',url('sort/index'));
		}
	}
	//添加应用栏目
	public function pluginadd()
	{
		$type=4;//插件类型
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
				$plugs=api(getApps(),'getdefaultMenu');//已开启的应用列表
				if(!empty($plugs)){
					$choose='<option value="">=选择已安装的应用=</option>';
				   foreach ($plugs as $vo){
					   if(!empty($vo))
					       $choose.='<option value="'.$vo['r'].'">'.$vo['name'].'</option>';
				    }
				    $this->choose=$choose;
				}

			$this->url=url('sort');
			$this->display('sort_pluginadd');
		}else{
			if(empty($_POST['sortname']) || empty($_POST['method'])) $this->error('请填写完整栏目信息！');
			$data=array();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['method']=in($_POST['method']);
			$data['tplist']=$_POST['tplist'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			//插入数据
			if(model('sort')->insert($data)){
				$this->success('插件栏目添加成功~',url('sort/index'));
			}
			else $this->error('插件栏目添加失败~');
		}
	}

	//编辑应用栏目
	public function pluginedit()
	{
		$type=4;//插件类型
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		if(!$this->checkConPower('sort',$id)) $this->error('当前账户没有权限编辑该应用栏目~');
		$info=model('sort')->find("id='$id'",'name,norder,path,ifmenu,method,tplist,keywords,description');
		$oldparentid=intval(substr ($info['path'], -6));
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
            $plugs=api(getApps(),'getdefaultMenu');//已开启的应用列表
				if(!empty($plugs)){
				   foreach ($plugs as $vo){
					   if(!empty($vo))
					   	if($vo['r']==$info['method']) $choose.='<option selected="selected" value="'.$vo['r'].'">'.$vo['name'].'</option>';
					    else $choose.='<option value="'.$vo['r'].'">'.$vo['name'].'</option>';
				    }
				    $this->choose=$choose;
				}
			$this->id=$id;
			$this->info=$info;
			$this->oldparentid=$oldparentid;
			$this->display();
		}else{
			if(empty($_POST['sortname']) || empty($_POST['method'])) $this->error('请填写完整栏目信息！');
			//数据处理
			$data=array();
			$newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid){
				$data=$this->sortmove($newparentid,$id);//分类编辑
			    if(!is_array($data)) $this->error($data);
			} 

			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['method']=in($_POST['method']);
			$data['tplist']=$_POST['tplist'];
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);

			
			//更新数据
			model('sort')->update("id = '$id'",$data);
			$this->success('插件栏目修改成功',url('sort/index'));
		}
	}
    //添加自定义栏目
	public function linkadd()
	{
		$type=5;//栏目类型
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$this->url=url('sort');
			$this->display('sort_linkadd');
		}else{
			if(empty($_POST['sortname']) || empty($_POST['url'])) $this->error('请填写完整栏目信息！');
			$data=array();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['extendid']=intval($_POST['ifout']);
			$data['url']=$_POST['url'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			//插入数据
			if(model('sort')->insert($data)){
				$this->success('外链栏目添加成功~',url('sort/index'));
			}
			else $this->error('外链栏目添加失败~');
		}
	}

	//编辑自定义栏目
	public function linkedit()
	{
		$type=5;//栏目类型
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		if(!$this->checkConPower('sort',$id)) $this->error('当前账户没有权限编辑该自定义栏目~');
		$info=model('sort')->find("id='$id'",'name,norder,path,ifmenu,url,extendid');
		$oldparentid=intval(substr ($info['path'], -6));
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$this->id=$id;
			$this->info=$info;
			$this->oldparentid=$oldparentid;
			$this->display();
		}else{
			if(empty($_POST['sortname']) || empty($_POST['url'])) $this->error('请填写完整栏目信息！');
			//数据处理
			$data=array();
			$newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid){
			    $data=$this->sortmove($newparentid,$id);//分类编辑
			    if(!is_array($data)) $this->error($data);
			} 

			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$data['extendid']=intval($_POST['ifout']);
			$data['url']=$_POST['url'];
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);

			//更新数据
			model('sort')->update("id = '$id'",$data);
			$this->success('外链栏目修改成功',url('sort/index'));
		}
	 }
	 //添加表单
	public function extendadd()
	{
		$type=6;//栏目类型
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$choose=$this->tempchoose(self::$sort[$type]['mark'],'index');
            if(!empty($choose)) $this->choose=$choose;	
            $this->md=self::$sort[$type]['mark'];

			$forminfo = model('extend')->select("type='1' AND pid='0'",'id,name');
			$this->forminfo=$forminfo;
			$this->url=url('sort');
			$this->display('sort_extendadd');
		}else{
			if(empty($_POST['sortname']) || empty($_POST['formid'])) $this->error('请填写完整栏目信息！');
			if($this->ifename($_POST['ename'])) $this->error('栏目英文名已存在~');
			$data=array();
			$maxid=model('sort')->maxid();
			$parentid=intval($_POST['parentid']);
			$data=$this->sortadd($parentid);//分类添加
			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$_POST['ename']=in($_POST['ename']);
            $data['ename']=empty($_POST['ename'])?$maxid+1:$_POST['ename'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['extendid']=intval($_POST['formid']);
			$data['url']=intval($_POST['num']).'|'.in($_POST['jurl']).'|'.in($_POST['mes']);
			$data['method']=empty($_POST['method'])?'extend/index':in($_POST['method']);
			$data['tplist']=$_POST['tplist'];
			$data['norder']=intval($_POST['norder']);
			$data['ifmenu']=intval($_POST['ifmenu']);
			//插入数据
			if(model('sort')->insert($data)){
				$this->success('表单栏目添加成功~',url('sort/index'));
			}
			else $this->error('表单栏目添加失败~');
		}
	}

	//编辑表单
	public function extendedit()
	{
		$type=6;//栏目类型
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('空的类别参数');
		if(!$this->checkConPower('sort',$id)) $this->error('当前账户没有权限编辑该表单栏目~');
		$info=model('sort')->find("id='$id'",'name,ename,keywords,description,norder,path,ifmenu,url,method,tplist,extendid');
		$oldparentid=intval(substr ($info['path'], -6));
		$urls=explode('|', $info['url']);
		$info['url']=intval($urls[0]);
		$info['jurl']=$urls[1];
		$info['mes']=$urls[2];
		if(!$this->isPost())
		{
			$list=model('sort')->select('','id,name,deep,path,norder');
			if(!empty($list)){
				$list=re_sort($list);
				$this->list=$list;
			}
			$tpdef=explode('_',$info['tplist']);
			if(!isset($tpdef[1])) $this->error('非法的模板参数~');
			$choose=$this->tempchoose(self::$sort[$type]['mark'],$tpdef[1]);
            if(!empty($choose)) $this->choose=$choose;	

			$forminfo = model('extend')->select("type='1' AND pid='0'",'id,name');
			$this->forminfo=$forminfo;
			$this->id=$id;
			$this->info=$info;
			$this->md=self::$sort[$type]['mark'];
			$this->oldparentid=$oldparentid;
			$this->display();
		}else{
			if(empty($_POST['sortname']) || empty($_POST['formid'])) $this->error('请填写完整栏目信息！');
			if($info['ename']!=trim($_POST['ename'])) {
				if($this->ifename($_POST['ename'])) $this->error('栏目英文名已存在~');
			}
			//数据处理
			$data=array();
			$newparentid=intval($_POST['parentid']);
			if($oldparentid!=$newparentid){
				 $data=$this->sortmove($newparentid,$id);//分类编辑
			     if(!is_array($data)) $this->error($data);
			}

			$data['type']=$type;
			$data['name']=$_POST['sortname'];
			$_POST['ename']=in($_POST['ename']);
            $data['ename']=empty($_POST['ename'])?$id:$_POST['ename'];
			$data['keywords']=in($_POST['keywords']);
			$data['description']=in($_POST['description']);
			$data['extendid']=intval($_POST['formid']);
			$data['url']=intval($_POST['num']).'|'.in($_POST['jurl']).'|'.in($_POST['mes']);
			if(!empty($_POST['method'])) $data['method']=in($_POST['method']);
			$data['tplist']=$_POST['tplist'];
			$data['ifmenu']=intval($_POST['ifmenu']);
			$data['norder']=intval($_POST['norder']);

			//更新数据
			model('sort')->update("id = '$id'",$data);
			$this->success('表单栏目修改成功',url('sort/index'));
		}
	 }
	private function _del($id){
		if(empty($id)) return '错误的ID参数~';
		if(!$this->checkConPower('sort',$id)) return "当前账户没有权限删除{$id}~"; 
		$condition['id']=$id;
		$target=model('sort')->find($condition,'path,type');
		$where='path = \''.$target['path'].','.$id.'\'';
		if(model('sort')->find($where)) return "请先删除{$id}下的栏目~";
		//判断类下有无内容
		$table=self::$sort[$target['type']]['mark'];
		if(empty($table)) return "{$id}未知类别";
		if($table!='plugin' && $table!='link'&& $table!='extend'){//插件栏目不用做以下操作
			$info=model($table)->find('sort = \''.$target['path'].','.$id.'\'','id');
			if($info){
				$delid=$info['id'];
				if('page'!=$table) return "请先删除{$id}下的内容~";//一栏目对多信息情况
				elseif(!model($table)->delete("id='{$delid}'")) return "{$id}下内容删除失败~";
			}
		}
		if(model('sort')->delete($condition)) return 'done';
		else return "{$id}删除失败~";
	}
	//删除栏目
	public function del()
	{
		if($this->isPost()){
           if('del'!=$_POST['dotype']) $this->error('操作类型错误~',url('sort/index'));
		   if(empty($_POST['delid'])) $this->error('还没有选择栏目~',url('sort/index'));
		   $delid=array_reverse($_POST['delid']);
		   $er='';
		   foreach ($delid as $vo) {
		   	  if(!empty($vo)){
		   		 foreach ($vo as $v) {
		   			$back=$this->_del(intval($v));
		   	        if('done'!=$back) $er.=$back.'<br>';
		   		 }
		   	  }  	  
		   }
		   if($er) $this->error($er,url('sort/index'));
		   else $this->success('栏目删除成功~',url('sort/index'));
		}else{//ajax方式
           $id=intval($_GET['id']);
           $back=$this->_del($id);
           if('done'==$back) echo 1;
           else echo $back;
		}
	}
	//单页编辑器上传
	public function PageUploadJson(){
		$this->EditUploadJson('pages');
	}
	//单页编辑器文件管理
	public function PageFileManagerJson(){
		$this->EditFileManagerJson('pages');
	}
	//图片本地化
	public function pagesaveimage(){
	  if(!empty($_POST['con'])){
		$content=$_POST['con'];
		$path='pages/image/'.date("Ymd");
		if(empty($content)) return;
		echo $this->localimage($content,$path);
	  }
	}
	/*信息位管理开始*/
	public function placelist(){
		$listRows=20;//每页显示的信息条数
		$url=url('sort/placelist',array('page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);

		$count=model('place')->count();
		$list=model('place')->select('','id,name,norder','norder DESC,id DESC',$limit);
		$this->page=$this->pageShow($count);
		$this->list=$list;
		$this->display();
	}
	public function placeadd(){
		if(!$this->isPost()) $this->display();
		else{
			if(empty($_POST['name'])) $this->error('必须填写位置名称~');
			$data['name']=in($_POST['name']);
			$data['norder']=intval($_POST['norder']);
			//插入数据
			if(model('place')->insert($data)) $this->success('信息定位添加成功~',url('sort/placelist'));
			else $this->error('信息定位添加失败~');
		}
	}
	public function placeedit(){
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost())
		{
			$info=model('place')->find("id='$id'");
		    $this->info=$info;
			$this->display();
		}else{
			if(empty($_POST['name'])) $this->error('必须填写位置名称~');
		    $data['name']=in($_POST['name']);
			$data['norder']=intval($_POST['norder']);
			//插入数据
			model('place')->update("id='$id'",$data);
			$this->success('信息定位编辑成功~',url('sort/placelist'));
		}
	}
	public function placedel(){
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(model('place')->delete("id='$id'")) $this->success('定位类型删除成功~',url('sort/placelist'));
		$this->error('删除失败~');
	} 
}
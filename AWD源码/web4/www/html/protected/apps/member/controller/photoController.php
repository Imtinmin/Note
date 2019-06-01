<?php
class photoController extends commonController
{
	static protected $sorttype;//图集栏目类型
	static protected $uploadpath='';//图片上传路径
	static protected $mesprefix='';
	public function __construct()
	{
		parent::__construct();
		if(!$this->auth['account']){
           if(empty($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER']=url('default/index/login');
           $this->error('您还没有登陆~',$_SERVER['HTTP_REFERER']);
        }
		$this->uploadpath=ROOT_PATH.'upload/photos/';
		$this->sorttype=2;
		$this->mesprefix=config('MS_PREFIX');
	}
	//列表
	public function index()
	{
		$listRows=15;//每页显示的信息条数
		$url=url('photo/index',array('page'=>'{page}'));
		$sortlist=model('sort')->select('','id,name,deep,path,norder,type');
		//类别条件
		$sort=in($_GET['sort']);
		//搜索条件
		$keyword=in(urldecode(trim($_GET['keyword'])));
		if(!empty($keyword)) $this->keyword=$keyword;
		//定位条件
		$place=intval($_GET['places']);
		$url=url('photo/index',array('sort'=>$sort,/*'places'=>$place,*/'keyword'=>urlencode($keyword),'page'=>'{page}'));

		if(!empty($sortlist)){
			$sortlist=re_sort($sortlist);
			$sortname=array();
			//栏目选项 
			foreach($sortlist as $vo){
				if($this->checkConPower($vo['id'])){
                    $space = str_repeat('├┈', $vo['deep']-1);
                    $sortnow=$vo['path'].','.$vo['id'];
                    $selected=($sort==$sortnow)?'selected="selected"':'';   
                    $disable=($this->sorttype==$vo['type'])?'':'disabled="disabled" style="background-color:#F0F0F0"';
                    $option.= '<option '.$selected.' value="'.$sortnow.'" '.$disable.'>'.$space.$vo ['name'].'</option>';
                }
                $sortname[$vo['id']]=$vo['name'];
            }
            $this->option=$option;
            $this->sortname=$sortname;
		}
        //定位选项
		// $places=model('place')->select('','id,name','norder desc');
		// if(!empty($places)){
  //          foreach($places as $vo){
  //          	  $selected=($place==$vo['id'])?'selected="selected"':''; 
  //             $poption.= '<option '.$selected.' value="'.$vo['id'].'">'.$vo ['name'].'</option>';
  //          }
  //          $this->poption=$poption;
		// }
		//搜索条件
		$keyword=in(urldecode(trim($_GET['keyword'])));
		if(!empty($keyword)){
			$url=url('photo/index',array('keyword'=>urlencode($keyword),'page'=>'{page}'));
			$this->keyword=$keyword;
		}
		$limit=$this->pageLimit($url,$listRows);
		$count=model('photo')->photocount($this->mesprefix.$this->auth['account'],$sort,/*$place,*/$keyword);
        $list=model('photo')->photoselect($this->mesprefix.$this->auth['account'],$sort,/*$place,*/$keyword,$limit);
        $this->sorts=$this->sortArray();//必须树状菜单
		$this->list= $list;
		$this->count= $count;
		$this->page=$this->pageShow($count);
		$this->url=url('photo');
		$this->display();
	}

	//添加
	public function add()
	{
		if(!$this->isPost()){
			$sortlist=model('sort')->select('','id,name,deep,tplist,path,norder,type');
			if(empty($sortlist)) $this->error('请先添加图集栏目~',url('sort/photoadd'));
			$sortlist=re_sort($sortlist);
            foreach($sortlist as $vo){
            	if($this->checkConPower($vo['id'])){
                    $ct=explode(',',$vo['tplist']);
				    $tpco[$vo['path'].','.$vo['id']]=$ct[1];
                    $space = str_repeat('├┈┈┈', $vo['deep']-1); 
                    $disable=($this->sorttype==$vo['type'])?'':'disabled="disabled" style="background-color:#F0F0F0"';    
                    $option.= '<option '.$disable.' value="'.$vo['path'].','.$vo['id'].'">'.$space.$vo ['name'].'</option>';
                }
            }
            $this->option=$option;
			$this->tpc=json_encode($tpco);//默认模板处理

            //$places=model('place')->select('','','norder DESC');//定位
			// $this->places=$places;
			$this->sortlist=$sortlist;
			$this->type=$this->sorttype;
			$this->twidth=config('thumbMaxwidth');
			$this->theight=config('thumbMaxheight');
			$this->picpath=__ROOT__.'/upload/photos/';
			$this->display();
		}else{
			if(empty($_POST['sort'])||empty($_POST['title'])||empty($_POST['tpcontent']))
			$this->error('请填写完整的信息~');
			$data=array();
			//扩展模型开始
			if (!empty($_POST['tableid'])) {
				$tableid = intval($_POST['tableid']);
				$info = model('extend')->find("id='{$tableid}'",'tableinfo'); //查询表
				$list = model('extend')->select("pid='{$tableid}'",'','id desc'); //查询表中字段
				foreach ($list as $vo) {
					if (!empty($vo['tableinfo'])) {
						if(is_array($_POST['ext_'.$vo['tableinfo']]))
							$fvalue=implode(',',$_POST['ext_'.$vo['tableinfo']]);
						else
						    $fvalue=in($_POST['ext_'.$vo['tableinfo']]);
						$ex_data[$vo['tableinfo']] = empty($fvalue)?$vo['defvalue']:$fvalue; //循环post字段
					}
				}
				$extfield=model('extend')->Extin($info['tableinfo'],$ex_data);
				$data['extfield']=$extfield;
			}
			//扩展模型结束
			$data['account']=$this->mesprefix.$this->auth['account'];
			$data['sort']=in($_POST['sort']);
			$data['exsort']=empty($_POST['exsort'])?'':implode(',',$_POST['exsort']);
			$data['title']=in($_POST['title']);
			$data['keywords']=in($_POST['keywords']);
			$data['picture']=in($_POST['picture']);
			$data['description']=in($_POST['description']);
			$data['content'] = html_in($_POST['content'],true);
			$data['method']='photo/content';
			$data['tpcontent']=in($_POST['tpcontent']);
			$data['ispass']=0;
			$data['recmd']=0;
			$data['hits']=0;
			$data['norder']=0;
			$data['addtime']=time();
            // if (empty($data['description'])) {
            //      $data['description']=in(substr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
            // }
            // if(empty($data['keywords'])){    
            //     $data['keywords']= $this->getkeyword($data['title'].$data['description']); //自动获取中文关键词 
            //     if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
            // }
            // if($_POST['iftag']) {
            //  	$iftag = $this->crtags($data['keywords']);
            //  	if(!$iftag) $this->alert('标签生成失败~');
            //  }
			if(!empty($_POST['photolist']))
			$data['photolist']=implode(',',$_POST['photolist']);
			if(!empty($_POST['conlist']))
			$data['conlist']=implode(',',in($_POST['conlist']));
			if(model('photo')->insert($data))
			$this->jump('图集添加成功~',url('photo/index'),'返回列表',url('photo/add'),'继续添加');
			else $this->error('图集添加失败');
		}
	}

	//编辑
	public function edit()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost()){
			$sortlist=model('sort')->select('','id,name,deep,path,tplist,norder,type');
			if(empty($sortlist)) $this->error('图集分类被清空了~');
			$sortlist=re_sort($sortlist);
			$info=model('photo')->find("id='$id'");
			if($info['account']!=$this->mesprefix.$this->auth['account']) $this->error('请不要越权编辑其他信息~');
			$info['addtime']=date("Y-m-d H:i:s",$info['addtime']);
			if(!empty($info['exsort'])) $exsort=explode(',', $info['exsort']);
			foreach($sortlist as $key=>$vo){
				if($this->checkConPower($vo['id'])){
				   $ct=explode(',',$vo['tplist']);
				   $tpco[$vo['path'].','.$vo['id']]=$ct[1];
                   $space = str_repeat('├┈┈┈', $vo['deep']-1);
                   $disable=($this->sorttype==$vo['type'])?'':'disabled="disabled" style="background-color:#F0F0F0"';
                   $tpath=$vo['path'].','.$vo['id'];
                   $ifselect =($info['sort']==$tpath)?'selected="selected"':'';   
                   $option.= '<option '.$ifselect.' value="'.$tpath.'"'.$disable.'>'.$space.$vo['name'].'</option>';
                   //副栏目
                   if(isset($exsort)) $sortlist[$key]['checked']=in_array($vo['id'],$exsort)?'checked':'';
               }
            }
            $this->option=$option;
            $this->tpc=json_encode($tpco);//默认模板处理

			// $places=model('place')->select('','','norder DESC');//定位
			// $this->places=$places;
			$this->info=$info;
			$this->sortlist=$sortlist;
			$this->type=$this->sorttype;
			$this->twidth=config('thumbMaxwidth');
			$this->theight=config('thumbMaxheight');
			$this->picpath=__ROOT__.'/upload/photos/';
			$this->display();
		}else{
			if(empty($_POST['sort'])||empty($_POST['title'])||empty($_POST['tpcontent']))
			$this->error('请填写完整的信息~');
		    $info=model('photo')->find("id='$id'",'account');
			if($info['account']!=$this->mesprefix.$this->auth['account']) $this->error('请不要越权编辑其他信息~');
			$data=array();
			//扩展模型编辑
			if (!empty($_POST['tableid'])) {
				$tableid = intval($_POST['tableid']);
				$info = model('extend')->find("id='{$tableid}'",'tableinfo'); //查询表
				$list = model('extend')->select("pid='{$tableid}'",'','id desc'); //查询表中字段
				foreach ($list as $vo) {
					if (!empty($vo['tableinfo'])) {
						if(is_array($_POST['ext_'.$vo['tableinfo']]))
							$fvalue=implode(',',$_POST['ext_'.$vo['tableinfo']]);
						else
						    $fvalue=in($_POST['ext_'.$vo['tableinfo']]);
						$ex_data[$vo['tableinfo']] = empty($fvalue)?$vo['defvalue']:$fvalue; //循环post字段
					}
				}
			}
			$extfield=intval($_POST['extfield']);
			if($_POST['sort']==$_POST['oldsort']){//信息没有更换分类
			  if(isset($ex_data)){
			  	  if($extfield) model('extend')->Extup($info['tableinfo'],"id='{$extfield}'",$ex_data);//更新拓展数据
			  	  else $extfield=model('extend')->Extin($info['tableinfo'],$ex_data);
			  }else $extfield=0;
			}else{//信息更换了分类
				if($extfield){//原分类使用了拓展表
				    $oldsid=substr($_POST['oldsort'],-6,6);
				    $oldexid=model('sort')->find("id='{$oldsid}'",'extendid');
				    $oldtable=model('extend')->find("id='{$oldexid['extendid']}'",'tableinfo');
				    model('extend')->Extdel($oldtable['tableinfo'],"id='$extfield'");//删除旧拓展表中关联项目
			    }
			    if(isset($ex_data)){//新栏目也试用拓展表
				    $extfield=model('extend')->Extin($info['tableinfo'],$ex_data);//插入新拓展数据
				        
				}else $extfield=0;
			}
			$data['extfield']=$extfield;
			//扩展模型编辑结束
			$data['sort']=in($_POST['sort']);
			$data['exsort']=empty($_POST['exsort'])?'':implode(',',$_POST['exsort']);
			$data['title']=in($_POST['title']);
			$data['keywords']=in($_POST['keywords']);
			$data['picture']=in($_POST['picture']);
			$data['description']=in($_POST['description']);
			$data['content'] = html_in($_POST['content'],true);
			$data['tpcontent']=in($_POST['tpcontent']);
			
            // if (empty($data['description'])) {
            //     $data['description']=in(substr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
            // }
            // if(empty($data['keywords'])){    
            //     $data['keywords']= $this->getkeyword($data['title'].$data['description']); //自动获取中文关键词 
            //     if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
            // }
            // if($_POST['iftag']) {
            //  	$iftag = $this->crtags($data['keywords']);
            //  	if(!$iftag) $this->alert('标签生成失败~');
            //  }
			if(!empty($_POST['photolist']))
			$data['photolist']=implode(',',$_POST['photolist']);
			else $data['photolist']='';
			if(!empty($_POST['conlist']))
			$data['conlist']=implode(',',in($_POST['conlist']));
			else $data['conlist']='';

			model('photo')->update("id='$id'",$data);
			$this->success('图集编辑成功~',url('photo/index'));
		}
	}
	//ajax拓展字段获取
	public function ex_field(){
		$this->extend_field();
	}
	//图片上传,ajax方式使用
	public function images_upload()
	{
		$ifthumb=intval($_REQUEST['ifthumb']);
		$type=intval($_REQUEST['ttype']);
		$thumbMaxwidth=intval($_REQUEST['width']);
		$thumbMaxheight=intval($_REQUEST['height']);
		$this->AjaxUpload('photos',$ifthumb,$type,$thumbMaxwidth,$thumbMaxheight);
	}
	//单图删除,ajax方式使用
	public function delpic()
	{
		if(empty($_POST['picname'])) $this->error('参数错误~');
		$picname=trim($_POST['picname']);
		if(strstr($picname,"./")||strstr($picname,".\\")) exit('您真闲...');
		$path=$this->uploadpath;
		$lasts=strtolower(substr($picname,-3));
		if(in_array($lasts,array('gif','jpg','png','bmp'))){
			if(file_exists($path.$picname)) @unlink($path.$picname);
		    else exit('图片不存在~');
		    if(file_exists($path.'thumb_'.$picname)) @unlink($path.'thumb_'.$picname);
		    else exit('缩略图不存在~');
		    echo '原图以及缩略图删除成功~';
		}else echo $lasts;
	}
	//图集删除
	public function del()
	{
		$path=$this->uploadpath;
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) echo '参数错误~';
			else{
				$photos=model('photo')->find("id='$id'",'photolist,sort,extfield,account');
				if($photos['account']!=$this->mesprefix.$this->auth['account']){
					echo '请不要越权编辑其他用户信息~';
					return;
				} 
				$sortid=substr($photos['sort'],-6,6);
				$exid=model('sort')->find("id='{$sortid}'",'extendid');
				if($exid['extendid']!=0){
					$table=model('extend')->find("id='{$exid['extendid']}'",'tableinfo');
					if(!empty($table['tableinfo'])){
						if(!($this->model->table($table['tableinfo'])->where("id='{$photos['extfield']}'")->delete())){//删除拓展表中关联信息
						   echo '删除拓展信息失败~';
						   return;
					   }
					}					
				}
				if(!empty($photos['photolist'])){
					$phoarr=explode(',',$photos['photolist']);
					foreach ($phoarr as $vo){
		                if(!strstr($vo,"./")&&!strstr($vo,".\\")){
		                	if(file_exists($path.$vo))
						    @unlink($path.$vo);
						    if(file_exists($path.'thumb_'.$vo))
						    @unlink($path.'thumb_'.$vo);
		                }
					}
				}
				if(model('photo')->delete("id='$id'"))
				echo 1;
				else echo '删除失败~';
			}
		}else{
			if('del'!=$_POST['dotype']) $this->error('操作类型错误~',url('photo/index'));
			if(empty($_POST['delid'])) $this->error('您没有选择~',url('photo/index'));
			foreach($_POST['delid'] as $value){
                $delid .= intval($value).',';
            }
            $delid = substr($delid,0,-1); 
			$photos=model('photo')->select('id in ('.$delid.')','id,photolist,sort,extfield,account');
			$delid='';
			foreach ($photos as $plist){
				if($plist['account']==$this->mesprefix.$this->auth['account']) {
			       $sortid=substr($plist['sort'],-6,6);
				   $exid=model('sort')->find("id='{$sortid}'",'extendid');
				   if($exid['extendid']!=0){
				   	$table=model('extend')->find("id='{$exid['extendid']}'",'tableinfo');
				   	if(!empty($table['tableinfo'])){
				   	   if(!($this->model->table($table['tableinfo'])->where("id='{$plist['extfield']}'")->delete()))//删除拓展表中关联信息
				   	    $this->error('删除ID为'.$info['extfield'].'的拓展信息失败~',url('photo/index'));
				   	}
				   }
				   if(!empty($plist['photolist'])){
				   	  $phoarr=explode(',',$plist['photolist']);
				   	  foreach ($phoarr as $vo){
		                if(!strstr($vo,"./")&&!strstr($vo,".\\")){
				   		    if(file_exists($path.$vo))
				   		    @unlink($path.$vo);
				   		    if(file_exists($path.'thumb_'.$vo))
				   		    @unlink($path.'thumb_'.$vo);
				        }
				   	  }
				   }
				   $delid.=$plist['id'].',';
			    }
			}
			if($delid){
				$delid=substr($delid, 0,-1);
			    if(model('photo')->delete('id in ('.$delid.')'))
			    $this->success('删除成功',url('photo/index'));
			    else $this->error('删除失败');
			}else $this->error('请不要越权删除其他信息~');
		}
	}
	public function colchange()
	{
		 if('change'!=$_POST['dotype']) $this->error('操作类型错误~',url('photo/index'));
         if(empty($_POST['delid'])||empty($_POST['col'])) $this->error('您没有选择~',url('photo/index'));
         foreach($_POST['delid'] as $value){
            $changeid .= intval($value).',';
         }
         $changeid = substr($changeid,0,-1);
		 $data['sort']=$_POST['col'];
		 model('photo')->update("id in ('".$changeid."') and account='".$this->mesprefix.$this->auth['account']."'",$data);
		 $this->success('栏目移动成功~',url('photo/index'));
	}
}
<?php
class photoController extends commonController
{
	static protected $sorttype;//图集栏目类型
	static protected $uploadpath='';//图片上传路径
	public function __construct()
	{
		parent::__construct();
		$this->uploadpath=ROOT_PATH.'upload/photos/';
		$this->sorttype=2;
	}
	//列表
	public function index()
	{
		$listRows=20;//每页显示的信息条数
		$url=url('photo/index',array('page'=>'{page}'));
		$sortlist=model('sort')->select('','id,name,ename,deep,path,norder,type');
		//类别条件
		$sort=in(urldecode($_GET['sort']));
		//搜索条件
		$keyword=in(urldecode(trim($_GET['keyword'])));
		if(!empty($keyword)) $this->keyword=$keyword;
		//定位条件
		$place=intval($_GET['places']);
		$url=url('photo/index',array('sort'=>$sort,'places'=>$place,'keyword'=>urlencode($keyword),'page'=>'{page}'));

		if(!empty($sortlist)){
			$sortlist=re_sort($sortlist);
			$sortinfo=array();
			//栏目选项
			foreach($sortlist as $vo){
                $space = str_repeat('├┈', $vo['deep']-1);
                $sortnow=$vo['path'].','.$vo['id'];
                $selected=($sort==$sortnow)?'selected="selected"':'';   
                $disable=($this->sorttype==$vo['type'])?($this->checkConPower('sort',$vo['id']))?'':'disabled="disabled" style="background-color:#F0F0F0"':'disabled="disabled"';
                $option.= '<option '.$selected.' value="'.$sortnow.'" '.$disable.'>'.$space.$vo ['name'].'</option>';

                $sortinfo[$vo['id']]['name']=$vo['name'];
                $sortinfo[$vo['id']]['ename']=$vo['ename'];
            }
            $this->option=$option;
            $this->sortinfo=$sortinfo;
		}
        //定位选项
		$places=model('place')->select('','id,name','norder desc');
		if(!empty($places)){
           foreach($places as $vo){
           	  $selected=($place==$vo['id'])?'selected="selected"':''; 
              $poption.= '<option '.$selected.' value="'.$vo['id'].'">'.$vo ['name'].'</option>';
           }
           $this->poption=$poption;
		}
		//搜索条件
		$keyword=in(urldecode(trim($_GET['keyword'])));
		if(!empty($keyword)){
			$url=url('photo/index',array('keyword'=>urlencode($keyword),'page'=>'{page}'));
			$this->keyword=$keyword;
		}
		$limit=$this->pageLimit($url,$listRows);
		$count=model('photo')->photocount($sort,$place,$keyword);
        $list=model('photo')->photoANDadmin($sort,$place,$keyword,$limit);
		$this->list= $list;
		$this->count= $count;
		$this->page=$this->pageShow($count);
		$this->url=url('photo');
		$this->display();
	}

	//添加
	public function add()
	{
		if(empty($_POST)){
			$sortlist=model('sort')->select("",'id,name,picwidth,picheight,deep,tplist,path,norder,type');
			if(empty($sortlist)) $this->error('请先添加图集栏目~',url('sort/add'));
			$sortlist=re_sort($sortlist);
            foreach($sortlist as $vo){
                 $ct=explode(',',$vo['tplist']);
                 $paths=$vo['path'].','.$vo['id'];
				 $tpco[$paths]['n']=$ct[1];
				 $tpco[$paths]['w']=$vo['picwidth'];
                 $tpco[$paths]['h']=$vo['picheight'];
				 $select=($paths==urldecode($_GET['sort']))?'selected':'';
                 $space = str_repeat('├┈┈┈', $vo['deep']-1); 
                 $disable=($this->sorttype==$vo['type'])?($this->checkConPower('sort',$vo['id']))?'':'disabled="disabled" style="background-color:#F0F0F0"':'disabled="disabled"';    
                 $option.= '<option '.$disable.' value="'.$paths.'" '.$select.'>'.$space.$vo ['name'].'</option>';
            }
            $this->option=$option;
			$this->tpc=json_encode($tpco);//默认模板和图片长宽处理
			
			$choose=$this->tempchoose('photo','content');
            if(!empty($choose)) $this->choose=$choose;	

            $places=model('place')->select('','','norder DESC');//定位
			$this->places=$places;
			$this->sortlist=$sortlist;
			$this->type=$this->sorttype;
			$this->twidth=config('thumbMaxwidth');
			$this->theight=config('thumbMaxheight');
			$this->picpath=__ROOT__.'/upload/photos/';
			$this->display();
		}else{
			if(empty($_POST['sort'])||empty($_POST['title'])||empty($_POST['method'])||empty($_POST['tpcontent']))
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
						$ex_data[$vo['tableinfo']] = empty($fvalue)?$vo['defvalue']?$vo['defvalue']:'':$fvalue; //循环post字段
					}
				}
				$extfield=model('extend')->Extin($info['tableinfo'],$ex_data);
				$data['extfield']=$extfield;
			}
			//扩展模型结束
			$data['places']=empty($_POST['places'])?'':implode(',',$_POST['places']);
			$data['account']=$_SESSION['admin_username'];
			$data['sort']=$_POST['sort'];
			$data['exsort']=empty($_POST['exsort'])?'':implode(',',$_POST['exsort']);
			$data['title']=in($_POST['title']);
			$data['color']=$_POST['color'];
			$data['keywords']=in($_POST['keywords']);
			$data['picture']=in($_POST['picture']);
			$data['description']=in($_POST['description']);
			if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes(html_in($_POST['content']));
			} else {
				$data['content'] = html_in($_POST['content']);
			}
			if(!empty($_POST['iflink'])){
               $tags=model('tags')->select("url!=''","name,url");
               if(!empty($tags)){
               	 foreach ($tags as $tag) {
               	 	$tag['url']=Check::url($tag['url'])?$tag['url']:url($tag['url']);
               	 	$data['content']=str_replace($tag['name'], '<a href="'.$tag['url'].'">'.$tag['name'].'</a>', $data['content']);
               	 }
               }
			}
			$data['method']=in($_POST['method']);
			$data['tpcontent']=in($_POST['tpcontent']);
			$data['ispass']=empty($_POST['ispass'])?0:1;
			$data['recmd']=empty($_POST['recmd'])?0:1;
			$data['hits']=intval(in($_POST['hits']));
			$data['norder']=intval(in($_POST['norder']));
			$data['addtime']=strtotime(in($_POST['addtime']));

			$_POST['releids']= str_replace('，',',',in($_POST['releids']));
			$releids=explode(',', $_POST['releids']);
			if(!empty($releids)){
				$data['releids']='';
				foreach ($releids as $vo) {
				   $vo=intval($vo);
				   $data['releids'].=$vo?$data['releids']?','.$vo:$vo:'';
			   }
			}	
            if (empty($data['description'])) {
                 $data['description']=in(msubstr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
            }
            if(empty($data['keywords'])){    
                $data['keywords']= $this->getkeyword($data['title'].$data['description']); //自动获取中文关键词 
                if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
            }
            if($_POST['iftag']) {
             	$iftag = $this->crtags($data['keywords']);
             	//if(!$iftag) $this->alert('标签生成失败~');
             }
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
		if(empty($_POST)){
			$sortlist=model('sort')->select('','id,name,picwidth,picheight,deep,tplist,path,norder,type');
			if(empty($sortlist)) $this->error('图集分类被清空了~');
			$sortlist=re_sort($sortlist);
			$info=model('photo')->find("id='$id'");
			if(!$this->checkConPower('sort',substr($info['sort'], strrpos($info['sort'],',')+1))) $this->error('没有权限编辑~');
			$info['addtime']=date("Y-m-d H:i:s",$info['addtime']);
			if(!empty($info['exsort'])) $exsort=explode(',', $info['exsort']);
			$pid=substr($info['sort'], -6);
			foreach($sortlist as $key=>$vo){
				  $ct=explode(',',$vo['tplist']);
                  $space = str_repeat('├┈┈┈', $vo['deep']-1);
                  $disable=($this->sorttype==$vo['type'])?($this->checkConPower('sort',$vo['id']))?'':'disabled="disabled" style="background-color:#F0F0F0"':'disabled="disabled"';
                  $tpath=$vo['path'].','.$vo['id'];
                  $tpco[$tpath]['n']=$ct[1];
                  $tpco[$tpath]['w']=$vo['picwidth'];
                  $tpco[$tpath]['h']=$vo['picheight'];
                  $ifselect =($info['sort']==$tpath)?'selected="selected"':'';   
                  $option.= '<option '.$ifselect.' value="'.$tpath.'"'.$disable.'>'.$space.$vo['name'].'</option>';
                  //副栏目
                  if(isset($exsort)) $sortlist[$key]['checked']=in_array($vo['id'],$exsort)?'checked':'';
                  //图片大小
                  if($pid==$vo['id']) {
                  	$twidth=$vo['picwidth'];
			        $theight=$vo['picheight'];
                  }
            }
            $this->option=$option;
            $this->tpc=json_encode($tpco);//默认模板和图片长宽处理
			$tpdef=explode('_',$info['tpcontent']);
			if(!isset($tpdef[1])) $this->error('非法的模板参数~');
			$choose=$this->tempchoose('photo',$tpdef[1]);
            if(!empty($choose)) $this->choose=$choose;	

			$places=model('place')->select('','','norder DESC');//定位
			$this->places=$places;
			$this->info=$info;
			$this->sortlist=$sortlist;
			$this->type=$this->sorttype;
			$this->twidth=$twidth?$twidth:config('thumbMaxwidth');
			$this->theight=$theight?$theight:config('thumbMaxheight');
			$this->picpath=__ROOT__.'/upload/photos/';
			$this->display();
		}else{
			if(empty($_POST['sort'])||empty($_POST['title']))
			$this->error('请填写完整的信息~');
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
			$data['places']=empty($_POST['places'])?'':implode(',',$_POST['places']);
			$data['account']=$_SESSION['admin_username'];
			$data['sort']=$_POST['sort'];
			$data['exsort']=empty($_POST['exsort'])?'':implode(',',$_POST['exsort']);
			$data['title']=in($_POST['title']);
			$data['color']=$_POST['color'];
			$data['keywords']=in($_POST['keywords']);
			$data['picture']=in($_POST['picture']);
			$data['description']=in($_POST['description']);
			if (get_magic_quotes_gpc()) {
				$data['content'] = stripslashes(html_in($_POST['content']));
			} else {
				$data['content'] = html_in($_POST['content']);
			}
			if(!empty($_POST['iflink'])){
               $tags=model('tags')->select("url!=''","name,url");
               if(!empty($tags)){
               	 foreach ($tags as $tag) {
               	 	$tag['url']=Check::url($tag['url'])?$tag['url']:url($tag['url']);
               	 	$data['content']=str_replace($tag['name'], '<a href="'.$tag['url'].'">'.$tag['name'].'</a>', $data['content']);
               	 }
               }
			}
			$data['method']=in($_POST['method']);
			$data['tpcontent']=in($_POST['tpcontent']);
			$data['ispass']=empty($_POST['ispass'])?0:1;
			$data['recmd']=empty($_POST['recmd'])?0:1;
			$data['hits']=intval(in($_POST['hits']));
			$data['norder']=intval(in($_POST['norder']));
			$data['addtime']=strtotime(in($_POST['addtime']));

			$_POST['releids']= str_replace('，',',',in($_POST['releids']));
			$releids=explode(',', $_POST['releids']);
			if(!empty($releids)){
				$data['releids']='';
				foreach ($releids as $vo) {
				   $vo=intval($vo);
				   $data['releids'].=$vo?$data['releids']?','.$vo:$vo:'';
			   }
			}	
            if (empty($data['description'])) {
                $data['description']=in(msubstr(deletehtml($_POST['content']), 0, 250)); //自动提取描述   
            }
            if(empty($data['keywords'])){    
                $data['keywords']= $this->getkeyword($data['title'].$data['description']); //自动获取中文关键词 
                if(empty($data['keywords'])) $data['keywords']=str_replace(' ',',',$data['description']);//非中文
            }
            if($_POST['iftag']) {
             	$iftag = $this->crtags($data['keywords']);
             	//if(!$iftag) $this->alert('标签生成失败~');
             }
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
	//编辑点击
	public function orderchange()
	{
		$id=intval($_POST['id']);
		$data['norder']=intval($_POST['order']);
		model('photo')->update("id='{$id}'",$data);
		echo 1;
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
		$picname=$_POST['picname'];
		$path=$this->uploadpath;
		if(file_exists($path.$picname))
		  @unlink($path.$picname);
		else{echo '图片不存在~';return;} 
		if(file_exists($path.'thumb_'.$picname))
		   @unlink($path.'thumb_'.$picname);
		else {echo '缩略图不存在~';return;}
		echo '原图以及缩略图删除成功~';
	}
	//图集删除
	public function del()
	{
		$path=$this->uploadpath;
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) echo '参数错误~';
			else{
				$photos=model('photo')->find("id='$id'",'photolist,sort,extfield');
				$sortid=substr($photos['sort'],-6,6);
				if(!$this->checkConPower('sort',$sortid)) {
				    echo '没有权限删除~';
				    return;
			     }
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
						if(file_exists($path.$vo))
						@unlink($path.$vo);
						if(file_exists($path.'thumb_'.$vo))
						@unlink($path.'thumb_'.$vo);
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
			$photos=model('photo')->select('id in ('.$delid.')','photolist,sort,extfield');
			foreach ($photos as $plist){
			    $sortid=substr($plist['sort'],-6,6);
				$exid=model('sort')->find("id='{$sortid}'",'extendid');
				if($exid['extendid']!=0){
					$table=model('extend')->find("id='{$exid['extendid']}'",'tableinfo');
					if(!empty($table['tableinfo'])){
					   if(!($this->model->table($table['tableinfo'])->where("id='{$plist['extfield']}'")->delete()))//删除拓展表中关联信息
					    $this->alert('删除ID为'.$info['extfield'].'的拓展信息失败~',url('photo/index'));
					}
				}
				if(!empty($plist['photolist'])){
					$phoarr=explode(',',$plist['photolist']);
					foreach ($phoarr as $vo){
						if(file_exists($path.$vo))
						@unlink($path.$vo);
						if(file_exists($path.'thumb_'.$vo))
						@unlink($path.'thumb_'.$vo);
					}
				}
			}
			if(model('photo')->delete('id in ('.$delid.')'))
			$this->success('删除成功',url('photo/index'));
			else $this->error('删除失败');
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
		 model('photo')->update('id in ('.$changeid.')',$data);
		 $this->success('栏目移动成功~',url('photo/index'));
	}
	//编辑器上传
	public function UploadJson(){
		$this->EditUploadJson('photos');
	}
	//编辑器文件管理
	public function FileManagerJson(){
		$this->EditFileManagerJson('photos');
	}
	//审核,ajax
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['ispass']=intval($_POST['ispass']);
		if(model('photo')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}
	//推荐，ajax
	public function recmd()
	{
		$id=intval($_POST['id']);
		$recmd['recmd']=intval($_POST['recmd']);
		if(model('photo')->update("id='{$id}'",$recmd))
		echo 1;
		else echo '操作失败~';
	}
}
<?php
class newsController extends commonController
{
	static protected $sorttype;//资讯栏目类型
	static protected $uploadpath='';//封面图路径
    static public $nopic='';//前台模板路径
	public function __construct()
	{
		parent::__construct();
		$this->uploadpath=ROOT_PATH.'upload/news/image/';
        $this->nopic='NoPic.gif';//默认封面
		$this->sorttype=1;
	}
	//列表
	public function index()
	{
		$listRows=20;//每页显示的信息条数
		$url=url('news/index',array('page'=>'{page}'));
		$sortlist=model('sort')->select('','id,name,ename,deep,path,norder,type');
		//类别条件
		$sort=in(urldecode($_GET['sort']));
		//搜索条件
		$keyword=in(urldecode(trim($_GET['keyword'])));
		if(!empty($keyword)) $this->keyword=$keyword;
		//定位条件
		$place=intval($_GET['places']);

		$url=url('news/index',array('sort'=>$sort,'places'=>$place,'keyword'=>urlencode($keyword),'page'=>'{page}'));
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

		$limit=$this->pageLimit($url,$listRows);
		$count=model('news')->newscount($sort,$place,$keyword);
        $list=model('news')->newsANDadmin($sort,$place,$keyword,$limit);

		$this->list = $list;
		$this->count = $count;
		$this->path = __ROOT__.'/upload/news/image/';
		$this->public = __PUBLICAPP__;
		$this->page = $this->pageShow($count);
		$this->display();
	}

	//添加
	public function add()
	{
		if(!$this->isPost()){
			$sortlist=model('sort')->select("",'id,name,deep,tplist,path,norder,type');
			if(empty($sortlist))  $this->error('请先添加文章栏目~',url('sort/add'));
			$sortlist=re_sort($sortlist);
            foreach($sortlist as $vo){
                 $ct=explode(',',$vo['tplist']);
                 $paths=$vo['path'].','.$vo['id'];
				 $tpco[$paths]=$ct[1];
				 $select=($paths==urldecode($_GET['sort']))?'selected':'';
                 $space = str_repeat('├┈┈┈', $vo['deep']-1); 
                 $disable=($this->sorttype==$vo['type'])?($this->checkConPower('sort',$vo['id']))?'':'disabled="disabled" style="background-color:#F0F0F0"':'disabled="disabled"';    
                 $option.= '<option '.$disable.' value="'.$paths.'" '.$select.'>'.$space.$vo ['name'].'</option>';
            }
            $this->option=$option;
			$this->tpc=json_encode($tpco);//默认模板处理
			$choose=$this->tempchoose('news','content');
            if(!empty($choose)) $this->choose=$choose;
			
			$places=model('place')->select('','','norder DESC');//定位
			$this->places=$places;
			$this->type=$this->sorttype;
			$this->sortlist=$sortlist;
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
			$data['origin']=empty($_POST['origin'])?'原创':in($_POST['origin']);
			$data['keywords']=in($_POST['keywords']);
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
			if(empty($_FILES['picture']['name']) === false){
                $tfile=date("Ymd");
				$imgupload= $this->upload($this->uploadpath.$tfile.'/',config('imgupSize'),'jpg,bmp,gif,png');
                $imgupload->saveRule='thumb_'.time();
				$imgupload->upload();
				$fileinfo=$imgupload->getUploadFileInfo();
				$errorinfo=$imgupload->getErrorMsg();
				if(!empty($errorinfo)){ 
                   $data['picture']=$this->nopic;
                   $this->alert($errorinfo);
                }
				else $data['picture']=$tfile.'/'.$fileinfo[0]['savename'];
			}elseif(!empty($_POST['ifget'])){
                	$firstpath=in($this->onepic(html_out($data['content']),intval($_POST['getnum'])));
                	if(!empty($firstpath)){
                		$lastlocation=strrpos($firstpath,'/');
                        $timefile=substr($firstpath,$lastlocation-8,8);
                        $covername=substr($firstpath,$lastlocation+1);
                        if(file_exists($this->uploadpath.$timefile.'/'.$covername)){
                            @copy($this->uploadpath.$timefile.'/'.$covername, $this->uploadpath.$timefile.'/thumb_'.$covername);//复制第一张图片为缩略图 
                            $data['picture']= $timefile.'/thumb_'.$covername;  
                        }
                        else $data['picture']=$this->nopic;
                	}
             }

             if(empty($data['picture'])){
             	if(Check::url($_POST['picurl'])){
             	 //$this->alert($_POST['picurl']);
             	 $data['picture']=in($_POST['picurl']);
               }else $data['picture']=$this->nopic;
             }
               
			if(model('news')->insert($data))
			$this->jump('资讯添加成功~',url('news/index'),'返回列表',url('news/add'),'继续添加');
			else $this->error('资讯添加失败');
		}
	}

	//编辑
	public function edit()
	{
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost()){
			$sortlist=model('sort')->select('','id,name,picwidth,picheight,deep,tplist,path,norder,type');
			if(empty($sortlist)) $this->error('资讯分类被清空了');
			$sortlist=re_sort($sortlist);
			$info=model('news')->find("id='$id'");
			if(!$this->checkConPower('sort',substr($info['sort'], strrpos($info['sort'],',')+1))) $this->error('没有权限编辑~');
			$info['addtime']=date("Y-m-d H:i:s",$info['addtime']);
			if(!empty($info['exsort'])) $exsort=explode(',', $info['exsort']);
			$pid=substr($info['sort'], -6);
			foreach($sortlist as $key=>$vo){
				  $ct=explode(',',$vo['tplist']);
                  $space = str_repeat('├┈┈┈', $vo['deep']-1);
                  $disable=($this->sorttype==$vo['type'])?($this->checkConPower('sort',$vo['id']))?'':'disabled="disabled" style="background-color:#F0F0F0"':'disabled="disabled"';
                  $tpath=$vo['path'].','.$vo['id'];
                  $tpco[$tpath]=$ct[1];
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
            $this->tpc=json_encode($tpco);//默认模板处理
			$tpdef=explode('_',$info['tpcontent']);
			if(!isset($tpdef[1])) $this->error('非法的模板参数~');
			$choose=$this->tempchoose('news',$tpdef[1]);
            if(!empty($choose)) $this->choose=$choose;	

            $places=model('place')->select('','','norder DESC');//定位
			$this->places=$places;
			$this->info=$info;
			$this->sortlist=$sortlist;
			$this->type=$this->sorttype;
            $this->twidth=$twidth?$twidth:config('sortMaxwidth');
			$this->theight=$theight?$theight:config('sortMaxheight');
			$this->path=__ROOT__.'/upload/news/image/';
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
			//$data['account']=$_SESSION['admin_username'];
			$data['places']=empty($_POST['places'])?'':implode(',',$_POST['places']);
			$data['sort']=$_POST['sort'];
			$data['exsort']=empty($_POST['exsort'])?'':implode(',',$_POST['exsort']);
			$data['title']=in($_POST['title']);
			$data['color']=$_POST['color'];
			$data['origin']=empty($_POST['origin'])?'原创':in($_POST['origin']);
			$data['keywords']=in($_POST['keywords']);
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
			if(empty($_FILES['picture']['name']) === false){
                $tfile=date("Ymd");
				$imgupload= $this->upload($this->uploadpath.$tfile.'/',config('imgupSize'),'jpg,bmp,gif,png');
                $imgupload->saveRule='thumb_'.time();
				$imgupload->upload();
				$fileinfo=$imgupload->getUploadFileInfo();
				$errorinfo=$imgupload->getErrorMsg();
				if(!empty($errorinfo)) $this->alert($errorinfo);
				else {
					if(!empty($_POST['oldpicture']) && $_POST['oldpicture']!=$this->nopic){
					   $picpath=$this->uploadpath.$_POST['oldpicture'];
					   if(file_exists($picpath)) @unlink($picpath);
				    }
					$data['picture']=$tfile.'/'.$fileinfo[0]['savename'];
				}
			}elseif(!empty($_POST['ifget'])){ 
                     $firstpath=in($this->onepic(html_out($data['content']),intval($_POST['getnum'])));
                    if(!empty($firstpath)){
                        $lastlocation=strrpos($firstpath,'/');
                        $timefile=substr($firstpath,$lastlocation-8,8);
                        $covername=substr($firstpath,$lastlocation+1);
                        if(file_exists($this->uploadpath.$timefile.'/'.$covername)){
                            @copy($this->uploadpath.$timefile.'/'.$covername, $this->uploadpath.$timefile.'/thumb_'.$covername);//复制第一张图片为缩略图 
                            if(!empty($_POST['oldpicture']) && $_POST['oldpicture']!=$this->nopic){
					           $picpath=$this->uploadpath.$_POST['oldpicture'];
					           if(file_exists($picpath)) @unlink($picpath);
				            }
                            $data['picture']= $timefile.'/thumb_'.$covername;  
                        }
                    }
            }
            if(empty($data['picture']) && Check::url($_POST['picurl'])) {
            	 $data['picture']=in($_POST['picurl']);
            	 if(!empty($_POST['oldpicture']) && $_POST['oldpicture']!=$this->nopic){
					 $picpath=$this->uploadpath.$_POST['oldpicture'];
					 if(file_exists($picpath)) @unlink($picpath);
				 }
            }
			model('news')->update("id='$id'",$data);
			$this->success('资讯编辑成功~',url('news/index'));
		}
	}

	//删除
	public function del()
	{
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)){
				echo '参数错误~';
				return;
			}
			$info=model('news')->find("id='$id'",'sort,picture,extfield');
            
			$sortid=substr($info['sort'],-6,6);
			if(!$this->checkConPower('sort',$sortid)) {
				echo '没有权限删除~';
				return;
			}
			$exid=model('sort')->find("id='{$sortid}'",'extendid');
			if($exid['extendid']!=0){
				$table=model('extend')->find("id='{$exid['extendid']}'",'tableinfo');
				if(!empty($table['tableinfo'])){
				   if(!(model('extend')->Extdel($table['tableinfo'],"id='{$info['extfield']}'"))){//删除拓展表中关联信息
					  echo '删除拓展信息失败~';
					  return;
				   }
			    }
			}
			if(!empty($info['picture']) && 'NoPic.gif'!=$info['picture']){
				$picpath=$this->uploadpath.$info[picture];
				if(file_exists($picpath)) @unlink($picpath);
			}
			if(model('news')->delete("id='$id'"))
			echo 1;
			else echo '删除失败~';
		}else{
			if('del'!=$_POST['dotype']) $this->error('操作类型错误~',url('news/index'));
			if(empty($_POST['delid'])) $this->error('您没有选择~',url('news/index'));
			foreach($_POST['delid'] as $value){
                $delid .= intval($value).',';
            }
            $delid = substr($delid,0,-1); 
			$list=model('news')->select('id in ('.$delid.')','sort,picture,extfield');
			foreach($list as $vo){
				$sortid=substr($vo['sort'],-6,6);
				$exid=model('sort')->find("id='{$sortid}'",'extendid');
				if($exid['extendid']!=0){
					$table=model('extend')->find("id='{$exid['extendid']}'",'tableinfo');
					if(!empty($table['tableinfo'])){
					   if(!(model('extend')->Extdel($table['tableinfo'],"id='{$vo['extfield']}'")))//删除拓展表中关联信息
					    $this->alert('删除ID为'.$info['extfield'].'的拓展信息失败~',url('news/index'));
					}
				}
				
				if(!empty($vo['picture']) && 'NoPic.gif'!=$vo['picture']){
					$picpath=$this->uploadpath.$vo[picture];
					if(file_exists($picpath)) @unlink($picpath);
				}
			}
			if(model('news')->delete('id in ('.$delid.')'))
			$this->success('删除成功',url('news/index'));
		}
	}
	public function colchange()
	{
		 if('change'!=$_POST['dotype']) $this->error('操作类型错误~',url('news/index'));
         if(empty($_POST['delid'])||empty($_POST['col'])) $this->error('您没有选择~',url('news/index'));
		 foreach($_POST['delid'] as $value){
            $changeid .= intval($value).',';
         }
         $changeid = substr($changeid,0,-1);
		 $data['sort']=$_POST['col'];
		 model('news')->update('id in ('.$changeid.')',$data);
		 $this->success('栏目移动成功~',url('news/index'));
	}

	//审核,ajax
	public function lock()
	{
		$id=intval($_POST['id']);
		$lock['ispass']=intval($_POST['ispass']);
		if(model('news')->update("id='{$id}'",$lock))
		echo 1;
		else echo '操作失败~';
	}

	//推荐，ajax
	public function recmd()
	{
		$id=intval($_POST['id']);
		$recmd['recmd']=intval($_POST['recmd']);
		if(model('news')->update("id='{$id}'",$recmd))
		echo 1;
		else echo '操作失败~';
	}
	//编辑点击
	public function orderchange()
	{
		$id=intval($_POST['id']);
		$data['norder']=intval($_POST['order']);
		model('news')->update("id='{$id}'",$data);
		echo 1;
	}
	//编辑器上传
	public function UploadJson(){
		$this->EditUploadJson('news');
	}
	//编辑器文件管理
	public function FileManagerJson(){
		$this->EditFileManagerJson('news');
	}
	//图片本地化
	public function saveimage(){
	  if(!empty($_POST['con'])){
		$content=$_POST['con'];
		$path='news/image/'.date("Ymd");
		if(empty($content)) return;
		echo $this->localimage($content,$path);
	  }
	}
	//ajax拓展字段获取
	public function ex_field(){
		$this->extend_field();
	}
	//封面图剪切
	public function cutcover()
	{
		//文件保存目录
		$picname=in($_POST['name']);
		$thumb_image_location=$large_image_location=$this->uploadpath.$picname;
		$thumb_width=intval($_POST["thumb_w"]);//剪切后图片宽度
		$x1 = intval($_POST["x1"]);
		$y1 = intval($_POST["y1"]);
		$w =intval($_POST["w"]);
		$h = intval($_POST["h"]);
		if(empty($thumb_width)||empty($w)||empty($h)) exit(0);
		$scale = $thumb_width/$w;
		$cropped = resizeThumbnailImage($thumb_image_location,$large_image_location,$w,$h,$x1,$y1,$scale);
		if(empty($cropped)) echo 0;
		else echo $picname;
	}
	//封面图删除
	public function delcover()
	{
		//文件保存目录
		$id=in($_POST['id']);
		$pic=in($_POST['pic']);
		$data['picture']= $this->nopic;
		if(model('news')->update("id='$id'",$data)){
			if(!Check::url($pic)){
				$picpath=$this->uploadpath.$pic;
			    if(file_exists($picpath)) @unlink($picpath);
			}
			echo 1;
		}else echo '删除封面失败~';
	}
}
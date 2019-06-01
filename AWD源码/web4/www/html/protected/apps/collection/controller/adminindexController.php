<?php
class adminindexController extends appadminController{
	protected $layout = 'layout';
	 //获取app模版下全部模版
    protected function temps($appname='default'){
        $config=require(BASE_PATH.'apps/'.$appname.'/config.php');
		if(empty($config['TPL']['TPL_TEMPLATE_PATH'])) $templepath=BASE_PATH.'apps/'.$appname.'/view';
		else $templepath=BASE_PATH.'apps/'.$appname.'/view/'.$config['TPL']['TPL_TEMPLATE_PATH'];
		if(is_dir($templepath)){
				$temps=getFileName($templepath.'/');//前台模板列表
                if(empty($temps)) $this->error('前台模板文件夹为空~');
                $temple=array();
				foreach ($temps as $vo){
					  $tp=substr($vo['name'],0,strrpos($vo['name'],config('TPL_TEMPLATE_SUFFIX')));
					  if(!empty($tp)){
					  	$tps=explode('_',$tp);
					  if(isset($tps[1])) $temple[$tps[0]][]=$tps[1];
					  }	     
				}
		}else $this->error('前台模板文件夹不存在~');
		return $temple;
	}
   //信息添加，编辑时获得模板选项
    protected function TempNewAndPhoto($default='index'){
         $temparray=$this->temps();
         $choose='';
         $marks=array('photo','news');
         foreach ($marks as $mark) {
         	 if(!empty($temparray[$mark])) {
         	    foreach ($temparray[$mark] as $vo) {
         		    $select='';
         		    if($vo==$default) //默认模板
         		       $select='selected="selected"';
                    $choose.='<option '.$select.' value="'.$mark.'_'.$vo.'">'.$mark.'_'.$vo.'</option>';
         	    }
            }
         }
         return $choose;
    }

   //信息添加或者编辑时ajax获取拓展字段信息
	protected function extend_field()
	{
		$id=intval(in($_POST['sid']));//分类id
		$exmesid=intval(in($_POST['extfield']));//拓展表记录id
		$info = model('sort')->find("id='{$id}'",'extendid');
		$extendid = $info['extendid']; //取得字段
		if($extendid==0) echo json_encode($info['extendid']);//判断是否为字段
		else{
			$fieldlist = model('extend')->select("pid='{$extendid}'","","norder DESC");
			if(!empty($exmesid)&& !empty($fieldlist)){//如果是编辑信息，取出字段值
				$extableinfo= model('extend')->find("id='{$extendid}'",'tableinfo','pid');//找到拓展表名
				$extinfo=model('extend')->Extfind($extableinfo['tableinfo'],"id='{$exmesid}'");
				for($i=0;$i<count($fieldlist);$i++){//将默认值替换为查询值
					if(($fieldlist[$i]['type']!=4) && ($fieldlist[$i]['type']!=6)){
						$fieldlist[$i]['defvalue']=$extinfo[$fieldlist[$i]['tableinfo']];
					}else{
						$fieldlist[$i]['choosevalue']=$extinfo[$fieldlist[$i]['tableinfo']];//如果是下拉框，加入选中值
					}
				}
			}
			echo json_encode($fieldlist);//输出
		}
	}
    //获取keywords
    protected function getkeyword($content='')
    {
        if(!empty($content)){
        	$segment = new Segment();
            $key=$segment->get_keyword(iconv('utf-8','gbk',$content));
            $tag=iconv('gbk','utf-8',str_replace(" ", ",", $key));
            return $tag;
        }
        return '';
    }
     //编辑器获得第n张图
    protected function onepic($content,$num=1)
    {
    	$num=empty($num)?1:intval($num);
        $ext = 'gif|jpg|jpeg|bmp|png';
        preg_match_all("/(href|src)=([\"|']?)([^ \"'>]+\.($ext))\\2/i",html_out($content), $matches); 
        return $matches[3][$num-1];
    }
    //抓取远程图
    protected function localimage($content='',$path=''){
        //文件路径
        $file_path = ROOT_PATH.'upload/'.$path.'/';
        //文件URL路径
        $file_url = __UPLOAD__.'/'.$path.'/';
        $body=html_out($content);
        $img_array = array();
        preg_match_all("/(src|SRC)=[\"|'| ]{0,}(http:\/\/(.*)\.(gif|jpg|jpeg|bmp|png))/isU",$body,$img_array);
        $img_array = array_unique($img_array[2]);
        set_time_limit(0);
        $milliSecond = date("YmdHis").'_';
        if(!is_dir($file_path)) @mkdir($file_path,0777,true);
        foreach($img_array as $key =>$value)
        {
            $value = trim($value);
            $ext=explode('.', $value);
            $ext=end($ext);
            $get_file = @Http::doGet($value,5);
            $rndFileName = $file_path.$milliSecond.$key.'.'.$ext;
            $fileurl = $file_url.$milliSecond.$key.'.'.$ext;
            if($get_file)
            {
                $status=@file_put_contents($rndFileName, $get_file);
                if($status){
                    $body = str_replace($value,$fileurl,$body);
                }
            }
        }
        return $body;
    }
	public function index(){
		$listRows=20;//每页显示的信息条数
		$url=url('adminindex/index',array('page'=>'{page}'));
	    $limit=$this->pageLimit($url,$listRows);

		$count=model('collectrules')->count();
		$list=model('collectrules')->select('','id,pname,sort,lasttime','id DESC',$limit);
		$this->page=$this->pageShow($count);
		$this->list=$list;
		$sortlist=model('sort')->select('','id,name,deep,path,norder,type');
		if(!empty($sortlist)){
			$sortlist=re_sort($sortlist);
			$sortinfo=array();
			foreach($sortlist as $vo){
                $sortinfo[$vo['id']]['name']=$vo['name'];
                $sortinfo[$vo['id']]['type']=$vo['type']==1?'文章':'图集';
            }
            $this->sortinfo=$sortinfo;
		}
		$this->display();
	}

	public function add(){
		if(!$this->isPost()){
			$sortlist=model('sort')->select("",'id,name,deep,tplist,path,norder,type');
			if(empty($sortlist))  $this->error('没有任何栏目~',url('sort/newsadd'));
			$sortlist=re_sort($sortlist);
            foreach($sortlist as $vo){
                 $ct=explode(',',$vo['tplist']);
                 $paths=$vo['path'].','.$vo['id'];
				 if(1==$vo['type']||2==$vo['type']){
				 	$tpco[$paths]['tp']=$ct[1];
				 	$tpco[$paths]['type']=$vo['type'];
				 }
				 $select=($paths==urldecode($_GET['sort']))?'selected':'';
                 $space = str_repeat('├┈┈┈', $vo['deep']-1);
                 $disable=(1==$vo['type']||2==$vo['type'])?'':'disabled="disabled" style="background-color:#F0F0F0"';    
                 $option.= '<option '.$disable.' value="'.$paths.'" '.$select.'>'.$space.$vo ['name'].'</option>';
            }
            $this->option=$option;
			$this->tpc=json_encode($tpco);//默认模板处理
			$choose=$this->TempNewAndPhoto('content');
            if(!empty($choose)) $this->choose=$choose;
			
			$places=model('place')->select('','','norder DESC');//定位
			$this->places=$places;
			//$this->type=$this->sorttype;
			$this->sortlist=$sortlist;
			$this->display();
		}else{
			if(empty($_POST['type'])||empty($_POST['pname'])||empty($_POST['url'])||empty($_POST['sort'])||empty($_POST['titlerule'])||empty($_POST['method'])||empty($_POST['tpcontent'])||empty($_POST['contentrule'])||empty($_POST['titlerule']))
			$this->error('请填写完整的信息~');
		   if(!Check::url($_POST['url'])) $this->error('要采集的列表页地址格式错误~');
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
			$data['pname']=in($_POST['pname']);
			$data['replaces']=in($_POST['replaces']);
			$data['account']=$_POST['account']?in($_POST['account']):$_SESSION['admin_username'];
			$data['url']=in($_POST['url']);
			$data['pages']=in($_POST['pages']);
			$data['sort']=in($_POST['sort']);
			$data['exsort']=empty($_POST['exsort'])?'':implode(',',$_POST['exsort']);
			$data['listsrcrule']=in($_POST['listsrcrule']);
			$data['titlerule']=in($_POST['titlerule']);
			$data['ispass']=empty($_POST['ispass'])?0:1;
			$data['recmd']=empty($_POST['recmd'])?0:1;
			$data['places']=empty($_POST['places'])?'':implode(',',$_POST['places']);
			$data['picturerule']=in($_POST['picturerule']);
			$data['keywordsrule']=in($_POST['keywordsrule']);
            $data['descriptionrule']=in($_POST['descriptionrule']);
            $data['contentrule']=in($_POST['contentrule']);
            $data['method']=in($_POST['method']);
            $data['tpcontent']=in($_POST['tpcontent']);
            $data['norder']=intval($_POST['norder']);
            $data['hitsrule']=in($_POST['hitsrule']);
            $data['addtimerule']=in($_POST['addtimerule']);
            $_POST['releids']= str_replace('，',',',in($_POST['releids']));
            $releids=explode(',', $_POST['releids']);
			if(!empty($releids)){
				$data['releids']='';
				foreach ($releids as $vo) {
				   $vo=intval($vo);
				   $data['releids'].=$vo?$data['releids']?','.$vo:$vo:'';
			   }
			}
			if($_POST['type']==1) $data['origin']=empty($data['origin'])?'原创':in($_POST['origin']);
			if($_POST['type']==2) {
				$data['photolistrule']=in($_POST['photolistrule']);
				$data['conlistrule']=in($_POST['conlistrule']);
			}
			if(model('collectrules')->insert($data))
			$this->success('采集添加成功~',url('adminindex/index'));
			else $this->error('采集添加失败');
		}
	}

    public function edit(){
    	$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		if(!$this->isPost()){
			$sortlist=model('sort')->select("",'id,name,deep,tplist,path,norder,type');
			if(empty($sortlist))  $this->error('没有任何栏目~',url('sort/newsadd'));
			$sortlist=re_sort($sortlist);
			$info=model('collectrules')->find("id='$id'");
			if(!empty($info['exsort'])) $exsort=explode(',', $info['exsort']);
            foreach($sortlist as $key=>$vo){
                 $ct=explode(',',$vo['tplist']);
                 $paths=$vo['path'].','.$vo['id'];
				 if(1==$vo['type']||2==$vo['type']){
				 	$tpco[$paths]['tp']=$ct[1];
				 	$tpco[$paths]['type']=$vo['type'];
				 }
				 $ifselect =($info['sort']==$paths)?'selected="selected"':'';   
                 $space = str_repeat('├┈┈┈', $vo['deep']-1); 
                 $disable=(1==$vo['type']||2==$vo['type'])?'':'disabled="disabled" style="background-color:#F0F0F0"';    
                 $option.= '<option '.$disable.' value="'.$paths.'" '.$ifselect.'>'.$space.$vo ['name'].'</option>';
                 if(isset($exsort)) $sortlist[$key]['checked']=in_array($vo['id'],$exsort)?'checked':'';
            }
            $this->option=$option;
			$this->tpc=json_encode($tpco);//默认模板处理
			$tpdef=explode('_',$info['tpcontent']);
			if(!isset($tpdef[1])) $this->error('非法的模板参数~');
			$choose=$this->TempNewAndPhoto($tpdef[1]);
            if(!empty($choose)) $this->choose=$choose;
			
			$places=model('place')->select('','','norder DESC');//定位
			$this->places=$places;
			$this->info=$info;
			$this->type=$tpco[$info['sort']]['type'];
			$this->sortlist=$sortlist;
			$this->display();
		}else{
			if(empty($_POST['type'])||empty($_POST['pname'])||empty($_POST['url'])||empty($_POST['sort'])||empty($_POST['titlerule'])||empty($_POST['method'])||empty($_POST['tpcontent'])||empty($_POST['contentrule'])||empty($_POST['titlerule']))
			$this->error('请填写完整的信息~');
		   if(!Check::url($_POST['url'])) $this->error('要采集的列表页地址格式错误~');
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
			$data['pname']=in($_POST['pname']);
			$data['replaces']=in($_POST['replaces']);
			$data['account']=$_POST['account']?in($_POST['account']):$_SESSION['admin_username'];
			$data['url']=in($_POST['url']);
			$data['pages']=in($_POST['pages']);
			$data['sort']=in($_POST['sort']);
			$data['exsort']=empty($_POST['exsort'])?'':implode(',',$_POST['exsort']);
			$data['listsrcrule']=in($_POST['listsrcrule']);
			$data['titlerule']=in($_POST['titlerule']);
			$data['ispass']=empty($_POST['ispass'])?0:1;
			$data['recmd']=empty($_POST['recmd'])?0:1;
			$data['places']=empty($_POST['places'])?'':implode(',',$_POST['places']);
			$data['picturerule']=in($_POST['picturerule']);
			$data['keywordsrule']=in($_POST['keywordsrule']);
            $data['descriptionrule']=in($_POST['descriptionrule']);
            $data['contentrule']=in($_POST['contentrule']);
            $data['method']=in($_POST['method']);
            $data['tpcontent']=in($_POST['tpcontent']);
            $data['norder']=intval($_POST['norder']);
            $data['hitsrule']=in($_POST['hitsrule']);
            $data['addtimerule']=in($_POST['addtimerule']);
            $_POST['releids']= str_replace('，',',',in($_POST['releids']));
            $releids=explode(',', $_POST['releids']);
			if(!empty($releids)){
				$data['releids']='';
				foreach ($releids as $vo) {
				   $vo=intval($vo);
				   $data['releids'].=$vo?$data['releids']?','.$vo:$vo:'';
			   }
			}
			if($_POST['type']==1) $data['origin']=empty($data['origin'])?'原创':in($_POST['origin']);
			if($_POST['type']==2) {
				$data['photolistrule']=in($_POST['photolistrule']);
				$data['conlistrule']=in($_POST['conlistrule']);
			}
			if(model('collectrules')->update("id='$id'",$data))
			$this->success('采集编辑成功~',url('adminindex/index'));
			else $this->error('采集编辑失败');
		}
	}

	public function del(){
		if(!$this->isPost()){
			$id=intval($_GET['id']);
			if(empty($id)) $this->error('您没有选择~');
			if(model('collectrules')->delete("id='$id'"))
			echo 1;
			else echo '删除失败~';
		}else{
			if(empty($_POST['delid'])) $this->error('您没有选择~');
			$delid=implode(',',$_POST['delid']);
			if(model('collectrules')->delete('id in ('.$delid.')'))
			$this->success('删除成功',url('adminindex/index'));
		}
	}
	
	public function collecting(){
		$id=intval($_GET['id']);
		if(empty($id)) $this->error('参数错误');
		$info=model('collectrules')->find("id='$id'");
		$spath=substr($info['sort'],-6);
		$sorts=model('sort')->find("id='$spath'",'type,name');
		if(empty($sorts)) $this->error('该分类不存在或者已经被删除~');
		require('simple_html_dom.php');
		ini_set("display_errors","0");
        ini_set("max_execution_time","7200");
        ini_set("memory_limit","1024M");
		echo '<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><link rel="stylesheet" type="text/css" href="'.__PUBLIC__.'/admin/css/back.css" /><script type="text/javascript" src="'.__PUBLIC__.'/js/jquery.js"></script><title>信息采集</title></head><body><div class="contener"><div class="list_head_m"><div class="list_head_ml">当前位置：【采集进度】</div></div><table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">';
		//echo str_pad(" ", 1024);
		ob_end_flush();//或ob_end_clean();
        ob_implicit_flush(true);
        //获取列表页
        echo '<tr><td>开始加载采集器~</td></tr>';
        ob_flush();
        flush();
        if(!empty($info['pages'])){//获取分页链接
           $urllist=array();
           if(strpos($info['pages'],'~')!==false){
             $bem=explode('~',$info['pages']);
             $bem[0]=intval($bem[0]);
             $bem[1]=intval($bem[1]);
             if(empty($bem[0])||empty($bem[1])||$bem[0]>=$bem[1]) $this->error('分页设置格式错误~');
             for ($i=$bem[0]; $i <=$bem[1] ; $i++) { 
             	$listurl=str_replace('*',$i,$info['url']);
        	    $html = file_get_html($listurl);
        	    foreach($ret = $html->find($info['listsrcrule'])  as $element) $urllist[] = $element->href;
             }
           }else{
             $pages=explode(',',$info['pages']);
             if(empty($pages)) $this->error('分页设置格式错误~');
             foreach ($pages as $vo) {
             	$listurl=str_replace('*',$vo,$info['url']);
        	    $html = file_get_html($listurl);
        	    foreach($ret = $html->find($info['listsrcrule'])  as $element) $urllist[] = $element->href;
             }
           }
        }else{
        	$html = file_get_html($info['url']);
        	foreach($ret = $html->find($info['listsrcrule'])  as $element) $urllist[] = $element->href;
        }
        unset($html);
        unset($ret);
        echo '<tr><td>获取到'.count($urllist).'条内容页链接~</td></tr>';
        ob_flush();
        flush();
        //获取内容页
        if(empty($urllist)) $this->error('没有获取到任何内容页url~');
        switch ($sorts['type']) {
			   case 1://资讯
			      $data['origin']=$info['origin'];
			   	  break;
			   case 2://图集
			   	  // if(!empty($info['photolistrule'])) 
        	      // if(!empty($info['conlistrule'])) 
			      break;
			   default:
			      $this->error('该类型栏目不属于多篇信息栏目，不适用采集~');
			   	  break;
		}
		    $data['sort']=$info['sort'];
		    $data['account']=$info['account'];
		    $data['places']=$info['places'];
		    $data['method']=$info['method'];
		    $data['tpcontent']=$info['tpcontent'];
		    $data['norder']=$info['norder'];
		    $data['ispass']=$info['ispass'];
		    $data['releids']=$info['releids'];
		    if(strpos($info['hitsrule'],',')!==false){
		        $hitrange=explode(',',$info['hitsrule']);
                $hitrange[0]=intval($hitrange[0]);
                $hitrange[1]=intval($hitrange[1]);
            }else $data['hits']=intval($info['hitsrule']);
            
            if(strpos($info['addtimerule'],',')!==false){
                $timerange=explode(',',$info['addtimerule']);
                $timerange[0]=strtotime($timerange[0]);
                $timerange[1]=strtotime($timerange[1]);
            }else $data['addtime']=strtotime($info['addtimerule']);

        	$picpath=ROOT_PATH.'upload/';
        	$picbname=date("Ymd").'/';
        	$picpath.=$sorts['type']==1?'news/image/'.$picbname:'photo/image/'.$picbname;
        	if(!empty($info['picturerule'])&&!is_dir($picpath)) @mkdir($picpath,0777,true);

        	$i=1;
        	foreach ($urllist as $vo) {
        		//$vo['url']='../index.html';
        		if(!Check::url($vo)) { 
        			$tmparr=parse_url($info['url']);
        			$urlhead=empty($tmparr['scheme'])?'http://':$tmparr['scheme'].'://';    
        			//$rurl=$tmparr['host'].$tmparr['path']; 
        			if('/'==substr($vo,0,1)){
                        $vo=$urlhead.$tmparr['host'].$vo;
        			}else{
        				$rurlarr=array();   
        			    if(!empty($tmparr['path'])){
        			    	$rurlarr=explode('/',substr($tmparr['path'],1));
        			        array_pop($rurlarr);
        			    }
        			    $rurlarrlen=count($rurlarr);

                        $uplever=substr_count($vo,'../');
                        $exitlever=$rurlarrlen-$uplever;
                        if($exitlever>0){
                        	for($j=0;$j<$exitlever;$j++){
                        		$tmparr['host'].='/'.$rurlarr[$j];
                        	}
                        }
                        $vo=$urlhead.$tmparr['host'].'/'.str_replace('../','',$vo);
        			}
        			// print_r($vo);
        			// exit();
        		}
        		$collectcon=array();
        		$html = file_get_html($vo);
        		if(!empty($info['titlerule'])) $collectcon['title']=$html->find($info['titlerule'],0)->plaintext;
        		if(!empty($info['picturerule'])){
        			$urls=parse_url($info['url']);
        			$collectcon['picture']=$html->find($info['picturerule'],0)->src;
        		}
        		if(!empty($info['keywordsrule'])) $collectcon['keywords']=$html->find($info['keywordsrule'],0)->plaintext;
        		if(!empty($info['descriptionrule'])) $collectcon['description']=$html->find($info['descriptionrule'],0)->plaintext;
        		if(!empty($info['contentrule'])) $collectcon['content']=$html->find($info['contentrule'],0)->innertext;
        		unset($html);
        		// print_r($collectcon);
        		// exit();
        		
        		if(empty($collectcon['content'])||empty($collectcon['title'])) echo $i==1?'<tr><td>开始采集：<br><a href="'.$vo.'" target="_blank"><font color="red">'.$vo.'</font></a><br>':'<a href="'.$vo.'" target="_blank"><font color="red">'.$vo.'</font></a><br>';
        		else{
        			$collectcon['hits']=isset($data['hits'])?$data['hits']:rand($hitrange[0],$hitrange[1]);
        			$collectcon['addtime']=isset($data['addtime'])?$data['addtime']:rand($timerange[0],$timerange[1]);
        			if(!empty($collectcon['picture'])){
        			   if(!Check::url($collectcon['picture'])){//构建完整图片路径
        			   	   if(substr($collectcon['picture'], 0,1)=='/') $collectcon['picture']=$urls['scheme'].'://'.$urls['host'].$collectcon['picture'];
        			   	   else $collectcon['picture']=substr($vo,0,strrpos($vo,'/')).'/'.$collectcon['picture'];   
        			   }
        			   $collectcon['picture'] = trim($collectcon['picture']);
                       $exts=explode('.', $collectcon['picture']);
                       $collectcon['picture']='';
                       $ext=substr(end($exts),0,3);
                       if(in_array($ext, array('jpg','gif','png'))){
                       	  $picaname=date("YmdHis").'_'.rand(1,1000).'.'.$ext;
                       	  for($j=0;$j<count($exts)-1;$j++){
                             $collectcon['picture'].=$exts[$j].'.';
                       	  }
                       	  unset($exts);
                       	  $collectcon['picture'].=$ext;
                          $get_file = @Http::doGet($collectcon['picture'],5);
                          if($get_file) $status=@file_put_contents($picpath.$picaname,$get_file);
                          if($status) $collectcon['picture']=$picbname.$picaname;
                       }else $collectcon['picture']='NoPic.gif';
        			}

        			//内容替换
        			if(!empty($info['replaces'])){
        				$ress=explode("\r\n",$info['replaces']);
        			    foreach ($ress as $res) {
        				   $reparr=explode("|",$res);
        				   $collectcon['content']=str_replace($reparr[0], $reparr[1], $collectcon['content']);
        			    }
        			}
                    //exit($collectcon['content']);
        			//字符转义
        			$collectcon['content']=html_in($collectcon['content']);
        			$fulldata=array_merge($data,$collectcon);
        			if(model('news')->insert($fulldata)) echo $i==1?'<tr><td>开始采集：<br><a href="'.$vo.'" target="_blank"><font color="green">'.$vo.'</font></a><br>':'<a href="'.$vo.'" target="_blank"><font color="green">'.$vo.'</font></a><br>';
        			ob_flush();
                    flush();
        		}
        		$i++;
        	}
        	echo '</td></tr><tr><td>【采集完成】<font color="green">绿色</font>采集成功；<font color="red">红色</font>采集失败</td></tr></body></html>';
        	model('collectrules')->update("id='$id'","lasttime='".time()."'");
	}
}
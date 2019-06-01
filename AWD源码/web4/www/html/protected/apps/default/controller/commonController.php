<?php
//公共类
class commonController extends memberController {
	protected $layout = 'layout';
	protected $NewImgPath='';
	protected $PhotoImgPath='';
	protected $LinkImgPath='';
	protected $PageImgPath='';
	public function __construct()
	{
		parent::__construct();
		defined('__CRAWLER__') or define('__CRAWLER__',isCrawler());           		
		$this->NewImgPath=__ROOT__.'/upload/news/image/';
		$this->PhotoImgPath=__ROOT__.'/upload/photos/';
		$this->LinkImgPath=__ROOT__.'/upload/links/';
		$this->PageImgPath=__ROOT__.'/upload/pages/image/';
		$this->assign('NewImgPath', $this->NewImgPath);
		$this->assign('PhotoImgPath', $this->PhotoImgPath);
		$this->assign('LinkImgPath', $this->LinkImgPath);
		$this->assign('PageImgPath', $this->PageImgPath);
		$this->sorts=$this->sortArray();
		$this->sortstree=sorttree($this->sorts);
		$this->title=config('sitename');
		$this->keywords=config('keywords');
		$this->description=config('description');
		$this->telephone=config('telephone');
		$this->QQ=config('QQ');
		$this->email=config('email');
		$this->address=config('address');
		$this->icp=config('icp');
		$this->view()->addTags(array(//自定义标签
			"/{(\S+):{(.*)}}\s*/i"=>"<?php $$1=getlist(\"$2\",\$sorts); $$1_i=0; if(!empty($$1)) foreach($$1 as $$1){  $$1_i++; ?> ",
            "/{\/([a-zA-Z_]+)}\s*/i"=> "<?php } ?>",
            "/\[([a-zA-Z_]+)\:\i\]\s*/i"=>"<?php echo \$$1_i ?>",
            "/\#\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]\#/i"=>'".\$$1[\'$2\']."',
            "/\#\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]\#/i"=> '".\$$1[\'$2\']."',
            "/\#\\$(\S+)\#/i"=>'".$$1."',
            "/\[([a-zA-Z_]+)\:([a-zA-Z_]+)\]\s*/i"=>"<?php echo \$$1['$2'] ?>",
            "/\[([a-zA-Z_]+)\:([a-zA-Z_]+) \\\$len\=([0-9]+)\]\s*/i"=>"<?php echo msubstr(\$$1['$2'],0,$3); ?>",
            "/\[([a-zA-Z_]+)\:([a-zA-Z_]+) \\\$elen\=([0-9]+)\]\s*/i"=>"<?php echo substr(\$$1['$2'],0,$3); ?>",
            "/{piece:([a-zA-Z_]+)}\s*/i"=> "<?php \$cpTemplate->display(model('fragment')->fragment($1),false,false); ?>",
            "/{link:([a-zA-Z][a-zA-Z0-9]+)}\s*/i"=>"<?php \$links=model('link')->getlink(\"$1\"); if(!empty(\$links)) foreach(\$links as \$link){ ?> ",
			),true);
	}
    //获得根节点
    protected function getrootid($id){
        $id=in($id); 
        $rootpath=model('sort')->find("id='{$id}'",'path');
        $rootid= empty($rootpath['path'])? '': substr($rootpath['path'].','.$id, 8, 6);
        return $rootid;
    }
	//返回无限分类数组
	protected  function  sortArray($type=0,$deep=0,$path='')
	{
		$where="";
		if($type) $where.="type='{$type}' ";
		if($deep) $where.=empty($where)?"deep='{$deep}' ":" AND deep='{$deep}'";
		if(!empty($path)) $where.=empty($where)?"path LIKE '{$path}%'":" AND path LIKE '{$path}%'";
		$list=model('sort')->select($where,'id,deep,name,ename,description,picwidth,picheight,picture,path,norder,method,url,type,extendid,ifmenu');
		if(!empty($list)) $list=re_sort($list);
		$newList=array();
		if(!empty($list)){
			foreach ($list as $vo)
			{
				$next=current($list);
			    next($list);
				$newList[$vo['id']]['name']=$vo['name'];
				$newList[$vo['id']]['ename']=$vo['ename'];
				$newList[$vo['id']]['description']=$vo['description'];
				if(!empty($vo['picture'])){
				   if($vo['picture']!='NoPic.gif'){
				        switch ($vo['type']) {
				    	    case 1:
				    		    $newList[$vo['id']]['picture']=$this->NewImgPath.$vo['picture'];
				    		    break;
				    	    case 2:
				    	 	    $newList[$vo['id']]['picture']=$this->PhotoImgPath.$vo['picture'];
				    		    break;
				    	    case 3:
				    		    $newList[$vo['id']]['picture']=$this->PageImgPath.$vo['picture'];
				    		    break;
				           }
				    }else $newList[$vo['id']]['picture']=__UPLOAD__.'/NoPic.gif';
				}
				$newList[$vo['id']]['pid']=substr($vo['path'],strrpos($vo['path'],",")+1);
				$newList[$vo['id']]['type']=$vo['type'];
				$newList[$vo['id']]['picwidth']=$vo['picwidth'];
				$newList[$vo['id']]['picheight']=$vo['picheight'];
				$newList[$vo['id']]['path']=$vo['path'].','.$vo['id'];
				if($path) $newList[$vo['id']]['path']=',000000'.str_replace($path, '', $newList[$vo['id']]['path']);
				$newList[$vo['id']]['deep']=$vo['deep'];
				$newList[$vo['id']]['method']=$vo['method'];
				$newList[$vo['id']]['ifmenu']=$vo['ifmenu'];
				$newList[$vo['id']]['extendid']=$vo['extendid'];
				$newList[$vo['id']]['nextdeep']=$next['deep'];
				$newList[$vo['id']]['url']=getURl($vo['type'],$vo['method'],$vo['url'],$vo['id'],$vo['extendid'],$vo['ename']);
			}			
		}
		return $newList;
	}
	//面包屑导航
	protected  function  crumbs($path=',000000')
	{
		$crumb=array();
		if(strlen($path)>7){
			$ids=substr($path,8);
			$crumb=model('sort')->select("id IN($ids)",'id,type,name,ename,method,url,extendid','deep');
			foreach ($crumb as $key=>$vo){
				$crumb[$key]['url']=getURl($vo['type'],$vo['method'],$vo['url'],$vo['id'],$vo['extendid'],$vo['ename']);
			}
		}
		return $crumb;
	}
	//文件上传
	protected  function  upload($savePath='',$maxSize='',$allowExts='',$allowTypes='',$saveRule='')
	{
		$upload=new UploadFile($savePath,$maxSize,$allowExts,$allowTypes,$saveRule);
		return $upload;
	}
}
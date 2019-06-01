<?php
class indexController extends commonController
{
	public function index()
	{
      if($_REQUEST['nor']){
        $this->redirect(url());
      }
      $this->display();
	}
  public function map()
  {
      $this->display();
  }
  
	public function search()
	{
       if((empty($_GET['keywords'])||empty($_GET['type']))&&(empty($_POST['keywords'])||empty($_POST['type']))) $this->error('搜索条件不足~');
       if(empty($_GET['keywords'])) $_GET['keywords']=$_POST['keywords'];
       if(empty($_GET['type'])) $_GET['type']=$_POST['type'];

       $keywords=in(urldecode($_GET['keywords']));
       $type=in($_GET['type']);
       $listRows=config('serchnum')*2;//每页显示的信息条数,2n偶数
       $url=url('index/search',array('keywords'=>urlencode($keywords),'type'=>$type,'page'=>'{page}'));
	     $where="ispass='1' AND (title like '%".$keywords."%' OR description like '%".$keywords."%')";
       switch ($type) {
       	case 'news':
       	  $count=model('news')->count($where);
          $limit=$this->pageLimit($url,$listRows);
       		$list=model('news')->select($where,'id,sort,title,picture,description,method,addtime,hits,origin','recmd DESC,norder desc,id DESC',$limit);
       		break;

       	case 'photo':
       	  $count=model('photo')->count($where);
          $limit=$this->pageLimit($url,$listRows);
       		$list=model('photo')->select($where,'id,sort,title,picture,description,method,addtime,hits','recmd DESC,norder desc,id DESC',$limit);
       		break;
       	
       	case 'all':
       	  $count1=model('news')->count($where);
       	  $count2=model('photo')->count($where);
          $limit=$this->pageLimit($url,$listRows/2);
       	  $list1=model('news')->select($where,'id,sort,title,picture,description,method,addtime,hits,origin','recmd DESC,norder desc,id DESC',$limit);
       		$list2=model('photo')->select($where,'id,sort,title,picture,description,method,addtime,hits','recmd DESC,norder desc,id DESC',$limit);
       		$count=max($count1,$count2);
       		if(empty($list1)) $list1=array();
       		if(empty($list2)) $list2=array();
       		$list=array_merge($list1,$list2);
       		break;
       	default:
              $type=intval($type);
              if($type){
                  $sortinfo=model('sort')->find("id='{$type}'",'name,ename,path,type,extendid');
                  if(!empty($sortinfo)){
                     switch ($sortinfo['type']) {
                       case 1:
                         $modeltable='news';
                         $judgetb=',origin';
                         break;
                       case 2:
                         $modeltable='photo';
                         break;
                       default:
                         throw new Exception('只有资讯和图集可搜索~', 404);
                         break;
                     }
                     $path=$sortinfo['path'].','.$type;
                     $limit=$this->pageLimit($url,$listRows);
                     if(empty($sortinfo['extendid'])){
                        $where.=" AND sort like '".$path."%'";
                        $count=model($modeltable)->count($where);
                        $list=model($modeltable)->select($where,'id,sort,title,picture,description,method,addtime,hits'.$judgetb,'recmd DESC,norder desc,id DESC',$limit);
                     }else {
                         $exid=$sortinfo['extendid'];
                         $extables=model('extend')->select("id='{$exid}' or (pid='{$exid}' AND ifsearch='1')","tableinfo,name","pid,norder DESC");
                         if(empty($extables)) throw new Exception('自定义字段信息不存在~', 404);
                         $excount=$modeltable.'count';
                         $exfunction=$modeltable.'ANDextend';
                         $count=model($modeltable)->$excount($extables,$path,$type,$keywords);
                         $list=model($modeltable)->$exfunction($extables,$path,$limit,$type,'',$keywords);
                         $this->extfields=$extables;
                         $this->id=$type;
                    }
                  }else throw new Exception('搜索栏目不存在~', 404);
              }else throw new Exception('非法的搜索类型~', 404);
              break;
       }
       if(!empty($list)){
          foreach ($list as $key=>$vo) {
                $pid=substr($vo['sort'],-6);
                $list[$key]['url']=Check::url($vo['method'])?$vo['method']:url($vo['method'],array('col'=>$this->sorts[$pid]['ename'],'id'=>$vo['id']));
                $list[$key]['sort']=substr($vo['sort'],-6);
                if(!empty($vo['picture']) && 'NoPic.gif'!=$vo['picture']) $list[$key]['picturepath']=isset($vo['origin'])?$this->NewImgPath.$vo['picture']:$this->PhotoImgPath.$vo['picture'];
          }
      }
      $this->page=$this->pageShow($count);
      $count=isset($count1)?($count1+$count2):$count;
      $this->count=$count;
      if(strlen($keywords)<60) model('tags')->update("name='{$keywords}'","hits=hits+1,mesnum='{$count}'");
      $this->list=$list;
      $this->keywords=$keywords;
      $this->display();
	}
      //生成验证码
      public function verify()
      {
            Image::buildImageVerify();
      }
}
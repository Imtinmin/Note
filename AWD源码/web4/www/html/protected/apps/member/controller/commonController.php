<?php
//公共类
class commonController extends memberController {
	protected $layout = 'layout';
	protected function checkConPower($id)
  {
       if(!$id) return flase;
       $asort=config('sortallow');
       if(!$asort) return flase;
       $power=explode(',',$asort);
       if(!in_array($id,$power)) return false;
       return true;
  }
  //文件上传
  protected  function  upload($savePath='',$maxSize='',$allowExts='',$allowTypes='',$saveRule='')
  {
    $upload=new UploadFile($savePath,$maxSize,$allowExts,$allowTypes,$saveRule);
    return $upload;
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
    //返回无限分类数组
  protected  function  sortArray($type=0,$deep=0,$path='')
  {
    $where="";
    if($type) $where.="type='{$type}' ";
    if($deep) $where.=empty($where)?"deep='{$deep}' ":" AND deep='{$deep}'";
    if(!empty($path)) $where.=empty($where)?"path LIKE '{$path}%'":" AND path LIKE '{$path}%'";
    $list=model('sort')->select($where,'id,deep,name,ename,picture,path,norder,method,url,type,extendid,ifmenu');
    if(!empty($list)) $list=re_sort($list);
    $newList=array();
    if(!empty($list)){
      foreach ($list as $vo)
      {
        $next=current($list);
          next($list);
        $newList[$vo['id']]['name']=$vo['name'];
        $newList[$vo['id']]['ename']=$vo['ename'];
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
        $newList[$vo['id']]['path']=$vo['path'].','.$vo['id'];
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
    //图片批量上传,ajax方式使用
  protected function AjaxUpload($filename,$ifthumb=false,$thumbtype=1,$thumbMaxwidth,$thumbMaxheight)
  {
    $path=ROOT_PATH.'upload/'.$filename.'/';
    $upload = $this->upload($path,config('imgupSize'),'jpg,bmp,gif,png');
    $upload->saveRule = date('ymdhis').mt_rand(); //命名规范
    $upload->thumb = $ifthumb; //缩略图开关
    $upload->thumbType=$thumbtype;
    $upload->thumbMaxWidth = empty($thumbMaxwidth)?config('thumbMaxwidth'):$thumbMaxwidth; // 缩略图最大宽度
    $upload->thumbMaxHeight = empty($thumbMaxheight)?config('thumbMaxheight'):$thumbMaxheight; // 缩略图最大高度
    $upload->upload(); //上传
    $info = $upload->getUploadFileInfo(); //返回信息 Array ( [0] => Array ( [name] => 未命名.jpg [type] => image/pjpeg [size] => 53241 [key] => Filedata [extension] => jpg [savepath] => ../../../upload/2011-12-17/ [savename] => 1112170727041127335395.jpg ) )
    if (empty($info)) return;
    // 输出
    if(config('ifwatermark'))//是否加水印
    {
      $Image = new Image();
      $tp = $info[0]['savepath'].$info[0]['savename']; //原图
      $logo = ROOT_PATH.'public/watermark/'.config('watermarkImg');//水印图
      $Image->water($tp,$logo,config('watermarkPlace')); //执行
    }
    echo $info[0]['savename'];
  }
}
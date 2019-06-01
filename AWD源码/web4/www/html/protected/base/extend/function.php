<?php
require(CP_PATH . 'lib/common.function.php');
require(CP_PATH . 'ext/template_ext.php');

//调试运行时间和占用内存
function debug($flag='system', $end = false){
  static $arr =array();
  if( !$end ){
    $arr[$flag] = microtime(true); 
  } else if( $end && isset($arr[$flag]) ) {
    echo  '<p>' . $flag . ': runtime:' . round( (microtime(true) - $arr[$flag]), 6)
       . '  memory_usage:' . memory_get_usage()/1000 . 'KB</p>'; 
  }
}
//保存配置
function save_config($app, $new_config = array()){
  if( !is_file($app) ){
    $file = BASE_PATH . 'apps/' . $app. '/config.php';
  }else{
    $file = $app;
  }
  
  if( is_file($file) ) {
    $config = require($file);
    $config = array_merge($config, $new_config);
  }else{
    $config = $new_config;
  }
  $content = var_export($config, true);
  $content = str_replace("_PATH' => '" . addslashes(BASE_PATH), "_PATH' => BASE_PATH . '", $content);

  if( file_put_contents($file, "<?php \r\nreturn " . $content . ';' ) ) {
    return true;
  }
  return false;
}

function copy_dir($src, $dst) {
 // if (file_exists($dst)) del_dir($dst);
  if (is_dir($src)) {
    mkdir($dst);
    $files = scandir($src);
    foreach ($files as $file)
    if ($file != "." && $file != "..") copy_dir("$src/$file", "$dst/$file");
  }
  else if (file_exists($src)) copy($src, $dst);
}
//无限分类重排序
function re_sort($data){
  $max_sort = 0;
  foreach($data as $i => $n){   //获得最大深度
    if($n['deep'] > $max_sort) $max_sort = $n['deep'];
  }
  foreach($data as $i => $n){
    for($x=1; $x<=$max_sort; $x++){
      if($n['deep'] == $x){
        ${'rela_'.$x}[] = $n;  //每个深度一个数组$real_i,存放一行所有数据
      }
    }
  }
  for($i=1; $i<=$max_sort; $i++){
    if(is_array(${'rela_'.$i})){
      foreach (${'rela_'.$i} as $o => $p) {
        ${'sort_'.$i}[$o] = $p['norder']; //每个深度一个数组$sort_i,该行的指定排序
      }
      array_multisort(${'sort_'.$i},SORT_ASC,${'rela_'.$i});//$real_i按$sort_i排序
    }
  }
  if(is_array($rela_1)){//多个顶级分类
    foreach($rela_1 as $i => $n){
      $all_column_1[] = $n;
      if(!is_array($rela_2)) break;
      foreach($rela_2 as $x => $y){
        if(stristr($y['path'],$n['id'])) $all_column_1[] = $y;//将二级分类放在对应一级父分类后
      }
    }
  }
  if(empty($rela_1)) $all_column_1 = $rela_2; //无顶级分类
  for($i=2; $i<$max_sort; $i++){
    if(empty(${'rela_'.$i})) ${'all_column_'.$i} = ${'rela_'.($i+1)};
    if(is_array(${'all_column_'.($i-1)})){
      foreach(${'all_column_'.($i-1)} as $o => $p){
        ${'all_column_'.$i}[] = $p;
        if($p['deep'] == $i){
          foreach(${'rela_'.($i+1)} as $e => $r){
            if(stristr($r['path'],$p['id'])) ${'all_column_'.$i}[] = $r;//将子分类放在对应父分类后
          }
        }
      }
    }
  }
  $all_column = ${'all_column_' . ($max_sort-1)};
  if(empty($all_column) || $max_sort == 1) $all_column = $rela_1;
  return $all_column;
}

//图片剪切方法
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
{//参数说明：剪切后图片路径、原图路径、剪切框宽度、剪切框高度、剪切框左上顶点坐标、剪切后图片与选中部分宽度比
list($imagewidth, $imageheight, $imageType) = getimagesize($image);
$imageType = image_type_to_mime_type($imageType);
$newImageWidth = ceil($width * $scale);
$newImageHeight = ceil($height * $scale);
$newImage = @imagecreatetruecolor($newImageWidth,$newImageHeight);
switch($imageType) {
  case "image/gif":
    $source= @imagecreatefromgif($image);
    break;
  case "image/pjpeg":
  case "image/jpeg":
  case "image/jpg":
    $source= @imagecreatefromjpeg($image);
    break;
  case "image/png":
  case "image/x-png":
    $source= @imagecreatefrompng($image);
    break;
}
@imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
switch($imageType) {
  case "image/gif":
    @imagegif($newImage,$thumb_image_name);
    break;
  case "image/pjpeg":
  case "image/jpeg":
  case "image/jpg":
    @imagejpeg($newImage,$thumb_image_name,90);
    break;
  case "image/png":
  case "image/x-png":
    @imagepng($newImage,$thumb_image_name);
    break;
}
chmod($thumb_image_name,  0644);
return $thumb_image_name;
}

//获取tag标签
function gettags($keywords)
{
   $tags=explode(',',$keywords);
   $constr='';
   foreach ($tags as $vo) {
       $vo=in($vo);
       if(!empty($vo)) $constr.=empty($constr)?'"'.$vo.'"':',"'.$vo.'"';
   }
   $taged=model('tags')->select('name in ('.$constr.')','name','hits desc,id desc');
   if(!empty($taged)){
     foreach ($taged as $vo) {
       $tages[]=$vo['name'];
     }
     unset($taged);
     return $tages;
   }else return false;
}
//前台模板直接查询数据库调用
function getlist($html,&$sorts)
{
        $html = stripslashes($html);
        preg_match_all('/(\S+)=\((.*)\)/iU', $html, $matches);
        $get = array_combine($matches[1], $matches[2]);
        $table = in($get['table']);
        $extable= in($get['extable']);
        $field =in($get['field']);
        $field = $field ? $field :'*';
        $limit = in($get['limit']);
        $desc = $get['order'];
        $condition = $get['where'];
        
        if('news'==$table || 'photo'==$table){//资讯、图集处理
           $column= in($get['column']);
           $nocolumn= in($get['nocolumn']);
           $place = in($get['place']);
           $noplace = in($get['noplace']);
           $exfield = in($get['exfield']);
           
           //栏目限定
           if(!empty($column)){
              if(strpos($column,'|ec')!==false) {//判断是否需要副栏目
                $column=str_replace('|ec','',$column);
                $ifexcol=true;
              }else $ifexcol=false;
              if(strpos($column,',')!==false){
                 $cols=explode(',', $column);
                 $colcondition='';
                 foreach ($cols as $vo) {
                   if(!empty($vo)) $colcondition.=$ifexcol?(empty($colcondition)?"(sort like '%".$vo."%' OR exsort like '%".$vo."%'":" OR sort like '%".$vo."%' OR exsort like '%".$vo."%'"):(empty($colcondition)?"(sort like '%".$vo."%'":" OR sort like '%".$vo."%'");
                 }
                 $colcondition.=')';
                 $condition.=empty($condition)?$colcondition: ' AND '.$colcondition;
              }else $condition.=$ifexcol?(empty($condition)?"(sort like '%".$column."%' OR exsort like '%".$column."%')":" AND (sort like '%".$column."%' OR exsort like '%".$column."%')"):(empty($condition)?"sort like '%".$column."%'":" AND sort like '%".$column."%'");
           } 
           //反向栏目
            if(!empty($nocolumn)){
              if(strpos($nocolumn,'|ec')!==false) {
                $nocolumn=str_replace('|ec','',$nocolumn);
                $ifexcol=true;
              }else $ifexcol=false;
              if(strpos($nocolumn,',')!==false){
                 $cols=explode(',', $nocolumn);
                 foreach ($cols as $vo) {
                   if(!empty($vo)) $condition.=$ifexcol?(empty($condition)?"sort not like '%".$vo."%' AND exsort not like '%".$vo."%'":" AND sort not like '%".$vo."%' AND exsort not like '%".$vo."%'"):(empty($condition)?"sort not like '%".$vo."%'":" AND sort not like '%".$vo."%'");
                 }
              }else $condition.=$ifexcol?(empty($condition)?"sort not like '%".$nocolumn."%' AND exsort not like '%".$nocolumn."%'":" AND sort not like '%".$nocolumn."%' AND exsort not like '%".$nocolumn."%'"):(empty($condition)?"sort not like '%".$nocolumn."%'":" AND sort not like '%".$nocolumn."%'");
           } 
          
          //定位
          if(!empty($place)) {
            $places=explode(',',$place);
            if(empty($places[1])) {
              $place=intval($places[0]);
              $condition.=empty($condition)?"places like '%".$place."%'":" AND places like '%".$place."%'";
            }else {
               $placecd='';
               foreach ($places as $vo) {
                  $vo=intval($vo);
                  if(!empty($vo)) $placecd.=empty($placecd)?"places like '%".$vo."%'":" OR places like '%".$vo."%'";
               }
               if(!empty($placecd)) $condition.=empty($condition)?"(".$placecd.")":" AND (".$placecd.")";
            }
          }

           //反向定位
          if(!empty($noplace)) {
            $noplaces=explode(',',$noplace);
            if(empty($noplaces[1])) {
              $noplace=intval($noplaces[0]);
              $condition.=empty($condition)?"places not like '%".$noplace."%'":" AND places not like '%".$noplace."%'";
            }else {
               $noplacecd='';
               foreach ($noplaces as $vo) {
                  $vo=intval($vo);
                  if(!empty($vo)) $noplacecd.=empty($noplacecd)?"places not like '%".$vo."%'":" AND places not like '%".$vo."%'";
               }
               if(!empty($noplacecd)) $condition.=empty($condition)?$noplacecd:" AND ".$noplacecd;
            }
          }
          //默认排序
          if(empty($desc)) $desc='recmd desc,norder desc,addtime desc';
          if($desc=='rand') $desc= 'rand()';
          //拓展字段
          if(!empty($exfield) && !empty($column)){
               //$exttableid=model('sort')->find("id='{$column}'","extendid");
               if(strpos($column,',')!==false){
                 $exid= $sorts[$cols[0]]['extendid'];
               }else{
                 $exid=$sorts[$column]['extendid'];
               }
               if(!empty($exid)) $extableinfo=model('extend')->find("id='{$exid}' AND type='0' AND pid='0'","tableinfo");
               $extable=$extableinfo['tableinfo'];
           }

          if(!(strpos($field,'id')!==false) && '*'!=$field) $field.=',id';
          if(!(strpos($field,'method')!==false) && '*'!=$field) $field.=',method';
          if(!(strpos($field,',sort')!==false)  && '*'!=$field) $field.=',sort';
          if(!empty($extable) && '*'!=$field && !(strpos($field,'extfield')!==false)) $field.=',extfield';

          $condition = str_replace('[', '(', $condition);
          $condition = str_replace(']', ')', $condition);
          $list = model($table)->select($condition,$field,$desc,$limit);
          if(empty($list)) return $list;
          
          $i=0;
          $ids='';
          //一次处理
          $sid='';
          foreach ($list as $vo) {
            $sid=substr($vo['sort'], -6);
            $list[$i]['url']=Check::url($vo['method'])?$vo['method']:url($vo['method'],array('col'=>$sorts[$sid]['ename'],'id'=>$vo['id']));
            if(strpos($field,'picture')!==false){
              switch ($table) {
                case 'news':
                  $list[$i]['picturepath']=__ROOT__.'/upload/news/image/'.$vo['picture'];
                  break;
                case 'photo':
                  $list[$i]['picturepath']=__ROOT__.'/upload/photos/thumb_'.$vo['picture'];
                  break;
              }
            }
            if(!empty($vo['keywords'])) $list[$i]['tags']=gettags($vo['keywords']);
            //栏目id获取
            if(!empty($vo['sort'])) $list[$i]['sort']=substr($vo['sort'],-6);
            if(!empty($vo['extfield'])) $ids.=empty($ids)?$vo['extfield']:','.$vo['extfield'];
            $i++;
          }
          if(!empty($extable) && !empty($ids)){
            if(!(strpos($exfield,'id')!==false) && '*'!=$exfield) $exfield.=',id';
            $exfields=model('extend')->Extselect($extable,"id in({$ids})",$exfield);
            if(!empty($exfields)){
              $exlist=array();
               foreach ($exfields as $vo) {
                  $exlist[$vo['id']]=$vo;
               }
               //二次处理
               $i=0;
               $exfields=explode(',',$exfield);
               foreach ($list as $vo) {
                 foreach ($exfields as $v) {
                  $list[$i][$v]=$exlist[$vo['extfield']][$v];
                 }  
                 $i++; 
               }
            }
          }
          return $list;
        }
        //自定义表处理
        if(!empty($extable)&& empty($table)){
           return model('extend')->Extselect($extable,$condition,$exfield,$desc,$limit);
        }
        $list= model($table)->select($condition,$field,$desc,$limit); //通用  
        if(strpos($field,'picture')!==false && !empty($list)){
          switch ($table) {
            case 'link':
                $i=0;
                foreach ($list as $vo) {
                    if(!empty($vo['logourl'])) $list[$i]['picturepath']=$vo['logourl'];
                    if(!empty($vo['picture'])) $list[$i]['picturepath']=__ROOT__.'/upload/links/'.$vo['picture'];
                    $i++;
                }
            break;
          }
        } 
        return $list;
}
//获取菜单URl
function getURl($type,$method,$url,$id,$extendid,$ename)
{
  switch ($type) {
    case 5:
      $urls=explode(',',$url);
      $url=$urls[0];
      if(!empty($urls[1])){
        $para=array();
        $arr=explode('/',$urls[1]);
        foreach ($arr as $v) {
            $ele=explode('=',$v);
            $para[$ele[0]]=$ele[1];
        }
      }
      return ($extendid==0) ? empty($para)?url($url):url($url,$para):$url;
      break;
    case 4:
      return url($method);
      break;
    default:
      //return url('default/'.$method,array('id'=>$id)); 
      return url('default/column/index',array('col'=>$ename)); 
      break;
  }  
}
//将栏目二维数组转换为多维树形结构
function sorttree($sorts=array())
{
  $newsorts=array();
  if($sorts && is_array($sorts)){
    foreach ($sorts as $key=>$vo){
       if($vo['ifmenu']){
         $path=substr($vo['path'],8,-7);
         $idem=&$newsorts;
         if($path){
           $paths=explode(',', $path);
           foreach ($paths as $v) {
             $idem=&$idem[$v]['c'];
           }
         }
         $idem[$key]=$sorts[$key];
      }
    }
  }
  return $newsorts;
}
//获取某栏目下所有子栏目
function getcsort($sorts,$psort,$type)
{
   $sortsnow=array();
   foreach ($sorts as $key => $vo) {
      if(strpos($vo['path'],','.$psort.',')!==false && $vo['type']==$type){
         $sortsnow[$key]=$vo;
      }
   }
   return $sortsnow;
}
//列表多条件增加栏目处理
function addexsort($sorts,$ids,$id,$sortnow=array())
{
    if(!empty($ids)){
      if(strpos(strval($ids),strval($id))!==false) return $ids;
      $i=1;
      $onlyids=array();
      foreach ($sorts as $key => $vo) {
          $sorts[$key]['order']=$i;
          $i++;
          if(!empty($sortnow) && !empty($sortnow[$key])) $onlyids[]=$key;
      }
      $idarr=explode('i',$ids);
      $newids='';
      $notfind=true;
      foreach ($idarr as $vo) {
        if(!in_array($vo, $onlyids)){
          if($sorts[$vo]['order']>$sorts[$id]['order'] && $notfind){//找到位置
             $newids.=$newids==''?$id.'i'.$vo : 'i'.$id.'i'.$vo;
             $notfind=false;
          }else $newids.=$newids==''?$vo : 'i'.$vo;
        } 
      }
      if($notfind) $newids.=$newids==''?$id:'i'.$id;
      return $newids;
    }else return $id;
}
//列表多条件减少栏目处理
function subexsort($ids,$getout)
{
    if(!empty($ids)){
      $idarr=explode('i',$ids);
      $newids='';
      foreach ($idarr as $vo) {
        if(is_array($getout))  $ifpass=empty($getout[$vo])?true:false;
        else $ifpass=($vo!=$getout)?true:false;
        if($ifpass) $newids.=$newids==''?$vo : 'i'.$vo;
      }
      return $newids;
    }else return '';
}
//修改配置参数
function conReplace($value){
      if($value=='true') return true;
      if($value=='false') return false;
      if(preg_match("/^\d*$/",$value) && strlen($value)<10 && !empty($value)) return intval($value);
      return $value;
    }
<?php
class setController extends commonController
{
	// 显示主设置
	public function index()
	{
		$config=require(BASE_PATH.'/config.php');//后台部分配置固定，需要重加载配置
		if(!$this->isPost()){
			$this->config=$config;
			$this->display();
		}else{
			$newconfig = $_POST; //接收表单数据
			
			//将url规则转换为数组
			if(empty($newconfig['REWRITE'])) $newconfig['REWRITE']=array();
			else{
               $rewrites=explode("\r\n",$newconfig['REWRITE']);
               $newconfig['REWRITE']=array();
               if(!empty($rewrites)){
               	   foreach ($rewrites as $value) {
               	      if(!empty($value)) $rewrite=explode("=",$value);
               	      if(!empty($rewrite[1])){
               	      	$rewrite[0]=trim($rewrite[0]);
               	      	$rewrite[1]=trim($rewrite[1]);
               	      	$newconfig['REWRITE'][$rewrite[0]]=$rewrite[1];
               	      } 
                   }
               }
			}
            if(!($config['REWRITE']===$newconfig['REWRITE'])){
                del_dir(config('HTML_CACHE_PATH'));
            }
			$config['REWRITE']=array();
			foreach ($newconfig as $key => $value) {
				if(is_array($value)){
					foreach ($value as $k=> $v) {
						$config[$key][$k]=conReplace($v);
					}
				}else $config[$key] = conReplace($value);
			}
			unset($config['__hash__']);
			if (save_config(BASE_PATH . '/config.php',$config)) {
				$this->success('设置修改成功~');
			} else {
				$this->error('设置修改失败');
			}
		}
	}
	//后台方法管理
	public function menuname()
	{
		$list=model('method')->select('','','rootid,id');
		if(!$this->isPost()){
			$this->list= $list;
			$this->display();
		}else{
			//菜单显示设置
			$menu=implode(',',$_POST['menu']);
			model('method')->update("id IN($menu) AND rootid!= 0","ifmenu='1'");//除app应用外
			model('method')->update("id NOT IN($menu) AND rootid!=0","ifmenu='0'");
			//方法名称设置
			$menuname=$_POST['mname'];
			foreach ($list as $vo){
				$name=in(trim($menuname[$vo['id']]));
				if($vo['name']!=$name && $vo['operate']!=$name && !empty($name))//除app应用外
				model('method')->update("id='".$vo['id']."'","name='$name'");
			}
			$this->success('设置成功',url('set/menuname'));
		}
	}
	//清空缓存
	public function clear()
	{
		$path['db']=config('DB_CACHE_PATH');
		$path['temp']=config('TPL_CACHE_PATH');
		$path['html']=config('HTML_CACHE_PATH');
		if(empty($_GET['file'])){
			$this->dbsize=intval(holdersize($path['db'])/1024);
			$this->temsize=intval(holdersize($path['temp'])/1024);
			$this->htmlsize=intval(holdersize($path['html'])/1024);
			$this->display();
		}else{
			$file=$_GET['file'];
			if(del_dir($path[$file])) echo '<div class="inputhelp">清空成功~</div>';
			else echo '<div class="inputhelp">已经是空里了~</div>';
		}
	}

	private $tpath='apps/default/view/';//前台模板路径
	//前台选择
	public function tpchange($appname='default')
	{
		$config=appConfig($appname);
		if(empty($config['TPL']['TPL_TEMPLATE_PATH'])) $this->error('该应用不支持多模版');
		if($this->isPost()){
			$tpfile = $_POST['tpfile'];
			$type = intval($_POST['type']);
			if(empty($tpfile)) $this->error('参数错误~');
			$tpname=$type?'TPL_TEMPLATE_PATH_MOBILE':'TPL_TEMPLATE_PATH';//判断模板类型
			if($tpfile!=$config['TPL'][$tpname]){//切换模板时
				$tpcachepath=substr(config('TPL_CACHE_PATH'), 0, -1);
				if(is_dir($tpcachepath)) del_dir($tpcachepath);//清除模板缓存
				$config['TPL'][$tpname]=$tpfile;
				if (save_config($appname,$config)){
					echo 1;
					return;
				}
				else{
					echo '模板设置失败~';
					return;
				}
			}
           echo '当前模板已经使用~';
		}else{//ajax接收数据
			$templepath=BASE_PATH . $this->tpath;
			$tps=getDir($templepath);
			foreach ($tps as $vo){
				$infofile=$templepath.$vo.'/info.php';
				if(file_exists($infofile))
				   $tpinfo[$vo]=require($infofile);
				else $tpinfo[$vo]=array();
			}
			$this->tpinfo=$tpinfo;
			$this->fileNow=$config['TPL']['TPL_TEMPLATE_PATH'];//当前模板文件名
			$this->fileNowMobile=$config['TPL']['TPL_TEMPLATE_PATH_MOBILE'];//当前移动端模板文件名
			$this->display();
		}
	}
	public function tplist()
	{
	   $tpfile=$_GET['Mname'];
	   if(empty($tpfile)) $this->error('非法操作~');
       $templepath=BASE_PATH . $this->tpath.$tpfile.'/';
       $list=getFileName($templepath);
       $this->tpfile=$tpfile;
       $this->flist=$list;
       $this->display();
	}

	public function tpadd()
	{
	   $tpfile=$_GET['Mname'];
	   if(empty($tpfile)) $this->error('非法操作~');
	   $templepath=BASE_PATH . $this->tpath.$tpfile.'/';
	   if($this->isPost()){
	   	 $filename=trim($_POST['filename']);
	   	 $code=stripcslashes($_POST['code']);
	   	 if(empty($filename)||empty($code)) $this->error('文件名和内容不能为空');
         $filepath=$templepath.$filename.'.php';
         if($this->ifillegal($filepath)) {$this->error('非法的文件路径~');exit;}
         try{
			file_put_contents($filepath, $code);
		  } catch(Exception $e) {
			$this->error('模板文件创建失败！');
		  }	
		  $this->success('模板文件创建成功！',url('set/tplist',array('Mname'=>$tpfile)));
	   }else{
	   	 $this->tpfile=$tpfile;
	   	 $this->display();
	   	
	   }
	}

	public function tpedit()
	{
	   $tpfile=$_GET['Mname'];
	   $filename=$_GET['fname'];
	   if(empty($tpfile) || empty($filename)) $this->error('非法操作~');
	   if($this->isPost()){
	   	   $code=$_POST['code'];
           if(empty($code)) $this->error('模板内容不能为空~');
		   try{
		      $filepath=BASE_PATH . $this->tpath.$tpfile.'/'.$filename;
		     if($this->ifillegal($filepath)) {$this->error('非法的文件路径~');exit;}
			  file_put_contents($filepath, stripcslashes($code));
		   } catch(Exception $e) {
			   $this->error('模板文件保存失败！');
		   }	
		   $this->success('模板保存成功！',url('set/tplist',array('Mname'=>$tpfile)));
	   }else{
          $this->tpfile=$tpfile;
          $this->filename=$filename;
	   	  $this->display();
	   }
	   
	}
	public function tpgetcode()
	{
	   $tpfile=$_POST['Mname'];
	   $filename=$_POST['fname'];
	   if(empty($tpfile) || empty($filename)) $this->error('非法操作~');
	   $filepath=BASE_PATH . $this->tpath.$tpfile.'/'.$filename;
	   if($this->ifillegal($filepath)) exit('非法的文件路径');
	   try{
			$code = file_get_contents($filepath);
			echo $code;
		  } catch(Exception $e) {
			echo '读取文件失败';
		}
	}

	public function tpdel()
	{
       $tpfile=$_GET['Mname'];
	   $filename=$_GET['fname'];
	   if(empty($tpfile) || empty($filename)) $this->error('非法操作~');
	   $filepath=BASE_PATH . $this->tpath.$tpfile.'/'.$filename;
	   if($this->ifillegal($filepath)) {$this->error('非法的文件路径~');exit;}
	   try{
			@unlink($filepath);
		} catch(Exception $e) {
			$this->error('文件删除失败！');
		}	
		$this->success('文件删除成功~',url('set/tplist',array('Mname'=>$tpfile)));
	}

	protected  function ifillegal($path)
	{
       if(strstr($path,"./")||strstr($path,".\\")||!strstr($path,"/view/")) return true;
       else return false;
	}
}
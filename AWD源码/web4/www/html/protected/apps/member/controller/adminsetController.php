<?php
class adminsetController extends appadminController{
	protected function setcf($config)
	{
        $newconfig=$_POST;
        foreach ($newconfig as $key => $value) {
			if(is_array($value)){
				foreach ($value as $k0 => $v0) {
					if(is_array($v0)){
                        foreach ($v0 as $k1=> $v1) {
                        	$config[$key][$k0][$k1]=conReplace($v1);
                        }
					}else $config[$key][$k0]=conReplace($v0);
				}
			}else $config[$key] = conReplace($value);
		}
		if (save_config(BASE_PATH . 'apps/member/config.php',$config)) {
			$this->success('设置修改成功~',$_SERVER['HTTP_REFERER']);
		} else {
			$this->error('设置修改失败');
		}
	}
	public function index()
	{
		$memberconfig=appConfig('member');
		if(!$this->isPost()){
			if(!empty($memberconfig['sortallow'])) $exsort=explode(',', $memberconfig['sortallow']);
			$sortlist=model('sort')->select("type='1' OR type='2'",'id,name,deep,path,norder,type');
			if(!empty($sortlist)){
				foreach($sortlist as $key=>$vo){
				  $sortlist[$key]['space']= str_repeat('├┈┈┈', $vo['deep']-1);
                  if(isset($exsort)) $sortlist[$key]['checked']=in_array($vo['id'],$exsort)?'checked':'';
                }
			    $sortlist=re_sort($sortlist);
			    $this->sortlist=$sortlist;
			}
			$this->config=$memberconfig;
			$this->display();
		}else{
			$_POST['sortallow']=empty($_POST['alsort'])?'':implode(',',$_POST['alsort']);
			unset($_POST['alsort']);
			$this->setcf($memberconfig);
        }
	}
}
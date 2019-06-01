<?php
class indexController extends baseController{
	protected $layout = 'layout';
	protected $lockFile = '';
	
	protected function init(){
		$this->lockFile = BASE_PATH . 'apps/' . APP_NAME .'/install.lock';
		if(ACTION_NAME !='ok' && file_exists($this->lockFile) ){
			$this->error('程序安装已被锁定，如需重新安装，请先删除文件' . str_replace("\\", "/", $this->lockFile));
			exit;
		}
		$this->title = config('title');
		$this->menu = array(
				'index'=>'1.协议',
				'env'=>'2.系统检查',
				'db'=>'3.数据库安装',
				'ok'=>'4.安装状态',
			);
	}
	
	//引导首页
	public function index(){
		$this->display();
	}
	
	//检查环境
	public function env(){
		$this->ifMysql = function_exists('mysql_connect');
		$this->ifVer = ((float)substr(PHP_VERSION, 0, 3) >= 5.0 ) ? true : false;
		$this->ifGd = function_exists('gd_info');
        $this->yes='<font color="green">√</font>';
        $this->no='<font color="red">×</font>';
		
		$rwFiles = array();
		foreach((array)config('rw_files') as $file){
			$perms = substr( sprintf("%o", @fileperms($file)), -4);
			$rwFiles[$file] = $perms >0644 ? true : false;
		}
		$this->rwFiles = $rwFiles;
		
		$this->display();
	}
	
	//安装数据库
	public function db(){
		if( !$this->isPost() ){
			$this->randomcode= substr(cp_encode(time()),-6);
			$this->display();
		}else{
			if(empty($_POST['DB']['DB_HOST'])||empty($_POST['DB']['DB_USER'])||empty($_POST['DB']['DB_NAME'])||empty($_POST['DB']['DB_PORT'])||empty($_POST['DB']['DB_PREFIX'])||empty($_POST['APP']['COOKIE_PRE']))
			$this->error('安装信息没有填写完整~');
		    
		    $ifdata=empty($_POST['IF_DATA'])?false:true;
		    $ifupdata=empty($_POST['IF_UPDATA'])?false:true;
		    unset($_POST['IF_DATA']);
		    unset($_POST['IF_UPDATA']);
		    $_POST['TPL']['TOKEN_KEY']=substr(cp_encode(rand(100,10000)),-7);
		    $_POST=in($_POST);
			config($_POST);
			
			//安装数据库文件
			if($ifdata)  model('install')->installSql( BASE_PATH . 'apps/' . APP_NAME .'/db.sql' );
			else model('install')->installSql( BASE_PATH . 'apps/' . APP_NAME .'/cdb.sql' );
 
			if(!$ifupdata){//清空上传文件
				del_dir(ROOT_PATH . 'upload/links',false);
                del_dir(ROOT_PATH . 'upload/news/image',false);
                del_dir(ROOT_PATH . 'upload/photos',false);
                del_dir(ROOT_PATH . 'upload/pages/image',false);
                del_dir(ROOT_PATH . 'upload/extend',false);
                del_dir(ROOT_PATH . 'upload/fragment/image',false);
                del_dir(ROOT_PATH . 'upload/member/image',false);
			}

			//修改配置文件
			if( !save_config(BASE_PATH . '/config.php', array('DB' => config('DB'),'APP'=>config('APP'),'TPL'=>config('TPL') ) ) ){ 
				cpError::show('配置文件写入失败！');
			}
			
			//安装成功，创建锁定文件
			if( NULL == ($fp = @fopen($this->lockFile, 'w')) ){
				cpError::show('数据库安装成功，但创建锁定文件失败！请手动删除install安装目录');
			}else{
				fwrite($fp, 'YXcms');
				fclose($fp);
			}
			
			$this->redirect( url('index/ok') );
		}
	}
	
	//安装成功
	public function ok(){
		$this->display();
		//程序安装结束之后，/删除install目录
		if( config('run_after_del') ){
			del_dir( BASE_PATH . 'apps/' . APP_NAME  ); 
		}
	}
}
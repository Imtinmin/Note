<?php
class dbbackController extends commonController
{
	static protected  $ndb='';
	public function __construct()
	{
		parent::__construct();
		self::$ndb=new Dbbak(config('DB_HOST'),config('DB_USER'),config('DB_PWD'),config('DB_NAME'),'utf8',ROOT_PATH.'data/db_back/');
	}

	//显示备份
	public function index()
	{
		$list=self::$ndb->getTables(config('DB_NAME'));//数据库表名
		if(!$this->isPost()){
			$this->table=$list;
			//$this->assign('list',$this->getFileName('../data/db_back'));//文件夹下所有文件信息
			$this->files=getDir(self::$ndb->dataDir);//获得文件夹列表
			$this->display();
		}else{
			@set_time_limit(0);
			$backtype=intval($_POST['backtype']);
			$table=$_POST['table'];
			$db_size=$_POST['size'];
			if($backtype)
			{
				$table=$list;
			}
			else {if(empty($table)) $this->error('请选择需要备份的表~');}
			if(self::$ndb->exportSql($table,$db_size))
			$this->success('备份成功',url('dbback/index'));
			else $this->error('备份失败');
		}

	}

	//恢复已存在备份
	public function recover()
	{
		@set_time_limit(0);
		$file=$_GET['f'];
		if(empty($file)) $this->error('参数错误');
		if(self::$ndb->importSql($file.'/'))
		{
			$this->success('数据恢复成功！',url('dbback/index'));
		}
		else{
			$this->error('数据恢复失败！');
		}
	}
	
	//ajax显示备份详细信息
	public function detail(){
		$file=$_GET['f'];
		if(empty($file)) {echo '参数错误'; return;}
		$list=getFileName(self::$ndb->dataDir.$file.'/');
		if(empty($list)) echo '没有详细信息';
		else{
		$str.='<table width="100%"><tr><th>分卷</th><th>大小</th><th>修改时间</th></tr>';
		foreach($list as $vo)
		   $str.='<tr><td align="center">'.$vo['name'].'</td><td align="center">'.$vo['size'].'kb</td><td align="center">'.$vo['time'].'</td></tr>';
		$str.='</table>';
		echo $str;
		}
	}

	public function del()
	{
		$file=$_GET['f'];
		if(empty($file)) $this->error('参数错误');
		if(del_dir(self::$ndb->dataDir.$file))
		$this->success('删除成功',url('dbback/index'));
		else $this->error('删除失败');
	}

	public function sqlrun(){
       if($this->isPost()){
			$sqlcode=out($_POST['sqlcode']);
			$sqlcode=str_replace('<prefix>', config('DB_PREFIX'), $sqlcode);
			$result=model('method')->query($sqlcode);
			if(!is_array($result) && $result) $this->num=model('method')->db->affected_rows();
			$this->sqlcode=$sqlcode;
			$this->list=$result;
		}
		$this->display();
	}
}
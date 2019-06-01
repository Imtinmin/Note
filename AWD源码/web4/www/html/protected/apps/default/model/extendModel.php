<?php
class extendModel extends baseModel{
	protected $table = 'extend';

    public function TableExit($table){
       $dbname=config('DB_NAME');
       $sqljg="SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA='{$dbname}' AND TABLE_NAME ='{$this->prefix}{$table}'";
	   $dtables=$this->model->query($sqljg);
	   if(empty($dtables)) return false;
	   return true;
    }
	public function Extfind($table,$where,$field=''){
		if(!$this->TableExit($table)) return false;
       return $this->model->table($table)->where($where)->field($field)->find();
	}

	public function Extin($table,$data){
		if(!$this->TableExit($table)) return false;
       return $this->model->table($table)->data($data)->insert();
	}

	public function Extselect($table,$where='',$field='',$order='',$limit=''){
		if(!$this->TableExit($table)) return false;
       return $this->model->table($table)->where($where)->field($field)->order($order)->limit($limit)->select();
	}
	
	public function Extcount($table,$where=''){
	   if(!$this->TableExit($table)) return false;
	   return $this->model->table($table)->where($where)->count();
	}
}
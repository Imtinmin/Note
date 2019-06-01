<?php
class extendModel extends baseModel{
	protected $table = 'extend';

	public function addtable($table,$type=0){
	   if($type)
       $sql="CREATE TABLE IF NOT EXISTS {$this->prefix}{$table}
			(
                `id` int(11) NOT NULL auto_increment,
                `addtime` int(11) NOT NULL,
                `ip` varchar(16) NOT NULL,
                `ispass` tinyint(1) NOT NULL,
                 PRIMARY KEY  (`id`)
            )ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
       else $sql="CREATE TABLE IF NOT EXISTS {$this->prefix}{$table}
			(
                `id` int(11) NOT NULL auto_increment,
                 PRIMARY KEY  (`id`)
            )ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
       return $this->model->query($sql);
	}

    public function TableExit($table){
       $dbname=config('DB_NAME');
       $sqljg="SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA='{$dbname}' AND TABLE_NAME ='{$this->prefix}{$table}'";
	   $dtables=$this->model->query($sqljg);
	   if(empty($dtables)) return false;
	   return true;
    }

    public function FieldExit($table,$field){
       $dbname=config('DB_NAME');
       $sqljg="SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='{$dbname}' AND TABLE_NAME ='{$this->prefix}{$table}' AND COLUMN_NAME='{$field}'";
	   $fields=$this->model->query($sqljg);
	   if(empty($fields)) return false;
	   return true;
    }

	public function deltable($table){
	   if($this->TableExit($table)){
	   	 $sql="DROP TABLE {$this->prefix}{$table}";
         return $this->model->query($sql);
	   }return true;
	}

	public function addfield($table,$field,$type){
		if($this->TableExit($table) && !$this->FieldExit($table,$field)){
	       $sql="alter table {$this->prefix}{$table} ADD `{$field}` {$type} NOT NULL ";
           return $this->model->query($sql);
        }return false;
	}

	public function delfield($table,$field){
		if($this->TableExit($table) && $this->FieldExit($table,$field)){
	      $sql="alter table {$this->prefix}{$table} DROP COLUMN `{$field}`";
          return $this->model->query($sql);
        }return false;
	}

	public function Extfind($table,$where=''){
       return $this->model->table($table)->where($where)->find();
	}

	public function Extselect($table,$where='',$order='',$limit=''){
       return $this->model->table($table)->where($where)->order($order)->limit($limit)->select();
	}

	public function Extin($table,$data){
       return $this->model->table($table)->data($data)->insert();
	}

	public function Extup($table,$where,$data){
       return $this->model->table($table)->where($where)->data($data)->update();
	}

	public function Extdel($table,$where){
       return $this->model->table($table)->where($where)->delete();
	}

	public function Extcount($table,$where=''){
	   return $this->model->table($table)->where($where)->count();
	}
}
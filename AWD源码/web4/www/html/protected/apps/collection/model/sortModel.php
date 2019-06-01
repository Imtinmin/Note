<?php
class sortModel extends baseModel{
	protected $table = 'sort';
	
	public function maxid(){
		$tinfo=$this->model->query("select max(id) as maxid from ".$this->prefix.$this->table);
		return $tinfo[0]['maxid'];
	}
}
<?php
class linkModel extends baseModel{
	protected $table = 'link';
	public function groups(){
        $sql="SELECT COUNT(*),groupname FROM {$this->prefix}link GROUP BY groupname";
		return $this->model->query($sql);
	}
}
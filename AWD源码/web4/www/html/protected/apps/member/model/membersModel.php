<?php
class membersModel extends baseModel{
	protected $table = 'members';
	public function memberANDgroup($limit=''){
		$sql="SELECT A.id,A.groupid,A.account,A.nickname,A.regip,A.lastip,A.regtime,A.lasttime,A.islock,B.name FROM {$this->prefix}members A,{$this->prefix}member_group B WHERE A.groupid=B.id  ORDER BY A.groupid,A.id LIMIT {$limit}";
		return $this->model->query($sql);
	}
}
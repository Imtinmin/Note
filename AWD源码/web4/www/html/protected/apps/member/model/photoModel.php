<?php
class photoModel extends baseModel{
	protected $table = 'photo';

	public function photoselect($account='',$sort='',/*$place='',*/$keyword='',$limit=''){
		$where="account='{$account}' ";
		if(!empty($sort)) $where.='AND sort like "'.$sort.'%" ';
		if(!empty($keyword)) $where.='AND title like "%'.$keyword.'%"';
		// if(!empty($place)) $where.='AND places like "%'.$place.'%"';
		return $this->select($where,'id,sort,title,picture,ispass,recmd,addtime,method','recmd DESC,norder desc,id DESC ',$limit);
	}
	public function photocount($account='',$sort='',/*$place='',*/$keyword=''){
		$where="account='{$account}' ";
		if(!empty($sort)) $where.='AND sort like "'.$sort.'%" ';
		if(!empty($keyword)) $where.='AND title like "%'.$keyword.'%"';
		// if(!empty($place)) $where.='AND places like "%'.$place.'%"';
		return $this->count($where);
	}
}
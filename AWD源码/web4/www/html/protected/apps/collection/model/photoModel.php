<?php
class photoModel extends baseModel{
	protected $table = 'photo';

	public function photoANDadmin($sort='',$place='',$keyword='',$limit=''){
		if(!empty($sort)) $where='where '.$this->prefix.'photo.sort like "'.$sort.'%"';
		if(!empty($keyword)) {
			$where.=empty($where)?'where ':' AND ';
			$where.=$this->prefix.'photo.title like "%'.$keyword.'%"';
		}
		if(!empty($place)) {
			$where.=empty($where)?'where ':' AND ';
			$where.=$this->prefix.'photo.places like "%'.$place.'%"';
		}
		if(!empty($_SESSION['admin_sortpower'])) {
			$power=explode(',',$_SESSION['admin_sortpower']);
			foreach ($power as $vo) {
				$where1.=empty($where1)?$this->prefix.'photo.sort like "%'.$vo.'"':' OR '.$this->prefix.'photo.sort like "%'.$vo.'"';
			}
		}
		if(!empty($where1)) $where.=empty($where)?'where '.$where1:' AND ('.$where1.')';
		$sql="SELECT {$this->prefix}photo.id,{$this->prefix}photo.sort,{$this->prefix}photo.norder,{$this->prefix}photo.title,{$this->prefix}photo.color,{$this->prefix}photo.recmd,{$this->prefix}photo.hits,{$this->prefix}photo.ispass,{$this->prefix}photo.addtime,{$this->prefix}photo.method,{$this->prefix}photo.account,{$this->prefix}admin.realname FROM {$this->prefix}photo left outer join {$this->prefix}admin on {$this->prefix}photo.account = {$this->prefix}admin.username {$where}  ORDER BY {$this->prefix}photo.recmd DESC,{$this->prefix}photo.norder desc,{$this->prefix}photo.id DESC LIMIT {$limit}";
		return $this->model->query($sql);
	}
	public function photocount($sort='',$place='',$keyword=''){
		if(!empty($sort)) $where='sort like "'.$sort.'%"';
		if(!empty($keyword)) {
			$where.=empty($where)?'':' AND ';
			$where.='title like "%'.$keyword.'%"';
		}
		if(!empty($place)) {
			$where.=empty($where)?'':' AND ';
			$where.='places like "%'.$place.'%"';
		}
		return $this->count($where);
	}
}
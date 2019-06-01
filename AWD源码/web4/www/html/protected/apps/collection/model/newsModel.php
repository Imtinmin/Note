<?php
class newsModel extends baseModel{
	protected $table = 'news';
	
	public function newsANDadmin($sort='',$place='',$keyword='',$limit=''){
		if(!empty($sort)) $where='where '.$this->prefix.'news.sort like "'.$sort.'%"';
		if(!empty($keyword)) {
			$where.=empty($where)?'where ':' AND ';
			$where.=$this->prefix.'news.title like "%'.$keyword.'%"';
		}
		if(!empty($place)) {
			$where.=empty($where)?'where ':' AND ';
			$where.=$this->prefix.'news.places like "%'.$place.'%"';
		}
		if(!empty($_SESSION['admin_sortpower'])) {
			$power=explode(',',$_SESSION['admin_sortpower']);
			foreach ($power as $vo) {
				$where1.=empty($where1)?$this->prefix.'news.sort like "%'.$vo.'"':' OR '.$this->prefix.'news.sort like "%'.$vo.'"';
			}
		}
		if(!empty($where1)) $where.=empty($where)?'where '.$where1:' AND ('.$where1.')';
		$sql="SELECT {$this->prefix}news.id,{$this->prefix}news.sort,{$this->prefix}news.norder,{$this->prefix}news.title,{$this->prefix}news.color,{$this->prefix}news.picture,{$this->prefix}news.recmd,{$this->prefix}news.hits,{$this->prefix}news.ispass,{$this->prefix}news.addtime,{$this->prefix}news.method,{$this->prefix}news.account,{$this->prefix}admin.realname FROM {$this->prefix}news left outer join {$this->prefix}admin on {$this->prefix}news.account = {$this->prefix}admin.username  {$where}  ORDER BY {$this->prefix}news.recmd DESC,{$this->prefix}news.norder desc,{$this->prefix}news.id DESC LIMIT {$limit}";
		return $this->model->query($sql);
	}
	public function newscount($sort='',$place='',$keyword=''){
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
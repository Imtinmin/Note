<?php
class newsModel extends baseModel{
	protected $table = 'news';

	public function newsANDextend($exttables=array(),$path='',$limit='',$id,$exwhere='',$keyword=''){
        $where="{$this->prefix}news.ispass='1'";
		$exttable=$exttables[0]['tableinfo'];
    	$exfield='';
        $extnum=count($exttables);
        if($keyword) $where.="  AND (".$this->prefix."news.title like '%".$keyword."%' OR ".$this->prefix."news.description like '%".$keyword."%'";
    	for($i=1;$i<$extnum;$i++){
             $exfield.=','.$this->prefix.$exttable.'.'.$exttables[$i]['tableinfo'];
             if($keyword) $where.=" OR ".$this->prefix.$exttable.'.'.$exttables[$i]['tableinfo']." LIKE '%{$keyword}%'";
    	}
        if($keyword) $where.=") ";
        $where.=empty($id)?"  AND {$this->prefix}news.sort LIKE '{$path}%'":" AND ({$this->prefix}news.sort LIKE '{$path}%' OR {$this->prefix}news.exsort LIKE '%{$id}%') ";
        if(!empty($exwhere)) $where.=" AND {$this->prefix}news.exsort LIKE '{$exwhere}'";
		$sql="SELECT {$this->prefix}news.id,{$this->prefix}news.title,{$this->prefix}news.places,{$this->prefix}news.color,{$this->prefix}news.sort,{$this->prefix}news.exsort,{$this->prefix}news.picture,{$this->prefix}news.origin,{$this->prefix}news.hits,{$this->prefix}news.addtime,{$this->prefix}news.method,{$this->prefix}news.description{$exfield} FROM {$this->prefix}news left outer join {$this->prefix}{$exttable} on ({$this->prefix}news.extfield = {$this->prefix}{$exttable}.id) where  {$where}  ORDER BY {$this->prefix}news.recmd DESC,{$this->prefix}news.norder desc,{$this->prefix}news.addtime DESC LIMIT {$limit}";
		return $this->model->query($sql);
	}
    public function newscount($exttables=array(),$path='',$id,$keyword=''){
        $where="{$this->prefix}news.ispass='1'";
        $exttable=$exttables[0]['tableinfo'];
        if($keyword){
           $where.="  AND (".$this->prefix."news.title like '%".$keyword."%' OR ".$this->prefix."news.description like '%".$keyword."%'";
           $extnum=count($exttables);
           for($i=1;$i<$extnum;$i++){
              $where.="  OR ".$this->prefix.$exttable.'.'.$exttables[$i]['tableinfo']." LIKE '%{$keyword}%'";
           }
           $where.=") ";
        }
        $where.=empty($id)?"  AND {$this->prefix}news.sort LIKE '{$path}%'":" AND ({$this->prefix}news.sort LIKE '{$path}%' OR {$this->prefix}news.exsort LIKE '%{$id}%') ";
        $sql="SELECT count(*) as total FROM {$this->prefix}news left outer join {$this->prefix}{$exttable} on ({$this->prefix}news.extfield = {$this->prefix}{$exttable}.id) where  {$where} ";
        $result=$this->model->query($sql);
        return $result[0]['total'];
    }
}
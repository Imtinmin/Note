<?php
class photoModel extends baseModel{
    protected $table = 'photo';
    
    public function photoANDextend($exttables=array(),$path='',$limit='',$id,$exwhere,$keyword=''){
        $where="{$this->prefix}photo.ispass='1'";
        $exttable=$exttables[0]['tableinfo'];
        $exfield='';
        $extnum=count($exttables);
        if($keyword) $where.="  AND (".$this->prefix."photo.title like '%".$keyword."%' OR ".$this->prefix."photo.description like '%".$keyword."%'";
        for($i=1;$i<$extnum;$i++){
             $exfield.=','.$this->prefix.$exttable.'.'.$exttables[$i]['tableinfo'];
             if($keyword) $where.=" OR ".$this->prefix.$exttable.'.'.$exttables[$i]['tableinfo']." LIKE '%{$keyword}%'";
        }
        if($keyword) $where.=") ";
        $where.=empty($id)?"  AND {$this->prefix}photo.sort LIKE '{$path}%'":" AND ({$this->prefix}photo.sort LIKE '{$path}%' OR {$this->prefix}photo.exsort LIKE '%{$id}%')";
        if(!empty($exwhere)) $where.=" AND {$this->prefix}photo.exsort LIKE '{$exwhere}'";
        $sql="SELECT {$this->prefix}photo.id,{$this->prefix}photo.title,{$this->prefix}photo.places,{$this->prefix}photo.color,{$this->prefix}photo.sort,{$this->prefix}photo.exsort,{$this->prefix}photo.picture,{$this->prefix}photo.hits,{$this->prefix}photo.addtime,{$this->prefix}photo.method,{$this->prefix}photo.description{$exfield} FROM {$this->prefix}photo left outer join {$this->prefix}{$exttable} on ({$this->prefix}photo.extfield = {$this->prefix}{$exttable}.id) where  {$where}  ORDER BY {$this->prefix}photo.recmd DESC,{$this->prefix}photo.norder desc,{$this->prefix}photo.addtime DESC LIMIT {$limit}";
        return $this->model->query($sql);
    }
    public function photocount($exttables=array(),$path='',$id,$keyword=''){
        $where="{$this->prefix}photo.ispass='1'";
        $exttable=$exttables[0]['tableinfo'];
        if($keyword){
           $where.="  AND (".$this->prefix."photo.title like '%".$keyword."%' OR ".$this->prefix."photo.description like '%".$keyword."%'";
           $extnum=count($exttables);
           for($i=1;$i<$extnum;$i++){
              $where.="  OR ".$this->prefix.$exttable.'.'.$exttables[$i]['tableinfo']." LIKE '%{$keyword}%'";
           }
           $where.=") ";
        }
        $where.=empty($id)?"  AND {$this->prefix}photo.sort LIKE '{$path}%'":" AND ({$this->prefix}photo.sort LIKE '{$path}%' OR {$this->prefix}photo.exsort LIKE '%{$id}%')";
        $sql="SELECT count(*) as total FROM {$this->prefix}photo left outer join {$this->prefix}{$exttable} on ({$this->prefix}photo.extfield = {$this->prefix}{$exttable}.id) where  {$where}  ";
        $result=$this->model->query($sql);
        return $result[0]['total'];
    }
}
<?php
class linkModel extends baseModel{
	protected $table = 'link';
	public function getlink($group='')
    {
        $where="ispass='1'";
    	if(!($group==''||$group=='all')) $where.=" and groupname='{$group}'";
    	$links = $this->select($where,'','norder desc,id desc');
        if(empty($links)) return '';
        foreach ($links as $key => $vo) {
            if(!empty($vo['logourl'])) $links[$key]['picpath']=$vo['logourl'];
            if(!empty($vo['picture'])) $links[$key]['picpath']=__ROOT__.'/upload/links/'.$vo['picture'];
        }
        return $links;
    }
}
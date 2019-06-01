<?php
class collectionApi extends baseApi{
  //前台菜单
  public function getdefaultMenu(){
    return array();   
  }
  //后台菜单
  public function getadminMenu(){
		return array(
          array('name'=>'采集项目','url'=>url('collection/adminindex/index')),
          array('name'=>'添加采集','url'=>url('collection/adminindex/add')),
		);
  } 
}
<?php
class demoApi extends baseApi{
  //前台菜单
  public function getdefaultMenu(){
    return array('name'=>'前台菜单','r'=>'demo/index/index');   
  }
  //后台菜单
  public function getadminMenu(){
		return array(
              array('name'=>'后台菜单','url'=>url('demo/index/index')),
		);
  } 
}
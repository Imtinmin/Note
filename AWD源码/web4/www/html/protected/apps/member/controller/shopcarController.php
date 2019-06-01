<?php
class shopcarController extends commonController
{
      protected function getgoods()
      {
         if($this->auth['id']){
            $olist=get_cookie('shopcar');
            $list=get_cookie($this->auth['id'].'shopcar');
            if(!empty($olist) && !empty($list)){
               foreach ($list as $key => $value) {
                  foreach ($olist as $k => $v) {
                     if($value['code']==$v['code']) {
                         $list[$key]['num']+=$v['num'];
                         unset($olist[$k]);
                     }
                  }
               }
               if(!empty($olist)) $list=array_merge($list,$olist);
               $this->setgoods($list);
               return $list;
            }
            if(!empty($list)) return $list;
            if(!empty($olist)) {
              $this->setgoods($olist);
              return $olist;
            }
            return '';
         }else return get_cookie('shopcar');
      }

      protected function setgoods($list)
      {
         if($this->auth['id']) {
            set_cookie($this->auth['id'].'shopcar',$list,time()+604800);
            set_cookie('shopcar','',time()-1);
         }
         else set_cookie('shopcar',$list);
      }

      protected function cleargoods()
      {
         set_cookie('shopcar','',time()-1);
         if($this->auth['id'])  set_cookie($this->auth['id'].'shopcar','',time()-1);
      }

      public function index()
      {
        $list=$this->getgoods();
        $this->mailtype=config('MAIL_TYPE');
        $this->payment=config('PAYMENT');
        $this->list=$list;
        $this->display();
      }

      //添加商品到购物车，ajax POST方式参数code、name、price、num
	    public function caradd()
	    {
        $list=$this->getgoods();
        $data['code']=in($_POST['code']);
        $data['name']=in($_POST['name']);
        $data['price']=(float)$_POST['price'];
        $data['num']=intval($_POST['num']);
        if($data['price']<=0 && $data['num']<=0) {echo '价格或数量必须是正数~';return;}
        foreach ($data as $val) { 
          if(empty($val)) {echo '商品信息不全或格式错误~';return;}
        }
        if($data['num']<=0) {echo '数量必须为正整数~';return;}
        if(!empty($list)){
          foreach ($list as $key => $value) {
            if($value['code']==$data['code']) {
              $list[$key]['num']+=$data['num'];
              $this->setgoods($list);
              echo '添加成功~';
              return;
            } 
          }
        }
        $list[]=$data;
        $this->setgoods($list);
        echo '添加成功~';
	    }
      
      //修改购物车商品数量,ajax POST方式参数code、num
      public function caredit()
      {
        $code=$_POST['code'];
        $num=intval($_POST['num']);
        if($num<=0) {echo '数量必须为正数~';return;}
        if(empty($code)||empty($num)) {echo '信息不完整~';return;}
        $list=$this->getgoods();
        if(!empty($list)){
          foreach ($list as $key => $value) {
            if($value['code']==$code) {
              $list[$key]['num']=$num;
              $this->setgoods($list);
              echo 1;
              return;
            } 
          }
        }
        echo '该商品已不存在~';
      }
       
      //删除购物车商品,ajax
      public function cardel()
      {
         $list=$this->getgoods();
         $code=$_POST['code'];
         if(empty($code)) {echo '信息不完整~';return;}
         if(!empty($list)){
          foreach ($list as $key => $value) {
            if($value['code']==$code) {
              unset($list[$key]);
              $this->setgoods($list);
              echo 1;
              return;
            } 
          }
        }
        echo '商品不存在~';
      }

      //清空购物车
      public function carclear()
      {
        $this->cleargoods();
         $this->success('购物车已被清空~',$_SERVER['HTTP_REFERER']);
      }
}
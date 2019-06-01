<?php
class adminorderController extends appadminController
{
      public function index()
      {
        $listRows=10;//每页显示的信息条数
        $url=url('adminorder/index',array('page'=>'{page}'));
        $where="";
        if(isset($_GET['state'])){
          $state=intval($_GET['state']);
          $where="state='".$state."'";
          $url=url('adminorder/index',array('page'=>'{page}','state'=>$state));
        } 

        if(!empty($_GET['stype']) && !empty($_GET['keyword'])) {
          $stype=intval($_GET['stype']);
          $keyword=in(urldecode(trim($_GET['keyword'])));
          switch ($stype) {
            case 1:
              $where="ordernum like '%".$keyword."%'";
              break;
            case 2:
              $where="account like '%".$keyword."%'";
              break;
            default:
              $where="ordernum like '%".$keyword."%'";
              break;
          }
          $url=url('adminorder/index',array('page'=>'{page}','stype'=>$stype,'keyword'=>urlencode($keyword)));
        } 

        $limit=$this->pageLimit($url,$listRows);
        $count=model('orders')->count($where);
        $list=model('orders')->select($where,'','id DESC',$limit);
        $this->list=$list;
        $this->page=$this->pageShow($count);
        $this->display();
      }

      public function detail()
      {
        if(!$this->isPost()){
          if(empty($_GET['id'])) $this->error('非法操作~');
          $id=intval($_GET['id']);
          $info=model('orders')->find("id='{$id}'");
          $list=model('orderDetail')->select("ordernum={$info['ordernum']}",'','id DESC');

          $this->mailtype=config('MAIL_TYPE');
          $this->payment=$info['freightpayment'];
          $this->info=$info;
          $this->list=$list;
          $this->display();
        }else{
          $data=array();
          $ordernum=in($_POST['ordernum']);
          unset($_POST['ordernumber']);
          unset($_POST['__hash__']);
          foreach ($_POST as $key => $vo) {
            $data[$key]=in($vo);
          }
           model('orders')->update("ordernum='{$ordernum}'",$data);
           $this->success('编辑成功~',$_SERVER['HTTP_REFERER']);
        }
      }

      public function del()
      {
        if(!$this->isPost()){
          if(empty($_GET['id'])) {echo '非法操作~';exit();}
          $id=intval($_GET['id']);
          $info=model('orders')->find("id='{$id}' AND state!='1' AND state!='2'",'ordernum');
          if(empty($info)) {echo '该订单未交易完成~';exit();}
          if(!model('orderDetail')->delete("ordernum='{$info['ordernum']}'")) {echo '订单详细删除失败~';exit();}
          if(!model('orders')->delete("id='{$id}'")) {echo '订单删除失败~';exit();}
          echo 1;
        }else{
          if(empty($_POST['delid'])) $this->error('您没有选择~');
          $delid=implode(',',$_POST['delid']);
          $order=model('orders')->select("id in (".$delid.") AND state!='1' AND state!='2'","ordernum");
          if(empty($order)) $this->error('订单未交易完成~');
          if(!model('orders')->delete("id in (".$delid.") AND state!='1' AND state!='2'")) $this->error('删除订单失败~');
          foreach ($order as $value) {
            $orderstr=$value['ordernum'].',';
          }
          if(!isset($orderstr)) $this->error('订单详细为空~');
          $orderstr=substr($orderstr, 0, -1);
          if(model('orderDetail')->delete("ordernum in (".$orderstr.")")) $this->success('订单删除成功~');
          $this->error('订单详细删除失败~');
        }
      }
}
<?php
class orderController extends commonController
{
  public function __construct()
  {
     parent::__construct();
     if(!$this->auth['account']){
        if(empty($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER']=url('default/index/login');
        $this->error('您还没有登陆~',$_SERVER['HTTP_REFERER']);
     }
  }
      public function index()
      {
        $account = $this->auth['account'];

        $listRows=10;//每页显示的信息条数
        $url=url('order/index',array('page'=>'{page}'));
        $limit=$this->pageLimit($url,$listRows);
        $where="account='{$account}'";
        $count=model('orders')->count($where);

        
        $list=model('orders')->select($where,'','id DESC',$limit);
        $this->list=$list;
        $this->page=$this->pageShow($count);
        $this->display();
      }

      public function orderadd()
      {
        $list=get_cookie($this->auth['id'].'shopcar');
        if(!empty($list)){
          $memberconfig=appConfig('member');
          $data['ordersubject']=empty($list[1])?in($list[0]['name']):'合并付款';
          $data['ordernum']=date("YmdHis").rand(0,100);
          $data['account']=$this->auth['account'];
          $data['freighttype']=in($_POST['type']);
          $data['freightpayment']=$memberconfig['PAYMENT'];
          $data['freight']=$memberconfig['MAIL_TYPE'][in($_POST['type'])][1];;//运费
          $data['receivename']=in($_POST['uname']);
          $data['receivephone']=in($_POST['phone']);
          $data['receivemobile']=in($_POST['mobile']);
          $data['receiveaddress']=in($_POST['address']);
          $data['receivezip']=in($_POST['zip']);

          $data['total']=0;
          $data['ordertime']=time();
          $data['state']=0;
          $data['mess']=in($_POST['mess']);
          
          foreach ($list as $value) {
             $value['ordernum']=$data['ordernum'];
             $id=model('orderDetail')->insert($value);
             if(!$id) $this->error('订单物品信息有误~');
             $data['total']+=floatval($value['price'])*intval($value['num']);
          }
          if(model('orders')->insert($data)) {
            set_cookie($this->auth['id'].'shopcar','',time()-1);
            $this->success('订单已生成~',url('order/index'));
          }
          else $this->error('订单生成失败~');
        }else $this->error('您的购物车是空的~');
      }

      public function detail()
      {
          if(empty($_GET['id'])) $this->error('非法操作~');
          $id=intval($_GET['id']);
          $account = $this->auth['account'];
          $info=model('orders')->find("id='{$id}' AND account='{$account}'");
          $list=model('orderDetail')->select("ordernum={$info['ordernum']}",'','id DESC');
          
          $this->mailtype=config('MAIL_TYPE');
          $this->payment=$info['freightpayment'];
          $this->info=$info;
          $this->list=$list;
          $this->display();
      }
      public function pay()
      {
          if(empty($_GET['order'])) $this->error('非法操作~');
          $order=in($_GET['order']);
          $account = $this->auth['account'];
          $info=model('orders')->find("ordernum='{$order}' AND account='{$account}' AND state='0'",'total,freight,freightpayment');
          if(empty($info)) $this->error('该订单不存在~');
          $info['total']+=$info['freightpayment']=='BUYER_PAY'?$info['freight']:0;
          $mes=model('members')->find("account='{$account}'","rmb,crmb");
          if(($mes['rmb']-$mes['crmb']-$info['total'])<0) $this->error('您的额只有￥'.($mes['rmb']-$mes['crmb']).'了，请先联系客服充值~');
          $mes['crmb']+=$info['total'];
          model('members')->update("account='{$account}'",$mes);
          model('orders')->update("ordernum='{$order}' AND account='{$account}' AND state='0'","state='1'");
          $this->success('支付成功~',url('order/index'));
      }
      public function del()
      {
          if(empty($_GET['id'])) $this->error('非法操作~');
          $id=intval($_GET['id']);
          $account = $this->auth['account'];
          $info=model('orders')->find("id='{$id}' AND account='{$account}' AND state!='1' AND state!='2'",'ordernum');
          if(empty($info)) $this->error('该订单未交易完成~');
          if(!model('orderDetail')->delete("ordernum='{$info['ordernum']}'")) $this->error('订单详细删除失败~');
          if(!model('orders')->delete("account='{$account}' AND id='{$id}'")) $this->error('订单删除失败~');
          $this->success('订单删除成功~',url('order/index'));
      }
      public function sure()
      {
          if(empty($_GET['id'])) $this->error('非法操作~');
          $id=intval($_GET['id']);
          $account = $this->auth['account'];
          if(!model('orders')->update("id='{$id}' AND account='{$account}' AND state='2'","state='3'")) $this->error('确认收货失败~');
          $this->success('确认收货成功~',url('order/index'));
      }
}
<?php
class indexController extends commonController
{
	    public function index()
	    {
        $this->act=(empty($_GET['act'])||!Check::url($_GET['act']))?url('index/welcome'):in($_GET['act']);
        $menu=Array ( 
              0 => Array ( 
                    'title' => '会员信息' ,
                    'channels' => Array ( 
                                  0 => Array ( 
                                         'channel' => '账户管理',
                                         'pages' => Array ( 
                                                    0 => Array ('name' => '修改密码', 'url' => 'member/infor/password' ) ,
                                                    1 => Array ('name' => '资料完善', 'url' => 'member/infor/index' ) ,
                                                    2 => Array ('name' => '我的账户', 'url' => 'member/infor/rmb' ) 
                                          ) 
                                  )
                    ) 
               ),
              1 => Array ( 
                    'title' => '信息发布' ,
                    'channels' => Array ( 
                                  0 => Array ( 
                                         'channel' => '信息列表',
                                         'pages' => Array ( 
                                                    0 => Array ('name' => '资讯列表', 'url' => 'member/news/index' ) ,
                                                    1 => Array ('name' => '图集列表', 'url' => 'member/photo/index' ) 
                                          ) 
                                  ) 
                    ) 
               ),
              2 => Array ( 
                    'title' => '在线交易' ,
                    'channels' => Array ( 
                                  0 => Array ( 
                                         'channel' => '在线购物',
                                         'pages' => Array ( 
                                                    0 => Array ('name' => '购物车', 'url' => 'member/shopcar/index' ) ,
                                                    1 => Array ('name' => '订单管理', 'url' => 'member/order/index' ) 
                                          ) 
                                  ) 
                    ) 
               )
         );
         $group_id=$this->auth['groupid']?$this->auth['groupid']:1;
         $notallow=model('memberGroup')->find("id={$group_id}");
         $na=empty($notallow['notallow'])?'':explode('|',$notallow['notallow']);
         foreach ($menu as $key=>$vo) {
             foreach ($vo['channels'] as $ke=>$v) {
                $i=0;
                $page=array();
                foreach ($v['pages'] as $k=>$e) {
                   $juge=ture;
                   if(!empty($na)){
                       foreach ($na as $nv) {
                          if(strpos($e['url'],$nv)!==false) $juge=false;
                       }
                   }
                   if($juge) {
                     $page[$i]['name']=$e['name'];
                     $page[$i]['url']=url($e['url']);
                     $i++;
                   }
                }
              $menu[$key]['channels'][$ke]['pages']=$page;
             }
         }
         //print_r($menu);
         $menulist= json_encode($menu);
         $this->menulist=$menulist;
         $this->display();
	    }

      public function welcome()
      {
          $this->display();
      }

      public function login()
      {
        if(!$this->isPost()){
            $cookie_auth=get_cookie('auth');
            if(!empty($this->auth)) $this->redirect(url('default/index/index'));
            $this->returnurl=$_SERVER['HTTP_REFERER'];
            $this->display();
        }else{
            session_starts();
            $verify=session('verify');
            session('verify',null);
            if(empty($_POST['name'])||empty($_POST['word'])) $this->error('请填写完整信息~');
            $account=in($_POST['name']);
            $password=in($_POST['word']);
            $cookietime=empty($_POST['cooktime'])?0:intval($_POST['cooktime']);
            $returnurl=empty($_POST['returnurl'])?$_SERVER['HTTP_REFERER']:deletehtml($_POST['returnurl']);
            $ucback=api('ucenter','uclog',array($account,$password,$cookietime));
            if(is_array($ucback)){//判断是否UC登录
               list($iflog,$mes,$scripts)=$ucback;
               if($iflog) {
                 $this->success($mes,$returnurl,3,$scripts);
               }else $this->error($mes);
            }else{
                if($this->_login($account,$password,$cookietime))
                {
                  $this->redirect($returnurl);
                }else $this->error('用户名或密码错误，或者您的账户已被锁定');
            }
            
        }
      }

      protected function _login($account,$password,$cookietime=0)
      {
          $acc=model('members')->find("account='{$account}'");
          if($acc['password']!=codepwd($password) || $acc['islock']) return false;
          if($cookietime!=0) $cookietime=time()+$cookietime;
          $data['lastip'] = get_client_ip();
          $data['lasttime']=time();
          model('members')->update("account='{$account}'",$data);
          if($acc['headpic'] && !Check::url($acc['headpic'])) {
            $acc['hpic']=$acc['headpic'];
            $acc['headpic']=__UPLOAD__.'/member/image/'.$acc['headpic'];
          }
          $cookie_auth = $acc['id'].'\t'.$acc['groupid'].'\t'.$acc['account'].'\t'.$acc['nickname'].'\t'.$acc['lastip'].'\t'.$acc['headpic'].'\t'.$acc['hpic'];
          if(set_cookie('auth',$cookie_auth,$cookietime)) return true;
          return false;
      }

      //用户退出
      public function logout()
      {
          $ucloginout=api('ucenter','uclogout');
          $url=empty($_GET['url'])?$_SERVER['HTTP_REFERER']:RemoveXSS($_GET['url']);
          if(set_cookie('auth','',time()-1)) $this->success('您已成功退出~',$url,3,$ucloginout);
      }

      public function regist()
      {
        if(!$this->isPost()){
            if(!empty($this->auth)) $this->redirect(url('default/index/index'));
            $this->display();
        }else{
            session_starts();
            $verify=session('verify');
            session('verify',null);
            if(empty($_POST['name'])||empty($_POST['word'])||empty($_POST['email'])) $this->error('请填写完整信息~');
            
            if(!Check::userName($_POST['name'])) $this->error('账户名格式错误~');
            if(!Check::email($_POST['email'])) $this->error('邮箱格式错误~');
           
            $_POST['nickname']=$_POST['nickname']?in($_POST['nickname']):$_POST['name'];
            $ucback=api('ucenter','ucreg',array($_POST['name'],$_POST['word'],$_POST['email'],$_POST['nickname']));
            if(is_array($ucback)){//判断是否UC注册
               list($iflog,$mes)=$ucback;
               if($iflog) $this->success($mes,url('index/index'));
               else $this->error($mes);
            }else{
               $data['account']=$_POST['name'];
               $acc=model('members')->find("account='".$data['account']."'");
               if(!empty($acc['account'])) $this->error('该账户已经有人注册~');
               $_POST['word']=in($_POST['word']);
               $_POST['sureword']=in($_POST['sureword']);
               if($_POST['word']!=$_POST['sureword']) $this->error('两次密码不相同~');
               $data['password']=codepwd($_POST['word']); 
               $data['nickname']=$_POST['nickname'];
               $data['email']=in($_POST['email']);
               $data['regip']=$data['lastip']=get_client_ip();
               $data['regtime']=$data['lasttime']=time();
               $data['rmb']=$data['crmb']=0;
               $data['islock']=0;
               $data['groupid']=2;
               $id=model('members')->insert($data);
               if($id){
                  $cookie_auth = $id.'\t'.$data['groupid'].'\t'.$data['account'].'\t'.$data['nickname'].'\t'.$data['lastip'];
                  if(set_cookie('auth',$cookie_auth,0)) $this->success('注册成功~',url('index/index'));
               }else $this->error('数据库写入失败~');
            }
        }
      }
      public function getpassword()
      {
        if(!$this->isPost()){
           if($_GET['code']){
              $acc=cp_decode(urldecode($_GET['code']),config('ENCODE_KEY'));
              if(empty($acc)) $this->error('密码重置失效~');
              $info=model('members')->find("account='{$acc}'",'email');
              if(empty($info)) $this->error('密码重置错误~');
              $newpass=rand(100000,1000000);
              $ucback=api('ucenter','editor',array($acc,'',$newpass));
              if(is_array($ucback) && !$ucback[0]) $this->error('UC修改密码'.$ucback[1]);
              $data['password']=codepwd($newpass); 
              if(model('members')->update("account='{$acc}'",$data)) {
                $email=new Email(config('EMAIL'));
                $email->send($info['email'],config('sitename').'账户重置找回成功','您的账户:'.$acc.'&nbsp;新密码是：'.$newpass);
                $this->success('密码重置成功请到邮箱查看密码~',url('default/index/index'));
              }else $this->error('密码重置失败~');
           }else{ 
              $this->display();
           }
        }else{
           $setmes=in($_POST['backname']);
           if(empty($setmes)) $this->error('填写信息不全~');
           switch ($_POST['type']) {
             case 'acc':
               if(!Check::userName($setmes)) $this->error('非法账户名~');
               $info=model('members')->find("account='{$setmes}'",'email');
               if(empty($info)) $this->error('账户不存在~');
               $url='http://'.$_SERVER['HTTP_HOST'].url('member/index/getpassword',array('code'=>urlencode(cp_encode($setmes,config('ENCODE_KEY'),600))));
               $email=new Email(config('EMAIL'));
               $email->send($info['email'],config('sitename').'密码重置','请点击以下链接以重置密码~<br><a href="'.$url.'">重置密码</a>');
               $this->success('请到邮箱查看邮件~',url('index/getpassword'));
               break;
             case 'email':
               if(!Check::email($setmes)) $this->error('邮箱格式错误~');
               $list=model('members')->select("email='{$setmes}'",'account');
               if(empty($list)) $this->error('该邮箱未注册~');
               $email=new Email(config('EMAIL'));
               foreach ($list as $vo) {
                 $url.="<a href='http://".$_SERVER['HTTP_HOST'].url('member/index/getpassword',array('code'=>urlencode(cp_encode($vo['account'],config('ENCODE_KEY'),600))))."'>重置：".$vo['account']."&nbsp;的密码</a><br>";
               }
               $email->send($setmes,config('sitename').'密码重置','请点击以下链接以重置密码~<br>'.$url);
               $this->success('请到邮箱查看邮件~',url('index/getpassword'));
               break;
             default:
               $this->error('错误的类型~');
               break;
           }
        }
       
      }
      //生成验证码
      public function verify()
      {
          Image::buildImageVerify();
      }
}

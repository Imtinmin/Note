<?php
class memberApi extends baseApi{
  public function getdefaultMenu(){
    return array('name'=>'会员中心','r'=>'member/index/index');   
  }
  public function getadminMenu(){
		return array(
              array('name'=>'会员级别','url'=>url('member/admingroup/index')),
			        array('name'=>'会员管理','url'=>url('member/adminmember/index')),
              array('name'=>'配置信息','url'=>url('member/adminset/index')),
              array('name'=>'订单管理','url'=>url('member/adminorder/index')),
			);
  } 
  public function powerCheck(){//参数一：返回1没有权限，返回2未登陆有权限，返回数组登陆有权限
		 $cookie_auth=get_cookie('auth');
     if(empty($cookie_auth)) $group_id=1;//未登录组
     else{
        $memberinfo=explode('\t',$cookie_auth); 
        $auth['id']=$memberinfo[0];
        $auth['groupid']=$memberinfo[1];
        $auth['account']=$memberinfo[2];
        $auth['nickname']=empty($memberinfo[3])?'未知':$memberinfo[3];
        $auth['lastip']=$memberinfo[4];
        $auth['headpic']=$memberinfo[5];
        $auth['hpic']=$memberinfo[6];

        $group_id=intval($auth['groupid']);
     }
      $notallow=model('memberGroup')->find("id={$group_id}");
      if(empty($notallow['notallow'])) return $group_id==1?array(2,$group_id):array($auth,$group_id);
      else{
        $flog=2;
        $rules=explode('|',$notallow['notallow']);
        foreach ($rules as $rule) {
          $power=explode(',',$rule);
          //R匹配
          $reds=explode('/',$power[0]);
          if(!empty($reds[0]) && $reds[0]==APP_NAME) $flog=1;
          if(!empty($reds[1]) && 1==$flog && $reds[1]!=CONTROLLER_NAME) $flog=2;
          if(!empty($reds[2]) && 1==$flog && $reds[2]!=ACTION_NAME) $flog=2;
          //参数匹配判断
          if(!empty($power[1]) && 1==$flog){
            $items=explode('/',$power[1]);
            if(!empty($items)){
              foreach ($items as $value) {
                 $gets=explode('=',$value);
                 if(!empty($gets[1]) && 1==$flog && $_GET[$gets[0]]!=$gets[1]) $flog=2;
              }
            }
          }
          if(1==$flog) return array($flog,$group_id);
        }
        return $group_id==1?array(2,$group_id):array($auth,$group_id);
      }
  } 
}
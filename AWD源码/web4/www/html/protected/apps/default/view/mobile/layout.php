<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="{$keywords}"/>
<meta name="description" content="{$description}"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{$title}</title>
<link href="__PUBLICAPP__/css/default.css" rel="stylesheet" media="screen">
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/bootstrap-ie6.min.css">
<link rel="stylesheet" type="text/css" href="__PUBLICAPP__/css/ie.css">
<![endif]-->
<script type="text/javascript" src="__PUBLICAPP__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/bootstrap.js"></script>
<script type="text/javascript">
function fleshVerify()
{
var timenow = new Date().getTime();
document.getElementById('verifyImg').src= "{url('index/verify')}/"+timenow;
}
//<![CDATA[
jQuery(function() {	
    var isIE = !!window.ActiveXObject;  
    var isIE6 = isIE && !window.XMLHttpRequest;  
    if (isIE && isIE6) $('body').html('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>提醒!</strong> 您正在使用 Internet Explorer 6，您的网上行为将面临巨大安全隐患。建议您升级到 IE8以上版本。</div>');
	//Scroll to top
		jQuery(window).scroll(function() {
			if(jQuery(this).scrollTop() != 0) {
				jQuery('#toTop').fadeIn();	
			} else {
				jQuery('#toTop').fadeOut();
			}
		});
		jQuery('#toTop').click(function() {
			jQuery('body,html').animate({scrollTop:0},300);
	});
	    $('.Notice').tooltip();
});
//]]>
</script>
</head>
<body>
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="{url()}">YXcms</a>
                  <div class="nav-collapse collapse navbar-inverse-collapse">
                    <ul class="nav">
                  {loop $sorts $key $vo}
                    {if $vo['ifmenu']}    
                      {if $vo['deep']==1}
                          {if $vo['nextdeep']==1 || empty($vo['nextdeep'])}
                               <li {if $rootid==$key} class="active" {/if} ><a href="{$vo['url']}">{$vo['name']}</a></li>
                          {else}
                               <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">{$vo['name']}<b class="caret"></b></a><ul class="dropdown-menu">
                          {/if}
                      {elseif $vo['deep']==2}
                          {if $vo['nextdeep']==1}
                               <li {if $rootid==$key} class="active" {/if} ><a href="{$vo['url']}">{$vo['name']}</a></li></ul></li>
                          {else}
                              <li {if $rootid==$key} class="active" {/if} ><a href="{$vo['url']}">{$vo['name']}</a></li>
                          {/if}
                      {/if}
                    {/if}
                  {/loop}
                    </ul>
            {if !$memberoff}<!--判断会员中心app是否开启-->
                {if !empty($auth)}<!--判断会员是否登陆-->
                         <ul class="unstyled inline pull-right mt10">
                            <li class="muted">用户：{$auth['nickname']}</li>
                            <!--li>上次登录：{$auth['lastip']}</li-->
                            <li><a href="{url('member/index/index')}">【会员中心】</a><a href="{url('member/index/logout')}">【退出】</a></li>
                         </ul>
                 {else}
                 <ul class="nav pull-right">
                      <li><a href="{url('member/index/regist')}">注册</a></li>
                      <li class="divider-vertical"></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">登陆 <b class="caret"></b></a>
                        <div class="dropdown-menu" style="padding:10px">
                              <form class="form-horizontal navbar-form" action="{url('member/index/login')}" method="post">
                               <div class="input-prepend">
                                  <div class="control-group">
                                     <span class="add-on">账户</span><input type="text" name="name" id="name" class="input-small">
                                  </div>
                                  <div class="control-group">
                                     <span class="add-on">密码</span><input type="password"  name="word" class="input-small">
                                  </div>
                                  <div class="control-group">
                                     <span class="add-on">验证码：</span><input type="text"  name="checkcode" id="checkcode" class="input-mini">
                                  </div>
                                 <img src="{url('index/verify')}" border="0"  height="30" width="55" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/> <input class="btn btn-small btn-primary" type="submit" value="登 录">
                               </div>
                             </form>
                        </div>
                      </li>
                    </ul>
                    {/if}
              {/if}
                    
                  </div>
                </div>
  </div>
</div>

{include file="$__template_file"}

<div class="footer">
    <div class="container">
      <div class="row-fluid">
        <div class="span3 muted text-center"><h1>YXCMS</h1></div>
        <div class="span9">
             <p class="muted footlink">
             {loop $sorts $key $vo}  
               {if $vo['ifmenu'] && $vo['deep']==1}        
                     <a target="_blank" href="{$vo['url']}">{$vo['name']}</a> &nbsp;|&nbsp;
               {/if}
             {/loop}
             </p>
             <p class="muted">Copyright © 2012-2014 YXcms.net. All rights reserved.Powered By <a class="Notice" data-toggle="tooltip" title="免费版必须保留此链接" href="http://www.yxcms.net">YXcms</a></p>
             <p class="muted">联系电话:{$telephone}&nbsp;&nbsp;&nbsp;&nbsp;QQ:{$QQ}&nbsp;&nbsp;&nbsp;&nbsp;站长邮箱：{$email}&nbsp;&nbsp;&nbsp;&nbsp;地址:{$address}&nbsp;&nbsp;&nbsp;&nbsp;ICP:{$icp}</p>
        </div>
      </div>
    </div>
</div>
<div id="toTop"><button class="btn" type="button"><i class="icon-eject"></i></button></div>
</body>
</html>
<!--[if lte IE 6]>
  <script type="text/javascript" src="js/bootstrap-ie.js"></script>
<![endif]-->
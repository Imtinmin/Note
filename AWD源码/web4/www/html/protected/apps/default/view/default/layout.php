<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="format-detection" content="telephone=no"/>
<meta name="format-detection" content="address=no"/>
<meta content="email=no" name="format-detection" />
<meta name="HandheldFriendly" content="true" />
<title>{$title}</title>
<meta name="keywords" content="{$keywords}"/>
<meta name="description" content="{$description}"/>
<link rel="stylesheet" href="__PUBLICAPP__/css/pintuer.css" type="text/css">
<link rel="stylesheet" href="__PUBLICAPP__/css/yxcms.css" type="text/css">
<script type="text/javascript" src="__PUBLICAPP__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/jquery.cookie.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/pintuer.js"></script>  
<script language="javascript">
//<![CDATA[
function changecolor(){
	var ocolor=$.cookie('yx_ocolor');
	var ncolor=$.cookie('yx_ncolor');
	if(ocolor&&ncolor){
	   $('.bg-'+ocolor).not('.fcolor').removeClass('bg-'+ocolor).addClass('bg-'+ncolor);
	   $('.bg-dark'+ocolor).not('.fcolor').removeClass('bg-dark'+ocolor).addClass('bg-dark'+ncolor);
	   $('.text-'+ocolor).not('.fcolor').removeClass('text-'+ocolor).addClass('text-'+ncolor);
	   $('#toplogo').attr('src','__PUBLICAPP__/images/logo'+ncolor+'.png');
	}
}
jQuery(function() {
	if($.cookie('yx_ncolor')&&$.cookie('yx_ncolor')!='blue'){
		$.cookie('yx_ocolor','blue');
		changecolor();
	}
	$('.change').click(function(){
		var tcolor=$(this).attr('id');
		if($.cookie('yx_ncolor')) $.cookie('yx_ocolor',$.cookie('yx_ncolor'));
		else $.cookie('yx_ocolor','blue');
		$.cookie('yx_ncolor',tcolor,{expires:7});
		changecolor();
	});
});
//]]>
</script>
</head>
<body>
<div class="layout">
  <div class="container height-big">
    <div class="float-left hidden-l fadein-left"><a href="{url()}"><img id="toplogo" src="__PUBLICAPP__/images/logoblue.png" class="img-responsive"></a></div>

    <div class="float-left padding-big-top fadein-right">
      <a href="#" onClick="return false;" id="blue" class="change fcolor txt txt-little radius bg-blue"></a>
      <a href="#" onClick="return false;" id="main" class="change fcolor txt txt-little radius bg-main"></a>  
      <a href="#" onClick="return false;" id="green" class="change fcolor txt txt-little radius bg-green"></a>
      <a href="#" onClick="return false;" id="red" class="change fcolor txt txt-little radius bg-red"></a>  
      <a href="#" onClick="return false;" id="yellow" class="change fcolor txt txt-little radius bg-yellow"></a>
      <a href="#" onClick="return false;" id="black" class="change fcolor txt txt-little radius bg-black"></a>
    </div>
    <div class="float-right padding fadein-right">
      <form method="post" action="{url('index/search')}">
         <input type="text" class="input input-auto border-gray" name="keywords" size="13" placeholder="关键词" />
         <select class="input input-auto border-gray hidden-l" name="type">
          <option value="all">【全部】</option>
          <option value="news">【文章】</option>
          <option value="photo">【图集】</option>
          {loop $sorts $key $vo}
             {if ($vo['type']==1 or $vo['type']==2) and $vo['deep']==1 and $vo['ifmenu']}
                 <option {if $id==$key} selected {/if} value="{$key}">{$vo['name']}</option>
             {/if}
          {/loop}
         </select>
         <button type="submit" class="button bg-blue"/>搜索</button>
      </form>
    </div>
    <div class="hidden-l float-right padding fadein-right  text-right"><span class="text-small">TAGS:</span> 
        {tag:{table=(tags) field=(name,url) order=(hits desc,id desc) limit=(5)}}
            <a class="text-small" href="{if $tag['url']}{$tag['url']}{else}{url('default/index/search',array('keywords'=>urlencode($tag['name']),'type'=>'all'))}{/if}">[tag:name]</a>
         {/tag}...</div>
  </div>
</div>

<div class="layout fixed bg-darkblue">
<div class="container">
<div class="navbar navbar-big bg-inverse radius">
  <div class="navbar-head">
    <button class="button bg icon-navicon" data-target="#navbar-bg1"></button>
    <a href="{url()}"><img src="__PUBLICAPP__/images/36-white.png" class="img-responsive" /></a>
  </div>  
  <div class="navbar-body nav-navicon" id="navbar-bg1">
    <ul class="nav nav-inline nav-menu nav-big" data-offset-spy="90">
      {loop $sortstree $k1 $v1}
         <li {if $rootid==$k1} class="active" {/if} ><a href="{$v1['url']}">{$v1['name']}</a>
             {if $v1['c']}
             <ul class="drop-menu"><!--二级菜单-->
                 {loop $v1['c'] $v2}
                    <li><a href="{$v2['url']}">{$v2['name']}{if $v2['c']}<span class="arrow"></span>{/if}</a>
                        {if $v2['c']}
                        <ul><!--三级菜单-->
                            {loop $v2['c'] $v3}
                                <li><a href="{$v3['url']}">{$v3['name']}{if $v3['c']}<span class="arrow"></span>{/if}</a>
                                    {if $v3['c']}
                                    <ul><!--四级菜单-->
                                        {loop $v3['c'] $v4}<li><a href="{$v4['url']}">{$v4['name']}</a></li>{/loop}
                                    </ul>
                                    {/if}
                                </li>
                            {/loop}
                        </ul>
                        {/if}
                    </li>
                 {/loop}
             </ul>
             {/if}
          </li>
       {/loop}
    </ul>
    <div class="navbar-text navbar-right">
          {if !$memberoff}<!--判断会员中心app是否开启-->
             {if !empty($auth)}<!--判断会员是否登陆-->
               <a href="{url('member/index/index')}" class="button bg-blue">{if $auth['nickname']}{$auth['nickname']}{else}会员中心{/if}</a> <a class="button bg-blue" href="{url('member/index/logout')}">退出</a>
              {else}
                <a class="button bg-blue" href="{url('member/index/login')}">登录</a> <a class="button bg-blue" href="{url('member/index/regist')}">注册</a>
                {if $openapi} <a class="openapi" href="{$openapi['sinaurl']}"><img src="__PUBLIC__/openapi/images/sina_login_btn.png"></a>&nbsp;&nbsp;<a class="openapi" href="{$openapi['qqurl']}"><img src="__PUBLIC__/openapi/images/qq_login.gif"></a>{/if}
             {/if}
           {/if}
    </div>
  </div>
</div>
</div>
</div>
{include file="$__template_file"} 
<div class="bg-darkblue margin-top fadein-bottom">
<div class="container padding-big-top padding-big-bottom">
  <div class="padding-top padding-big-bottom hidden-l text-white  clearfix link">
       {link:friends}<!--all替换为分组名称即可调用指定分组下的链接-->
           {if $link['picpath']} <a  href="[link:url]" target="_blank"><img src="[link:picpath]" alt="[link:name]" ></a>
           {else}<a  href="[link:url]" target="_blank">[link:name]</a> 
           {/if}
       {/link}
  </div>
  <div class="text-center text-white">
  联系电话:{$telephone}&nbsp;&nbsp;&nbsp;&nbsp;QQ:{$QQ}&nbsp;&nbsp;&nbsp;&nbsp;{$email}&nbsp;&nbsp;&nbsp;&nbsp;{$address}&nbsp;&nbsp;&nbsp;&nbsp;{$icp} <br>
     版权所有 ©  All Rights Reserved <a class="text-white" href="{url('index/map')}">网站地图</a>
  </div>
</div>
</div>
<!--[if lt IE 9]>
<script type="text/javascript" src="__PUBLICAPP__/js/respond.js"></script>
<![endif]-->
</body>
</html>
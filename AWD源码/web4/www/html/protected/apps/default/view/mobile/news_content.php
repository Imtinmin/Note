<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript" src="__PUBLICAPP__/js/jquery.pin.min.js"></script>
<script type="text/javascript">
//<![CDATA[
jQuery(function() {
	$("#Lmenu").pin({containerSelector: ".container"});
});
//]]>
</script>
<div class="jumbotron">
  <div class="container subhead">
    <h1>YXcms VIP demo</h1>
    <p class="lead">该模板采用前端框架式架构，其简单灵巧结合了JQuery</p>
  </div>
</div>

<div class="container clearfix">
   <div class="row-fluid">
      
      <div class="span9 mt50">
         <div class="well">
             <ul class="breadcrumb">
                 <li><i class="icon-home"></i><a href="{url()}"> 首页</a> <span class="divider">/</span></li>
                 {loop $daohang $vo}
                     <li><a href="{$vo['url']}">{$vo['name']}</a> <span class="divider">/</span></li>
                 {/loop}
             </ul>
               <h4 class="text-center">{$info['title']}</h4>
               <p class="muted text-center">发布日期：{date($info['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;点击量：{$info['hits']}&nbsp;&nbsp; 信息来源：{$info['from']} </p>
               <div class="content">
               {$info['content']['content']}
               </div>
               {loop $extinfo $vo}
                <div class="content">{$vo['name']}:{$vo['value']}</div>
               {/loop}
            <div class="pagination">{$info['content']['page']}</div>
            {piece:duoshuo}
            <ul class="unstyled">
               <li>上一篇：{if !empty($upnews)}<a href="{$upnews['url']}" onFocus="this.blur()">{$upnews['title']}</a>{else}没有了....{/if}</li>
                <li>下一篇：{if !empty($downnews)}<a href="{$downnews['url']}" onFocus="this.blur()">{$downnews['title']}</a>{else}没有了....{/if}</li>
            </ul>
         </div>
      </div>
      {include file="aCom"}
      
   </div>
</div>
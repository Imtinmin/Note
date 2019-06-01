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
               <p class="muted text-center">发布日期：{date($info['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;点击量：{$info['hits']}</p>
               <div class="well text-info">{$info['content']['content']}</div>
               <div class="pagination">{$info['content']['page']}</div>
             <ul class="thumbnails row-fluid">
              {loop $photolist $key $vo}              
                <li class="span2">
                <a href="#myModal{$key}" title="{$vo['tit']}" data-toggle="modal" class="thumbnail"><img alt="{$vo['tit']}" src="{$PhotoImgPath}thumb_{$vo['picture']}"></a>
                 <div id="myModal{$key}" class="well modal hide text-center">
                      <img alt="{$vo['tit']}" src="{$PhotoImgPath}{$vo['picture']}">
                      <h5>{$vo['tit']}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
                 </div>
              </li>
              {/loop} 
             </ul>
          {piece:duoshuo}
            
            <ul class="unstyled">
               <li>上一图集：{if !empty($upnews)}<a href="{$upnews['url']}" onFocus="this.blur()">{$upnews['title']}</a>{else}没有了....{/if}</li>
                <li>下一图集：{if !empty($downnews)}<a href="{$downnews['url']}" onFocus="this.blur()">{$downnews['title']}</a>{else}没有了....{/if}</li>
            </ul>
         </div>
      </div>
       {include file="pCom"}
   </div>
</div>
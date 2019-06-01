<?php if(!defined('APP_NAME')) exit;?>
<div class="layout listbanner bg-blue">
    <div class="container"><h1 class="fadein-top">YXcms Demo</h1><p class="fadein-bottom">该模板采用前端框架式架构，兼容PC、平板和手机</p></div>
</div>

<div class="container margin-top">
  <div class="line-middle">
    <div class="xm9">
      <ul class="bread bg-blue bg-inverse">
         <li><a href="{url()}" class="icon-home"> 首页</a></li>
         {loop $daohang $vo}
              <li><a href="{$vo['url']}">{$vo['name']}</a></li>
         {/loop}
      </ul>
      <div class="border padding">
         <ul class="list-group">
          {loop $alist $vo}
             <li><a title="{$vo['title']}" href="{$vo['url']}" target="_blank" style="color:{$vo['color']}">{$vo['title']}</a><span class="float-right text-gray">{date($vo['addtime'],Y-m-d H:m:i)}</span></li>
           {/loop}
         </ul>
         <div class="pagelist">
          {$page}
         </div>
       </div>
    </div>
    
     <div class="xm3 hidden-s hidden-l">
         {include file="arightCom"}
     </div>
  </div>
</div>
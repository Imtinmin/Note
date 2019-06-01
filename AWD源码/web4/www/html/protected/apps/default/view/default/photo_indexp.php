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
         <div class="line-middle clearfix">
             {loop $plist $vo}
                  <div class="xl6 xs4 xm3 padding-bottom">
                    <div class="media media-y clearfix">
                        <a title="{$vo['title']}" href="{$vo['url']}" target="_blank"><img src="{$vo['picturepath']}" class="img-responsive border radius" alt="{$vo['title']}"></a>
                        <div class="media-body" style="color:{$vo['color']}">{$vo['title']}&nbsp;<span class="tag bg-red">￥{$vo['jiage']}</span></div>
                    </div>
                  </div>  
             {/loop}              
         </div>
         <div class="pagelist">
          {$page}
         </div>
       </div>
    </div>
    
     <div class="xm3 hidden-s hidden-l">
         {include file="prightCom"}
     </div>
  </div>
</div>
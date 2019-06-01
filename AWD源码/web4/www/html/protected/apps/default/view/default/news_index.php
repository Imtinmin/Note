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
         <ul class="list-media list-underline">
             {loop $alist $vo}
             <li>
                 <div class="media media-x">
                     {if $vo['picture'] && $vo['picture']!='NoPic.gif'}<a class="float-left" title="{$vo['title']}" href="{$vo['url']}" target="_blank"><img src="{$vo['picturepath']}" class="radius" alt="{$vo['title']}"></a>{/if}
                     <div class="media-body height-big">
                         <strong class="float-left" style="color:{$vo['color']}">{$vo['title']}</strong>
                         <span class="text-gray float-right hidden-l">{date($vo['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;点击:{$vo['hits']}</span>
                         <p class="clear">
                         {$vo['description']}...&nbsp;<a class="button button-little bg-blue swing-hover" href="{$vo['url']}">查看详情</a><br>
                           <span class="text-gray">TAGS:
                            {for $i=0;$i<10;$i++}
                               {if !empty($vo['tags'][$i])}
                                   <a class="text-gray" href="{url('default/index/search',array('type'=>'all','keywords'=>urlencode($vo['tags'][$i])))}">{$vo['tags'][$i]}</a>
                               {/if}
                            {/for}
                           </span>
                         </p>
                     </div>
                 </div>
             </li>
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
<?php if(!defined('APP_NAME')) exit;?>
<link href="__PUBLICAPP__/css/photoswipe.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="__PUBLICAPP__/js/klass.min.js"></script>
<script type="text/javascript" src="__PUBLICAPP__/js/code.photoswipe.jquery-3.0.5.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#box img').addClass('img-responsive').addClass('center-block');
	var options = {};
	$("#Gallery a").photoSwipe(options);
   $.each($("pre.lang-html,pre.lang-css,pre.lang-js"), function(i,val){  
     var old=$(val).html();  
     $(val).html('<textarea name="text" id="runcode'+i+'"cols="80"rows="10">'+old+'</textarea><br><input type="button" value="运行代码" onClick="runcode(runcode'+i+')" class="yx-button">&nbsp;<input type="button" value="保存代码" onClick="savecode(runcode'+i+')" class="yx-button">&nbsp;<input type="button" value="复制代码" onClick="copycode(runcode'+i+')" class="yx-button">&nbsp;<input type="button" value="剪切代码" onClick="cutcode(runcode'+i+')" class="yx-button">&nbsp;<input type="button" value="粘贴代码" onClick="pastecode(runcode'+i+')" class="yx-button">');
     //$(val).html(htmlEncode(old));
   }); 
});
</script>
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
           <h2 class="text-center padding-top">{$info['title']}</h2>
           <p class="text-gray border-bottom border-dotted padding">发布日期：{date($info['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;点击量：{$info['hits']}</p>
           <div class="line-big clearfix" id="Gallery">
               {loop $photolist $vo}
                <div class="xl6 xs4 padding-bottom">
                    <div class="media media-y clearfix">
                        <a title="{$vo['tit']}" href="{$PhotoImgPath}{$vo['picture']}"><img src="{$PhotoImgPath}thumb_{$vo['picture']}" alt="{$vo['tit']}" /></a>
                    </div>
               </div>
               {/loop} 
           </div>
          <div class="text-indent height" id="box">
              {$info['content']['content']}
          </div>
           <div class="text-gray"> TAGS:
              {for $i=0;$i<10;$i++}
                 {if !empty($info['tags'][$i])} 
                    <a href="{url('default/index/search',array('type'=>'all','keywords'=>urlencode($info['tags'][$i])))}" class="text-gray">{$info['tags'][$i]}</a>
                 {/if}
              {/for}
            </div>
           {loop $extinfo $vo}
                <div>{$vo['name']}:{$vo['value']}</div>
           {/loop}
         <div class="pagelist">
          {$info['content']['page']}
         </div>
         <ul class="list-unstyle border-top border-dotted padding text-gray">
                <li class="padding-little">上一图集：{if !empty($upnews)}<a href="{$upnews['url']}" onFocus="this.blur()">{$upnews['title']}</a>{else}没有了....{/if}</li>
                <li class="padding-little">下一图集：{if !empty($downnews)}<a href="{$downnews['url']}" onFocus="this.blur()">{$downnews['title']}</a>{else}没有了....{/if}</li>
          </ul>
         {include file="pcomment"}
       </div>
       {if !empty($reles)}
       <div class="panel margin-top">
            <div class="panel-head bg-blue"><h4 class="text-white">相关信息</h4></div>
            <div class="panel-body">
               <ul class="list-unstyle height-big">
                 {loop $reles $vo}
                     <li><a style="color:{$vo['color']}" title="{$vo['title']}" target="_blank" href="{$vo['url']}">{$vo['title']}</a><span class="float-right text-gray hidden-m text-little">{date($vo['addtime'],Y-m-d)}</span></li>
                 {/loop}
               </ul>
            </div>
         </div>
        {/if}
    </div>
    
     <div class="xm3 hidden-s hidden-l">
        {include file="prightCom"}
     </div>
  </div>
</div>
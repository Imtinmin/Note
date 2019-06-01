<?php if(!defined('APP_NAME')) exit;?>
<link href="__PUBLICAPP__/css/smoothproducts.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
$(function(){    
	$('#box img').addClass('img-responsive');
	$("#buy").click(function(){
		    var num=parseInt($("#num").val());
	        $.post("{url('member/shopcar/caradd')}", {code:"{$extdata['pinpai']}",name:"{$info['title']}",price:"{$extdata['jiage']}",num:num},
   				function(data){
					if(confirm(data+"是否进入会员中心管理购物车?")){
                window.location.href="{url('member/index/index',array('act'=>url('member/shopcar/index')))}";
           }else return false;
   			});
    });
})    

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
           <p class="text-gray border-bottom border-dotted padding">发布日期：{date($info['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;点击量：{$info['hits']}</p>
           <div class="line-big clearfix padding">
              <div class="xl12 xs5 text-center">
                <div class="sp-wrap">
                    {loop $photolist $vo}
                       <a href="{$PhotoImgPath}{$vo['picture']}"><img src="{$PhotoImgPath}thumb_{$vo['picture']}" alt="{$vo['tit']}"></a>
                    {/loop} 
               </div>
	          </div>
              <div class="xl12 xs7">
                 <div class="line-big height-big padding-left">            
                   <div class="x12">产品名称：{$info['title']}</div>
                   <div class="x6">{$extinfo[19]['name']}：{$extinfo[19]['value']}</div>
                   <div class="x6">{$extinfo[20]['name']}：{$extinfo[20]['value']}</div>
                   <div class="x6">{$extinfo[21]['name']}：{$extinfo[21]['value']}</div>
                   <div class="x6">{$extinfo[22]['name']}：<span class="tag bg-red">￥{$extinfo[22]['value']}</span></div>
                   <div class="x6">发布日期：{date($info['addtime'],Y-m-d H:m:i)}</div>
                   <div class="x12">数量：<input type="text" value="1" name="num" id="num" size="3" class="input input-auto">&nbsp;<button id="buy" class="button bg-blue">加入购物车</button></div>
                 </div>
              </div>
           </div>
           <script type="text/javascript" src="__PUBLICAPP__/js/smoothproducts.js"></script>
        
       <div class="tab margin-top" data-toggle="hover">
          <div class="tab-head">
            <ul class="tab-nav">
              <li class="active"><a href="#tab-start2">产品详细</a></li>
              <li><a href="#tab-css2">产品评论</a></li>
            </ul>
          </div>
          <div class="tab-body tab-body-bordered">
            <div class="tab-panel active" id="tab-start2">
              <div class="text-indent height" id="box">
              {$info['content']['content']}
              </div>
              <div class="pagelist">
                 {$info['content']['page']}
              </div>
            </div>
             <div class="tab-panel" id="tab-css2">
               {include file="pcomment"}
            </div>
          </div>
      </div>
      
       <ul class="list-unstyle border-top border-dotted padding text-gray">
            <li class="padding-little">上一产品：{if !empty($upnews)}<a href="{$upnews['url']}" onFocus="this.blur()">{$upnews['title']}</a>{else}没有了....{/if}</li>
            <li class="padding-little">下一产品：{if !empty($downnews)}<a href="{$downnews['url']}" onFocus="this.blur()">{$downnews['title']}</a>{else}没有了....{/if}</li>
       </ul>
       
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
    </div>
    
     <div class="xm3 hidden-s hidden-l">
         {include file="prightCom"}     
     </div>
  </div>
</div>
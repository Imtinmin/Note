<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript" src="__PUBLICAPP__/js/jquery.pin.min.js"></script>
<script type="text/javascript">
//<![CDATA[
jQuery(function() {
	$("#Lmenu").pin({containerSelector: ".container"});
	//购物车ajax提交
	$("#buy").click(function(){
		    var num=parseInt($("#appendedInputButton").val());
	        $.post("{url('member/shopcar/caradd')}", {code:"{$extdata['stand']}",name:"{$info['title']}",price:"{$extdata['price']}",num:num},
   				function(data){
					if(confirm(data+"是否进入会员中心管理购物车?")){
                       window.location.href="{url('member/index/index',array('act'=>url('member/shopcar/index')))}";
                    }else return false;
   			});
    });
});
//]]>
</script>
<div class="jumbotron">
  <div class="container subhead">
    <h1>JavaScript插件</h1>
    <p class="lead">Bootstrap自带了13个jQuery插件，这些插件为Bootstrap中的组件赋予了"生命"。</p>
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
            <div class="row-fluid">
                <div id="myCarousel" class="carousel slide span5">
                   <ol class="carousel-indicators">
                      {loop $photolist $key $vo}
                       <li data-target="#myCarousel" data-slide-to="{$key}" {if $key==0} class="active" {/if}></li>
                      {/loop} 
                   </ol>

                   <div class="carousel-inner">
                    {loop $photolist $key $vo}
                       <div class="item {if $key==0} active {/if}"><img alt="{$vo['tit']}" src="{$PhotoImgPath}{$vo['picture']}" />
                       <div class="carousel-caption"><p>{$vo['tit']}</p></div>
                       </div>
                    {/loop} 
                   </div> 
                  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                </div>
                
                 <ul class="unstyled span7 prlist">
                   <li><strong>产品名称</strong>：{$info['title']}</li>
                   <li><strong>{$extinfo[2]['name']}</strong>：{$extinfo[2]['value']}</li>
                   <li><strong>{$extinfo[3]['name']}</strong>：{$extinfo[3]['value']}</li>
                   <li><strong>{$extinfo[4]['name']}</strong>：{$extinfo[4]['value']}</li>
                   <li><strong>{$extinfo[5]['name']}</strong>：{$extinfo[5]['value']}</li>
                   <li><strong>{$extinfo[6]['name']}</strong>：{$extinfo[6]['value']}</li>
                   <li>发布日期：{date($info['addtime'],Y-m-d H:m:i)}</li>
                   <li>
                        <div class="input-append input-prepend ">
                           <span class="add-on">数量:</span>
                           <input class="span2" id="appendedInputButton" name="num"  type="text" value="1"> 
                           <button class="btn btn-primary" id="buy" type="button">立即购买</button>
                       </div>
                   </li>
                </ul>
            </div>
             <div class="row-fluid">
                <div class="navbar-inner">
                    <h5>详细介绍</h5>
                </div>
                <div class="well">{$info['content']['content']}</div>
                 <div class="pagination">{$info['content']['page']}</div>
                {piece:duoshuo}
             </div>
            <ul class="unstyled">
               <li>上一图集：{if !empty($upnews)}<a href="{$upnews['url']}" onFocus="this.blur()">{$upnews['title']}</a>{else}没有了....{/if}</li>
                <li>下一图集：{if !empty($downnews)}<a href="{$downnews['url']}" onFocus="this.blur()">{$downnews['title']}</a>{else}没有了....{/if}</li>
            </ul>
         </div>
      </div>
      
      {include file="pCom"}
   </div>
</div>
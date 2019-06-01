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
      
       {if !empty($sortlist)}  <!--子栏目列表-->
             <ul class="nav nav-tabs  nav-stacked" style="background-color:#fff" >
               <li>
                 <div class="navbar-inner">
                    <a href="#"><h5>{$info['title']}</h5></a>
                 </div>
               </li>
               {loop $sortlist $key $vo}  
                  <li><a title="{$vo['name']}"  href="{$vo['url']}">{$vo['name']}</a></li>
              {/loop}
             </ul>
       {/if}
      
      <div class="{if !empty($sortlist)} span9 {else} span12 {/if} mt50">
         <div class="well">
             <ul class="breadcrumb">
                 <li><i class="icon-home"></i><a href="{url()}"> 首页</a> <span class="divider">/</span></li>
                 {loop $daohang $vo}
                     <li><a href="{$vo['url']}">{$vo['name']}</a> <span class="divider">/</span></li>
                 {/loop}
             </ul>
               <h4 class="text-center">{$title}</h4>
               <div class="content">
               {$info['content']['content']}
               </div>
            <div class="pagination"> {$info['content']['page']}</div>
         </div>
      </div>     
   </div>
</div>
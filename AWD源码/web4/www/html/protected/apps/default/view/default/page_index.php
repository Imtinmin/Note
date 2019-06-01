<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript">
$(document).ready(function(){
	$('#box img').addClass('img-responsive').addClass('center-block');
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
           <h2 class="text-center padding">{$info['title']}</h2>
           <div class="text-indent height" id="box">
              {$info['content']['content']}
           </div>
         <div class="pagelist">
          {$info['content']['page']}
         </div>
       </div>
    </div>
    
     <div class="xm3 hidden-s hidden-l">
         {include file="arightCom"}
     </div>
  </div>
</div>
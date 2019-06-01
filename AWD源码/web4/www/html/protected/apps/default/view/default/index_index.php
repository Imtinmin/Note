<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript">
//重载验证码
function fleshVerify()
{
var timenow = new Date().getTime();
document.getElementById('verifyImg').src= "{url('index/verify')}/"+timenow;
}
</script>
<div class="layout bg-blue fadein-left">
<div class="container">
<div class="banner" data-pointer="1" data-interval="6" data-item="1" data-small="1" data-middle="1" data-big="1" data-style="border-white">
  <div class="carousel">
     {link:banner}<!--全部链接使用link:all-->
           {if $link['picpath']}<div class="item"><a href="[link:url]" target="_blank"><img src="[link:picpath]" alt="[link:name]" class="img-responsive"></a></div>
           {else}<div class="item"><a href="[link:url]" target="_blank">[link:name]</a></div>
           {/if}
     {/link}
  </div>
</div>
</div>
</div>

<div class="container margin-top fadein-bottom">
   <div class="line-middle">
      <div class="xl12 xm5">
         <div class="panel">
            <div class="panel-head bg-blue"><h4 class="text-white">{$sorts['100001']['name']}<a href="{$sorts['100001']['url']}" class="float-right text-white">more</a></h4></div>
            <div class="panel-body media-x">
              <a class="float-left" href="#"><img src="{$sorts['100001']['picture']}" class="radius" alt="{$sorts['100001']['name']}"></a>
              <div class="height text-indent">{$sorts['100001']['description']}...</div>
            </div>
         </div>
      </div>
       
      <div class="xl12 xm7">
        <div class="panel">
          <div class="panel-head bg-blue"><h4 class="text-white">推荐资讯</h4></div>
             <div class="panel-body">
                <ul class="list-media">
                {news:{table=(news) field=(id,title,color,picture,method,description) place=(101) where=(ispass='1') limit=(2)}}
                    <li {if $news_i==1}class="border-bottom padding-big-bottom"{/if}>
                        <div class="media media-x">
                          <a class="float-left" href="[news:url]"><img src="[news:picturepath]" alt="[news:title $len=20]" class="radius" ></a>
                          <div><strong style="color:[news:color]">[news:title]</strong>[news:description]... <a class="button button-little bg-blue swing-hover" href="[news:url]">详细</a></div>
                        </div>
                    </li>
                 {/news} 
                </ul>
             </div>
        </div>
      </div>
   </div>
</div>

<div class="container margin-top fadein-bottom">
         <div class="panel">
            <div class="panel-head bg-blue"><h4 class="text-white">{$sorts['100002']['name']}<a href="{$sorts['100002']['url']}" class="float-right text-white">more</a></h4></div>
            <div class="panel-body">
                <div class="line-middle clearfix">
                {photo:{table=(photo) field=(id,title,color,picture,method) column=(100002|ec) where=(ispass='1') limit=(6)}}
                  <div class="xl6 xs4 xm2 padding-bottom">
                    <div class="media media-y clearfix">
                        <a title="[photo:title]" target="_blank" href="[photo:url]"><img src="[photo:picturepath]" alt="[photo:title]" class="img-responsive border radius"></a>
                        <div class="media-body" style="color:[photo:color]">[photo:title]</div>
                    </div>
                  </div>
                {/photo}
                </div>
            </div>
         </div>
</div>

<div class="container margin-top fadein-bottom">
    <div class="line-middle">
      <div class="xl12 xm8">
        <div class="tab" data-toggle="hover">
          <div class="tab-head">
            <ul class="tab-nav">
              <li class="active"><a href="#tab-start2">{$sorts['100004']['name']}</a></li>
              <li><a href="#tab-css2">{$sorts['100005']['name']}</a></li>
              <li><a href="#tab-units2">{$sorts['100006']['name']}</a></li>
            </ul>
          </div>
          <div class="tab-body tab-body-bordered">
            <div class="tab-panel active" id="tab-start2">
               <ul class="list-unstyle height-big">
                    {news:{table=(news) field=(id,title,color,addtime,method,keywords,description) column=(100004) where=(ispass='1') limit=(7)}}
                       {if $news_i==1} <!--通过计数器判断第一条显示为头条样式-->
                         <li>
                            <a href="[news:url]"><h2 class="text-center" style="color:[news:color]">[news:title $len=20]</h2></a>
                            <p class="text-indent">[news:description]...<a href="[news:url]" class="text-blue">【详细】</a>
                            {for $i=0;$i<4;$i++}
                               {if !empty($news['tags'][$i])}
                                   <a class="text-gray" href="{url('default/index/search',array('type'=>'all','keywords'=>urlencode($news['tags'][$i])))}">{$news['tags'][$i]}</a>
                               {/if}
                            {/for}
                            </p>
                         </li>
                       {else}
                          <li><a class="button button-little" href="{$sorts[$news['sort']]['url']}">{$sorts[$news['sort']]['name']}</a> <a title="[news:title]" target="_blank" href="[news:url]" style="color:[news:color]">[news:title $len=25]</a><span class="float-right text-gray hidden-l text-little">{date($news['addtime'],Y-m-d)}</span></li>
                       {/if}
                    {/news} 
                   <li class="text-right"><a href="{$sorts['100004']['url']}" class="button button-little bg-blue">更多</a></li>
               </ul>
            </div>
            <div class="tab-panel" id="tab-css2">
                <ul class="list-unstyle height-big">
                    {news:{table=(news) field=(id,title,color,addtime,method,keywords,description) column=(100005) where=(ispass='1') limit=(7)}}
                       {if $news_i==1} <!--通过计数器判断第一条显示为头条样式-->
                         <li>
                            <a href="[news:url]"><h2 class="text-center" style="color:[news:color]">[news:title $len=20]</h2></a>
                            <p class="text-indent">[news:description]...<a href="[news:url]" class="text-blue">【详细】</a>
                             {for $i=0;$i<4;$i++}
                               {if !empty($news['tags'][$i])}
                                   <a class="text-gray" href="{url('default/index/search',array('type'=>'all','keywords'=>urlencode($news['tags'][$i])))}">{$news['tags'][$i]}</a>
                               {/if}
                             {/for}
                            </p>
                         </li>
                       {else}
                          <li><a class="button button-little" href="{$sorts[$news['sort']]['url']}">{$sorts[$news['sort']]['name']}</a> <a title="[news:title]" target="_blank" href="[news:url]" style="color:[news:color]">[news:title $len=25]</a><span class="float-right text-gray hidden-l text-little">{date($news['addtime'],Y-m-d)}</span></li>
                       {/if}
                    {/news} 
                   <li class="text-right"><a href="{$sorts['100005']['url']}" class="button button-little bg-blue">更多</a></li>
               </ul>
            </div>
            <div class="tab-panel" id="tab-units2">
                <ul class="list-unstyle height-big">
                    {news:{table=(news) field=(id,title,color,addtime,method,keywords,description) column=(100006) where=(ispass='1') limit=(7)}}
                       {if $news_i==1} <!--通过计数器判断第一条显示为头条样式-->
                         <li>
                            <a href="[news:url]"><h2 class="text-center" style="color:[news:color]">[news:title $len=20]</h2></a>
                            <p class="text-indent">[news:description]...<a href="[news:url]" class="text-blue">【详细】</a>
                            {for $i=0;$i<4;$i++}
                               {if !empty($news['tags'][$i])}
                                   <a class="text-gray" href="{url('default/index/search',array('type'=>'all','keywords'=>urlencode($news['tags'][$i])))}">{$news['tags'][$i]}</a>
                               {/if}
                             {/for}
                            </p>
                         </li>
                       {else}
                          <li><a class="button button-little" href="{$sorts[$news['sort']]['url']}">{$sorts[$news['sort']]['name']}</a> <a title="[news:title]" target="_blank" href="[news:url]" style="color:[news:color]">[news:title $len=25]</a><span class="float-right text-gray hidden-l text-little">{date($news['addtime'],Y-m-d)}</span></li>
                       {/if}
                    {/news} 
                   <li class="text-right"><a href="{$sorts['100006']['url']}" class="button button-little bg-blue">更多</a></li>
               </ul>
            </div>
          </div>
      </div>
    </div>
    
    <div class="xl12 xm4">
        <div class="panel">
          <div class="panel-head bg-blue"><h4 class="text-white">{$sorts['100012']['name']}<a href="#" class="float-right text-white">more</a></h4></div>
             <div class="panel-body">
                <div class="height-little">
                  <form method="post" class="form form-block" action="{$sorts['100012']['url']}">
                     <div class="form-group">
                       <div class="field">
                          <input type="text" class="input" name="tname" data-validate="required:必填" placeholder="姓名" />
                       </div>
                     </div>
                     <div class="form-group">
                       <div class="field">
                          <input type="text" class="input" name="tel" data-validate="required:必填" placeholder="联系电话" />
                       </div>
                     </div>
                     <div class="form-group">
                       <div class="field">
                          <input type="text" class="input" name="qq" placeholder="QQ号" />
                       </div>
                     </div>
                     <div class="form-group">
                       <div class="field">
                          <textarea rows="4" class="input" name="content" data-validate="required:必填" placeholder="留言内容"></textarea>
                       </div>
                     </div>
                     <input type="text" size="6"  class="input input-auto" name="checkcode"  placeholder="验证码" /> <img src="{url('index/verify')}" border="0"  height="28" width="55" style=" cursor:hand;" alt="如果您无法识别验证码，请点图片更换" onClick="fleshVerify()" id="verifyImg"/>
                     <input type="submit" class="button bg-blue float-right">
                  </form>
                </div>
             </div>
        </div>
    </div>
  </div>
</div>

<div class="container margin-top fadein-bottom">
         <div class="panel">
            <div class="panel-head bg-blue"><h4 class="text-white">{$sorts['100011']['name']}<a href="{$sorts['100011']['url']}" class="float-right text-white">more</a></h4></div>
            <div class="panel-body">
                <div class="line-big clearfix">
                {photo:{table=(photo) field=(id,title,color,picture,method) exfield=(jiage) column=(100011) where=(ispass='1') limit=(4)}}
                  <div class="xl6 xs6 xm3 padding-bottom">
                    <div class="media media-y clearfix">
                        <a title="[photo:title]" target="_blank" href="[photo:url]"><img src="[photo:picturepath]" alt="[photo:title]" class="img-responsive border radius-circle"></a>
                        <div class="media-body" style="color:[photo:color]">[photo:title]&nbsp;<span class="tag bg-red">￥[photo:jiage]</span></div>
                    </div>
                  </div>
                {/photo}
                </div>
            </div>
         </div>
</div>
<script language="javascript">
fleshVerify();
</script>
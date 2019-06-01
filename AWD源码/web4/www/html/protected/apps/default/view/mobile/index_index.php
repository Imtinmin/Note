<?php if(!defined('APP_NAME')) exit;?>
<script type="text/javascript">
//<![CDATA[
jQuery(function() {	
    $('.carousel').carousel({  interval: 4000,pause:'hover'}).carousel('cycle');
    $('.popo').popover();
});
//]]>
</script>
<div class="jumbotron masthead">
  <div class="container">
    <div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <h1>YXcms</h1>
	                <p>高效、灵活、实用的网站管理系统，让web开发更迅速、简单</p>
	                <p>
	                   <a href="http://www.yxcms.net/news/index_id_100001.html" class="btn btn-primary btn-large" >下载YXcms</a>
	                </p>
	                <ul class="masthead-links">
	                    <li><a href="#" target="_blank">模板</a></li>
	                    <li><a href="#">案例</a></li>
	                    <li><a href="#">应用</a></li>
	                    <li id="version">1.2.5</li>
	                </ul>
                  </div>
                  <div class="item">
                     <h1>What we do?</h1>
	                <p>将复杂回归简洁，把简单变得精致</p>
	                <p>
	                   <a href="http://www.wyour.com/help/index.html" class="btn btn-success btn-large" id="start-intro">YXcms入门指南</a>
	                </p>
	                <ul class="masthead-links">
	                    <li><a href="#" target="_blank">模板</a></li>
	                    <li><a href="#">案例</a></li>
	                    <li><a href="#">应用</a></li>
	                    <li id="version">1.2.5</li>
	                </ul>
                  </div>
                </div>
     </div>
  </div>
</div>

<div class="container mt20">
  <div class="row-fluid">
    <div class="span6">
       <div class="well">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#col1" data-toggle="tab">新闻摘要</a></li>
              <li><a href="#col2" data-toggle="tab">{$sorts[100006]['name']}</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{$sorts[100005]['name']} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#col3" data-toggle="tab">{$sorts[100016]['name']} </a></li>
                  <li><a href="#col4" data-toggle="tab">{$sorts[100017]['name']} </a></li>
                </ul>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="col1">
                <ul class="unstyled">
                {news:{table=(news) field=(id,title,color,addtime,method,description)  where=(ispass='1') limit=(6)}}
                     {if $news_i==1} <!--通过计数器判断第一条显示为头条样式-->
                        <li class="botline">
                          <a href="[news:url]" class="text-center"><h4 style="color:[news:color]">[news:title $len=20]</h4></a>
                          <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[news:description]</p>
                        </li>
                     {else} 
                    <li><a target="_blank" style="color:[news:color]" class="span9" href="[news:url]">[news:title]</a><span class="span3">{date($news['addtime'],Y-m-d)}</span></li>
                     {/if} 
                {/news}
                </ul>
              </div>
              <div class="tab-pane fade" id="col2">
                 <ul class="unstyled">
                   {news:{table=(news) field=(id,title,color,addtime,method) column=(100006)  where=(ispass='1') limit=(6)}} 
                   <li><a target="_blank" style="color:[news:color]" class="span9" href="[news:url]">[news:title]</a><span class="span3">{date($news['addtime'],Y-m-d)}</span></li>
                   {/news}
                   <li class="text-right"><i class="icon-share"></i><a href="{$sorts[100006]['url']}">&nbsp;更多</a><li>
                 </ul>
              </div>
              <div class="tab-pane fade" id="col3">
                <ul class="unstyled">
                   {news:{table=(news) field=(id,title,color,addtime,method) column=(100016)  where=(ispass='1') limit=(6)}} 
                   <li><a target="_blank" style="color:[news:color]" class="span9" href="[news:url]">[news:title]</a><span class="span3">{date($news['addtime'],Y-m-d)}</span></li>
                   {/news}
                   <li class="text-right"><i class="icon-share"></i><a href="{$sorts[100016]['url']}">&nbsp;更多</a><li>
                 </ul>
              </div>
              <div class="tab-pane fade" id="col4">
                <ul class="unstyled">
                   {news:{table=(news) field=(id,title,color,addtime,method) column=(100017) where=(ispass='1') limit=(6)}} 
                   <li><a target="_blank" style="color:[news:color]" class="span9" href="[news:url]">[news:title]</a><span class="span3">{date($news['addtime'],Y-m-d)}</span></li>
                   {/news}
                   <li class="text-right"><i class="icon-share"></i><a href="{$sorts[100017]['url']}">&nbsp;更多</a><li>
                 </ul>
              </div>
            </div>
       </div>
    </div>
    <div class="span6">
        <div class="tabbable tabs-left well">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#lA" data-toggle="tab">系统架构</a></li>
                <li><a href="#lB" data-toggle="tab">系统特色</a></li>
                <li><a href="#lC" data-toggle="tab">后台入口</a></li>
                <li><a href="#lD" data-toggle="tab">模板说明</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="lA">
                  <p>Yxcms是一款高效,灵活,实用,免费的企业建站系统,基于PHP和mysql技术,采用MVC三层架构，让您拥有更加专业的企业建站和企业网站制作服务。</p>
                </div>
                <div class="tab-pane" id="lB">
                <button class="btn btn-small btn-primary popo"  data-toggle="popover" data-placement="top" data-content="采用三级缓存：数据库缓存、模板缓存、静态缓存，可使网站数据达到百万级负载！" title="高效" type="button"><h3>高&nbsp;&nbsp;效</h3></button>
       <button class="btn btn-small btn-danger popo"  data-toggle="popover" data-placement="bottom" data-content="采用功能与显示分离设计，灵活的标签库和任意拓展的插件机制，让您随心所欲，将DIY进行到底！" title="灵活" type="button"><h3>灵&nbsp;&nbsp;活</h3></button>
       <button class="btn btn-small btn-info popo"  data-toggle="popover" data-placement="top" data-content="拥有建站各种实用功能，摒弃各种复杂繁琐的功能操作。卓越的用户体验，让您使用起来方便明了！" title="实用" type="button"><h3>实&nbsp;&nbsp;用</h3></button>
       <button class="btn btn-small btn-warning popo"  data-toggle="popover" data-placement="bottom" data-content="遵循BSD开源协议，不对用户做任何功能限制，保证用户二次商业开发使用！" title="免费" type="button"><h3>免&nbsp;&nbsp;费</h3></button>
                </div>
                <div class="tab-pane" id="lC">
                  <p>{piece:announce}</p>
                </div>
                <div class="tab-pane" id="lD">
                  <p>本站为YXcms的默认演示模板，给用户展示各种UI使用方法。用户可在模板中自行修改调整。甚至自行设计新模板。</p>
                </div>
              </div>
            </div>
       </div>
  </div>  
  
  <div class="row-fluid">
        <div class="navbar-inner">
            <a class="Notice" data-toggle="tooltip" title="点击看更多" href="{$sorts[100002]['url']}"><h5><i class="icon-share"></i> {$sorts[100002]['name']}</h5></a>
        </div>
        <ul class="thumbnails well">
             {photo:{table=(photo) field=(id,title,picture,method) column=(100002) where=(ispass='1') limit=(6)}} 
                <li class="span2">
                <a title="[photo:title]" href="[photo:url]" class="thumbnail"><img alt="[photo:title]" src="{$PhotoImgPath}thumb_[photo:picture]"></a>
                 <div class="caption text-center"><h6>[photo:title]</h6></div>
                </li>
             {/photo}    
        </ul>
   </div>
  
  <div class="row-fluid">
     <div class="span8">
        <div class="well">
          <ul class="nav nav-tabs">
            <li><a class="Notice" data-toggle="tooltip" title="点击看更多" href="{$sorts[100018]['url']}" ><i class="icon-share"></i> {$sorts[100018]['name']}</a></li>
          </ul>
          <div class="accordion" id="accordion2">
        {news:{table=(news) field=(id,title,content) column=(100018)  where=(ispass='1') limit=(5)}} 
              <div class="accordion-group">
                 <div class="accordion-heading">
                     <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse[news:id]">
                         <i class="icon-edit"></i>&nbsp;[news:title]
                     </a>
                 </div>
                <div id="collapse[news:id]" class="accordion-body collapse {if $news_i==1} in {/if}">
                    <div class="accordion-inner">
                        [news:content]
                    </div>
                </div>
             </div>
        {/news}
           </div>
         </div>
      </div>
     <div class="span4">
          <div class="tabbable tabs-below well">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#Al" data-toggle="tab">友情链接</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="Al">
                    <ul class="thumbnails">
                    {link:friends}<!--all替换为分组名称即可调用指定分组下的链接-->
                      <li>
                        {if $link['picpath']} <a class="thumbnail " href="[link:url]" target="_blank"><img src="[link:picpath]" alt="[link:name]" ></a>
                        {else}<a class="thumbnail " href="[link:url]" target="_blank">[link:name]</a> 
                        {/if}
                      </li>
                    {/link}
                    </ul>
                </div>
              </div>
          </div>
      </div>
  </div>

</div>
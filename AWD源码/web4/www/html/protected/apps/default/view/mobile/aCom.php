<?php if(!defined('APP_NAME')) exit;?>
       <div class="span3"  id="fixmenu">
         <div class="mt50" id="Lmenu">
            {if !empty($sortlist)}  <!--子栏目列表-->
             <ul class="nav nav-tabs  nav-stacked" style="background-color:#fff" >
               <li>
                 <div class="navbar-inner">
                    <a href="#"><h5>{$title}</h5></a>
                 </div>
               </li>
               {loop $sortlist $key $vo}  
                  <li><a title="{$vo['name']}"  href="{$vo['url']}">{$vo['name']}</a></li>
              {/loop}
             </ul>
            {/if}
            
             <ul class="nav nav-tabs  nav-stacked" style="background-color:#fff" >
               <li>
                 <div class="navbar-inner">
                    <a href="#"><h5>热点文章</h5></a>
                 </div>
               </li>
               {news:{table=(news) field=(id,title,color,method) order=(hits desc,id desc) where=(ispass='1') limit=(4)}}
                   <li><a style="color:[news:color]" title="[news:title]" target="_blank" href="[news:url]">[news:title $len=25]</a><span></li>
               {/news}
             </ul>
             
             <ul class="nav nav-tabs  nav-stacked" style="background-color:#fff" >
               <li>
                 <div class="navbar-inner">
                    <a href="#"><h5>推荐文章</h5></a>
                 </div>
               </li>
               {news:{table=(news) field=(id,title,color,method) order=(recmd desc,id desc) where=(ispass='1') limit=(4)}}
                     <li><a style="color:[news:color]" title="[news:title]" target="_blank" href="[news:url]">[news:title $len=25]</a></li>
              {/news}
             </ul>
         </div>
      </div>
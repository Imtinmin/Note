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
            
                <div class="navbar-inner">
                    <a href="#"><h5>热门图集</h5></a>
                 </div>
                <div class="well mb20" >
                {photo:{table=(photo) field=(id,title,picture,method) order=(hits desc,id desc) where=(ispass='1') limit=(2)}}
                   <div class="row-fluid mb20">
                     <a target="_blank" class="span6" title="[photo:title]" href="[photo:url]"><img class="img-rounded"  src="{$PhotoImgPath}thumb_[photo:picture]" alt="[photo:title]"></a>
                     <div class="span6">
                       <p>[photo:title]</p>
                     </div>
                   </div> 
                {/photo} 
                </div>
            
                <div class="navbar-inner">
                    <a href="#"><h5>推荐图集</h5></a>
                 </div>
                <div class="well mb20" >
                {photo:{table=(photo) field=(id,title,picture,method) order=(recmd desc,id desc) where=(ispass='1') limit=(2)}}
                   <div class="row-fluid mb20">
                     <a target="_blank" class="span6" title="[photo:title]" href="[photo:url]"><img class="img-rounded"  src="{$PhotoImgPath}thumb_[photo:picture]" alt="[photo:title]"></a>
                     <div class="span6">
                       <p>[photo:title]</p>
                     </div>
                   </div> 
                {/photo} 
                </div>
         </div>
      </div>
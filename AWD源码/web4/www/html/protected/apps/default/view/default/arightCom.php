<?php if(!defined('APP_NAME')) exit;?>
      {if !empty($sortlist)} 
      <!--当前栏目子栏目调用-->
       <div class="panel margin-bottom">
            <div class="panel-head bg-blue"><h4 class="text-white">{$sorts[$id]['name']}</h4></div>
            <div class="panel-body">
               <ul class="rmenu">
                 {loop sorttree($sortlist) $v1}
                     <li><a href="{$v1['url']}">{$v1['name']}</a>
                     {if $v1['c']}
                     <ul><!--二级-->
                         {loop $v1['c'] $v2}
                            <li><a href="{$v2['url']}">{$v2['name']}</a>
                              {if $v2['c']}
                               <ul><!--三级-->
                                   {loop $v2['c'] $v3}
                                      <li><a href="{$v3['url']}">{$v3['name']}</a></li>
                                   {/loop}
                               </ul>
                              {/if}
                            </li>
                         {/loop}
                     </ul>
                     {/if}
                   </li>
                 {/loop}
               </ul>
            </div>
         </div>
       {/if}
       {if empty($sortlist)} 
       <!--演示顶级栏目id为100003的子栏目调用，若是二级栏目请使用{ loop $sortstree[顶级栏目id]['c'][二级栏目id]['c'] $k1 $v1 } 以此类推-->
       <div class="panel margin-bottom">
            <div class="panel-head bg-blue"><h4 class="text-white">{$sorts['100003']['name']}</h4></div>
            <div class="panel-body">
            <ul class="rmenu">
              {loop $sortstree['100003']['c'] $k1 $v1}
                     <li><a href="{$v1['url']}">{$v1['name']}</a>
                     {if $v1['c']}
                     <ul><!--二级-->
                         {loop $v1['c'] $v2}
                            <li><a href="{$v2['url']}">{$v2['name']}</a>
                              {if $v2['c']}
                               <ul><!--三级-->
                                   {loop $v2['c'] $v3}
                                      <li><a href="{$v3['url']}">{$v3['name']}</a></li>
                                   {/loop}
                               </ul>
                              {/if}
                            </li>
                         {/loop}
                     </ul>
                     {/if}
                   </li>
               {/loop}
            </ul>
            </div>
         </div>
         {/if}

         <div class="panel margin-bottom">
            <div class="panel-head bg-blue"><h4 class="text-white">通知公告</h4></div>
            <div class="panel-body">
                <p class="text-indent">{piece:notice}</p>
            </div>
         </div>
         <div class="panel margin-bottom">
            <div class="panel-head bg-blue"><h4 class="text-white">热门资讯</h4></div>
            <div class="panel-body">
               <ul class="list-unstyle height-big">
                {news:{table=(news) field=(id,title,color,addtime,method)  limit=(5)}}
                     <li><a style="color:[news:color]" title="[news:title]" target="_blank" href="[news:url]">[news:title $len=25]</a><span class="float-right text-gray hidden-m text-little">{date($news['addtime'],Y-m-d)}</span></li>
                {/news}
               </ul>
            </div>
         </div>
         <div class="panel margin-bottom">
            <div class="panel-head bg-blue"><h4 class="text-white">随机资讯</h4></div>
            <div class="panel-body">
               <ul class="list-unstyle height-big">
                   {news:{table=(news) field=(id,title,color,addtime,method) order=(rand) limit=(5)}}
                     <li><a style="color:[news:color]" title="[news:title]" target="_blank" href="[news:url]">[news:title $len=25]</a><span class="float-right text-gray hidden-m text-little">{date($news['addtime'],Y-m-d)}</span></li>
                {/news}
               </ul>
            </div>
         </div>
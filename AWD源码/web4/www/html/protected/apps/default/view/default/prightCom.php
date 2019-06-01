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
       <!--固定子栏目调用-->
       <div class="panel margin-bottom">
            <div class="panel-head bg-blue"><h4 class="text-white">{$sorts['100003']['name']}</h4></div>
            <div class="panel-body">
            <ul class="rmenu">
              <!--演示顶级栏目id为100003的子栏目调用，若是二级栏目请使用{ loop $sortstree[顶级栏目id]['c'][二级栏目id]['c'] $k1 $v1 } 以此类推-->
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
            <div class="panel-head bg-blue"><h4 class="text-white">热门图集</h4></div>
            <div class="panel-body">
              <div class="line-middle clearfix">
              {photo:{table=(photo) field=(id,title,picture,method) order=(hits desc,id desc) where=(ispass='1') limit=(4)}}
               <div class="x6 padding-bottom">
                    <div class="media media-y clearfix">
                        <a target="_blank"  title="[photo:title]" href="[photo:url]"><img src="[photo:picturepath]" alt="[photo:title]" class="img-responsive border radius" ></a>
                        <div class="media-body">[photo:title]</div>
                    </div>
                  </div>
              {/photo}
                </div>
            </div>
         </div>
         <div class="panel margin-bottom">
            <div class="panel-head bg-blue"><h4 class="text-white">随机图集</h4></div>
            <div class="panel-body">
               <div class="line-middle clearfix">
              {photo:{table=(photo) field=(id,title,picture,method) order=(rand) where=(ispass='1') limit=(4)}}
                  <div class="x6 padding-bottom">
                    <div class="media media-y clearfix">
                        <a target="_blank"  title="[photo:title]" href="[photo:url]"><img src="[photo:picturepath]" alt="[photo:title]" class="img-responsive border radius" ></a>
                        <div class="media-body">[photo:title $len=10]</div>
                    </div>
                  </div>
              {/photo}
                </div>
            </div>
         </div>
<?php if(!defined('APP_NAME')) exit;?>
<div class="layout listbanner bg-blue">
    <div class="container"><h1 class="fadein-top">YXcms Demo</h1><p class="fadein-bottom">该模板采用前端框架式架构，兼容PC、平板和手机</p></div>
</div>

<div class="container margin-top">
      <ul class="bread bg-blue bg-inverse">
         <li>一共找到 <font size="+1"> {$count} </font> 个结果</li>
      </ul>
      <div class="border padding">
         <ul class="list-media list-underline">
            {loop $list $vo}
             <li>
                 <div class="media media-x">
                     {if $vo['picturepath']}<a class="float-left" title="{$vo['title']}" href="{$vo['url']}" target="_blank"><img src="{$vo['picturepath']}" class="radius" alt="{$vo['title']}"></a>{/if}
                     <div class="media-body">
                     <strong class="float-left"><a class="button button-little" href="{$sorts[$vo['sort']]['url']}">{$sorts[$vo['sort']]['name']}</a> <?php echo str_replace($keywords,"<font style='color:red'>$keywords</font>",$vo['title']); ?></strong><span class="text-gray float-right">{date($vo['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;点击:{$vo['hits']}</span>
					 <p class="clear height">
					 <?php echo str_replace($keywords,"<font style='color:red'>$keywords</font>",$vo['description']); ?>... <a class="button button-little bg-blue swing-hover" href="{$vo['url']}">查看详情</a><br>
                      <!--自定义字段搜索结果-->
                     {for $i=1;$i<count($extfields);$i++} 
                       <span class="text-gray">{$extfields[$i]['name']}:<?php echo str_replace($keywords,"<font style='color:red'>$keywords</font>",$vo[$extfields[$i]['tableinfo']]); ?></span>
                     {/for}
                     </p>
                     </div>
                 </div>
             </li>
            {/loop}
         </ul>
         <div class="pagelist">
          {$page}
         </div>
       </div>
</div>
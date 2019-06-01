<?php if(!defined('APP_NAME')) exit;?>
<div class="container clearfix">
         <div class="well mt50">
               <ul class="breadcrumb">
                 <li><i class="icon-home"></i><a href="#"> 首页</a> <span class="divider">/</span></li>
                 <li><a href="#">搜索结果页</a> <span class="divider">/</span></li>
                 <li class="active">一共搜索到 <font style="color:red"> {$count} </font> 个结果 </li>
               </ul>
                <form method="get" action="{url('index/search')}" class="form-search">
                  <div class="input-append">
                    <input name="r" type="hidden" value="default/index/search" />
                    <select name="type" class="input-small">
                       <option value="all">全部</option>
                       <option value="news">文章</option>
                       <option value="photo">图集</option>
                     </select>
                     <input type="text"  name="keywords" class="search-query" id="appendedInputButton" placeholder="站内搜索..." >
                     <input type="submit" value="搜 索" class="btn input-small">
                   </div>
               </form>
              {if empty($list)}
                 <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                    没有搜索到任何结果~
                </div>
              {/if}
             {loop $list $vo}
              <div class="media">
                <div class="media-body">
                    <a style="color:{$vo['color']}" class="media-heading" title="{$vo['title']}" href="{url($vo['method'],array('id'=>$vo['id']))}" target="_blank"><h4><?php echo str_replace($keywords,"<font style='color:red'>$keywords</font>",$vo['title']); ?></h4></a>
                    <p class="muted">{date($vo['addtime'],Y-m-d H:m:i)}&nbsp;&nbsp;&nbsp;&nbsp;点击:{$vo['hits']}</p>
                    <?php echo str_replace($keywords,"<font style='color:red'>$keywords</font>",$vo['description']); ?>......
                </div>
              </div>
             {/loop}
            
            <div class="pagination">{$page}</div>
            
         </div>
</div>
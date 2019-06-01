<?php if(!defined('APP_NAME')) exit;?>
<div class="container margin-top">
    <ol>
      {loop sorttree($sorts) $k1 $v1}
         <li {if $rootid==$k1} class="active" {/if} ><a class="h2" href="{$v1['url']}">{$v1['name']}</a>
             {if $v1['c']}
             <ol>
                 {loop $v1['c'] $v2}
                    <li><a class="h3" href="{$v2['url']}">{$v2['name']}</a>
                        {if $v2['c']}
                        <ol>
                            {loop $v2['c'] $v3}
                                <li><a class="h4" href="{$v3['url']}">{$v3['name']}</a>
                                    {if $v3['c']}
                                    <ol>
                                        {loop $v3['c'] $v4}<li class="h5"><a class="h4" href="{$v4['url']}">{$v4['name']}</a></li>{/loop}
                                    </ol>
                                    {/if}
                                </li>
                            {/loop}
                        </ol>
                        {/if}
                    </li>
                 {/loop}
             </ol>
             {/if}
          </li>
       {/loop}
    </ol>
</div>
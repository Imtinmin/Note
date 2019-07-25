{if(!defined("RUN_MODE"))} {!die()} {/if}
{noparse}
<style>
.user-control-nav {padding: 0 7px 4px; border-bottom: 1px solid #e5e5e5; margin-top: 10px; margin-bottom: 10px;}
.user-control-nav > li {float: left; margin: 0 3px 6px;}
.user-control-nav > li > a {float: left; border: 1px solid #f1f1f1; border-radius: 2px; min-width: 100px;}
.user-control-nav > li.active > a {background-color: #ebf2f9; color: #3280fc; border-color: #3280fc;}
.user-control-nav > li > a > .icon-chevron-right {display: none}
.user-control-nav > li > a > [class*='icon-'] {color: #666;}
.user-control-nav > li.active > a > [class*='icon-'] {color: #3280fc;}
</style>
{/noparse}
{$control->loadModel('user')->fixMenus()}
<ul class='nav user-control-nav clearfix'>
{if($thisMethodName !== 'control')}
  <li>{!html::a($control->createLink('user', 'control'), "<i class='icon-th-large'></i> " . $lang->user->control->common, "class='btn default'")}</li>
{/if}
{foreach($control->config->user->navGroups as $group => $items)}
  {$navs = explode(',', $items)}
  {foreach($navs as $nav)}
    {$class = ''}
    {$menu = zget($lang->user->control->menus, $nav, '')}
    {if(empty($menu))} {continue} {/if}
    {@list($label, $module, $method) = explode('|', $menu)}
    {$module = strtolower($module)}
    {$method = strtolower($method)}
    {$menuInfo = explode('|', $menu)}
    {$params   = zget($menuInfo, 3 ,'')}
    {if(!commonModel::isAvailable($module))} {continue} {/if}
    {if($module == $control->app->getModuleName() && $method == $control->app->getMethodName())} {$class .= 'active'} {/if}
    <li class="{$class}">{!html::a($control->createLink($module, $method, $params), $label, "class='btn default'")}</li>
  {/foreach}
{/foreach}
</ul>

{if(!defined("RUN_MODE"))} {!die()} {/if}
{if($extView = $control->getExtViewFile(TPL_ROOT . 'common/footer.html.php'))} {include $extView}  {@return helper::cd()} {/if}
<div class='block-region region-all-bottom blocks' data-region='all-bottom'>{$control->loadModel('block')->printRegion($layouts, 'all', 'bottom')}</div>
<div class='appinfo clearfix'>
  <div class='copyright pull-left'>
    <span style='overflow:hidden; max-width: 200px; height: 20px; line-height: 20px; display:inline-block;'>
     {$contact   = json_decode($config->company->contact)}
     {$company   = (empty($contact->site) or $contact->site == $control->server->http_host) ? $config->company->name : html::a('http://' . $contact->site, $config->company->name, "target='_blank'")}
     &copy; {$company}
    </span>
    <div class='pull-right'>
    {if($control->config->site->execInfo == 'show')} {$control->config->execPlaceholder} {/if}
    </div>
  </div>
  <div class='icpinfo hide'>
    {if(!empty($config->site->icpLink) and !empty($config->site->icpSN))} {!html::a(strpos($config->site->icpLink, 'http://') !== false ? $config->site->icpLink : 'http://' . $config->site->icpLink, $config->site->icpSN, "target='_blank'")} {/if}
    {if(empty($config->site->icpLink) and !empty($config->site->icpSN))}  {$config->site->icpSN} {/if}
  </div>
  <div class='powerby pull-right' id='powerby'>
    {$chanzhiVersion                   = $config->version}
    {$isProVersion                     = strpos($chanzhiVersion, 'pro') !== false}
    {if($isProVersion)} {$chanzhiVersion = str_replace('pro', '', $chanzhiVersion)} {/if}
    {$footerLogo = "<span class='" . ($isProVersion ? 'icon-chanzhi-pro' : 'icon-chanzhi') . "' style='font-size:12px;'></span>"}
    {!printf($lang->poweredBy, $config->version, k(), "$footerLogo <span class='name hide'>" . $lang->chanzhiEPSx . '</span>' . $chanzhiVersion)}
  </div>
</div>

{if(isset($control->config->site->mobileBottomNav) and ($control->config->site->mobileBottomNav == 'hide'))}
{else}
  {$bottomNavs = $control->loadModel('nav')->getNavs('mobile_bottom')}
  <footer class="appbar fix-bottom" id='footerNav' data-ve='navbar' data-type='mobile_bottom'>
    <ul class="nav">
      {foreach($bottomNavs as $nav)}
        {$icon  = ''}
        {$class = ''}
        {if($nav->system == 'contact')}
          {$icon = "<i class='icon icon-comments-alt'></i> "}
          {$class = "class='text-primary'"}
        {/if}
        {if($nav->system == 'company')}
          {$icon = "<i class='icon icon-group'></i> "}
          {$class = "class='text-important'"}
        {/if}
        <li>{!html::a($nav->url, $icon . $nav->title, ($nav->target != 'modal') ? "target='$nav->target' $class" : "data-toggle='modal' $class")}</li>
      {/foreach}
    </ul>
  </footer>
{/if}
{if(isset($pageJS))} {!js::execute($pageJS)} {/if}

{* Load hook files for current page. *}
{$extPath      = dirname(__FILE__) . '/ext/'}
{$extHookRule  = $extPath . 'footer.front.*.hook.php'}
{$extHookFiles = glob($extHookRule)}
{if($extHookFiles)}
  {foreach($extHookFiles as $extHookFile)} 
    {include $extHookFile}
  {/foreach}
{/if}
{* Load hook file for site.*}
{$siteExtPath  = dirname(__FILE__) . DS . "ext/_{{$control->app->siteCode}}/"}
{$extHookRule  = $siteExtPath . 'footer.front.*.hook.php'}
{$extHookFiles = glob($extHookRule)}
{if($extHookFiles)}
  {foreach($extHookFiles as $extHookFile)}
    {include $extHookFile}
  {/foreach}
{/if}
<div class='block-region region-footer hidden blocks' data-region='all-footer'>{$control->loadModel('block')->printRegion($layouts, 'all', 'footer')}</div>
{if(commonModel::isAvailable('shop'))} {include TPL_ROOT . 'common/cart.html.php'} {/if}
{include TPL_ROOT . 'common/log.html.php'}

{* execute script of theme *}
{$baseCustom = isset($control->config->template->custom) ? json_decode($control->config->template->custom, true) : array()}
{if(!empty($baseCustom[CHANZHI_TEMPLATE][CHANZHI_THEME]['js']))} {!js::execute($baseCustom[$template][$theme]['js'])} {/if}
</body>
</html>

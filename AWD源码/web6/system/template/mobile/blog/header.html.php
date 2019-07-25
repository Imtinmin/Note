{if(!defined("RUN_MODE"))} {!die()} {/if}
{if($extView = $control->getExtViewFile(TPL_ROOT . 'blog/header.html.php'))}
  {include $extView}
  {@return helper::cd()}
{/if}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.lite')}
<div class='block-region region-all-top blocks' data-region='all-top'>{$control->block->printRegion($layouts, 'all', 'top')}</div>
<header class='appbar fix-top' id='appbar'>
  <div class='appbar-title'>
    <a href='{$webRoot}'>
     {$logoSetting = isset($control->config->site->logo) ? json_decode($control->config->site->logo) : new stdclass()}
     {$logo = false}
     {if(isset($logoSetting->{{CHANZHI_TEMPLATE}}->themes->all))} {$logo = $logoSetting->{{CHANZHI_TEMPLATE}}->themes->all} {/if}
     {if(isset($logoSetting->{{CHANZHI_TEMPLATE}}->themes->{{CHANZHI_THEME}}))} {$logo = $logoSetting->{{CHANZHI_TEMPLATE}}->themes->{{CHANZHI_THEME}}} {/if}
     {if($logo)}
       {$logo->extension = $control->loadModel('file')->getExtension($logo->pathname)}
       {!html::image($control->loadModel('file')->printFileURL($logo), "class='logo' alt='{{$control->config->company->name}}' title='{{$control->config->company->name}}'")}
     {else}
       <h4>{!$control->config->site->name}</h4>
     {/if}
    </a>
  </div>
  <div class='appbar-actions'>
    {if(commonModel::isAvailable('search'))}
      <div class='dropdown'>
        <button type='button' class='btn' data-toggle='dropdown' id='searchToggle'><i class='icon-search'></i></button>
        <div class='dropdown-menu fade search-bar' id='searchbar'>
          <form action='{!helper::createLink('search')}' method='get' role='search'>
            <div class='input-group'>
              {$keywords = ($control->app->getModuleName() == 'search') ? $control->session->serachIngWord : ''}
              {!html::input('words', $keywords, "class='form-control' placeholder=''")}
              {if($control->config->requestType == 'GET')} {!html::hidden($control->config->moduleVar, 'search') . html::hidden($control->config->methodVar, 'index')} {/if}
              <div class='input-group-btn'>
                <button class='btn default' type='submit'><i class='icon icon-search'></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    {/if}
    <div class='dropdown'>
      {if(!isset($control->config->site->type) or $control->config->site->type != 'blog')}
        {!html::a($config->webRoot, '<i class="icon-home icon-large"></i>', "class='btn'")}
      {/if}

      <button type='button' class='btn' data-toggle='dropdown'><i class='icon-bars'></i></button>
      <ul class='dropdown-menu dropdown-menu-right'>
        {$control->config->siteNavHolder}
      </ul>
    </div>
  </div>
</header>

{$navs = $control->loadModel('nav')->getNavs('mobile_blog')}
<nav class='appnav fix-top appnav-auto' id='appnav'>
  <div class='mainnav'>
    <ul class='nav'>
    {$subnavs = ''}
    {foreach($navs as $nav1)}
      <li class='{$nav1->class}'>
      {if(empty($nav1->children))}
        {!html::a($nav1->url, $nav1->title, ($nav1->target != 'modal') ? "target='$nav1->target'" : "data-toggle='modal'")}
      {else}
        {!html::a("#sub-{{$nav1->class}}", $nav1->title . " <i class='icon-caret-down'></i>", ($nav1->target != 'modal') ? "target='$nav1->target'" : "data-toggle='modal'")}
        {$subnavs .= "<ul class='nav' id='sub-{{$nav1->class}}'>\n"}
        {foreach($nav1->children as $nav2)}
          {$subnavs .= "<li class='{{$nav2->class}}'>"}
          {if(empty($nav2->children))}
            {$subnavs .= html::a($nav2->url, $nav2->title, ($nav2->target != 'modal') ? "target='$nav2->target'" : "data-toggle='modal' class='text-important'")}
          {else}
            {$subnavs .= html::a("javascript:;", $nav2->title . " <i class='icon-caret-down'></i>", "data-toggle='dropdown' class='text-important'")}
            {$subnavs .= "<ul class='dropdown-menu'>"}
            {foreach($nav2->children as $nav3)}
              {$subnavs .= "<li>" . html::a($nav3->url, $nav3->title, ($nav3->target != 'modal') ? "target='$nav3->target'" : "data-toggle='modal' class='text-important'") . '</li>'}
            {/foreach}
            {$subnavs .= "</ul>\n"}
          {/if}
          {$subnavs .= "</li>\n"}
        {/foreach}
        {$subnavs .= "</ul>\n"}
      {/if}
      </li>
    {/foreach}<!-- end nav1 -->
    </ul>
  </div>
  <div class='subnavs fade'>
    {$subnavs}
  </div>
</nav>

<div class='block-region region-all-banner blocks' data-region='all-banner'>
  {$control->block->printRegion($layouts, 'all', 'banner')}
</div>

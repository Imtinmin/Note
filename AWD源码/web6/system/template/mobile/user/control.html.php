{if(!defined("RUN_MODE"))} {!die()} {/if}
{*php
/**
 * The control view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<hr class='space'>
<div class='panel panel-body panel-section'>
  <div class='alert bg-primary-pale'>{!printf($lang->user->control->welcome, $control->app->user->realname)}</div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side')}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}

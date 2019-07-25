<?php if(!defined("RUN_MODE")) die();?>
<?php
$config->user = new stdclass();
$config->user->resetExpired = 3*86400;

$config->user->skipedFields = new stdclass();
$config->user->skipedFields->create = 'ip,fingerprint,private,emailCertified,mobileCertified,registerAgreement';
$config->user->skipedFields->update = 'ip,admin,email,groups,account,join,visits,fingerprint,locked,token,private,emailCertified,mobileCertified,bindSite';

$config->user->skipedFields->adminUpdate = 'groups,fingerprint';

$config->user->require = new stdclass();
$config->user->require->create      = 'account,realname,email,password1';
$config->user->require->register    = 'account,realname,email,password1';
$config->user->require->edit        = 'realname';
$config->user->require->setSecurity = 'question, answer, security';

$config->user->default = new stdclass();
$config->user->default->module = RUN_MODE == 'front' ? 'user'    : 'admin';
$config->user->default->method = RUN_MODE == 'front' ? 'control' : 'index';

$config->user->recPerPage = new stdclass();
$config->user->recPerPage->thread = 10;
$config->user->recPerPage->reply  = 10;

$config->user->level[1] = 0;
$config->user->level[2] = 500;
$config->user->level[3] = 2000;
$config->user->level[4] = 10000;
$config->user->level[5] = 30000;
$config->user->level[6] = 50000;
$config->user->level[7] = 200000;

$config->user->navGroups = new stdclass();
$config->user->navGroups->user    = 'profile,message,score,recharge';
$config->user->navGroups->order   = 'order,address';
$config->user->navGroups->message = 'thread,reply,submission';

$config->user->relatedTables = array();
$config->user->relatedTables[TABLE_MESSAGE][]  = 'account';
$config->user->relatedTables[TABLE_MESSAGE][]  = '`to`';
$config->user->relatedTables[TABLE_THREAD][]   = 'author';
$config->user->relatedTables[TABLE_THREAD][]   = 'repliedBy';
$config->user->relatedTables[TABLE_REPLY][]    = 'author';
$config->user->relatedTables[TABLE_CATEGORY][] = 'postedBy';
$config->user->relatedTables[TABLE_ADDRESS][]  = 'account';
$config->user->relatedTables[TABLE_CART][]     = 'account';
$config->user->relatedTables[TABLE_ORDER][]    = 'account';
$config->user->relatedTables[TABLE_ARTICLE][]  = 'addedBy';

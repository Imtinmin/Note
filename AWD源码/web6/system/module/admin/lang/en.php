<?php if(!defined("RUN_MODE")) die();?>
<?php
$lang->admin->common        = 'Admin';
$lang->admin->index         = 'Home';
$lang->admin->checked       = 'Checked';

$lang->admin->shortcuts = new stdclass();
$lang->admin->shortcuts->common             = 'Shortcuts';
$lang->admin->shortcuts->articleCategories  = 'Categories';
$lang->admin->shortcuts->article            = 'Articles';
$lang->admin->shortcuts->product            = 'Products';
$lang->admin->shortcuts->feedback           = 'Feedback';
$lang->admin->shortcuts->site               = 'Settings';
$lang->admin->shortcuts->logo               = 'Logo';
$lang->admin->shortcuts->company            = 'Company';
$lang->admin->shortcuts->contact            = 'Contacts';

$lang->admin->thread       = 'New Threads';
$lang->admin->order        = 'New Orders';
$lang->admin->feedback     = 'New Feedback';

$lang->admin->adminEntry     = 'Warning! The admin entry is admin.php. Please rename it for security reasons.';

$lang->admin->connectApiFail = "Can't connect to the chanzhi community, please <a href='javascritp:loaction.reload()'>retry</a> after check the internet connection.";
$lang->admin->registerInfo   = "The site has binded to Zsite %s, %s";
$lang->admin->registerPage   = 'Register Page';
$lang->admin->rebind         = "Rebind";
$lang->admin->bindedInfo     = 'ZSite Account';

$lang->js->confirmRebind = "Are you sure to rebind the account of Zsite?";

$lang->admin->register = new stdclass();
$lang->admin->register->common     = 'The page is to register with Zsite.';
$lang->admin->register->caption    = 'Register';
$lang->admin->register->lblAccount = 'Only letters and numbers are allowed. ';
$lang->admin->register->lblPasswd  = 'Only letters and numbers are allowed. ';
$lang->admin->register->submit     = 'Submit';
$lang->admin->register->success    = "Submitted.";
$lang->admin->register->update     = "Update information";

$lang->admin->bind = new stdclass();
$lang->admin->bind->caption = 'Zsite Account';
$lang->admin->bind->submit  = 'Bind account';
$lang->admin->bind->success = "Bind account successfully";

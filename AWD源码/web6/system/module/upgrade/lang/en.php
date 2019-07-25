<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The upgrade module English file of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     upgrade
 * @version     $Id: en.php 5119 2013-07-12 08:06:42Z wyd621@gmail.com $
 * @link        http://www.chanzhi.org
 */
$lang->upgrade->common  = 'Upgrade';

$lang->upgrade->result  = 'Backup Result';
$lang->upgrade->fail    = 'Backup failed!';
$lang->upgrade->success = 'Backed up!';
$lang->upgrade->tohome  = 'Back to Home';

$lang->upgrade->backup        = 'Data Backup';
$lang->upgrade->prepair       = 'Prepare to upgrade';
$lang->upgrade->selectVersion = 'Confirm current version';
$lang->upgrade->confirm       = 'Confirm SQL statement';
$lang->upgrade->execute       = 'Confirm';
$lang->upgrade->next          = 'Next';
$lang->upgrade->updateLicense = 'Zsite 4.0 has swtiched to use Z PUBLIC LICENSE(ZPL) 1.2.';

$lang->upgrade->deleteTips   = 'Need to delete some files. The commands in Linux are:<br />';
$lang->upgrade->deleteDir    = '<code>rm -fr %s</code>';
$lang->upgrade->deleteFile   = '<code>rm %s</code>';
$lang->upgrade->afterDeleted = '<br />Refresh after delete.';

$lang->upgrade->backupData = <<<EOT
<pre>
<strong>Use phpMyAdminor mysqldump to backup database.</strong>
<textarea class='autoSelect w-500px red' readonly rows='1' > mysqldump -u %s -p%s %s > chanzhi.sql </textarea>
</pre>
EOT;

$lang->upgrade->createSlidePath = <<<EOT
<div class='alert'> Please create a silde directory <b>%s</b> and turn on the permission to write in this directory. </div>
EOT;

$lang->upgrade->chmodThemePath = <<<EOT
<div class='alert'> Please turn on the wirte permission of <b>%s</b> and continuee. </div>
EOT;

$lang->upgrade->chmodCustomConfig = <<<EOT
<div class='alert'> Please turn on the wirte permission of <b>%s</b> and continuee. </div>
EOT;

$lang->upgrade->versionNote = " Please choose the right version, or it might cause data loss.";

$lang->upgrade->fromVersions['1_1']      = '1.1.stable';
$lang->upgrade->fromVersions['1_2']      = '1.2.stable';
$lang->upgrade->fromVersions['1_3']      = '1.3.stable';
$lang->upgrade->fromVersions['1_4']      = '1.4.stable';
$lang->upgrade->fromVersions['1_5']      = '1.5.stable';
$lang->upgrade->fromVersions['1_6']      = '1.6.stable';
$lang->upgrade->fromVersions['1_7']      = '1.7.stable';
$lang->upgrade->fromVersions['1_8']      = '1.8.stable';
$lang->upgrade->fromVersions['2_0']      = '2.0.stable';
$lang->upgrade->fromVersions['2_0_1']    = '2.0.1.stable';
$lang->upgrade->fromVersions['2_1']      = '2.1.stable';
$lang->upgrade->fromVersions['2_2']      = '2.2.stable';
$lang->upgrade->fromVersions['2_2_1']    = '2.2.1.stable';
$lang->upgrade->fromVersions['2_3']      = '2.3.stable';
$lang->upgrade->fromVersions['2_4']      = '2.4.stable';
$lang->upgrade->fromVersions['2_5_beta'] = '2.5.beta';
$lang->upgrade->fromVersions['2_5_1']    = '2.5.1';
$lang->upgrade->fromVersions['2_5_2']    = '2.5.2';
$lang->upgrade->fromVersions['2_5_3']    = '2.5.3';
$lang->upgrade->fromVersions['3_0']      = '3.0';
$lang->upgrade->fromVersions['3_0_1']    = '3.0.1';
$lang->upgrade->fromVersions['3_1']      = '3.1';
$lang->upgrade->fromVersions['3_2']      = '3.2';
$lang->upgrade->fromVersions['3_3']      = '3.3';
$lang->upgrade->fromVersions['4_0']      = '4.0';
$lang->upgrade->fromVersions['4_1_beta'] = '4.1.beta';
$lang->upgrade->fromVersions['4_2']      = '4.2';
$lang->upgrade->fromVersions['4_2_1']    = '4.2.1';
$lang->upgrade->fromVersions['4_3_beta'] = '4.3.beta';
$lang->upgrade->fromVersions['4_4']      = '4.4';
$lang->upgrade->fromVersions['4_4_1']    = '4.4.1';
$lang->upgrade->fromVersions['4_5']      = '4.5';
$lang->upgrade->fromVersions['4_5_1']    = '4.5.1';
$lang->upgrade->fromVersions['4_5_2']    = '4.5.2';
$lang->upgrade->fromVersions['4_6']      = '4.6';
$lang->upgrade->fromVersions['5_0']      = '5.0';
$lang->upgrade->fromVersions['5_0_1']    = '5.0.1';
$lang->upgrade->fromVersions['5_1']      = '5.1';
$lang->upgrade->fromVersions['5_2']      = '5.2';
$lang->upgrade->fromVersions['5_3']      = '5.3';
$lang->upgrade->fromVersions['5_3_1']    = '5.3.1';
$lang->upgrade->fromVersions['5_3_2']    = '5.3.2';
$lang->upgrade->fromVersions['5_3_3']    = '5.3.3';
$lang->upgrade->fromVersions['5_3_4']    = '5.3.4';
$lang->upgrade->fromVersions['5_4']      = '5.4';
$lang->upgrade->fromVersions['5_4_1']    = '5.4.1';
$lang->upgrade->fromVersions['5_5']      = '5.5';
$lang->upgrade->fromVersions['5_6']      = '5.6';
$lang->upgrade->fromVersions['5_7']      = '5.7';
$lang->upgrade->fromVersions['6_0']      = '6.0';
$lang->upgrade->fromVersions['6_1']      = '6.1';
$lang->upgrade->fromVersions['6_2']      = '6.2';
$lang->upgrade->fromVersions['6_3_beta'] = '6.3.beta';
$lang->upgrade->fromVersions['6_4']      = '6.4';
$lang->upgrade->fromVersions['6_4_1']    = '6.4.1';
$lang->upgrade->fromVersions['6_5']      = '6.5';
$lang->upgrade->fromVersions['6_6']      = '6.6';
$lang->upgrade->fromVersions['6_6_1']    = '6.6.1';
$lang->upgrade->fromVersions['6_7']      = '6.7';
$lang->upgrade->fromVersions['6_7_1']    = '6.7.1';
$lang->upgrade->fromVersions['7_0']      = '7.0';

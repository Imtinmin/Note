<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<div><div><div><div>
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from set-pageset-nav-form" name="myform" action="{$_M[url][own_form]}a=dosave_pageset_nav" target="_self">
	<div class="v52fmbx">
		<dl>
			<dd class="ftype_description">勾选的应用将出现在导航栏【常用功能】下拉列表中</dd>
		</dl>
		<dl class="set-pageset-nav">
<!--
EOT;
foreach ($applist as $value) {
	if($value['display']){
		$value['info']=mb_substr($value['info'],0,40,'utf-8');
		$checked=$value['display']==2?' checked':'';
echo <<<EOT
-->
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="media ui-item{$checked}" data-id="{$value['id']}">
					<div class="media-left">
						<img src="{$_M['url']['app']}{$value['m_name']}/icon.png" alt="{$value['appname']}" width="80">
					</div>
					<div class="media-body">
						<h4 class="media-heading">{$value['appname']}</h4>
						<p>{$value['info']}</p>
					</div>
					<i class="fa fa-check"></i>
				</div>
			</div>
<!--
EOT;
	}
}
echo <<<EOT
-->
		</dl>
	</div>
	<input type="submit" value="{$_M['word']['Submit']}" class="submit hide">
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
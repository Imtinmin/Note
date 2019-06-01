<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<div id="contain">
<ul class="breadcrumb">
     <li> <span>账户管理</span><span class="divider">/</span><span>我的账户</span></li>
</ul>
        <table class="table table-bordered">
            <tr>
              <th width="200" align="right">入款总额 ：</th>
              <td>￥{$info['rmb']}</td>
            </tr>
            <tr>
              <th width="200" align="right">支付总额：</th>
              <td>￥{$info['crmb']}</td>
            </tr>
            <tr>
              <th width="200" align="right">余额：</th>
              <td>￥{$info['rrmb']}</td>
            </tr>
        </table>
</div>
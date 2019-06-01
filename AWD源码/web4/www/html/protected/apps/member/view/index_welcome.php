<?php if(!defined('APP_NAME')) exit;?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css" />
<div id="contain">
  <ul class="breadcrumb">
     <li> <span>基础信息</span></li>
  </ul>
   <table width="100%" class="table">
      <tr>
         <td>当前用户:<font color="blue"><?php eval("echo ${auth['nickname']};");?></font></td>
         <td>上次登录IP:<font color="blue"><?php echo $auth['lastip'];?> </font></td>
      </tr>
   </table>
</div>

<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<title>标签添加</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">        
           <div class="list_head_ml">当前位置：【标签添加】</div>                    
        </div>
         <form action=""  method="post" id="info">
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <tr>
            <td width="15%" align="right">标签名：</td>
            <td><input type="text" name="name" value=""></td>
            <td align="left" class="inputhelp"></td>
          </tr>
          <tr>
            <td width="15%" align="right">URL：</td>
            <td><input type="text" name="url" size="30" value=""></td>
            <td align="left" class="inputhelp">http://开头网址</td>
          </tr>
          <tr>
          <td align="right"></td>
             <td align="left"><input class="btn btn-small btn-primary" type="submit" value="添加"></td>
             <td align="left" id="backdata" style="color:green"></td>
          </tr>
         </table>
         </form>
</div>
</body>
</html>
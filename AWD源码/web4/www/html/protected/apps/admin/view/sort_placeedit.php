<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<title>编辑定位</title>
</head>
<body>
<div class="contener">
   <div class="list_head_m">
    <div class="list_head_ml">当前位置：【定位编辑】</div>
    <div class="list_head_mr"></div>
    </div>
          <form action="{url('sort/placeedit',array('id'=>$info['id']))}"  method="post" id="info">
          <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">  
          <tr>
            <td align="right">定位名称：</td>
            <td align="left">
              <input type="text" name="name" id="name" value="{$info['name']}">
            </td>
            <td align="left" class="inputhelp"></td>
          </tr>          
          <tr>
            <td align="right">排序：</td>
            <td align="left">
              <input type="text" name="norder" id="norder" value="{$info['norder']}" size="10">
            </td>
            <td align="left" class="inputhelp">值越大越靠前</td>
          </tr>       
          <tr>
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">              
              <input type="submit" value="编辑" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </table>
          </form>    
</div>
</body>
</html>     
<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<title>上传拓展文件</title>
</head>
<body>
  <form action="" method="post" style=" margin:0; padding:0;"  enctype="multipart/form-data" name="form1" id="form1">
	  <label for="fileField"></label>
	  <input type="file" name="fileField" id="fileField" style=" width:180px;" size="17" />
	  <input name="do" type="hidden" value="yes" />
	  <input name="inputName" type="hidden" value="{$inputName}" />
	  <input type="submit" value="上传" />
   </form>
</body>
</html>
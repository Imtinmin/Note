<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<title>资讯栏目批量编辑</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">当前位置：【资讯栏目批量编辑】</div>
           <div class="list_head_mr">

           </div>
        </div>  
    <form action=""  method="post" id="info">
          <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">    
          <tr>
            <td align="right">栏目ID：</td>
            <td align="left" colspan="2" style="color:green">{$ids}</td>
          </tr> 
          <tr>
            <td align="right">SEO关键词：</td>
            <td align="left"><input type="text" name="keywords" id="keywords" size="20"></td>
            <td class="inputhelp">留空不做修改</td>
          </tr> 
          <tr>
            <td align="right">SEO描述：</td>
            <td align="left"><textarea cols="30" rows="3" name="description" id="description"></textarea></td>
            <td class="inputhelp">留空不做修改</td>
          </tr>
          <tr>
            <td align="right">前台每页显示条数：</td>
            <td align="left"><input type="text" name="num" id="num" value="" size="4"></td>
            <td class="inputhelp">留空不做修改</td>
          </tr>
          <tr>
            <td align="right">前台栏目模板：</td>
            <td align="left">
              <select name="tplist" id="tplist">
               <option value="">=不做修改=</option>
               {$chooseL}
              </select>
            </td>
            <td align="left" class="inputhelp">栏目模板和内容模板必须同时选择才能修改成功</td>
          </tr> 
          <tr>
            <td align="right">前台默认内容模板：</td>
            <td align="left">
              <select name="cnlist" id="cnlist">
               <option value="">=不做修改=</option>
               {$chooseC}
              </select>
            </td>
            <td align="left" class="inputhelp">栏目模板和内容模板必须同时选择才能修改成功</td>
          </tr>           
          <tr>
            <td align="right">排序：</td>
            <td align="left">
              <input type="text" name="norder" id="norder" value="" size="6">
            </td>
            <td align="left" class="inputhelp">请以数字表示分类的排序（值越小越靠前），留空不做修改</td>
          </tr> 
          <tr>
            <td align="right">是否前台显示：</td>
            <td align="left"><input  name="ifmenu"  type="radio" value="1" />是 <input name="ifmenu" type="radio" value="0" />否</td>
            <td class="inputhelp">留空不做修改</td>
          </tr> 
          <tr>
            <td align="right">字段拓展：</td>
            <td align="left">
              <select name="extendid" id="extendid">
                <option value="">=不做修改=</option>
                <option value="0">=不使用字段拓展=</option>
                {$extendoption}
              </select>
            </td>
            <td align="left" class="inputhelp">可以<a style="color:green" href="{url('extendfield/tableadd')}">在这里</a>拓展字段</td>
          </tr>            
          <tr>
            <td width="200">&nbsp;</td>
            <td align="left" colspan="2">
               <input type="hidden" value="{$ids}" name="ids">
               <input type="hidden" value="{$type}" name="type">
               <input type="submit" value="编辑" class="btn btn-primary btn-small">
               <input type="reset" value="重置" class="btn btn-primary btn-small">
            </td>
          </tr> 
          </table>
          </form>    
  </div>
</body>
</html>     
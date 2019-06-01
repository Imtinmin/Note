<?php if(!defined('APP_NAME')) exit;?>
<div class="contener">
<div class="list_head_m">
           <div class="list_head_ml">你当前的位置：【创建应用】</div>
           <div class="list_head_mr">
           </div>
        </div>

         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
           <form  method="post" action="{url('index/create')}">
            <tr>
              <td align="right">应用：</td>
              <td><input type="text" name="app_id" id="app_id" /></td>
              <td class="inputhelp">必须为全小写字母</td>
            </tr>
            <tr>
              <td align="right">应用名称：</td>
              <td><input  type="text" name="app_name" id="app_name" /></td>
              <td class="inputhelp"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td align="left" colspan="2"><input type="submit" value="创 建" class="btn btn-primary btn-small"></td>
            </tr>
        </form>
        </table>
  </div>
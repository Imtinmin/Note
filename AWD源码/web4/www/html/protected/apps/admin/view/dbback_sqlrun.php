<?php if(!defined('APP_NAME')) exit;?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-stand|ie-comp">
<meta http-equiv ="X-UA-Compatible" content = "IE=edge,chrome=1"/>
<link href="__PUBLICAPP__/css/back.css" type=text/css rel=stylesheet>
<title>SQL执行</title>
</head>
<body>
<div class="contener">
<div class="list_head_m">
    <div class="list_head_ml">当前位置：【SQL执行】</div>
 </div>
         <table width="100%" border="0" cellpadding="0" cellspacing="1"   class="all_cont">
          <form action=""  method="post">
          <tr> <td class="inputhelp">表前缀请使用<font color="red">&lt;prefix&gt;</font>,一次只能执行一条SQL命令，执行前请先备份数据库</td></tr>
          <tr>
            <td>
               <textarea name="sqlcode" style="width:97%; height:60px">{$sqlcode}</textarea><br>
                <input type="submit" value="执行" class="btn btn-primary btn-small">
            </td>
          </tr>
          </form>         
        </table>

        <?php if(!empty($list)){ ?>
         <table width="100%" border="0" cellpadding="0" cellspacing="1" class="all_cont">
          <tr>
            <th>执行结果</th>
          </tr>
          <tr>
            <td style="color:#666; line-height:18px">
           <?php
           if(is_array($list)){
              $recod=count($list);
              echo '查询到<font color="green">'.$recod.'</font>条记录<hr>';
              foreach ($list as $key => $vo) {
                 if(is_array($vo)){
                    foreach($vo as $k=>$v){
                       echo '<font color="green">'.$k.'</font>->"'.in($v).'"<font color="red">,</font>';
                    }
                    echo '<hr>';
                 }else{
                    echo '<font color="green">'.$key.'</font>->"'.in($vo).'"<font color="red">,</font>';
                 }
              }
           }else echo $list?'执行成功,影响<font color="red">'.$num.'</font>条记录~':'执行失败~';
           ?>
            </td>
          </tr>
        </table>
        <?php } ?>
</div>
</body>
</html>
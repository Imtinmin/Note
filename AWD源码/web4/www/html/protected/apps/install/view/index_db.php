<?php if(!defined('APP_NAME')) exit;?>
<div class="install_right">
 <form action="{url('index/db')}" method="post" >
  <div class="install_box">
      <h2>请输入数据库相关信息。若您不清楚，请咨询主机提供商。</h2>
      <table class="form-table"> 
        <tbody>
       <tr>
            <td><LABEL for=dbhost>数据库主机</LABEL></td>
            <td><input name="DB[DB_HOST]" type="text" value="localhost" class="install_input"></td>
            <td><CODE>localhost，必填</CODE></td>
          </tr>
          <tr>
            <td width="15%"><LABEL for=dbname>数据库名</LABEL></td>
            <td width="34%"><input name="DB[DB_NAME]" type="text" class="install_input"></td>
            <td width="51%"> 若不存在则尝试自动创建，必填</td>
          </tr>
          <tr>
            <td><LABEL for=uname>数据库用户名</LABEL></td>
            <td><input name="DB[DB_USER]" type="text" class="install_input" value="root"></td>
            <td>您的 MySQL 用户名，必填</td>
          </tr>
          <tr>
            <td><LABEL for=pwd>数据库密码</LABEL></td>
            <td><input type="password"  name="DB[DB_PWD]" class="install_input"></td>
            <td>您的  MySQL 密码。</td>
          </tr>
          <tr>
            <td><LABEL for=pwd>数据库驱动</LABEL></td>
            <td><input name="DB[DB_TYPE]" type="radio" value="Mysql" checked/> Mysql &nbsp;<input name="DB[DB_TYPE]" type="radio" value="Mysqli" /> Mysqli &nbsp;<input name="DB[DB_TYPE]" type="radio" value="MysqlPdo"/> MysqlPdo</td>
            <td></td>
          </tr>
          <tr>
            <td><LABEL for=dbport>端口</LABEL></td>
            <td><input name="DB[DB_PORT]" type="text" value="3306" class="install_input"></td>
            <td>默认3306，必填</td>
          </tr>
          <tr>
            <td><LABEL for=prefix>表名前缀</LABEL></td>
            <td><input name="DB[DB_PREFIX]" type="text" value="yx_" class="install_input"></td>
            <td>区分其他数据表，提高安全性，必填</td>
          </tr>
          <tr>
            <td><LABEL for=prefix>加密秘钥</LABEL></td>
            <td><input type="text" name="APP[ENCODE_KEY]" value="{$randomcode}" class="install_input"></td>
            <td>用于关键数据加密，选填</td>
          </tr>
          <tr>
            <td><LABEL for=prefix>COOKIE前缀</LABEL></td>
            <td><input type="text" name="APP[COOKIE_PRE]" value="yx_" class="install_input"></td>
            <td>用于区分其他系统COOKIE，必填</td>
          </tr>
          <tr>
            <td><LABEL for=prefix>安装演示数据</LABEL></td>
            <td><input type="checkbox" name="IF_DATA" checked value="1" ></td>
            <td></td>
          </tr>
          <tr>
            <td><LABEL for=prefix>保留上传文件</LABEL></td>
            <td><input type="checkbox" name="IF_UPDATA" checked value="1" ></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="install_btn">
      <input class="button" value="上一步" type="button" onClick="window.location.href = '{url('index/env')}'">
      <input class="button" value="开始安装" type="submit" >
    </div>
  </form>
  </div>
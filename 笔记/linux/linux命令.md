# linux 学习

ubuntu 支持32位程序 
sudo apt-get install libc6:i386

### CTF linux常用命令

#### 查后门

> find / -name *.php|xargs grep -in "@eval"
> find / -name *.php|xargs grep -in "system"
> find / -name *.php|xargs grep -in "shell_exec"



### 数据库命令（mysql）

导出：mysqldump -uroot -p 数据库名>name.sql

##### *监控输出命令*

> 
>
> watch -d -n 1 "tail -n 10 /tmp/log_normal" 
>
> 

***


### 常用命令



## *wget*

>下载：wget http://cn.wordpress.org/wordpress-3.1-zh_CN.zip 
>
>下载保存成另一个文件名：wget -O wordpress.zip http://www.centos.bz/download.php?id=1080
>
>限速下载：wget –limit-rate=300k http://cn.wordpress.org/wordpress-3.1-zh_CN.zip 
>
>继续下载中断的：wget -c http://cn.wordpress.org/wordpress-3.1-zh_CN.zip 
>
>测试下载连接：wget –spider URL
>
>重试：wget –tries=40 URL 
>
>下载txt里的多个链接：wget -i filelist.txt 

## *scp*

> scp -P [端口号]  +文件路径(/var/www/html/index.php) + username@39.108.36.103:+dirname



### vi使用



按下 `/`输入关键词进行搜索，按n跳到下一个匹配字符

ctri+g /G 跳转到文件末

dd 删除一行



### SS 命令

```bash
Usage: ss [ OPTIONS ]
       ss [ OPTIONS ] [ FILTER ]
   -V, --version        output version information
   -n, --numeric        don't resolve service names
   -r, --resolve       resolve host names
   -a, --all            display all sockets
   -l, --listening      display listening socket
   -o, --options       show timer information
   -e, --extended      show detailed socket information
   -m, --memory        show socket memory usage
   -p, --processes      show process using socket
   -i, --info           show internal TCP information
   -s, --summary        show socket usage summary

   -0, --packet display PACKET sockets
   -t, --tcp            display only TCP sockets
   -u, --udp            display only UDP sockets
   -d, --dccp           display only DCCP sockets
   -w, --raw            display only RAW sockets
   -x, --unix           display only Unix domain sockets
   -f, --family=FAMILY display sockets of type FAMILY
 
   -A, --query=QUERY, --socket=QUERY
       QUERY := {all|inet|tcp|udp|raw|unix|packet|netlink}[,QUERY]
 
   -D, --diag=FILE      Dump raw information about TCP sockets to FILE
   -F, --filter=FILE   read filter information from FILE
       FILTER := [ state TCP-STATE ] [ EXPRESSION ]
```

```bash
root# ss -ltn
State       Recv-Q Send-Q                 Local Address:Port                                Peer Address:Port              
LISTEN      0      128                                *:80                                             *:*                  
LISTEN      0      128                                *:122                                            *:*                  
LISTEN      0      128                                *:443                                            *:*                  
LISTEN      0      80                                :::3306                                          :::*             
```

### lsof	(查看文件使用)

```
root# lsof -h
lsof 4.89
 latest revision: ftp://lsof.itap.purdue.edu/pub/tools/unix/lsof/
 latest FAQ: ftp://lsof.itap.purdue.edu/pub/tools/unix/lsof/FAQ
 latest man page: ftp://lsof.itap.purdue.edu/pub/tools/unix/lsof/lsof_man
 usage: [-?abhKlnNoOPRtUvVX] [+|-c c] [+|-d s] [+D D] [+|-E] [+|-e s] [+|-f[gG]]
 [-F [f]] [-g [s]] [-i [i]] [+|-L [l]] [+m [m]] [+|-M] [-o [o]] [-p s]
 [+|-r [t]] [-s [p:s]] [-S [t]] [-T [t]] [-u s] [+|-w] [-x [fl]] [--] [names]
Defaults in parentheses; comma-separated set (s) items; dash-separated ranges.
  -?|-h list help          -a AND selections (OR)     -b avoid kernel blocks
  -c c  cmd c ^c /c/[bix]  +c w  COMMAND width (9)    +d s  dir s files
  -d s  select by FD set   +D D  dir D tree *SLOW?*   +|-e s  exempt s *RISKY*
  -i select IPv[46] files  -K list tasKs (threads)    -l list UID numbers
  -n no host names         -N select NFS files        -o list file offset
  -O no overhead *RISKY*   -P no port names           -R list paRent PID
  -s list file size        -t terse listing           -T disable TCP/TPI info
  -U select Unix socket    -v list version info       -V verbose search
  +|-w  Warnings (+)       -X skip TCP&UDP* files     -Z Z  context [Z]
  -- end option scan     
  -E display endpoint info              +E display endpoint info and files
  +f|-f  +filesystem or -file names     +|-f[gG] flaGs 
  -F [f] select fields; -F? for help  
  +|-L [l] list (+) suppress (-) link counts < l (0 = all; default = 0)
                                        +m [m] use|create mount supplement
  +|-M   portMap registration (-)       -o o   o 0t offset digits (8)
  -p s   exclude(^)|select PIDs         -S [t] t second stat timeout (15)
  -T qs TCP/TPI Q,St (s) info
  -g [s] exclude(^)|select and print process group IDs
  -i i   select by IPv[46] address: [46][proto][@host|addr][:svc_list|port_list]
  +|-r [t[m<fmt>]] repeat every t seconds (15);  + until no files, - forever.
       An optional suffix to t is m<fmt>; m must separate t from <fmt> and
      <fmt> is an strftime(3) format for the marker line.
  -s p:s  exclude(^)|select protocol (p = TCP|UDP) states by name(s).
  -u s   exclude(^)|select login|UID set s
  -x [fl] cross over +d|+D File systems or symbolic Links
  names  select named files or files on named file systems
Anyone can list all files; /dev warnings disabled; kernel ID check disabled.
```

### SED

```
sed -i 's/原字符串/新字符串/' /home/1.txt
sed -i 's/原字符串/新字符串/g' /home/1.txt
```

## base64 解码
```
echo PD9waHAgJGZsYWcgPSBoZ2FtZXtUaEVyNF9BcjRfczBtNF9QaHBfVHIxY2tzfSA/Pgo= | base64 -d
```

## tr

>tr -d +字符串
删除特定字符

>tr + 字符串1 + 字符串2

替换字符串1 为 字符串2



## 文件内容查看

```bash
nl [file]  显示行号

head 显示前几行
	-n 前几行
	-c 前多少字节
	
tail 显示后面几行
	-n 行数
less 
```

## AWK

> 格式化输出(默认分隔空格符)

```bash
$echo 1231   3123  31231 | awk '{print $1}'
$1231
```

> 指定分隔 -F 

```
awk -F "="
```

`vim`
```
开始编辑：按下 i I o O r R
dd 删除一行
dG 删除光标所在位置到最后一行所有数据
gg 移动到第一行
0 移动到这一行第一个字符
$ 移动到这一行最后一个字符
G 移动到最后
:w 写入磁盘 后可以接文件名
:q 退出不保存
! 强制

查找替换
:n1,n2s/word1/word2/g n1到n2 word1替换为word2
:1,$s/word1/word2/g 从第一行到最后一行word1替换为word2
```
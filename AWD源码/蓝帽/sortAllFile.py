#!/usr/bin/env python
# _*_ coding:utf-8 _*_

import os
import time
import traceback

ignore_keyword = ['/Cache/', '/cache/', '/Session/', '/session']
files_mtime = []

for (root, dirs, files) in os.walk("/var/www/html/"):
    '''
    for dirc in dirs:
        print os.path.join(root, dirc)
    '''

    for filename in files:
        try:
            filepath = os.path.join(root, filename)
            ignore = 0
            for keyword in ignore_keyword:
                if keyword in filepath: ignore = 1
            if ignore == 1: continue
            if os.path.splitext(filepath)[1] != '.php': continue
            filemtime = os.path.getmtime(filepath)
            file = [filepath, filemtime]
            files_mtime.append(file)
        except:
            traceback.print_exc()
            #traceback.format_exc()
            pass

files_mtime = sorted(files_mtime, key=lambda mtime: mtime[1], reverse=False)

for (filepath, filemtime) in files_mtime:
    print ('%d: %s : %s' % (filemtime, time.strftime("%Y-%m-%d %H:%M:%S",time.localtime(filemtime)), filepath))
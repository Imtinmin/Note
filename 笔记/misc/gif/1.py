white = open('C:\\Users\\Imtinmin\\Desktop\\gif\\0.jpg','rb').read()
black = open('C:\\Users\\Imtinmin\\Desktop\\gif\\1.jpg','rb').read()

flag_binary = ''

for i in range(104):
	with open("C:\\Users\\Imtinmin\\Desktop\\gif\\{}.jpg".format(i),'rb') as f:
		if f.read() == white:
			flag_binary += '0'
		else:
			flag_binary += '1'
print flag_binary
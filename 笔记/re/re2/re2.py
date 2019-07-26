s = "66h, 6Dh, 63h, 64h, 7Fh, 60h, 32h, 74h, 71h, 56h, 58h,4Eh, 53h, 75h, 3Eh, 7Dh, 4Fh, 72h, 7Ah, 20h, 77h, 5Eh,5Dh, 5Ch, 65h, 27h"
l =  s.split(',')
b = []
for i in l:
	b.append(i.strip()[:-1])
print b
flag = ''
for i in range(25):
	flag += chr(i ^ int(b[i],16))
print flag
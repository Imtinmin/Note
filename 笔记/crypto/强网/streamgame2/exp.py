def lfsr(R,mask):
    output = (R << 1) & 0xffffff
    i=(R&mask)&0xffffff
    lastbit=0
    while i!=0:
        lastbit^=(i&1)
        i=i>>1
    output^=lastbit
    return (output,lastbit)

mask=0x100002

key = open('./key','rb').read()
for t in range(pow(2,21)):
	R = t
	get = 0
	for i in range(12):
		tmp=0
		for j in range(8):
			(R,out)=lfsr(R,mask)
			tmp=(tmp << 1)^out
		if chr(tmp) != key[i]: break
		if i==11 : get = 1
	if get == 1:
		print bin(t)
		break
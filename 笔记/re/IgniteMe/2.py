s="GONDPHyGjPEKruv{{pj]X@rF"

d = [0x0D,0x13,0x17,0x11,2,1,0x20,0x1D,0x0C,2,0x19,0x2F,0x17,0x2B,0x24,0x1F,0x1E,0x16,9,0x0F,0x15,0x27,0x13,0x26,0x0A,0x2F,0x1E,0x1A,0x2D,0x0C,0x22,4]
flag = ''
for i in range(len(s)):
	flag += chr(((ord(s[i]) ^ d[i])-72)^ 0x55)

print flag
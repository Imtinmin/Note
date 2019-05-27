# -*- coding: utf-8 -*-
import libnum

def LFSR_inv(R,mask):
    str=bin(R)[2:].zfill(32)	#给前面补零
    new=str[-1:]+str[:-1]
    new=int(new,2)                    #R循环右移一位得到new
    i = (new & mask) & 0xffffffff
    lastbit = 0
    while i != 0:
        lastbit ^= (i & 1)
        i = i >> 1
    return R>>1 | lastbit<<31         #最高位用lastbit填充

mask = 0b10100100000010000000100010010100
data=open('key').read()
data=data[:4]
c=libnum.s2n(data)                    #生成32比特后的状态
for _ in range(32):
    c=LFSR_inv(c,mask)
print hex(c)
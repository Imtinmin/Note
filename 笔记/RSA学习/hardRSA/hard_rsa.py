#Rabin      e=2
#linux 
import gmpy2
import string
from Crypto.PublicKey import RSA


cipher = open('flag.enc','r').read().encode("hex")
cipher = string.atoi(cipher,base=16)

with open('./pubkey.pem', 'r') as f:
    key = RSA.importKey(f)
    N = key.n
    e = key.e
#print N
# factordb
p = 275127860351348928173285174381581152299
q = 319576316814478949870590164193048041239
# yp,yq
inv_p = gmpy2.invert(p, q)
inv_q = gmpy2.invert(q, p)

# mp,mq
mp = pow(cipher, (p + 1) / 4, p)
mq = pow(cipher, (q + 1) / 4, q)

# a,b,c,d
a = (inv_p * p * mq + inv_q * q * mp) % N
b = N - int(a)
c = (inv_p * p * mq - inv_q * q * mp) % N
d = N - int(c)

for i in (a, b, c, d):
    s = '%x' % i
    if len(s) % 2 != 0:
        s = '0' + s
    print s.decode('hex')
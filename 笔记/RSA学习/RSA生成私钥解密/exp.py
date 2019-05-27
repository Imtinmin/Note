import gmpy2
import string
from Crypto.PublicKey import RSA

with open('./pub.key', 'r') as f:
    key = RSA.importKey(f)
    N = key.n
    e = key.e

cipher = open('flag.enc','r').read().encode("hex")
cipher = string.atoi(cipher,base=16)
print N
print e
print cipher
p = 285960468890451637935629440372639283459
q = 304008741604601924494328155975272418463
phin = (p - 1)*(q - 1)
d = gmpy2.invert(e,phin)
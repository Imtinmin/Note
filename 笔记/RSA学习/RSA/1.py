# -- EXP.PY --
# -*-coding:utf-8 -*-
from Cryptodome.PublicKey import RSA
from Cryptodome.Cipher import PKCS1_v1_5
from Cryptodome.Util.number import long_to_bytes
import gmpy2
import base64
with open('./pub.key', 'r') as f:
	key = RSA.import_key(f.read())
	N = key.n
	e = key.e

print(N)
print(e)
p = 285960468890451637935629440372639283459
q = 304008741604601924494328155975272418463
phin = (p - 1)*(q - 1)
d = gmpy2.invert(e,phin)
print(d)

cipher = open('flag.enc','rb').read().hex()

# ---------- private key -------------------
prv = RSA.construct((N,e,int(d),p,q)) #生成私钥

rsa = PKCS1_v1_5.new(prv)
print(rsa.decrypt(bytes.fromhex(cipher), e))

# ---------- public key -------------------

flag = int(cipher,16)
m = pow(flag,d,N)
print(long_to_bytes(m))

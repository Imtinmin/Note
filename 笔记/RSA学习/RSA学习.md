# RSA学习

https://www.freebuf.com/articles/others-articles/166049.html

> 明文n = pow(c,d,N)

表示c的n次方取模

### python库

gmpy

​	gmpy.root(x,y)=a,b	a为x 开 y 次方的值，a为整数则b为1，否则b为0

gmpy2

​	**invert(...)**

​	invert(x, m) returns *y* such that *x* * *y* == 1 modulo *m*, or 0 if no such *y* exists.

### openssl[¶](https://ctf-wiki.github.io/ctf-wiki/crypto/asymmetric/rsa/rsa_theory/#openssl)

- 查看公钥文件

  ```bash
  openssl rsa -pubin -in pubkey.pem -text -modulus
  ```

- 解密

  ```ba&#39;sh
  rsautl -decrypt -inkey private.pem -in flag.enc -out flag
  ```

#### *medium_rsa*

```python
import gmpy2
from Crypto.Util.number import long_to_bytes
  
e = 65537
N = 0xC2636AE5C3D8E43FFB97AB09028F1AAC6C0BF6CD3D70EBCA281BFFE97FBE30DD # 87924348264132406875276140514499937145050893665602592992418171647042491658461
p = 275127860351348928173285174381581152299
q = 319576316814478949870590164193048041239
  
flag = open('flag.enc','r').read().encode('hex')
phin = (p - 1) * (q - 1)
  
d = gmpy2.invert(e,phin)
flag = int(flag,16)
m = pow(flag,d,N)
print long_to_bytes(m)
```



#### *hard_RSA*

使用 Crypto 库来读取公钥，刚开始做以为是普通的小公钥指数攻击，e=3，但是题目说不用爆破，而且试了		一下跑不出来，发现Rebin算法，https://ctf-wiki.github.io/ctf-wiki/crypto/asymmetric/rsa/rsa_e_attack/#rsa-rabin

先上	factordb 解出p，q

脚本跑一下，windows会有ioerror，放linux上就可以了

```python
#Rabin     
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
print N
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
```

共模攻击原理：

```
c_1 equiv m^{e_1} text{ } mod text{ } n
c_2 equiv m^{e_2} text{ } mod text{ } n
gcd(e1,e2) = 1
```

那么根据贝祖等式:

```
ax+by = gcd(a,b) = d
```

我们一定可以得到

```
e1s1+e2s2 = 1
```

那么我们将最初的两个等式进行变形

```
c_1^{s_1} equiv m^{e_1s_1} text{ } mod text{ } n
c_2^{s_2} equiv m^{e_2s_2} text{ } mod text{ } n
```

我们将其相乘
`c_1^{s_1}c_2^{s_2} text{ } mod text{ } n equiv m^{e_1s_1+e_2s_2} text{ } mod text{ } n`

则得到

```
c_1^{s_1}c_2^{s_2} text{ } mod text{ } n equiv m^{1} text{ } mod text{ } n
```


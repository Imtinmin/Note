import os
def xor(a,b):
    assert len(a)==len(b)
    c=""
    for i in range(len(a)):
        c+=chr(ord(a[i])^ord(b[i]))
    return c
def f(x,k):
    return xor(xor(x,k),7)
def round(M,K):
    L=M[0:27]
    R=M[27:54]
    new_l=R
    new_r=xor(xor(R,L),K) 
    return new_l+new_r
def fez(m,K):
    for i in K:
        m=round(m,i)
    return m

K=[]
for i in range(7):
    K.append(os.urandom(27))
m=open("flag","rb").read()
assert len(m)<54
m+=os.urandom(54-len(m)) #m=flag+urandom(?)
test=os.urandom(54)
print test.encode("hex")    #R7  L7
print fez(test,K).encode("hex")  #R     test=round(test,k[x])   K=
print fez(m,K).encode("hex")    #m=round(m,k[x])

#  51026a40ec1e8dbc84afe07fa1678629bd52dbbefc7037c2c38665401e066031b8120d687098b588f65aa09f974279bd3a8352adcd80
#  2ae39981788cf243a32ba7ba7c41b451d74f6b8941bb6222f92f011a1ffdffd8dff28487ba45dc0b88d3f249ec73aa660b13c2e71173
#  0c9be28d74519aa64d689d2de80063f51fdccc239fa6d6041f03240b098dd4437a72ae9933f36b49cbe314631b39881b0aff4af2dd5a









#test 左边Lt 右边Rt  第一次：Rt+Lt^Rt^K1
#                           Lt^Rt^K1+Lt^K1^K2
#                           Lt^K1^K2+Rt^K2^K3
#                           Rt^K2^K3+Rt^Lt^K1^K3^K4
#                           Rt^Lt^K1^K3^K4+Lt^K1^K2^K4^K5
#                           Lt^K1^K2^K4^K5+Rt^K2^K3^K5^K6
#                           Rt^K2^K3^K5^K6+Rt^Lt^K1^K3^K4^K6^K7   fez(test,K)   test_K
#
#   m左边 Lm  右边Rm 第二次: Rm+Lm^Rm^K1
#                           Lm^Rm^K1+Lm^K1^K2
###                         Lm^K1^K2+Rm^K2^K3
 ##3`                       Rm^K2^K3+Rm^Lm^K1^K3^K4
#                           Rm^Lm^K1^K3^K4+Lm^K1^K2^K4^K5
#                           Lm^K1^K2^K4^K5+Rm^K2^K3^K5^K6
#                           Rm^K2^K3^K5^K6+Rm^Lm^K1^K3^K4^K6^K7   fez(m,K)  m_K
#           
#                           test_L=Rt^Rm   test_R=Rm^Lm^Rt^Lt   R=Rt^Rm     RL=Rt^Lt^Rm^Lm   L=RL^R     Rm=R^test_R     Lm=L^test_L
#
#    0b001000^0b111000                  48
#    (0b000100+0b000100)^(0b011000+0b100000)    48
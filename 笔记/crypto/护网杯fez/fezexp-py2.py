# -*-coding:utf-8	-*-
def xor(a,b):
    assert len(a)==len(b)
    c=""
    for i in range(len(a)):
        c+=chr(ord(a[i])^ord(b[i]))
    return c

test = '51026a40ec1e8dbc84afe07fa1678629bd52dbbefc7037c2c38665401e066031b8120d687098b588f65aa09f974279bd3a8352adcd80'.decode('hex')
test_K = '2ae39981788cf243a32ba7ba7c41b451d74f6b8941bb6222f92f011a1ffdffd8dff28487ba45dc0b88d3f249ec73aa660b13c2e71173'.decode('hex')
m_K = '0c9be28d74519aa64d689d2de80063f51fdccc239fa6d6041f03240b098dd4437a72ae9933f36b49cbe314631b39881b0aff4af2dd5a'.decode('hex')

#   Rt^Rm^(Rt)=Rm
#   Rt^Lt^Rm^Lm^(Rt^Lt^Rm)=Lm

# m(FLAG)=Lm+Rm

Lt=test[0:27]
Rt=test[27:54]

#   Kl=K2^K3^K5^k6  Kr=K1^K3^K4^K6^K7

test_L = test_K[0:27]
test_R = test_K[27:54]


m_L=m_K[0:27]
m_R=m_K[27:54]


#Kl=xor(test_K[0:27],Rt)
#Kr=xor(Lt,xor(test_K[27:54],Rt))


R=xor(test_L,m_L) #Rt^Rm	再异或Rt，Rm就出来了
K_R=xor(test_R,m_R)	#Rt^Lt^Rm^Lm	发现跟左边异或就是Lt^Lm了


L=xor(R,K_R)	#Lt^Lm 	+Rt^Rm

test_m=L+R 	#Lt^Lm+Rt^Rm

flag=xor(test,test_m)


print flag



#Mr=xor(Kl,K_M[0:27])
#Ml=xor(Mr,xor(Kr,K_M[27:54]))

#print Ml,Mr

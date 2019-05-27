import base64
def decode2(ans):
    s = ''
    for i in ans:
        x = ord(i)
        x = (x ^ 36) -36
        s += chr(x)
    return s

def decode3(ans):
    return base64.b32decode(ans)

def decode1(ans):
    s = ''
    for i in ans:
        x = ord(i) - 25
        x = x ^ 36
        s += chr(x)
    return s

final = 'UC7KOWVXWVNKNIC2XCXKHKK2W5NLBKNOUOSK3LNNVWW3E==='

#print(decode3(final))
flag = decode1(decode2((decode3(final))))
print(flag)
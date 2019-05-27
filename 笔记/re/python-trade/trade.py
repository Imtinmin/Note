#!/usr/bin/env python
# encoding: utf-8
# 如果觉得不错，可以推荐给你的朋友！http://tool.lu/pyc
import base64

def encode(message):
    s = ''
    for i in message:
        x = ord(i) ^ 32
        x = x + 16
        s += chr(x)
    
    return base64.b64encode(s)

def decode(message):
    a = base64.b64decode(message)
    s = ''
    for i in a:
        s += chr((ord(i) - 16) ^ 32)
    return s

    
'''correct = 'XlNkVmtUI1MgXWBZXCFeKY+AaXNt'
flag = ''
print 'Input flag:'
flag = raw_input()
if encode(flag) == correct:
    print 'correct'
else:
    print 'wrong'
'''
correct = 'XlNkVmtUI1MgXWBZXCFeKY+AaXNt'
print decode(correct)

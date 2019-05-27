def decry(cipher):
	strs1 = "asdfghjkl;qwertyuiop!@#$%^&*()-+"
	strs2 = "zxcvbnm,./asdfghjkl;qwertyuiop{}"
	dir = dict(zip(strs1,strs2))

	num = "0123456789"
	res = ""
	for i in cipher:
		if i not in num:
			res += dir[chr(ord(i)-1)]
		else:
			res += i
	return res

def main():
	cipher = "spru.r5sf3h7660h7394e169699hffe0s0h$4,"
	print decry(cipher)

if __name__ == '__main__':
	main()
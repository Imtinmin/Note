# nginx+PHP配置

### 改 /etc/nginx/sites-enabled/default

```	
location ~ \.php$ {
		include snippets/fastcgi-php.conf;
	#
	#	# With php7.0-cgi alone:
	#	fastcgi_pass 127.0.0.1:9000;
	#	# With php7.0-fpm:
		fastcgi_pass unix:/run/php/php7.0-fpm.sock;
	}
```
- 去掉两个注释


```
	# Add index.php to the list if you are using PHP
	index index.html index.htm index.nginx-debian.html index.php;
```

添加index.php

如果没有php-fpm,则`apt-get install php-fpm`

这会在`/etc/php/7.2`生成fpm文件，其中`/fpm/pool.d/www.conf`中会有listen参数

决定default文件如掉`127.0.0.1:9000`注释还是去掉`php7.0-fpm`注释，二者选一，选多了，`service nginx restart`会报错
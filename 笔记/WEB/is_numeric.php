<?php
foreach([$_POST] as $global_var) { 
    foreach($global_var as $key => $value) { 
        $value = trim($value); 
        is_string($value) && $req[$key] = addslashes($value); 
    } 
}	
var_dump($req['number']);
var_dump(strval(intval($req['number'])));
var_dump($req['number'] == strval(intval($req['number'])));

#number=0e-0%00
<?php
function areyouok($greeting){
    return preg_match('/Merry.*Christmas/is',$greeting);
}

$greeting=@$_POST['greeting'];
if(!is_array($greeting)){
    if(!areyouok($greeting)){
        if(strpos($greeting,'Merry Christmas')!==false){
            echo 'Merry Christmas. '.'flag{xxxxxx}';
        }else{
            echo 'Do you know .swp file?';
        }
    }else{
        echo 'Do you know PHP?';
    }
}
?>

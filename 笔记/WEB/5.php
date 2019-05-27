 <?php
if(!isset($_GET['md5'])){die(highlight_file(__FILE__));}
if (isset($_GET['md5']) and strlen($_GET['md5']) == 3 and !is_numeric($_GET['md5'])){
    $md5=$_GET['md5'];
    if (floatval($md5)==md5($md5)){
        die(highlight_file("flag.php"));
    }else{
        echo htmlspecialchars($md5)."!=",md5($md5);
    }
}else{die(highlight_file(__FILE__));}
// xad
?> 

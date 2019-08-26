<?php
if (isset($_POST['message'])) {
    $message = json_decode($_POST['message']);
    $key ="*********";
    if ($message->key == $key) {
       // include("/flag");
    } 
    else {
        header('Location: ./1.gif');
    }
 }
 else{
     include("./public/index.php");
 }
?>

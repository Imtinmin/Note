<?php

ini_set('session.serialize_handler','php_serialize');
session_start();

$_SESSION['tinmin'] = @$_GET['tinmin'];
highlight_file(__file__);
?>